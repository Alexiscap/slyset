<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class melo_actu extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
//        $this->output->enable_profiler(true);

        $this->user_authentication->musicien_user_validation();
        
        $this->layout->ajouter_css('slyset');
        $this->layout->ajouter_js('jquery.placeheld.min');
        $this->layout->ajouter_js('jquery.easing.min');
        
        $this->load->helper('form');
        $this->load->model('mc_actus_model');
        $this->load->library('form_validation');
        $this->load->library('layout');
        
        $this->layout->set_id_background('melo_actu');
        
        $data = array();
    }
  
    public function index()
    {
        $this->page();
    }
  
    public function page()
    {
        $data['sidebar_left'] = $this->load->view('sidebars/sidebar_left', '', TRUE);
        $data['sidebar_right'] = $this->load->view('sidebars/sidebar_right', '', TRUE);
        $data['messages'] = $this->mc_actus_model->liste_actus();
        $data['commentaires'] = $this->mc_actus_model->liste_comments();
        
//        $data['nb_commentaires'] = $this->userManager->count('Wall_id', 'Arthur');
        
        $this->layout->view('wall/melo_actu', $data);
    }
    
    public function form_wall_musicien_message()
    {   
        $data['sidebar_left'] = $this->load->view('sidebars/sidebar_left', '', TRUE);
        $data['sidebar_right'] = $this->load->view('sidebars/sidebar_right', '', TRUE);
        $data['messages'] = $this->mc_actus_model->liste_actus();
        $data['commentaires'] = $this->mc_actus_model->liste_comments();
      
        $this->form_validation->set_rules('comment1', 'Message', 'trim|required|xss_clean');
      
        if($this->form_validation->run() == FALSE){
            $this->layout->view('wall/mc_actus', $data);
        } else {
            $message = ucfirst($this->input->post('comment1'));
            $lien = '';
            $photo = '';
            
            $this->mc_actus_model->insert_actus($message, $lien, $photo);
            redirect('mc_actus', 'refresh');
        }
    }
    
    public function form_wall_musicien_photo()
    {   
        $data['sidebar_left'] = $this->load->view('sidebars/sidebar_left', '', TRUE);
        $data['sidebar_right'] = $this->load->view('sidebars/sidebar_right', '', TRUE);
        $data['messages'] = $this->mc_actus_model->liste_actus();
        $data['commentaires'] = $this->mc_actus_model->liste_comments();
        
        $dynamic_path = './files/'.$this->session->userdata('uid').'/wall/';
        if (is_dir($dynamic_path) == false){
            mkdir($dynamic_path, 0755, true);
        }
        
        $config['upload_path']   = $dynamic_path;
        $config['allowed_types'] = 'gif|jpg|png';
//        $config['max_size']      = '100000';
//        $config['max_width']     = '1024';
//        $config['max_height']    = '768';
        $this->load->library('upload', $config);
        
        $this->form_validation->set_rules('comment2', 'Message', 'trim|required|xss_clean');
        $this->form_validation->set_rules('photo', 'Photo', 'callback_handle_upload_photo');
      
        if($this->form_validation->run() == FALSE){
            $this->layout->view('wall/mc_actus', $data);
        } else {
            $message = ucfirst($this->input->post('comment2'));
            $lien = '';
            $photo = $this->input->post('photo');
            
            $this->mc_actus_model->insert_actus($message, $lien, $photo);
            redirect('mc_actus', 'refresh');
        }
    }
    
    public function form_wall_musicien_link()
    {   
        $data['sidebar_left'] = $this->load->view('sidebars/sidebar_left', '', TRUE);
        $data['sidebar_right'] = $this->load->view('sidebars/sidebar_right', '', TRUE);
        $data['messages'] = $this->mc_actus_model->liste_actus();
        $data['commentaires'] = $this->mc_actus_model->liste_comments();
      
        $this->form_validation->set_rules('comment3', 'Message', 'trim|required|xss_clean');
        $this->form_validation->set_rules('linkurl', 'Lien', 'trim|required|prep_url|valid_url|xss_clean|callback_valid_youtube_url');
      
        if($this->form_validation->run() == FALSE){
            $this->layout->view('wall/mc_actus', $data);
        } else {
            $message = ucfirst($this->input->post('comment3'));
            $lien = $this->input->post('linkurl');
            $photo = '';
            
            $this->mc_actus_model->insert_actus($message, $lien, $photo);
            redirect('mc_actus', 'refresh');
        }
    }

    public function form_wall_user_comment()
    {   
//        $data['sidebar_left'] = $this->load->view('sidebars/sidebar_left', '', TRUE);
//        $data['sidebar_right'] = $this->load->view('sidebars/sidebar_right', '', TRUE);
//        $data['messages'] = $this->mc_actus_model->liste_actus();
//      
//        $this->form_validation->set_rules('comment3', 'Message', 'trim|required|xss_clean');
//        $this->form_validation->set_rules('linkurl', 'Lien', 'trim|required|prep_url|valid_url|xss_clean|callback_valid_youtube_url');
//      
//        if($this->form_validation->run() == FALSE){
//            $this->layout->view('mc_actus', $data);
//        } else {
//            $message = ucfirst($this->input->post('comment3'));
//            $lien = $this->input->post('linkurl');
//            $photo = '';
//            
//            $this->mc_actus_model->insert_actus($message, $lien, $photo);
//            redirect('mc_actus', 'refresh');
//        }
      
        $usercomment = $this->input->post('usercomment');
        $messageid   = $this->input->post('messageid');
        echo $this->mc_actus_model->insert_comments();
    }
    
    public function handle_upload_photo()
    {
        if (isset($_FILES['photo']) && !empty($_FILES['photo']['name'])){
            if ($this->upload->do_upload('photo')){
                $upload_data    = $this->upload->data();
                $_POST['photo'] = $upload_data['file_name'];
                return true;
            } else {
                $this->form_validation->set_message('handle_upload', $this->upload->display_errors());
                return false;
            }
        } else {
            $this->form_validation->set_message('handle_upload', "Vous devez télécharger une image !");
            return false;
        }
    }
    
    public function valid_youtube_url()
    {
        $lien         = $this->input->post('linkurl');
        $preg_youtube = preg_match('/https?:\/\/(?:www\.)?youtu(?:\.be|be\.com)\/watch(?:\?(.*?)&|\?)v=([a-zA-Z0-9_\-]+)(\S*)/i', $lien);

        if(!$preg_youtube){
            $this->form_validation->set_message('valid_youtube_url', 'Vous devez renseigner une URL youtube valide !');
            return false;
        } else {
            return true;
        }
    }
    
    public function delete($message_id)
    {
        $this->mc_actus_model->delete_actus($message_id);
        redirect('mc_actus', 'refresh');
    }
    
    public function delete_comment($comment_id)
    {
        $this->mc_actus_model->delete_comments($comment_id);
        redirect('mc_actus', 'refresh');
    }
  
}