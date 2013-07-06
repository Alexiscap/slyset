<?php  
class Admin_articles extends CI_Controller
{
    var $data;
    var $user_id;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->layout->ajouter_css('slyset');
        $this->layout->ajouter_css('shadowbox/shadowbox');
        $this->layout->ajouter_css('redactor');
        $this->layout->ajouter_js('jquery.placeheld.min');
        $this->layout->ajouter_js('shadowbox/shadowbox');
        $this->layout->ajouter_js('redactor/redactor.min');
        
        $this->load->helper(array('cookie', 'form'));
        $this->load->model(array('login_model', 'perso_model', 'user_model', 'article_model'));
        $this->load->library(array('form_validation', 'layout'));
        
        $this->layout->set_id_background('admin-articles');
        
        $this->data = array(
            'sidebar_left'  => $this->load->view('sidebars/sidebar_left_admin', '', TRUE)
        );
    }

    
    public function index($order = 'updated', $by = 'desc')
    {
        if($this->login_model->isLoggedInAdmin()){
//            redirect('admin/dashboard', 'refresh');
            $this->dashboard($order, $by);
        } else {
            redirect('login', 'refresh');
        }
    }
    
    public function dashboard($order = 'updated', $by = 'desc')
    {      
        if($this->login_model->isLoggedInAdmin()){
            $data = $this->data;
                                
            $data['articles'] = $this->article_model->liste_article($order, $by);
            
            $this->layout->view('admin/articles', $data);
        } else {
            redirect('login', 'refresh');
        }
    }
    
    public function add_article()
    {
        if($this->login_model->isLoggedInAdmin()){
            $data = $this->data;
            $data['articles'] = $this->article_model->liste_article('created', 'desc');

            $this->form_validation->set_rules('title', 'Titre', 'trim|xss_clean|required');
            $this->form_validation->set_rules('article', 'Article', 'trim|xss_clean|required');
            $this->form_validation->set_rules('submit', 'Publier l\'article', '');

            if($this->form_validation->run() == FALSE){
                $this->layout->view('admin/articles', $data);
            } else {
                $title   = $this->input->post('title');
                
                $article = $this->input->post('article');
//                $article = mysql_real_escape_string($article_html);

                $this->article_model->insert_article($title, $article);

                redirect('admin_articles', 'refresh');
            }
        } else {
            redirect('login', 'refresh');
        }
    }
    
    public function delete_article($article_id = NULL)
    {
        if($this->login_model->isLoggedInAdmin()){
            $data = $this->data;
            $data['article'] = $this->article_model->get_article($article_id);

            $this->article_model->delete_article($article_id);
            redirect('admin_articles', 'refresh');
        } else {
            redirect('login', 'refresh');
        }
    }
    
    public function update_article($article_id = NULL)
    {
        if($this->login_model->isLoggedInAdmin()){
            $data = $this->data;
            $data['article'] = $this->article_model->get_article($article_id);

            $this->form_validation->set_rules('title', 'Titre', 'trim|xss_clean|required');
            $this->form_validation->set_rules('article', 'Article', 'trim|xss_clean|required');
            $this->form_validation->set_rules('submit', 'Editer l\'article', '');

            if($this->form_validation->run() == FALSE){
                $this->layout->view('admin/articles_edit', $data);
            } else {
                $title   = $this->input->post('title');
                
                $article = $this->input->post('article');
//                $article = mysql_real_escape_string($article_html);

                $this->article_model->update_article($article_id, $title, $article);
                redirect('admin_articles', 'refresh');
            }
        } else {
            redirect('login', 'refresh');
        }
    }
    
    public function delete_multi_article()
    {
        if($this->login_model->isLoggedInAdmin()){
            $data = $this->data;
            $data['articles'] = $this->article_model->liste_article('created', 'desc');
            $array_article_id = array();

            $this->form_validation->set_rules('checkarticle', 'Checkbox Article', 'required');
            $this->form_validation->set_rules('submit', 'Supprimer', '');

            if($this->form_validation->run() == FALSE){
                $this->layout->view('admin/articles', $data);
            } else {
                $checkbox_article  = $this->input->post('checkarticle');

                foreach($checkbox_article as $cba){
                    $array_article_id[] = $cba;
                }

                $this->article_model->multi_delete_article($array_article_id);
                redirect('admin_articles', 'refresh');
            }
        } else {
            redirect('login', 'refresh');
        }
    }
    
    public function uploadImg()
    {
        print 'okkkkkk';
        $dynamic_path = './files/articles/';
        if (is_dir($dynamic_path) == false){
            mkdir($dynamic_path, 0755, true);
        }
        
        $config['upload_path']   = $dynamic_path;
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['encrypt_name']  = true;
        
        $this->load->library('upload', $config);
        
        if($this->upload->do_upload('file')){
            $data = $this->upload->data();
            $array = array(
                'filelink' => uploaded_dir_img($data['file_name'])
            );
            
            $this->output
                 ->set_content_type('application/json')
                 ->set_output(stripcslashes(json_encode($array)));
        }
    }
    
}