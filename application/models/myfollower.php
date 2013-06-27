<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class myfollower extends CI_Model
{



	protected $table_communaute = 'communaute';
	protected $table_info_user = 'utilisateur';

	public function get_all_abonnement($user_id)
	{
		return $this->db->select('communaute.id,communaute.Utilisateur_id,utilisateur.login,communaute.type,utilisateur.style_ecoute,utilisateur.style_joue,utilisateur.cover,utilisateur.description')
					->where('Follower_id',$user_id)
					->from($this->table_communaute)
					->join('utilisateur','utilisateur.id=communaute.Utilisateur_id')
					->get()
					->result();
	
	}
	
	public function delete_wall_community($id_community)
	{
	$this->db->delete($this->table_communaute, array('id' => $id_community)); 

	
	}

}