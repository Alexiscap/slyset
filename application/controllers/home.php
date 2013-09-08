<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    var $data;

    public function __construct() {
        parent::__construct();
        $this->layout->ajouter_css('slyset');

        $this->load->helper(array('cookie', 'form'));
        $this->load->model(array('login_model', 'homepage_model', 'user_model', 'article_model', 'admin_model'));
        //      $this->load->model('Facebook_Model');

        $this->layout->ajouter_js('carouFredSel');
        $this->layout->ajouter_js('infinite_scroll');
        $this->layout->ajouter_js('jsdate');
        $this->layout->ajouter_js('calendar');

        $this->layout->set_id_background('home');
        $this->layout->set_description('Slyset');
        $this->layout->set_titre('Slyset Music');
    }

    public function index($uid = NULL) {
        $session_uid = $this->session->userdata('uid');

        if (!empty($session_uid) && empty($uid)) {
            redirect('home/' . $session_uid, 'refresh');
        } elseif (isset($uid) && !empty($uid)) {
            $this->homepage();
        } else {
            $this->homepage();
        }
    }

    public function homepage() {
        $this->load->helper('date');

        $data = array();

        $data['notification'] = $this->input->cookie('notification');
        $data['sidebar_left'] = $this->load->view('sidebars/sidebar_left', '', TRUE);
        $data['sidebar_right'] = $this->load->view('sidebars/sidebar_right', '', TRUE);
        $data['articles'] = $this->article_model->liste_article(10, 0);
        $data['newbies'] = $this->user_model->getNewbies();
        $data['coverflow_covers'] = $this->admin_model->get_cover_artistes();
        $data['concert_date'] = $this->homepage_model->get_concert();
        $data['dates'] = $this->homepage_model->get_date();
        $data['top_morceaux'] = $this->homepage_model->get_top_morceau();
        $data['all_date_calendar'] = "";
        $data['all_info_concert'] = "";

        foreach ($data['dates'] as $data['date']) {
            $title = "";

            foreach ($data['concert_date'] as $data['concert_date_uniq']) {
                if ($data['concert_date_uniq']->date == $data['date']->date) {
                    if (isset($data['concert_date_uniq']->date)) {
                        $data['all_info_concert'] .=
                                $data['concert_date_uniq']->titre;
                        $data['evenement'] = explode('-', $data['concert_date_uniq']->date);
                        date_default_timezone_set('Europe/Paris');
                        $datestring = "%Y-%m-%d %h:%i:%s";
                        $time = time();
                        $today = mdate($datestring, $time) . "<pre>";

                        if ($today < $data['concert_date_uniq']->date) {
                            $link = site_url() . "/mc_concerts/" . $data['concert_date_uniq']->Utilisateur_id . '/#' . $data['concert_date_uniq']->id;
                        } else {
                            $link = site_url() . "/mc_concerts/concert_passe/" . $data['concert_date_uniq']->Utilisateur_id . '/#' . $data['concert_date_uniq']->id;
                        }

                        $title .= '<a href=' . $link . '> ' . $data['concert_date_uniq']->titre . ' + ' . $data['concert_date_uniq']->seconde_partie . ' </a> </br> ' . $data['concert_date_uniq']->salle . ' - ' . $data['concert_date_uniq']->ville . '</br>';

                        $data['format_date_calendar'] = '{ Title:"<span>Concert du ' . substr($data['evenement'][2], 0, 2) . '/' . $data['evenement'][1] . '/' . $data['evenement'][0] . '</span></br>' . $title . '", Date: new Date("' . $data['evenement'][1] . '/' . substr($data['evenement'][2], 0, 2) . '/' . $data['evenement'][0] . '") },';
                    }
                }
            }
            $data['all_date_calendar'] .= $data['format_date_calendar'];
        }


        $this->layout->view('homepage', $data);
    }

    public function ajax_articles($uid, $offset = null) {
        if ($this->article_model->liste_article(10, $offset)) {
            $data['articles'] = $this->article_model->liste_article(10, $offset);

            $this->load->view('homepage_ajax', $data);
        }
    }

    public function _remap($method, $params = array()) {
        if (method_exists($this, $method)) {
            return call_user_func_array(array($this, $method), $params);
        }

        show_404();
    }

}