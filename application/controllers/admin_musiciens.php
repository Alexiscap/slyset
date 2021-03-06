<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_musiciens extends CI_Controller {

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
        $this->layout->set_description('');
        $this->layout->set_titre('Dashboard Admin : Gestion des artistes | Slyset Music');

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
            $data['musiciens'] = $this->comptes_model->liste_musiciens(20, 0);

            $this->layout->view('admin/musiciens', $data);
        } else {
            redirect('login', 'refresh');
        }
    }

    public function delete($musicien_id = NULL) {
        if ($this->login_model->isLoggedInAdmin()) {
            $data = $this->data;
            $data['musiciens'] = $this->comptes_model->get_musicien($musicien_id);

            $this->comptes_model->delete_musicien($musicien_id);
            redirect('admin_musiciens', 'refresh');
        } else {
            redirect('login', 'refresh');
        }
    }

    public function suspend($musicien_id = NULL) {
        if ($this->login_model->isLoggedInAdmin()) {
            $data = $this->data;
            $data['musiciens'] = $this->comptes_model->get_musicien($musicien_id);

            if ($data['musiciens']->suspendu == 0) {
                $this->comptes_model->suspend_musicien($musicien_id, 1);
            } else {
                $this->comptes_model->suspend_musicien($musicien_id, 0);
            }

            redirect('admin_musiciens', 'refresh');
        } else {
            redirect('login', 'refresh');
        }
    }

    public function submit_multi_musiciens() {
        if ($this->login_model->isLoggedInAdmin()) {
            $data = $this->data;
            $data['musiciens'] = $this->comptes_model->liste_musiciens();
            $array_musiciens_id = array();

            $this->form_validation->set_rules('checkcompte', 'Checkbox Compte', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->layout->view('admin/musiciens', $data);
            } else {
                $checkbox_musicien = $this->input->post('checkcompte');

                foreach ($checkbox_musicien as $cbcomptes) {
                    $array_musiciens_id[] = $cbcomptes;
                }

                if (isset($_POST['supprimer'])) {
                    $this->comptes_model->multi_delete_musiciens($array_musiciens_id);
                } elseif (isset($_POST['suspendre'])) {
                    $this->comptes_model->multi_suspend_musiciens($array_musiciens_id);
                }

                redirect('admin_musiciens', 'refresh');
            }
        } else {
            redirect('login', 'refresh');
        }
    }

    public function ajax_musiciens($uid, $offset = null) {
        if ($this->comptes_model->liste_musiciens(20, $offset)) {
            $data['musiciens'] = $this->comptes_model->liste_musiciens(20, $offset);

            $this->load->view('admin/musiciens_ajax', $data);
        } else {
//          echo 'End';
        }
    }

}