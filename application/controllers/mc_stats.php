<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mc_stats extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->layout->ajouter_css('slyset');
        $this->layout->ajouter_js('Chart');
        $this->load->model(array('perso_model', 'user_model'));

        $this->layout->set_id_background('stats');

        $this->user_id = (is_numeric($this->uri->segment(2))) ? $this->uri->segment(2) : $this->uri->segment(3);
        $output = $this->perso_model->get_perso($this->user_id);

        $sub_data = array();
        $sub_data['profile'] = $this->user_model->getUser($this->user_id);
        $sub_data['perso'] = $output;
        
        if ($this->user_id != null) {
            $sub_data['photo_right'] = $this->user_model->last_photo($this->user_id);
            $sub_data['morceau_right'] = $this->user_model->top_five_morceau_profil($this->user_id);
            $sub_data['morceau_right_t']['type_page'] = 1;

        }
        
        if (!empty($output)) {
            $this->layout->ajouter_dynamique_css($output->theme_css);
            write_css($output);
        }
        //--bouton suivre un musicien
        $community_follower = $this->user_model->get_community($this->session->userdata('uid'));
        $my_abonnement_head = "";


        foreach ($community_follower as $my_following_head) {
            $my_abonnement_head .= $my_following_head->Utilisateur_id . '/';
        }
        $this->data = array(
            'sidebar_left' => $this->load->view('sidebars/sidebar_left', '', TRUE),
            'sidebar_right' => $this->load->view('sidebars/sidebar_right', $sub_data, TRUE)
        );
    }

    public function index($user_id) {
        $uid = $this->session->userdata('uid');
        $type_account = $this->session->userdata('account');

        if (($user_id == $uid) && $type_account != 1) {
            $this->page($user_id);
        } elseif (isset($uid)) {
            redirect('home/' . $uid, 'refresh');
        } else {
            redirect('home', 'refresh');
        }
    }

    public function page() {
        $data = $this->data;
        $data['profile'] = $this->user_model->getUser($this->user_id);

        // GOOGLE ANALYTICS APPEL A L4'API

        session_start();
        require_once 'assets/GoogleClientApi/src/Google_Client.php';
        require_once 'assets/GoogleClientApi/src/contrib/Google_AnalyticsService.php';

        //$scriptUri = $this->layout->view('statistique/mc_stats', $data);


        $client = new Google_Client();
        $client->setAccessType('offline'); // default: offline
        $client->setApplicationName('My Application name');
        $client->setClientId('359711119127-10vh4o4i102le2jtp64qfcjdum7mkf91.apps.googleusercontent.com');
        $client->setClientSecret('EC7OnFYBjxMLQXepSYpTm6lh');
        //$client->setRedirectUri($scriptUri);
        $client->setDeveloperKey('AIzaSyCcssc_1iHiNjx3tub8qJ3L3WmpCn-ea5Y'); // API key

        // $service implements the client interface, has to be set before auth call
        $service = new Google_AnalyticsService($client);

        if (isset($_GET['logout'])) { // logout: destroy token
            unset($_SESSION['token']);
            die('Logged out.');
        }

        if (isset($_GET['code'])) { // we received the positive auth callback, get the token and store it in session
            $client->authenticate();
            $_SESSION['token'] = $client->getAccessToken();
        }

        if (isset($_SESSION['token'])) { // extract token from session and configure client
            $token = $_SESSION['token'];
            $client->setAccessToken($token);
        }

        if (!$client->getAccessToken()) { // auth call to google
            $authUrl = $client->createAuthUrl();
            header("Location: ".$authUrl);
            die;
        }
    
        $projectId = '76438199';

        //from 30 pour le graph
        //depuis la date d'inscription pour les autres données
        $from_30 = date('Y-m-d', time()-30*24*60*60); // 30 days
        $from_begining = date('Y-m-d', time()-30*24*60*60); // 30 days
        $to = date('Y-m-d'); // today


        //pour viste et page vu : ajouter le path2 et ne prendre que les page musicien

        //total visite pour un utilisateur
        
        $metrics_visit = 'ga:visits';
        $dimensions_visit = 'ga:pagePathLevel3';
        //ga:pagePathLevel3==/3')) : 3 est l'id de l'utilisateur
        $visit_tot = $service->data_ga->get('ga:'.$projectId, $from_begining, $to, $metrics_visit, array('dimensions' => $dimensions_visit,'filters'=>'ga:pagePathLevel3==/3'));
        $data['visit_tot'] = $visit_tot['rows'];
       
        //page vue sur l'utilisateur

        $metrics_page = 'ga:pageviews';
        $dimensions_page = 'ga:pagePathLevel3';
        //ga:pagePathLevel3==/3')) : 3 est l'id de l'utilisateur
        $pages = $service->data_ga->get('ga:'.$projectId, $from_begining, $to, $metrics_page, array('dimensions' => $dimensions_page,'filters'=>'ga:pagePathLevel3==/3'));
        $data['pages_tot'] = $visit_tot['rows'];

        // source du traffic par utilisar

        $metrics_sources = 'ga:visits';
        $dimensions_sources = 'ga:source';
        //ga:pagePathLevel3==/3')) : 3 est l'id de l'utilisateur
        $sources = $service->data_ga->get('ga:'.$projectId, $from_begining, $to, $metrics_sources, array('dimensions' => $dimensions_sources,'filters'=>'ga:pagePathLevel3==/3'));
        $data['sources_tot'] = $sources['rows'];
        
        //evolution du trafic (visit et visit unique par jour sur le mois
        $metrics_evol = 'ga:visits,ga:newVisits';
        $dimensions_evol = 'ga:day';
        //ga:pagePathLevel3==/3')) : 3 est l'id de l'utilisateur
        $evol = $service->data_ga->get('ga:'.$projectId, $from_30, $to, $metrics_evol, array('dimensions' => $dimensions_evol,'filters'=>'ga:pagePathLevel3==/3'));
        $data['evol'] = $evol['rows'];

        //var_dump($data['rows']);

        $this->layout->view('statistique/mc_stats', $data);
    }

}