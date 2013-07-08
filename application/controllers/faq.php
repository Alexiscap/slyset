<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class faq extends CI_Controller 
{
    
    public function __construct()
    {
      parent::__construct();
      
      $this->layout->ajouter_css('slyset');
      
      $this->layout->ajouter_js('jquery.imagesloaded.min');
      $this->layout->ajouter_js('jquery.masonry.min');
      $this->layout->ajouter_js('jquery.stapel');
      
        $this->layout->set_id_background('FAQ');
    }
  
    public function index()
    {
      $this->page();
    }
  
    public function page()
    {
      $datas = array();
      $datas['sidebar_left'] = $this->load->view('sidebars/sidebar_left', '', TRUE);
      $datas['sidebar_right'] = $this->load->view('sidebars/sidebar_right', '', TRUE);
      
      //$this->layout->views('3');
      $this->layout->view('faq', $datas);
    }
  
}