<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class melo_abonnements extends CI_Controller 
{
    
    public function __construct()
    {
      parent::__construct();
      
      $this->layout->ajouter_css('slyset');
      
      $this->layout->ajouter_js('jquery.imagesloaded.min');
      $this->layout->ajouter_js('jquery.masonry.min');
      $this->layout->ajouter_js('jquery.stapel');
<<<<<<< HEAD
            $this->load->model('myfollower');

        $this->layout->set_id_background('abonnements');
    }
  
    public function index($user_id)
    {
      $this->page($user_id);
    }
  
    public function page($user_id)
=======
      
        $this->layout->set_id_background('abonnements');
    }
  
    public function index()
    {
      $this->page();
    }
  
    public function page()
>>>>>>> 0a5f106366459ee42989c8cd393a8c35e10afe2d
    {
      $datas = array();
      $datas['sidebar_left'] = $this->load->view('sidebars/sidebar_left', '', TRUE);
      $datas['sidebar_right'] = $this->load->view('sidebars/sidebar_right', '', TRUE);
      
<<<<<<< HEAD
     
      $datas['all_follower'] = $this->myfollower->get_all_abonnement($user_id);
      //$this->layout->views('3');
    
    
=======
      //$this->layout->views('3');
>>>>>>> 0a5f106366459ee42989c8cd393a8c35e10afe2d
      $this->layout->view('follower/melo_abonnements', $datas);
    }
  
}