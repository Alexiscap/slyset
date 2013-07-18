<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_melomanes extends CI_Controller {

    var $data;
    var $user_id;

    public function __construct() {
        parent::__construct();

        $this->layout->ajouter_css('slyset');
        $this->layout->ajouter_js('infinite_scroll');
        $this->layout->ajouter_js('jquery.tablesorter');

        $this->load->helper(array('cookie', 'form'));
        $this->load->model(array('login_model', 'user_model', 'comptes_model'));
        $this->load->library(array('form_validation', 'layout'));

        $this->layout->set_id_background('admin-comptes');

        $this->data = array(
            'sidebar_left' => $this->load->view('sidebars/sidebar_left_admin', '', TRUE)
        );
    }

    public function index() {
        if ($this->login_model->isLoggedInAdmin()) {
            $this->dashboard();
        } else {
            redirect('login', 'refresh');
        }
    }

    public function dashboard() {
        if ($this->login_model->isLoggedInAdmin()) {
            $data = $this->data;
            $data['melos'] = $this->comptes_model->liste_melos(20, 0);

            $this->layout->view('admin/melomanes', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

    public function delete($melo_id = NULL) {
        if ($this->login_model->isLoggedInAdmin()) {
            $data = $this->data;
            $data['melos'] = $this->comptes_model->get_melo($melo_id);

            $this->comptes_model->delete_melo($melo_id);
            redirect('admin_melomanes', 'refresh');
        } else {
            redirect('login', 'refresh');
        }
    }

    public function suspend($melo_id = NULL) {
        if ($this->login_model->isLoggedInAdmin()) {
            $data = $this->data;
            $data['melos'] = $this->comptes_model->get_melo($melo_id);

            if ($data['melos']->suspendu == 0) {
                $this->comptes_model->suspend_melo($melo_id, 1);
            } else {
                $this->comptes_model->suspend_melo($melo_id, 0);
            }

            redirect('admin_melomanes', 'refresh');
        } else {
            redirect('login', 'refresh');
        }
    }

    public function submit_multi_melos() {
        if ($this->login_model->isLoggedInAdmin()) {
            $data = $this->data;
            $data['melos'] = $this->comptes_model->liste_melos();
            $array_melos_id = array();

            $this->form_validation->set_rules('checkcompte', 'Checkbox Compte', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->layout->view('admin/melomanes', $data);
            } else {
                $checkbox_melo = $this->input->post('checkcompte');

                foreach ($checkbox_melo as $cbcomptes) {
                    $array_melos_id[] = $cbcomptes;
                }

                if (isset($_POST['supprimer'])) {
                    $this->comptes_model->multi_delete_melos($array_melos_id);
                } elseif (isset($_POST['suspendre'])) {
                    $this->comptes_model->multi_suspend_melos($array_melos_id);
                }

                redirect('admin_melomanes', 'refresh');
            }
        } else {
            redirect('login', 'refresh');
        }
    }

    public function ajax_melomanes($uid, $offset = null) {
        if ($this->comptes_model->liste_melos(20, $offset)) {
            $data['melos'] = $this->comptes_model->liste_melos(20, $offset);

            $this->load->view('admin/melomanes_ajax', $data);
        } else {
//          echo 'End';
        }
    }

}