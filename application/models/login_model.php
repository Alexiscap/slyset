<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login_model extends CI_Model {

    protected $data;

    public function __construct() {
        parent::__construct();
        $this->data = array();
    }

//    public function facebook_register($facebook_id)
//    {
//        $this->db->select('facebook_id');
//        $this->db->from('utilisateur');
//        $this->db->where('facebook_id = ' . "'" . $facebook_id . "'" . ' AND facebook_id != 0');
//        $this->db->limit(1);
//
//        $query = $this->db->get();
//
//        if($query->num_rows() == 1){
//           return $query->result();
//        } else {
//           return false;
//        }
//    }

    public function validCredentials($login, $password) {
        $this->load->library('encrypt');

        $password = $this->encrypt->sha1($password);

        $this->db->select('*');
        $this->db->from('utilisateur');
        $this->db->where('login = ' . "'" . $login . "'" . ' AND password = ' . "'" . $password . "'" . ' AND suspendu = 0');
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $r = $query->result();
            $session_data = array(
                'logged_in' => true,
                'uid' => $r[0]->id,
                'fid' => $r[0]->facebook_id,
                'account' => $r[0]->type,
                'login' => $r[0]->login,
                'nom' => $r[0]->nom,
                'prenom' => $r[0]->prenom,
                'mail' => $r[0]->mail,
                'date_naissance' => $r[0]->date_naissance,
                'cover' => $r[0]->cover,
                'thumb' => $r[0]->thumb,
                'created' => $r[0]->created
            );
            
            $this->session->set_userdata($session_data);
            return true;
        } else {
            return false;
        }
    }

    function isLoggedIn() {
        if ($this->session->userdata('logged_in') && $this->session->userdata('account') != 0) {
            return true;
        } else {
            return false;
        }
    }

    function isLoggedInAdmin() {
        if ($this->session->userdata('logged_in') && $this->session->userdata('account') == 0) {
            return true;
        } else {
            return false;
        }
    }

}