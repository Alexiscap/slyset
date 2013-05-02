<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Facebooklocal extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Facebook_Model');
        $this->load->helper('url');
    }

    public function index() {
        $fb_data = $this->session->userdata('fb_data');

        print_r($fb_data);

            $data = array(
                'fb_data' => $fb_data,
            );
            
        $this->load->view('inscription/loginform2', $data);
    }

}