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
	
}