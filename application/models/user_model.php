<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    
    public function facebook_register($facebook_id){
        $this->db->select('facebook_id');
        $this->db->from('utilisateur');
        $this->db->where('facebook_id = ' . "'" . $facebook_id . "'");
        $this->db->limit(1);

        $query = $this->db->get();

        if($query->num_rows() == 1){
           return $query->result();
        } else {
           return false;
        }
    }
    
    public function mail_register($mail){
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
		 
    public function insert_user($login, $mail, $password, $nom, $prenom, $ville, $pays, $type){
        $this->load->library('encrypt');
        
        $data['mail'] = $mail;
        $data['password'] = $this->encrypt->sha1($password);
        $data['login'] = $login;
        $data['nom'] = $nom;
        $data['prenom'] = $prenom;
        $data['ville'] = $ville;
        $data['nationalite'] = $pays;
        $data['type'] = $type;
        $data['created'] = Date('Y-m-d');
        
        $this->db->insert('utilisateur', $data);
    }

}
	