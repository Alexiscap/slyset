<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class follower extends CI_Model
{



	protected $table_communaute = 'communaute';
	protected $table_info_user = 'utilisateur';

	public function get_all_follower_user($user_id)
	{
		return $this->db->select('communaute.Follower_id,utilisateur.login,communaute.type,utilisateur.style_ecoute,utilisateur.style_joue,utilisateur.cover,utilisateur.description')
					->where('Utilisateur_id',$user_id)
					->from($this->table_communaute)
					->join('utilisateur','utilisateur.id=communaute.Follower_id')
					->get()
					->result();
	
	}
	
		public function get_follower_bytype($user_id,$type)
	{
		return $this->db->select('communaute.Follower_id,utilisateur.login,communaute.type,utilisateur.style_ecoute,utilisateur.style_joue,utilisateur.cover,utilisateur.description')
					->where('Utilisateur_id',$user_id)
					->where('communaute.type',$type)
					->from($this->table_communaute)
					->join('utilisateur','utilisateur.id=communaute.Follower_id')
					->get()
					->result();
	
	}


}