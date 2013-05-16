<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{
  
    public function __construct()
    {
        parent::__construct();
        $this->output->enable_profiler(true);
        $this->layout->ajouter_css('slyset');

        $this->load->helper('form');
        $this->load->model('login_model');
//        $this->load->model('user_model');
  //      $this->load->model('Facebook_Model');

        $this->layout->ajouter_js('jsdate');
        $this->layout->ajouter_js('calendar');
        $this->layout->ajouter_js('carouFredSel');
        
        $this->layout->set_id_background('home');
        $this->layout->set_description('Slyset');
        $this->layout->set_titre('Slyset');
    }

    public function index($uid = NULL)
    {
        if(!empty($uid)){
            $this->homepage();
        } else {
            $this->homepage();
        }
    }

    public function homepage()
    {
        $this->load->model('homepage');
        
//        $data = $this->user_model->getAll();
//        var_dump($data);
        
        $datas = array();
        
//        if($this->session->userdata('logged_in')){
//            $user_id = $this->session->userdata('uid');
//            $datas['uid'] = $user_id;
//            
//            print_r($this->session->all_userdata());
//            echo '<br /><br />'.$this->uri->segment(1);
//        }

        $datas['sidebar_left']      = $this->load->view('sidebars/sidebar_left', '', TRUE);
        $datas['sidebar_right']     = $this->load->view('sidebars/sidebar_right', '', TRUE);
        $datas['concert_date']      = $this->homepage->get_concert();   
        $datas['all_date_calendar'] = "";
        
        foreach ($datas['concert_date'] as $datas['concert_date_uniq']){
            if (isset ($datas['concert_date_uniq']->date)){
                $datas['evenement']            = explode('-', $datas['concert_date_uniq']->date);  
                $datas['all_date_calendar']   .= 
                $datas['format_date_calendar'] =  '['.$datas['evenement'][1].','.substr($datas['evenement'][2],0,2).','.$datas['evenement'][0].'],' ;
            }
        }

        $this->layout->view('homepage', $datas);
    }
    
    public function _remap($method, $params = array())
    {
        if (method_exists($this, $method))
        {
            return call_user_func_array(array($this, $method), $params);
        }

        show_404();
    }
    
}