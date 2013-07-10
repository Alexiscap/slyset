<?php  
class Admin extends CI_Controller
{
    var $data;
    var $user_id;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->layout->ajouter_css('slyset');
        $this->layout->ajouter_css('shadowbox');
        $this->layout->ajouter_js('shadowbox/shadowbox');
        
        $this->load->helper(array('cookie', 'form'));
        $this->load->model(array('login_model', 'perso_model', 'user_model'));
        $this->load->library(array('form_validation', 'layout'));
        
        $this->layout->set_id_background('admin');
        
        $this->data = array(
            'sidebar_left'  => $this->load->view('sidebars/sidebar_left_admin', '', TRUE)
        );
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
            $data = $this->data;
            $data['nb_suspension'] = $this->user_model->count_suspend();       
            
            $this->layout->view('admin/admin', $data);
        } else {
            redirect('login', 'refresh');
        }
    }
    
    public function set_notification()
    {
        if($this->login_model->isLoggedInAdmin()){
            $data = $this->data;

            $this->form_validation->set_rules('notification', 'Notification', 'trim|xss_clean');
            $this->form_validation->set_rules('submit', 'Modification de la notification', '');

            if($this->form_validation->run() == FALSE){
                $this->layout->view('admin/admin', $data);
            } else {
                $notification = $this->input->post('notification');

                $cookie = array(
                    'name'   => 'notification',
                    'value'  => $notification,
                    'expire' =>  99999999,
                    'secure' => false
                );
                $this->input->set_cookie($cookie);

                redirect('admin', 'refresh');
            }
        } else {
            redirect('login', 'refresh');
        }
    }
    
}