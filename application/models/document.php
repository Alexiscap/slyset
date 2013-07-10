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
	
	public function all_doc($user_id)
	{
	return $this->db->query('SELECT morceaux_id,path,type_document FROM documents WHERE Utilisateur_id = '.$user_id.' ORDER BY type_document ASC')
					->result();
	}
	
	public function get_morceau_album()
	{
		return $this->db->query('SELECT morceaux.id,morceaux.nom,morceaux.Albums_id,documents.path,documents.prix,documents.type_document
								FROM morceaux
								JOIN albums ON morceaux.Albums_id = albums.id
								JOIN documents ON morceaux.id = documents.Morceaux_id
										WHERE morceaux.Utilisateur_id = 30
								GROUP BY documents.Albums_id
																ORDER BY type_document ASC

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
	return $this->db->query('SELECT nom,id FROM morceaux WHERE Albums_id = '.$album)
			->result();
	}

	public function insert_doc($album,$morceau,$path,$type)
	{
	$this->db->set(array('albums_id'=>$album,'Morceaux_id'=>$morceau,'path'=>$path,'Utilisateur_id'=>$this->session->userdata('uid'),'format'=>'pdf','type_document'=>$type))
                	->insert('documents');
                	}

	public function insert_livret($album,$path)
	{
	
						
						$data = array(
               'livret_path' => $path,
             
            );

$this->db->where('id', $album);
$this->db->update('albums', $data); 

	}
}