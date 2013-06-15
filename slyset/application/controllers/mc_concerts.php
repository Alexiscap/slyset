<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mc_concerts extends CI_Controller 
{
    
    public function __construct()
    {
        parent::__construct();

//        $this->user_authentication->musicien_user_validation();
        $this->layout->ajouter_css('slyset');
    	$this->layout->ajouter_css('colorbox');

        $this->layout->ajouter_js('concert');
        $this->layout->ajouter_js('maps_api');
      	$this->layout->ajouter_js('maps-google');
        $this->layout->ajouter_js('jquery.colorbox');
		$this->load->model('concert');

        $this->load->model(array('perso_model', 'user_model'));
        
        $this->user_id = (is_numeric($this->uri->segment(2))) ? $this->uri->segment(2) : $this->uri->segment(3);
        $output = $this->perso_model->get_perso($this->user_id);
        
        $sub_data = array();
        $sub_data['profile'] = $this->user_model->getUser($this->user_id);
        $sub_data['perso'] = $output;
        
        if(!empty($output)){
            $this->layout->ajouter_dynamique_css($output->theme_css);
            write_css($output);
        }
        
        $this->data = array(
            'sidebar_left'  => $this->load->view('sidebars/sidebar_left', '', TRUE),
            'sidebar_right' => $this->load->view('sidebars/sidebar_right', $sub_data, TRUE)
        );

    }
  
    public function index($user_id,$uid = NULL){    
          $uid = $this->session->userdata('uid');

 	  // if( $user_id ==$uid)
  	 	//{
    		$this->page_main($user_id,"concert/mc_concerts",">");
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
  				$this->page_main($user_id,"concert/mc_concert_passe","<");
  		//	}
    	//else
    	//	{
    	     // 	show_404();
    	//	}
  	}	

  	public function page_main($user_id,$moment,$inf_sup)
    {	   
      	    $uid = $this->session->userdata('uid');
       
      		$this->load->model('concert');
      		$this->load->helper('url');
	  		$this->load->helper('date');
      		$datas = array();
      		$datas['user_id'] = $user_id;
      		$datas['info_user'] = $this->concert->get_user($user_id);
      		if ($datas['info_user']==null)
      			{
      				//pour le moment si utilisateur inexistant : 404;
      				show_404();
      			}
      		
      		$datas['nbr_concert_par_artiste'] = $this->concert->count_artiste_concert($user_id,$inf_sup);

      		$datas['sidebar_left'] = $this->load->view('sidebars/sidebar_left', '', TRUE);
      		$datas['sidebar_right'] = $this->load->view('sidebars/sidebar_right', '', TRUE);
           
      		$datas['concert_all'] = $this->concert->get_concert($datas['nbr_concert_par_artiste'],0,$user_id,$inf_sup);
   
      		function get_date($date_concert,$test)
      			{
					//gestion des differents formats d'affichage des dates
      				$date_format = (date_create($date_concert, timezone_open('Europe/Paris')));	
      				$datas['date_2'] = date_format( $date_format,"N-j-n-Y-G-i");
    				$nom_jour_fr= array("","Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi","Dimanche",);
					$mois_fr = array("","janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août","septembre", "octobre", "novembre","Decembre");
  					$mois_fr_trois = array("","JAN", "FEV", "MAR", "AVR", "MAI", "JUIN", "JUIL", "AOU","SEP", "OCT", "NOV","DEC");
  					list($nom_jour, $jour_chiffre,$mois_text, $annee,$heure,$minutes) = explode('-', $datas['date_2']);
				 	$date['complete'] =  $nom_jour_fr[$nom_jour].' '.$jour_chiffre.' '.$mois_fr[$mois_text].' '.$annee.' - '.$heure.'h'.$minutes;
  		 			$date['mois_trois'] = $mois_fr_trois[$mois_text];
  		   			$date['jour_texte'] = $jour_chiffre;	
  					echo $date[$test];
      			}	
      			
      		$datas['activity'] = $this->concert->get_activity($uid);
      		$datas['all_concert_act'] ="";
      		foreach($datas['activity'] as $datas['activite'])
      		{
      		  	$datas['all_concert_act'] .=
				$datas['activite']->Concerts_id."/";
			}
 
      		$this->layout->view('concert/'.$moment, $datas);
    }
  
  
  
  	public function ajouter_concert($user_id)
    	{
    		if ($user_id != $this->session->userdata('uid'))
    			{
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
	

			  if ($this->form_validation->run() == FALSE)
					{

						$this->load->view('concert/ajouter_concert');
						
					}
			  else
					{
						$datas['concert_lieu_salle'] = $this->input->post('salle');
						$datas['concert_lieu_ville'] = $this->input->post('ville');
      					$mot_uniq_glgle = explode (" ",$datas['concert_lieu_salle']);

						$array_mot = count($mot_uniq_glgle);
						$datas['concert_lieu_salle_plus'] = "";
						for ($i=0;$i<$array_mot;$i++)
							{
								$datas['concert_lieu_salle_plus'].=
								$mot_uniq_glgle[$i].'+';
							}
      					//ajouter des + a chaque espace -> sinon aucune recherche google
  					   	if(isset($datas['concert_lieu_ville']))
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
											{
	  											curl_setopt($cpr2, CURLOPT_URL,"https://maps.googleapis.com/maps/api/place/details/json?reference=".$url_detail_place."&sensor=true&key=AIzaSyCcssc_1iHiNjx3tub8qJ3L3WmpCn-ea5Y");
	 											curl_setopt($cpr2,CURLOPT_HTTPHEADER,array('Content-Type:application/json'));
	 											curl_setopt($cpr2,CURLOPT_RETURNTRANSFER,TRUE);

   	  											$datas['curl2'] = curl_exec($cpr2);
	  											$datas['test2'] = json_decode($datas['curl2']);
 
 												if(isset($datas['test2']))
													{
			 											$phone =  $datas['test2']->{'result'}->{'formatted_phone_number'};
			 	
	 													$website =  $datas['test2']->{'result'}->{'website'};
	 													$adress_component = $datas['test2']->{'result'}->{'address_components'};
														$nbr_componenent =  count($adress_component);
	  													for ($i = 0;$i<$nbr_componenent;$i++) 
	  														{
	  														//modifier: m ettre case
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
	  												}

											}
		
										$this->concert->ajout_concert_data ($this->input->post('ville'),$pays,$code_postal,$route,$street_number,$this->input->post('artiste'),$this->input->post('snd_partie'),$this->input->post('salle'),$this->input->post('prix'),$this->input->post('heure_concert'),$this->input->post('date_concert'),$user_id,$phone,$website);

		
			

		
					}
		   				
		   				$this->load->view('concert/success-concert');
		   				
						//redirect('mc_concerts','refresh');

   					 }
  
  
		}
		
		
		
	
  	public function modifier_concert($user_id,$concert_id,$adresse_id)
    	{
    		if ($user_id != $this->session->userdata('uid'))
    		{
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
		
			  $datas = array();
		      $datas['info_concert'] = $this->concert->get_one_concert($concert_id);
	//var_dump($datas['info_concert']);
	
			  if ($this->form_validation->run() == FALSE)
					{
						
						$this->load->view('concert/modifier_concert',$datas);
						
					}
			  else
					{
						$datas['concert_lieu_salle'] = $this->input->post('salle');
						$datas['concert_lieu_ville'] = $this->input->post('ville');					
	
						$mot_uniq_glgle = explode (" ",$datas['concert_lieu_salle']);

						$array_mot = count($mot_uniq_glgle);
						$datas['concert_lieu_salle_plus'] = "";
						for ($i=0;$i<$array_mot;$i++)
							{
								$datas['concert_lieu_salle_plus'].=
								$mot_uniq_glgle[$i].'+';
							}	  							
						
      					//ajouter des + a chaque espace -> sinon aucune recherche google
  					   	if(isset($datas['concert_lieu_ville'])||isset($datas['concert_lieu_salle'])||$datas['concert_lieu_salle']!=$datas['info_concert'][0]->{'salle'}||$datas['concert_lieu_ville']!=$datas['info_concert'][0]->{'ville'})
     					 	{
      							$cpr = curl_init();
			
	 							curl_setopt($cpr, CURLOPT_URL,"https://maps.googleapis.com/maps/api/place/textsearch/json?query=".$datas['concert_lieu_salle_plus']."+".$datas['concert_lieu_ville']."&sensor=true&key=AIzaSyCcssc_1iHiNjx3tub8qJ3L3WmpCn-ea5Y");
	  							curl_setopt($cpr,CURLOPT_HTTPHEADER,array('Content-Type:application/json'));
	  							curl_setopt($cpr,CURLOPT_RETURNTRANSFER,TRUE);

	  							$datas['curl'] = curl_exec($cpr);
								$datas['test'] = json_decode($datas['curl']);
								//var_dump( $datas['test']) ;
								if (isset($datas['test']->{'results'}[0]))
									{
	 									 $url_detail_place =$datas['test']->{'results'}[0]->{"reference"};
	  			  
	  			 						 //*************** AVEC LA REFERENCE : RECUP DES COORDONNEES ****************
									
	 									$cpr2 = curl_init();
			
										if (isset($url_detail_place))
											{
	  											curl_setopt($cpr2, CURLOPT_URL,"https://maps.googleapis.com/maps/api/place/details/json?reference=".$url_detail_place."&sensor=true&key=AIzaSyCcssc_1iHiNjx3tub8qJ3L3WmpCn-ea5Y");
	 											curl_setopt($cpr2,CURLOPT_HTTPHEADER,array('Content-Type:application/json'));
	 											curl_setopt($cpr2,CURLOPT_RETURNTRANSFER,TRUE);

   	  											$datas['curl2'] = curl_exec($cpr2);
	  											$datas['test2'] = json_decode($datas['curl2']);
 
 												if(isset($datas['test2']))
													{
			 											$phone =  $datas['test2']->{'result'}->{'formatted_phone_number'};
	 													$website =  $datas['test2']->{'result'}->{'website'};
	 													$adress_component = $datas['test2']->{'result'}->{'address_components'};
														$nbr_componenent =  count($adress_component);
	  													for ($i = 0;$i<$nbr_componenent;$i++) 
	  														{
	  														//modifier: m ettre case
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
	  												}

											}

		
									}

		
							} 
						

						$this->concert->update_concert_data($this->input->post('ville'),$pays,$code_postal,$route,$street_number,$this->input->post('artiste'),$this->input->post('snd_partie'),$this->input->post('salle'),$this->input->post('prix'),$this->input->post('heure_concert'),$this->input->post('date_concert'),$concert_id,$adresse_id,$phone,$website);

			
		   				
		   				//$this->layout->view('mc_concerts');
		   				
		   				$this->load->view('concert/success-concert');

   					 }
  
  
		}
		
	public function suppression_concert($user_id,$concert_id,$adresse_id)
		{			
		    $this->load->model('concert');
		    $this->load->helper('form');
         	$this->load->library('form_validation');
			$datas = array();
    		if ($user_id != $this->session->userdata('uid'))
    		{
    			show_404();
    		}		

			 if($this->input->post("delete"))
			 {
    				$this->concert->delete_concert_data($concert_id,$adresse_id);
    				$this->load->view('concert/success-concert');

    				
			 }
			 echo $this->input->post("no_delete");
			{
				//CLOSE POP UP
			}
			
		$this->load->view('concert/suppression_concert',$datas);
		
		}
		
	public function add_activity_concert()
		{
			$uid = $this->session->userdata('uid');
			$id_concert = $this->input->post('id_concert');
			$this->concert->add_activity($id_concert,$uid);
			
			

		}
	public function delete_activity_concert()
		{
			$uid = $this->session->userdata('uid');
			$id_concert = $this->input->post('id_concert');
			$this->concert->delete_activity($id_concert,$uid);

		}
		
  
}