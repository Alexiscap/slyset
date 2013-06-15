<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mc_photos extends CI_Controller 
{
    
    public function __construct()
    {
        parent::__construct();

        $this->layout->ajouter_css('slyset');

        $this->layout->ajouter_js('jquery.imagesloaded.min');
        $this->layout->ajouter_js('jquery.masonry.min');
        $this->layout->ajouter_js('jquery.stapel');
        
        $this->load->model(array('perso_model', 'user_model'));
      
        $this->layout->set_id_background('photos_videos');
        
        $this->user_id = (is_numeric($this->uri->segment(2))) ? $this->uri->segment(2) : $this->uri->segment(3);
        $output = $this->perso_model->get_perso($this->user_id);
        
        $sub_data = array();
        $sub_data['profile'] = $this->user_model->getUser($this->user_id);
        $sub_data['perso'] = $output;
        
        if(!empty($output)){
            $this->layout->ajouter_dynamique_css($output->theme_css);
            write_css($output);
        }
        
        $this->data = array(
            'sidebar_left'  => $this->load->view('sidebars/sidebar_left', '', TRUE),
            'sidebar_right' => $this->load->view('sidebars/sidebar_right', $sub_data, TRUE)
        );
    }
  
    public function index()
    {
        $this->page();
    }
  
    public function page()
    {
      $datas = array();
      $datas['sidebar_left'] = $this->load->view('sidebars/sidebar_left', '', TRUE);
      $datas['sidebar_right'] = $this->load->view('sidebars/sidebar_right', '', TRUE);
      
      //$this->layout->views('3');
      $this->layout->view('photos/mc_photos', $datas);
    }
  
}