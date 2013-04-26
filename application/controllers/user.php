<?php
 
class User extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->output->enable_profiler(true);
        
        $this->layout->ajouter_css('slyset');
        $this->layout->ajouter_js('jquery.placeheld.min');
        $this->layout->ajouter_js('slyset');
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('user_model');
        $this->load->model('Facebook_Model');
        $this->load->library('layout');
        
        $this->layout->set_id_background('inscription');
    }
  
    public function index()
    {
        $this->register_step_1();
    }
    
    public function register_step_1()
    {
        $fb_data = $this->session->userdata('fb_data');
        //print_r($fb_data);
        
//        if((!$fb_data['uid']) or (!$fb_data['me'])){
//            // If this is a protected section that needs user authentication
//            // you can redirect the user somewhere else
//            // or take any other action you need
//            $this->layout->view('inscription/loginform', $data);
//        } else {
            $data = array('fb_data' => $fb_data);
//        }
            
        $this->form_validation->set_rules('mail', 'Email', 'trim|required|valid_email|xss_clean|callback_check_register');
        $this->form_validation->set_rules('login', 'Nom d\'utilisateur', 'trim|required|xss_clean');

        if($this->form_validation->run() == FALSE){			 
            $this->layout->view('inscription/loginform', $data);
        } else {
            $mail = $this->input->post('mail');
            $login = $this->input->post('login');
          
//            $this->register_step_2(););
            $this->layout->view('inscription/loginform2', $data);
        }
    }

    public function register_step_2()
    {
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|matches[confpassword]');
        $this->form_validation->set_rules('confpassword', 'Confirmation password', 'trim|required|xss_clean');
      
//        $required_if = $this->input->post('password') ? '|required' : '' ;
//        $required_if2 = $this->input->post('confpassword') ? 'required' : '' ;
//        $valid_pass = $this->input->post('password');
//        $valid_confpass = $this->input->post('confpassword');
//      if(empty($valid_pass) && empty($valid_confpass)){
//        $this->form_validation->set_rules('password', 'Password', 'trim|xss_clean|matches[confpassword]');
//        $this->form_validation->set_rules('confpassword', 'Confirmation password', 'trim|xss_clean');
//      } else {
//        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|matches[confpassword]');
//        $this->form_validation->set_rules('confpassword', 'Confirmation password', 'trim|required|xss_clean');
//      }
      
        if($this->form_validation->run() == FALSE){			 
          $this->layout->view('inscription/loginform2');
        } else {
          $password = $this->input->post('password');
          $confpassword = $this->input->post('confpassword');
          //$this->user_model->insert_user($mail, $password);

          //on pourrait le loguer direct mais on l'envoi vers le formulaire d'identification
          //redirect('login', 'refresh');
          //echo('GG MEC ! : '.$mail.' et '.$password);
          $this->layout->view('inscription/loginform3');
        }
    }
    
    public function register_step_3()
    {
        $this->form_validation->set_rules('nom', 'Nom', 'trim|required|xss_clean');
        $this->form_validation->set_rules('prenom', 'Prénom', 'trim|required|xss_clean');
      
//        $required_if = $this->input->post('password') ? '|required' : '' ;
//        $required_if2 = $this->input->post('confpassword') ? 'required' : '' ;
//        $valid_pass = $this->input->post('password');
//        $valid_confpass = $this->input->post('confpassword');
//      if(empty($valid_pass) && empty($valid_confpass)){
//        $this->form_validation->set_rules('password', 'Password', 'trim|xss_clean|matches[confpassword]');
//        $this->form_validation->set_rules('confpassword', 'Confirmation password', 'trim|xss_clean');
//      } else {
//        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|matches[confpassword]');
//        $this->form_validation->set_rules('confpassword', 'Confirmation password', 'trim|required|xss_clean');
//      }
      
        if($this->form_validation->run() == FALSE){			 
          $this->layout->view('inscription/loginform3');
        } else {
          $nom = $this->input->post('nom');
          $prenom= $this->input->post('prenom');
          //$this->user_model->insert_user($mail, $password);

          //on pourrait le loguer direct mais on l'envoi vers le formulaire d'identification
          //redirect('login', 'refresh');
          //echo('GG MEC ! : '.$mail.' et '.$password);
          redirect('homepage', 'refresh');
          echo 'Le formulaire a été correctement rempli et envoyé.';
        }
    }
    
    public function check_register(){
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