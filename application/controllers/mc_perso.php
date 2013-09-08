<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mc_perso extends CI_Controller {

    var $data;
    var $user_id;

    public function __construct() {
        parent::__construct();

        $this->layout->ajouter_css('slyset');
        $this->layout->ajouter_css('colorpicker');

        $this->layout->ajouter_js('colorpicker/colorpicker');
        $this->layout->ajouter_js('colorpicker/eye');
        $this->layout->ajouter_js('colorpicker/utils');

        $this->load->helper(array('form', 'comments_helper'));
        $this->load->model(array('perso_model', 'user_model'));
        $this->load->library(array('form_validation'));

        $this->layout->set_id_background('personnaliser');

        $this->user_id = (is_numeric($this->uri->segment(2))) ? $this->uri->segment(2) : $this->uri->segment(3);
        $output = $this->perso_model->get_perso($this->user_id);

        $sub_data = array();
        $sub_data['profile'] = $this->user_model->getUser($this->user_id);
        $sub_data['perso'] = $output;
        
        if ($this->user_id != null) {
            $sub_data['photo_right'] = $this->user_model->last_photo($this->user_id);
            $sub_data['morceau_right'] = $this->user_model->top_five_morceau_profil($this->user_id);
            $sub_data['morceau_right_t']['type_page'] = 1;

        }
        
        if (!empty($output)) {
            $this->layout->ajouter_dynamique_css($output->theme_css);
            write_css($output);
        }

        $community_follower = $this->user_model->get_community($this->session->userdata('uid'));
        $my_abonnement_head = "";

        foreach ($community_follower as $my_following_head) {
            $my_abonnement_head .= $my_following_head->Utilisateur_id . '/';
        }

        $this->data = array(
            'sidebar_left' => $this->load->view('sidebars/sidebar_left', '', TRUE),
            'sidebar_right' => $this->load->view('sidebars/sidebar_right', $sub_data, TRUE)
        );
    }

    public function index($user_id) {
        $uid = $this->session->userdata('uid');
        $type_account = $this->session->userdata('account');

        if (($user_id == $uid) && $type_account != 1) {
            $this->page();
        } else {
            redirect('home/' . $uid, 'refresh');
        }
    }

    public function page($infos_profile = NULL) {
        $data = $this->data;
        $data['profile'] = $this->user_model->getUser($this->user_id);
        $data['perso'] = $this->perso_model->get_perso($this->user_id);
        $this->layout->view('personnalisation/mc_perso', $data);
    }

    public function update_perso($infos_profile = NULL) {
        $uid = $this->session->userdata('uid');
        $this->user_id = $this->uri->segment(3);
        $data = $this->data;
        $data['profile'] = $this->user_model->getUser($this->user_id);
        $data['perso'] = $this->perso_model->get_perso($this->user_id);

        $dynamic_path = './files/' . $uid . '/perso/';
        if (is_dir($dynamic_path) == false) {
            mkdir($dynamic_path, 0755, true);
        }

        $config['upload_path'] = $dynamic_path;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '8192';
        $config['max_width'] = '0';
        $config['max_height'] = '0';
        $config['remove_space'] = TRUE;
        $config['overwrite'] = TRUE;
        $this->load->library('upload', $config);

        $this->form_validation->set_rules('background', 'Background', 'callback_handle_upload_background');
        $this->form_validation->set_rules('theme_css', 'Thème', '');
        $this->form_validation->set_rules('repeat', 'Répéter l\'image', 'trim|xss_clean');
        $this->form_validation->set_rules('couleur1', 'Couleur d\'arrière plan', 'trim|xss_clean');
        $this->form_validation->set_rules('couleur2', 'Contour de votre photo de profil', 'trim|xss_clean');
        $this->form_validation->set_rules('couleur3', 'Couleur des liens', 'trim|xss_clean');
        $this->form_validation->set_rules('couleur4', 'Couleur des grands titres', 'trim|xss_clean');
        $this->form_validation->set_rules('submit', 'Personnalisation du profil', '');

        if ($this->form_validation->run() == FALSE) {
            $this->layout->view('personnalisation/mc_perso', $data);
        } else {
            $theme_css = 'custom_user_css.php';

            $background_perso = $this->input->post('background');
            if (empty($background_perso) && !empty($data['perso']->background)) {
                $background = $data['perso']->background;
            } elseif (!empty($background_perso)) {
                $background = $background_perso;
            } else {
                $background = NULL;
            }

            $repeat = $this->input->post('repeat');
            $couleur1 = $this->input->post('couleur1');
            $couleur2 = $this->input->post('couleur2');
            $couleur3 = $this->input->post('couleur3');
            $couleur4 = $this->input->post('couleur4');

            $this->user_id = $this->uri->segment(3);
            $exist = $this->perso_model->get_perso($this->user_id);

            if ($exist == FALSE) {
                $this->perso_model->insert_perso($theme_css, $background, $repeat, $couleur1, $couleur2, $couleur3, $couleur4);
            } else {
                $this->perso_model->update_perso($theme_css, $background, $repeat, $couleur1, $couleur2, $couleur3, $couleur4);
            }
            
            $output = $this->perso_model->get_perso($uid);
            if(!empty($output)){
                $this->layout->ajouter_dynamique_css($output->theme_css);
                write_css($output);
            }

            redirect('personnaliser/' . $uid, 'refresh');
        }
    }

    public function theme1($infos_profile = NULL) {
        $uid = $this->session->userdata('uid');
        $this->user_id = $this->uri->segment(3);
        $data = $this->data;
        $data['profile'] = $this->user_model->getUser($this->user_id);
        $data['perso'] = $this->perso_model->get_perso($this->user_id);

        $theme_css = 'theme_css_1.css';

        $exist = $this->perso_model->get_perso($this->user_id);

        if ($exist == FALSE) {
            $this->perso_model->insert_perso($theme_css);
        } else {
            $this->perso_model->update_perso($theme_css);
        }

        redirect('personnaliser/' . $uid, 'refresh');
    }

    public function theme2($infos_profile = NULL) {
        $uid = $this->session->userdata('uid');
        $this->user_id = $this->uri->segment(3);
        $data = $this->data;
        $data['profile'] = $this->user_model->getUser($this->user_id);
        $data['perso'] = $this->perso_model->get_perso($this->user_id);

        $theme_css = 'theme_css_2.css';

        $exist = $this->perso_model->get_perso($this->user_id);

        if ($exist == FALSE) {
            $this->perso_model->insert_perso($theme_css);
        } else {
            $this->perso_model->update_perso($theme_css);
        }

        redirect('personnaliser/' . $uid, 'refresh');
    }

    public function theme3($infos_profile = NULL) {
        $uid = $this->session->userdata('uid');
        $this->user_id = $this->uri->segment(3);
        $data = $this->data;
        $data['profile'] = $this->user_model->getUser($this->user_id);
        $data['perso'] = $this->perso_model->get_perso($this->user_id);

        $theme_css = 'theme_css_3.css';

        $exist = $this->perso_model->get_perso($this->user_id);

        if ($exist == FALSE) {
            $this->perso_model->insert_perso($theme_css);
        } else {
            $this->perso_model->update_perso($theme_css);
        }

        redirect('personnaliser/' . $uid, 'refresh');
    }

    public function theme4($infos_profile = NULL) {
        $uid = $this->session->userdata('uid');
        $this->user_id = $this->uri->segment(3);
        $data = $this->data;
        $data['profile'] = $this->user_model->getUser($this->user_id);
        $data['perso'] = $this->perso_model->get_perso($this->user_id);

        $theme_css = 'theme_css_4.css';

        $exist = $this->perso_model->get_perso($this->user_id);

        if ($exist == FALSE) {
            $this->perso_model->insert_perso($theme_css);
        } else {
            $this->perso_model->update_perso($theme_css);
        }

        redirect('personnaliser/' . $uid, 'refresh');
    }

    public function delete_perso() {
        $this->perso_model->delete_perso();

        if (file_exists('assets/css/custom_user_css.php')) {
            unlink('assets/css/custom_user_css.php');
        }

        redirect('personnaliser/' . $this->session->userdata('uid'), 'refresh');
    }

    function handle_upload_background() {
        if (isset($_FILES['background']) && !empty($_FILES['background']['name'])) {
            if ($this->upload->do_upload('background')) {
                $upload_data = $this->upload->data();
                $_POST['background'] = $upload_data['file_name'];
                return true;
            } else {
                $this->form_validation->set_message('handle_upload_background', '<p>L\'image que vous tentez d\'envoyer dépasse les valeurs maximales autorisées. (Max 1024 KO)</p>');
                return false;
            }
//        } else {
////            $this->form_validation->set_message('handle_upload', "You must upload an image!");
////            $_POST['background'] = $this->session->userdata('background');
//            return true;
        }
    }

}