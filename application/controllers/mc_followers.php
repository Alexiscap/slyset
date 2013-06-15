<<<<<<< HEAD
﻿<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
=======
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
>>>>>>> 0a5f106366459ee42989c8cd393a8c35e10afe2d

class Mc_followers extends CI_Controller 
{
    
    public function __construct()
    {
      parent::__construct();
      
      $this->layout->ajouter_css('slyset');
      
      $this->layout->ajouter_js('jquery.imagesloaded.min');
      $this->layout->ajouter_js('jquery.masonry.min');
      $this->layout->ajouter_js('jquery.stapel');
<<<<<<< HEAD
      $this->load->model('follower');
        $this->layout->set_id_background('followers');
    }
  
    public function index($user_id,$uid = NULL)

    {    
    $uid = $this->session->userdata('uid');

 	  // if( $user_id ==$uid)
  	 	//{
    		$this->page($user_id);
    	//}
    	//else
    	//	{
    	  //    	show_404();
    		//}
    }	
    
  
    public function page($user_id)
=======
      
        $this->layout->set_id_background('followers');
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
      $datas['all_follower'] = $this->follower->get_all_follower_user($user_id);
      //$this->layout->views('3');
      $this->layout->view('follower/mc_followers', $datas);
    }
    
    public function musicien($user_id)
    
    	{
    	 $datas = array();
      $datas['sidebar_left'] = $this->load->view('sidebars/sidebar_left', '', TRUE);
      $datas['sidebar_right'] = $this->load->view('sidebars/sidebar_right', '', TRUE);
      $datas['all_follower'] = $this->follower->get_follower_bytype($user_id,2);
      //$this->layout->views('3');
      $this->layout->view('follower/musicien', $datas);
    	
    	
    	}
    	
    	public function melomane($user_id)
    
    	{
    	 $datas = array();
      $datas['sidebar_left'] = $this->load->view('sidebars/sidebar_left', '', TRUE);
      $datas['sidebar_right'] = $this->load->view('sidebars/sidebar_right', '', TRUE);
      $datas['all_follower'] = $this->follower->get_follower_bytype($user_id,1);
      //$this->layout->views('3');
      $this->layout->view('follower/melomane', $datas);
    	
    	
    	}
    	
    	
=======
      
      //$this->layout->views('3');
      $this->layout->view('follower/mc_followers', $datas);
    }
>>>>>>> 0a5f106366459ee42989c8cd393a8c35e10afe2d
  
}