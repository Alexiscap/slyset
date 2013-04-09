<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
  public function __construct()
  {
    parent::__construct();
    $this->load->helper('assets_helper');
    $this->load->library('layout');

    $this->layout->ajouter_css('reset');
    $this->layout->ajouter_css('tpl_header-footer');
    $this->layout->ajouter_css('tpl_sidebar-left');
    $this->layout->ajouter_css('slyset');
  }
  
	public function index()
	{
		//$this->load->view('welcome_message');
    $this->homepage();
	}
  
  public function homepage(){
    $datas = array();
    $datas['sidebar_left'] = $this->load->view('sidebars/sidebar_left', '', TRUE);
    $datas['sidebar_right'] = $this->load->view('sidebars/sidebar_right', '', TRUE);

    $this->layout->view('homepage', $datas);
  }
  
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */