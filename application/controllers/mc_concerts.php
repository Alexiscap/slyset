<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mc_concerts extends CI_Controller 
{
    
    public function __construct()
    {
      parent::__construct();
      
      $this->layout->ajouter_css('slyset');
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
      
      $this->concert->ajout_concert($this->input->post('artiste'),$this->input->post('snd_partie'),$this->input->post('date_concert'),$this->input->post('heure_concert'),$this->input->post('salle'),$this->input->post('ville'),$this->input->post('prix'));
                               
      $this->layout->view('ajouter_concert');

      
    }
  
  public function page_main()
    {
    
      $this->load->model('concert');
      
      $nbr_concert_par_artiste = $this->concert->count();

      $datas = array();
      $datas['sidebar_left'] = $this->load->view('sidebars/sidebar_left', '', TRUE);
      $datas['sidebar_right'] = $this->load->view('sidebars/sidebar_right', '', TRUE);
      
      //recup des données concert pour l'artiste en bdd
      $datas['concert_all'] = $this->concert->get_concert($nbr_concert_par_artiste,0);
	  // test pour google	  
	  $datas['concert_lieu_salle'] =$datas['concert_all'][0]->lieu ;
	  $datas['concert_lieu_ville'] =$datas['concert_all'][0]->ville ;
	  $datas['concert_main_artiste'] =$datas['concert_all'][0]->titre ;
	  $datas['concert_date'] =$datas['concert_all'][0]->date ;

	
		
	//**************** RECUP COORDONNEES GOOGLE ****************
	
	//**************** RECHERCHERCHE DE LA REFERENCE AVEC VILLE ET SALLE ****************

	  $cpr = curl_init();
	
	  curl_setopt($cpr, CURLOPT_URL,"https://maps.googleapis.com/maps/api/place/textsearch/json?query=".$datas['concert_lieu_salle']."+".$datas['concert_lieu_ville']."&sensor=true&key=AIzaSyCcssc_1iHiNjx3tub8qJ3L3WmpCn-ea5Y");
	  curl_setopt($cpr,CURLOPT_HTTPHEADER,array('Content-Type:application/json'));
	  curl_setopt($cpr,CURLOPT_RETURNTRANSFER,TRUE);

	  $datas['curl'] = curl_exec($cpr);
	  $datas['test'] = json_decode($datas['curl']);
	
	  $url_detail_place =$datas['test']->{'results'}[0]->{"reference"};

	  //*************** AVEC LA REFERENCE : RECUP DES COORDONNEES ****************


	  $cpr2 = curl_init();
	
	  curl_setopt($cpr2, CURLOPT_URL,"https://maps.googleapis.com/maps/api/place/details/json?reference=".$url_detail_place."&sensor=true&key=AIzaSyCcssc_1iHiNjx3tub8qJ3L3WmpCn-ea5Y");
	  curl_setopt($cpr2,CURLOPT_HTTPHEADER,array('Content-Type:application/json'));
	  curl_setopt($cpr2,CURLOPT_RETURNTRANSFER,TRUE);

   	  $datas['curl2'] = curl_exec($cpr2);
	  $datas['test2'] = json_decode($datas['curl2']);
	
	  $datas['phone'] =  $datas['test2']->{'result'}->{'formatted_phone_number'};
	  $datas['website'] =  $datas['test2']->{'result'}->{'website'};
	  $datas['adress_numero_rue'] =  $datas['test2']->{'result'}->{'address_components'}[0]->{'short_name'};
	  $datas['adress_rue'] =  $datas['test2']->{'result'}->{'address_components'}[1]->{'short_name'};
	  //$datas['adress_code_postal'] =  $datas['test2']->{'result'}->{'address_components'}[5]->{'short_name'};


      //$this->layout->views('3');
      $this->layout->view('mc_concerts', $datas);
    }
  
}