<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class melo_achats extends CI_Controller 
{
    
    public function __construct()
    {
      parent::__construct();
      
      $this->layout->ajouter_css('slyset');
      	
    	//	$this->layout->ajouter_css('shadowbox');
     	//   $this->layout->ajouter_js('shadowbox/shadowbox');
            	      	$this->layout->ajouter_js('jquery-1.7.1.min');

        $this->layout->ajouter_js('jquery.colorbox');
    	$this->layout->ajouter_css('colorbox');
      	$this->layout->ajouter_js('jquery.imagesloaded.min');
      	$this->layout->ajouter_js('jquery.masonry.min');
      	$this->layout->ajouter_js('jquery.stapel');
       	$this->load->model('achat');
       	      $this->load->helper('form');
      	$this->layout->ajouter_css('popin');

        $this->layout->set_id_background('achats');
    }
  
    public function index($user_id)
    {
      $this->page($user_id);
    }
  
    public function page($user_id)
    {
    
   // $data = array(
     //      'popin'  => $this->load->view('achat/pi_ta_infos', '', TRUE) 
       //    );
      $data = array();
      $data['sidebar_left'] = $this->load->view('sidebars/sidebar_left', '', TRUE);
      $data['sidebar_right'] = $this->load->view('sidebars/sidebar_right', '', TRUE);
      $data['cmd'] = $this->achat->get_achat($user_id);
      foreach ($data['cmd'] as $commande)
      {
					if($commande->status=="P"&&$commande->Albums_id!=null)
					{
					$data['total_album_panier'] =  count($commande);
					
					} 
					if($commande->status=="P"&&$commande->Morceaux_id!=null)
					{
					$data['total_morceaux_panier'] =  count($commande);
					
					} 
					if($commande->status=="P"&&$commande->Documents_id!=null)
					{
					$data['total_document_panier'] =  count($commande);
					
					} 
						if($commande->status=="V"&&$commande->Albums_id!=null)
					{
					$data['total_album_history'] =  count($commande);
					
					} 
					if($commande->status=="V"&&$commande->Morceaux_id!=null)
					{
					$data['total_morceaux_history'] =  count($commande);
					
					} 
					if($commande->status=="V"&&$commande->Documents_id!=null)
					{
					$data['total_document_history'] =  count($commande);
					
					} 
      
      }
      //$this->layout->views('3');
      
      
      
      $this->layout->view('achat/melo_achats', $data);
    }
  
}