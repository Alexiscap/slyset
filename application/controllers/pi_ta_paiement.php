<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pi_ta_paiement extends CI_Controller 
{
    
    public function __construct()
    {
      parent::__construct();
      
     // $this->layout->ajouter_css('slyset');
      
      $this->layout->ajouter_js('jquery.imagesloaded.min');
      $this->layout->ajouter_js('jquery.masonry.min');
      $this->layout->ajouter_js('jquery.stapel');
      $this->load->model('achat');
         $this->load->helper('form');
		$this->load->library('form_validation');

       // $this->layout->set_id_background('Tunnel d\'achats paiement');
    }
  
    public function index()
    {
      $this->page();
    }
  
    public function page()
    {
      $datas = array();
      $this->form_validation->set_rules('code_carte', 'code_carte', 'exact_length[16]|numeric|required');
    $this->form_validation->set_rules('code_secu', 'code_secu', 'exact_length[3]|numeric|required');



      if ($this->form_validation->run() == FALSE)
		{


      $this->load->view('achat/pi_ta_paiement', $datas);
      }
      else
      {
      $this->validation_paiement();
      }
    }
  
  	public function validation_paiement()
  	{
  	//print $this->session->flashdata('format');
  	     $data['cmd'] = $this->achat->get_achat($this->session->userdata('uid'));
  	     
  	     $number_last_commande = $this->achat->number_commande();
		 $data['numero_cmd'] =  $number_last_commande[0]->last_cmd;

			foreach ($data['cmd'] as $commande)
			{
				if($commande->status=="P")
				{
				  	 $this->achat->panier_to_achat($commande->id,$number_last_commande[0]->last_cmd);

				}
			}
  	     //$this->achat->panier_to_achat();

  	$email =  $this->session->flashdata('email');
  	$nom =  $this->session->flashdata('nom');

     $to  = $email;

     $subject = 'test';

     $message = '
     <html>
      <head>
       <title>Facture Slyset</title>
      </head>
      <body>
  		   Bonjour'.$nom.' </br></br>

				Les artistes de Slyset vous remercies de cette commande que vous venez de passer sur notre site internet. </br></br>

				Voici le récapitulatif de votre commande ___________. </br></br>
				Cette commande a été passée ___________date </br></br>

				Numéro de transaction : 24966070 </br></br>

				Nous vous confirmons le bon paiement suivant (Paiement paybox numéro 372-13022423362169999). </br></br>

				Montant TOTAL TTC : 51,60 € (dont 1,00 € de frais de gestion) </br></br>

      </body>
     </html>
     ';
     $headers  = 'MIME-Version: 1.0' . "\r\n";
     $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";



     mail($to, $subject, $message, $headers);
  
    
      $data['cmd_download'] = $this->achat->cmd_valider( $data['numero_cmd']);
      var_dump($data['cmd_download']);
    
		$this->load->view('achat/pi_ta_dl',$data);

	

  	}
}