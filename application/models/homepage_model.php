<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Homepage_model extends CI_Model {

    protected $table = 'concerts';
    protected $data;
    protected $tbl_morceau = 'morceaux';
    protected $tbl_user = 'utilisateur';
    protected $tbl_alb  ='albums';

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

    public function get_top_morceau()
    {
        return $this->db->select('morceaux.nom,utilisateur.login,utilisateur.id AS loggin_id, albums.nom AS name_alb,morceaux.id AS id_track')
                        ->from($this->tbl_morceau)
                        ->join($this->tbl_user,'morceaux.Utilisateur_id = utilisateur.id')
                        ->join($this->tbl_alb,'albums.id = morceaux.albums_id', 'LEFT OUTER')
                        ->order_by('nombre_lectures DESC')
                        ->limit(10)
                        ->get()
                        ->result();

    }

}