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
        
        $this->layout->ajouter_js('jquery.colorbox');
        $this->layout->ajouter_js('jquery-ui');
//        $this->layout->ajouter_js('audiojs/audio');

        $this->load->library('getid3/Getid3');
        $this->load->model(array('perso_model', 'user_model','musique_model'));
        $this->load->helper('form');

        $this->layout->set_id_background('musique');

        $this->user_id = (is_numeric($this->uri->segment(2))) ? $this->uri->segment(2) : $this->uri->segment(3);
        $output = $this->perso_model->get_perso($this->user_id);

        $sub_data = array();
        $sub_data['profile'] = $this->user_model->getUser($this->user_id);
        $sub_data['perso'] = $output;

        if ($this->user_id != null) {
            $sub_data['photo_right'] = $this->user_model->last_photo($this->user_id);
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

        $this->data = array(
            'sidebar_left' => $this->load->view('sidebars/sidebar_left', '', TRUE),
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

        $this->layout->view('musique/mc_musique', $data);
    }

    public function test() {
        $folder = 'assets/musique/';
        $test = $this->getid3->analyze($folder . 'test.mp3');
//        print_r($test);
        echo '<pre>' . htmlentities(print_r($test, true)) . '</pre>';


        $test2 = $this->getid3->writetags($folder . 'test.mp3');
        $test2->filename = $folder . 'test2.mp3';
        print '</br></br>' . $test2->filename;
        print_r($test2);

//        $test = $this->getid3->analyze($folder . 'test.mp3');
//        print_r($test);
    }

    public function player($user_id,$type = null,$name = null,$id_morceau = null) {    
    	
    	//print $type;
    	$data['playlists'] = $this->musique_model->get_my_playlist_player($user_id,$type,$name,$id_morceau);
    	//var_dump($data['playlists']);
    	$data['morceaux_playlist'] = $this->musique_model->get_morceau_by_playlist_user($user_id);
		if($id_morceau != null)
		{
		$info_morceau = $this->musique_model->get_morceau($id_morceau);
		$data['morceau'] = $info_morceau[0]->nom;
		}
    	//$unique_playlist = array_unique($playlist);
    	//var_dump($morceaux_playlist);
        $this->load->view('musique/player',$data);
    }

    public function do_upload_musique() {
        $this->load->library('upload');
        $image_upload_folder = 'files/uploads/';

        if (!file_exists($image_upload_folder)) {
            mkdir($image_upload_folder, DIR_WRITE_MODE, true);
        }

        $this->upload_config = array(
            'upload_path' => $image_upload_folder,
            'allowed_types' => 'png|jpg|jpeg|mp3',
            'max_size' => 50000,
            'remove_space' => TRUE,
            'overwrite' => TRUE,
            'encrypt_name' => FALSE,
        );

        $this->upload->initialize($this->upload_config);
        print_r($_FILES);
        print '<br/><br/>';
        print_r($_POST);
        
        $userfile_name = str_replace(' ', '_', $_FILES['userfile']['name']);
        print_r($userfile_name);
        
//        if($this->check_exists()){
//            print_r('réussie !!');
            if (!$this->upload->do_upload()) {
    //            $upload_error = $this->upload->display_errors();
    //            echo json_encode($upload_error);

                $error = array('error' => $this->upload->display_errors());
                $this->load->view('musique/upload_musique', $error);
            } else {
                $data['file_info'] = $this->upload->data();
    //            print_r($data['file_info']['file_name']);
                $this->load->view('musique/upload_musique', $data);
            }
//        } else {
//            print_r('foiré !!');
//        }
    }

    public function check_exists(){
        $targetFolder = '/slyset/files/uploads';
        
        $userfile_name = str_replace(' ', '_', $_POST['filename']);
        print_r($_SERVER['DOCUMENT_ROOT'] . $targetFolder . '/' . $userfile_name);
        
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $targetFolder . '/' . $userfile_name)) {
            echo 1;
            print_r('exist');
//            return false;
        } else {
            echo 0;
            print_r('d"ont exist');
//            return true;
        }

//        echo json_encode($_POST['filename']);
//        return json_encode($_POST['filename']);
    }
    
////     Function called by the form
//    public function upload_img() { 
//        print_r($_FILES);
//        //Format the name        
//        $name = $_FILES['files']['name'][0];
//        $name = strtr($name, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
//
////         replace characters other than letters, numbers and . by _
//        $name = preg_replace('/([^.a-z0-9]+)/i', '_', $name);
//
//        //Your upload directory, see CI user guide
//        $config['upload_path'] = $this->getPath_img_upload_folder();
//
//        $config['allowed_types'] = 'gif|jpg|png|JPG|GIF|PNG|mp3|MP3';
////		$config['max_size'] = '1000';
//        $config['file_name'] = $name;
//
//        //Load the upload library
//        $this->load->library('upload', $config);
//
//        if ($this->do_upload()) {
//            print 'ok';
//            // Codeigniter Upload class alters name automatically (e.g. periods are escaped with an
//            //underscore) - so use the altered name for thumbnail
//            $data = $this->upload->data();
//            $name = $data['file_name'];
//
//            //If you want to resize 
//            $config['new_image'] = $this->getPath_img_thumb_upload_folder();
//            $config['image_library'] = 'gd2';
//            $config['source_image'] = $this->getPath_img_upload_folder() . $name;
//            $config['create_thumb'] = FALSE;
//            $config['maintain_ratio'] = TRUE;
//            $config['width'] = 193;
//            $config['height'] = 94;
//
//            $this->load->library('image_lib', $config);
//
//            $this->image_lib->resize();
//
//            //Get info 
//            $info = new stdClass();
//
//            $info->name = $name;
//            $info->size = $data['file_size'];
//            $info->type = $data['file_type'];
//            $info->url = $this->getPath_img_upload_folder() . $name;
//            $info->thumbnail_url = $this->getPath_img_thumb_upload_folder() . $name; //I set this to original file since I did not create thumbs.  change to thumbnail directory if you do = $upload_path_url .'/thumbs' .$name
//            $info->delete_url = $this->getDelete_img_url() . $name;
//            $info->delete_type = 'DELETE';
//
//
//            //Return JSON data
//            if (IS_AJAX) {   //this is why we put this in the constants to pass only json data
//                echo json_encode(array($info));
//                //this has to be the only the only data returned or you will get an error.
//                //if you don't give this a json array it will give you a Empty file upload result error
//                //it you set this without the if(IS_AJAX)...else... you get ERROR:TRUE (my experience anyway)
//            } else {   // so that this will still work if javascript is not enabled
//                $file_data['upload_data'] = $this->upload->data();
//                echo json_encode(array($info));
//            }
//        } else {
//
//            // the display_errors() function wraps error messages in <p> by default and these html chars don't parse in
//            // default view on the forum so either set them to blank, or decide how you want them to display.  null is passed.
//            $error = array('error' => $this->upload->display_errors('', ''));
//
//            echo json_encode(array($error));
//        }
//    }
//
//    //Function for the upload : return true/false
//    public function do_upload() {
//        if (!$this->upload->do_upload()) {
//            return false;
//        } else {
//            //$data = array('upload_data' => $this->upload->data());
//            return true;
//        }
//    }
//
//    //Function Delete image
//    public function deleteImage() {
//        //Get the name in the url
//        $file = $this->uri->segment(3);
//
//        $success = unlink($this->getPath_img_upload_folder() . $file);
//        $success_th = unlink($this->getPath_img_thumb_upload_folder() . $file);
//
//        //info to see if it is doing what it is supposed to	
//        $info = new stdClass();
//        $info->sucess = $success;
//        $info->path = $this->getPath_url_img_upload_folder() . $file;
//        $info->file = is_file($this->getPath_img_upload_folder() . $file);
//        if (IS_AJAX) {//I don't think it matters if this is set but good for error checking in the console/firebug
//            echo json_encode(array($info));
//        } else {
//            //here you will need to decide what you want to show for a successful delete
//            var_dump($file);
//        }
//    }
//
//    //Load the files
//    public function get_files() {
//        $this->get_scan_files();
//    }
//
//    //Get info and Scan the directory
//    public function get_scan_files() {
//        $file_name = isset($_REQUEST['file']) ?
//                basename(stripslashes($_REQUEST['file'])) : null;
//        if ($file_name) {
//            $info = $this->get_file_object($file_name);
//        } else {
//            $info = $this->get_file_objects();
//        }
//        header('Content-type: application/json');
//        echo json_encode($info);
//    }
//
//    protected function get_file_object($file_name) {
//        $file_path = $this->getPath_img_upload_folder() . $file_name;
//        if (is_file($file_path) && $file_name[0] !== '.') {
//
//            $file = new stdClass();
//            $file->name = $file_name;
//            $file->size = filesize($file_path);
//            $file->url = $this->getPath_url_img_upload_folder() . rawurlencode($file->name);
//            $file->thumbnail_url = $this->getPath_url_img_thumb_upload_folder() . rawurlencode($file->name);
//            //File name in the url to delete 
//            $file->delete_url = $this->getDelete_img_url() . rawurlencode($file->name);
//            $file->delete_type = 'DELETE';
//
//            return $file;
//        }
//        return null;
//    }
//
//    //Scan
//    protected function get_file_objects() {
//        return array_values(array_filter(array_map(
//                                array($this, 'get_file_object'), scandir($this->getPath_img_upload_folder())
//        )));
//    }
}