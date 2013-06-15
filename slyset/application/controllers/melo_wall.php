<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class melo_wall extends CI_Controller
{
    
    public function __construct()
    {
      parent::__construct();
      
      $this->layout->ajouter_css('slyset');
      $this->load->model('wallm');
      $this->load->library('session');

	//$this->load->helper('url');
    }
  
    public function index($user_id,$uid = NULL)
    {
      $this->page($user_id);
    }
  
    public function page($user_id)
    {
      $datas = array();
      $datas['sidebar_left'] = $this->load->view('sidebars/sidebar_left', '', TRUE);
      $datas['sidebar_right'] = $this->load->view('sidebars/sidebar_right', '', TRUE);
      
      $data_follow = $this->wallm->get_following($user_id);
    //  var_dump($data_follow);
    $listforin = "";
    $datas['info_user'] = $this->wallm->get_info_user($user_id);
      foreach ($data_follow as $following)
      
      	{
			$listforin .= $following->Utilisateur_id.',';

      	}
          $listforin_sql = substr($listforin,0,-1);

     $data_wall_id_mu = $this->wallm->get_entities_id_mu($listforin_sql);
     
    //$data_wall_video = $this->wallm->get_entity_video($listforin);
     $data_wall_id_me = $this->wallm->get_entities_id_me($listforin_sql);
     if(isset($data_wall_id_me)&&isset($data_wall_id_mu))
	$datas['data_all_wall']  =array_merge($data_wall_id_me,$data_wall_id_mu);
//sort le array merge by date
      //var_dump(	$datas['data_all_wall']);

      $this->layout->view('wall/melo_actu', $datas);
    }
  
}