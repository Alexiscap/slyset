<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Melo_playlist extends CI_Controller {

    var $data;

    public function __construct() {
        parent::__construct();

        $this->layout->ajouter_css('slyset');
        $this->layout->ajouter_css('information');

        $this->layout->ajouter_js('jquery.colorbox');
    	$this->layout->ajouter_js('jquery.reveal');

        

        $this->load->model(array('user_model','musique_model','follower_model','achat_model'));
        $this->load->helpers(array('date','form'));

        $this->layout->set_id_background('playlist');

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
        $type_account = $this->session->userdata('account');

       // if ($user_id == $uid) {
            $this->page($user_id);
        /*} elseif (isset($uid)) {
            redirect('home/' . $uid, 'refresh');
        } else {
            redirect('home', 'refresh');
        }*/
    }

    public function page($user_id) {
        $data = $this->data;
        $data['playlists'] = $this->musique_model->get_my_playlist($user_id);
    	$data['morceaux_playlist'] = $this->musique_model->get_morceau_by_playlist_user($user_id);
    	$data['all_following'] = $this->follower_model->get_all_abonnement($user_id);
		$my_panier = $this->achat_model->all_panier();
		$data['all_panier'] ="";
			foreach($my_panier as $mpanier):
      	 $data['all_panier'] .= '/'.$mpanier->Morceaux_id.'/';
      	 endforeach;
		$my_like_morceau = $this->musique_model->get_my_like_morceau();
		//$data['artistes'] = $this->musique_model->get_n_artiste($user_id);
		$data['all_my_like'] ="";
      	foreach($my_like_morceau as $mlike):
      	 $data['all_my_like'] .= '/'.$mlike->morceaux_id.'/';
      	 endforeach;
      
       	$this->layout->view('playlist/melo_playlist', $data);
    }
    
 	public function add_like()
 	
 	{
 		$user = $this->session->userdata('uid');
 		$morceau =  $this->input->post('id_morceau');
 		$this->musique_model->add_like_morceau($user,$morceau);
 	}
 	
 	 
 	public function delete_like()
 	
 	{
 		$user = $this->session->userdata('uid');
 		$morceau =  $this->input->post('id_morceau');
 		$this->musique_model->delete_like_morceau($user,$morceau);
 	}
 	
 	public function delete_from_pl()
 	{
 		$user = $this->session->userdata('uid');
 		$morceau =  $this->input->post('track_pl');
 		$this->musique_model->delete_morceau_playlist($user,$morceau);
 	}
 	
 	public function pl_to_panier()
 	{
 		$user = $this->session->userdata('uid');
 		$morceau =  $this->input->post('track_pl');
		$id_track = array($morceau);
 		$return = $this->musique_model->pl_to_panier($user,$id_track);
		print $return;
 	}
 	
 	public function change_title_pl()
 	{
 		$old =  $this->input->post('title_init');
 		$new =  $this->input->post('title_new');
 		$this->musique_model->update_title($new,$old);

 	}

}