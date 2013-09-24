<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mc_actus extends CI_Controller {

    var $data;

    public function __construct() {
        parent::__construct();
        
        $this->layout->ajouter_css('slyset');
        $this->layout->ajouter_css('pop_in');
        $this->layout->ajouter_css('colorbox');
        
        $this->layout->ajouter_js('jquery.colorbox');
        $this->layout->ajouter_js('infinite_scroll');
        $this->layout->ajouter_js('jquery.easing.min');

        $this->load->helper(array('form', 'comments_helper'));
        $this->load->model(array('mc_actus_model', 'perso_model', 'user_model','achat_model','follower_model','musique_model'));
        $this->load->library(array('form_validation'));

        $this->layout->set_id_background('musicien_actus');

        $this->user_id = (is_numeric($this->uri->segment(2))) ? $this->uri->segment(2) : $this->uri->segment(3);
        $output = $this->perso_model->get_perso($this->user_id);

        $sub_data = array();
        $sub_data['profile'] = $this->user_model->getUser($this->user_id);
        if(isset($sub_data['profile']->login)):
            $this->layout->set_description('Retrouvez '.$sub_data['profile']->login.' sur Slyset et découvrez sa musique, ses prochains concerts, ses photos, ses vidéos, ses livrets, ses partitions...');
            $this->layout->set_titre('Toute l\'actualité de '.$sub_data['profile']->login.' : photos, concerts, news - Slyset');
            $this->layout->set_keyword($sub_data['profile']->login.', musicien, musique en ligne, streaming musique, slyset, concerts, photos, vidéos, actualités musique');
        endif;
        $sub_data['perso'] = $output;
        if ($this->user_id != null) {
            $sub_data['photo_right'] = $this->user_model->last_photo($this->user_id);
            $sub_data['morceau_right'] = $this->user_model->top_five_morceau_profil($this->user_id);
            $sub_data['morceau_right_t']['type_page'] = 1;
        }
        //--bouton suivre un musicien
        $community_follower = $this->user_model->get_community($this->session->userdata('uid'));
        $my_abonnement_head = "";

        foreach ($community_follower as $my_following_head) {
            $my_abonnement_head .= $my_following_head->Utilisateur_id . '/';
        }

        if (!empty($output)) {
            $this->layout->ajouter_dynamique_css($output->theme_css);
            write_css($output);
        }
        $data_notif['count_notif'] = $this->achat_model->notif_panier($this->session->userdata('uid'));

        $this->data = array(
            'sidebar_left' => $this->load->view('sidebars/sidebar_left', $data_notif, TRUE),
            'sidebar_right' => $this->load->view('sidebars/sidebar_right', $sub_data, TRUE),
            'commentaires' => $this->mc_actus_model->liste_comments(),
            'community_follower' => $my_abonnement_head
        );
    }

    public function index($user_id) {
        $uid = $this->session->userdata('uid');
        $type_account = $this->session->userdata('account');
        $infos_profile = $this->user_model->getUser($this->user_id);

        if ($user_id != $uid && !empty($user_id) && $infos_profile->type != 1) {
            $this->page($infos_profile);
        } elseif ($user_id == $uid && !empty($user_id) && $infos_profile->type != 1) {
            $this->page($infos_profile);
        } else {
            redirect('home/' . $uid, 'refresh');
        }
    }

    public function page($infos_profile = NULL) {
        $data = $this->data;
        $user_visited = (empty($infos_profile)) ? $this->session->userdata('uid') : $infos_profile->id;
        $data['messages'] = $this->mc_actus_model->liste_actus(10, 0, $user_visited);

        if (!empty($infos_profile)) {
            $data['infos_profile'] = $infos_profile;
        }
        $data['all_follower'] = $this->follower_model->get_all_follower_user($user_visited);
        $data['album_nbr'] = $this->musique_model->get_nalb($user_visited);
        $data['all_morceau_artiste'] = $this->musique_model->get_morceau_user($user_visited);

        $this->layout->view('wall/mc_actus', $data);
    }

    public function form_wall_musicien_message($user_id) {
        $data = $this->data;
        $data['messages'] = $this->mc_actus_model->liste_actus(10, 0, $user_id);

        if (!empty($infos_profile)) {
            $data['infos_profile'] = $infos_profile;
        }

        $this->form_validation->set_rules('comment1', 'Message', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $this->layout->view('wall/mc_actus', $data);
        } else {
            $message = ucfirst($this->input->post('comment1'));
            $lien = '';
            $photo = '';

            $logged_in = $this->session->userdata('logged_in');
            if ($logged_in == 1) {
                $this->mc_actus_model->insert_actus($message, $lien, $photo, $user_id);
                redirect('actualite/' . $user_id, 'refresh');
            } else {
                redirect('login', 'refresh');
            }
        }
    }

    public function form_wall_musicien_photo($user_id) {
        $data = $this->data;
        $user_visited = (empty($infos_profile)) ? $this->session->userdata('uid') : $infos_profile->id;
        $data['messages'] = $this->mc_actus_model->liste_actus(10, 0, $user_visited);

        $dynamic_path = './files/' . $this->session->userdata('uid') . '/wall/';
        if (is_dir($dynamic_path) == false) {
            mkdir($dynamic_path, 0755, true);
        }

        $config['upload_path'] = $dynamic_path;
        $config['allowed_types'] = 'gif|jpg|png';
//        $config['max_size']      = '100000';
//        $config['max_width']     = '1024';
//        $config['max_height']    = '768';
        $config['remove_space'] = TRUE;
        $config['overwrite'] = TRUE;
        $this->load->library('upload', $config);

        $this->form_validation->set_rules('comment2', 'Message', 'trim|required|xss_clean');
        $this->form_validation->set_rules('photo', 'Photo', 'callback_handle_upload_photo');

        if ($this->form_validation->run() == FALSE) {
            $this->layout->view('wall/mc_actus', $data);
        } else {
            $message = ucfirst($this->input->post('comment2'));
            $lien = '';
            $photo = $this->input->post('photo');

            $logged_in = $this->session->userdata('logged_in');
            if ($logged_in == 1) {
                $this->mc_actus_model->insert_actus($message, $lien, $photo, $user_visited);
                redirect('actualite/' . $user_visited, 'refresh');
            } else {
                redirect('login', 'refresh');
            }
        }
    }

    public function form_wall_musicien_link($user_id) {
        $data = $this->data;
        $user_visited = (empty($infos_profile)) ? $this->session->userdata('uid') : $infos_profile->id;
        $data['messages'] = $this->mc_actus_model->liste_actus(10, 0, $user_visited);

        $this->form_validation->set_rules('comment3', 'Message', 'trim|required|xss_clean');
        $this->form_validation->set_rules('linkurl', 'Lien', 'trim|required|prep_url|valid_url|xss_clean|callback_valid_youtube_url');

        if ($this->form_validation->run() == FALSE) {
            $this->layout->view('wall/mc_actus', $data);
        } else {
            $message = ucfirst($this->input->post('comment3'));
            $lien = $this->input->post('linkurl');
            $photo = '';

            $logged_in = $this->session->userdata('logged_in');
            if ($logged_in == 1) {
                $this->mc_actus_model->insert_actus($message, $lien, $photo, $user_visited);
                redirect('actualite/' . $user_visited, 'refresh');
            } else {
                redirect('login', 'refresh');
            }
        }
    }

    public function form_wall_user_comment() {
        $usercomment = $this->input->post('usercomment');
        $messageid = $this->input->post('messageid');
        echo $this->mc_actus_model->insert_comments();
    }

    public function ajax_actus($uid, $offset = null) {
//        $user_visited = (empty($infos_profile)) ? $this->session->userdata('uid') : $infos_profile->id;
       $data = $this->data; 
        
        if ($this->mc_actus_model->liste_actus(10, $offset, $uid)) {
//            $data['articles'] = $this->article_model->liste_article(20, $offset);
            $data['messages'] = $this->mc_actus_model->liste_actus(10, $offset, $uid);

            $this->load->view('wall/mc_actus_ajax', $data);
        } else {
//          echo 'End';
        }
    }
    
    public function handle_upload_photo() {
        if (isset($_FILES['photo']) && !empty($_FILES['photo']['name'])) {
            if ($this->upload->do_upload('photo')) {
                $upload_data = $this->upload->data();
                $_POST['photo'] = $upload_data['file_name'];
                return true;
            } else {
                $this->form_validation->set_message('handle_upload', $this->upload->display_errors());
                return false;
            }
        } else {
            $this->form_validation->set_message('handle_upload', "Vous devez télécharger une image !");
            return false;
        }
    }

    public function valid_youtube_url() {
        $lien = $this->input->post('linkurl');
        $preg_youtube = preg_match('/https?:\/\/(?:www\.)?youtu(?:\.be|be\.com)\/watch(?:\?(.*?)&|\?)v=([a-zA-Z0-9_\-]+)(\S*)/i', $lien);

        if (!$preg_youtube) {
            $this->form_validation->set_message('valid_youtube_url', 'Vous devez renseigner une URL youtube valide !');
            return false;
        } else {
            return true;
        }
    }

    public function delete($message_id) {
//        $user_id = $this->user_infos->uri_user();
        $user_id = $this->session->userdata('uid');
//        $infos_profile = $this->user_model->getUser($user_id);
//        $user_visited = (empty($infos_profile)) ? $this->session->userdata('uid') : $infos_profile->id;

        $this->mc_actus_model->delete_actus($message_id);
        redirect('actualite/' . $user_id, 'refresh');
    }

    public function delete_comment($user_id, $comment_id) {
//        $user_id = $this->user_infos->uri_user();
//        $infos_profile = $this->user_model->getUser($user_id);
//        $user_visited = (empty($infos_profile)) ? $this->session->userdata('uid') : $user_id;
        $this->mc_actus_model->delete_comments($comment_id);
        redirect('actualite/' . $user_id, 'refresh');
    }

}