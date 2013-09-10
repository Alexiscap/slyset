Piwik comes with unit tests, integration tests, Javascript tests and Webtests.
This document briefly describes how to use and modify Piwik tests. 
 
## How To Run Piwik Tests

To run tests, you must use the Git master. Tests files are not in the Piwik zip archive.
You can get the latest Git revision at: http://github.com/piwik/piwik

```
$ git clone https://github.com/piwik/piwik.git
```

To execute the tests:

 * In your php.ini make sure you have the setting to show all errors:
 `error_reporting = E_ALL | E_STRICT`

 * Go to tests/index.php to see the tests homepage and run the Integration tests via a visual UI, or run JS Tests

## Integration Tests

Integration tests files are in `tests/PHPUnit/Integration/*Test.php`

Integration tests allow to test how major Piwik components interact together.
A test will typically generate hits to the Tracker (record visits and page views)
and then test all API responses and for each API output. It then checks that they match expected XML (or CSV, json, etc.).
If a test fails, you can compare the processed/ and expected/ directories in a graphical 
text compare tool, such as WinMerge on Win, or MELD on Linux, to easily view changes between files.

For example using Meld, click on "Start new comparison", "Directory comparison",
in "Original" select "path/to/piwik/tests/PHPUnit/Integration/expected"
in "Mine" select "path/to/piwik/tests/PHPUnit/Integration/processed"

If changes are expected due to the code changes you make, simply copy the file from processed/ to 
expected/, and test will then pass. Copying files is done easily using Meld (ALT+LEFT).
Otherwise, if you didn't expect to modify the API outputs, it might be that your changes are breaking some features unexpectedly.

## PHPUnit Tests

1. 	Install PHPUnit on your system
	
		$ cd your/php/directory
		$ sudo pear upgrade PEAR
		$ pear config-set auto_discover 1
		$ sudo pear install --alldeps pear.phpunit.de/PHPUnit

	Doc at: http://www.phpunit.de/manual/current/en/installation.html

2. 	Configure PHPUnit: Copy the file `piwik/tests/PHPUnit/phpunit.xml.dist` to `phpunit.xml`.
	In this file, you will find the following lines.
	Please edit HTTP_HOST and REQUEST_URI to match the hostname and path of the Piwik files.
    For example if your Piwik is available at http://localhost/path/to/piwik/ you would write:

		<server name="HTTP_HOST" value="localhost"/>
		<server name="REQUEST_URI" value="/path/to/piwik/"/>


3. 	Run the tests (see the next section to run tests in the browser)

		$ cd /path/to/piwik/tests/PHPUnit
		$ phpunit

	This will run all unit + integration tests. It might take 10-20 minutes to run.

	You can also run tests of specified "parts" of Piwik.
	There are three main groups of tests: Core, Plugins and Integration
	For example run `phpunit --group Core`
	to run all Core Piwik tests. You may also combine groups like
	`phpunit --group Core,Plugins`

4.	Write more tests :)
	See ["Writing Unit tests with PHPUnit"](http://www.phpunit.de/manual/current/en/writing-tests-for-phpunit.html)

## JavaScript Tests

piwik.js is unit tested and you can run tests via piwik/tests/javascript/

## Testing Data

You can import data over several days in Piwik:

1. 	Install Piwik
2. 	Create a site with URL http://piwik.org/
3. 	Create a Goal eg. URL Contains "blog"
4. 	Import data from an anonimized test log file in piwik/tests/resources/ directory. Run the following command:

		$ python /home/piwik/misc/log-analytics/import_logs.py --url=http://localhost/path/ /path/to/piwik/tests/resources/access.log-dev-anon-9-days-nov-2012.log.bz2 --idsite=1 --enable-http-errors --enable-http-redirects --enable-static --enable-bots

	This will import 9 days worth of data from Nov 20th-Nov 29th 2012.

5.	You can then archive the reports with:

	$ php5 /home/piwik/misc/cron/archive.php --url=http://localhost/path/

You should now have some interesting data to test with in November 2012!

## Selenium Webdriver tests

We would like to add Webdriver selenium testing for the following: installation, auto update from 1.0, initial user login.
Task is tracked in: http://dev.piwik.org/trac/ticket/2935

## Scheduled Reports Tests

Piwik scheduled reports (HTML, PDF & SMS) are part of the integration test suite.
They follow the same principles described in the INTEGRATION TESTS section of this document.

Piwik scheduled reports can contain PNG graphs when the user specifies it.
Depending on the system under test, generated images differ slightly.

Including all variations in the expected files would not be convenient. Developers would need to run the tests under
several environments before being able to commit their work.
Excluding images altogether is not an option as they are an important feature.

Therefore, PNG graphs are only tested if the system under test has the same characteristics as the integration server.
The characteristics of the integration server are described in `IntegrationTestCase::canImagesBeIncludedInScheduledReports()`

If your system does not comply to those characteristics, images will not be tested and PHPUnit will display the
warning message contained in `IntegrationTestCase::alertWhenImagesExcludedFromTests()`.

In this case, the integration test suite might pass on your box but fail on the integration server. This means your
work altered the expected images. The standard procedure described in the INTEGRATION TESTS section needs to be applied :

 1. find out if the change is expected (*)
 2. a. if the change is expected, the expected files need to be updated (*)

    b. if the change is not expected, there is a bug needing to be fixed


(*) to analyse and/or generate the expected files, you can either

 - set up the vagrant piwik vm (which is used by the integration server) or
 - retrieve the files from the integration server.

## Continuous Integration

We run a Jenkins server for continuous integration. It automatically downloads the latest version of the Piwik code
from our GIT repo and runs a battery of thousands of tests. More information at the links:

 * Official Piwik Jenkins Server: http://qa.piwik.org:8080/
 * QA in Piwik: http://piwik.org/qa/

## VisualPHPUnit

Piwik comes with a modified copy of VisualPHPUnit (see https://github.com/NSinopoli/VisualPHPUnit)
which you can use to run PHPUnit tests in your browser.

### Starting VisualPHPUnit

To load VisualPHPUnit point your browser to http://path/to/piwik/tests/lib/visualphpunit/.

VisualPHPUnit will already be configured for use with Piwik. 

Troubleshooting

 * If at this URL you see a listing of files instead of seeing VisualPHPUnit, 
   enable mod_rewrite apache module, and make sure your vhost in apache 
   configuration has "AllowOverride all" so that .htaccess are loaded.
 
 * If you get an error such as "Warning: require_once(PHPUnit/Autoload.php)" it is because the PEAR path 
   is not set in your php.ini. Edit in php.ini the value include_path to include the path to your
   PEAR setup, and restart Apache.

### Running tests

Once VisualPHPUnit is loaded, you can run tests by selecting files or whole directories in the
file selector on the left of the screen, then clicking the 'Run tests' button. To select
files/directories ctrl+click them.

To run all Piwik tests, ctrl+click the 'Core', 'Integration' and 'Plugins' directory, then
click the 'Run tests' button.

### Running tests by URL

If you're in need of a URL that will not only load VisualPHPUnit but run one or more tests,
you may add the list of tests to run as the hash of the URL. For example,

http://path/to/piwik/tests/lib/visualphpunit/#/Core/DataTableTest.php:/Core/CookieTest.php

will load VisualPHPUnit and immediately run the tests in DataTableTest.php and CookieTest.php.
Currently, this feature will not allow you to specify directories with tests to run.

### Using phpunit.xml

By default, VisualPHPUnit lets you run tests by selecting individual test files or directories
and clicking the 'Run Tests' button. If you want to use a phpunit.xml file, either your own or the
one that comes with Piwik, you'll need to modify VisualPHPUnit's configuration. Edit the file
located at

/path/to/piwik/tests/lib/visualphpunit/app/config/bootstrap.php

and set the 'xml_configuration_file' config option.

Please note that when a phpunit.xml file is supplied in the configuration, VisualPHPUnit will
always run tests with it, regardless of what files you select. You can override this behavior
in the web UI by selecting 'No' in the 'Use XML Config' input.

### Debugging invalid responses

Sometimes, VisualPHPUnit will run PHPUnit tests and get a response it can't read. These problems
are usually caused by an unmatched ob_start() call in the code somewhere, or by the program
prematurely exiting.

To find the cause of such issues, it can help to determine what code can & can't affect the
output VisualPHPUnit sees. Code that can affect what VisualPHPUnit sees is before the bug in
question, and code that can't is after it.

## Benchmarks

See tests/PHPUnit/Benchmarks/README.txt

## Profiling with XHProf

Piwik is distributed with a copy of XHProf, the PHP profiler created by Facebook. Piwik
also comes with a copy of VisualPHPUnit that has been modified to easily use XHProf. Using
these two tools, you can profile tests and benchmarks.

### Installing XHProf

First, XHProf must be built (this guide assumes you're using a linux variant):

 * 	Navigate to the XHProf extension directory.

		$ cd /path/to/piwik/tests/lib/xhprof-0.9.2/extension
    
 * 	Build XHProf.

		$ phpize
		$ ./configure
		$ make
    
	xhprof.so will now exist in the ./modules directory.
    
 *	Configure PHP to use XHProf. Add the following to your php.ini file:
      
	```
	[xhprof]
	extension=/path/to/piwik/tests/lib/xhprof-0.9.2/extension/modules/xhprof.so
	xhprof.output_dir=/path/to/output/dir
	```
      
	Replace /path/to/output/dir with an existing directory. All your profiles will be
	stored there.

Restart your webserver and you're done. VisualPHPUnit will automatically detect if XHProf
is installed and act accordingly.

### Using XHProf

To use XHProf, first load VisualPHPUnit by pointing your browser to:

http://path/to/piwik/tests/lib/visualphpunit/

Select a test or get ready to run a benchmark. Make sure the 'Profile with XHProf' select
box is set to 'Yes' and click 'Run Tests'.

When the test finishes, a link will be displayed that will let you view the profile that
was created.

NOTE:

    * Currently, it is not possible to use XHProf with more than one test, so if multiple
      tests are selected, XHProf will not be used.
    * XHProf will not delete old profiles, you must do that yourself, though individual
      profiles do not take much space.

## Participate

You can help by improving existing tests, or identify some missing tests and implement them.
See http://piwik.org/participate/development-process
Please contact us at hello@piwik.org

