<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends CI_Model {

    protected $table = 'utilisateur';
    protected $data;
    protected $tbl_track = 'morceaux';
 	protected $tbl_album = 'albums';
 	
    public function __construct() {
        parent::__construct();
        $data = array();
    }

    public function getAll() {
        $this->db->select('id');
        $this->db->from($this->table);
        $this->db->where('facebook_id = ' . "'" . $facebook_id . "'" . ' AND facebook_id != 0');
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            $data = $query->result();
            return $data;
        } else {
            return false;
        }
    }

    public function getUser($user_id) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id = ' . "'" . $user_id . "'");
        $this->db->limit(1);

        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            $result = $query->result();
            $data = $result[0];
            return $data;
        } else {
            return false;
        }
    }

    public function getNewbies() {
        $this->db->select('id, type, login, thumb');
        $this->db->from($this->table);
        $this->db->order_by('id', 'desc');
        $this->db->limit(4);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $data = $query->result();
            return $data;
        } else {
            return false;
        }
    }

    public function getUserByName($nid) {
        $this->db->select('login, type');
        $this->db->from($this->table);
        $this->db->where('type = 2 AND login = ' . "'" . $nid . "'");
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            $data = $query->result();
            return $data;
        } else {
            return false;
        }
    }
    
    public function getUserByMail($mail) {
        $this->db->select('login, id');
        $this->db->from($this->table);
        $this->db->where('mail = ' . "'" . $mail . "'");
        $this->db->limit(1);

        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            $result = $query->result();
            $data = $result[0];
            return $data;
        } else {
            return false;
        }
    }

    public function facebook_register($facebook_id) {
        $this->db->select('facebook_id');
        $this->db->from($this->table);
        $this->db->where('facebook_id = ' . "'" . $facebook_id . "'" . ' AND facebook_id != 0');
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function mail_register($mail) {
        $this->db->select('mail');
        $this->db->from($this->table);
        $this->db->where('mail = ' . "'" . $mail . "'");
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function insert_user($facebook_id, $login, $mail, $password, $type, $nom, $prenom, $naissance, $genre, $ville, $pays, $stylemusicecoute, $stylemusicjoue, $stylemusicinstru, $cover, $thumb) {
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

        $this->db->insert($this->table, $data);
    }

    public function update_musicien($website, $twitter, $facebook, $googleplus, $stylemusicjoue, $stylemusicinstru) {
//        $data['login'] = $login;
//        $data['description'] = $description;
        $data['siteweb'] = $website;
        $data['twitter'] = $twitter;
        $data['facebook'] = $facebook;
        $data['googleplus'] = $googleplus;
        $data['style_joue'] = $stylemusicjoue;
        $data['instrument'] = $stylemusicinstru;
//        $data['cover'] = $cover;
//        $data['thumb'] = $thumb;
        $data['updated'] = Date('Y-m-d H:i:s');

        $this->db->update($this->table, $data, "id = " . $this->session->userdata('uid'));
    }

    public function update_melomane($login, $password, $description, $nom, $prenom, $email, $stylemusicecoute, $cover, $thumb) {        
        $data['login'] = $login;
        $data['password'] = $password;
        $data['prenom'] = $prenom;
        $data['nom'] = $nom;
        $data['mail'] = $email;
        $data['description'] = $description;
        $data['style_ecoute'] = $stylemusicecoute;
        $data['cover'] = $cover;
        $data['thumb'] = $thumb;
        $data['updated'] = Date('Y-m-d H:i:s');

        $this->db->update($this->table, $data, "id = " . $this->session->userdata('uid'));
    }

    public function update_password($id, $password) {
        $data['password'] = $password;
        $data['updated'] = Date('Y-m-d H:i:s');

        $this->db->update($this->table, $data, "id = " . $id);
    }

    public function delete_user($uid) {
        return $this->db->where('id', (int) $uid)->delete($this->table);
    }

    public function get_community($user_follower_id) {
        return $this->db->select('id, Utilisateur_id')
                        ->from('communaute')
                        ->where(array('Follower_id' => $user_follower_id))
                        ->get()
                        ->result();
    }

    public function count_suspend() {
        return (int) $this->db->where('suspendu', '1')
                        ->from($this->table)
                        ->count_all_results();
    }

    public function last_photo($user) {
        return $this->db->query('SELECT photos.id,photos.Utilisateur_id,photos.file_name FROM photos LEFT OUTER JOIN album_media ON photos.id = album_media.Photos_id 
 WHERE photos.Utilisateur_id =' . $user . ' AND album_media.Photos_id IS NULL ORDER BY photos.date ASC LIMIT 0, 4')
                        ->result();
    }
    
    public function top_five_morceau_profil($user)
    {
    	return $this->db->select('morceaux.nom,albums.nom AS alb_name,morceaux.id')
    			->from($this->tbl_track)
    			->join($this->tbl_album,'albums.id = morceaux.albums_id')
    			->where('morceaux.Utilisateur_id',$user)
    			->order_by('nombre_lectures','ASC')
    			->limit(5)
    			->get()
    			->result();
    }

}

