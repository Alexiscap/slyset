<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Melo_wall extends CI_Controller {

    var $data;
    
    public function __construct() {
        parent::__construct();

        $this->layout->ajouter_css('slyset');
        $this->layout->ajouter_css('colorbox');

        
        $this->layout->ajouter_js('infinite_scroll');
        $this->layout->ajouter_js('jquery.easing.min');
        $this->layout->ajouter_js('jquery.colorbox');

        $this->layout->ajouter_js('colorbox');
        
        $this->load->model(array('user_model', 'mc_actus_model', 'melo_actus_model','musique_model','follower_model','achat_model'));
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $this->layout->set_id_background('melo_actu');

        $this->user_id = (is_numeric($this->uri->segment(2))) ? $this->uri->segment(2) : $this->uri->segment(3);

        $sub_data = array();
        $sub_data['profile'] = $this->user_model->getUser($this->user_id);
        $data_notif['count_notif'] = $this->achat_model->notif_panier($this->session->userdata('uid'));

        if ($this->user_id != null) {
            $sub_data['photo_right'] = $this->user_model->last_photo($this->user_id);
        }
        
        $this->data = array(
            'sidebar_left' => $this->load->view('sidebars/sidebar_left', $data_notif, TRUE),
            'sidebar_right' => $this->load->view('sidebars/sidebar_right', $sub_data, TRUE)
        );
    }

    public function index($user_id) {
     	$uid = $this->session->userdata('uid');
        $infos_profile = $this->user_model->getUser($user_id);

       // if ((($user_id != $uid && !empty($user_id)) || ($user_id == $uid && !empty($user_id))) && $infos_profile->type != 1) {
            $this->page($infos_profile);
        //} else {
          //  redirect('home/' . $uid, 'refresh');
        //}
//        $uid = $this->session->userdata('uid');
//        $infos_profile = $this->user_model->getUser($user_id);
//
//        if ($user_id == $uid) {
        //$this->page($user_id);
//        } else {
//            show_404();
//        }
    }

    public function page($infos_profile) {
		
		$data = $this->data;
        $uid = $this->session->userdata('uid');

        $user_visited = (empty($infos_profile)) ? $uid : $infos_profile->id;
		
        if (!empty($infos_profile)) {
            $data['infos_profile'] = $infos_profile;
        }
		
        $this->layout->ajouter_js('wall');

        setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');
        $data['playlists'] = $this->musique_model->get_my_playlist($user_visited);
        $data['all_following'] = $this->follower_model->get_all_abonnement($user_visited);
        

        $data_follow = $this->melo_actus_model->get_following($user_visited);
        $listforin = "";
        $data['info_user'] = $this->melo_actus_model->get_info_user($user_visited);
        
        foreach ($data_follow as $following) {
            $listforin .= $following->Utilisateur_id . ',';
        }
        
        $listforin_sql = substr($listforin, 0, -1);
        $data['data_all_wall'] = $this->melo_actus_model->get_entities_id(10, 0, $listforin_sql, $user_visited);

        $a = 0;
        if (isset($data['data_all_wall'])) {
            foreach ($data['data_all_wall'] as $data_for_album) {

                if ($data_for_album->product == 5 && $data_for_album->type == "MU") {
                    $data['photo_by_album'][$a] = $this->melo_actus_model->get_photos_album($data_for_album->idproduit, $data_for_album->date);
                    $a++;
                }
            }
        }
        $this->layout->view('wall/melo_actu', $data);
    }

    public function get_difference() {
        $user_id = $this->input->post('id_user');
        $data_follow = $this->melo_actus_model->get_following($user_id);
        
        $listforin = "";
        $data['info_user'] = $this->melo_actus_model->get_info_user($user_id);
        
        foreach ($data_follow as $following) {
            $listforin .= $following->Utilisateur_id . ',';
        }
        
        $listforin_sql = substr($listforin, 0, -1);
        print $listforin_sql.'__'.$user_id.'<br/>';
        $result = $this->melo_actus_model->difference($listforin_sql, $user_id);
        if (isset($result)) {
            foreach ($result as $id) {
                if ($id->id > $this->input->post('id_last')) {
                    $id_new = $id->id;
                    $result_total = $this->melo_actus_model->get_new_item($id_new, $id->type, $id->photos_id, $id->videos_id, $id->message_id, $id->concerts_id, $id->Following_id);

                    if (isset($result_total)) {
                        if ($id->type == 'ME') {
                            $result_total[0][0]->login = "";
                        } else {
                            $result_total[0][0]->login = $result_total[0][0]->login . ' - ';
                        }


                        setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');
                        date_default_timezone_set('Europe/Paris');
                        $date_format = (date_create($result_total[0][0]->date, timezone_open('Europe/Paris')));
                        $a = date_timestamp_get($date_format);
                        $data['date_2'] = strftime('Le %d %B %G', $a);
                        echo '<div id ="' . $result_total[0][0]->id . '" class="artist_post photo_message">
                                <div class="top"  class="top" id="' . $result_total[0][0]->id . '">
                                        <a href="#"><img src="' . img_url('musicien/btn_suppr.png') . '" alt="Suppression" /></a>
                                </div>
                                  <div class="left">
                                    <img src="' . base_url('/files/profiles/' . $result_total[0][0]->user_me) . '" alt="Photo Profil" />
                                  </div>
                                <div class="right">' . $result_total[2] . '
                                    </div>
                              <div class="bottom">
                                    <span class="infos_publi">' . $result_total[0][0]->login . $data['date_2'] . '<!--Le 26 Septembre 2013--></span>
                                  </div>
                              </div>';
                    }
                }
            }
        }
    }
    
    public function ajax_actus($uid, $offset = null) {
        $data = $this->data; 
        
        $data_follow = $this->melo_actus_model->get_following($uid);
        $listforin = "";
        $data['info_user'] = $this->melo_actus_model->get_info_user($uid);
        
        foreach ($data_follow as $following) {
            $listforin .= $following->Utilisateur_id . ',';
        }
        
        $listforin_sql = substr($listforin, 0, -1);
//        $data['data_all_wall'] = $this->melo_actus_model->get_entities_id(3, 0, $listforin_sql, $user_id);
        
        if ($this->melo_actus_model->get_entities_id(10, $offset, $listforin_sql, $uid)) {
            $data['data_all_wall'] = $this->melo_actus_model->get_entities_id(10, $offset, $listforin_sql, $uid);

            $this->load->view('wall/melo_actu_ajax', $data);
        } else {
//          echo 'End';
        }
    }

    public function delete_from_wall() {
        $id_wall = $this->input->post('id_wall');
        $this->melo_actus_model->delete_activity_wall($id_wall);
    }

}