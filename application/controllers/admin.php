<?php  
class Admin extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->layout->ajouter_css('slyset');
        $this->layout->ajouter_js('jquery.placeheld.min');
        
        $this->load->helper('form');
        $this->load->model('login_model');
//        $this->load->model('Facebook_Model');
        $this->load->library('layout');
        
        $this->layout->set_id_background('admin-login');
    }

    
    public function index($uid = NULL)
    {
        if($this->login_model->isLoggedInAdmin()){
//            redirect('admin/dashboard', 'refresh');
            $this->dashboard();
        } else {
            redirect('login', 'refresh');
        }   
    }
    
//    public function login()
//    {
//        if($this->login_model->isLoggedIn()){
//             redirect('admin','refresh');
//        } else {
//             $this->load->library('form_validation');
//             
//             $this->form_validation->set_rules('login', 'Login', 'trim|required|xss_clean');
//             $this->form_validation->set_rules('password', 'Mot de passe', 'trim|required|xss_clean');
//
//             if(!$this->form_validation->run()){
//                  $this->load->view('login');
//             } else {
//                  $login            = $this->input->post('login');
//                  $password         = $this->input->post('password');
//                  $validCredentials = $this->login_model->validCredentials($login, $password);
//
//                  if($validCredentials){
//                       redirect('admin/dashboard', 'refresh');
//                  } else {
//                       $data['error_credentials'] = 'Wrong Username/Password';
//                       $this->load->view('login', $data);
//                  }
//             }
//        }
//    }
    
    public function dashboard()
    {
          if($this->login_model->isLoggedInAdmin()){
               $this->layout->view('admin');
          }
     }
    
}