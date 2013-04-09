<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mc_actus extends CI_Controller
{
    
    public function __construct()
    {
      parent::__construct();
      $this->load->helper('assets_helper');
      $this->load->library('layout');

      $this->layout->ajouter_css('reset');
      $this->layout->ajouter_css('tpl_header-footer');
      $this->layout->ajouter_css('tpl_sidebar-left');
      $this->layout->ajouter_css('tpl_sidebar-right');
      $this->layout->ajouter_css('slyset');
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
      
      $this->layout->view('mc_actus', $datas);
    }
  
}