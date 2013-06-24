<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mc_photos extends CI_Controller {

  public function __construct() {
    parent::__construct();

    $this->layout->ajouter_css('slyset');
    $this->layout->ajouter_css('colorbox');

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

    $this->data = array(
        'sidebar_left' => $this->load->view('sidebars/sidebar_left', '', TRUE),
        'sidebar_right' => $this->load->view('sidebars/sidebar_right', $sub_data, TRUE)
    );
  }

  public function index($user_id) {
    $uid = $this->session->userdata('uid');
//
//      print 'ONE - '.$user_id.'<br />';
//      print 'TWO - '.$uid.'<br />';
//      print 'THREE - '.$infos_profile.'<br />';
      
    if(($user_id != $uid && !empty($user_id)) || ($user_id == $uid && !empty($user_id))) {
      $user_id = $this->user_infos->uri_user();
      $infos_profile = $this->user_model->getUser($user_id);
      $this->page($infos_profile);
    } else {
      redirect('home/' . $uid, 'refresh');
    }
  }

  public function page($user_id) {
    $datas = array();
    $datas['user_id'] = $this->session->userdata('uid');
    $datas['sidebar_left'] = $this->load->view('sidebars/sidebar_left', '', TRUE);
    $datas['sidebar_right'] = $this->load->view('sidebars/sidebar_right', '', TRUE);
    // $datas['all_media_user_result'] = $this->photos->get_media_user(30);
    $datas['all_media_user_result'] = $this->photos->liste_photos($user_id);
    $datas['commentaires'] = $this->photos->liste_comments();
    $datas['commentaires_albums'] = $this->photos->liste_comments_album();
    $datas['commentaires_video'] = $this->photos->liste_comments_video();

    $datas['all_photos'] = $this->photos->all_photos();
    $datas['all_photos_albums'] = $this->photos->all_photos_album();
    //	$datas['all_video_user'] = $this->photos->get_video($datas['user_id']) ;
    $datas['like_photo'] = $this->photos->get_like_user($user_id);
    $datas['all_photo_like'] = "";
    $datas['all_album_like'] = "";
    $datas['all_video_like'] = "";

    foreach ($datas['like_photo'] as $datas['likes_photo']) {
      $datas['all_photo_like'] .=
              $datas['likes_photo']->Photo_id . "/";

      $datas['all_album_like'] .=
              $datas['likes_photo']->Album_media_file_name . "/";

      $datas['all_video_like'] .=
              $datas['likes_photo']->Video_id . "/";
    }

    foreach ($datas['like_photo'] as $datas['likes_photo']) {
      $datas['all_photo_like'] .= $datas['likes_photo']->Photo_id . "/";

      $datas['all_album_like'] .= $datas['likes_photo']->Album_media_file_name . "/";

      $datas['all_video_like'] .= $datas['likes_photo']->Video_id . "/";
    }

    $this->layout->view('photos/mc_photos', $datas, false);
    //doit faire passer name album en requete 2
  }

  // page album
  public function album($user_id, $album_name) {
    $datas = array();
    $datas['user_id'] = $this->session->userdata('uid');
    $datas['sidebar_left'] = $this->load->view('sidebars/sidebar_left', '', TRUE);
    $datas['sidebar_right'] = $this->load->view('sidebars/sidebar_right', '', TRUE);
    $datas['all_media_user_result'] = $this->photos->get_photos_by_album($user_id, $album_name);
    $datas['commentaires_video'] = $this->photos->liste_comments_video();

    $datas['commentaires'] = $this->photos->liste_comments();

//        $datas['all_media_user_result'] = $this->photos->all_photos();
//        $datas['commentaires_albums'] = $this->photos->liste_comments_album();
//        $datas['all_photos'] = $this->photos->all_photos();
//        $datas['all_photos_albums'] = $this->photos->all_photos_album();

    $this->layout->view('photos/album', $datas, false);
  }

  public function zoom_photo($id_photo) {
    $datas = array();
    $this->load->view('photos/zoom_photo', $datas);
  }

  public function upload_photo($user_id) {
    $this->load->model('photos');
    $this->load->helper('form');

    $datas = array();
    $datas = array('error' => ' ');
    $datas['options'] = array(
        '' => '',
    );
    $datas['album_by_user'] = $this->photos->get_album($user_id);

//        specifier $i en fonction du nombre de ligne retourner
//        marche pas avec tableaux multidimension :

    $datas['max_album_user'] = count($datas['album_by_user']);
//        for($i=0; $i<$max_album_user; $i++){	
//            $datas['options'][$album_by_user[$i]->{'nom'}] = $album_by_user[$i]->{'nom'};  
//        }
//        $datas['options']['nouveau']="Creer un nouvel album";

    $this->load->helper('form', $datas);
    $this->load->view('photos/ajouter_photos', $datas);
  }

  public function do_upload($user_id) {

    $noespace_filename_album = str_replace(' ', '_', $this->input->post('albums'));
    $dynamic_path = './files/' . $this->session->userdata('uid') . '/photos/' . $noespace_filename_album;

    if (is_dir($dynamic_path) == false) {
      mkdir($dynamic_path, 0755, true);
    }

    $cover_photo = (count(scandir($dynamic_path)));

    $config['upload_path'] = $dynamic_path;
    if ($cover_photo <= 2) {
      $config['file_name'] = "cover";
    }

    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size'] = '1000';
    // a definir
    $config['max_width'] = '1024';
    $config['max_height'] = '768';
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
    $datas = array();
    $datas['album_by_user'] = $this->photos->get_album($user_id);
    $datas['max_album_user'] = count($datas['album_by_user']);
    if ($type == 1) {
      $datas['info_album_photo'] = $this->photos->get_abum_for_photo($id_media);
      $datas['info_photo'] = $this->photos->get_photo_by_id($id_media);
    }
    if ($this->form_validation->run() == FALSE) {
      $this->load->helper(array('form', 'url'));

      $this->load->view('photos/update_photo', $datas);
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

        if (isset($datas['info_album_photo'][0]->file_name)) {
          $file_base = './files/' . $user_id . '/photos/' . $datas['info_album_photo'][0]->file_name . '/' . $datas['info_photo'][0]->file_name;
        } else {
          $file_base = './files/' . $user_id . '/photos/' . $datas['info_photo'][0]->file_name;
        }
        if (isset($dynamic_path)) {
          $datas['info_photo'][0]->file_name = "cover.jpg";
        }
        if ($file_name_album != null) {
          $file_obj = './files/' . $user_id . '/photos/' . $file_name_album . '/' . $datas['info_photo'][0]->file_name;
        } else {
          $file_obj = './files/' . $user_id . '/photos/' . '/' . $datas['info_photo'][0]->file_name;
        }

        //changement de paths du fichiers
        rename($file_base, $file_obj);
        $datas['update_photos'] = $this->photos->update_photo($user_id, $id_media, $this->input->post('description'), $this->input->post('albums'), $file_name_album, $datas['info_photo'][0]->file_name);

        $this->load->view('photos/mc_photos', $datas);
      }


      if ($type == 2) {
        $datas['update_photos'] = $this->photos->update_album($user_id, $id_media, $this->input->post('description'));
        $this->load->view('photos/mc_photos', $datas);
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



        $datas['update_photos'] = $this->photos->update_video($user_id, $id_media, $this->input->post('description'), $this->input->post('albums'), $file_name_album);
        $this->load->view('photos/mc_photos', $datas);

        //$user_id,$id_video,$nom_video,$album_name,$file_name_a
      }
    }
  }

  /*
    public function update_album($user_id,$filename_album)
    {
    $datas['album_by_user'] = $this->photos->get_album($user_id);
    $datas['max_album_user'] = count($datas['album_by_user']);
    $datas['update_album'] = $this->photos->update_album($user_id,$this->input->post('album_select'),$filename_album);
    $this->load->view('photos/update_album', $datas);


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
    $datas = array();
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

    $this->load->view('photos/delete_photos', $datas);
  }

}