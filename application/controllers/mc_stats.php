<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mc_stats extends CI_Controller
{
    var $data;
    var $user_id;

    public function __construct() {
        parent::__construct();

        $this->layout->ajouter_css('slyset');

        $this->load->model(array('perso_model', 'user_model'));
        $this->load->library(array('layout'));

        $this->layout->set_id_background('stats');
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

    public function index($user_id)
    {
        $uid = $this->session->userdata('uid');
        $type_account = $this->session->userdata('account');

        if (($user_id == $uid) && $type_account != 1) {
            $this->page($user_id);
        } elseif(isset($uid)) {
            redirect('home/'.$uid, 'refresh');
        } else {
            redirect('home', 'refresh');
        }
    }

    public function page()
    {
        $data = $this->data;
        $data['profile'] = $this->user_model->getUser($this->user_id);
        
        $this->layout->view('statistique/mc_stats', $data);
    }

}