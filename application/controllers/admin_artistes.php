<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_artistes extends CI_Controller {

    var $data;
    var $user_id;

    public function __construct() {
        parent::__construct();

        $this->layout->ajouter_css('slyset');

        $this->load->helper(array('cookie', 'form'));
        $this->load->model(array('login_model', 'user_model', 'admin_model'));
        $this->load->library(array('form_validation', 'layout'));

        $this->layout->set_id_background('admin-artistes');
        $this->layout->set_description('');
        $this->layout->set_titre('Dashboard Admin : Gestion des articles | Slyset Music');

        $this->data = array(
            'sidebar_left' => $this->load->view('sidebars/sidebar_left_admin', '', TRUE)
        );
    }

    public function index() {
        if ($this->login_model->isLoggedInAdmin()) {
            $this->dashboard();
        } else {
            redirect('login', 'refresh');
        }
    }

    public function dashboard() {
        if ($this->login_model->isLoggedInAdmin()) {
            $data = $this->data;
            $data['cover_artistes'] = $this->admin_model->get_cover_artistes();

            $this->layout->view('admin/artistes', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

    public function add_artiste() {
        if ($this->login_model->isLoggedInAdmin()) {
            $data = $this->data;

            $this->form_validation->set_rules('artiste1', 'Artiste n°1', 'trim|xss_clean|required|callback_check_type[artiste1]');
            $this->form_validation->set_rules('artiste2', 'Artiste n°2', 'trim|xss_clean|callback_check_type[artiste2]');
            $this->form_validation->set_rules('artiste3', 'Artiste n°3', 'trim|xss_clean|callback_check_type[artiste3]');
            $this->form_validation->set_rules('artiste4', 'Artiste n°4', 'trim|xss_clean|callback_check_type[artiste4]');
            $this->form_validation->set_rules('artiste5', 'Artiste n°5', 'trim|xss_clean|callback_check_type[artiste5]');
            $this->form_validation->set_rules('submit', 'Enregistrer', '');

            if ($this->form_validation->run() == FALSE) {
                $this->layout->view('admin/artistes', $data);
            } else {
                $artiste1 = $this->input->post('artiste1');
                $artiste2 = $this->input->post('artiste2');
                $artiste3 = $this->input->post('artiste3');
                $artiste4 = $this->input->post('artiste4');
                $artiste5 = $this->input->post('artiste5');

                $exist = $this->admin_model->get_cover_artistes();
                if ($exist == FALSE) {
                    $this->admin_model->insert_artiste($artiste1, $artiste2, $artiste3, $artiste4, $artiste5);
                    print 11111111;
                } else {
                    $this->admin_model->update_artiste($artiste1, $artiste2, $artiste3, $artiste4, $artiste5);
                    print 2222222;
                }
                
                redirect('admin_artistes', 'refresh');
            }
        } else {
            redirect('login', 'refresh');
        }
    }

    public function check_type($field_artiste) {
        $mail = $this->input->post($field_artiste);
        $result = $this->user_model->getUserByName($field_artiste);

        if (!$result && !empty($field_artiste)) {
            $this->form_validation->set_message('check_type', 'Veuillez saisir un nom de musicien ou de groupe !');
            return false;
        } else {
            return true;
        }
    }

}