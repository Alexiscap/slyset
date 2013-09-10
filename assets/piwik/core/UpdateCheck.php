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
 * Class to check if a newer version of Piwik is available
 *
 * @package Piwik
 */
class Piwik_UpdateCheck
{
    const CHECK_INTERVAL = 28800; // every 8 hours
    const UI_CLICK_CHECK_INTERVAL = 10; // every 10s when user clicks UI link
    const LAST_TIME_CHECKED = 'UpdateCheck_LastTimeChecked';
    const LATEST_VERSION = 'UpdateCheck_LatestVersion';
    const SOCKET_TIMEOUT = 2;

    /**
     * Check for a newer version
     *
     * @param bool $force     Force check
     * @param int  $interval  Interval used for update checks
     */
    public static function check($force = false, $interval = null)
    {
        if ($interval === null) {
            $interval = self::CHECK_INTERVAL;
        }

        $lastTimeChecked = Piwik_GetOption(self::LAST_TIME_CHECKED);
        if ($force
            || $lastTimeChecked === false
            || time() - $interval > $lastTimeChecked
        ) {
            // set the time checked first, so that parallel Piwik requests don't all trigger the http requests
            Piwik_SetOption(self::LAST_TIME_CHECKED, time(), $autoload = 1);
            $parameters = array(
                'piwik_version' => Piwik_Version::VERSION,
                'php_version'   => PHP_VERSION,
                'url'           => Piwik_Url::getCurrentUrlWithoutQueryString(),
                'trigger'       => Piwik_Common::getRequestVar('module', '', 'string'),
                'timezone'      => Piwik_SitesManager_API::getInstance()->getDefaultTimezone(),
            );

            $url = Piwik_Config::getInstance()->General['api_service_url']
                . '/1.0/getLatestVersion/'
                . '?' . http_build_query($parameters, '', '&');
            $timeout = self::SOCKET_TIMEOUT;

            if (@Piwik_Config::getInstance()->Debug['allow_upgrades_to_beta']) {
                $url = 'http://builds.piwik.org/LATEST_BETA';
            }

            try {
                $latestVersion = Piwik_Http::sendHttpRequest($url, $timeout);
                if (!preg_match('~^[0-9][0-9a-zA-Z_.-]*$~D', $latestVersion)) {
                    $latestVersion = '';
                }
            } catch (Exception $e) {
                // e.g., disable_functions = fsockopen; allow_url_open = Off
                $latestVersion = '';
            }
            Piwik_SetOption(self::LATEST_VERSION, $latestVersion);
        }
    }

    /**
     * Returns version number of a newer Piwik release.
     *
     * @return string|false  false if current version is the latest available,
     *                       or the latest version number if a newest release is available
     */
    public static function isNewestVersionAvailable()
    {
        $latestVersion = Piwik_GetOption(self::LATEST_VERSION);
        if (!empty($latestVersion)
            && version_compare(Piwik_Version::VERSION, $latestVersion) == -1
        ) {
            return $latestVersion;
        }
        return false;
    }
}
