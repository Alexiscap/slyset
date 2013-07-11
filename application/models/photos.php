<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class photos extends CI_Model
{
    protected $table_album = 'album_media';
    protected $table_photos = 'photos';
    protected $table_video = 'videos';
    
    public function get_album($user_id)
    {
  	 return $this->db->select('nom')        				
                        ->from ($this->table_album)
                        ->where(array('Utilisateur_id' => $user_id))
                        ->group_by('nom')
                        ->get()
                        ->result();

    }
   /* 
    public function get_video($user_id)
    {
     return $this->db->select('nom')        				
                        ->from ($this->table_video)
                        ->where(array('Utilisateur_id' => $user_id))
                       // ->group_by('nom')
                        ->get()
                        ->result();
    }
*/
    
    public function get_media_user($user_id)
    {
    /*SELECT photos.file_name 
FROM photos 
      LEFT OUTER JOIN album_media ON photos.photos.id = album_media.Photos_id 
              AND photos.Utilisateur_id = 30 
WHERE album_media.Photos_id IS NULL

*/
//premier select : select des potos orpheline
//ajouter toutes les infos
// requete : tous selectionné (commentaire aussi)

/*

(SELECT photos.file_name,photos.nom,photos.date,photos.id,commentaires.comment
							FROM photos 
   						  		 LEFT OUTER JOIN album_media ON photos.id = album_media.Photos_id 
                                 LEFT OUTER JOIN commentaires ON photos.id = commentaires.photos_id
             						AND photos.Utilisateur_id = 30 
									WHERE album_media.Photos_id IS NULL	
							)  
							
							UNION

*/


//select 2 : select des dossier : selectionner en plus les photos associer au dossier
return $one =  $this->db->query('SELECT album_media.file_name,album_media.nom,album_media.id,album_media.Photos_id
							FROM album_media 
								WHERE album_media.Utilisateur_id = '.$user_id.'	
								GROUP BY album_media.nom 
								HAVING album_media.Photos_id
							ORDER BY date DESC')		
                        //->get()
                        ->result();
                    // a partir de album_id : select all photo
                        }
   //ne pas oblier de changer le 30 en variable$user id !!!
      public function liste_photos($user_id)
    {
        return $this->db->query('(SELECT photos.file_name,photos.nom,photos.date,photos.id,photos.like_total,1 as type
								FROM photos 
   						  		 LEFT OUTER JOIN album_media ON photos.id = album_media.Photos_id 
             						WHERE photos.Utilisateur_id = '.$user_id.'	 
									AND album_media.Photos_id IS NULL
									)
									UNION
								(SELECT album_media.file_name,album_media.nom,album_media.date,album_media.Photos_id,album_media.like_total,2
							FROM album_media 
								WHERE album_media.Utilisateur_id = '.$user_id.'	 	
								GROUP BY album_media.file_name
								)
								UNION
								(
								SELECT videos.nom,videos.description,videos.date,videos.id,videos.like_total,3
								FROM videos
								 LEFT OUTER JOIN album_media ON videos.id = album_media.Videos_id 
								WHERE videos.Utilisateur_id = '.$user_id.'	 
									AND album_media.Videos_id IS NULL								)
								ORDER BY date DESC
									')
        
                        ->result();
    }
                       
    public function liste_comments() //$nb = 50, $debut = 0
    {

        return $this->db->select('*,commentaires.id AS comm_id')
                        ->from($this->table_photos)
                        ->join('commentaires', 'commentaires.photos_id = photos.id')
                        ->join('utilisateur','utilisateur.id = commentaires.Utilisateur_id')
                        ->order_by('commentaires.id', 'asc')
                        ->get()
                        ->result();
    } 
    
      public function liste_comments_album() //$nb = 50, $debut = 0
    {
   
        return $this->db->select('*,commentaires.id AS comm_id')
                        ->from($this->table_album)
                        ->join('commentaires', 'commentaires.album_media_file_name = album_media.file_name')
                    	->join('utilisateur','utilisateur.id = commentaires.Utilisateur_id')
                        ->group_by('commentaires.id')
                        ->order_by('commentaires.id', 'asc')
                        ->get()
                        ->result();
    } 
    
    public function liste_comments_video()
    	{
    	//return this->db->query('SELECT * FROM')
    	return $this->db->select('*,commentaires.id AS comm_id')
    				->from($this->table_video)
    				->join('commentaires', 'commentaires.video_id = videos.id')
    				    ->join('utilisateur','utilisateur.id = commentaires.Utilisateur_id')
                        ->group_by('commentaires.id')
                        ->order_by('commentaires.id', 'asc')
                        ->get()
                        ->result();
    	}
        public function all_photos_album() //$nb = 50, $debut = 0
    {
   
        return $this->db->select('*')
                        ->from($this->table_photos)
                        ->get()
                        ->result();
    }  
      
      public function all_photos() //$nb = 50, $debut = 0
    {
   
        return $this->db->select('*')
                        ->from($this->table_album)
                       // ->join('photos', 'photos.id = album_media.Photos_id')
                        ->get()
                        ->result();
    }            
            //modif le 31 mais à 15h :
            /*          
    public function get_photos_by_album($user_id,$name_album)
             {
             $sql = 'SELECT photos.file_name,album_media.id,photos.id,album_media.nom
							FROM photos
								  JOIN album_media ON photos.id = album_media.Photos_id
								AND photos.Utilisateur_id = 30
								AND album_media.nom = ?
								
								';
               //photos.file_name,album_media.id
			return $this->db->query($sql,array($name_album))
								
						->result();
				}*/
				
	public function get_photos_by_album($user_id,$name_album)
    {
        $requete_album = '(SELECT  photos.file_name,photos.nom,photos.date,photos.id,photos.like_total,1 as type
								FROM album_media
								JOIN photos
								ON  photos.id=album_media.Photos_id
								WHERE album_media.Utilisateur_id = ? AND album_media.file_name = ?
									)
									UNION
								(
								SELECT videos.nom,videos.description,videos.date,videos.id,videos.like_total,2
								FROM album_media
								JOIN videos
								ON  videos.id=album_media.Videos_id
								WHERE album_media.Utilisateur_id = ? AND album_media.file_name = ?)
								
									';
     	return $this->db->query($requete_album,array($user_id,$name_album,$user_id,$name_album))
     	->result();
     	
 
				
	}
				
	public function get_comment_by_photos($user_id,$photos_id,$para_info)
				{
				$sql = $para_info.',Utilisateur_id';
				  return $this->db->select($sql)        				
                        ->from ('commentaires')
                        ->where(array('Photos_id' => $photos_id))
                        ->get()
                        ->result();
				}
				
/*
        $photo_general = $this->db->select('nom,file_name,id')        				
                        ->from ($this->table_photos)
                        ->where(array('Utilisateur_id' => $user_id))
                        ->get()
                        ->result();
            return $photo_general->id;

       return $photo_comment = $this->db->select('comment,file_name,id')        				
                        ->from ('commentaires')
                        ->where(array('id' => $photo_general->id))
                        ->get()
                        ->result();
                        
*/
    
    
    public function get_info_album($nom_album)
    	{
    	return $this->db->select('file_name,nom')   
                        ->from ($this->table_album)
                        ->where('nom',$nom_album)
                        ->get()
                        ->result();
    	}
     public function get_abum_for_photo($id_photo)
    	{
    	return $this->db->select('file_name,nom')   
                        ->from ($this->table_album)
                        ->where('Photos_id',$id_photo)
                        ->get()
                        ->result();
    	}
    public function get_photo_by_id($id_photo)
    	{
    	return $this->db->select('nom,file_name')   
                        ->from ($this->table_photos)
                        ->where('id',$id_photo)
                        ->get()
                        ->result();
    	}
    
    
    public function insert_photos($filename,$user_name,$album_file_name,$album_name,$photo_name) 
    {
   		  $this->db->set(array('Utilisateur_id'=>$user_name,'file_name'=>$filename,'nom'=>$photo_name))
        	        ->insert($this->table_photos);
    	  $last_id_photos =  $this->db->insert_id();
    	      		$photo_last_id =  $this->db->insert_id();

    	      $this->db->set(array('Photos_id'=>$last_id_photos,'like_value'=>"0"))
                	->insert('ilike');

			
    	  if ($album_name != null||$album_name != '')
    		{
     			$this->db->set(array('Utilisateur_id'=>$user_name,'file_name'=>$album_file_name,'nom'=>$album_name,'Photos_id'=>$last_id_photos))
                	->insert($this->table_album);
                
             $data_add_cmty_photo = array('Utilisateur_id'=>$user_name,'photos_id'=>$photo_last_id,'albums_media_file_name'=>$album_file_name,'type'=>"MU"); 
	 	$this->db->insert('wall_melo_component', $data_add_cmty_photo); 
			}
		else {
		
		$data_add_cmty_photo = array('Utilisateur_id'=>$user_name,'photos_id'=>$photo_last_id,'type'=>"MU"); 
	 	$this->db->insert('wall_melo_component', $data_add_cmty_photo); 
		
		}
		
    }
    
    public function update_photo($user_id,$id_photos,$nom_photo,$album_name,$file_name_a,$file_name_photo)
    	{
    	//update
 
    	     $data_photos =  array('nom'=>$nom_photo,'file_name'=>$file_name_photo);
  		
    		 $this->db->where('id',$id_photos)
               		 ->update($this->table_photos,$data_photos);
               		 
            if ($album_name != null||$album_name != '')
    		{
    			$this->db->where('Photos_id',$id_photos);
				$this->db->delete($this->table_album); 
				
     			$this->db->set(array('Utilisateur_id'=>$user_id,'file_name'=>$file_name_a,'nom'=>$album_name,'Photos_id'=>$id_photos))
                	->insert($this->table_album);
                
            
			}
	
    	}
    	
       public function update_album($user_id,$file_name_album,$nom_album)
    	{
    	//update
 
    	     $data_album =  array('nom'=>$nom_album);
			$where_para = array('file_name' => $file_name_album, 'Utilisateur_id' => $user_id);

    		 $this->db->where($where_para)
               		 ->update($this->table_album,$data_album);
		 
    	}
    	
       public function update_video($user_id,$id_video,$nom_video,$album_name,$file_name_a)
    	{
    	//update
 
    	     $data_videos =  array('description'=>$nom_video);

			$where_para = array('id'=>$id_video, 'Utilisateur_id' => $user_id);

    		 $this->db->where($where_para)
               		 ->update($this->table_video,$data_videos);
               		 

               		 
            if ($album_name != null||$album_name != '')
    		{
    			$this->db->where('Videos_id',$id_video);
				$this->db->delete($this->table_album); 
				
     			$this->db->set(array('Utilisateur_id'=>$user_id,'file_name'=>$file_name_a,'nom'=>$album_name,'Videos_id'=>$id_video))
                	->insert($this->table_album);
                
            
			}
	

		
    	}

    public function insert_comments()
    {
        if(!empty($_POST['usercomment']) && !empty($_POST['messageid'])){
            $wallid   = $this->input->post('messageid');
            $comment  = $this->input->post('usercomment');
            $created  = Date('Y-m-d H:i:s');
            
//        
            
            $commentArray = array(
              'photos_id'  =>   $wallid,
              'comment'  =>   $comment,
              'created'  =>   $created,
              'Utilisateur_id' => $this->session->userdata('uid')
            );
            
            $this->db->insert('commentaires', $commentArray);
            return $this->returnMarkup($comment, $created);
        } else {
            echo 'Oops, une erreur ! Vérifie que tu as bien remplie ton commentaire !';
        }
    }
    
    
        
    private function returnMarkup($comment, $created)
    {         
                
              return  '<div class="comm">
						
    					<img src="'.base_url('/files/profiles/'. $this->session->userdata('thumb')).'" />
      					<p class="name_comm">'. $this->session->userdata('login').'</p>
      					<p class="commentaire">'.$comment.'</p> 
    				</div>';
    }
    
    public function insert_comments_album()
    {
        if(!empty($_POST['usercomment']) && !empty($_POST['messageid'])){
            $wallid   = $this->input->post('messageid');
            $comment  = $this->input->post('usercomment');
            $created  = Date('Y-m-d H:i:s');
            
//        
            
            $commentArray = array(
              'album_media_file_name' =>   $wallid,
              'comment'  =>   $comment,
              'created'  =>   $created,
              'Utilisateur_id' =>$this->session->userdata('uid')
            );
            
            $this->db->insert('commentaires', $commentArray);
            return $this->returnMarkup($comment, $created);
        } else {
            echo 'Oops, une erreur ! Vérifie que tu as bien remplie ton commentaire !';
        }
    }
    
        
    public function insert_comments_video()
    {
        if(!empty($_POST['usercomment']) && !empty($_POST['messageid'])){
            $wallid   = $this->input->post('messageid');
            $comment  = $this->input->post('usercomment');
            $created  = Date('Y-m-d H:i:s');
            
//        
            
            $commentArray = array(
              'video_id' =>   $wallid,
              'comment'  =>   $comment,
              'created'  =>   $created,
              'Utilisateur_id' => $this->session->userdata('uid')
            );
            
            $this->db->insert('commentaires', $commentArray);
            return $this->returnMarkup($comment, $created);
        } else {
            echo 'Oops, une erreur ! Vérifie que tu as bien remplie ton commentaire !';
        }
    }

    
    public function insert_like($id_photo,$id_user)
    {
        	  //$data_album =  array('like_total'=> like_total+1);
//+1
		$requete_photo ='UPDATE photos SET like_total = like_total +1 WHERE id= ?';
     	$this->db->query($requete_photo,array($id_photo));
     
		$requet_like = 'UPDATE ilike SET like_value = like_value +1 WHERE Photos_id= ?';
	 	$this->db->query($requet_like,array($id_photo));
	 
	  	$this->db->set(array('Photo_id'=>$id_photo,'Utilisateur_id'=>$id_user))
                	->insert('like_activity_pav');
                	
        $data_delete_act = array('Utilisateur_id'=>$id_user,'photos_id'=>$id_photo,'type'=>"ME"); 
	 	$this->db->insert('wall_melo_component', $data_delete_act); 
	
    }
    
      public function insert_like_a($file_name_album,$id_user)
    {
        	  //$data_album =  array('like_total'=> like_total+1);

//+1
		$requete_photo ='UPDATE album_media SET like_total = like_total +1 WHERE file_name= ?';
     $this->db->query($requete_photo,array($file_name_album));
     
		$requet_like = 'UPDATE ilike SET like_value = like_value +1 WHERE Album_media_file_name= ?';
	 $this->db->query($requet_like,array($file_name_album));
	 
	  $this->db->set(array('Album_media_file_name'=>$file_name_album,'Utilisateur_id'=>$id_user))
                	->insert('like_activity_pav');
	
    }
    
	public function insert_like_v($video_id,$id_user)
    {
        	  //$data_album =  array('like_total'=> like_total+1);

//+1
		$requete_photo ='UPDATE videos SET like_total = like_total +1 WHERE id= ?';
     	$this->db->query($requete_photo,array($video_id));
     
		$requet_like = 'UPDATE ilike SET like_value = like_value +1 WHERE Videos_id= ?';
	 	$this->db->query($requet_like,array($video_id));
	 
	  	$this->db->set(array('Video_id'=>$video_id,'Utilisateur_id'=>$id_user))
                	->insert('like_activity_pav');
                	
   	  	$data_delete_act = array('Utilisateur_id'=>$id_user,'videos_id'=>$video_id,'type'=>"ME"); 
	 	$this->db->insert('wall_melo_component', $data_delete_act); 
	
    }
    
    
     public function delete_like($id_photo,$id_user)
    {
        	  //$data_album =  array('like_total'=> like_total+1);

//+1
		$requete_photo ='UPDATE photos SET like_total = like_total -1 WHERE id= ?';
    	$this->db->query($requete_photo,array($id_photo));
     
		$requet_like = 'UPDATE ilike SET like_value = like_value -1 WHERE Photos_id= ?';
		$this->db->query($requet_like,array($id_photo));
	 
		$this->db->where(array('Photo_id'=>$id_photo,'Utilisateur_id'=>$id_user))
                	->delete('like_activity_pav');
        
        $data_delete_act = array('Utilisateur_id'=>$id_user,'photos_id'=>$id_photo,'type'=>"ME"); 
	 	$this->db->delete('wall_melo_component', $data_delete_act); 

	
    }
    
      public function delete_like_a($file_name_album,$id_user)
    {
        	  //$data_album =  array('like_total'=> like_total+1);

//+1
		$requete_photo ='UPDATE album_media SET like_total = like_total -1 WHERE file_name= ?';
     $this->db->query($requete_photo,array($file_name_album));
     
		$requet_like = 'UPDATE ilike SET like_value = like_value -1 WHERE Album_media_file_name= ?';
	 $this->db->query($requet_like,array($file_name_album));
	 
	  $this->db->where(array('Album_media_file_name'=>$file_name_album,'Utilisateur_id'=>$id_user))
                	->delete('like_activity_pav');
	
    }
    
      
      public function delete_like_v($video_id,$id_user)
    {
        	  //$data_album =  array('like_total'=> like_total+1);

//+1
		$requete_photo ='UPDATE videos SET like_total = like_total -1 WHERE id= ?';
     	$this->db->query($requete_photo,array($video_id));
     
		$requet_like = 'UPDATE ilike SET like_value = like_value -1 WHERE Videos_id= ?';
	 	$this->db->query($requet_like,array($video_id));
	 
	  	$this->db->where(array('Video_id'=>$video_id,'Utilisateur_id'=>$id_user,))
                	->delete('like_activity_pav');
                	
     	$data_delete_act = array('Utilisateur_id'=>$id_user,'videos_id'=>$video_id,'type'=>"ME"); 
	 	$this->db->delete('wall_melo_component', $data_delete_act); 

	
    }
    
    public function get_like_user ($user_id)
    {
    	 return $this->db->select('Photo_id , Album_media_file_name, Video_id')        				
                        ->from('like_activity_pav')
                        ->where(array('Utilisateur_id' => $user_id))
                        ->get()
                        ->result();
                        
        
    }
    
    public function add_video ($id_video,$user_id,$description,$album_nom)
    {
   
    	$this->db->set(array('nom'=>$id_video,'Utilisateur_id'=>$user_id,'description'=>$description))
    			->insert('videos');
    	  $last_id_video =  $this->db->insert_id();
    	
    	    	  $id_video =  $this->db->insert_id();

    	
    	if ($album_nom != null||$album_nom != '')
    		{
     			$this->db->set(array('Utilisateur_id'=>$user_id,'nom'=>$album_nom,'Videos_id'=>$id_video))
                	->insert($this->table_album);
                
             $data_add_cmty_photo = array('Utilisateur_id'=>$user_id,'videos_id'=>$id_video,'albums_media_file_name'=>$album_nom,'type'=>"MU"); 
	 	$this->db->insert('wall_melo_component', $data_add_cmty_photo); 
			}
		else {
		
		$data_add_cmty_photo = array('Utilisateur_id'=>$user_id,'videos_id'=>$id_video,'type'=>"MU"); 
	 	$this->db->insert('wall_melo_component', $data_add_cmty_photo); 
		
		}
    	
    	
    	
    	$data_delete_act = array('Utilisateur_id'=>$user_id,'videos_id'=>$last_id_video,'type'=>"MU"); 
 	
	 	$this->db->insert('wall_melo_component', $data_delete_act); 
	
    }
    
    public function delete_photo($id_photo)
    {
    
      $this->db->where(array('id'=>$id_photo))
                	->delete('photos');
	
    
    }
    
     public function delete_video($id_video)
    {
    
      $this->db->where(array('id'=>$id_video))
                	->delete('videos');
	
    
    }
     public function delete_album($file_name_album)
    {
    $this->db->query('DELETE photos FROM photos JOIN album_media ON album_media.photos_id = photos.id WHERE album_media.file_name = "'.$file_name_album.'"');
      $this->db->where(array('file_name'=>$file_name_album))
                	->delete('album_media');
	
    
    }
    
    public function get_zoom_photos($id_photo)
    {
    	return $this->db->query('SELECT Utilisateur_id,like_total,file_name,nom,id FROM photos WHERE id='.$id_photo)
    					->result();
    }
    
     public function get_zoom_photos_comment($id_photo)
    {
    	return $this->db->query('SELECT comment,utilisateur.login,Utilisateur_id,utilisateur.thumb FROM commentaires JOIN utilisateur ON utilisateur.id = commentaires.Utilisateur_id WHERE photos_id='.$id_photo)
    					->result();
    }
    
    public function delete_comment($id_com)
    {
     $this->db->where(array('id'=>$id_com))
                	->delete('commentaires');
	
    }
    

}