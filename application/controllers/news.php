<?php 

class News extends CI_Controller
{
    public function _construct()
    {
      parent::_construct();
      $this->load->helper('url');
      $this->load->helper('assets');
    }
  
    public function index()
    {
        $this->accueil();
    }
 
    public function accueil()
    {
        $data = array();
        $data['pseudo'] = 'Arthur';
        $data['email'] = 'email@ndd.fr';
        $data['en_ligne'] = true;
 
        $this->load->view('vue', $data, false);
    }
}