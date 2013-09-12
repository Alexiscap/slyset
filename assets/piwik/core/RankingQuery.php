<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 * @category Piwik
 * @package Piwik
 */

/**
 * The ranking query class wraps an arbitrary SQL query with more SQL that limits
 * the number of results while grouping the rest to "Others" and allows for some
 * more fancy things that can be configured via method calls of this class. The
 * advanced use cases are explained in the doc comments of the methods.
 *
 * The general use case looks like this:
 *
 * // limit to 500 rows + "Others"
 * $rankingQuery = new Piwik_RankingQuery(500);
 *
 * // idaction_url will be "Others" in the row that contains the aggregated rest
 * $rankingQuery->addLabelColumn('idaction_url');
 *
 * // the actual query. it's important to sort it before the limit is applied
 * $sql = 'SELECT idaction_url, COUNT(*) AS nb_hits
 *         FROM log_link_visit_action
 *         GROUP BY idaction_url
 *         ORDER BY nb_hits DESC';
 *
 * // execute the query
 * $rankingQuery->execute($sql);
 *
 *
 * For more examples, see RankingQueryTest.php
 *
 *
 * @package Piwik
 */
class Piwik_RankingQuery
{

    /**
     * Contains the labels of the inner query.
     * Format: "label" => true (to make sure labels don't appear twice)
     * @var array
     */
    private $labelColumns = array();

    /**
     * The columns of the inner query that are not labels
     * Format: "label" => "aggregation function" or false for no aggregation
     * @var array
     */
    private $additionalColumns = array();

    /**
     * The limit for each group
     * @var int
     */
    private $limit = 5;

    /**
     * The name of the columns that marks rows to be excluded from the limit
     * @var string
     */
    private $columnToMarkExcludedRows = false;

    /**
     * The column that is used to partition the result
     * @var bool|string
     */
    private $partitionColumn = false;

    /**
     * The possible values for the column $this->partitionColumn
     * @var array
     */
    private $partitionColumnValues = array();

    /**
     * The value to use in the label of the 'Others' row.
     * @var string
     */
    private $othersLabelValue = 'Others';

    /**
     * The constructor.
     * Can be used as a shortcut for setLimit()
     */
    public function __construct($limit = false)
    {
        if ($limit !== false) {
            $this->setLimit($limit);
        }
    }

    /**
     * Set the limit after which everything is grouped to "Others"
     *
     * @param $limit int
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
    }

    /**
     * Set the value to use for the label in the 'Others' row.
     *
     * @param $value string
     */
    public function setOthersLabel($value)
    {
        $this->othersLabelValue = $value;
    }

    /**
     * Add a label column.
     * Labels are the columns that are replaced with "Others" after the limit.
     *
     * @param $labelColumn string|array
     */
    public function addLabelColumn($labelColumn)
    {
        if (is_array($labelColumn)) {
            foreach ($labelColumn as $label) {
                $this->addLabelColumn($label);
            }
            return;
        }
        $this->labelColumns[$labelColumn] = true;
    }

    /**
     * Add a column that has be added to the outer queries.
     *
     * @param $column
     * @param string|bool $aggregationFunction string
     *         If set, this function is used to aggregate the values of "Others"
     */
    public function addColumn($column, $aggregationFunction = false)
    {
        if (is_array($column)) {
            foreach ($column as $c) {
                $this->addColumn($c, $aggregationFunction);
            }
            return;
        }
        $this->additionalColumns[$column] = $aggregationFunction;
    }

    /**
     * The inner query can have a column that marks the rows that shall be excluded from limiting.
     * If the column contains 0, rows are handled as usual. For values greater than 0, separate
     * groups are made. If this method is used, generate() returns both the regular result and
     * the excluded columns separately.
     *
     * @param $column string  name of the column
     * @throws Exception when method is used more than once
     */
    public function setColumnToMarkExcludedRows($column)
    {
        if ($this->columnToMarkExcludedRows !== false) {
            throw new Exception("setColumnToMarkExcludedRows can only be used once");
        }

        $this->columnToMarkExcludedRows = $column;
        $this->addColumn($this->columnToMarkExcludedRows);
    }

    /**
     * This method can be used to get multiple groups in one go. For example, one might query
     * the top following pages, outlinks and downloads in one go by using log_action.type as
     * the partition column and [TYPE_ACTION_URL, TYPE_OUTLINK, TYPE_DOWNLOAD] as the possible
     * values.
     * When this method has been used, generate() returns as array that contains one array
     * per group of data.
     *
     * @param $partitionColumn string
     * @param $possibleValues array of integers
     * @throws Exception when method is used more than once
     */
    public function partitionResultIntoMultipleGroups($partitionColumn, $possibleValues)
    {
        if ($this->partitionColumn !== false) {
            throw new Exception("partitionResultIntoMultipleGroups can only be used once");
        }

        $this->partitionColumn = $partitionColumn;
        $this->partitionColumnValues = $possibleValues;
        $this->addColumn($partitionColumn);
    }

    /**
     * Execute the query.
     * The object has to be configured first using the other methods.
     *
     * @param $innerQuery string  The "payload" query. The result has be sorted as desired.
     * @param $bind array         Bindings for the inner query.
     * @return array              The format depends on which methods have been used
     *                            to configure the ranking query
     */
    public function execute($innerQuery, $bind = array())
    {
        $query = $this->generateQuery($innerQuery);
        $data = Piwik_FetchAll($query, $bind);

        if ($this->columnToMarkExcludedRows !== false) {
            // split the result into the regular result and the rows with special treatment
            $excludedFromLimit = array();
            $result = array();
            foreach ($data as &$row) {
                if ($row[$this->columnToMarkExcludedRows] != 0) {
                    $excludedFromLimit[] = $row;
                } else {
                    $result[] = $row;
                }
            }
            $data = array(
                'result'            => &$result,
                'excludedFromLimit' => &$excludedFromLimit
            );
        }

        if ($this->partitionColumn !== false) {
            if ($this->columnToMarkExcludedRows !== false) {
                $data['result'] = $this->splitPartitions($data['result']);
            } else {
                $data = $this->splitPartitions($data);
            }
        }

        return $data;
    }

    private function splitPartitions(&$data)
    {
        $result = array();
        foreach ($data as &$row) {
            $partition = $row[$this->partitionColumn];
            if (!isset($result[$partition])) {
                $result[$partition] = array();
            }
            $result[$partition][] = & $row;
        }
        return $result;
    }

    /**
     * Generate the SQL code that does the magic.
     * If you want to get the result, use execute() instead. If you're interested in
     * the generated SQL code (e.g. for debugging), use this method.
     *
     * @param $innerQuery string  SQL of the actual query
     * @return string             entire ranking query SQL
     */
    public function generateQuery($innerQuery)
    {
        // +1 to include "Others"
        $limit = $this->limit + 1;
        $counterExpression = $this->getCounterExpression($limit);

        // generate select clauses for label columns
        $labelColumnsString = '`' . implode('`, `', array_keys($this->labelColumns)) . '`';
        $labelColumnsOthersSwitch = array();
        foreach ($this->labelColumns as $column => $true) {
            $labelColumnsOthersSwitch[] = "
				CASE
					WHEN counter = $limit THEN '" . $this->othersLabelValue . "'
					ELSE `$column`
				END AS `$column`
			";
        }
        $labelColumnsOthersSwitch = implode(', ', $labelColumnsOthersSwitch);

        // generate select clauses for additional columns
        $additionalColumnsString = '';
        $additionalColumnsAggregatedString = '';
        foreach ($this->additionalColumns as $additionalColumn => $aggregation) {
            $additionalColumnsString .= ', `' . $additionalColumn . '`';
            if ($aggregation !== false) {
                $additionalColumnsAggregatedString .= ', ' . $aggregation . '(`' . $additionalColumn . '`) AS `' . $additionalColumn . '`';
            } else {
                $additionalColumnsAggregatedString .= ', `' . $additionalColumn . '`';
            }

        }

        // initialize the counters
        if ($this->partitionColumn !== false) {
            $initCounter = '';
            foreach ($this->partitionColumnValues as $value) {
                $initCounter .= '( SELECT @counter' . intval($value) . ':=0 ) initCounter' . intval($value) . ', ';
            }
        } else {
            $initCounter = '( SELECT @counter:=0 ) initCounter,';
        }

        // add a counter to the query
        // we rely on the sorting of the inner query
        $withCounter = "
			SELECT
				$labelColumnsString,
				$counterExpression AS counter
				$additionalColumnsString
			FROM
				$initCounter
				( $innerQuery ) actualQuery
		";

        // group by the counter - this groups "Others" because the counter stops at $limit
        $groupBy = 'counter';
        if ($this->partitionColumn !== false) {
            $groupBy .= ', `' . $this->partitionColumn . '`';
        }
        $groupOthers = "
			SELECT
				$labelColumnsOthersSwitch
				$additionalColumnsAggregatedString
			FROM ( $withCounter ) AS withCounter
			GROUP BY $groupBy
		";
        return $groupOthers;
    }

    private function getCounterExpression($limit)
    {
        $whens = array();

        if ($this->columnToMarkExcludedRows !== false) {
            // when a row has been specified that marks which records should be excluded
            // from limiting, we don't give those rows the normal counter but -1 times the
            // value they had before. this way, they have a separate number space (i.e. negative
            // integers).
            $whens[] = "WHEN {$this->columnToMarkExcludedRows} != 0 THEN -1 * {$this->columnToMarkExcludedRows}";
        }

        if ($this->partitionColumn !== false) {
            // partition: one counter per possible value
            foreach ($this->partitionColumnValues as $value) {
                $isValue = '`' . $this->partitionColumn . '` = ' . intval($value);
                $counter = '@counter' . intval($value);
                $whens[] = "WHEN $isValue AND $counter = $limit THEN $limit";
                $whens[] = "WHEN $isValue THEN $counter:=$counter+1";
            }
            $whens[] = "ELSE 0";
        } else {
            // no partitioning: add a single counter
            $whens[] = "WHEN @counter = $limit THEN $limit";
            $whens[] = "ELSE @counter:=@counter+1";
        }

        return "
			CASE
				" . implode("
				", $whens) . "
			END
		";
    }

}
