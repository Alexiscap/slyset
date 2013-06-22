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

        $data['notification']      = $this->input->cookie('notification');
        $data['sidebar_left']      = $this->load->view('sidebars/sidebar_left', '', TRUE);
        $data['sidebar_right']     = $this->load->view('sidebars/sidebar_right', '', TRUE);
        $data['articles']          = $this->article_model->liste_article('updated', 'desc');
        $data['newbies']           = $this->user_model->getNewbies();
        $data['concert_date']      = $this->homepage->get_concert(); 
        $data['dates']      = $this->homepage->get_date();   
  
        $data['all_date_calendar'] = "";
        $data['all_info_concert'] = "";
		
		foreach ($data['dates'] as $data['date'])
		{
			$title = "";

    		foreach ($data['concert_date'] as $data['concert_date_uniq'])
      			{ 
      				if($data['concert_date_uniq']->date == $data['date']->date)
                	{
           		 		if (isset ($data['concert_date_uniq']->date))
            			{
		            		$data['all_info_concert'] .= 
        		    		$data['concert_date_uniq']->titre ;
     	 		          	$data['evenement'] = explode('-', $data['concert_date_uniq']->date); 
        		        	date_default_timezone_set('Europe/Paris');
                			$datestring = "%Y-%m-%d %h:%i:%s";
							$time = time();
							$today = mdate($datestring, $time)."<pre>";
				
              				if($today<$data['concert_date_uniq']->date)
             				{
              					$link = "http://127.0.0.1/slyset/index.php/mc_concerts/".$data['concert_date_uniq']->Utilisateur_id.'/#'.$data['concert_date_uniq']->id;
							}
              				else
              				{
                    			$link = "http://127.0.0.1/slyset/index.php/mc_concerts/concert_passe/".$data['concert_date_uniq']->Utilisateur_id.'/#'.$data['concert_date_uniq']->id;
							}
//							print $data['concert_date_uniq']->seconde_partie;
					       
               
        					$title .= '<a href='.$link.'> '.$data['concert_date_uniq']->titre.' + '.$data['concert_date_uniq']->seconde_partie.' </a> </br> '.$data['concert_date_uniq']->salle.' - '.$data['concert_date_uniq']->ville.'</br>';		
            				
            				$data['format_date_calendar'] =  '{ Title:"<span>Concert du '.substr($data['evenement'][2],0,2).'/'.$data['evenement'][1].'/'.$data['evenement'][0].'</span></br>'.$title.'", Date: new Date("'.$data['evenement'][1].'/'.substr($data['evenement'][2],0,2).'/'.$data['evenement'][0].'") },';

						}

					}
    	        
       	 		}
       	 	$data['all_date_calendar']   .=  $data['format_date_calendar'] ;
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