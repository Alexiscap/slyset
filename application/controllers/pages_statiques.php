<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pages_statiques extends CI_Controller {

    protected $session_uid;
    protected $data;

    public function __construct() {
        parent::__construct();
        //        $this->output->enable_profiler(true);
        $this->layout->ajouter_css('slyset');

        $this->layout->set_id_background('statics-pages');

        $uid = $this->session->userdata('uid');
        $this->session_uid = (!empty($uid)) ? $uid : '';

        $this->data = array(
            'sidebar_left' => $this->load->view('sidebars/sidebar_left', '', TRUE)
        );
    }

//    public function index($page = NULL) {
//        if ($page == 'mentions') {
//            $this->mentions_legales();
//        } elseif ($page == '') {
//            $this->test();
//        } else {
//            redirect('home/'.$this->session_uid, 'refresh');
//        }
//    }
    
    public function mentions_legales() {
        $data = $this->data;

        $this->layout->view('statiques/mentions_legales', $data);
    }

    public function faq() {
        $data = $this->data;

        $this->layout->view('statiques/faq', $data);
    }

    public function cgu() {
        $data = $this->data;

        $this->layout->view('statiques/cgu', $data);
    }

    public function annonceurs() {
        $data = $this->data;

        $this->layout->view('statiques/annonceurs', $data);
    }

    public function contact() {
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $data = $this->data;

        $this->layout->view('statiques/contact', $data);
    }

    public function contact_form() {
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $data = $this->data;

        $this->form_validation->set_rules('nom', 'Nom', 'trim|required|xss_clean');
        $this->form_validation->set_rules('prenom', 'Prénom', 'trim|required|xss_clean');
        $this->form_validation->set_rules('mail', 'Email', 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('message', 'Message', 'trim|required|xss_clean');

        if($this->form_validation->run() == FALSE){
            $this->layout->view('statiques/contact', $data);
        } else {
            $name  = $this->input->post('nom');
            $surname  = $this->input->post('prenom');
            $mail  = $this->input->post('mail');
            $message  = $this->input->post('message');
            
            $this->session->set_flashdata('feedback', 'Votre message a bien été transmis à l\'équipe Slyset. Nous vous donnerons réponse aussi tôt que possible.');
            
//            redirect('home');
//            $this->layout->view('statiques/contact', $data);
            redirect('contact/'.$this->session_uid);
        }
    }


    public function paiements() {
        $data = $this->data;

        $this->layout->view('statiques/paiements', $data);
    }

    public function slyset() {
        $data = $this->data;

        $this->layout->view('statiques/qui_sommes_nous', $data);
    }

    public function fonctionnalites() {
        $data = $this->data;

        $this->layout->view('statiques/fonctionnalites', $data);
    }

}