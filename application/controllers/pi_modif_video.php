<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pi_modif_video extends CI_Controller 
{
    
    public function __construct()
    {
      parent::__construct();
      
      $this->layout->ajouter_css('slyset');
      
      $this->layout->ajouter_js('jquery.imagesloaded.min');
      $this->layout->ajouter_js('jquery.masonry.min');
      $this->layout->ajouter_js('jquery.stapel');
      
        $this->layout->set_id_background('modif_videos');
    }
  
    public function index()
    {
      $this->page();
    }
  
    public function page()
    {
      $datas = array();
      
      //$this->layout->views('3');
      $this->layout->view('pi_modif_video', $datas);
    }
  
}