<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stat_model extends CI_Model {

    protected $table = 'utilisateur';
    protected $table_info_cmd = 'infos_commande';
    protected $table_track = 'morceaux';
    protected $table_album = 'albums';
    protected $table_doc = 'documents';
    protected $table_cmd = 'commande';

    protected $data;

    public function __construct() {
        parent::__construct();
        $data = array();
    }

    
    public function count_vente_titre($user_id)
    {
        return $this->db->select('COUNT(infos_commande.id) AS vente_titre')
                        ->from($this->table_info_cmd)
                        ->join($this->table_track ,'morceaux.id = infos_commande.morceaux_id')
                        ->join($this->table_cmd ,'commande.id = infos_commande.commande_id')
                        ->where(array('morceaux.Utilisateur_id' => $user_id, 'commande.status'=>'V','infos_commande.documents_id IS NULL'=>null))
                        ->get()
                        ->result();
    }

    public function stat_by_track($user_id)
    {
        return $this->db->select('morceaux.nom,morceaux.nombre_lectures,COUNT(infos_commande.morceaux_id) AS vente_by_titre')
                        ->from($this->table_track)
                        ->join($this->table_info_cmd ,'morceaux.id = infos_commande.morceaux_id')
                        ->join($this->table_cmd ,'commande.id = infos_commande.commande_id')
                        ->where(array('morceaux.Utilisateur_id'=>$user_id,'commande.status'=>'V','infos_commande.documents_id IS NULL'=>null))
                        ->group_by('morceaux.id')
                        ->get()
                        ->result();
    }

    public function stat_euro_track($user_id)
    {
        return $this->db->select('SUM(infos_commande.prix) AS gain_track')
                        ->from($this->table_info_cmd)
                        ->join($this->table_cmd ,'commande.id = infos_commande.commande_id')
                        ->join($this->table_track ,'morceaux.id = infos_commande.morceaux_id')
                        //->join($this->table_album ,'albums.id = infos_commande.albums_id')
                        //->join($this->table_doc ,'documents.id = infos_commande.documents_id')
                        //->where(array())
                        ->where(array('morceaux.Utilisateur_id'=>$user_id,'commande.status'=>'V','infos_commande.documents_id IS NULL'=>null))
                        //->group_by('morceaux.id')
                        ->get()
                        ->result();
    }

    public function stat_euro_album($user_id)
    {
        return $this->db->select('SUM(infos_commande.prix) AS gain_alb')
                        ->from($this->table_info_cmd)
                        ->join($this->table_cmd ,'commande.id = infos_commande.commande_id')
                        ->join($this->table_album ,'albums.id = infos_commande.albums_id')
                        ->where(array('albums.Utilisateur_id'=>$user_id,'commande.status'=>'V','infos_commande.documents_id IS NULL'=>null,'infos_commande.morceaux_id IS NULL'=>null))
                        ->get()
                        ->result();
    }

    public function stat_euro_doc($user_id)
    {
        return $this->db->select('SUM(infos_commande.prix) AS gain_doc,COUNT(commande.Utilisateur_id)')
                        ->from($this->table_info_cmd)
                        ->join($this->table_cmd ,'commande.id = infos_commande.commande_id')
                        ->join($this->table_doc ,'documents.id = infos_commande.documents_id')
                        ->where(array('documents.Utilisateur_id'=>$user_id,'commande.status'=>'V'))
                        ->get()
                        ->result();
    }

    public function count_distinc_buyer()
    {
        return $this->db->query('SELECT COUNT(DISTINCT(commande.Utilisateur_id)) AS n_client
                                FROM infos_commande
                                    JOIN commande ON commande.id = infos_commande.commande_id
                                        LEFT OUTER JOIN albums ON albums.id = infos_commande.albums_id
                                            LEFT OUTER JOIN documents ON documents.id = infos_commande.documents_id
                                                LEFT OUTER JOIN morceaux ON morceaux.id = infos_commande.morceaux_id
                                WHERE ( documents.Utilisateur_id =30 OR albums.Utilisateur_id =30 OR albums.Utilisateur_id =30)
                                    AND commande.status = "V"')
                        ->result();

    }

}