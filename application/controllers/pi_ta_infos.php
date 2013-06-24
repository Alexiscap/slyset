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
  
    public function page()
    {
      $data = array();
      $this->form_validation->set_rules('email', 'email', 'valid_email');

      $user_id = $this->session->userdata('uid');
     $data['cmd'] = $this->achat->get_achat($user_id);
   
//paiement-commande
if ($this->form_validation->run() == FALSE)
		{
		 $this->load->view('achat/pi_ta_infos', $data);
		 }
		else{
		$this-> validation_commande();
		}
//var_dump($data['cmd']);
      //$this->layout->views('3');
     
    }
  
  	public function validation_commande()
  	{
  	  $format = $this->input->post('format');
  	    	  $email = $this->input->post('email');
  	    	  $nom = $this->input->post('nom');

  //  $this->session->set_flashdata('format', $format);
  $this->session->set_flashdata('email', $email);
  $this->session->set_flashdata('nom', $nom);

		$this->load->view('achat/pi_ta_paiement');
  	}
}