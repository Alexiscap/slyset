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

//$route['(:num)'] = "$1";
$route['home/(:num)'] = "home/index/$1";
//$route['admin/(:num)'] = "admin/index/$1";
$route['concert/(:num)'] = "mc_concerts/index/$1";
$route['actualite/(:num)'] = "mc_actus/index/$1";
//$route['actualite/(:num)'] = "mc_actus/form_wall_musicien_message/$1";
$route['media/(:num)'] = "mc_photos/index/$1";
$route['musique/(:num)'] = "mc_musique/index/$1";
<<<<<<< HEAD
$route['follower/(:num)'] = "mc_followers/index/$1";
$route['my-concert/(:num)'] = "/melo_concerts/index/$1";
$route['my-follower/(:num)'] = "/melo_abonnements/index/$1";
$route['document/(:num)'] = "/mc_partitions/index/$1";
$route['my-wall/(:num)'] = "/melo_wall/index/$1";
=======
>>>>>>> 0a5f106366459ee42989c8cd393a8c35e10afe2d
$route['reglages/(:num)'] = "mc_reglages/index/$1";
$route['reglages/update_user/(:num)'] = "mc_reglages/update_user/$1";
$route['personnaliser/(:num)'] = "mc_perso/index/$1";
$route['personnaliser/update/(:num)'] = "mc_perso/update_perso/$1";
$route['personnaliser/delete/(:num)'] = "mc_perso/delete_perso/$1";
$route['personnaliser/theme-1/(:num)'] = "mc_perso/theme1/$1";
<<<<<<< HEAD

=======
>>>>>>> 0a5f106366459ee42989c8cd393a8c35e10afe2d

$route['mc_concerts'] = "home"; 
$route['mc_concerts/ajouter_concert'] = "welcome"; 
$route['mc_concerts/(:num)'] = "mc_concerts/index/$1";
//$route['home/(:num)'] = "home/$1";
//$route['home/(:any)/(:num)'] = "home/$1";
//$route['home/index/(:num)'] = "home/$1";
//$route['mc_concerts/index/(:num)'] = "mc_concerts/$1";


/* End of file routes.php */
/* Location: ./application/config/routes.php */