<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout->ajouter_css('slyset');

        $this->load->helper('form');
        $this->load->model('login_model');
//        $this->load->model('Facebook_Model');

        $this->layout->set_id_background('inscription');
    }

    public function index() {
        if ($this->login_model->isLoggedIn()) {
            $this->dashboard();
        } else {
            $this->login_all();
        }
    }

    public function login_home() {
        if ($this->login_model->isLoggedIn()) {
            $this->login();
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('login', 'Login', 'trim|required|xss_clean');
            $this->form_validation->set_rules('password', 'Mot de passe', 'trim|required|xss_clean');

            if (!$this->form_validation->run()) {
                $this->session->set_flashdata('error', 'Mauvais Login/Mot de passe');
                redirect('home', 'refresh');
            } else {
                $login = $this->input->post('login');
                $password = $this->input->post('password');
                $validCredentials = $this->login_model->validCredentials($login, $password);

                if ($validCredentials) {
                    $this->dashboard();
                } else {
                    $this->session->set_flashdata('error', 'Mauvais Login/Mot de passe');
                    redirect('home');
                }
            }
        }
    }

    public function login_all() {
        if ($this->login_model->isLoggedIn()) {
            $this->login();
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('login', 'Login', 'trim|required|xss_clean');
            $this->form_validation->set_rules('password', 'Mot de passe', 'trim|required|xss_clean');

            if (!$this->form_validation->run()) {
                $data['error_credentials'] = 'Mauvais Login/Mot de passe';
                $this->layout->view('login');
            } else {
                $login = $this->input->post('login');
                $password = $this->input->post('password');
                $validCredentials = $this->login_model->validCredentials($login, $password);

                if ($validCredentials) {
                    $this->dashboard();
                } else {
                    $data['error_credentials'] = 'Mauvais Login/Mot de passe';
                    $this->layout->view('login', $data);
                }
            }
        }
    }

    public function dashboard() {
        if ($this->login_model->isLoggedIn()) {
            redirect('home/' . $this->session->userdata('uid'), 'refresh');
        } else if ($this->login_model->isLoggedInAdmin()) {
            redirect('admin', 'refresh');
        }
    }

    public function logout() {
        $this->session->unset_userdata('login');
        $this->session->unset_userdata('account');
        $this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();

        redirect('/', 'refresh');
    }

}