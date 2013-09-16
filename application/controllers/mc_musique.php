<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mc_musique extends CI_Controller {

    var $data;

    public function __construct() {
        parent::__construct();

        $this->layout->ajouter_css('slyset');
        $this->layout->ajouter_css('pop_in');
        $this->layout->ajouter_css('colorbox');
        $this->layout->ajouter_css('information');

        $this->layout->ajouter_js('jquery.colorbox');
        $this->layout->ajouter_js('jquery-ui');
        $this->layout->ajouter_js('jquery.reveal');
        $this->layout->ajouter_js('jquery.tablesorter');

        $this->load->library('getid3/Getid3');
        $this->load->model(array('perso_model', 'user_model', 'musique_model', 'follower_model', 'achat_model'));
        $this->load->helper('form');

        $this->layout->set_id_background('musique');

        $this->user_id = (is_numeric($this->uri->segment(2))) ? $this->uri->segment(2) : $this->uri->segment(3);
        $output = $this->perso_model->get_perso($this->user_id);

        $sub_data = array();
        $sub_data['profile'] = $this->user_model->getUser($this->user_id);
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
        $user_visited = (empty($infos_profile)) ? $this->session->userdata('uid') : $infos_profile->id;

        if (!empty($infos_profile)) {
            $data['infos_profile'] = $infos_profile;
        }
        $data['all_morceau_artiste'] = $this->musique_model->get_morceau_user($infos_profile->id);
        $data['album_alaune'] = $this->musique_model->get_album_une($infos_profile->id);
        $data['morceaux_alaune'] = $this->musique_model->get_morceau_une($infos_profile->id);
        $data['playlists'] = $this->musique_model->get_my_playlist($this->session->userdata('uid'));
        $data['all_alb'] = $this->musique_model->get_list_album($this->session->userdata('uid'));
        $data['all_follower'] = $this->follower_model->get_all_follower_user($infos_profile->id);
        $data['album_nbr'] = $this->musique_model->get_nalb($infos_profile->id);
        $my_like_morceau = $this->musique_model->get_my_like_morceau();
        //$data['artistes'] = $this->musique_model->get_n_artiste($user_id);
        $data['all_my_like'] = "";
        foreach ($my_like_morceau as $mlike):
            $data['all_my_like'] .= '/' . $mlike->morceaux_id . '/';
        endforeach;
        //var_dump($data['all_morceau_artiste']);
        $this->layout->view('musique/mc_musique', $data);
    }

    public function page_album($user_id, $id_album) {
        $uid = $this->session->userdata('uid');
        $infos_profile = $this->user_model->getUser($user_id);

        if ((($user_id != $uid && !empty($user_id)) || ($user_id == $uid && !empty($user_id))) && $infos_profile->type != 1) {
            $data = $this->data;
            $user_visited = (empty($infos_profile)) ? $this->session->userdata('uid') : $infos_profile->id;

            if (!empty($infos_profile)) {
                $data['infos_profile'] = $infos_profile;
            }

            $data['this_album'] = $this->musique_model->get_album_page($id_album);
            $data['this_album_morceau'] = $this->musique_model->get_morceau_alb_page($user_id, $id_album);
            $data['playlists'] = $this->musique_model->get_my_playlist($this->session->userdata('uid'));
            $data['all_follower'] = $this->follower_model->get_all_follower_user($user_id);
            $data['album_nbr'] = $this->musique_model->get_nalb($user_id);
            $data['all_morceau_artiste'] = $this->musique_model->get_morceau_user($infos_profile->id);

            $my_like_morceau = $this->musique_model->get_my_like_morceau();

            $data['all_my_like'] = "";
            foreach ($my_like_morceau as $mlike):
                $data['all_my_like'] .= '/' . $mlike->morceaux_id . '/';
            endforeach;

            $this->layout->view('musique/album', $data);
        }
        else {
            redirect('home/' . $uid, 'refresh');
        }
    }

    public function to_pl() {
        $pl_name = $this->input->post('pl');
        $id_morceau = $this->input->post('id_track');
        $this->musique_model->to_playlist($pl_name, $id_morceau);
    }

    public function alb_to_panier() {
        $id_alb = $this->input->post('album_id');
        $pn = $this->musique_model->alb_to_panier($id_alb);
        print $pn;
        return $pn;
    }

    public function morceau_to_panier() {
        $id_track = $this->input->post('track_id');
        $rtn = $this->musique_model->morceau_to_panier($id_track);
        print $rtn;
        return $rtn;
    }

    public function put_alaune() {
        $id_alb = $this->input->post('id_alb');
        $put_une = $this->musique_model->put_alune($id_alb);
        //return $put_une;
    }

    public function player($user_id, $type = null, $name = null, $id_morceau = null) {
        //print $type;
        $data['playlists'] = $this->musique_model->get_my_playlist_player($user_id, $type, $name, $id_morceau);
        //var_dump($data['playlists']);
        $data['morceaux_playlist'] = $this->musique_model->get_morceau_by_playlist_user($user_id);


        /*  if ($id_morceau != null) {
          $info_morceau = $this->musique_model->get_morceau($id_morceau);
          $data['morceau'] = $info_morceau[0]->nom;
          } */
        //$unique_playlist = array_unique($playlist);
        //var_dump($morceaux_playlist);
        $this->load->view('musique/player', $data);
    }

    public function calcul_ecoute() {
        $id_track = $this->input->post('id_morceau');
        $this->musique_model->increment_ecoute($id_track);
    }

    public function already_like_track()
    {
        $id_morceau = $this->input->post('id_morceau');
        $yes_or_not_exist = $this->musique_model->already_like_track($id_morceau);
        if(empty($yes_or_not_exist)==1)
        {
            echo 'no';
        }
        else
        {
            echo 'yes';
        }
    }


    public function do_upload_musique($current_album = NULL) {
        $this->load->library('upload');
        $uid = $this->session->userdata('uid');

//        print_r($_FILES);
//        print_r($this->getid3->analyze($_FILES['tmp_name']));
//        $upload_folder = './files/'.$uid.'/musique/';
        $upload_folder = 'tmp/';

        if (is_dir($upload_folder) == false) {
            mkdir($upload_folder, 0755, true);
        }

        $this->upload_config = array(
            'upload_path' => $upload_folder,
//            'allowed_types' => 'png|jpg|jpeg|mp3',
            'allowed_types' => 'mp3|MP3|octet-stream',
            'max_size' => 9000000,
            'remove_space' => TRUE,
            'overwrite' => TRUE,
            'encrypt_name' => FALSE,
        );

        $this->upload->initialize($this->upload_config);

//        var_dump($_FILES);
        $userfile_exploded = explode('.mp3', $_FILES['userfile']['name']);
//        $strreplace = array('\'', '"', '(', ')', '.', ';', ':', '[', ']', '?', ',', '!', '=', '+', '`', '~', '^', '#', '°', '@', '*', '$', '€', '£', '%', 'µ');
//        $userfile1 = str_replace($strreplace, '', $userfile_exploded[0]);
        $userfile2 = preg_replace(array('/\s+/', '/[^\w-]/'), array('_', ''), $userfile_exploded[0]);
//        $userfile22 = str_replace(' ', '_', $userfile_exploded[0]);
        $userfile = $userfile2 . '.mp3';

//        print 'Voici le premier userfile ' . $userfile;
        $userfile_name = strtr($userfile, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');

//        print_r($_FILES);
//        print '<br/>';
//        print_r($_POST);
//        if($this->check_exists()){
//            print_r('réussie !!');
        if (!$this->upload->do_upload()) {
            //            $upload_error = $this->upload->display_errors();
            //            echo json_encode($upload_error);

            $error = array('error' => $this->upload->display_errors());
            $this->load->view('musique/upload_musique', $error);
        } else {
            $data['file_info'] = $this->upload->data();
            $id3 = $this->getid3->analyze($upload_folder . $userfile_name);
//            print_r($id3);

            $filesize = (isset($id3['filesize'])) ? $id3['filesize'] : NULL;
            $filename = (isset($id3['filename'])) ? $id3['filename'] : NULL;
            $price = (isset($_POST['price'])) ? $_POST['price'] : NULL;
//                $file_to_path = $id3['filepath'];
//                $full_path = $id3['filenamepath'];
            $format = (isset($id3['fileformat'])) ? $id3['fileformat'] : NULL;
            $bitrate = (isset($id3['audio']['bitrate'])) ? round($id3['audio']['bitrate']) : NULL;
            $track_number = (isset($id3['tags']['id3v2']['track_number'])) ? $id3['tags']['id3v2']['track_number'][0] : NULL;
            $year = (isset($id3['tags']['id3v2']['year'])) ? $id3['tags']['id3v2']['year'][0] : NULL;
            $genre = (isset($id3['tags']['id3v2']['genre'])) ? $id3['tags']['id3v2']['genre'][0] : NULL;

            if (!empty($current_album)) {
                $data['current_album'] = $current_album;
                $cur_album = $this->musique_model->get_album_page($current_album);
                $album = $cur_album[0]->nom;
            } else {
                $album = (isset($id3['tags']['id3v2']['album'])) ? $id3['tags']['id3v2']['album'][0] : NULL;
            }

            $artist = (isset($id3['tags']['id3v2']['artist'])) ? $id3['tags']['id3v2']['artist'][0] : NULL;
            $title = (isset($id3['tags']['id3v2']['title'])) ? $id3['tags']['id3v2']['title'][0] : NULL;
            $duration = (isset($id3['playtime_string'])) ? $id3['playtime_string'] : NULL;

            $file_to_move = $upload_folder . '' . $filename;
            $moved_path = "";
            $str_album = str_replace(' ', '_', strtolower($album));
            if (!empty($album)) {
                $moved_path = 'files/' . $uid . '/musique/' . $str_album . '/';
            } else {
                $moved_path = 'files/' . $uid . '/musique/';
            }

            if (is_dir($moved_path) == false) {
                mkdir($moved_path, 0755, true);
            }

            $moved_path_file = $moved_path . '' . $filename;

            if (copy($file_to_move, $moved_path_file)) {
                unlink($file_to_move);
            }

            $list_albums = $this->musique_model->get_list_album($uid);

            foreach ($list_albums as $list_album) {
                $albs[$list_album->id] = $list_album->nom;
            }

            $last_album_id = key(array_slice($albs, -1, 1, TRUE));

            if (!in_array($album, $albs)) {
                $this->musique_model->insert_album($album);
            }

            $this->musique_model->insert_music($filename, $last_album_id, $title, $track_number, $artist, $genre, $year, $duration, $price, $format, $bitrate, $filesize);
//            
//                $this->musique_model->insert_album($str_album, $genre, $year);

            $this->load->view('musique/upload_musique', $data);
        }
    }

    public function delete_track() {
        $morceau_id = $this->input->post('track_id');
        $uid = $this->session->userdata('uid');

        $data = array();
        $data['track'] = $this->musique_model->get_morceau_single($morceau_id);
        $filename = $data['track']->filename;
        $album = $data['track']->title_alb;

        $moved_path = "";
        $str_album = str_replace(' ', '_', strtolower($album));
        if (!empty($album)) {
            $moved_path = 'files/' . $uid . '/musique/' . $str_album . '/';
        } else {
            $moved_path = 'files/' . $uid . '/musique/';
        }
        unlink($moved_path . '' . $filename);

        echo $this->musique_model->delete_morceau($morceau_id);
    }

    public function delete_album($album_id) {
        $uid = $this->session->userdata('uid');

        $alb_name = $this->musique_model->get_album_by_id($album_id);
        $album = $alb_name->nom;

        $moved_path = "";
        $str_album = str_replace(' ', '_', strtolower($album));
        if (!empty($album)) {
            $moved_path = 'files/' . $uid . '/musique/' . $str_album;
        }
//        unlink($moved_path. '' .$filename);

        $morceaux_alb = $this->musique_model->get_morceau_alb_page($uid, $album_id);
        $array_tracks = array();
        foreach ($morceaux_alb as $morceau_alb) {
            $array_tracks[] = $morceau_alb->id;
        }
        $this->musique_model->delete_morceau_alb($array_tracks);

        echo $this->musique_model->delete_album($album_id);

        $this->rrmdir($moved_path);

        redirect('musique/' . $uid, 'refresh');
    }

    public function rrmdir($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir . "/" . $object) == "dir")
                        rmdir($dir . "/" . $object); else
                        unlink($dir . "/" . $object);
                }
            }
            reset($objects);
            rmdir($dir);
        }
    }

    public function check_exists() {
        $uid = $this->session->userdata('uid');

        //TODO : CHANGER PATH EN FONCTION DE ALBUM OU NON
        $targetFolder = '/slyset/' . $uid . '/musique/';

        $userfile_name = str_replace(' ', '_', $_POST['filename']);
        print_r($_SERVER['DOCUMENT_ROOT'] . $targetFolder . '/' . $userfile_name);

        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $targetFolder . '/' . $userfile_name)) {
            echo 1;
            print_r('exist');
//            return false;
        } else {
            echo 0;
            print_r('don\'t exist');
//            return true;
        }

//        echo json_encode($_POST['filename']);
//        return json_encode($_POST['filename']);
    }

}