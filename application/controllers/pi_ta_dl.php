<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pi_ta_dl extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->layout->ajouter_css('slyset');
        
        $this->load->model('achat_model');
        
        $this->layout->set_id_background('Tunnel d\'achats téléchargements');
    }

    public function index() {
        $this->page();
    }

    public function page() {
        $data = array();

        $data['cmd_download'] = $this->achat_model->cmd_valider();
        $this->layout->view('achat/pi_ta_dl', $data);
    }

}