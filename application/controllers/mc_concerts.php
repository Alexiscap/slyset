<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mc_concerts extends CI_Controller {

    var $data;

    public function __construct() {
        parent::__construct();

        $this->layout->ajouter_css('slyset');
        $this->layout->ajouter_css('colorbox');

        $this->layout->ajouter_js('concert');
        $this->layout->ajouter_js('social_media');
        $this->layout->ajouter_js('maps_api');
        // $this->layout->ajouter_js('maps-google');
        $this->layout->ajouter_js('jquery.colorbox');

        $this->load->model(array('perso_model', 'user_model', 'concert_model'));

        $this->load->helper('form');
        
        $this->user_id = (is_numeric($this->uri->segment(2))) ? $this->uri->segment(2) : $this->uri->segment(3);
        $output = $this->perso_model->get_perso($this->user_id);

        $sub_data = array();
        $sub_data['profile'] = $this->user_model->getUser($this->user_id);
        $sub_data['perso'] = $output;
        
        if ($this->user_id != null) {
            $sub_data['photo_right'] = $this->user_model->last_photo($this->user_id);
        } 
        $community_follower = $this->user_model->get_community($this->session->userdata('uid'));
        $my_abonnement_head = "";

        foreach ($community_follower as $my_following_head) {
            $my_abonnement_head .= $my_following_head->Utilisateur_id . '/';
        }

        if (!empty($output)) {
            $this->layout->ajouter_dynamique_css($output->theme_css);
            write_css($output);
        }

        $this->data = array(
            'sidebar_left' => $this->load->view('sidebars/sidebar_left', '', TRUE),
            'sidebar_right' => $this->load->view('sidebars/sidebar_right', $sub_data, TRUE),
            'community_follower' => $my_abonnement_head
        );
    }
    
    public function index($user_id) {
        $uid = $this->session->userdata('uid');
        $infos_profile = $this->user_model->getUser($user_id);
        $this->layout->set_id_background('concert_mu');

        if ((($user_id != $uid && !empty($user_id)) || ($user_id == $uid && !empty($user_id))) && $infos_profile->type != 1) {
            $this->page_main($infos_profile, "mc_concerts", ">");
        } else {
            redirect('home/' . $uid, 'refresh');
        }
    }

    public function concert_passe($user_id) {
        $uid = $this->session->userdata('uid');
        $infos_profile = $this->user_model->getUser($user_id);
        $this->layout->set_id_background('concert_mu');

        if ((($user_id != $uid && !empty($user_id)) || ($user_id == $uid && !empty($user_id))) && $infos_profile->type != 1) {
            $this->page_main($infos_profile, "mc_concert_passe", "<");
        } else {
            redirect('home/' . $uid, 'refresh');
        }
    }

    public function page_main($infos_profile = NULL, $moment, $inf_sup) {
        $data = $this->data;
        $uid = $this->session->userdata('uid');
        $this->load->helper('date');

//    $user_id = $user_id->id; //Ajout de cette ligne par Alexis car bug, $user_id ne correspondait plus à un entier mais à un stdclass, toutes les requêtes étaient foirées
//    
//    $data['user_id'] = $user_id;
//    $data['info_user'] = $this->concert_model->get_user($user_id);
//    if ($data['info_user'] == null) {
//      //pour le moment si utilisateur inexistant : 404;
//      show_404();
//    }

        $user_visited = (empty($infos_profile)) ? $this->session->userdata('uid') : $infos_profile->id;

        if (!empty($infos_profile)) {
            $data['infos_profile'] = $infos_profile;
        }

        $data['nbr_concert_par_artiste'] = $this->concert_model->count_artiste_concert($user_visited, $inf_sup);
        $data['concert_all'] = $this->concert_model->get_concert($data['nbr_concert_par_artiste'], 0, $user_visited, $inf_sup);

        function get_date($date_concert, $test) {
            //gestion des differents formats d'affichage des dates
            $date_format = (date_create($date_concert, timezone_open('Europe/Paris')));
            $data['date_2'] = date_format($date_format, "N-j-n-Y-G-i");
            $nom_jour_fr = array("", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche",);
            $mois_fr = array("", "janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "Decembre");
            $mois_fr_trois = array("", "JAN", "FEV", "MAR", "AVR", "MAI", "JUIN", "JUIL", "AOU", "SEP", "OCT", "NOV", "DEC");
            list($nom_jour, $jour_chiffre, $mois_text, $annee, $heure, $minutes) = explode('-', $data['date_2']);
            $date['complete'] = $nom_jour_fr[$nom_jour] . ' ' . $jour_chiffre . ' ' . $mois_fr[$mois_text] . ' ' . $annee . ' - ' . $heure . 'h' . $minutes;
            $date['mois_trois'] = $mois_fr_trois[$mois_text];
            $date['jour_texte'] = $jour_chiffre;
            echo $date[$test];
        }

        $data['activity'] = $this->concert_model->get_activity($uid);
        $data['all_concert_act'] = "";
        
        foreach ($data['activity'] as $data['activite']) {
            $data['all_concert_act'] .= "/" . $data['activite']->Concerts_id . "/";
        }

        $this->layout->view('concert/' . $moment, $data);
    }

    public function add_activity_concert() {
        $uid = $this->session->userdata('uid');
        $id_concert = $this->input->post('id_concert');
        $this->concert_model->add_activity($id_concert, $uid);
    }

    public function delete_activity_concert() {
        $uid = $this->session->userdata('uid');
        
//        $id_concert = $this->input->post('id_concert');
//        echo $id_concert;
        
        $this->concert_model->delete_activity($id_concert, $uid);
    }

}