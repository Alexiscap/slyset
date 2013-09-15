<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Melo_concert_model extends CI_Model {

    protected $table = 'concerts';
    protected $table_people = 'utilisateur';
    protected $table_addresse = 'adresse';

	/*
    public function get_user($user_id) {
        return $this->db->select('nom,prenom,login')
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
	
	//concerts melomane en fonction du temps
    public function count_melo_concert($user_id, $date) {
        //date_default_timezone_set('Europe/Paris');
        $today = now();
        $datestring = mdate('%Y-%m-%d %H:%i:00');

        $appel = $this->db->select('concerts_activite.id')
                ->from('concerts_activite')
                ->join('concerts', 'concerts_activite.Concerts_id = concerts.id')
                ->where(array('concerts_activite.Utilisateur_id' => $user_id, 'concerts.date ' . $date => $datestring))
                ->get();
        return $appel->num_rows();
    }

    public function get_concert($nb, $first = 0, $user_id, $date) {
        $this->load->helper('date');
        if (!is_integer($nb) OR $nb < 1 OR !is_integer($first) OR $first < 0) {
            return false;
        }
        //date_default_timezone_set('Europe/Paris');
        $today = now();
        $datestring = mdate('%Y-%m-%d %H:%i:00');
    				
        return $this->db->select('concerts_activite.id,concerts.id AS concerts_id,concerts.titre,adresse.ville,concerts.date,concerts.Adresse_id,concerts.salle,adresse.pays,concerts.prix,concerts.seconde_partie,adresse.numero_adresse,adresse.voie_adresse,adresse.ville,adresse.code_postal,adresse.phone_number,adresse.website')
                        ->from('concerts_activite')
                        ->join('concerts', 'concerts.id=concerts_activite.Concerts_id')
                        ->join('adresse', 'adresse.id=concerts.Adresse_id')
                        ->where(array('concerts_activite.Utilisateur_id' => $user_id, 'date ' . $date => $datestring))
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

    public function add_activity($id_concert, $uid) {
        $this->db->set(array('Utilisateur_id' => $uid, 'Concerts_id' => $id_concert))
                ->insert('concerts_activite');

        /*$this->db->set(array('Utilisateur_id' => $uid, 'concerts_id' => $id_concert, 'type' => "ME"))
                ->insert('wall_melo_component');*/
        //return $this->returnMarkup($id_concert);
    }

    /*private function returnMarkup($id_concert) {
        return '<a id="' . $id_concert . '" href="#" class="noparticiper"><span class="button_left"></span><span  class="button_center">Je n\'y vais plus</span><span class="button_right"></span></a>';
    }*/

    public function delete_activity($id_concert, $uid) {
        $data_delete_act = array('Utilisateur_id' => $uid, 'Concerts_id' => $id_concert);
        $this->db->delete('concerts_activite', $data_delete_act);

        $data_delete_acte_cmty = array('Utilisateur_id' => $uid, 'concerts_id' => $id_concert, 'type' => 'ME');
        $this->db->delete('wall_melo_component', $data_delete_acte_cmty);
    }

    public function get_activity($user_id) {
        return $this->db->select('Concerts_id')
                        ->from('concerts_activite')
                        ->where(array('Utilisateur_id' => $user_id))
                        ->get()
                        ->result();
    }

}