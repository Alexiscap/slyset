<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller
{
    var $data;
    var $user_id;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->layout->ajouter_css('slyset');
        
        $this->load->helper(array('cookie', 'form'));
        $this->load->model(array('login_model', 'user_model'));
        $this->load->library(array('form_validation', 'layout'));
        
        $this->layout->set_id_background('admin');
        $this->layout->set_description('');
        $this->layout->set_titre('Dashboard Admin | Slyset Music');
        
        $this->data = array(
            'sidebar_left'  => $this->load->view('sidebars/sidebar_left_admin', '', TRUE)
        );
    }

    
    public function index($uid = NULL)
    {
        if($this->login_model->isLoggedInAdmin()){
            $this->dashboard();
        } else {
            redirect('login', 'refresh');
        }
    }
    
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