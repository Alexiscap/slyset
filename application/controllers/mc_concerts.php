<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mc_concerts extends CI_Controller 
{
    
    public function __construct()
    {
      parent::__construct();
      
      $this->layout->ajouter_css('slyset');
      $this->layout->ajouter_js('concert');

    }
  
    public function index()
    {
      $this->page_main();
    }
    

  public function page_main()
    {
    
      $this->load->model('concert');
	  $this->load->helper('date');

      $datas = array();

      $datas['nbr_concert_par_artiste'] = $this->concert->count();
      $datas['sidebar_left'] = $this->load->view('sidebars/sidebar_left', '', TRUE);
      $datas['sidebar_right'] = $this->load->view('sidebars/sidebar_right', '', TRUE);
           
      $datas['concert_all'] = $this->concert->get_concert($datas['nbr_concert_par_artiste'],0);
   
      function get_date($date_concert,$test)
      {
  

      		$date_format = (date_create($date_concert, timezone_open('Europe/Paris')));	
      		$datas['date_2'] = date_format( $date_format,"N-j-n-Y-G-i");
    		$nom_jour_fr= array("Dimanche","Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");
			$mois_fr = array("janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août","septembre", "octobre", "novembre", "décembre");
  			$mois_fr_trois = array("jan", "fév", "mar", "avr", "mai", "JUIN", "juil", "août","sept", "oct", "nov", "déc");

  			list($nom_jour, $jour_chiffre,$mois_text, $annee,$heure,$minutes) = explode('-', $datas['date_2']);
			//$datas['jour_texte'] = $nom_jour_fr[$nom_jour];
		 	$date['complete'] =  $nom_jour_fr[$nom_jour].' '.$jour_chiffre.' '.$mois_fr[$mois_text].' '.$annee.' - '.$heure.'h'.$minutes;
  		 	$date['mois_trois'] = $mois_fr_trois[$mois_text];
  		    $date['jour_texte'] = $jour_chiffre;
			
  			echo $date[$test];
      }

        
   
   
      $this->layout->view('mc_concerts', $datas);
    }
  
  	public function ajouter_concert()
    {

    
          $this->load->model('concert');
          $this->load->helper('form');

//quand profil utilisateur creer pense a ajouter "utilisateur_id de 
//la table artiste dans le champs artiste_id de la table concert
      
//quand profil utilisateur pret -> penser a ajouter "utilisateur_id 
			
		//**************** RECUP COORDONNEES GOOGLE ****************
	
		//**************** RECHERCHERCHE DE LA REFERENCE AVEC VILLE ET SALLE ****************
	
		$datas['concert_lieu_salle'] = $this->input->post('salle');
		$datas['concert_lieu_ville'] = $this->input->post('ville');
      	 //ajouter des + a chaque espace -> sinon aucune recherche google
      /*	if(isset($datas['concert_lieu_ville']))
      	{
      		$cpr = curl_init();
			
	 		curl_setopt($cpr, CURLOPT_URL,"https://maps.googleapis.com/maps/api/place/textsearch/json?query=".$datas['concert_lieu_salle']."+".$datas['concert_lieu_ville']."&sensor=true&key=AIzaSyCcssc_1iHiNjx3tub8qJ3L3WmpCn-ea5Y");
	  		curl_setopt($cpr,CURLOPT_HTTPHEADER,array('Content-Type:application/json'));
	  		curl_setopt($cpr,CURLOPT_RETURNTRANSFER,TRUE);

	  		$datas['curl'] = curl_exec($cpr);
			$datas['test'] = json_decode($datas['curl']);
			//var_dump( $datas['test']) ;
			if (isset($datas['test']->{'results'}[0]))
			{
	 			 $url_detail_place =$datas['test']->{'results'}[0]->{"reference"};
	  			  
	  			  //*************** AVEC LA REFERENCE : RECUP DES COORDONNEES ****************
			}
	 		$cpr2 = curl_init();
			
			if (isset($url_detail_place))
	  			curl_setopt($cpr2, CURLOPT_URL,"https://maps.googleapis.com/maps/api/place/details/json?reference=".$url_detail_place."&sensor=true&key=AIzaSyCcssc_1iHiNjx3tub8qJ3L3WmpCn-ea5Y");
	 		curl_setopt($cpr2,CURLOPT_HTTPHEADER,array('Content-Type:application/json'));
	 		curl_setopt($cpr2,CURLOPT_RETURNTRANSFER,TRUE);

   	  		$datas['curl2'] = curl_exec($cpr2);
	  		$datas['test2'] = json_decode($datas['curl2']);
 
 			if(isset($datas['test2']))
			{
			 	$datas['phone'] =  $datas['test2']->{'result'}->{'formatted_phone_number'};
			 	
	 			$datas['website'] =  $datas['test2']->{'result'}->{'website'};
	 			$adress_component = $datas['test2']->{'result'}->{'address_components'};
				$nbr_componenent =  count($adress_component);
	  			for ($i = 0;$i<$nbr_componenent;$i++) 
	  			{
	  				if($adress_component[$i]->{'types'}[0]=='street_number')
	  				{
	  					$street_number =  $adress_component[$i]->{'short_name'};
	  				}
	  				
  					if($adress_component[$i]->{'types'}[0]=='route')
	  				{
		  				$route = $adress_component[$i]->{'short_name'};  			
	  				}
	  				
	  				if($adress_component[$i]->{'types'}[0]=='postal_code')
	  				{
		  				$code_postal = $adress_component[$i]->{'short_name'};  			
	  				}
	  				if($adress_component[$i]->{'types'}[0]=='country')
	  				{
		  				$pays = $adress_component[$i]->{'short_name'};  			
	  				}
   				}
				$this->concert->ajout_adresse($this->input->post('ville'),$pays,$code_postal,$route,$street_number);
	  		}

		}
		*/
		
		
			$this->concert->ajout_concert($this->input->post('artiste'),$this->input->post('snd_partie'),$this->input->post('salle'),$this->input->post('prix'),$this->input->post('heure_concert'),$this->input->post('date_concert'));
        
      $this->layout->view('ajouter_concert');

      
    }
  
  
}