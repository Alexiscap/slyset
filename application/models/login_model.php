<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
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
    
    public function validCredentials($login, $password){
        $this->load->library('encrypt');

        $password = $this->encrypt->sha1($password);

        $this->db->select('*');
        $this->db->from('utilisateur');
        $this->db->where('login = ' . "'" . $login . "'" . ' AND password = ' . "'" . $password . "'");
        $this->db->limit(1);

        $query = $this->db->get();

        if($query->num_rows() > 0){
            $r = $query->result();
            $session_data = array('login' => $r[0]->login, 'uid' => $r[0]->id, 'account' => $r[0]->type, 'logged_in' => true);//, 'account' => $r[0]->type,
            $this->session->set_userdata($session_data);
            return true;
        } else {
            return false;
        }
    }
    
    function isLoggedIn(){
        if($this->session->userdata('logged_in') && $this->session->userdata('account') != 0){
            return true;
        } else {
            return false;
        }
    }

    function isLoggedInAdmin(){
        if($this->session->userdata('logged_in') && $this->session->userdata('account') == 0){
            return true;
        } else {
            return false;
        }
    }

}