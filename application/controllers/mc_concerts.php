<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mc_concerts extends CI_Controller {

    var $data;

    public function __construct() {
        parent::__construct();
        $this->output->enable_profiler(true);
//        $this->user_authentication->musicien_user_validation();
        $this->layout->ajouter_css('slyset');
        $this->layout->ajouter_css('colorbox');

        $this->layout->ajouter_js('concert');
        $this->layout->ajouter_js('maps_api');
        $this->layout->ajouter_js('maps-google');
        $this->layout->ajouter_js('jquery.colorbox');
        $this->load->model(array('perso_model', 'user_model', 'concert'));
		$this->load->helper('url');
        $this->user_id = (is_numeric($this->uri->segment(2))) ? $this->uri->segment(2) : $this->uri->segment(3);
        $output = $this->perso_model->get_perso($this->user_id);

        $sub_data = array();
        $sub_data['profile'] = $this->user_model->getUser($this->user_id);
        $sub_data['perso'] = $output;

        if (!empty($output)) {
            $this->layout->ajouter_dynamique_css($output->theme_css);
            write_css($output);
        }

        $this->data = array(
            'sidebar_left' => $this->load->view('sidebars/sidebar_left', '', TRUE),
            'sidebar_right' => $this->load->view('sidebars/sidebar_right', $sub_data, TRUE)
        );
    }

//  public function index($user_id) {
//    $uid = $this->session->userdata('uid');
//
//    if(($user_id != $uid && !empty($user_id)) || ($user_id == $uid && !empty($user_id))) {
//      $user_id = $this->user_infos->uri_user();
//      $infos_profile = $this->user_model->getUser($user_id);
//      $this->page_main($infos_profile, "mc_concerts", ">");
//      
//    } else {
//      redirect('home/' . $uid, 'refresh');
//    }
//  }

    public function index($user_id) {
        $uid = $this->session->userdata('uid');
        $infos_profile = $this->user_model->getUser($user_id);

        if ((($user_id != $uid && !empty($user_id)) || ($user_id == $uid && !empty($user_id))) && $infos_profile->type != 1) {
            $this->page_main($infos_profile, "mc_concerts", ">");
        } else {
            redirect('home/' . $uid, 'refresh');
        }
    }

    public function concert_passe($user_id) {
        $uid = $this->session->userdata('uid');
        $infos_profile = $this->user_model->getUser($user_id);

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
//    $data['info_user'] = $this->concert->get_user($user_id);
//    if ($data['info_user'] == null) {
//      //pour le moment si utilisateur inexistant : 404;
//      show_404();
//    }

        $user_visited = (empty($infos_profile)) ? $this->session->userdata('uid') : $infos_profile->id;

        if (!empty($infos_profile)) {
            $data['infos_profile'] = $infos_profile;
        }

        $data['nbr_concert_par_artiste'] = $this->concert->count_artiste_concert($user_visited, $inf_sup);
        $data['concert_all'] = $this->concert->get_concert($data['nbr_concert_par_artiste'], 0, $user_visited, $inf_sup);

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

        $data['activity'] = $this->concert->get_activity($uid);
        $data['all_concert_act'] = "";
        foreach ($data['activity'] as $data['activite']) {
            $data['all_concert_act'] .= $data['activite']->Concerts_id . "/";
        }

        $this->layout->view('concert/' . $moment, $data);
    }

    public function ajouter_concert($user_id) {
        if ($user_id != $this->session->userdata('uid')) {
            show_404();
        }

        $this->load->helper('form');
        $this->load->library('form_validation');


        $this->form_validation->set_error_delimiters('<div class="error-form">', '</div>');

        $this->form_validation->set_rules('artiste', 'Artiste', 'required');
        $this->form_validation->set_rules('date_concert', 'Date concert', 'required');
        $this->form_validation->set_rules('salle', 'Salle', 'required');
        $this->form_validation->set_rules('ville', 'Ville', 'required');

        //**************** RECUP COORDONNEES GOOGLE ****************
        //**************** RECHERCHERCHE DE LA REFERENCE AVEC VILLE ET SALLE ****************


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('concert/ajouter_concert');
        } else {
            $data['concert_lieu_salle'] = $this->input->post('salle');
            $data['concert_lieu_ville'] = $this->input->post('ville');
            $mot_uniq_glgle = explode(" ", $data['concert_lieu_salle']);

            $array_mot = count($mot_uniq_glgle);
            $data['concert_lieu_salle_plus'] = "";
            for ($i = 0; $i < $array_mot; $i++) {
                $data['concert_lieu_salle_plus'].= $mot_uniq_glgle[$i] . '+';
            }
            //ajouter des + a chaque espace -> sinon aucune recherche google
            if (isset($data['concert_lieu_ville'])) {
                $cpr = curl_init();

                curl_setopt($cpr, CURLOPT_URL, "https://maps.googleapis.com/maps/api/place/textsearch/json?query=" . $data['concert_lieu_salle_plus'] . "+" . $data['concert_lieu_ville'] . "&sensor=true&key=AIzaSyCcssc_1iHiNjx3tub8qJ3L3WmpCn-ea5Y");
                curl_setopt($cpr, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                curl_setopt($cpr, CURLOPT_RETURNTRANSFER, TRUE);

                $data['curl'] = curl_exec($cpr);
                $data['test'] = json_decode($data['curl']);
                //var_dump( $data['test']) ;
                if (isset($data['test']->{'results'}[0])) {
                    $url_detail_place = $data['test']->{'results'}[0]->{"reference"};

                    //*************** AVEC LA REFERENCE : RECUP DES COORDONNEES ****************
                }
                $cpr2 = curl_init();

                if (isset($url_detail_place)) {
                    curl_setopt($cpr2, CURLOPT_URL, "https://maps.googleapis.com/maps/api/place/details/json?reference=" . $url_detail_place . "&sensor=true&key=AIzaSyCcssc_1iHiNjx3tub8qJ3L3WmpCn-ea5Y");
                    curl_setopt($cpr2, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                    curl_setopt($cpr2, CURLOPT_RETURNTRANSFER, TRUE);

                    $data['curl2'] = curl_exec($cpr2);
                    $data['test2'] = json_decode($data['curl2']);

                    if (isset($data['test2'])) {
                        $phone = $data['test2']->{'result'}->{'formatted_phone_number'};

                        $website = $data['test2']->{'result'}->{'website'};
                        $adress_component = $data['test2']->{'result'}->{'address_components'};
                        $nbr_componenent = count($adress_component);
                        for ($i = 0; $i < $nbr_componenent; $i++) {
                            //modifier: m ettre case
                            if ($adress_component[$i]->{'types'}[0] == 'street_number') {
                                $street_number = $adress_component[$i]->{'short_name'};
                            }

                            if ($adress_component[$i]->{'types'}[0] == 'route') {
                                $route = $adress_component[$i]->{'short_name'};
                            }

                            if ($adress_component[$i]->{'types'}[0] == 'postal_code') {
                                $code_postal = $adress_component[$i]->{'short_name'};
                            }
                            if ($adress_component[$i]->{'types'}[0] == 'country') {
                                $pays = $adress_component[$i]->{'short_name'};
                            }
                        }
                    }
                }

                $this->concert->ajout_concert_data($this->input->post('ville'), $pays, $code_postal, $route, $street_number, $this->input->post('artiste'), $this->input->post('snd_partie'), $this->input->post('salle'), $this->input->post('prix'), $this->input->post('heure_concert'), $this->input->post('date_concert'), $user_id, $phone, $website);
            }

            $this->load->view('concert/success-concert');

            //redirect('mc_concerts','refresh');
        }
    }

    public function modifier_concert($infos_profile = NULL, $concert_id, $adresse_id) {
        if ($infos_profile != $this->session->userdata('uid')) {
            show_404();
        }

        $this->load->helper('form');
        $this->load->library('form_validation');

        $data = $this->data;


        //**************** RECUP COORDONNEES GOOGLE ****************
        //**************** RECHERCHERCHE DE LA REFERENCE AVEC VILLE ET SALLE ****************

        $this->form_validation->set_rules('artiste', 'Artiste', 'required');
        $this->form_validation->set_rules('date_concert', 'Date concert', 'required');
        $this->form_validation->set_rules('salle', 'Salle', 'required');
        $this->form_validation->set_rules('ville', 'Ville', 'required');

//    $data = array();
        $data['info_concert'] = $this->concert->get_one_concert($concert_id);
        //var_dump($data['info_concert']);

        if ($this->form_validation->run() == FALSE) {

            $this->load->view('concert/modifier_concert', $data);
        } else {
            $data['concert_lieu_salle'] = $this->input->post('salle');
            $data['concert_lieu_ville'] = $this->input->post('ville');

            $mot_uniq_glgle = explode(" ", $data['concert_lieu_salle']);

            $array_mot = count($mot_uniq_glgle);
            $data['concert_lieu_salle_plus'] = "";
            for ($i = 0; $i < $array_mot; $i++) {
                $data['concert_lieu_salle_plus'].=
                        $mot_uniq_glgle[$i] . '+';
            }

            //ajouter des + a chaque espace -> sinon aucune recherche google
            if (isset($data['concert_lieu_ville']) || isset($data['concert_lieu_salle']) || $data['concert_lieu_salle'] != $data['info_concert'][0]->{'salle'} || $data['concert_lieu_ville'] != $data['info_concert'][0]->{'ville'}) {
                $cpr = curl_init();

                curl_setopt($cpr, CURLOPT_URL, "https://maps.googleapis.com/maps/api/place/textsearch/json?query=" . $data['concert_lieu_salle_plus'] . "+" . $data['concert_lieu_ville'] . "&sensor=true&key=AIzaSyCcssc_1iHiNjx3tub8qJ3L3WmpCn-ea5Y");
                curl_setopt($cpr, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                curl_setopt($cpr, CURLOPT_RETURNTRANSFER, TRUE);

                $data['curl'] = curl_exec($cpr);
                $data['test'] = json_decode($data['curl']);
                //var_dump( $data['test']) ;
                if (isset($data['test']->{'results'}[0])) {
                    $url_detail_place = $data['test']->{'results'}[0]->{"reference"};

                    //*************** AVEC LA REFERENCE : RECUP DES COORDONNEES ****************

                    $cpr2 = curl_init();

                    if (isset($url_detail_place)) {
                        curl_setopt($cpr2, CURLOPT_URL, "https://maps.googleapis.com/maps/api/place/details/json?reference=" . $url_detail_place . "&sensor=true&key=AIzaSyCcssc_1iHiNjx3tub8qJ3L3WmpCn-ea5Y");
                        curl_setopt($cpr2, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                        curl_setopt($cpr2, CURLOPT_RETURNTRANSFER, TRUE);

                        $data['curl2'] = curl_exec($cpr2);
                        $data['test2'] = json_decode($data['curl2']);

                        if (isset($data['test2'])) {
                            $phone = $data['test2']->{'result'}->{'formatted_phone_number'};
                            $website = $data['test2']->{'result'}->{'website'};
                            $adress_component = $data['test2']->{'result'}->{'address_components'};
                            $nbr_componenent = count($adress_component);
                            for ($i = 0; $i < $nbr_componenent; $i++) {
                                //modifier: m ettre case
                                if ($adress_component[$i]->{'types'}[0] == 'street_number') {
                                    $street_number = $adress_component[$i]->{'short_name'};
                                }

                                if ($adress_component[$i]->{'types'}[0] == 'route') {
                                    $route = $adress_component[$i]->{'short_name'};
                                }

                                if ($adress_component[$i]->{'types'}[0] == 'postal_code') {
                                    $code_postal = $adress_component[$i]->{'short_name'};
                                }
                                if ($adress_component[$i]->{'types'}[0] == 'country') {
                                    $pays = $adress_component[$i]->{'short_name'};
                                }
                            }
                        }
                    }
                }
            }


            $this->concert->update_concert_data($this->input->post('ville'), $pays, $code_postal, $route, $street_number, $this->input->post('artiste'), $this->input->post('snd_partie'), $this->input->post('salle'), $this->input->post('prix'), $this->input->post('heure_concert'), $this->input->post('date_concert'), $concert_id, $adresse_id, $phone, $website);



            //$this->layout->view('mc_concerts');

            $this->load->view('concert/success-concert');
        }
    }

    public function suppression_concert($user_id, $concert_id, $adresse_id) {
        if ($user_id != $this->session->userdata('uid')) {
            show_404();
        }

        $this->load->helper('form');
        $this->load->library('form_validation');

        $data = $this->data;

        if ($this->input->post("delete")) {
            $this->concert->delete_concert_data($concert_id, $adresse_id);
            $this->load->view('concert/success-concert');
        }
        echo $this->input->post("no_delete"); {
            //CLOSE POP UP
        }

        $this->load->view('concert/suppression_concert', $data);
    }

    public function add_activity_concert() {
        $uid = $this->session->userdata('uid');
        $id_concert = $this->input->post('id_concert');
        $this->concert->add_activity($id_concert, $uid);
    }

    public function delete_activity_concert() {
       $uid = $this->session->userdata('uid');
      print  $id_concert = $this->input->post('id_concert');
        $this->concert->delete_activity($id_concert, $uid);
    }

}