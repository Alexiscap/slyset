<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mc_reglages extends CI_Controller 
{
    var $data;
    var $user_id;
    
    public function __construct()
    {
        parent::__construct();

        $this->layout->ajouter_css('slyset');
        $this->layout->ajouter_js('jquery.placeheld.min');

        $this->load->helper(array('form', 'comments_helper'));
        $this->load->model(array('mc_actus_model', 'perso_model', 'user_model'));
        $this->load->library(array('form_validation', 'layout'));

        $this->layout->set_id_background('reglages');
        
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
  
    public function index($user_id, $uid = NULL)
    {
//        $user_id = $this->user_infos->uri_user();
        $uid = $this->session->userdata('uid');

        if($user_id == $uid){
            $this->page();
        }	elseif($user_id != $uid && !empty($user_id)){
//            $user_id = $this->user_infos->uri_user();
            
//            $infos_profile = $this->user_model->getUser($user_id);
//            $this->page($infos_profile);
          
            redirect('/home/'.$uid, 'refresh');
        } else {
            show_404();
        }
    }	
  
    public function page($infos_profile = NULL)
    {
        $data = $this->data;
        $data['profile'] = $this->user_model->getUser($this->user_id);
        
        $this->layout->view('reglage/mc_reglages', $data);
    }
    
    public function update_user($infos_profile = NULL)
    {
        $uid = $this->session->userdata('uid');
        $this->user_id = $this->uri->segment(3);
        $data = $this->data;
        $data['profile'] = $this->user_model->getUser($this->user_id);
        
        $dynamic_path = './files/profiles/';
        if (is_dir($dynamic_path) == false){
            mkdir($dynamic_path, 0755, true);
        }
        
        $config['upload_path']   = $dynamic_path;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']    = '100000';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';
        $this->load->library('upload', $config);
        
        $this->form_validation->set_rules('cover', 'Photo de couverture', 'callback_handle_upload_cover');
        $this->form_validation->set_rules('thumb', 'Photo de profil', 'callback_handle_upload_thumb');
        $this->form_validation->set_rules('login', 'Nom de scène', 'trim|xss_clean');
        $this->form_validation->set_rules('description', 'Bio', 'trim|xss_clean');
        $this->form_validation->set_rules('site', 'Site Web', 'trim|xss_clean|callback_url_checking');
        $this->form_validation->set_rules('twitter', 'Twitter', 'trim|xss_clean|callback_url_checking');
        $this->form_validation->set_rules('facebook', 'Facebook', 'trim|xss_clean|callback_url_checking');
        $this->form_validation->set_rules('googleplus', 'Google +', 'trim|xss_clean|callback_url_checking');
        $this->form_validation->set_rules('stylemusicjoue', 'Style de musique joué', '');
        $this->form_validation->set_rules('stylemusicinstru', 'Style d\'instrument', '');
        $this->form_validation->set_rules('submit', 'Modification du compte', '');
             
        if($this->form_validation->run() == FALSE){
            $this->layout->view('reglage/mc_reglages', $data);
        } else {
            $cover            = $this->input->post('cover');
            $this->session->set_userdata('cover', $cover);
            
            $thumb            = $this->input->post('thumb');
            $this->session->set_userdata('thumb', $thumb);
            
            $login            = $this->input->post('login');
            $this->session->set_userdata('login', $login);
            
            $description      = $this->input->post('description');
            $website          = $this->input->post('site');
            $twitter          = $this->input->post('twitter');
            $facebook         = $this->input->post('facebook');
            $googleplus       = $this->input->post('googleplus');
            
            $array_stylemusicjoue   = $this->input->post('stylemusicjoue');
            $stylemusicjoue   = join(', ',$array_stylemusicjoue);            

            $array_stylemusicinstru = $this->input->post('stylemusicinstru');
            $stylemusicinstru   = join(', ',$array_stylemusicinstru);
            $this->session->set_userdata('instrument', $stylemusicinstru);
            

            $this->user_model->update_user($login, $description, $website, $twitter, $facebook, $googleplus, $stylemusicjoue, $stylemusicinstru, $cover, $thumb);

            redirect('reglages/'.$uid, 'refresh');
//            print_r($this->session->all_userdata());
        }
    }
    
    function handle_upload_cover()
    {
        if (isset($_FILES['cover']) && !empty($_FILES['cover']['name'])){
            if ($this->upload->do_upload('cover')){
                $upload_data    = $this->upload->data();
                $_POST['cover'] = $upload_data['file_name'];
                return true;
              } else {
                  $this->form_validation->set_message('handle_upload', $this->upload->display_errors());
                  return false;
            }
        } else {
//            $this->form_validation->set_message('handle_upload', "You must upload an image!");
            $_POST['cover'] = $this->session->userdata('cover');
            return true;
        }
    }
    
    function handle_upload_thumb()
    {
        if (isset($_FILES['thumb']) && !empty($_FILES['thumb']['name'])){
            if ($this->upload->do_upload('thumb')){
                $upload_data    = $this->upload->data();
                $_POST['thumb'] = $upload_data['file_name'];
                return true;
            } else {
//             $this->form_validation->set_message('handle_upload', $this->upload->display_errors());
              return false;
            }
        } else {
//            $this->form_validation->set_message('handle_upload', "You must upload an image!");
            $_POST['thumb'] = $this->session->userdata('thumb');
            return true;
        }
    }
    
    public function url_checking($url)
    {
        $pattern = "/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i";
        
        if(!preg_match($pattern, $url) && !empty($url)){
            $this->form_validation->set_message('url_checking', 'Vous devez renseigner une URL valide !');
            return FALSE;
        }

        return TRUE;
    }
  
}