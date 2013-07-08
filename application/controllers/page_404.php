<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Page_404 extends CI_Controller
{
    
    var $data;
    
    public function __construct() {
        parent::__construct();
//        $this->output->enable_profiler(true);
        $this->layout->ajouter_css('slyset');

        $this->load->helper(array('cookie', 'form'));
        $this->load->model(array('login_model', 'homepage', 'user_model'));

        $this->layout->ajouter_js('jquery.placeheld.min');

        $this->layout->set_id_background('page-404');
        $this->layout->set_description('Page 404 : Aucun réusltat n\'a été trouvé pour votre recherche.');
        $this->layout->set_titre('Page 404 : Aucun résultat trouvé !');
    }

    public function index($session_uid = NULL) {
        $this->output->set_status_header('404');
        $this->layout->view('404');
    }
    
}