<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{
  
    public function __construct()
    {
        parent::__construct();
//        $this->output->enable_profiler(true);
        $this->layout->ajouter_css('slyset');

        $this->load->helper(array('cookie', 'form'));
        $this->load->model(array('login_model', 'homepage', 'user_model', 'article_model'));
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
                $this->load->helper('date');

//        $data = $this->user_model->getAll();
//        var_dump($data);
        
        $data = array();
        
//        if($this->session->userdata('logged_in')){
//            $user_id = $this->session->userdata('uid');
//            $data['uid'] = $user_id;
//            
//            print_r($this->session->all_userdata());
//            echo '<br /><br />'.$this->uri->segment(1);
//        }

        $datas['notification']      = $this->input->cookie('notification');
        $datas['sidebar_left']      = $this->load->view('sidebars/sidebar_left', '', TRUE);
        $datas['sidebar_right']     = $this->load->view('sidebars/sidebar_right', '', TRUE);
        $datas['articles']          = $this->article_model->liste_article('updated', 'desc');
        $datas['newbies']           = $this->user_model->getNewbies();
        $datas['concert_date']      = $this->homepage->get_concert();   
        $datas['all_date_calendar'] = "";
                $datas['all_info_concert'] = "";

        foreach ($datas['concert_date'] as $datas['concert_date_uniq'])
        {
     //   var_dump ($datas['concert_date_uniq']);
            if (isset ($datas['concert_date_uniq']->date))
            {
            	$datas['all_info_concert'] .= 
            	$datas['concert_date_uniq']->titre ;
                $datas['evenement'] = explode('-', $datas['concert_date_uniq']->date); 
                date_default_timezone_set('Europe/Paris');
                $datestring = "%Y-%m-%d %h:%i:%s";
				$time = time();

				$today = mdate($datestring, $time)."<pre>";
            //  echo  $datas['concert_date_uniq']->date."<pre>";
              if($today<$datas['concert_date_uniq']->date)
              {
              $link = "http://127.0.0.1/slyset/index.php/mc_concerts/".$datas['concert_date_uniq']->Utilisateur_id.'/#'.$datas['concert_date_uniq']->id;
}
              else
              {
                    $link = "http://127.0.0.1/slyset/index.php/mc_concerts/concert_passe/".$datas['concert_date_uniq']->Utilisateur_id.'/#'.$datas['concert_date_uniq']->id;
				}
               //var_dump(getdate());
             
        
                $datas['all_date_calendar']   .= 
            	$datas['format_date_calendar'] =  '{ Title:"Concert du '.$datas['concert_date_uniq']->date.'</br><a href='.$link.'> '.$datas['concert_date_uniq']->titre.' & '.$datas['concert_date_uniq']->seconde_partie.' </a> </br> '.$datas['concert_date_uniq']->salle.' - '.$datas['concert_date_uniq']->ville.'", Date: new Date("'.$datas['evenement'][1].'/'.substr($datas['evenement'][2],0,2).'/'.$datas['evenement'][0].'") },';
				//print $datas['format_date_calendar'];
			
            }
        }

        $this->layout->view('homepage', $data);
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