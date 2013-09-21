<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mc_partitions extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->layout->ajouter_css('slyset');
        $this->layout->ajouter_css('pop_in');
        $this->layout->ajouter_css('colorbox');
        
        $this->layout->ajouter_js('jquery.colorbox');

        $this->load->helper('form');
        $this->load->model(array('perso_model', 'user_model', 'document_model','achat_model'));

        $this->layout->set_id_background('partitions');

        $this->user_id = (is_numeric($this->uri->segment(2))) ? $this->uri->segment(2) : $this->uri->segment(3);
        $output = $this->perso_model->get_perso($this->user_id);

        $sub_data = array();
        $sub_data['profile'] = $this->user_model->getUser($this->user_id);
        
        $this->layout->set_description('Retrouvez '.$sub_data['profile']->login.' sur Slyset et découvrez sa musique, ses prochains concerts, ses photos, ses vidéos, ses livrets, ses partitions...');
        $this->layout->set_titre('Retrouvez tous les livrets et les partitions de '.$sub_data['profile']->login.' - Slyset');
        $this->layout->set_keyword($sub_data['profile']->login.', musicien, musique en ligne, streaming musique, slyset, concerts, photos, vidéos, actualités musique');
        
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
      
        $data['get_album'] = $this->document_model->get_all_album_user($user_visited);
        
        $all_album = "";
        foreach ($data['get_album'] as $album_id) {
            $all_album .= "'" . $album_id->id . "',";
        }
        $album_where_in = substr($all_album, 0, -1);
        if (!empty($album_where_in)) {
            $data['all_doc_paroles'] = $this->document_model->get_document_paroles($album_where_in);
            $data['all_doc_partition'] = $this->document_model->get_document_partition($album_where_in);
        }
        $data['all_morceau'] = $this->document_model->get_all_album_moreceaux_user($user_visited);

        //  $data['get_doc'] = $this->document_model->get_all_morceau_doc($user_visited);
        //  var_dump($data['get_doc']);
        // $data['get_morc'] = $this->document_model->get_morceau_album();
        //    var_dump($data['get_morc']);
        //$data['all_morc'] = $this->document_model->all_doc($user_visited);
        $this->layout->view('partition/mc_partitions', $data);
    }

    public function upload() {
        
        /*
         * 
         * /!\ Commentaire d'Alexis : Utiliser de préférence la librairie d'upload de codeigniter qui gère sa beaucoup plus facilement et proprement /!\
         * 
         */
        
        error_reporting(E_ALL | E_STRICT);

        $this->load->helper("upload.class");

        $upload_handler = new UploadHandler();

        header('Pragma: no-cache');
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Content-Disposition: inline; filename="files.json"');
        header('X-Content-Type-Options: nosniff');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: OPTIONS, HEAD, GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: X-File-Name, X-File-Type, X-File-Size');

        switch ($_SERVER['REQUEST_METHOD']) {
            case 'OPTIONS':
                break;
            case 'HEAD':
            case 'GET':
                $upload_handler->get();
                break;
            case 'POST':
                if (isset($_REQUEST['_method']) && $_REQUEST['_method'] === 'DELETE') {
                    $upload_handler->delete();
                } else {
                    $upload_handler->post();
                }
                break;
            case 'DELETE':
                $upload_handler->delete();
                break;
            default:
                header('HTTP/1.1 405 Method Not Allowed');
        }
    }

    public function panier() {
        $prix = $this->input->post('prix');
        $doc_id = $this->input->post('doc_id');
        $nom = $this->input->post('nom');

        $panier = $this->document_model->panier($prix, $doc_id, $nom);
    }

}