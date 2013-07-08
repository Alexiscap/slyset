<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class wallm extends CI_Model
{

 	protected $table_album = 'album_media';
    protected $table_photos = 'photos';
    protected $table_video = 'videos';
    protected $table_communaute = 'communaute';
	protected $table_message = 'wall';
	
	public function get_following($user_id)
	{
	
		 return $this->db->select('Utilisateur_id')        				
                        ->from ($this->table_communaute)
                        ->where(array('Follower_id' => $user_id))
                        ->get()
                        ->result(); 
	//$sql = "SELECT * FROM `myTable` WHERE `myField` IN (1,40,20,55,29,48)";

	}
	
	public function get_info_user($user_id)
	{
	return $this->db->select('*')        				
                        ->from ('utilisateur')
                        ->where(array('id' => $user_id))
                        ->get()
                        ->result(); 
	}
	
	public function get_entities_id($list_id,$user_id)
	{
	       //  $this->db->join('photos as b','true');
	if($list_id!=null)
	{
$sql_mu = '(SELECT wall_melo_component.id,wall_melo_component.type,wall_melo_component.date,photos_id as idproduit,photos.nom AS main_nom,photos.file_name,photos.Utilisateur_id,utilisateur.thumb,utilisateur.login, "null" AS ville,"null" AS salle,"null" AS walltouser, 1 as product
				FROM wall_melo_component
				JOIN photos
						ON photos.id = wall_melo_component.Photos_id
				JOIN utilisateur
						ON utilisateur.id = photos.Utilisateur_id
					WHERE wall_melo_component.Utilisateur_id 	
						IN ('.$list_id.') 
					AND wall_melo_component.type = "MU")			
			UNION
			(SELECT wall_melo_component.id,wall_melo_component.type,wall_melo_component.date,videos_id,videos.description,videos.nom,videos.Utilisateur_id,utilisateur.thumb,utilisateur.login,"null","null" ,"null", 2 as product
				FROM wall_melo_component
				JOIN videos
						ON videos.id = wall_melo_component.Videos_id
				JOIN utilisateur
						ON utilisateur.id = videos.Utilisateur_id
					WHERE wall_melo_component.Utilisateur_id 	
						IN ('.$list_id.') 
					AND wall_melo_component.type = "MU")
			UNION
			(SELECT wall_melo_component.id,wall_melo_component.type,wall_melo_component.date,concerts_id,concerts.titre,concerts.seconde_partie,utilisateur.id,Utilisateur.thumb,utilisateur.login,adresse.ville,concerts.salle,"null", 3 as product
				FROM wall_melo_component
				JOIN concerts
						ON concerts.id = wall_melo_component.concerts_id
				JOIN adresse
						ON adresse.id = concerts.Adresse_id
				JOIN Utilisateur
						ON Utilisateur.id = concerts.Utilisateur_id
					WHERE wall_melo_component.Utilisateur_id 	
						IN ('.$list_id.') 
					AND wall_melo_component.type = "MU")
			UNION
			(SELECT wall_melo_component.id,wall_melo_component.type,wall_melo_component.date,message_id,wall.markup_message,"null",utilisateur.id,utilisateur.thumb,utilisateur.login,"null","null",wall.wallto_utilisateur_id,  4 as product
				FROM wall_melo_component
				JOIN wall
						ON wall.id = wall_melo_component.message_id
				JOIN Utilisateur
						ON Utilisateur.id = wall.wallto_utilisateur_id
					WHERE wall_melo_component.Utilisateur_id 	
						IN ('.$list_id.') 
					AND wall_melo_component.type = "MU")
			UNION
			
			(SELECT wall_melo_component.id,wall_melo_component.type,wall_melo_component.date,message_id,wall.markup_message,"null",utilisateur.id,utilisateur.thumb,utilisateur.login,"null","null",wall.wallto_utilisateur_id,  4 as product
				FROM wall_melo_component
				JOIN wall
						ON wall.id = wall_melo_component.message_id
				JOIN Utilisateur
						ON Utilisateur.id = wall.wallto_utilisateur_id
					WHERE wall_melo_component.Utilisateur_id 	
						IN ('.$user_id.') 
					AND wall_melo_component.type = "ME")
			
			UNION 
			(SELECT wall_melo_component.id,wall_melo_component.type,wall_melo_component.date,photos_id,photos.nom,photos.file_name,photos.Utilisateur_id,utilisateur.thumb,utilisateur.login,"null","null","null", 1 as product
				FROM wall_melo_component
				JOIN photos
						ON photos.id = wall_melo_component.Photos_id
				JOIN utilisateur
						ON utilisateur.id = photos.Utilisateur_id
					WHERE wall_melo_component.Utilisateur_id = '.$user_id.'
					AND wall_melo_component.type = "ME")
			UNION

			(SELECT wall_melo_component.id,wall_melo_component.type,wall_melo_component.date,videos_id,videos.description,videos.nom,videos.Utilisateur_id,utilisateur.thumb,utilisateur.login,"null","null","null",  2 as product
				FROM wall_melo_component
				JOIN videos
						ON videos.id = wall_melo_component.Videos_id
				JOIN utilisateur
						ON utilisateur.id = videos.Utilisateur_id
					WHERE wall_melo_component.Utilisateur_id= '.$user_id.'
					AND wall_melo_component.type = "ME")
					
			UNION

			(SELECT wall_melo_component.id,wall_melo_component.type,wall_melo_component.date,concerts_id,concerts.titre,concerts.seconde_partie,concerts.Utilisateur_id,Utilisateur.thumb,Utilisateur.login,adresse.ville,concerts.salle,"null" ,3 as product
				FROM wall_melo_component
				JOIN concerts
						ON concerts.id = wall_melo_component.concerts_id
				JOIN adresse
						ON adresse.id = concerts.Adresse_id
				JOIN utilisateur
						ON concerts.Utilisateur_id = utilisateur.id
					WHERE wall_melo_component.Utilisateur_id= '.$user_id.'
					AND wall_melo_component.type = "ME")
			ORDER BY date DESC
				';/*	
				UNION
			(SELECT morceaux_id,morceaux.nom,3
				FROM wall_melo_component
				JOIN morceaux
						ON morceaux.id = wall_melo_component.morceaux_id
					WHERE wall_melo_component.Utilisateur_id 	
						IN ('.$listforin.') 
					AND type = "MU")
				UNION
			(SELECT concerts_id,concerts.titre,4
				FROM wall_melo_component
				JOIN concerts
						ON concerts.id = wall_melo_component.concerts_id
					WHERE wall_melo_component.Utilisateur_id 	
						IN ('.$listforin.') 
					AND type = "MU")
			';*/
	return $this->db->query($sql_mu)
					->result();
   		} 			
   		 			/*$this->db->select('*')        				
                        ->from ('wall_melo_component')
                       	->where_in('Utilisateur_id', $user_id)     
                       	->where('type','MU') 
                       	->order_by('date','desc')     
                        ->get()
                        ->result(); 
            */
	}
	
	public function difference($list_id,$user_id)
	{
	$sql_diff ='SELECT id FROM wall_melo_component WHERE Utilisateur_id IN ('.$list_id.') AND type ="MU" OR (Utilisateur_id = '.$user_id.' AND type="ME")';
	return $this->db->query($sql_diff)
					->result();
					
	
	}
	
	
	public function get_new_item($id_component)
		{
		$sql_new_item = 'SELECT wall_melo_component.id,wall_melo_component.type,wall_melo_component.date
				FROM wall_melo_component
				JOIN photos
						ON photos.id = wall_melo_component.Photos_id
				JOIN utilisateur
						ON utilisateur.id = photos.Utilisateur_id
					WHERE wall_melo_component.id = '.$id_component;	
		return $this->db->query($sql_new_item)
					->result();	
		}
  /*
  
  	
   
    public function get_album($user_id)
    {
  	 return $this->db->select('nom')        				
                        ->from ($this->table_album)
                        ->where(array('Utilisateur_id' => $user_id))
                        ->group_by('nom')
                        ->get()
                        ->result();

    }
  */
  
  public function delete_activity_wall($id)
  {
  $this->db->delete('wall_melo_component', array('id' => $id)); 

  
  }
  
}
  