<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Homepage_model extends CI_Model {

    protected $table = 'concerts';
    protected $data;

    public function __construct() {
        parent::__construct();
        $this->data = array();
    }

    public function get_concert() {
        return $this->db->select('date,titre,salle,Utilisateur_id,salle,ville,concerts.id,seconde_partie')
                        ->from($this->table)
                        ->join('adresse', 'concerts.Adresse_id=adresse.id')
                        ->get()
                        ->result();
    }

    public function get_date() {
        return $this->db->select('date')
                        ->from($this->table)
                        ->join('adresse', 'concerts.Adresse_id=adresse.id')
                        ->group_by('date')
                        ->get()
                        ->result();
    }

}