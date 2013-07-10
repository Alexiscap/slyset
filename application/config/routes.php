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
$route['404_override'] = 'page_404';
//$route['404_override/(:num)'] = 'page_404/index/$1';

$route['admin'] = "admin/index";
$route['admin/(:num)'] = "admin/index/$1";
$route['admin-article'] = "admin_articles/index";
$route['admin-article/(:num)'] = "admin_articles/index/$1";
$route['admin-artiste'] = "admin_artistes/index";
$route['admin-artiste/(:num)'] = "admin_artistes/index/$1";
$route['admin-melomanes'] = "admin_melomanes/index";
$route['admin-melomanes/(:num)'] = "admin_melomanes/index/$1";
$route['admin-musiciens'] = "admin_musiciens/index";
$route['admin-musiciens/(:num)'] = "admin_musiciens/index/$1";

$route['search'] = "search/search_keyword";
$route['search/(:num)'] = "search/search_keyword/$1";

$route['home'] = "home/index";
$route['home/(:num)'] = "home/index/$1";

$route['concert'] = "mc_concerts/index";
$route['concert/(:num)'] = "mc_concerts/index/$1";
$route['concert/ajouter'] = "mc_concerts/ajouter_concert";
$route['concert/ajouter/(:num)'] = "mc_concerts/ajouter_concert/$1";
$route['concert/archive'] = "mc_concerts/concert_passe";
$route['concert/archive/(:num)'] = "mc_concerts/concert_passe/$1";

$route['actualite'] = "mc_actus/index";
$route['actualite/(:num)'] = "mc_actus/index/$1";
//$route['actualite/(:num)'] = "mc_actus/form_wall_musicien_message/$1";

$route['media'] = "mc_photos/index";
$route['media/(:num)'] = "mc_photos/index/$1";
$route['media/ajouter-photo'] = "mc_photos/upload_photo";
$route['media/ajouter-photo/(:num)'] = "mc_photos/upload_photo/$1";
$route['media/ajouter-video'] = "mc_photos/add_video";
$route['media/ajouter-video/(:num)'] = "mc_photos/add_video/$1";

$route['media/supprimer'] = "mc_photos/suppression_media";
$route['media/supprimer/(:num)'] = "mc_photos/suppression_media/$1";
$route['media/supprimer/(:num)/(:any)/(:num)'] = "mc_photos/suppression_media/$1/$2/$3";
$route['media/editer'] = "mc_photos/update_photo";
$route['media/editer/(:num)/(:any)/(:num)'] = "mc_photos/update_photo/$1/$2/$3";
$route['media/zoom'] = "mc_photos/zoom_photo";
$route['media/zoom/(:num)/(:num)'] = "mc_photos/zoom_photo/$1/$2";
$route['media/album'] = "mc_photos/album";
$route['album/(:num)/(:any)'] = "mc_photos/album/$1/$2";

$route['musique'] = "mc_musique/index";
$route['musique/(:num)'] = "mc_musique/index/$1";

$route['statistique'] = "mc_stats/index";
$route['statistique/(:num)'] = "mc_stats/index/$1";

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
$route['follower/musicien/'] = "mc_followers/musicien";
$route['follower/musicien/(:num)'] = "mc_followers/musicien/$1";
$route['follower/melomane/'] = "mc_followers/melomane";
$route['follower/melomane/(:num)'] = "mc_followers/melomane/$1";

$route['my-reglages'] = "melo_reglages/index";
$route['my-reglages/(:num)'] = "melo_reglages/index/$1";
$route['my-reglages/update_user/(:num)'] = "melo_reglages/update_user/$1";


$route['my-concert'] = "melo_concerts/index";
$route['my-concert/(:num)'] = "melo_concerts/index/$1";
$route['my-concert/archive'] = "melo_concerts/concert_passe";
$route['my-concert/archive/(:num)'] = "melo_concerts/concert_passe/$1";

$route['my-follower'] = "melo_abonnements/index";
$route['my-follower/(:num)'] = "melo_abonnements/index/$1";

$route['document'] = "mc_partitions/index";
$route['document/(:num)'] = "mc_partitions/index/$1";
$route['document/new-lyrics'] = "pi_ajout_paroles/index";
$route['document/new-score'] = "pi_ajout_partitions/index";
$route['document/new-livret'] = "pi_ajout_livret/index";


$route['my-wall'] = "melo_wall/index";
$route['my-wall/(:num)'] = "melo_wall/index/$1";

$route['my-playlists'] = "melo_playlist/index";
$route['my-playlists/(:num)'] = "melo_playlist/index/$1";

$route['my-shopping/(:num)'] = "melo_achats/index/$1";
$route['my-shopping-recap/(:num)'] = "melo_achats/index/$1";

$route['slyset-project'] = "pages_statiques/slyset";
$route['slyset-project/(:num)'] = "pages_statiques/slyset/$1";

$route['fonctionnalites'] = "pages_statiques/fonctionnalites";
$route['fonctionnalites/(:num)'] = "pages_statiques/fonctionnalites/$1";

$route['faq'] = "pages_statiques/faq";
$route['faq/(:num)'] = "pages_statiques/faq/$1";

$route['contact'] = "pages_statiques/contact";
$route['contact/(:num)'] = "pages_statiques/contact/$1";

$route['paiements'] = "pages_statiques/paiements";
$route['paiements/(:num)'] = "pages_statiques/paiements/$1";

$route['conditions-generales'] = "pages_statiques/cgu";
$route['conditions-generales/(:num)'] = "pages_statiques/cgu/$1";

$route['mentions-legales'] = "pages_statiques/mentions_legales";
$route['mentions-legales/(:num)'] = "pages_statiques/mentions_legales/$1";

$route['annonceurs'] = "pages_statiques/annonceurs";
$route['annonceurs/(:num)'] = "pages_statiques/annonceurs/$1";


/* End of file routes.php */
/* Location: ./application/config/routes.php */