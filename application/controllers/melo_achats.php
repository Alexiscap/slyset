<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Melo_achats extends CI_Controller {

    var $data;

    public function __construct() {
        parent::__construct();

        $this->layout->ajouter_css('slyset');
        $this->layout->ajouter_css('colorbox');
        $this->layout->ajouter_css('popin');

        $this->layout->ajouter_js('jquery.tablesorter');
        $this->layout->ajouter_js('jquery.colorbox');

        $this->load->model(array('user_model', 'mc_actus_model', 'achat_model','musique_model','follower_model'));
        $this->load->helper(array('form','download'));
        $this->load->library('zip');
        $this->layout->set_id_background('achats');

        $this->user_id = (is_numeric($this->uri->segment(2))) ? $this->uri->segment(2) : $this->uri->segment(3);

        $sub_data = array();
        $data_notif['count_notif'] = $this->achat_model->notif_panier($this->session->userdata('uid'));
        $sub_data['profile'] = $this->user_model->getUser($this->user_id);

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

        if ($user_id == $uid) {
            $this->page($infos_profile);
        } else {
            show_404();
        }
    }

    public function page($infos_profile) {
        $data = $this->data;
        $uid = $this->session->userdata('uid');

        $user_visited = (empty($profile)) ? $uid : $profile->id;
        if (!empty($profile)) {
            $data['infos_profile'] = $profile;
        }
        //infos stats de la cover
        $data['playlists'] = $this->musique_model->get_my_playlist($user_visited);
        $data['all_following'] = $this->follower_model->get_all_abonnement($user_visited);
        $data['concert_cover'] = $this->user_model->concert_cover($user_visited);

        $data['cmd'] = $this->achat_model->get_achat($user_visited);
        //print $this->input->post("article-all");
        $data['total_album_panier'] = 0;
        $data['total_morceaux_panier'] = 0;
        $data['total_paroles_panier'] = 0;
        $data['total_partition_panier'] = 0;
        $data['total_album_history'] = 0;
        $data['total_morceaux_history'] = 0;
        $data['total_paroles_history'] = 0;
        $data['total_partition_history'] = 0;

        foreach ($data['cmd'] as $commande) {
            if ($commande->status == "P" && $commande->type == 'album' ) {
                $data['total_album_panier'] = $data['total_album_panier'] + count($commande);
            }
            if ($commande->status == "P" && $commande->type == 'morceau' ) {
                $data['total_morceaux_panier'] = $data['total_morceaux_panier'] + count($commande);
            }
            if ($commande->status == "P" && $commande->type == 'paroles' ) {
                $data['total_paroles_panier'] = $data['total_paroles_panier'] + count($commande);
            }
            if ($commande->status == "P" && $commande->type == 'partition' ) {
                $data['total_partition_panier'] = $data['total_partition_panier'] + count($commande);
            }
            if ($commande->status == "V" && $commande->type == 'album' ) {
                $data['total_album_history'] = $data['total_album_history'] + count($commande);
            }
            if ($commande->status == "V" && $commande->type == 'morceau' ) {
                $data['total_morceaux_history'] = $data['total_morceaux_history'] + count($commande);
            }
            if ($commande->status == "V" && $commande->type == 'paroles' ) {
                $data['total_paroles_history'] = $data['total_paroles_history'] + count($commande);
            }
            if ($commande->status == "V" && $commande->type == 'partition' ) {
                $data['total_partition_history'] = $data['total_partition_history'] + count($commande);
            }
        }
        $this->layout->view('achat/melo_achats', $data);
    }

    public function delete_panier() {
        $this->achat_model->delete_panier($this->input->post("commande"));
    }

    public function download_file($user_id,$id_commandes)
    {
        $id_commande = explode('%20',$id_commandes);

        $info_dnld = $this->achat_model->get_item_for_cmd_dwnld($id_commande);

        foreach ($info_dnld as $path_n => $info_cmd)
        {
            if($info_cmd->doc_user != null)
            {
                $path_n = "./files/".$info_cmd->alb_user."/albums/".str_replace(" ", "_", $info_cmd->name_alb)."/".$info_cmd->type_doc.'/'.$info_cmd->path_doc;
            
                $this->zip->read_file($path_n); 

            }
            if($info_cmd->doc_user == null && $info_cmd->track_fname !=null)
            {
                $path_n = "./files/".$info_cmd->alb_user."/musique/".str_replace(" ", "_", $info_cmd->name_alb)."/".$info_cmd->track_fname;
                $this->zip->read_file($path_n); 
            }
    
            if($info_cmd->doc_user == null && $info_cmd->track_fname ==null)
            {
                $path_n = "./files/".$info_cmd->alb_user."/musique/".str_replace(" ", "_", $info_cmd->name_alb)."/";
                $this->zip->read_dir($path_n,FALSE); 

            }
        }

        $this->zip->download('slyset_mes_telechargement.zip');

    }

}