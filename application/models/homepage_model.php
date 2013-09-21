<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Homepage_model extends CI_Model {

    protected $table = 'concerts';
    protected $data;
    protected $tbl_activity_concert = 'concerts_activite';
    protected $tbl_morceau = 'morceaux';
    protected $tbl_user = 'utilisateur';
    protected $tbl_alb  ='albums';
    protected $tbl_community = 'communaute';
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

    public function fil_top_morceau()
    {

        return $this->db->select('morceaux.id,morceaux.Utilisateur_id,utilisateur.description AS descri_f_t,utilisateur.login,morceaux.nom,utilisateur.thumb,albums.nom AS name_alb,morceaux.created')
                        ->from($this->tbl_morceau)
                        ->join($this->tbl_user, 'morceaux.Utilisateur_id = utilisateur.id','LEFT OUTER')
                        ->join($this->tbl_alb,'morceaux.albums_id = albums.id','LEFT OUTER')
                        ->where('nombre_lectures > 100')
                        ->get()
                        ->result();

    }

    public function fil_top_concert()
    {

        return $this->db->select('concerts.id,concerts.Utilisateur_id,utilisateur.description,utilisateur.login,concerts.titre,utilisateur.thumb,concerts.created,concerts.date,concerts.salle')
                        ->from($this->tbl_activity_concert)
                        ->join($this->table,'concerts.id = concerts_activite.Concerts_id')
                        ->join($this->tbl_user, 'concerts.Utilisateur_id = utilisateur.id','LEFT OUTER')
                        ->group_by('concerts_activite.concerts_id')
                        ->having ('(COUNT(concerts_activite.concerts_id)) > 1')
                        ->get()
                        ->result();

    }

    public function fil_top_people()
    {
                return $this->db->select('communaute.Utilisateur_id,utilisateur.thumb,utilisateur.login,utilisateur.description AS description_f_p,communaute.created')
                        ->from($this->tbl_community)
                        ->join($this->tbl_user, 'communaute.Utilisateur_id = utilisateur.id','LEFT OUTER')
                        ->group_by('communaute.Utilisateur_id')
                        ->having ('COUNT(communaute.Utilisateur_id) > 1')
                        ->get()
                        ->result();
    }

}