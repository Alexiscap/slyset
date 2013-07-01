<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mc_followers extends CI_Controller {

    var $data;

    public function __construct() {
        parent::__construct();

        $this->layout->ajouter_css('slyset');

        $this->load->model(array('perso_model', 'user_model', 'follower'));
        $this->layout->set_id_background('followers');

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
        $uid = $this->session->userdata('uid');

        $user_visited = (empty($infos_profile)) ? $uid : $infos_profile->id;

        if (!empty($infos_profile)) {
            $data['infos_profile'] = $infos_profile;
        }

        $data['all_follower'] = $this->follower->get_all_follower_user($user_visited);
        $ifollow = $this->follower->get_abonnement($user_visited);
        $data['allifollow'] = "";
        foreach ($ifollow as $allmy){
            $data['allifollow'] .= $allmy->Utilisateur_id . ',';
        }
        //$this->layout->views('3');
        $this->layout->view('follower/mc_followers', $data);
    }

    public function musicien($user_id) {
        $data = $this->data;

        $infos_profile = $this->user_model->getUser($user_id);
        if (!empty($infos_profile)) {
            $data['infos_profile'] = $infos_profile;
        }

        $data['all_follower'] = $this->follower->get_follower_bytype($user_id, 2);
        //$this->layout->views('3');
        $ifollow = $this->follower->get_abonnement($user_id);
        $data['allifollow'] = "";
        foreach ($ifollow as $allmy) {
            $data['allifollow'] .=$allmy->Utilisateur_id . ',';
        }
        $this->layout->view('follower/musicien', $data);
    }

    public function melomane($user_id) {
        $data = $this->data;

        $infos_profile = $this->user_model->getUser($user_id);
        if (!empty($infos_profile)) {
            $data['infos_profile'] = $infos_profile;
        }

        $data['all_follower'] = $this->follower->get_follower_bytype($user_id, 1);
        $this->layout->view('follower/melomane', $data);
    }

}