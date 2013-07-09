<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mc_photos extends CI_Controller {

  var $data;  
    
  public function __construct() {
    parent::__construct();

    $this->layout->ajouter_css('slyset');
    $this->layout->ajouter_css('colorbox');
    
    $this->layout->ajouter_js('jquery.placeheld.min');
    $this->layout->ajouter_js('jquery.imagesloaded.min');
    $this->layout->ajouter_js('jquery.masonry.min');
    $this->layout->ajouter_js('jquery.stapel');
    $this->layout->ajouter_js('jquery.colorbox');
    $this->layout->ajouter_js('combobox');
    $this->layout->ajouter_js('jquery-ui');
    

    $this->load->model('photos');
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->model(array('perso_model', 'user_model'));

    $this->layout->set_id_background('photos_videos');

    $this->user_id = (is_numeric($this->uri->segment(2))) ? $this->uri->segment(2) : $this->uri->segment(3);
    $output = $this->perso_model->get_perso($this->user_id);

    $sub_data = array();
    $sub_data['profile'] = $this->user_model->getUser($this->user_id);
    $sub_data['perso'] = $output;

    if (!empty($output)) {
      $this->layout->ajouter_dynamique_css($output->theme_css);
      write_css($output);
    } 	
 	//--bouton suivre un musicien
    $community_follower=  $this->user_model->get_community($this->session->userdata('uid'));
    $my_abonnement_head = "";
             
    foreach($community_follower as $my_following_head)
    {
    	$my_abonnement_head .= $my_following_head->Utilisateur_id.'/';
    }

    $this->data = array(
        'sidebar_left' => $this->load->view('sidebars/sidebar_left', '', TRUE),
        'sidebar_right' => $this->load->view('sidebars/sidebar_right', $sub_data, TRUE),
        'community_follower'=>$my_abonnement_head

    );
  }
  
    public function index($user_id) {
        $uid = $this->session->userdata('uid');
        $infos_profile = $this->user_model->getUser($user_id);

        if ((($user_id != $uid && !empty($user_id)) || ($user_id == $uid && !empty($user_id))) && $infos_profile->type != 1) {
            $this->page($infos_profile);
        } else {
            redirect('home/' . $uid, 'refresh');
        }
    }

  public function page($infos_profile) {
    $data = $this->data;
    $uid = $this->session->userdata('uid');
    // $data['all_media_user_result'] = $this->photos->get_media_user(30);
        
    $user_visited = (empty($infos_profile)) ? $uid : $infos_profile->id;

    if (!empty($infos_profile)) {
        $data['infos_profile'] = $infos_profile;
    }
        
    $data['all_media_user_result'] = $this->photos->liste_photos($user_visited);
    $data['commentaires'] = $this->photos->liste_comments();
    $data['commentaires_albums'] = $this->photos->liste_comments_album();
    $data['commentaires_video'] = $this->photos->liste_comments_video();

    $data['all_photos'] = $this->photos->all_photos();
    $data['all_photos_albums'] = $this->photos->all_photos_album();
    //	$data['all_video_user'] = $this->photos->get_video($data['user_id']) ;
    $data['like_photo'] = $this->photos->get_like_user($user_visited);
    $data['all_photo_like'] = "";
    $data['all_album_like'] = "";
    $data['all_video_like'] = "";

    foreach ($data['like_photo'] as $data['likes_photo']) {
      $data['all_photo_like'] .=
              $data['likes_photo']->Photo_id . "/";

      $data['all_album_like'] .=
              $data['likes_photo']->Album_media_file_name . "/";

      $data['all_video_like'] .=
              $data['likes_photo']->Video_id . "/";
    }

    foreach ($data['like_photo'] as $data['likes_photo']) {
      $data['all_photo_like'] .= $data['likes_photo']->Photo_id . "/";

      $data['all_album_like'] .= $data['likes_photo']->Album_media_file_name . "/";

      $data['all_video_like'] .= $data['likes_photo']->Video_id . "/";
    }


    $this->layout->view('photos/mc_photos', $data, false);
    //doit faire passer name album en requete 2
  }

  // page album
  public function album($user_id, $album_name) {
    $data = $this->data;
        $uid = $this->session->userdata('uid');

    $data['user_id'] = $this->session->userdata('uid');
    $data['all_media_user_result'] = $this->photos->get_photos_by_album($user_id, $album_name);
    $data['commentaires_video'] = $this->photos->liste_comments_video();

    $data['commentaires'] = $this->photos->liste_comments();

//        $data['all_media_user_result'] = $this->photos->all_photos();
//        $data['commentaires_albums'] = $this->photos->liste_comments_album();
//        $data['all_photos'] = $this->photos->all_photos();
//        $data['all_photos_albums'] = $this->photos->all_photos_album();
     
    $user_visited = (empty($infos_profile)) ? $uid : $infos_profile->id;

    if (!empty($infos_profile)) {
        $data['infos_profile'] = $infos_profile;
    }
 $data['like_photo'] = $this->photos->get_like_user($user_visited);
    $data['all_photo_like'] = "";
    $data['all_album_like'] = "";
    $data['all_video_like'] = "";

    foreach ($data['like_photo'] as $data['likes_photo']) {
      $data['all_photo_like'] .=
              $data['likes_photo']->Photo_id . "/";

      $data['all_album_like'] .=
              $data['likes_photo']->Album_media_file_name . "/";

      $data['all_video_like'] .=
              $data['likes_photo']->Video_id . "/";
    }

    foreach ($data['like_photo'] as $data['likes_photo']) {
      $data['all_photo_like'] .= $data['likes_photo']->Photo_id . "/";

      $data['all_album_like'] .= $data['likes_photo']->Album_media_file_name . "/";

      $data['all_video_like'] .= $data['likes_photo']->Video_id . "/";
    }


    $this->layout->view('photos/album', $data, false);
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
    } else {
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

        $this->load->view('photos/mc_photos', $data);
      }


      if ($type == 2) {
        $data['update_photos'] = $this->photos->update_album($user_id, $id_media, $this->input->post('description'));
        $this->load->view('photos/mc_photos', $data);
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
        $this->load->view('photos/mc_photos', $data);

        //$user_id,$id_video,$nom_video,$album_name,$file_name_a
      }
    }
  }

  /*
    public function update_album($user_id,$filename_album)
    {
    $data['album_by_user'] = $this->photos->get_album($user_id);
    $data['max_album_user'] = count($data['album_by_user']);
    $data['update_album'] = $this->photos->update_album($user_id,$this->input->post('album_select'),$filename_album);
    $this->load->view('photos/update_album', $data);


    } */

  public function form_photo_user_comment() {
//     
    date_default_timezone_set('Europe/Paris');
    $usercomment = $this->input->post('usercomment');
    $messageid = $this->input->post('messageid');

    echo $this->photos->insert_comments();
  }

  public function form_album_user_comment() {
//     
    date_default_timezone_set('Europe/Paris');
    $usercomment = $this->input->post('usercomment');
    $messageid = $this->input->post('messageid');

    echo $this->photos->insert_comments_album();
  }

  public function form_video_user_comment() {
//     
    date_default_timezone_set('Europe/Paris');
    $usercomment = $this->input->post('usercomment');
    $messageid = $this->input->post('messageid');

    echo $this->photos->insert_comments_video();
  }

//like : ajouter dans like activity l'id de l'elmeent et de l'utilisateu
//incrementer de 1 le total like dans table like
// incrementer dans photos de 1 le total like
//
  public function add_like() {
    $id_photo = $this->input->post('id_photo');
    $id_user = $this->session->userdata('uid');
    echo $this->photos->insert_like($id_photo, $id_user);
  }

  public function add_like_a() {
    $file_name_album = $this->input->post('album_file_name');
    $id_user = $this->session->userdata('uid');
    echo $this->photos->insert_like_a($file_name_album, $id_user);
  }

  public function add_like_v() {
    $video_nom = $this->input->post('video_nom');
    $id_user = $this->session->userdata('uid');
    echo $this->photos->insert_like_v($video_nom, $id_user);
  }

  public function minus_like() {
    $id_photo = $this->input->post('id_photo');
    $id_user = $this->session->userdata('uid');
    echo $this->photos->delete_like($id_photo, $id_user);
  }

  public function minus_like_a() {
    $file_n_a = $this->input->post('file_name_album');
    $id_user = $this->session->userdata('uid');
    echo $this->photos->delete_like_a($file_n_a, $id_user);
  }

  public function minus_like_v() {
    $video_nom = $this->input->post('video_nom');
    $id_user = $this->session->userdata('uid');
    echo $this->photos->delete_like_v($video_nom, $id_user);
  }

  public function add_video($user_id) {
    $url_video_complete = $this->input->post('url_video');
    $description = $this->input->post('description');
    $id_url_v = strstr($url_video_complete, "v=");
    $id_url = mb_strcut($id_url_v, 2, 11);
    //envoit en bdd de l'id et la description ainsi que l'album
    $this->form_validation->set_rules('url_video', 'url_video', 'required');

    $this->load->helper(array('form', 'url'));

    $this->load->library('form_validation');

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('photos/add_video');
    } else {
      $this->photos->add_video($id_url, $user_id, $description);
    }
  }

  //delete album  :supprimer photos too !!
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
        $this->load->view('success-concert');
      }

      if ($type_media == 2) {

        $this->photos->delete_album($media_id);
        // add success page photo
        $this->load->view('success-concert');
      }

      if ($type_media == 3) {

        $this->photos->delete_video($media_id);
        // add success page photo
        $this->load->view('success-concert');
      }
    }
    echo $this->input->post("no_delete"); {
      //CLOSE POP UP
    }

    $this->load->view('photos/delete_photos', $data);
  }

}