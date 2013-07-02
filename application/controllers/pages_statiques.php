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

    public function index($page = NULL) {
        if ($page == 'mentions') {
            $this->mentions_legales();
        } elseif ($page == '') {
            $this->test();
        } else {
            redirect('home/'.$this->session_uid, 'refresh');
        }
    }

    public function test() {
        print 'ok test';
    }

    public function mentions_legales() {
        $data = $this->data;

        $this->layout->view('mentions_legales', $data);
    }

}