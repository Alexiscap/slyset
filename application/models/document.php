<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class document extends CI_Model
{

	protected $table_doc = 'documents';
	public function get_all_morceau_doc($user_id)
	{
		// les id morceaux sans album + les morceaux par albums
		return $this->db->query('(SELECT Morceaux_Id,documents.Albums_id,albums.nom,albums.annee,albums.livret_path,img_cover, 1 as type
								FROM documents
								JOIN albums ON documents.Albums_id = albums.id
										WHERE documents.Utilisateur_id = 30
								GROUP BY documents.Albums_id
						)
						
						'
						)
					
	
						->result();
				
				
	
	}
	
	public function get_morceau_album()
	{
		return $this->db->query('SELECT morceaux.id,morceaux.nom,morceaux.Albums_id,documents.path,documents.prix
								FROM morceaux
								JOIN albums ON morceaux.Albums_id = albums.id
								JOIN documents ON morceaux.id = documents.Morceaux_id
										WHERE morceaux.Utilisateur_id = 30
								')
					->result();
	
}

	public function get_album($user_id)
	{
	return $this->db->query('SELECT nom,id FROM albums WHERE Utilisateur_id = '.$user_id)
			->result();
	}
	
	
	public function get_morceau_by_album($album)
	{
	return $this->db->query('SELECT nom FROM morceaux WHERE Albums_id = '.$album)
			->result();
	}
}