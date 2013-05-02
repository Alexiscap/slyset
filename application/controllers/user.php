<?php
 
class User extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        //$this->output->enable_profiler(true);
        
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

        if($this->form_validation->run() == FALSE){			 
            $this->layout->view('inscription/loginform', $data);
        } else {
            $mail  = $this->input->post('mail');
          
            $this->layout->view('inscription/loginform2', $data);
        }
    }

    public function register_step_2()
    {
        $this->form_validation->set_rules('password', 'Mot de passe', 'trim|required|xss_clean|matches[confpassword]');
        $this->form_validation->set_rules('confpassword', 'Confirmer mot de passe', 'trim|required|xss_clean');
      
        if($this->form_validation->run() == FALSE){			 
            $this->layout->view('inscription/loginform2');
        } else {
            $password     = $this->input->post('password');
            $confpassword = $this->input->post('confpassword');
            
            $this->layout->view('inscription/loginform3');
        }
    }
    
    public function register_step_3()
    {
        $this->form_validation->set_rules('nom', 'Nom', 'trim|required|xss_clean');
        $this->form_validation->set_rules('prenom', 'Prénom', 'trim|required|xss_clean');
        $this->form_validation->set_rules('genre', 'Genre', 'trim|required|xss_clean');
        $this->form_validation->set_rules('login', 'Nom d\'utilisateur', 'trim|required|xss_clean');
        $this->form_validation->set_rules('nomscene', 'Nom de scène', 'trim|required|xss_clean');
        $this->form_validation->set_rules('ville', 'Ville', 'trim|required|xss_clean');
        $this->form_validation->set_rules('pays', 'Nationalité', 'trim|required|xss_clean');
             
        if($this->form_validation->run() == FALSE){			 
           $this->layout->view('inscription/loginform3');
        } else {
            $type        = $this->input->post('typeaccount');
            $mail        = $this->input->post('mail');
            $password    = $this->input->post('password');
            $nom         = $this->input->post('nom');
            $prenom      = $this->input->post('prenom');
            $genre       = $this->input->post('genre');
            $ville       = $this->input->post('ville');
            $pays        = $this->input->post('pays');
            
            switch($this->type){
              case 1 :
                $login = $this->input->post('login');
                break;
              
              case 2 :
                $login = $this->input->post('nomscene');
                break;
            }
          
            $this->user_model->insert_user($login, $mail, $password, $nom, $prenom, $genre, $ville, $pays, $type);

            //on pourrait le loguer direct mais on l'envoi vers le formulaire d'identification
            //redirect('login', 'refresh');
            //redirect('homepage', 'refresh');
            echo 'Le formulaire a été correctement rempli et envoyé.';
        }
    }
    
    public function check_register(){
        $mail   = $this->input->post('mail');
        $result = $this->user_model->mail_register($mail);

        if($result){
            $this->form_validation->set_message('check_register','Cette adresse email est déjà utilisée !');
            return false;
        } else {
            return true;
        }
    }
  
}