<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pi_ta_dl extends CI_Controller 
{
    
    public function __construct()
    {
      parent::__construct();
      
      $this->layout->ajouter_css('slyset');
      
      $this->layout->ajouter_js('jquery.imagesloaded.min');
      $this->layout->ajouter_js('jquery.masonry.min');
      $this->layout->ajouter_js('jquery.stapel');
      
        $this->layout->set_id_background('Tunnel d\'achats téléchargements');
    }
  
    public function index()
    {
      $this->page();
    }
  
    public function page()
    {
    print 'cdcds';
      $data = array();
    
      $data['cmd_download'] = $this->achat->cmd_valider();
      var_dump($cmd_download);
      $this->layout->view('achat/pi_ta_dl', $data);
    }
  
}