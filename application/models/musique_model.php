<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Musique_model extends CI_Model {
	
	protected $tbl_playlist = 'playlists';
	protected $tbl_morceaux = 'morceaux';
	protected $tbl_user = 'utilisateur';
	protected $tbl_album = 'albums';
	protected $tbl_order = 'commande';
	protected $tbl_orderinfo = 'infos_commande';
	protected $tbl_doc = 'documents';

	//---------------------------------------------------------------------------
	//-								GENERAL	MUSIQUE								-
	//---------------------------------------------------------------------------


	
	public function get_morceau_by_playlist_user()
	{
		return $this->db->select('Morceaux_id,playlists.nom,morceaux.nom AS title_track,utilisateur.login,albums.nom AS title_album,morceaux.duree')
						->from($this->tbl_playlist)
						->join($this->tbl_morceaux, 'morceaux.id = playlists.Morceaux_id')
						->join($this->tbl_album, 'morceaux.albums_id = albums.id','LEFT OUTER')
						->join($this->tbl_user, 'morceaux.Utilisateur_id = utilisateur.id')
						->where(array('playlists.Utilisateur_id'=>30))
						->get()
						->result();
	
	}
	
	//---------------------------------------------------------------------------
	//-								PLAYER										-
	//---------------------------------------------------------------------------


	
	
	public function get_my_playlist_player($user_id,$type,$name,$morceau)
	{
		if($type == 'playlist')
		{
			if($name == null)
			{
				$pl_or_album =  $this->db->select('nom')
									->from($this->tbl_playlist)
									->where(array('Utilisateur_id'=>$user_id))
									->group_by('nom')
									->get()
									->result();
					
				$morceaux =  $this->db->select('Morceaux_id,playlists.nom,morceaux.nom AS title_track,utilisateur.login,albums.nom AS title_album,morceaux.duree')
									->from($this->tbl_playlist)
									->join($this->tbl_morceaux, 'morceaux.id = playlists.Morceaux_id')
									->join($this->tbl_album, 'morceaux.albums_id = albums.id','LEFT OUTER')
									->join($this->tbl_user, 'morceaux.Utilisateur_id = utilisateur.id')
									->where(array('playlists.Utilisateur_id'=>30))
									->get()
									->result();
			}
			
			if($name != null)
			{

					$pl_or_album =  $this->db->select('nom')
											->from($this->tbl_playlist)
											->where(array('Utilisateur_id'=>$user_id,'nom'=>str_replace('%20',' ',$name)))
											->group_by('nom')
											->get()
											->result();
					
					$morceaux =  $this->db->select('Morceaux_id,playlists.nom,morceaux.nom AS title_track,utilisateur.login,albums.nom AS title_album,morceaux.duree')
									->from($this->tbl_playlist)
									->join($this->tbl_morceaux, 'morceaux.id = playlists.Morceaux_id')
									->join($this->tbl_album, 'morceaux.albums_id = albums.id','LEFT OUTER')
									->join($this->tbl_user, 'morceaux.Utilisateur_id = utilisateur.id')
									->where(array('playlists.Utilisateur_id'=>30,'playlists.nom'=>str_replace('%20',' ',$name)))
									->get()
									->result();
			
			}
		}
		
		if($type == 'album')
		{	
			if($name == null)
			{
				$pl_or_album =  $this->db->select('nom')
									->from($this->tbl_album)
									->where(array('Utilisateur_id'=>$user_id))
									->group_by('nom')
									->get()
									->result();	
			
			
				$morceaux =  $this->db->select('morceaux.id,albums.nom,morceaux.nom AS title_track,utilisateur.login,albums.nom AS title_album,morceaux.duree')
										->from($this->tbl_album)
										->join($this->tbl_morceaux, 'morceaux.Albums_id = albums.id')
										->join($this->tbl_user, 'morceaux.Utilisateur_id = utilisateur.id')
										->where(array('albums.Utilisateur_id'=>30))
										->get()
										->result();
			}
			if($name != null)
			{
				$pl_or_album =  $this->db->select('nom')
									->from($this->tbl_album)
									->where(array('Utilisateur_id'=>$user_id,'nom'=>str_replace('%20',' ',$name)))
									->group_by('nom')
									->get()
									->result();	
			
			
				$morceaux =  $this->db->select('morceaux.id,albums.nom,morceaux.nom AS title_track,utilisateur.login,albums.nom AS title_album,morceaux.duree')
										->from($this->tbl_album)
										->join($this->tbl_morceaux, 'morceaux.Albums_id = albums.id')
										->join($this->tbl_user, 'morceaux.Utilisateur_id = utilisateur.id')
										->where(array('albums.Utilisateur_id'=>30,'albums.nom'=>str_replace('%20',' ',$name)))
										->get()
										->result();
			}
		}
		
		return array($pl_or_album,$morceaux);
	}
	
	public function get_morceau($id_morceau)
	{
		return $this->db->select('nom')
							->from($this->tbl_morceaux)
							->where(array('id'=>$id_morceau))
							->get()
							->result();	
	}
		
	//---------------------------------------------------------------------------
	//-								MORCEAUX									-
	//---------------------------------------------------------------------------


	public function get_album_une($user_id)
	{
		return $this->db->select('nom,img_cover,annee,livret_path,documents.id AS doc_id')
				->from($this->tbl_album)
				->where(array('une'=>1,'Utilisateur_id'=>$user_id))
				->join($this->tbl_doc, 'documents.albums_id = albums.id','LEFT OUTER')
				->get()
				->result();
	}
	
	public function get_morceau_une($user_id)
	{
		return $this->db->select('morceaux.id, morceaux.nom,duree')
				->from($this->tbl_morceaux)
				->join($this->tbl_album, 'morceaux.albums_id = albums.id','LEFT OUTER')
				->where(array('une'=>1,'morceaux.Utilisateur_id'=>$user_id))
				->get()
				->result();
	}

	public function get_morceau_user($user_id)
	{
		return $this->db->select('morceaux.id,morceaux.nom,albums.nom AS title_alb,morceaux.duree,albums.id AS id_alb')
				->from($this->tbl_morceaux)
				->where(array('morceaux.Utilisateur_id'=>$user_id))
				->join($this->tbl_album, 'morceaux.albums_id = albums.id','LEFT OUTER')
				->get()
				->result();
	}

	
	public function get_album_page($id_alb)
	{
		return $this->db->select('nom,img_cover,annee,livret_path,documents.id AS doc_id')
				->from($this->tbl_album)
				->where(array('albums.id'=>$id_alb))
				->join($this->tbl_doc, 'documents.albums_id = albums.id','LEFT OUTER')
				->get()
				->result();
	}
	
		public function get_morceau_alb_page($user_id,$id_alb)
	{
		return $this->db->select('morceaux.id, morceaux.nom,duree')
				->from($this->tbl_morceaux)
				->join($this->tbl_album, 'morceaux.albums_id = albums.id','LEFT OUTER')
				->where(array('albums.id'=>$id_alb,'morceaux.Utilisateur_id'=>$user_id))
				->get()
				->result();
	}


	//---------------------------------------------------------------------------
	//-								PLAYLIST									-
	//---------------------------------------------------------------------------

	public function get_my_playlist($user_id)
	{
		return $this->db->select('COUNT(Morceaux_id) AS n_morceau,Morceaux_id,playlists.nom,COUNT(Distinct morceaux.Utilisateur_id) AS n_artiste')
				->from($this->tbl_playlist)
				->join($this->tbl_morceaux,'morceaux.id = playlists.Morceaux_id')
				->where(array('playlists.Utilisateur_id'=>$user_id))
				->group_by('nom')
				->get()
				->result();
	
	
	}
	
	public function delete_playlist_data($name,$user)
	{	
		$name = str_replace ('%20',' ',$name);
		$this->db->delete($this->tbl_playlist, array('Utilisateur_id' => $user,'nom'=>$name)); 
	}
	
	/*
	public function get_n_artiste()
	{
		return $this->db->select('COUNT(morceaux.Utilisateur_id) AS n_artiste')
				->from($this->tbl_playlist)
				->join($this->tbl_morceaux,'morceaux.id = playlists.Morceaux_id')
				->where(array('playlists.Utilisateur_id'=>30))
				->group_by('playlists.nom')
				->get()
				->result();
	}
	*/
	
	public function add_like_morceau($user,$morceau)
	{
	
		$update_like_morceau = "UPDATE morceaux SET like_total = like_total + 1 WHERE id = '".$morceau."'";
		$this->db->query($update_like_morceau);
		
		$update_like_morceau_gal = 'UPDATE ilike SET like_value = like_value +1 WHERE Morceaux_id= ?';
        $this->db->query($update_like_morceau_gal, array($morceau));
        
        $update_like_morceau_user = 'INSERT INTO like_activity_pav (Utilisateur_id,Morceaux_id) VALUES ( ?,?)';
        $this->db->query($update_like_morceau_user, array($user,$morceau));
	
	}
	
	public function get_my_like_morceau()
	{
		return $this->db->select('morceaux_id')
				->from('like_activity_pav')
				->where(array('Utilisateur_id' => $this->session->userdata('uid'),'morceaux_id IS NOT NULL'=>null))
				->get()
				->result();
	}
	
	public function delete_like_morceau($user,$morceau)
	{
		$update_like_morceau = "UPDATE morceaux SET like_total = like_total - 1 WHERE id = '".$morceau."'";
		$this->db->query($update_like_morceau);
		
		$update_like_morceau_gal = 'UPDATE ilike SET like_value = like_value -1 WHERE Morceaux_id= ?';
        $this->db->query($update_like_morceau_gal, array($morceau));
        
        $update_like_morceau_user = 'DELETE FROM like_activity_pav WHERE Utilisateur_id = ? AND Morceaux_id = ?';
        $this->db->query($update_like_morceau_user, array($user,$morceau));

	
	}
	
	public function delete_morceau_playlist($user,$morceau)
	{
		$this->db->delete($this->tbl_playlist, array('Morceaux_id' => $morceau,'Utilisateur_id'=>$user)); 

	}
	
	public function pl_to_panier($user_id,$morceaux_id)
	{
		$id_commande_user =  $this->db->select('id')
									->from($this->tbl_order)
									->where(array('Utilisateur_id'=>$user_id,'status'=>'P'))
									->get()
									->result();
		if (empty($id_commande_user)==1)
		{
			$data = array(
   				'Utilisateur_id' => $user_id ,
   				'date' => date('Y-m-d H:i:s', now()),
   				'status' => 'P'
			);

			$this->db->insert($this->tbl_order, $data); 
		}
		
		$existing_panier =  $this->db->select('id,titre')
									->from($this->tbl_orderinfo)
									->where_in('Morceaux_id',$morceaux_id)
									->where(array('Commande_id'=>$id_commande_user[0]->id))
									->get()
									->result();
		if(empty($existing_panier)==1)
		{
			$id_commande_user =  $this->db->select('id')
										->from($this->tbl_order)
										->where(array('Utilisateur_id'=>$user_id,'status'=>'P'))
										->get()
										->result();
		
		
			$info_morceaux = $this->db->select('id,nom,Albums_id,prix,format')
									->from($this->tbl_morceaux)
									->where_in('id',$morceaux_id)
									->get()
									->result();
		
			foreach($info_morceaux as $info_morceau)
			{
				$data_cmd = array(
	   				'Commande_id' => $id_commande_user[0]->id ,
   					'Albums_id' => $info_morceau->Albums_id ,
   					'titre' => $info_morceau->nom,
   					'prix' => $info_morceau->prix,
   					'morceaux_id' => $info_morceau->id,
   					'format' => $info_morceau->format
				);

				$this->db->insert($this->tbl_orderinfo, $data_cmd); 		
				return 'ajout';
			}	
		}				
	}
}