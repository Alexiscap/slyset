<?php
 
class User extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        //$this->output->enable_profiler(true);
        
        $this->layout->ajouter_css('slyset');
        $this->layout->ajouter_js('jquery.placeheld.min');
        
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
//        print_r($fb_data);
        
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
        } else if(isset($fb_data['me']) && $fb_data['me']['uid'] != 0) {
            $this->layout->view('inscription/loginform3', $data);
        } else {
            $mail  = $this->input->post('mail');
            
//            $sess_mail = $this->session->userdata('mail');
//            $this->session->set_userdata('mail', $sess_mail);
//            $this->session->set_userdata('mail', $mail);
          
            $this->layout->view('inscription/loginform2', $data);
        }
    }

    public function register_step_2()
    {   
        $this->form_validation->set_rules('typeaccount', 'Type de compte', 'required');     
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

    public function register_step_2fb()
    {
        $this->form_validation->set_rules('typeaccount', 'Type de compte', 'required');
      
        $fb_data = $this->session->userdata('fb_data');
        print_r($fb_data);
        $data = array('fb_data' => $fb_data);
        
        if($this->form_validation->run() == FALSE){			 
            $this->layout->view('inscription/loginform2_fb', $data);
        } else {
            $this->layout->view('inscription/loginform3', $data);
        }
    }
    
    public function register_step_3()
    {
        $fb_data = $this->session->userdata('fb_data');
        $data = array('fb_data' => $fb_data);
        print_r($fb_data);
        
        //echo '<pre>'.print_r($fb_data).'</pre>';
//        $this->form_validation->set_rules('nom', 'Nom', 'trim|required|xss_clean');
//        $this->form_validation->set_rules('prenom', 'Prénom', 'trim|required|xss_clean');
//        $this->form_validation->set_rules('genre', 'Genre', 'trim|required|xss_clean');
//        $this->form_validation->set_rules('ville', 'Ville', 'trim|required|xss_clean');
//        $this->form_validation->set_rules('pays', 'Nationalité', 'trim|required|xss_clean');
        
        $this->form_validation->set_rules('stylemusicecoute', 'Style de musique écouté', 'required');
        $this->form_validation->set_rules('submit', 'Validation du compte', 'callback_check_fb_register');
        
        if($this->input->post('typeaccount') == 1){
            $this->form_validation->set_rules('login', 'Nom d\'utilisateur', 'trim|required|xss_clean');
        } else if($this->input->post('typeaccount') == 2){
            $this->form_validation->set_rules('nomscene', 'Nom de scène', 'trim|required|xss_clean');
            $this->form_validation->set_rules('stylemusicjoue', 'Style de musique joué', 'required');
            $this->form_validation->set_rules('stylemusicinstru', 'Style d\'instrument', 'required');
        }
             
        if($this->form_validation->run() == FALSE){
            $this->layout->view('inscription/loginform3');
        } else {
            if(isset($fb_data['me']) && $fb_data['me']['id'] != 0){
                if(isset($fb_data['me']['location']['name'])){
                    $explode_fb_location = explode(', ', $fb_data['me']['location']['name']);
                    $ville_fb = $explode_fb_location[0];
                    $pays_fb = $explode_fb_location[1];
                } else {
                    $ville_fb = '';
                    $pays_fb = '';
                }

                if(isset($fb_data['me']['gender']) && $fb_data['me']['gender'] == 'male'){
                    $genre_fb = 'Homme';
                } else if(isset($fb_data['me']['gender']) && $fb_data['me']['gender'] == 'female'){
                    $genre_fb = 'Femme';
                } else {
                    $genre_fb = '';
                }

                $facebook_id      = $fb_data['me']['id'];
                $type             = $this->input->post('typeaccount');
                $mail             = $fb_data['me']['email'];
                $password         = '';
                $nom              = $fb_data['me']['last_name'];
                $prenom           = $fb_data['me']['first_name'];
                $naissance        = $fb_data['me']['birthday'];
                $genre            = $genre_fb;
                $ville            = $ville_fb;
                $pays             = $pays_fb;
                $stylemusicecoute = $this->input->post('stylemusicecoute');
            } else {
                $facebook_id      = '';
                $type             = $this->input->post('typeaccount');
                $mail             = $this->input->post('mail');
                $password         = $this->input->post('password');
                $nom              = '';
                $prenom           = '';
                $naissance        = '';
                $genre            = '';
                $ville            = '';
                $pays             = '';
                $stylemusicecoute = $this->input->post('stylemusicecoute');
            }
            
            switch($this->input->post('typeaccount')){
              case 1 :
                $login            = $this->input->post('login');
                $stylemusicjoue   = '';
                $stylemusicinstru = '';
                break;
              
              case 2 :
                $login            = $this->input->post('nomscene');
                $stylemusicjoue   = $this->input->post('stylemusicjoue');
                $stylemusicinstru = $this->input->post('stylemusicinstru');
                break;
            }
          
            $this->user_model->insert_user($facebook_id, $login, $mail, $password, $type, $nom, $prenom, $naissance, $genre, $ville, $pays, $stylemusicecoute, $stylemusicjoue, $stylemusicinstru);

            //on pourrait le loguer direct mais on l'envoi vers le formulaire d'identification
            //redirect('login', 'refresh');
            //redirect('homepage', 'refresh');
            //echo $this->input->post('stylemusicecoute');
            echo 'Le formulaire a été correctement rempli et envoyé.';
        }
    }
    
    public function check_register()
    {
        $mail   = $this->input->post('mail');
        $result = $this->user_model->mail_register($mail);

        if($result){
            $this->form_validation->set_message('check_register', 'Cette adresse email est déjà utilisée !');
            return false;
        } else {
            return true;
        }
    }
    
    public function check_fb_register()
    {
        $fb_data      = $this->session->userdata('fb_data');
        
        $facebook_id  = $fb_data['me']['id'];
        $result       = $this->user_model->facebook_register($facebook_id);

        if($result){
            $this->form_validation->set_message('check_fb_register', 'Ce compte facebook ou l\'email de votre compte facebook est déjà utilisé !');
            return false;
        } else {
            return true;
        }
    }
  
}