<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pi_ajout_livret extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->layout->ajouter_css('slyset');

        $this->layout->ajouter_js('jquery.imagesloaded.min');
        $this->layout->ajouter_js('jquery.masonry.min');
        $this->layout->ajouter_js('jquery.stapel');

        $this->load->helper(array('form'));

        $this->load->model('document');

        $this->layout->set_id_background('ajout_livret');
    }

    public function index() {

        $this->page();
    }

    public function page() {
        $data = array();
        $data['error'] = " ";


        //$this->layout->views('3');
        // $this->layout->view('partition/pi_ajout_paroles', $datas);
        $data['album'] = $this->document->get_album($this->session->userdata('uid'));
        $this->layout->view('partition/pi_ajout_livret', $data);
    }

    public function get_morceaux() {
        $album_id = $this->input->post('id_album');
        $data['morceaux'] = $this->document->get_morceau_by_album($album_id);
        $all_option = "";
        foreach ($data['morceaux'] as $morceau) {
            $all_option .=
                    $option = '<option name="morceaux" value="' . $morceau->id . '">' . $morceau->nom . '</option>';
        }
        echo '			<select name="morceaux" class="mor">' . $all_option . '</select>
';
    }

    function do_upload() {
        $album = $this->input->post('album');
        print $morceau = $this->input->post('morceaux');
        $album_exp = explode('+', $album);
        $album_name = $album_exp[0];
        $album_id = $album_exp[1];
        $noespace_filename_album = str_replace(' ', '_', $album_name);
        $dynamic_path = './files/' . $this->session->userdata('uid') . '/documents/' . $album_id;

        if (is_dir($dynamic_path) == false) {
            mkdir($dynamic_path, 0755, true);
        }



        $config['upload_path'] = $dynamic_path;

        $config['allowed_types'] = 'pdf';


        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('partition/pi_ajout_livret', $error);
        } else {
            $data = array('upload_data' => $this->upload->data());



            $this->document->insert_livret($album_id, $data['upload_data']['file_name']);
            //	$this->load->view('partition/pi_ajout_paroles', $data);
        }
    }

}