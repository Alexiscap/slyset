<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pi_ta_paiement extends CI_Controller 
{
    
    public function __construct()
    {
      parent::__construct();
      
      $this->layout->ajouter_css('slyset');
      
      $this->layout->ajouter_js('jquery.imagesloaded.min');
      $this->layout->ajouter_js('jquery.masonry.min');
      $this->layout->ajouter_js('jquery.stapel');
      $this->load->model('achat');

        $this->layout->set_id_background('Tunnel d\'achats paiement');
    }
  
    public function index()
    {
      $this->page();
    }
  
    public function page()
    {
      $datas = array();
      
      //$this->layout->views('3');
      $this->layout->view('achat/pi_ta_paiement', $datas);
    }
  
  	public function validation_paiement()
  	{
  	date_default_timezone_set('Europe/Paris') ;
  	print $this->session->flashdata('format');
  	$email =  $this->session->flashdata('email');
  	$nom =  $this->session->flashdata('nom');

     $to  = "camille.fenart@gmail.com";

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
     
     $this->achat->panier_to_achat();

  	}
}