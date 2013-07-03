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
    
    public function getUser($user_id)
    {
        $this->db->select('*');
        $this->db->from('utilisateur');
        $this->db->where('id = '."'".$user_id."'");
        $this->db->limit(1);

        $query = $this->db->get();
        if($query->num_rows() == 1){
//            $data = $query->result();
            $result = $query->result();
            $data = $result[0];
            return $data;
        } else {
           return false;
        }
    }
    
    public function getNewbies()
    {
        $this->db->select('id, type, login, thumb');
        $this->db->from('utilisateur');
        $this->db->order_by('id', 'desc');
        $this->db->limit(4);

        $query = $this->db->get();

        if($query->num_rows() > 0){
            $data = $query->result();
            return $data;
        } else {
           return false;
        }
    }
    
    public function getUserByName($nid)
    {
        $this->db->select('login, type');
        $this->db->from('utilisateur');
        $this->db->where('type = 2 AND login = '."'".$nid."'");
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
        $data['updated'] = Date('Y-m-d H:i:s');
        
        $this->db->insert('utilisateur', $data);
    }
    
    public function update_musicien($login, $description, $website, $twitter, $facebook, $googleplus, $stylemusicjoue, $stylemusicinstru, $cover, $thumb)
    {
        $data['login'] = $login;
        $data['description'] = $description;
        $data['siteweb'] = $website;
        $data['twitter'] = $twitter;
        $data['facebook'] = $facebook;
        $data['googleplus'] = $googleplus;
        $data['style_joue'] = $stylemusicjoue;
        $data['instrument'] = $stylemusicinstru;
        $data['cover'] = $cover;
        $data['thumb'] = $thumb;
        $data['updated'] = Date('Y-m-d H:i:s');
        
        $this->db->update('utilisateur', $data, "id = ".$this->session->userdata('uid'));
    }
    
    public function update_melomane($login, $description, $nom, $prenom, $email, $stylemusicecoute, $cover, $thumb)
    {
        $data['login'] = $login;
        $data['prenom'] = $prenom;
        $data['nom'] = $nom;
        $data['mail'] = $email;
        $data['description'] = $description;
        $data['style_ecoute'] = $stylemusicecoute;
        $data['cover'] = $cover;
        $data['thumb'] = $thumb;
        $data['updated'] = Date('Y-m-d H:i:s');
        
        $this->db->update('utilisateur', $data, "id = ".$this->session->userdata('uid'));
    }
    
    public function get_community($user_follower_id)
    {
    	return $this->db->select('id,Utilisateur_id')
     				->from('communaute')
       				->where(array('Follower_id' => $user_follower_id))
        			->get()
           			->result();
    }

}
	