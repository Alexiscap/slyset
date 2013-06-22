<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//class Admin_model extends CI_Model {
//
//    public function __construct()
//    {
//        parent::__construct();
//    }
//    
//    public function validCredentials($login, $password){
//        $this->load->library('encrypt');
//
//        $password = $this->encrypt->sha1($password);
//
//        $this->db->select('*');
//        $this->db->from('utilisateur');
//        $this->db->where('login = ' . "'" . $login . "'" . ' AND password = ' . "'" . $password . "'");
//        $this->db->limit(1);
//
//        $query = $this->db->get();
//
//        if($query->num_rows() > 0){
//            $r = $query->result();
//            $session_data = array('login' => $r[0]->login, 'logged_in' => true);
//            $this->session->set_userdata($session_data);
//            return true;
//        } else {
//            return false;
//        }
//    }
//    
//    function isLoggedIn(){
//        if($this->session->userdata('logged_in')){
//            return true;
//        } else {
//            return false;
//        }
//    }
//
//}