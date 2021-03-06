<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

$active_group = 'prod';
$active_record = TRUE;

$db['preprod']['hostname'] = 'localhost';
$db['preprod']['username'] = 'slyset';
$db['preprod']['password'] = 'slyset';
$db['preprod']['database'] = 'preprod-slyset';
$db['preprod']['dbdriver'] = 'mysql';
$db['preprod']['dbprefix'] = '';
$db['preprod']['pconnect'] = TRUE;
$db['preprod']['db_debug'] = TRUE;
$db['preprod']['cache_on'] = FALSE;
$db['preprod']['cachedir'] = '';
$db['preprod']['char_set'] = 'utf8';
$db['preprod']['dbcollat'] = 'utf8_general_ci';
$db['preprod']['swap_pre'] = '';
$db['preprod']['autoinit'] = TRUE;
$db['preprod']['stricton'] = FALSE;


$db['prod']['hostname'] = 'localhost';
$db['prod']['username'] = 'slyset';
$db['prod']['password'] = 'slyset';
$db['prod']['database'] = 'prod-slyset';
$db['prod']['dbdriver'] = 'mysql';
$db['prod']['dbprefix'] = '';
$db['prod']['pconnect'] = TRUE;
$db['prod']['db_debug'] = TRUE;
$db['prod']['cache_on'] = FALSE;
$db['prod']['cachedir'] = '';
$db['prod']['char_set'] = 'utf8';
$db['prod']['dbcollat'] = 'utf8_general_ci';
$db['prod']['swap_pre'] = '';
$db['prod']['autoinit'] = TRUE;
$db['prod']['stricton'] = FALSE;


$db['heroku']['hostname'] = 'us-cdbr-east-04.cleardb.com';
$db['heroku']['username'] = 'b503c54ae6cadb';
$db['heroku']['password'] = 'b35f224d';
$db['heroku']['database'] = 'heroku_23b8b27bc5d4a40';
$db['heroku']['dbdriver'] = 'mysql';
$db['heroku']['dbprefix'] = '';
$db['heroku']['pconnect'] = TRUE;
$db['heroku']['db_debug'] = TRUE;
$db['heroku']['cache_on'] = FALSE;
$db['heroku']['cachedir'] = '';
$db['heroku']['char_set'] = 'utf8';
$db['heroku']['dbcollat'] = 'utf8_general_ci';
$db['heroku']['swap_pre'] = '';
$db['heroku']['autoinit'] = TRUE;
$db['heroku']['stricton'] = FALSE;

/* End of file database.php */
/* Location: ./application/config/database.php */