<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class melo_concerts extends CI_Controller 
{
    
    public function __construct()
    {
        parent::__construct();

        $this->layout->ajouter_css('slyset');
        $this->layout->ajouter_js('concert');
        $this->layout->ajouter_js('maps_api');
      	$this->layout->ajouter_js('maps-google');
        
        $this->user_authentication->musicien_user_validation();
    }
    
    public function index($user_id,$uid = NULL)

    {    
   // $uid = $this->session->userdata('uid');
 	 //  if( $user_id ==$uid)
  	 	//{
    		$this->page_main($user_id,"concert/melo_concerts",">");
    	//}
    	//else
    	//	{
    	  //    	show_404();
    		//}
    }	
    
    
    
    public function concert_passe($user_id)
  	{
          $uid = $this->session->userdata('uid');

  		// if( $user_id ==$uid)
  	 	//	{
  				$this->page_main($user_id,"concert/melo_concert_passe","<");
  		//	}
    	//else
    	//	{
    	      //	show_404();
    	//	}
  	}	

  	public function page_main($user_id, $moment, $inf_sup)
    {
        $this->load->model('concert');
        $this->load->helper('url');
        $this->load->helper('date');
        
        $datas = array();
        $datas['user_id']   = $user_id;
        $datas['info_user'] = $this->concert->get_user($user_id);
        
        if($datas['info_user'] == null)
        {
            //pour le moment si utilisateur inexistant : 404;
            show_404();
        }
      		
        $datas['nbr_concert_par_artiste'] = $this->concert->count_artiste_concert($user_id, $inf_sup);

        $datas['sidebar_left']  = $this->load->view('sidebars/sidebar_left', '', TRUE);
        $datas['sidebar_right'] = $this->load->view('sidebars/sidebar_right', '', TRUE);

        $datas['concert_all']   = $this->concert->get_concert($datas['nbr_concert_par_artiste'], 0, $user_id, $inf_sup);
   
        function get_date($date_concert, $test)
        {
            //gestion des differents formats d'affichage des dates
            $date_format = (date_create($date_concert, timezone_open('Europe/Paris')));	
            $datas['date_2'] = date_format( $date_format,"N-j-n-Y-G-i");
            $nom_jour_fr= array("","Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi","Dimanche",);
            $mois_fr = array("","janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août","septembre", "octobre", "novembre","Decembre");
            $mois_fr_trois = array("","DEC","jan", "fév", "mar", "avr", "mai", "JUIN", "juil", "août","sept", "oct", "nov","DEC");
            list($nom_jour, $jour_chiffre,$mois_text, $annee,$heure,$minutes) = explode('-', $datas['date_2']);
            $date['complete'] =  $nom_jour_fr[$nom_jour].' '.$jour_chiffre.' '.$mois_fr[$mois_text].' '.$annee.' - '.$heure.'h'.$minutes;
            $date['mois_trois'] = $mois_fr_trois[$mois_text];
            $date['jour_texte'] = $jour_chiffre;
            
            echo $date[$test];
        }	
 
        $this->layout->view('concert/'.$moment, $datas);
    }

  
}