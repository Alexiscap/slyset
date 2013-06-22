<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pi_ta_infos extends CI_Controller 
{
    
    public function __construct()
    {
      parent::__construct();
      
      $this->layout->ajouter_css('slyset');
      
      $this->layout->ajouter_js('jquery.imagesloaded.min');
      $this->layout->ajouter_js('jquery.masonry.min');
      $this->layout->ajouter_js('jquery.stapel');
      $this->load->helper('form');
    $this->load->model('achat');

	  $this->load->library('session');

        $this->layout->set_id_background('Tunnel d\'achats infos');
    }
  
    public function index($user_id)
    {
      $this->page($user_id);
    }
  
    public function page($user_id)
    {
      $data = array();
     $data['cmd'] = $this->achat->get_achat($user_id);
//var_dump($data['cmd']);
      //$this->layout->views('3');
      $this->layout->view('achat/pi_ta_infos', $data);
    }
  
}