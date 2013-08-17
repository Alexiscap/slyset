<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Achat_model extends CI_Model {

    protected $table_cmd = 'commande';
    protected $table_cmd_info = 'infos_commande';
    protected $data;
    protected $data_cmd;

    public function __construct() {
        parent::__construct();
        $this->data = array();
        $this->data_cmd = array();
    }
    
    //toutes les infos produits sur une commande
    public function get_achat($user_id) {
        $sql = "(SELECT infos_commande.id,commande.Utilisateur_id,commande.date,status,infos_commande.Albums_id,infos_commande.Morceaux_id,infos_commande.Documents_id,morceaux.nom AS nom,documents.type_document AS type,utilisateur.login AS user_login,infos_commande.prix,documents.format,commande.id AS commande_id
					FROM commande
						INNER JOIN infos_commande ON infos_commande.Commande_id = commande.id
							INNER JOIN documents ON infos_commande.Documents_id = documents.id
								INNER JOIN morceaux ON documents.Morceaux_id = morceaux.id
									INNER JOIN utilisateur ON utilisateur.id = morceaux.Utilisateur_id
					WHERE commande.Utilisateur_id = ? 
				)
				UNION
				(SELECT infos_commande.id,commande.Utilisateur_id,commande.date,status,infos_commande.Albums_id,infos_commande.Morceaux_id,infos_commande.Documents_id,albums.nom,'album',utilisateur.login,infos_commande.prix,albums.format,commande.id AS commande_id
					FROM commande
						INNER JOIN infos_commande ON infos_commande.Commande_id = commande.id
							INNER JOIN albums ON infos_commande.Albums_id = albums.id
								INNER JOIN utilisateur ON utilisateur.id = albums.Utilisateur_id
					WHERE commande.Utilisateur_id = ? 
					AND infos_commande.Morceaux_id IS NULL
				)
				UNION
				(SELECT infos_commande.id,commande.Utilisateur_id,commande.date,status,infos_commande.Albums_id,infos_commande.Morceaux_id,infos_commande.Documents_id,morceaux.nom,'morceau',utilisateur.login,infos_commande.prix,morceaux.format,commande.id AS commande_id
					FROM infos_commande
						INNER JOIN commande ON infos_commande.Commande_id = commande.id
							INNER JOIN morceaux ON infos_commande.Morceaux_id = morceaux.id
								INNER JOIN utilisateur ON utilisateur.id = morceaux.Utilisateur_id
					WHERE commande.Utilisateur_id = ? )";
					
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
        
        $this->db->where('id', $id_commande);
        $this->db->delete($this->table_cmd);

        $this->db->where('Commande_id', $id_commande);
        $this->db->delete($this->table_cmd_info);
    }

	//la derniere commande existante
    public function number_commande() {
    	
    	return $last_commande = $this->db->select('MAX(titre) AS last_cmd')
    							->from($this->table_cmd_info)
    							->get()
    							->result();
        /*return $last_commande = $this->db->query('SELECT MAX(titre) AS last_cmd FROM infos_commande')
                						->result();*/
    }

	//infos commandes produit commande validé (par n° de cmd)
    public function cmd_valider($cmd) 
    {
        return $download_last_cmd = $this->db->query(
        	'(SELECT commande.id,commande.Utilisateur_id,commande.date,status,infos_commande.Albums_id,infos_commande.Morceaux_id,infos_commande.Documents_id,morceaux.nom AS nom,documents.type_document AS type,utilisateur.login AS user_login,infos_commande.prix,documents.format
				FROM commande
					INNER JOIN infos_commande ON infos_commande.Commande_id = commande.id
						INNER JOIN documents ON infos_commande.Documents_id = documents.id
							INNER JOIN morceaux ON documents.Morceaux_id = morceaux.id
								INNER JOIN utilisateur ON utilisateur.id = morceaux.Utilisateur_id
				WHERE infos_commande.titre =' . $cmd . ' 
			)
			UNION
			(SELECT commande.id,commande.Utilisateur_id,commande.date,status,infos_commande.Albums_id,infos_commande.Morceaux_id,infos_commande.Documents_id,albums.nom,"album",utilisateur.login,infos_commande.prix,albums.format
				FROM infos_commande
					INNER JOIN commande ON infos_commande.Commande_id = commande.id
						INNER JOIN albums ON infos_commande.Albums_id = albums.id
							INNER JOIN utilisateur ON utilisateur.id = albums.Utilisateur_id

				WHERE infos_commande.titre =' . $cmd . '
			)
			UNION	
			(SELECT commande.id,commande.Utilisateur_id,commande.date,status,infos_commande.Albums_id,infos_commande.Morceaux_id,infos_commande.Documents_id,morceaux.nom,"morceau",utilisateur.login,infos_commande.prix,morceaux.format
				FROM commande
					INNER JOIN infos_commande ON infos_commande.Commande_id = commande.id
						INNER JOIN morceaux ON infos_commande.Morceaux_id = morceaux.id
							INNER JOIN utilisateur ON utilisateur.id = morceaux.Utilisateur_id
				WHERE infos_commande.titre =' . $cmd . '
			)')
              		 					 ->result();
    }

}
