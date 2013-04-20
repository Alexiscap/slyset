<?php
 
class User extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
    }
  
    public function index()
    {
        $this->register();
    }
  
    public function register(){
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('user_model');

        $this->form_validation->set_rules('mail', 'Email', 'trim|required|valid_email|xss_clean|callback_check_register');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

        $this->load->library('layout');

        if($this->form_validation->run() == FALSE){			 
          $this->layout->view('loginform');
        } else {
          $mail = $this->input->post('mail');
          $password = $this->input->post('password');
          $this->user_model->insert_user($mail, $password);

          //on pourrait le loguer direct mais on l'envoi vers le formulaire d'identification
          //redirect('login', 'refresh');
          echo('GG MEC ! : '.$mail.' et '.$password);
        }
    }

    function check_register(){
        $mail = $this->input->post('mail');
        $result = $this->user_model->register($mail);

        if($result){
            $this->form_validation->set_message('check_register','Cette adresse email est déjà utilisée !');
            return false;
        } else { 
            return true;
        }
    }
  
}