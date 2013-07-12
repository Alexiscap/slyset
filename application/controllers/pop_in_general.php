<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pop_in_general extends CI_Controller 
{

    public function __construct() {
        parent::__construct();


   		$this->load->model(array('perso_model','concert','photos','achat'));
        $this->user_id = (is_numeric($this->uri->segment(2))) ? $this->uri->segment(2) : $this->uri->segment(3);
        $output = $this->perso_model->get_perso($this->user_id);
      	$this->layout->ajouter_css('pop');
	  	$this->load->library('session');

	 	$this->load->helper('form');
    	$this->load->library('form_validation');

        $sub_data = array();
        $sub_data['profile'] = $this->user_model->getUser($this->user_id);
        $sub_data['perso'] = $output;

      

        if (!empty($output)) {
            $this->layout->ajouter_dynamique_css($output->theme_css);
            write_css($output);
        }

        $this->data = array(
            'sidebar_left' => $this->load->view('sidebars/sidebar_left', '', TRUE),
            'sidebar_right' => $this->load->view('sidebars/sidebar_right', $sub_data, TRUE),
        );
    }
	// ---- - - --- - - - - - - Pop in Concert - - - - - - - -  --  -- 

	public function ajouter_concert($user_id) {
        if ($user_id != $this->session->userdata('uid')) {
            show_404();
        }

        $this->load->helper('form');
        $this->load->library('form_validation');


        $this->form_validation->set_error_delimiters('<div class="error-form">', '</div>');

        $this->form_validation->set_rules('artiste', 'Artiste', 'required');
        $this->form_validation->set_rules('date_concert', 'Date concert', 'required');
        $this->form_validation->set_rules('salle', 'Salle', 'required');
        $this->form_validation->set_rules('ville', 'Ville', 'required');

        //**************** RECUP COORDONNEES GOOGLE ****************
        //**************** RECHERCHERCHE DE LA REFERENCE AVEC VILLE ET SALLE ****************


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('concert/ajouter_concert');
        } else {
            $data['concert_lieu_salle'] = $this->input->post('salle');
            $data['concert_lieu_ville'] = $this->input->post('ville');
            $mot_uniq_glgle = explode(" ", $data['concert_lieu_salle']);

            $array_mot = count($mot_uniq_glgle);
            $data['concert_lieu_salle_plus'] = "";
            for ($i = 0; $i < $array_mot; $i++) {
                $data['concert_lieu_salle_plus'].= $mot_uniq_glgle[$i] . '+';
            }
            //ajouter des + a chaque espace -> sinon aucune recherche google
            if (isset($data['concert_lieu_ville'])) {
                $cpr = curl_init();

                curl_setopt($cpr, CURLOPT_URL, "https://maps.googleapis.com/maps/api/place/textsearch/json?query=" . $data['concert_lieu_salle_plus'] . "+" . $data['concert_lieu_ville'] . "&sensor=true&key=AIzaSyCcssc_1iHiNjx3tub8qJ3L3WmpCn-ea5Y");
                curl_setopt($cpr, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                curl_setopt($cpr, CURLOPT_RETURNTRANSFER, TRUE);

                $data['curl'] = curl_exec($cpr);
                $data['test'] = json_decode($data['curl']);
                //var_dump( $data['test']) ;
                if (isset($data['test']->{'results'}[0])) {
                    $url_detail_place = $data['test']->{'results'}[0]->{"reference"};

                    //*************** AVEC LA REFERENCE : RECUP DES COORDONNEES ****************
                }
                $cpr2 = curl_init(); 
                $pays = null; $code_postal = null; $route = null; $street_number = null; $phone =null; $website = null;
                if (isset($url_detail_place)) {
                    curl_setopt($cpr2, CURLOPT_URL, "https://maps.googleapis.com/maps/api/place/details/json?reference=" . $url_detail_place . "&sensor=true&key=AIzaSyCcssc_1iHiNjx3tub8qJ3L3WmpCn-ea5Y");
                    curl_setopt($cpr2, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                    curl_setopt($cpr2, CURLOPT_RETURNTRANSFER, TRUE);

                    $data['curl2'] = curl_exec($cpr2);
                    $data['test2'] = json_decode($data['curl2']);

                    if (isset($data['test2'])) {
                        $phone = $data['test2']->{'result'}->{'formatted_phone_number'};

                        $website = $data['test2']->{'result'}->{'website'};
                        $adress_component = $data['test2']->{'result'}->{'address_components'};
                        $nbr_componenent = count($adress_component);
                        for ($i = 0; $i < $nbr_componenent; $i++) {
                            //modifier: m ettre case
                            if ($adress_component[$i]->{'types'}[0] == 'street_number') {
                                $street_number = $adress_component[$i]->{'short_name'};
                            }
                            if ($adress_component[$i]->{'types'}[0] == 'route') {
                                $route = $adress_component[$i]->{'short_name'};
                            }

                            if ($adress_component[$i]->{'types'}[0] == 'postal_code') {
                                $code_postal = $adress_component[$i]->{'short_name'};
                            }
                            if ($adress_component[$i]->{'types'}[0] == 'country') {
                                $pays = $adress_component[$i]->{'short_name'};
                            }
                        }
                    }
                }

                $this->concert->ajout_concert_data($this->input->post('ville'), $pays, $code_postal, $route, $street_number, $this->input->post('artiste'), $this->input->post('snd_partie'), $this->input->post('salle'), $this->input->post('prix'), $this->input->post('heure_concert'), $this->input->post('date_concert'), $user_id, $phone, $website);
            }
			$data_success['status'] = 'ajouté';
            $this->load->view('concert/success-concert',$data_success);

            //redirect('mc_concerts','refresh');
        }
    }
    
    public function modifier_concert($infos_profile = NULL, $concert_id, $adresse_id) {
        if ($infos_profile != $this->session->userdata('uid')) {
            show_404();
        }

        $this->load->helper('form');
        $this->load->library('form_validation');

        $data = $this->data;


        //**************** RECUP COORDONNEES GOOGLE ****************
        //**************** RECHERCHERCHE DE LA REFERENCE AVEC VILLE ET SALLE ****************

        $this->form_validation->set_rules('artiste', 'Artiste', 'required');
        $this->form_validation->set_rules('date_concert', 'Date concert', 'required');
        $this->form_validation->set_rules('salle', 'Salle', 'required');
        $this->form_validation->set_rules('ville', 'Ville', 'required');

//    $data = array();
        $data['info_concert'] = $this->concert->get_one_concert($concert_id);
        //var_dump($data['info_concert']);

        if ($this->form_validation->run() == FALSE) {

            $this->load->view('concert/modifier_concert', $data);
        } else {
            $data['concert_lieu_salle'] = $this->input->post('salle');
            $data['concert_lieu_ville'] = $this->input->post('ville');

            $mot_uniq_glgle = explode(" ", $data['concert_lieu_salle']);

            $array_mot = count($mot_uniq_glgle);
            $data['concert_lieu_salle_plus'] = "";
            for ($i = 0; $i < $array_mot; $i++) {
                $data['concert_lieu_salle_plus'].=
                        $mot_uniq_glgle[$i] . '+';
            }

            //ajouter des + a chaque espace -> sinon aucune recherche google
            if (isset($data['concert_lieu_ville']) || isset($data['concert_lieu_salle']) || $data['concert_lieu_salle'] != $data['info_concert'][0]->{'salle'} || $data['concert_lieu_ville'] != $data['info_concert'][0]->{'ville'}) {
                $cpr = curl_init();

                curl_setopt($cpr, CURLOPT_URL, "https://maps.googleapis.com/maps/api/place/textsearch/json?query=" . $data['concert_lieu_salle_plus'] . "+" . $data['concert_lieu_ville'] . "&sensor=true&key=AIzaSyCcssc_1iHiNjx3tub8qJ3L3WmpCn-ea5Y");
                curl_setopt($cpr, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                curl_setopt($cpr, CURLOPT_RETURNTRANSFER, TRUE);

                $data['curl'] = curl_exec($cpr);
                $data['test'] = json_decode($data['curl']);
                //var_dump( $data['test']) ;
                if (isset($data['test']->{'results'}[0])) {
                    $url_detail_place = $data['test']->{'results'}[0]->{"reference"};

                    //*************** AVEC LA REFERENCE : RECUP DES COORDONNEES ****************

                    $cpr2 = curl_init();
                	$pays = null; $code_postal = null; $route = null; $street_number = null; $phone =null; $website = null;

                    if (isset($url_detail_place)) {
                        curl_setopt($cpr2, CURLOPT_URL, "https://maps.googleapis.com/maps/api/place/details/json?reference=" . $url_detail_place . "&sensor=true&key=AIzaSyCcssc_1iHiNjx3tub8qJ3L3WmpCn-ea5Y");
                        curl_setopt($cpr2, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                        curl_setopt($cpr2, CURLOPT_RETURNTRANSFER, TRUE);

                        $data['curl2'] = curl_exec($cpr2);
                        $data['test2'] = json_decode($data['curl2']);

                        if (isset($data['test2'])) {
                            $phone = $data['test2']->{'result'}->{'formatted_phone_number'};
                            $website = $data['test2']->{'result'}->{'website'};
                            $adress_component = $data['test2']->{'result'}->{'address_components'};
                            $nbr_componenent = count($adress_component);
                            for ($i = 0; $i < $nbr_componenent; $i++) {
                                //modifier: m ettre case
                                if ($adress_component[$i]->{'types'}[0] == 'street_number') {
                                    $street_number = $adress_component[$i]->{'short_name'};
                                }

                                if ($adress_component[$i]->{'types'}[0] == 'route') {
                                    $route = $adress_component[$i]->{'short_name'};
                                }

                                if ($adress_component[$i]->{'types'}[0] == 'postal_code') {
                                    $code_postal = $adress_component[$i]->{'short_name'};
                                }
                                if ($adress_component[$i]->{'types'}[0] == 'country') {
                                    $pays = $adress_component[$i]->{'short_name'};
                                }
                            }
                        }
                    }
                }
            }


            $this->concert->update_concert_data($this->input->post('ville'), $pays, $code_postal, $route, $street_number, $this->input->post('artiste'), $this->input->post('snd_partie'), $this->input->post('salle'), $this->input->post('prix'), $this->input->post('heure_concert'), $this->input->post('date_concert'), $concert_id, $adresse_id, $phone, $website);



            //$this->layout->view('mc_concerts');

         			$data_success['status'] = 'modifié';
            $this->load->view('concert/success-concert',$data_success);

        }
    }

    public function suppression_concert($user_id, $concert_id, $adresse_id) {
        if ($user_id != $this->session->userdata('uid')) {
            show_404();
        }

        $this->load->helper('form');
        $this->load->library('form_validation');

        $data = $this->data;
        
        
        
        if ($this->input->post("delete")) {
            $this->concert->delete_concert_data($concert_id, $adresse_id);
          $data_succes['status'] = 'supprimé';
            $this->load->view('concert/success-concert',$data_succes);
        }
        else {
        		$this->load->view('concert/suppression_concert', $data);

        }
       // echo $this->input->post("no_delete"); {
            //CLOSE POP UP
        //}

       
    }
    
    
    
 	public function zoom_photo($id_photo,$id_album) {
    $data = array();
    
    $data['zoom'] = $this->photos->get_zoom_photos($id_photo);
   $data['zoom_comment'] = $this->photos->get_zoom_photos_comment($id_photo);
    
    $this->load->view('photos/pi_voir_photo', $data);
  }

  	public function upload_photo($user_id) {
    $this->load->model('photos');
    $this->load->helper('form');

    $data = array();
    $data = array('error' => ' ');
    $data['options'] = array(
        '' => '',
    );
    $data['album_by_user'] = $this->photos->get_album($user_id);

//        specifier $i en fonction du nombre de ligne retourner
//        marche pas avec tableaux multidimension :

    $data['max_album_user'] = count($data['album_by_user']);
//        for($i=0; $i<$max_album_user; $i++){	
//            $data['options'][$album_by_user[$i]->{'nom'}] = $album_by_user[$i]->{'nom'};  
//        }
//        $data['options']['nouveau']="Creer un nouvel album";

    $this->load->helper('form', $data);
    $this->load->view('photos/ajouter_photos', $data);
  }

  	public function add_video($user_id) {
    $url_video_complete = $this->input->post('url_video');
    $description = $this->input->post('description');
    $id_url_v = strstr($url_video_complete, "v=");
    $id_url = mb_strcut($id_url_v, 2, 11);
    //envoit en bdd de l'id et la description ainsi que l'album
    $this->form_validation->set_rules('url_video', 'url_video', 'required');

	$data = array();
    $data = array('error' => ' ');
    $data['options'] = array(
        '' => '',
    );
    $data['album_by_user'] = $this->photos->get_album($user_id);

//        specifier $i en fonction du nombre de ligne retourner
//        marche pas avec tableaux multidimension :

    $data['max_album_user'] = count($data['album_by_user']);

    $this->load->helper(array('form', 'url'));

    $this->load->library('form_validation');

    if ($this->form_validation->run() == FALSE) {
      	$this->load->view('photos/add_video',$data);
    } 
    else 
    {
      	$this->photos->add_video($id_url, $user_id, $description,$this->input->post('albums'));
    	$this->load->view('photos/photos_success', $data);

    }
    
  }

  	public function do_upload($user_id) {
    $noespace_filename_album = str_replace(' ', '_', $this->input->post('albums'));
   // $dynamic_path = './files/' . $this->session->userdata('uid') . '/photos/' . $noespace_filename_album;
    $dynamic_path = './files/' . $this->session->userdata('uid') . '/photos/' . $noespace_filename_album;

    if (is_dir($dynamic_path) == false) {
      mkdir($dynamic_path, 0755, true);
    }

    $cover_photo = (count(scandir($dynamic_path)));

    $config['upload_path'] = $dynamic_path;
    if ($cover_photo <= 2) {
      $config['file_name'] = "cover";
    }

    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    /*$config['max_size'] = '1000';
    $config['max_width'] = '1024';
    $config['max_height'] = '768';*/
    $photo = $this->input->post('photo_up');

    $this->load->library('upload', $config);

    if (!$this->upload->do_upload('photo_up')) {
      $error = array('error' => $this->upload->display_errors());
      $this->load->view('photos/ajouter_photos', $error);
    } else {
      $upload_data = $this->upload->data();
      //$_POST['photo'] = $data['file_name'];
      //envoyer id utilisateur, nom photos, noms albums
      $this->photos->insert_photos($upload_data['file_name'], $user_id, $noespace_filename_album, $this->input->post('albums'), $this->input->post('description'));


      $this->load->view('photos/photos_success', $upload_data);
    }
  }

  	public function update_photo($user_id, $id_media, $type) {
    $this->load->library('form_validation');
    $this->form_validation->set_rules('description', 'description', 'required');

    // cas possible : 
    //update le nom d'une photo orpheline donc sans albm -> ok
    //update du nom d'un album -> ok
    //update une video -> le nom ->ok
    // Video et photo -> changer nom d'alubm 
    // mettre sans album
    // ajouter un album
    //si cover et changement ou suppresion album -> changer la cover
    //pour album : changement de direction fichier
    //update du nom d'une photo dans un album 
    //update une video -> la mettre dans un album
    //ajouter un  album a une photo : nouvel album
    // changer l'album d'une photo
    //supprimer la photo d'un album
    //supprimer une video d'un album
   
    $data = array();
    $data['album_by_user'] = $this->photos->get_album($user_id);
    $data['max_album_user'] = count($data['album_by_user']);
    if ($type == 1) {
      $data['info_album_photo'] = $this->photos->get_abum_for_photo($id_media);
      $data['info_photo'] = $this->photos->get_photo_by_id($id_media);
    }
    if ($this->form_validation->run() == FALSE) {
      $this->load->helper(array('form', 'url'));

      $this->load->view('photos/update_photo', $data);
    } 
    else {
      if ($type == 1) {
        //info de l'album renseigné : donc changement album pour photo
        $file_name_a = $this->photos->get_info_album($this->input->post('albums'));
        //file name de l'album renseigné soit deja existant / soit nouveau

        if (isset($file_name_a[0]->file_name)) {
          $file_name_album = $file_name_a[0]->file_name;
        } else {
          //creation d'un nouvel album pour la photo
          $file_name_album = str_replace(' ', '_', $this->input->post('albums'));
          $dynamic_path = './files/' . $this->session->userdata('uid') . '/photos/' . $file_name_album;

          if (is_dir($dynamic_path) == false) {
            mkdir($dynamic_path, 0755, true);
          }
          //specifier le nom cover à la photo  
        }
        //mise a jour en bdd des infos photos + album
        //definition des changement de paths des fichiers

        if (isset($data['info_album_photo'][0]->file_name)) {
          $file_base = './files/' . $user_id . '/photos/' . $data['info_album_photo'][0]->file_name . '/' . $data['info_photo'][0]->file_name;
        } else {
          $file_base = './files/' . $user_id . '/photos/' . $data['info_photo'][0]->file_name;
        }
        if (isset($dynamic_path)) {
          $data['info_photo'][0]->file_name = "cover.jpg";
        }
        if ($file_name_album != null) {
          $file_obj = './files/' . $user_id . '/photos/' . $file_name_album . '/' . $data['info_photo'][0]->file_name;
        } else {
          $file_obj = './files/' . $user_id . '/photos/' . '/' . $data['info_photo'][0]->file_name;
        }

        //changement de paths du fichiers
        rename($file_base, $file_obj);
        $data['update_photos'] = $this->photos->update_photo($user_id, $id_media, $this->input->post('description'), $this->input->post('albums'), $file_name_album, $data['info_photo'][0]->file_name);

        $this->load->view('photos/photos_success', $data);
      }


      if ($type == 2) {
        $data['update_photos'] = $this->photos->update_album($user_id, $id_media, $this->input->post('description'));
        $this->load->view('photos/photos_success', $data);
      }
      if ($type == 3) {

        //info de l'album renseigné : donc changement album pour photo
        $file_name_a = $this->photos->get_info_album($this->input->post('albums'));
        //file name de l'album renseigné soit deja existant / soit nouveau

        if (isset($file_name_a[0]->file_name)) {
          $file_name_album = $file_name_a[0]->file_name;
        } else {
          //creation d'un nouvel album pour la photo
          $file_name_album = str_replace(' ', '_', $this->input->post('albums'));
          $dynamic_path = './files/' . $this->session->userdata('uid') . '/photos/' . $file_name_album;

          if (is_dir($dynamic_path) == false) {
            mkdir($dynamic_path, 0755, true);
          }
        }



        $data['update_photos'] = $this->photos->update_video($user_id, $id_media, $this->input->post('description'), $this->input->post('albums'), $file_name_album);
        $this->load->view('photos/photos_success', $data);

        //$user_id,$id_video,$nom_video,$album_name,$file_name_a
      }
    }
  }

  	public function suppression_media($user_id, $media_id, $type_media) {
    $this->load->model('photos');
    $this->load->helper('form');
    $this->load->library('form_validation');
    $data = array();
    print $type_media;
    if ($user_id != $this->session->userdata('uid')) {
      show_404();
    }
    if ($this->input->post("delete")) {
      if ($type_media == 1) {

        $this->photos->delete_photo($media_id);
        // add success page photo
        $this->load->view('photos/photos_success');
      }

      if ($type_media == 2) {

        $this->photos->delete_album($media_id);
        // add success page photo
        $this->load->view('photos/photos_success');
      }

      if ($type_media == 3) {

        $this->photos->delete_video($media_id);
        // add success page photo
        $this->load->view('photos/photos_success');
      }
    }
    echo $this->input->post("no_delete"); {
      //CLOSE POP UP
    }

    $this->load->view('photos/delete_photos', $data);
  }
  


	public function delete_user($user_id) {
        $uid = $this->session->userdata('uid');
        
        if ($user_id != $uid) {
            show_404();
        }
        
        $this->user_id = $this->uri->segment(3);
        $data = $this->data;
        $data['profile'] = $this->user_model->getUser($this->user_id);
        
        $this->form_validation->set_rules('confirm-oui','Oui', '');
        $this->form_validation->set_rules('confirm-non','Non', '');
        
        if($this->form_validation->run() == FALSE){
//            $this->layout->view('reglage/mc_reglages', $data);
            $this->layout->ajouter_css('colorbox');
            $this->layout->ajouter_js('jquery.colorbox');
            $this->load->view('reglage/pi_suppression_confirm', $data);
        } else {
            $confirm = $this->input->post('confirm-oui');            

            if(isset($confirm)){
//            $this->user_model->delete_user($uid);
            } else {
                redirect('my-reglages/'.$uid, 'refresh');
            }
            redirect('home', 'refresh');
//            $this->load->view('reglage/pi_suppression_confirm', $data);
        }
    }
    
    
   	public function panier_infos()
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
		else
		{
			$this-> validation_commande();
		}
   
    }
  
  	public function validation_commande()
  	{
  	  	$format = $this->input->post('format');
  	  	$email = $this->input->post('email');
	  	$nom = $this->input->post('nom');

 		$this->session->set_flashdata('email', $email);
  		$this->session->set_flashdata('nom', $nom);

		$this->load->view('achat/pi_ta_paiement');
  	}
   	
}