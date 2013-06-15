<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{
  
    public function __construct()
    {
        parent::__construct();
<<<<<<< HEAD
   //     $this->output->enable_profiler(true);
=======
//        $this->output->enable_profiler(true);
>>>>>>> 0a5f106366459ee42989c8cd393a8c35e10afe2d
        $this->layout->ajouter_css('slyset');

        $this->load->helper(array('cookie', 'form'));
        $this->load->model(array('login_model', 'homepage', 'user_model', 'article_model'));
//        $this->load->model('user_model');
  //      $this->load->model('Facebook_Model');
        $this->load->helper('date');

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
<<<<<<< HEAD

=======
        
>>>>>>> 0a5f106366459ee42989c8cd393a8c35e10afe2d
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

<<<<<<< HEAD
        $datas['sidebar_left']      = $this->load->view('sidebars/sidebar_left', '', TRUE);
        $datas['sidebar_right']     = $this->load->view('sidebars/sidebar_right', '', TRUE);
        $datas['concert_date']      = $this->homepage->get_concert();   
        
        $datas['all_date_calendar'] = "";
        $datas['all_info_concert'] = "";
              
        $datas['notification']      = $this->input->cookie('notification');
 
        $datas['articles']          = $this->article_model->liste_article('updated', 'desc');
        $datas['newbies']           = $this->user_model->getNewbies();

        
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
			
=======
        $data['notification']      = $this->input->cookie('notification');
        $data['sidebar_left']      = $this->load->view('sidebars/sidebar_left', '', TRUE);
        $data['sidebar_right']     = $this->load->view('sidebars/sidebar_right', '', TRUE);
        $data['articles']          = $this->article_model->liste_article('updated', 'desc');
        $data['newbies']           = $this->user_model->getNewbies();
        $data['concert_date']      = $this->homepage->get_concert();   
        $data['all_date_calendar'] = "";
        
        foreach ($data['concert_date'] as $data['concert_date_uniq']){
            if (isset($data['concert_date_uniq']->date)){
                $data['evenement']            = explode('-', $data['concert_date_uniq']->date);  
                $data['all_date_calendar']   .= 
                $data['format_date_calendar'] =  '['.$data['evenement'][1].','.substr($data['evenement'][2],0,2).','.$data['evenement'][0].'],' ;
>>>>>>> 0a5f106366459ee42989c8cd393a8c35e10afe2d
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