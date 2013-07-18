<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Melo_playlist extends CI_Controller {

    var $data;

    public function __construct() {
        parent::__construct();

        $this->layout->ajouter_css('slyset');

        $this->load->model(array('user_model'));

        $this->layout->set_id_background('playlist');

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
        $type_account = $this->session->userdata('account');

        if ($user_id == $uid) {
            $this->page($user_id);
        } elseif (isset($uid)) {
            redirect('home/' . $uid, 'refresh');
        } else {
            redirect('home', 'refresh');
        }
    }

    public function page($user_id) {
        $data = $this->data;

        $this->layout->view('playlist/melo_playlist', $data);
    }

}