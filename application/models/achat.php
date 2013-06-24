<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class achat extends CI_Model
{
	protected $table_cmd ='commande';
	
	public function get_achat($user_id)
	{
		$sql = "(SELECT commande.id,commande.Utilisateur_id,commande.date,status,infos_commande.Albums_id,infos_commande.Morceaux_id,infos_commande.Documents_id,morceaux.nom AS nom,documents.type_document AS type,utilisateur.login AS user_login,infos_commande.prix,documents.format
					FROM commande
					INNER JOIN infos_commande ON infos_commande.Commande_id = commande.id
					INNER JOIN documents ON infos_commande.Documents_id = documents.id
					INNER JOIN morceaux ON documents.Morceaux_id = morceaux.id
					INNER JOIN utilisateur ON utilisateur.id = morceaux.Utilisateur_id
					WHERE commande.Utilisateur_id = ? )
					UNION
(SELECT commande.id,commande.Utilisateur_id,commande.date,status,infos_commande.Albums_id,infos_commande.Morceaux_id,infos_commande.Documents_id,albums.nom,'album',utilisateur.login,infos_commande.prix,albums.format
					FROM commande
					INNER JOIN infos_commande ON infos_commande.Commande_id = commande.id
					INNER JOIN albums ON infos_commande.Albums_id = albums.id
					INNER JOIN utilisateur ON utilisateur.id = albums.Utilisateur_id

					WHERE commande.Utilisateur_id = ? )
					UNION
(SELECT commande.id,commande.Utilisateur_id,commande.date,status,infos_commande.Albums_id,infos_commande.Morceaux_id,infos_commande.Documents_id,morceaux.nom,'morceau',utilisateur.login,infos_commande.prix,morceaux.format
					FROM commande
					INNER JOIN infos_commande ON infos_commande.Commande_id = commande.id
					INNER JOIN morceaux ON infos_commande.Morceaux_id = morceaux.id
					INNER JOIN utilisateur ON utilisateur.id = morceaux.Utilisateur_id

					WHERE commande.Utilisateur_id = ? )
					 ";
		  return $this->db->query($sql,array($user_id,$user_id,$user_id))
                        ->result();		
	}

	public function panier_to_achat()
	{
	
	}


}