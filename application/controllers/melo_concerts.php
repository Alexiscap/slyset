<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class melo_concerts extends CI_Controller 
{
    
    public function __construct()
    {
        parent::__construct();

<<<<<<< HEAD
        $this->user_authentication->musicien_user_validation();
=======
>>>>>>> 0a5f106366459ee42989c8cd393a8c35e10afe2d
        $this->layout->ajouter_css('slyset');
        $this->layout->ajouter_js('concert');
        $this->layout->ajouter_js('maps_api');
      	$this->layout->ajouter_js('maps-google');
<<<<<<< HEAD

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
=======
        
        $this->user_authentication->musicien_user_validation();
    }
    
    public function index($user_id, $uid = NULL)
    {    
        $uid = $this->session->userdata('uid');
        
        if( $user_id ==$uid){
            $this->page_main($user_id,"melo_concerts",">");
        } else {
            show_404();
        }
>>>>>>> 0a5f106366459ee42989c8cd393a8c35e10afe2d
    }	
    
    
    public function concert_passe($user_id)
  	{
<<<<<<< HEAD
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

  	public function page_main($user_id,$moment,$inf_sup)
    {	

      		$this->load->model('melo_concert');
      		$this->load->helper('url');
	  		$this->load->helper('date');
      		$datas = array();
      		$datas['user_id'] = $user_id;
      		$datas['info_user'] = $this->melo_concert->get_user($user_id);
      		if ($datas['info_user']==null)
      			{
      				//pour le moment si utilisateur inexistant : 404;
      				show_404();
      			}
      		
      		$datas['nbr_concert_par_melo'] = $this->melo_concert->count_melo_concert($user_id,$inf_sup);

      		$datas['sidebar_left'] = $this->load->view('sidebars/sidebar_left', '', TRUE);
      		$datas['sidebar_right'] = $this->load->view('sidebars/sidebar_right', '', TRUE);
           
      		$datas['concert_all'] = $this->melo_concert->get_concert($datas['nbr_concert_par_melo'],0,$user_id,$inf_sup);
      		function get_date($date_concert,$test)
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
      			
      					$datas['activity'] = $this->melo_concert->get_activity($user_id);
      		$datas['all_concert_act'] ="";
      		foreach($datas['activity'] as $datas['activite'])
      		{
      		  	$datas['all_concert_act'] .=
				$datas['activite']->Concerts_id."/";
			}
 
      		$this->layout->view($moment, $datas);
    }
  

=======
        $uid = $this->session->userdata('uid');

        if($user_id == $uid){
            $this->page_main($user_id,"melo_concert_passe","<");
  			} else {
            show_404();
    		}
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

  	public function ajouter_concert($user_id)
    {
        if($user_id != $this->session->userdata('uid')){
            show_404();
        }
        
        $this->load->model('concert');
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('<div class="error-form">', '</div>');

		 	  $this->form_validation->set_rules('artiste', 'Artiste', 'required');
        $this->form_validation->set_rules('date_concert', 'Date concert', 'required');
        $this->form_validation->set_rules('salle', 'Salle', 'required');
        $this->form_validation->set_rules('ville', 'Ville', 'required');
		
		//**************** RECUP COORDONNEES GOOGLE ****************
	
		//**************** RECHERCHERCHE DE LA REFERENCE AVEC VILLE ET SALLE ****************
	

			  if ($this->form_validation->run() == FALSE){
            $this->layout->view('concert/ajouter_concert');
				} else {
						$datas['concert_lieu_salle'] = $this->input->post('salle');
						$datas['concert_lieu_ville'] = $this->input->post('ville');
            
            //ajouter des + a chaque espace -> sinon aucune recherche google
            if(isset($datas['concert_lieu_ville'])){
                $cpr = curl_init();
			
	 							curl_setopt($cpr, CURLOPT_URL, "https://maps.googleapis.com/maps/api/place/textsearch/json?query=".$datas['concert_lieu_salle']."+".$datas['concert_lieu_ville']."&sensor=true&key=AIzaSyCcssc_1iHiNjx3tub8qJ3L3WmpCn-ea5Y");
                curl_setopt($cpr,CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                curl_setopt($cpr,CURLOPT_RETURNTRANSFER, TRUE);

                $datas['curl'] = curl_exec($cpr);
								$datas['test'] = json_decode($datas['curl']);
                
								//var_dump( $datas['test']) ;
								if(isset($datas['test']->{'results'}[0])){
                    $url_detail_place =$datas['test']->{'results'}[0]->{"reference"};
	  			  
                    //*************** AVEC LA REFERENCE : RECUP DES COORDONNEES ****************
                }
                
                $cpr2 = curl_init();
			
                if(isset($url_detail_place)){
                    curl_setopt($cpr2, CURLOPT_URL, "https://maps.googleapis.com/maps/api/place/details/json?reference=".$url_detail_place."&sensor=true&key=AIzaSyCcssc_1iHiNjx3tub8qJ3L3WmpCn-ea5Y");
                    curl_setopt($cpr2, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                    curl_setopt($cpr2, CURLOPT_RETURNTRANSFER, TRUE);

                    $datas['curl2'] = curl_exec($cpr2);
                    $datas['test2'] = json_decode($datas['curl2']);
 
                    if(isset($datas['test2'])){
                        $datas['phone']   =  $datas['test2']->{'result'}->{'formatted_phone_number'};
			 	
                        $datas['website'] =  $datas['test2']->{'result'}->{'website'};
                        $adress_component = $datas['test2']->{'result'}->{'address_components'};
                        $nbr_componenent  =  count($adress_component);
                        
                        for($i = 0; $i<$nbr_componenent; $i++){
                            //modifier: m ettre case
                            if($adress_component[$i]->{'types'}[0]=='street_number'){
                                $street_number =  $adress_component[$i]->{'short_name'};
                            }
	  				
                            if($adress_component[$i]->{'types'}[0]=='route'){
                                $route = $adress_component[$i]->{'short_name'};  			
                            }

                            if($adress_component[$i]->{'types'}[0]=='postal_code'){
                                $code_postal = $adress_component[$i]->{'short_name'};  			
                            }
                            
                            if($adress_component[$i]->{'types'}[0]=='country'){
                                $pays = $adress_component[$i]->{'short_name'};  			
                            }
                        }
                    }
                }
		
                $this->concert->ajout_concert_data($this->input->post('ville'), $pays, $code_postal, $route, $street_number, $this->input->post('artiste'), $this->input->post('snd_partie'), $this->input->post('salle'), $this->input->post('prix'), $this->input->post('heure_concert'), $this->input->post('date_concert'), $user_id);
            }
		   				
            $this->layout->view('concert/melo_concerts');
		   				
						redirect('mc_concerts','refresh');
        } 
		}
    
  	public function modifier_concert($concert_id, $adresse_id)
    {
        if($user_id != $this->session->userdata('uid')){
            show_404();
    		}
        
        $this->load->model('concert');
        $this->load->helper('form');
        $this->load->library('form_validation');

        //**************** RECUP COORDONNEES GOOGLE ****************

        //**************** RECHERCHERCHE DE LA REFERENCE AVEC VILLE ET SALLE ****************

		 	  $this->form_validation->set_rules('artiste', 'Artiste', 'required');
        $this->form_validation->set_rules('date_concert', 'Date concert', 'required');
        $this->form_validation->set_rules('salle', 'Salle', 'required');
        $this->form_validation->set_rules('ville', 'Ville', 'required');
		
			  if($this->form_validation->run() == FALSE){
						$this->layout->view('concert/modifier_concert');
        } else {
						$datas['concert_lieu_salle'] = $this->input->post('salle');
						$datas['concert_lieu_ville'] = $this->input->post('ville');
            
            //ajouter des + a chaque espace -> sinon aucune recherche google
            if(isset($datas['concert_lieu_ville'])){
                $cpr = curl_init();
			
	 							curl_setopt($cpr, CURLOPT_URL, "https://maps.googleapis.com/maps/api/place/textsearch/json?query=".$datas['concert_lieu_salle']."+".$datas['concert_lieu_ville']."&sensor=true&key=AIzaSyCcssc_1iHiNjx3tub8qJ3L3WmpCn-ea5Y");
                curl_setopt($cpr, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                curl_setopt($cpr, CURLOPT_RETURNTRANSFER, TRUE);

                $datas['curl'] = curl_exec($cpr);
								$datas['test'] = json_decode($datas['curl']);
                
								//var_dump( $datas['test']) ;
								if(isset($datas['test']->{'results'}[0])){
                    $url_detail_place =$datas['test']->{'results'}[0]->{"reference"};
	  			  
                    //*************** AVEC LA REFERENCE : RECUP DES COORDONNEES ****************
                    
	 									$cpr2 = curl_init();
			
										if(isset($url_detail_place)){
                        curl_setopt($cpr2, CURLOPT_URL, "https://maps.googleapis.com/maps/api/place/details/json?reference=".$url_detail_place."&sensor=true&key=AIzaSyCcssc_1iHiNjx3tub8qJ3L3WmpCn-ea5Y");
	 											curl_setopt($cpr2, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
	 											curl_setopt($cpr2, CURLOPT_RETURNTRANSFER, TRUE);

                        $datas['curl2'] = curl_exec($cpr2);
                        $datas['test2'] = json_decode($datas['curl2']);
 
 												if(isset($datas['test2'])){
                            $datas['phone'] = $datas['test2']->{'result'}->{'formatted_phone_number'};
			 	
	 													$datas['website'] = $datas['test2']->{'result'}->{'website'};
	 													$adress_component = $datas['test2']->{'result'}->{'address_components'};
														$nbr_componenent  =  count($adress_component);
                            
                            for($i = 0;$i<$nbr_componenent;$i++){
                                //modifier: m ettre case
                                if($adress_component[$i]->{'types'}[0]=='street_number'){
                                    $street_number =  $adress_component[$i]->{'short_name'};
                                }
	  				
                                if($adress_component[$i]->{'types'}[0]=='route'){
                                    $route = $adress_component[$i]->{'short_name'};  			
                                }

                                if($adress_component[$i]->{'types'}[0]=='postal_code'){
                                    $code_postal = $adress_component[$i]->{'short_name'};  			
                                }
                                  
                                if($adress_component[$i]->{'types'}[0]=='country'){
                                    $pays = $adress_component[$i]->{'short_name'};  			
                                }
                            }
                        }
                    }
                    
										$this->concert->update_concert_data($this->input->post('ville'), $pays, $code_postal, $route, $street_number, $this->input->post('artiste'), $this->input->post('snd_partie'), $this->input->post('salle'), $this->input->post('prix'), $this->input->post('heure_concert'), $this->input->post('date_concert'), $concert_id, $adresse_id);
                }
            } 
						
            //$this->layout->view('mc_concerts');

            redirect('mc_concerts','refresh');
        }
		}
  
>>>>>>> 0a5f106366459ee42989c8cd393a8c35e10afe2d
}