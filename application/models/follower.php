<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class follower extends CI_Model
{



	protected $table_communaute = 'communaute';
	protected $table_info_user = 'utilisateur';
	protected $table_wall_melo = 'wall_melo_component';

	public function get_all_follower_user($user_id)
	{
		return $this->db->select('communaute.id,communaute.Follower_id,utilisateur.login,communaute.type,utilisateur.style_ecoute,utilisateur.style_joue,utilisateur.cover,utilisateur.description')
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
	
	public function get_abonnement($user_id)
	{
		return $this->db->select('Utilisateur_id,communaute.type')
					->where('Follower_id',$user_id)
					->from($this->table_communaute)
					->get()
					->result();
	
	}
	
	
	public function add_follow($user_id,$id_follower,$type)
	{
	
		$data_follow = array(
  		 	'Utilisateur_id' => $user_id ,
   			'type' => $type ,
  		 	'Follower_id' => $id_follower
		);

		$this->db->insert($this->table_communaute, $data_follow); 
	    $last_id_follow = $this->db->insert_id();

		$data_follow_wall = array(
  		 	'Utilisateur_id' => $id_follower ,
   			'type' => 'ME' ,
  		 	'Following_id' => $last_id_follow
		);

		$this->db->insert($this->table_wall_melo, $data_follow_wall); 
	}

	public function ifollow($user_id,$follower_id)
	{
	return $this->db->select('id')
			->where(array('Utilisateur_id'=>$user_id,'Follower_id'=>$follower_id))
			->from($this->table_communaute)
			->get()
			->result();
	}
	
	public function delete_follow($user_id,$id_follower)
	{
	
		$data_follow = array(
  		 	'Utilisateur_id' => $user_id ,
  		 	'Follower_id' => $id_follower
		);

		$id_communaute = $this->db->select('id')
								->where(array('Utilisateur_id'=>$user_id,'Follower_id'=>$id_follower))
								->from($this->table_communaute)
								->get()
								->result();
		
		$this->db->where($data_follow)
				->delete($this->table_communaute);
	
		$data_follow_wall = array(
  		 	'Utilisateur_id' => $id_follower ,
  		 	'Following_id' => $id_communaute[0]->id
		);

		$this->db->where($data_follow_wall)
				->delete($this->table_wall_melo);
	}
}