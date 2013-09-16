<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Achat_model extends CI_Model {

    protected $table_cmd = 'commande';
    protected $table_cmd_info = 'infos_commande';
    protected $data;
    protected $data_cmd;
    protected $tb_track = 'morceaux';
    protected $tb_doc = 'documents';
    protected $tb_alb = 'albums';
    public function __construct() {
        parent::__construct();
        $this->data = array();
        $this->data_cmd = array();
    }
    
    //toutes les infos produits sur une commande
    public function get_achat($user_id) {
        $sql = "(SELECT infos_commande.id,commande.Utilisateur_id,commande.date,status,infos_commande.Albums_id,infos_commande.Morceaux_id,infos_commande.Documents_id,morceaux.nom AS nom,documents.type_document AS type,utilisateur.login AS user_login,utilisateur.id AS artiste_id,infos_commande.prix,documents.format,commande.id AS commande_id,'null' AS name_alb
					FROM commande
						INNER JOIN infos_commande ON infos_commande.Commande_id = commande.id
							INNER JOIN documents ON infos_commande.Documents_id = documents.id
								INNER JOIN morceaux ON documents.Morceaux_id = morceaux.id
									INNER JOIN utilisateur ON utilisateur.id = morceaux.Utilisateur_id
					WHERE commande.Utilisateur_id = ? 
				)
				UNION
				(SELECT infos_commande.id,commande.Utilisateur_id,commande.date,status,infos_commande.Albums_id,infos_commande.Morceaux_id,infos_commande.Documents_id,albums.nom,'album',utilisateur.login,utilisateur.id AS artiste_id,infos_commande.prix,albums.format,commande.id AS commande_id,'null'
					FROM commande
						INNER JOIN infos_commande ON infos_commande.Commande_id = commande.id
							INNER JOIN albums ON infos_commande.Albums_id = albums.id
								INNER JOIN utilisateur ON utilisateur.id = albums.Utilisateur_id
					WHERE commande.Utilisateur_id = ? 
					AND infos_commande.Morceaux_id IS NULL
				)
				UNION
				(SELECT infos_commande.id,commande.Utilisateur_id,commande.date,status,infos_commande.Albums_id,infos_commande.Morceaux_id,infos_commande.Documents_id,morceaux.nom,'morceau',utilisateur.login,utilisateur.id AS artiste_id,infos_commande.prix,morceaux.format,commande.id AS commande_id,albums.nom 
					FROM infos_commande
						INNER JOIN commande ON infos_commande.Commande_id = commande.id
							INNER JOIN morceaux ON infos_commande.Morceaux_id = morceaux.id
								INNER JOIN utilisateur ON utilisateur.id = morceaux.Utilisateur_id
                                    LEFT OUTER JOIN albums ON albums.id = morceaux.Albums_id
					WHERE commande.Utilisateur_id = ? 
                                        AND Documents_id IS NULL
)";
					
        return $this->db->query($sql, array($user_id, $user_id, $user_id))
                        ->result();
    }


    public function panier_to_achat($id_commande, $last_cmd) 
    {
        $data = $this->data;
        $data_cmd = $this->data_cmd;           
        $data['status'] = "V";
        $my_cmd = $this->db->select('id')
        		->from($this->table_cmd)
        		->where(array('Utilisateur_id'=>$this->session->userdata('uid')))
        		->get()
        		->result();

        // passage de la commande en validé
        $this->db->where('Utilisateur_id', $this->session->userdata('uid'));
        $this->db->update($this->table_cmd, $data);

        $data_cmd['titre'] = $last_cmd + 1;
        
        //attribution d'un numero de commande
        $this->db->where('Commande_id', $my_cmd[0]->id);
        $this->db->update($this->table_cmd_info, $data_cmd);
    }

    public function delete_panier($id_commande) 
    {
        
        //$this->db->where('id', $id_commande);
        //$this->db->delete($this->table_cmd);

        $this->db->where('id', $id_commande);
        $this->db->delete($this->table_cmd_info);
    }

	//la derniere commande existante
    public function number_commande() {
    	
    	return $last_commande = $this->db->select('MAX(id) AS last_cmd')
    							->from($this->table_cmd)
                                ->where('Utilisateur_id',$this->session->userdata('uid'))
    							->get()
    							->result();
        /*return $last_commande = $this->db->query('SELECT MAX(titre) AS last_cmd FROM infos_commande')
                						->result();*/
    }

	//infos commandes produit commande validé (par n° de cmd)
    public function cmd_valider($cmd) 
    {
        return $download_last_cmd = $this->db->query(
        	'(SELECT commande.id,infos_commande.id AS id_info,commande.Utilisateur_id,commande.date,status,infos_commande.Albums_id,infos_commande.Morceaux_id,infos_commande.Documents_id,morceaux.nom AS nom,documents.type_document AS type,utilisateur.login AS user_login,infos_commande.prix,documents.format
				FROM commande
					INNER JOIN infos_commande ON infos_commande.Commande_id = commande.id
						INNER JOIN documents ON infos_commande.Documents_id = documents.id
							INNER JOIN morceaux ON documents.Morceaux_id = morceaux.id
								INNER JOIN utilisateur ON utilisateur.id = morceaux.Utilisateur_id
				WHERE infos_commande.Commande_id =' . $cmd . ' 
			)
			UNION
			(SELECT commande.id,infos_commande.id AS id_info,commande.Utilisateur_id,commande.date,status,infos_commande.Albums_id,infos_commande.Morceaux_id,infos_commande.Documents_id,albums.nom,"album",utilisateur.login,infos_commande.prix,albums.format
				FROM infos_commande
					INNER JOIN commande ON infos_commande.Commande_id = commande.id
						INNER JOIN albums ON infos_commande.Albums_id = albums.id
							INNER JOIN utilisateur ON utilisateur.id = albums.Utilisateur_id
				WHERE infos_commande.Commande_id =' . $cmd . ' AND infos_commande.Morceaux_id IS NULL AND infos_commande.Documents_id IS NULL
			)
			UNION	
			(SELECT commande.id,infos_commande.id AS id_info,commande.Utilisateur_id,commande.date,status,infos_commande.Albums_id,infos_commande.Morceaux_id,infos_commande.Documents_id,morceaux.nom,"morceau",utilisateur.login,infos_commande.prix,morceaux.format
				FROM commande
					INNER JOIN infos_commande ON infos_commande.Commande_id = commande.id
						INNER JOIN morceaux ON infos_commande.Morceaux_id = morceaux.id
							INNER JOIN utilisateur ON utilisateur.id = morceaux.Utilisateur_id
				WHERE infos_commande.Commande_id =' . $cmd . ' AND infos_commande.Documents_id IS NULL
			)')
              		 					 ->result();
    }
    
    public function all_panier()
    {
    	return $this->db->select('infos_commande.Morceaux_id')
    			->from($this->table_cmd_info)
    			->join($this->table_cmd,'infos_commande.Commande_id = commande.id')
    			->where(array('commande.status'=>'P','Utilisateur_id'=>$this->session->userdata('uid')))
    			->get()
    			->result();
    }

    public function notif_panier($user_id)
    {
        return $this->db->select('COUNT(infos_commande.id) AS n_notif')
                        ->from($this->table_cmd)
                        ->join($this->table_cmd_info, 'infos_commande.Commande_id = commande.id','INNER JOIN')
                        ->where(array('commande.status'=>'P','Utilisateur_id'=>$user_id))
                        ->get()
                        ->result();


    }

    public function get_item_for_cmd_dwnld($id_commandes)
    {
       return $this->db->select('infos_commande.*,documents.path,documents.Utilisateur_id AS doc_user,albums.Utilisateur_id AS alb_user,morceaux.Utilisateur_id AS track_user,albums.nom AS name_alb,morceaux.filename AS track_fname,documents.path AS path_doc,documents.type_document AS type_doc')
                ->from($this->table_cmd_info)
                ->join($this->tb_track,'infos_commande.Morceaux_id = morceaux.id','LEFT OUTER')
                ->join($this->tb_doc,'infos_commande.Documents_id = documents.id','LEFT OUTER')
                ->join($this->tb_alb,'infos_commande.Albums_id = albums.id','LEFT OUTER')
                ->where_in ('infos_commande.id',$id_commandes)
                ->get()
                ->result();


    }

}
