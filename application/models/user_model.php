<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    
    public function register($mail){
        $this->db->select('mail');
        $this->db->from('utilisateur');
        $this->db->where('mail = ' . "'" . $mail . "'");

        $query = $this->db->get();

        if($query->num_rows() == 1){
           return $query->result();
        } else {
           return false;
        }
    }
		 
    public function insert_user($mail, $password){
        $this->load->library('encrypt');
        
        $data['login'] = $login;
        $data['mail'] = $mail;
        $data['password'] = $this->encrypt->sha1($password);
        $data['created'] = Date('Y-m-d');
        
        $this->db->insert('utilisateur', $data);
    }

}
	