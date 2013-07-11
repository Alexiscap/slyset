<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class melo_concerts extends CI_Controller {

    var $data;

    public function __construct() {
        parent::__construct();

        $this->layout->ajouter_css('slyset');
        $this->layout->ajouter_js('concert');
        $this->layout->ajouter_js('maps_api');
       // $this->layout->ajouter_js('maps-google');
        $this->layout->set_id_background('concert_melo');

        $this->load->model(array('user_model', 'concert','melo_concert'));
        $this->load->helper('date');

//        $this->user_authentication->musicien_user_validation();

        $this->user_id = (is_numeric($this->uri->segment(2))) ? $this->uri->segment(2) : $this->uri->segment(3);

        $sub_data = array();
        $sub_data['profile'] = $this->user_model->getUser($this->user_id);
        if($this->user_id!=null)
    	{
    		$sub_data['photo_right'] = $this->user_model->last_photo($this->user_id);
		}
        $this->data = array(
            'sidebar_left' => $this->load->view('sidebars/sidebar_left', '', TRUE),
            'sidebar_right' => $this->load->view('sidebars/sidebar_right', $sub_data, TRUE)
        );
    }

    public function index($user_id) {
        $uid = $this->session->userdata('uid');
        $infos_profile = $this->user_model->getUser($user_id);

        if ($user_id == $uid) {
            $this->page_main($infos_profile, "melo_concerts", ">");
        } else {
            show_404();
        }
    }

    public function concert_passe($user_id) {
        $uid = $this->session->userdata('uid');
        $infos_profile = $this->user_model->getUser($user_id);
        
        if ($user_id == $uid) {
            $this->page_main($infos_profile, "melo_concert_passe", "<");
        } else {
            show_404();
        }
    }

    public function page_main($infos_profile, $moment, $inf_sup) {
        $data = $this->data;
        $uid = $this->session->userdata('uid');

        $user_visited = (empty($infos_profile)) ? $this->session->userdata('uid') : $infos_profile->id;
        if (!empty($infos_profile)) {
            $data['infos_profile'] = $infos_profile;
        }

//        $data['user_id'] = $user_id;
//        $data['info_user'] = $this->concert->get_user($user_id);

        $data['nbr_concert_par_melo'] = $this->concert->count_artiste_concert($user_visited, $inf_sup);
        $data['concert_all'] = $this->melo_concert->get_concert($data['nbr_concert_par_melo'], 0, $user_visited, $inf_sup);
        function get_date($date_concert, $test) {
            //gestion des differents formats d'affichage des dates
            $date_format = (date_create($date_concert, timezone_open('Europe/Paris')));
            $data['date_2'] = date_format($date_format, "N-j-n-Y-G-i");
            $nom_jour_fr = array("", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche",);
            $mois_fr = array("", "janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "Decembre");
            $mois_fr_trois = array("", "JAN", "FEV", "MAR", "AVR", "MAI", "JUIN", "JUIL", "AOUT", "SEPT", "OCT", "NOV", "DEC");
            list($nom_jour, $jour_chiffre, $mois_text, $annee, $heure, $minutes) = explode('-', $data['date_2']);
            $date['complete'] = $nom_jour_fr[$nom_jour] . ' ' . $jour_chiffre . ' ' . $mois_fr[$mois_text] . ' ' . $annee . ' - ' . $heure . 'h' . $minutes;
            $date['mois_trois'] = $mois_fr_trois[$mois_text];
            $date['jour_texte'] = $jour_chiffre;

            echo $date[$test];
        }

        $data['activity'] = $this->concert->get_activity($user_visited);
        $data['all_concert_act'] = "";
        foreach ($data['activity'] as $data['activite']) {
            $data['all_concert_act'] .=
                    $data['activite']->Concerts_id . "/";
        }


        $this->layout->view('concert/' . $moment, $data);
    }

}