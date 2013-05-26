<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $data = array();
    }
    
    public function getAll()
    {
        $this->db->select('id');
        $this->db->from('utilisateur');
        $this->db->where('facebook_id = ' . "'" . $facebook_id . "'" . ' AND facebook_id != 0');
        $this->db->limit(1);

        $query = $this->db->get();

        if($query->num_rows() == 1){
            $data = $query->result();
            return $data;
        } else {
           return false;
        }
        
//        $query = $this->db->get('utilisateur');
//        $data  = $query->result();
//        $query->free_result();
//        return $data;
    }
    
        public function getUser($uid)
    {
        $this->db->select('*');
        $this->db->from('utilisateur');
        $this->db->where('id = ' . "'" . $uid);
        $this->db->limit(1);

        $query = $this->db->get();

        if($query->num_rows() == 1){
            $data = $query->result();
            return $data;
        } else {
           return false;
        }
    }
    
    public function facebook_register($facebook_id)
    {
        $this->db->select('facebook_id');
        $this->db->from('utilisateur');
        $this->db->where('facebook_id = ' . "'" . $facebook_id . "'" . ' AND facebook_id != 0');
        $this->db->limit(1);

        $query = $this->db->get();

        if($query->num_rows() == 1){
            return $query->result();
        } else {
           return false;
        }
    }
    
    public function mail_register($mail)
    {
        $this->db->select('mail');
        $this->db->from('utilisateur');
        $this->db->where('mail = ' . "'" . $mail . "'");
        $this->db->limit(1);

        $query = $this->db->get();

        if($query->num_rows() == 1){
           return $query->result();
        } else {
            return false;
        }
    }
		 
    public function insert_user($facebook_id, $login, $mail, $password, $type, $nom, $prenom, $naissance, $genre, $ville, $pays, $stylemusicecoute, $stylemusicjoue, $stylemusicinstru, $cover, $thumb)
    {
        $this->load->library('encrypt');
        
        $data['facebook_id'] = $facebook_id;
        $data['mail'] = $mail;
        $data['password'] = $this->encrypt->sha1($password);
        $data['login'] = $login;
        $data['nom'] = $nom;
        $data['prenom'] = $prenom;
        $data['date_naissance'] = $naissance;
        $data['genre'] = $genre;
        $data['ville'] = $ville;
        $data['nationalite'] = $pays;
        $data['type'] = $type;
        $data['style_ecoute'] = $stylemusicecoute;
        $data['style_joue'] = $stylemusicjoue;
        $data['instrument'] = $stylemusicinstru;
        $data['cover'] = $cover;
        $data['thumb'] = $thumb;
        $data['created'] = Date('Y-m-d H:i:s');
        
        $this->db->insert('utilisateur', $data);
    }

}
	