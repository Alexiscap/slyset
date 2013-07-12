<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pi_ta_infos extends CI_Controller 
{
    
    public function __construct()
    {
      parent::__construct();
      
      $this->layout->ajouter_css('pop');
      
      $this->layout->ajouter_js('jquery.imagesloaded.min');
      $this->layout->ajouter_js('jquery.masonry.min');
      $this->layout->ajouter_js('jquery.stapel');
      $this->load->helper('form');
    	$this->load->model('achat');
		$this->load->library('form_validation');

	  $this->load->library('session');

        $this->layout->set_id_background('Tunnel d\'achats infos');
    }
  
    public function index()
    {
      $this->page();
    }
  

}