<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout->ajouter_css('slyset');

        $this->load->helper('form');
        $this->load->model(array('login_model', 'user_model'));
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

    public function forgot() {
        $this->load->helper('genpassword');
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('mail', 'Email', 'trim|required|valid_email|xss_clean|callback_check_register');

        if (!$this->form_validation->run()) {
//            $data['error_credentials'] = 'Mauvais Login/Mot de passe';
            $this->layout->view('forgot_password');
        } else {
            $mail = $this->input->post('mail');
            $user = $this->user_model->getUserByMail($mail);
            $new_password = get_random_password();
            
            $to = $mail;
            $subject = 'Slyset - Votre compte : mot de passe oublié';
            $message = '<html>
                            <head>
                              <title>Réinitialisation de votre mot de passe</title>
                            </head>
                            <body>
                              Bonjour' . $user->login . ' </br></br>Vous avez demandé à récupérer votre mot de passe sur Slyset. Par soucis de sécurité, nous ne souhaitons pas divulguer celui-ci à travers un simple mail.</br></br>Voici donc votre nouveau mot de passe réinitialisé : ' . $new_password . ' </br></br></br>Vous pouvez bien entendu vous connecter dès à présent sur votre espace Slyset et à tout moment changer votre mot de passe via les réglages de votre profil.</br></br>A bientôt sur Slyset,</br></br></br>L\'équipe Slyset
                            </body>
                        </html>';
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

            mail($to, $subject, $message, $headers);
            $this->user_model->update_password($user->id, $new_password);
            
            $this->session->set_flashdata('validation', '<div class="message_info">Votre mot de passe a bien été réinitialisé, un mail vous a été envoyé avec les instructions et vos nouveaux accès !</div>');
            redirect('login', 'refresh');
        }
    }
    
    public function check_register() {
        $mail = $this->input->post('mail');
        $result = $this->user_model->mail_register($mail);

        if ($result) {
            return true;
        } else {
            $this->form_validation->set_message('check_register', 'Cette adresse email n\'est pas utilisée, n\'hésitez pas à vous vous inscrire.');
            return false;
        }
    }

}