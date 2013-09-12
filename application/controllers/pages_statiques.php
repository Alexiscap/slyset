<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pages_statiques extends CI_Controller {

    protected $session_uid;
    protected $data;

    public function __construct() {
        parent::__construct();
        
        $this->layout->ajouter_css('slyset');
        $this->load->helper('form');
        $this->load->model('achat_model');
        $this->layout->set_id_background('statics-pages');

        $uid = $this->session->userdata('uid');
        $this->session_uid = (!empty($uid)) ? $uid : '';

        $data_notif['count_notif'] = $this->achat_model->notif_panier($this->session->userdata('uid'));

        $this->data = array(
            'sidebar_left' => $this->load->view('sidebars/sidebar_left', $data_notif, TRUE)
        );
    }
    
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
        $this->load->library('form_validation');
        
        $data = $this->data;

        $this->layout->view('statiques/contact', $data);
    }

    public function contact_form() {
        $this->load->library(array('form_validation', 'email'));
        
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
            
//            $this->email->from($mail, $name.' '.surname);
//            $this->email->to('alexiscap@gmail.com'); 
//            $this->email->cc($mail);
//
//            $this->email->subject('Slyset - Contact : '.$name.' '.surname);
//            $this->email->message($message);	
//
//            $this->email->send();
            
            $to = $mail;
            $subject = 'Slyset - Contact : '.$name.' '.surname;
            $message = '
            <html>
             <head>
              <title>Contact Form - Slyset</title>
             </head>
             <body>
               '.$message.'</br></br></br>
               Ce mail a été généré automatiquement via le formulaire de contact de Slyset, veuillez attendre une réponse de l\'équipe Slyset et ne pas répondre à cette adresse.
             </body>
            </html>';
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            mail($to, $subject, $message, $headers);
            
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