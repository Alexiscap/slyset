<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mc_musique extends CI_Controller 
{
    
    public function __construct()
    {
      parent::__construct();
      
      $this->layout->ajouter_css('slyset');
      
      $this->layout->ajouter_js('jquery.imagesloaded.min');
      $this->layout->ajouter_js('jquery.masonry.min');
      $this->layout->ajouter_js('jquery.stapel');
      
        $this->layout->set_id_background('musique');
    }
  
    public function index($user_id)
    {
        $uid = $this->session->userdata('uid');
        
        if($user_id != $uid && !empty($user_id)){
            $user_id = $this->user_infos->uri_user();
            $infos_profile = $this->user_model->getUser($user_id);
            $this->page($infos_profile);
        } else {
            redirect('home/'.$uid, 'refresh');
        }
    }
  
    public function page($infos_profile)
    {
      $datas = array();
      $datas['sidebar_left'] = $this->load->view('sidebars/sidebar_left', '', TRUE);
      $datas['sidebar_right'] = $this->load->view('sidebars/sidebar_right', '', TRUE);
      
      //$this->layout->views('3');
      $this->layout->view('musique/mc_musique', $datas);
    }
  
}