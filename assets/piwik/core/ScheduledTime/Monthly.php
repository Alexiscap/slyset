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
 * Piwik_ScheduledTime_Monthly class is used to schedule tasks every month.
 *
 * @see Piwik_ScheduledTask
 * @package Piwik
 * @subpackage Piwik_ScheduledTime
 */
class Piwik_ScheduledTime_Monthly extends Piwik_ScheduledTime
{
    /**
     * Day of the week for scheduled time.
     *
     * @var int
     */
    private $dayOfWeek = null;

    /**
     * Week number for scheduled time.
     *
     * @var int
     */
    private $week = null;

    /**
     * @return int
     */
    public function getRescheduledTime()
    {
        $currentTime = $this->getTime();

        // Adds one month
        $rescheduledTime = mktime(date('H', $currentTime),
            date('i', $currentTime),
            date('s', $currentTime),
            date('n', $currentTime) + 1,
            1,
            date('Y', $currentTime)
        );

        $nextMonthLength = date('t', $rescheduledTime);

        // Sets scheduled day
        $scheduledDay = date('j', $currentTime);

        if ($this->day !== null) {
            $scheduledDay = $this->day;
        }

        if ($this->dayOfWeek !== null
            && $this->week !== null
        ) {
            $newTime = $rescheduledTime + $this->week * 7 * 86400;
            while (date("w", $newTime) != $this->dayOfWeek % 7) // modulus for sanity check
            {
                $newTime += 86400;
            }
            $scheduledDay = ($newTime - $rescheduledTime) / 86400 + 1;
        }

        // Caps scheduled day
        if ($scheduledDay > $nextMonthLength) {
            $scheduledDay = $nextMonthLength;
        }

        // Adjusts the scheduled day
        $rescheduledTime += ($scheduledDay - 1) * 86400;

        // Adjusts the scheduled hour
        $rescheduledTime = $this->adjustHour($rescheduledTime);

        return $rescheduledTime;
    }

    /**
     * @param int $_day the day to set, has to be >= 1 and < 32
     * @throws Exception if parameter _day is invalid
     */
    public function setDay($_day)
    {
        if (!($_day >= 1 && $_day < 32)) {
            throw new Exception ("Invalid day parameter, must be >=1 and < 32");
        }

        $this->day = $_day;
    }

    /**
     * Makes this scheduled time execute on a particular day of the week on each month.
     *
     * @param int $_day the day of the week to use, between 0-6 (inclusive). 0 -> Sunday
     * @param int $_week the week to use, between 0-3 (inclusive)
     * @throws Exception if either parameter is invalid
     */
    public function setDayOfWeek($_day, $_week)
    {
        if (!($_day >= 0 && $_day < 7)) {
            throw new Exception("Invalid day of week parameter, must be >= 0 & < 7");
        }

        if (!($_week >= 0 && $_week < 4)) {
            throw new Exception("Invalid week number, must be >= 1 & < 4");
        }

        $this->dayOfWeek = $_day;
        $this->week = $_week;
    }
}
