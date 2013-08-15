<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Musique_model extends CI_Model {
	
	protected $tbl_playlist = 'playlists';
	protected $tbl_morceaux = 'morceaux';
	

	public function get_my_playlist()
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
		return $this->db->select('Morceaux_id,playlists.nom,morceaux.nom AS title_track')
				->from($this->tbl_playlist)
				->join($this->tbl_morceaux, 'morceaux.id = playlists.Morceaux_id')
				->where(array('playlists.Utilisateur_id'=>30))
				->get()
				->result();
	
	}
}