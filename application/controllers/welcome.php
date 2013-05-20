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
    
      $this->layout->ajouter_css('slyset');
      
      $this->layout->ajouter_js('jsdate');
      $this->layout->ajouter_js('calendar');
  }
  
	public function index()
	{
      //$this->load->view('welcome_message');		 
   		$this->homepage();
	}
  
  public function homepage(){
      $this->load->model('homepage');

      $datas = array();

      $datas['sidebar_left']  = $this->load->view('sidebars/sidebar_left', '', TRUE);
      $datas['sidebar_right'] = $this->load->view('sidebars/sidebar_right', '', TRUE);
      $datas['concert_date']  = $this->homepage->get_concert();   
      $datas['all_date_calendar'] ="";
      foreach ($datas['concert_date'] as $datas['concert_date_uniq'])
      {
     	 if (isset ($datas['concert_date_uniq']->date))
     	 {
			$datas['evenement'] = explode('-', $datas['concert_date_uniq']->date);  
  			$datas['all_date_calendar'] .= 
			$datas['format_date_calendar'] =  '['.$datas['evenement'][1].','.substr($datas['evenement'][2],0,2).','.$datas['evenement'][0].'],' ;
     			    

      	}
      }
    
    
      $this->layout->view('homepage', $datas);
  }
  
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */