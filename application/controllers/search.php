<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Search extends CI_Controller {

    var $data;

    public function __construct() {
        parent::__construct();
//        $this->output->enable_profiler(true);
        $this->layout->ajouter_css('slyset');
        $this->layout->ajouter_js('infinite_scroll');

        $this->load->helper(array('cookie', 'form'));
        $this->load->model(array('search_model', 'user_model'));
        $this->load->library(array('form_validation'));

        $this->layout->set_id_background('search');
        $this->layout->set_description('Slyset');
        $this->layout->set_titre('Slyset');

        $this->user_id = (is_numeric($this->uri->segment(2))) ? $this->uri->segment(2) : $this->uri->segment(3);
//        $output = $this->perso_model->get_perso($this->user_id);

        $sub_data = array();
        $sub_data['profile'] = $this->user_model->getUser($this->user_id);
//        $sub_data['perso'] = $output;
//
//        if (!empty($output)) {
//            $this->layout->ajouter_dynamique_css($output->theme_css);
//            write_css($output);
//        }

        $this->data = array(
            'sidebar_left' => $this->load->view('sidebars/sidebar_left', '', TRUE),
            'sidebar_right' => $this->load->view('sidebars/sidebar_right', $sub_data, TRUE)
        );
    }

    public function index($uid) {
        $session_id = $this->session->userdata('uid');

        if (!empty($session_id) && empty($uid)) {
            redirect('home/' . $session_id, 'refresh');
        } elseif (isset($uid) && !empty($uid)) {
            $this->search_keyword($uid);
        } else {
            $this->search_keyword($uid);
        }
    }

    public function search_keyword($uid) {
        $data = $this->data;
        $session_id = $this->session->userdata('uid');
        
        $this->form_validation->set_rules('recherche', 'Recherche', 'trim|require|xss_clean');
             
        if($this->form_validation->run() == FALSE){
//            $this->layout->view('search_result', $data);
        } else {
            $keyword = $this->input->post('recherche');
            $data['results'] = $this->search_model->search($keyword, 2, 0);
            $data['keyword'] = $keyword;

            $this->layout->view('search_result', $data);
        }
    }
    
    public function ajax_search_result($uid, $offset = null) {
//        $this->load->library('my_layout');
        $keyword = $this->input->post('recherche');
//        print 'du ajax controller fonction : '.$keyword;    
//        print 'donc offset : '.$offset;    
        
        if ($this->search_model->search($keyword, 2, $offset)) {
            $data['results'] = $this->search_model->search($keyword, 2, $offset);
            $data['keyword'] = $keyword;

            $this->load->view('search_result_ajax', $data);
        }
        else {
//          echo 'End';
        }
    }
}