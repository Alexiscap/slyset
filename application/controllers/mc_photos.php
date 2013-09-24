<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mc_photos extends CI_Controller {

    var $data;

    public function __construct() {
        parent::__construct();

        $this->layout->ajouter_css('slyset');
        $this->layout->ajouter_css('pop_in');
        $this->layout->ajouter_css('colorbox');


        $this->layout->ajouter_js('jquery.imagesloaded.min');
        $this->layout->ajouter_js('jquery.masonry.min');
        $this->layout->ajouter_js('jquery.stapel');
        $this->layout->ajouter_js('jquery.colorbox');
        $this->layout->ajouter_js('combobox');
        $this->layout->ajouter_js('jquery-ui');

        $this->load->helper('form');
        $this->load->model(array('perso_model', 'user_model', 'photo_model','achat_model','musique_model','follower_model'));
        $this->load->library('form_validation');

        $this->layout->set_id_background('photos_videos');

        $this->user_id = (is_numeric($this->uri->segment(2))) ? $this->uri->segment(2) : $this->uri->segment(3);
        $output = $this->perso_model->get_perso($this->user_id);

        $sub_data = array();
        $sub_data['profile'] = $this->user_model->getUser($this->user_id);
        if(isset($sub_data['profile']->login)):
            $this->layout->set_description('Retrouvez '.$sub_data['profile']->login.' sur Slyset et découvrez sa musique, ses prochains concerts, ses photos, ses vidéos, ses livrets, ses partitions...');
            $this->layout->set_titre('Galerie photos de '.$sub_data['profile']->login.' : concerts, festivals, etc.. - Slyset');
            $this->layout->set_keyword($sub_data['profile']->login.', musicien, musique en ligne, streaming musique, slyset, concerts, photos, vidéos, actualités musique');
        endif;
        $sub_data['perso'] = $output;
        
        if ($this->user_id != null) {
            $sub_data['photo_right'] = $this->user_model->last_photo($this->user_id);
            $sub_data['morceau_right'] = $this->user_model->top_five_morceau_profil($this->user_id);
            $sub_data['morceau_right_t']['type_page'] = 1;

        }
        
        if (!empty($output)) {
            $this->layout->ajouter_dynamique_css($output->theme_css);
            write_css($output);
        }
        //--bouton suivre un musicien
        $community_follower = $this->user_model->get_community($this->session->userdata('uid'));
        $my_abonnement_head = "";

        foreach ($community_follower as $my_following_head) {
            $my_abonnement_head .= $my_following_head->Utilisateur_id . '/';
        }
        $data_notif['count_notif'] = $this->achat_model->notif_panier($this->session->userdata('uid'));


        $this->data = array(
            'sidebar_left' => $this->load->view('sidebars/sidebar_left', $data_notif, TRUE),
            'sidebar_right' => $this->load->view('sidebars/sidebar_right', $sub_data, TRUE),
            'community_follower' => $my_abonnement_head
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

        $user_visited = (empty($infos_profile)) ? $uid : $infos_profile->id;

        if (!empty($infos_profile)) {
            $data['infos_profile'] = $infos_profile;
        }

        $data['all_media_user_result'] = $this->photo_model->liste_photos($user_visited);
        $data['commentaires'] = $this->photo_model->liste_comments();
        $data['commentaires_albums'] = $this->photo_model->liste_comments_album();
        $data['commentaires_video'] = $this->photo_model->liste_comments_video();
		$data['wall_photos'] = $this->photo_model->get_album_wall_all($user_visited);
        $data['all_photos'] = $this->photo_model->all_photos();
       	$data['comments_wall'] = $this->photo_model->get_comment_wall($user_visited);
        $data['all_photos_albums'] = $this->photo_model->all_photos_album();
        $data['like_photo'] = $this->photo_model->get_like_user($user_visited);
        $data['all_photo_like'] = "";
        $data['all_album_like'] = "";
        $data['all_video_like'] = "";

        foreach ($data['like_photo'] as $data['likes_photo']) {
            $data['all_photo_like'] .= $data['likes_photo']->Photo_id . "/";
            $data['all_album_like'] .= $data['likes_photo']->Album_media_file_name . "/";
            $data['all_video_like'] .= $data['likes_photo']->Video_id . "/";
        }

        foreach ($data['like_photo'] as $data['likes_photo']) {
            $data['all_photo_like'] .= $data['likes_photo']->Photo_id . "/";
            $data['all_album_like'] .= $data['likes_photo']->Album_media_file_name . "/";
            $data['all_video_like'] .= $data['likes_photo']->Video_id . "/";
        }

        $data['all_follower'] = $this->follower_model->get_all_follower_user($user_visited);
        $data['album_nbr'] = $this->musique_model->get_nalb($user_visited);
        $data['all_morceau_artiste'] = $this->musique_model->get_morceau_user($user_visited);
			
		//$data['album_wall'] = $this->photo_model->get_album_wall_four($user_visited);
		//var_dump($data['album_wall'] );
        $this->layout->view('photos/mc_photos', $data, false);
    }

    public function album($user_id, $album_name) {
        
        $data = $this->data;
        $uid = $this->session->userdata('uid');
		
		if($album_name != "wall")
		{
	        $data['user_id'] = $this->session->userdata('uid');
    	    $data['all_media_user_result'] = $this->photo_model->get_photos_by_album($user_id, $album_name);
        	$data['commentaires_video'] = $this->photo_model->liste_comments_video();

	        $data['commentaires'] = $this->photo_model->liste_comments();

    	    $user_visited = (empty($infos_profile)) ? $uid : $infos_profile->id;

        	if (!empty($infos_profile)) {
        	    $data['infos_profile'] = $infos_profile;
        	}

 	       $data['like_photo'] = $this->photo_model->get_like_user($user_id);
    	    $data['all_photo_like'] = "";
        	$data['all_album_like'] = "";
        	$data['all_video_like'] = "";

	        foreach ($data['like_photo'] as $data['likes_photo']) {
    	        $data['all_photo_like'] .= $data['likes_photo']->Photo_id . "/";
        	    $data['all_album_like'] .= $data['likes_photo']->Album_media_file_name . "/";
            	$data['all_video_like'] .= $data['likes_photo']->Video_id . "/";
        	}

     	  	foreach ($data['like_photo'] as $data['likes_photo']) {
        		$data['all_photo_like'] .= $data['likes_photo']->Photo_id . "/";
            	$data['all_album_like'] .= $data['likes_photo']->Album_media_file_name . "/";
            	$data['all_video_like'] .= $data['likes_photo']->Video_id . "/";
        	}
        }
        else
        {
       
       		$data['all_media_user_result'] = $this->photo_model->get_photos_by_album_wall($user_id);
		    $data['commentaires'] = $this->photo_model->liste_comments_wall();

        
        }

        $data['all_follower'] = $this->follower_model->get_all_follower_user($user_id);
        $data['album_nbr'] = $this->musique_model->get_nalb($user_id);
        $data['all_morceau_artiste'] = $this->musique_model->get_morceau_user($user_id);

        $this->layout->view('photos/album', $data, false);
    }

    public function form_photo_user_comment() {
        date_default_timezone_set('Europe/Paris');
        $usercomment = $this->input->post('usercomment');
        $messageid = $this->input->post('messageid');

        echo $this->photo_model->insert_comments();
    }

    public function form_album_user_comment() {
        date_default_timezone_set('Europe/Paris');
        $usercomment = $this->input->post('usercomment');
        $messageid = $this->input->post('messageid');

        echo $this->photo_model->insert_comments_album();
    }

    public function form_video_user_comment() {
        date_default_timezone_set('Europe/Paris');
        $usercomment = $this->input->post('usercomment');
        $messageid = $this->input->post('messageid');

        echo $this->photo_model->insert_comments_video();
    }

	public function form_album_wall_user_comment()
	{
	 	date_default_timezone_set('Europe/Paris');
        $usercomment = $this->input->post('usercomment');
        $messageid = $this->input->post('messageid');

        echo $this->photo_model->insert_comments_wall_photo();
	}
//like : ajouter dans like activity l'id de l'elmeent et de l'utilisateu
//incrementer de 1 le total like dans table like
// incrementer dans photos de 1 le total like

    public function add_like() {
        $id_photo = $this->input->post('id_photo');
        $id_user = $this->session->userdata('uid');
        echo $this->photo_model->insert_like($id_photo, $id_user);
    }

    public function add_like_a() {
        $file_name_album = $this->input->post('album_file_name');
        $id_user = $this->session->userdata('uid');
        echo $this->photo_model->insert_like_a($file_name_album, $id_user);
    }

    public function add_like_v() {
        $video_nom = $this->input->post('video_nom');
        $id_user = $this->session->userdata('uid');
        echo $this->photo_model->insert_like_v($video_nom, $id_user);
    }

    public function minus_like() {
        $id_photo = $this->input->post('id_photo');
        $id_user = $this->session->userdata('uid');
        echo $this->photo_model->delete_like($id_photo, $id_user);
    }

    public function minus_like_a() {
        $file_n_a = $this->input->post('file_name_album');
        $id_user = $this->session->userdata('uid');
        echo $this->photo_model->delete_like_a($file_n_a, $id_user);
    }

    public function minus_like_v() {
        $video_nom = $this->input->post('video_nom');
        $id_user = $this->session->userdata('uid');
        echo $this->photo_model->delete_like_v($video_nom, $id_user);
    }

    public function delete_comment() {
        $id_com = $this->input->post('id_comm');
        $this->photo_model->delete_comment($id_com);
    }

}