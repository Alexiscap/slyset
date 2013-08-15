<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Musique_model extends CI_Model {
	
	protected $tbl_playlist = 'playlists';
	protected $tbl_morceaux = 'morceaux';
	protected $tbl_user = 'utilisateur';
	protected $tbl_album = 'albums';


	//---------------------------------------------------------------------------
	//-								GENERAL	MUSIQUE								-
	//---------------------------------------------------------------------------

	public function get_my_playlist_player()
	{
		return $this->db->select('Morceaux_id,nom')
				->from($this->tbl_playlist)
				->where(array('Utilisateur_id'=>30))
				->group_by('nom')
				->get()
				->result();
	}
	
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
	//-								MORCEAUX									-
	//---------------------------------------------------------------------------

	//---------------------------------------------------------------------------
	//-								PLAYLIST									-
	//---------------------------------------------------------------------------

	public function get_my_playlist()
	{
		return $this->db->select('COUNT(Morceaux_id) AS n_morceau,Morceaux_id,playlists.nom,COUNT(Distinct morceaux.Utilisateur_id) AS n_artiste')
				->from($this->tbl_playlist)
				->join($this->tbl_morceaux,'morceaux.id = playlists.Morceaux_id')
				->where(array('playlists.Utilisateur_id'=>30))
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
		/*$like = 'like_total + 1' ;
	$this->db->set('like_total', $like);

$this->db->where('nom',$morceau);
$this->db->update($this->tbl_morceaux, $data); */
	}
	
	public function get_my_like_morceau()
	{
		return $this->db->select('morceaux_id')
				->from('like_activity_pav')
				->where(array('Utilisateur_id' => $this->session->userdata('uid'),'morceaux_id IS NOT NULL'=>null))
				->get()
				->result();
	}
}