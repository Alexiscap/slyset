<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->layout->ajouter_css('slyset');

        $this->load->model(array('user_model', 'Facebook_Model'));
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->layout->set_id_background('inscription');
    }

    public function index() {
        $this->register_step_1();
    }

    public function register_step_1() {

        $fb_data = $this->session->userdata('fb_data');
//        print_r($fb_data);
//        if((!$fb_data['uid']) or (!$fb_data['me'])){
//            // If this is a protected section that needs user authentication
//            // you can redirect the user somewhere else
//            // or take any other action you need
//            $this->layout->view('inscription/loginform', $data);
//        } else {
        $data = array('fb_data' => $fb_data);
//        }

        $this->form_validation->set_rules('mail', 'Email', 'trim|required|valid_email|xss_clean|callback_check_register');

        if ($this->form_validation->run() == FALSE) {
            $this->layout->view('inscription/loginform', $data);
        } else if (isset($fb_data['me']) && $fb_data['me']['uid'] != 0) {
            $this->layout->view('inscription/loginform3', $data);
        } else {
            $mail = $this->input->post('mail');
            $this->layout->view('inscription/loginform2', $data);
        }
    }

    public function register_step_2() {
        $this->form_validation->set_rules('typeaccount', 'Type de compte', 'required');
        $this->form_validation->set_rules('password', 'Mot de passe', 'trim|required|xss_clean|matches[confpassword]');
        $this->form_validation->set_rules('confpassword', 'Confirmer mot de passe', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $this->layout->view('inscription/loginform2');
        } else {
            $password = $this->input->post('password');
            $confpassword = $this->input->post('confpassword');

            $this->layout->view('inscription/loginform3');
        }
    }

    public function register_step_2fb() {
        $this->form_validation->set_rules('typeaccount', 'Type de compte', '');

        $fb_data = $this->session->userdata('fb_data');
//        print_r($fb_data);
        $data = array('fb_data' => $fb_data);

        if ($this->form_validation->run() == FALSE) {
            $this->layout->view('inscription/loginform2_fb', $data);
        } else {
            $this->layout->view('inscription/loginform3', $data);
        }
    }

    public function register_step_3() {
        $fb_data = $this->session->userdata('fb_data');
        
        $dynamic_path = './files/profiles/';
        if (is_dir($dynamic_path) == false) {
            mkdir($dynamic_path, 0755, true);
        }

        $config['upload_path'] = $dynamic_path;
        $config['allowed_types'] = 'gif|jpg|png]jpeg';
//        $config['max_size'] = '2048';
//        $config['max_width'] = '1024';
//        $config['max_height'] = '768';
        $config['remove_space'] = TRUE;
        $config['overwrite'] = TRUE;
        $this->load->library('upload', $config);

        $data = array('fb_data' => $fb_data);
//        print_r($fb_data);
        //echo '<pre>'.print_r($fb_data).'</pre>';
//        $this->form_validation->set_rules('nom', 'Nom', 'trim|required|xss_clean');
//        $this->form_validation->set_rules('prenom', 'Prénom', 'trim|required|xss_clean');
//        $this->form_validation->set_rules('genre', 'Genre', 'trim|required|xss_clean');
//        $this->form_validation->set_rules('ville', 'Ville', 'trim|required|xss_clean');
//        $this->form_validation->set_rules('pays', 'Nationalité', 'trim|required|xss_clean');

        $this->form_validation->set_rules('stylemusicecoute', 'Style de musique écouté', 'required');
        $this->form_validation->set_rules('submit', 'Validation du compte', 'callback_check_fb_register');
        $this->form_validation->set_rules('cover', 'Photo de couverture', 'callback_handle_upload_cover');
        $this->form_validation->set_rules('thumb', 'Photo de profil', 'callback_handle_upload_thumb');

        if ($this->input->post('typeaccount') == 1) {
            $this->form_validation->set_rules('login', 'Nom d\'utilisateur', 'trim|required|xss_clean');
        } else if ($this->input->post('typeaccount') == 2) {
            $this->form_validation->set_rules('nomscene', 'Nom de scène', 'trim|required|xss_clean');
            $this->form_validation->set_rules('stylemusicjoue', 'Style de musique joué', 'required');
            $this->form_validation->set_rules('stylemusicinstru', 'Style d\'instrument', 'required');
        }

        if ($this->form_validation->run() == FALSE) {
            $this->layout->view('inscription/loginform3');
        } else {
            if (isset($fb_data['me']) && $fb_data['me']['id'] != 0) {
                if (isset($fb_data['me']['location']['name'])) {
                    $explode_fb_location = explode(', ', $fb_data['me']['location']['name']);
                    $ville_fb = $explode_fb_location[0];
                    $pays_fb = $explode_fb_location[1];
                } else {
                    $ville_fb = '';
                    $pays_fb = '';
                }

                if (isset($fb_data['me']['gender']) && $fb_data['me']['gender'] == 'male') {
                    $genre_fb = 'Homme';
                } else if (isset($fb_data['me']['gender']) && $fb_data['me']['gender'] == 'female') {
                    $genre_fb = 'Femme';
                } else {
                    $genre_fb = '';
                }

                $facebook_id = $fb_data['me']['id'];
                $type = $this->input->post('typeaccount');
                $mail = $fb_data['me']['email'];
                $password = '';
                $nom = $fb_data['me']['last_name'];
                $prenom = $fb_data['me']['first_name'];
                $naissance = $fb_data['me']['birthday'];
                $genre = $genre_fb;
                $ville = $ville_fb;
                $pays = $pays_fb;

                $array_stylemusicecoute = $this->input->post('stylemusicecoute');
                $stylemusicecoute = join(', ', $array_stylemusicecoute);

                $cover = $fb_data['me']['cover']['source'];
                $thumb = $fb_data['me']['picture']['data']['url'];
            } else {
                $facebook_id = '';
                $type = $this->input->post('typeaccount');
                $mail = $this->input->post('mail');
                $password = $this->input->post('password');
                $nom = '';
                $prenom = '';
                $naissance = '';
                $genre = '';
                $ville = '';
                $pays = '';

                $array_stylemusicecoute = $this->input->post('stylemusicecoute');
                $stylemusicecoute = join(', ', $array_stylemusicecoute);

                $cover = $this->input->post('cover');
                $thumb = $this->input->post('thumb');
            }

            switch ($this->input->post('typeaccount')) {
                case 1 :
                    $login = $this->input->post('login');
                    $stylemusicjoue = '';
                    $stylemusicinstru = '';
                    break;

                case 2 :
                    $login = $this->input->post('nomscene');
                    $array_stylemusicjoue = $this->input->post('stylemusicjoue');
                    $stylemusicjoue = join(', ', $array_stylemusicjoue);

                    $array_stylemusicinstru = $this->input->post('stylemusicinstru');
                    $stylemusicinstru = join(', ', $array_stylemusicinstru);
                    break;
            }

            $this->user_model->insert_user($facebook_id, $login, $mail, $password, $type, $nom, $prenom, $naissance, $genre, $ville, $pays, $stylemusicecoute, $stylemusicjoue, $stylemusicinstru, $cover, $thumb);

            redirect('login', 'refresh');
        }
    }

    public function check_register() {
        $mail = $this->input->post('mail');
        $result = $this->user_model->mail_register($mail);

        if ($result) {
            $this->form_validation->set_message('check_register', 'Cette adresse email est déjà utilisée !');
            return false;
        } else {
            return true;
        }
    }

    public function check_fb_register() {
        $fb_data = $this->session->userdata('fb_data');

        $facebook_id = $fb_data['me']['id'];
        $result = $this->user_model->facebook_register($facebook_id);

        if ($result) {
            $this->form_validation->set_message('check_fb_register', 'Ce compte facebook ou l\'email de votre compte facebook est déjà utilisé !');
            return false;
        } else {
            return true;
        }
    }

    function handle_upload_cover() {
        if (isset($_FILES['cover']) && !empty($_FILES['cover']['name'])) {
            if ($this->upload->do_upload('cover')) {
                $upload_data = $this->upload->data();
                $_POST['cover'] = $upload_data['file_name'];
                return true;
            } else {
                $this->form_validation->set_message('handle_upload', $this->upload->display_errors());
                return false;
            }
        } else {
            $this->form_validation->set_message('handle_upload', "You must upload an image!");
            return false;
        }
    }

    function handle_upload_thumb() {
        if (isset($_FILES['thumb']) && !empty($_FILES['thumb']['name'])) {
            if ($this->upload->do_upload('thumb')) {
                $upload_data = $this->upload->data();
                $_POST['thumb'] = $upload_data['file_name'];
                return true;
            } else {
                $this->form_validation->set_message('handle_upload', $this->upload->display_errors());
                return false;
            }
        } else {
            $this->form_validation->set_message('handle_upload', "You must upload an image!");
            return false;
        }
    }

}