<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mc_musique extends CI_Controller {

    var $data;

    public function __construct() {
        parent::__construct();

        $this->layout->ajouter_css('slyset');
        
        $this->load->model(array('perso_model', 'user_model'));
        $this->load->helper('form');
        
        $this->layout->set_id_background('musique');

        $this->user_id = (is_numeric($this->uri->segment(2))) ? $this->uri->segment(2) : $this->uri->segment(3);
        $output = $this->perso_model->get_perso($this->user_id);

        $sub_data = array();
        $sub_data['profile'] = $this->user_model->getUser($this->user_id);
        $sub_data['perso'] = $output;
        
        if ($this->user_id != null) {
            $sub_data['photo_right'] = $this->user_model->last_photo($this->user_id);
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
            'sidebar_right' => $this->load->view('sidebars/sidebar_right', $sub_data, TRUE),
            'community_follower' => $my_abonnement_head
        );
    }

    public function index($user_id) {
        $uid = $this->session->userdata('uid');
        $infos_profile = $this->user_model->getUser($user_id);

        if ((($user_id != $uid && !empty($user_id)) || ($user_id == $uid && !empty($user_id))) && $infos_profile->type != 1) {
            $this->page($infos_profile);
        } else {
            redirect('home/' . $uid, 'refresh');
        }
    }

    public function page($infos_profile) {
        $data = $this->data;
        $user_visited = (empty($infos_profile)) ? $this->session->userdata('uid') : $infos_profile->id;

        if (!empty($infos_profile)) {
            $data['infos_profile'] = $infos_profile;
        }

        $this->layout->view('musique/mc_musique', $data);
    }
    
    public function test() {        
        $this->load->library('getid3/Getid3');
        
        $folder = 'assets/musique/';
        
        $test = $this->getid3->analyze($folder.'test.mp3');
        print_r($test);
    }

}