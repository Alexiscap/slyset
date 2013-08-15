<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Concert_model extends CI_Model {

    protected $table = 'concerts';
    protected $table_people = 'utilisateur';
    protected $table_addresse = 'adresse';
    protected $data;

    public function __construct() {
        parent::__construct();
        $this->data = array();
    }

	/*
    public function get_user($user_id) {
        return $this->db->select('nom, prenom, login')
                        ->from($this->table_people)
                        ->where(array('id' => $user_id))
                        ->get()
                        ->result();
    }
	*/
   
   /*
    public function count() {
        return $this->db->count_all('concerts');
    }
	*/
	
	//total concert par artiste (en fonction du temps : passé ou à venir)
    public function count_artiste_concert($user_id, $date) {
        //date_default_timezone_set('Europe/Paris');
        $today = now();
        $datestring = mdate('%Y-%m-%d %H:%i:00');

        $appel = $this->db->select('id')
                ->from('concerts')
                ->where(array('Utilisateur_id' => $user_id, 'date ' . $date => $datestring))
                ->get();
        return $appel->num_rows();
    }

	//données concerts pour un artiste (en fonction du temps : passé ou à venir)
    public function get_concert($nb, $first = 0, $user_id, $date) {
        $this->load->helper('date');
        
        if (!is_integer($nb) OR $nb < 1 OR !is_integer($first) OR $first < 0) 
        {
            return false;
        }
        //date_default_timezone_set('Europe/Paris');
        
        $today = now();
        $datestring = mdate('%Y-%m-%d %H:%i:00');

        return $this->db->select('concerts.id,Utilisateur_id,Adresse_id,date,titre,seconde_partie,numero_adresse,salle,voie_adresse,ville,code_postal,pays,prix,phone_number,website')
                        ->from('concerts')
                        ->join('adresse', 'concerts.Adresse_id=adresse.id')
                        ->where(array('Utilisateur_id' => $user_id, 'date ' . $date => $datestring))
                        ->order_by('date', 'desc')
                        ->limit($nb, $first)
                        ->get()
                        ->result();
    }

    public function get_one_concert($id_concert) {
        return $this->db->select('date,titre,seconde_partie,salle,ville,prix')
                        ->from('concerts')
                        ->join('adresse', 'concerts.Adresse_id=adresse.id')
                        ->where(array('concerts.id' => $id_concert))
                        ->get()
                        ->result();
    }


    public function ajout_concert_data($ville, $pays, $code_postal, $route, $street_number, $artiste, $snd_partie, $salle, $prix, $heure, $date, $user) {

		//insert des infos adresses pour le nouveau concert
        $this->db->set(array('ville' => $ville, 'pays' => $pays, 'code_postal' => $code_postal, 'voie_adresse' => $route, 'numero_adresse' => $street_number))
                ->insert($this->table_addresse);

        $last_id_addresse = $this->db->insert_id();
        $prix = !empty($prix) ? "$prix" : NULL;
        $snd_partie = !empty($snd_partie) ? "$snd_partie" : NULL;
        $date_concert = $date . ' ' . $heure . ':00';

		//ajout du concert
        $this->db->set(array('Utilisateur_id' => $user, 'titre' => $artiste, 'Adresse_id' => $last_id_addresse, 'salle' => $salle, 'seconde_partie' => $snd_partie, 'prix' => $prix, 'date' => $date_concert))
                ->insert($this->table);

        $last_id_concert = $this->db->insert_id();
		
		//ajout du concert pour remontée wall
        $insert_community = array('Utilisateur_id' => $user, 'concerts_id' => $last_id_concert, 'type' => 'MU');
        $this->db->insert('wall_melo_component', $insert_community);
    }

    public function update_concert_data($ville, $pays, $code_postal, $route, $street_number, $artiste, $snd_partie, $salle, $prix, $heure, $date, $id_concert, $adresse_id, $phone, $website) {
        
        $date_concert = $date . ' ' . $heure;
        $prix = !empty($prix) ? "$prix" : NULL;
        $snd_partie = !empty($snd_partie) ? "$snd_partie" : NULL;

        $data_concert = array('titre' => $artiste, 'salle' => $salle, 'seconde_partie' => $snd_partie, 'prix' => $prix, 'date' => $date_concert);

		//update données concerts
        $this->db->where('id', $id_concert)
                ->update($this->table, $data_concert);

        $data_adresse = array('ville' => $ville, 'pays' => $pays, 'code_postal' => $code_postal, 'voie_adresse' => $route, 'numero_adresse' => $street_number, 'phone_number' => $phone, 'website' => $website);

		//update données adresses
        $this->db->where('id', $adresse_id)
                ->update($this->table_addresse, $data_adresse);
    }

    public function delete_concert_data($id_concert, $id_adresse) {
       
        $this->db->where('id', $id_concert)
                ->delete('concerts');

        $this->db->where('id', $id_adresse);
        $this->db->delete('adresse');
    }

	//je vais à un concert
    public function add_activity($id_concert, $uid) {
        $this->db->set(array('Utilisateur_id' => $uid, 'Concerts_id' => $id_concert))
                ->insert('concerts_activite');

        $this->db->set(array('Utilisateur_id' => $uid, 'concerts_id' => $id_concert, 'type' => "ME"))
                ->insert('wall_melo_component');
        
       // return $this->returnMarkup($id_concert);
    }

	/*
    private function returnMarkup($id_concert) {
        return '<a id="' . $id_concert . '" href="#" class="noparticiper"><span class="button_left"></span><span  class="button_center">Je n\'y vais plus</span><span class="button_right"></span></a>';
    }
	*/
	
	// je ne vais plus à un concert
    public function delete_activity($id_concert, $uid) {
        $data_delete_act = array('Utilisateur_id' => $uid, 'Concerts_id' => $id_concert);
        $this->db->delete('concerts_activite', $data_delete_act);

        $data_delete_acte = array('Utilisateur_id' => $uid, 'concerts_id' => $id_concert, 'type' => "ME");
        $this->db->delete('wall_melo_component', $data_delete_acte);
    }

	//concerts participés par un utilisateur
    public function get_activity($user_id) {
        return $this->db->select('Concerts_id')
                        ->from('concerts_activite')
                        ->where(array('Utilisateur_id' => $user_id))
                        ->get()
                        ->result();
    }
    
    //participants à un concert
    public function get_public()
    {
    	return $this->db->select('COUNT(Utilisateur_id) AS nperson,concerts_id')
    					->from('concerts_activite')
    					->group_by('concerts_id')
    					->get()
    					->result();
    }

}