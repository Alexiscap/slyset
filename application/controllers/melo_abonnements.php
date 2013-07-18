<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Melo_abonnements extends CI_Controller {

    var $data;

    public function __construct() {
        parent::__construct();

        $this->layout->ajouter_css('slyset');

        $this->load->model(array('user_model', 'follower_model'));

        $this->layout->set_id_background('abonnements');

        $this->user_id = (is_numeric($this->uri->segment(2))) ? $this->uri->segment(2) : $this->uri->segment(3);

        $sub_data = array();
        $sub_data['profile'] = $this->user_model->getUser($this->user_id);

        if ($this->user_id != null) {
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
            $this->page($infos_profile);
        } else {
            show_404();
        }
    }

    public function page($infos_profile) {
        $data = $this->data;
        $uid = $this->session->userdata('uid');

        $user_visited = (empty($infos_profile)) ? $uid : $infos_profile->id;
        if (!empty($infos_profile)) {
            $data['infos_profile'] = $infos_profile;
        }

        $data['all_follower'] = $this->follower_model->get_all_abonnement($user_visited);

        $this->layout->view('follower/melo_abonnements', $data);
    }

    public function delete_community_wall() {
        $id_community = $this->input->post('idwall_community');
        $delete_wall_community = $this->follower_model->delete_wall_community($id_community);
    }

}