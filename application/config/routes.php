<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'home';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "home" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";
$route['404_override'] = '';

$route['home'] = "home/index";
$route['home/(:num)'] = "home/index/$1";
//$route['admin/(:num)'] = "admin/index/$1";

$route['concert'] = "mc_concerts/index";
$route['concert/(:num)'] = "mc_concerts/index/$1";

$route['actualite'] = "mc_actus/index";
$route['actualite/(:num)'] = "mc_actus/index/$1";
//$route['actualite/(:num)'] = "mc_actus/form_wall_musicien_message/$1";

$route['media'] = "mc_photos/index";
$route['media/(:num)'] = "mc_photos/index/$1";

$route['musique'] = "mc_musique/index";
$route['musique/(:num)'] = "mc_musique/index/$1";

$route['reglages'] = "mc_reglages/index";
$route['reglages/(:num)'] = "mc_reglages/index/$1";
$route['reglages/update_user/(:num)'] = "mc_reglages/update_user/$1";

$route['personnaliser'] = "mc_perso/index";
$route['personnaliser/(:num)'] = "mc_perso/index/$1";
$route['personnaliser/update/(:num)'] = "mc_perso/update_perso/$1";
$route['personnaliser/delete/(:num)'] = "mc_perso/delete_perso/$1";
$route['personnaliser/theme-1/(:num)'] = "mc_perso/theme1/$1";

$route['follower'] = "mc_followers/index";
$route['follower/(:num)'] = "mc_followers/index/$1";

$route['my-reglages'] = "melo_reglages/index";
$route['my-reglages/(:num)'] = "melo_reglages/index/$1";
$route['my-reglages/update_user/(:num)'] = "melo_reglages/update_user/$1";

$route['my-concert'] = "/melo_concerts/index";
$route['my-concert/(:num)'] = "/melo_concerts/index/$1";
$route['my-concert-passe/(:num)'] = "/melo_concerts/concert_passe/$1";

$route['my-follower'] = "/melo_abonnements/index";
$route['my-follower/(:num)'] = "/melo_abonnements/index/$1";

$route['document'] = "/mc_partitions/index";
$route['document/(:num)'] = "/mc_partitions/index/$1";

$route['my-wall'] = "/melo_actu/index";
$route['my-wall/(:num)'] = "/melo_wall/index/$1";

$route['mc_concerts'] = "home"; 
$route['mc_concerts/ajouter_concert'] = "welcome"; 
$route['mc_concerts'] = "mc_concerts/index";
$route['mc_concerts/(:num)'] = "mc_concerts/index/$1";


$route['my-shopping/(:num)'] = "melo_achats/index/$1";
$route['my-shopping-recap/(:num)'] = "melo_achats/index/$1";



/* End of file routes.php */
/* Location: ./application/config/routes.php */