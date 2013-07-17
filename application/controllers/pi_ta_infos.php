<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pi_ta_infos extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->layout->ajouter_css('pop');

        $this->load->helper('form');
        $this->load->model('achat_model');
        $this->load->library('form_validation');

        $this->layout->set_id_background('Tunnel d\'achats infos');
    }

    public function index() {
        $this->page();
    }

}