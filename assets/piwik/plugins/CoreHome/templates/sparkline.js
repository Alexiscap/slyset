/*!
 * Piwik - Web Analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

function initializeSparklines() {
    var sparklineUrlParamsToIgnore = ['module', 'action', 'idSite', 'period', 'date', 'viewDataTable'];

    $("a[name='evolutionGraph']").each(function () {
        var graph = $(this);

        // try to find sparklines and add them clickable behaviour
        graph.parent().find('div.sparkline').each(function () {
            // find the sparkline and get it's src attribute
            var sparklineUrl = $('img.sparkline', this).attr('src');

            if (sparklineUrl != "") {
                var params = broadcast.getValuesFromUrl(sparklineUrl);
                for (var i = 0; i != sparklineUrlParamsToIgnore.length; ++i) {
                    delete params[sparklineUrlParamsToIgnore[i]];
                }
                for (var key in params) {
                    if (typeof params[key] == 'undefined') {
                        // this happens for example with an empty segment parameter
                        delete params[key];
                    } else {
                        params[key] = decodeURIComponent(params[key]);
                    }
                }

                // on click, reload the graph with the new url
                $(this).click(function () {
                    var idDataTable = graph.attr('graphId'),
                        dataTable = $('#' + idDataTable);

                    // when the metrics picker is used, the id of the data table might be updated (which is correct behavior).
                    // for example, in goal reports it might change from GoalsgetEvolutionGraph to GoalsgetEvolutionGraph1.
                    // if this happens, we can't find the graph using $('#'+idDataTable+"Chart");
                    // instead, we just use the first evolution graph we can find.
                    if (dataTable.length == 0) {
                        dataTable = $('div.dataTableGraphEvolutionWrapper').first().closest('.dataTable');
                    }

                    // reload the datatable w/ a new column & scroll to the graph
                    dataTable.trigger('reload', params);
                });
                $(this).hover(
                    function () {
                        $(this).css({
                            "cursor": "pointer",
                            "border-bottom": "1px dashed #C3C3C3"
                        });
                    },
                    function () {
                        $(this).css({"border-bottom": "1px solid white"});
                    }
                );
            }
        });
    });
}
