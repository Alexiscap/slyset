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
    
	public function ajouter_concert()
    {
    
          $this->load->model('concert');
//quand profil utilisateur creer pense a ajouter "utilisateur_id de 
//la table artiste dans le champs artiste_id de la table concert
      
//quand profil utilisateur pret -> penser a ajouter "utilisateur_id 
			
		//**************** RECUP COORDONNEES GOOGLE ****************
	
		//**************** RECHERCHERCHE DE LA REFERENCE AVEC VILLE ET SALLE ****************
	
		$datas['concert_lieu_salle'] = $this->input->post('salle');
		$datas['concert_lieu_ville'] = $this->input->post('ville');
      	 //ajouter des + a chaque espace -> sinon aucune recherche google
      	if(isset($datas['concert_lieu_ville']))
      	{
      		$cpr = curl_init();
			
	 		curl_setopt($cpr, CURLOPT_URL,"https://maps.googleapis.com/maps/api/place/textsearch/json?query=".$datas['concert_lieu_salle']."+".$datas['concert_lieu_ville']."&sensor=true&key=AIzaSyCcssc_1iHiNjx3tub8qJ3L3WmpCn-ea5Y");
	  		curl_setopt($cpr,CURLOPT_HTTPHEADER,array('Content-Type:application/json'));
	  		curl_setopt($cpr,CURLOPT_RETURNTRANSFER,TRUE);

	  		$datas['curl'] = curl_exec($cpr);
			$datas['test'] = json_decode($datas['curl']);
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

	  			for ($i = 0;$i<7;$i++) 
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
//        		$this->concert->ajout_adresse($this->input->post('ville'),$pays,$code_postal,$route,$street_number);
   				}
	
	  		}

		}
			
		$this->concert->ajout_concert($this->input->post('artiste'),$this->input->post('snd_partie'),$this->input->post('date_concert'),$this->input->post('heure_concert'),$this->input->post('salle'),$this->input->post('prix'));
                               
      $this->layout->view('ajouter_concert');

      
    }
  
  public function page_main()
    {
    
      $this->load->model('concert');
   
      $datas = array();

      $datas['nbr_concert_par_artiste'] = $this->concert->count();
      $datas['sidebar_left'] = $this->load->view('sidebars/sidebar_left', '', TRUE);
      $datas['sidebar_right'] = $this->load->view('sidebars/sidebar_right', '', TRUE);
           
      $datas['concert_all'] = $this->concert->get_concert($datas['nbr_concert_par_artiste'],0);
     
   
      $this->layout->view('mc_concerts', $datas);
    }
  
}