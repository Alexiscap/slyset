<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Photo_model extends CI_Model {

    protected $table_album = 'album_media';
    protected $table_photos = 'photos';
    protected $table_video = 'videos';
    protected $data;

    public function __construct() {
        parent::__construct();
        $data = array();
    }

    public function get_album($user_id) {
        return $this->db->select('nom')
                        ->from($this->table_album)
                        ->where(array('Utilisateur_id' => $user_id))
                        ->group_by('nom')
                        ->get()
                        ->result();
    }

    public function get_media_user($user_id) {
        //select 2 : select des dossier : selectionner en plus les photos associer au dossier
        return $one = $this->db->query('SELECT album_media.file_name,album_media.nom,album_media.id,album_media.Photos_id
							FROM album_media 
								WHERE album_media.Utilisateur_id = ' . $user_id . '	
								GROUP BY album_media.nom 
								HAVING album_media.Photos_id
							ORDER BY date DESC')
                ->result();
    }

    public function liste_photos($user_id) {
        return $this->db->query('(SELECT photos.file_name,photos.nom,photos.date,photos.id,photos.like_total,1 as type
								FROM photos 
   						  		 LEFT OUTER JOIN album_media ON photos.id = album_media.Photos_id 
             						WHERE photos.Utilisateur_id = ' . $user_id . '	 
									AND album_media.Photos_id IS NULL
									)
									UNION
								(SELECT album_media.file_name,album_media.nom,album_media.date,album_media.Photos_id,album_media.like_total,2
							FROM album_media 
								WHERE album_media.Utilisateur_id = ' . $user_id . '	 	
								GROUP BY album_media.file_name
								)
								UNION
								(
								SELECT videos.nom,videos.description,videos.date,videos.id,videos.like_total,3
								FROM videos
								 LEFT OUTER JOIN album_media ON videos.id = album_media.Videos_id 
								WHERE videos.Utilisateur_id = ' . $user_id . '	 
									AND album_media.Videos_id IS NULL								
								)
								UNION
								(SELECT photo,markup_message,created,null,null,4
									FROM wall
									WHERE wallto_utilisateur_id = '.$user_id.'
										AND photo IS NOT NULL
										GROUP BY wall.utilisateur_id
									ORDER BY created ASC
									
									LIMIT 0,4
									
								)	
								ORDER BY date DESC
								')

                        ->result();
    }

    public function liste_comments() {
        return $this->db->select('*,commentaires.id AS comm_id')
                        ->from($this->table_photos)
                        ->join('commentaires', 'commentaires.photos_id = photos.id')
                        ->join('utilisateur', 'utilisateur.id = commentaires.Utilisateur_id')
                        ->order_by('commentaires.id', 'asc')
                        ->get()
                        ->result();
    }

	public function liste_comments_wall()
	{
		return $this->db->select('wall.id as photos_id,utilisateur.thumb,utilisateur.login,commentaires.comment,commentaires.id AS comm_id')
                         ->from('wall')
                        ->join('commentaires', 'commentaires.wall_id = wall.id')
                       
                        ->join('utilisateur', 'utilisateur.id = commentaires.Utilisateur_id')
                        ->where('commentaires.wall_id IS NOT NULL',null)
                        ->order_by('commentaires.id', 'asc')
                        ->get()
                        ->result();
	}

    public function liste_comments_album() {
        return $this->db->select('*,commentaires.id AS comm_id')
                        ->from($this->table_album)
                        ->join('commentaires', 'commentaires.album_media_file_name = album_media.file_name')
                        ->join('utilisateur', 'utilisateur.id = commentaires.Utilisateur_id')
                        ->group_by('commentaires.id')
                        ->order_by('commentaires.id', 'asc')
                        ->get()
                        ->result();
    }

    public function liste_comments_video() {
        return $this->db->select('*,commentaires.id AS comm_id')
                        ->from($this->table_video)
                        ->join('commentaires', 'commentaires.video_id = videos.id')
                        ->join('utilisateur', 'utilisateur.id = commentaires.Utilisateur_id')
                        ->group_by('commentaires.id')
                        ->order_by('commentaires.id', 'asc')
                        ->get()
                        ->result();
    }

    public function all_photos_album() {
    //*.id,Utilisateur_id,file_name,photos.nom AS photo_titre,date,like_total
    $sql_all = '(SELECT "null" AS video_id,id AS photo_id,Utilisateur_id,"null" AS video_path,file_name,nom,date,like_total FROM photos) 
    				UNION 
    			(SELECT id,"null",Utilisateur_id,nom,"null",description,date,like_total FROM videos)';
        return $this->db->query($sql_all)
                        ->result();
    }

    public function all_photos() {
        return $this->db->select('*')
                        ->from($this->table_album)
                        ->get()
                        ->result();
    }
    
    public function get_photos_by_album($user_id, $name_album) {
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
        return $this->db->query($requete_album, array($user_id, $name_album, $user_id, $name_album))
                        ->result();
    }
	
	public function get_photos_by_album_wall($user_id)
	{
		$query = 'SELECT photo AS file_name,markup_message AS nom,created AS date,id,null as like_total, 1 AS type
					FROM wall
						WHERE Utilisateur_id = wallto_utilisateur_id 
						AND Utilisateur_id = '.$user_id.' 
							AND photo IS NOT NULL 
							AND photo != ""';
			
						
		return $this->db->query($query)
						->result();
	}
    
    public function get_comment_by_photos($user_id, $photos_id, $para_info) {
        $sql = $para_info . ',Utilisateur_id';
        return $this->db->select($sql)
                        ->from('commentaires')
                        ->where(array('Photos_id' => $photos_id))
                        ->get()
                        ->result();
    }
    
    public function get_comment_wall($user_id)
    {
        return $this->db->select('commentaires.id AS comm_id,comment,utilisateur.thumb,utilisateur.login')
                        ->from('wall')
                        ->join('commentaires','commentaires.wall_id = wall.id')
                        ->join('utilisateur', 'utilisateur.id = commentaires.Utilisateur_id')
                        ->where(array('wall.Utilisateur_id' => $user_id))
                        ->order_by('commentaires.created','ASC')
                        ->get()
                        ->result();
    }
    
    public function get_info_album($nom_album) {
        return $this->db->select('file_name,nom')
                        ->from($this->table_album)
                        ->where('nom', $nom_album)
                        ->get()
                        ->result();
    }

    public function get_abum_for_photo($id_photo) {
        return $this->db->select('file_name,nom')
                        ->from($this->table_album)
                        ->where('Photos_id', $id_photo)
                        ->get()
                        ->result();
    }

        public function get_abum_add($fn_alb) {
        return $this->db->select('file_name,nom')
                        ->from($this->table_album)
                        ->where('file_name', $fn_alb)
                        ->get()
                        ->result();
    }

      public function get_abum($id_photo) {
        return $this->db->select('file_name,nom')
                        ->from($this->table_album)
                        ->where('file_name', $id_photo)
                        ->get()
                        ->result();
    }

    

    public function get_photo_by_id($id_photo) {
        return $this->db->select('nom,file_name')
                        ->from($this->table_photos)
                        ->where('id', $id_photo)
                        ->get()
                        ->result();
    }
    public function get_video_by_id($id_photo) {
        return $this->db->select('nom AS file_name,description AS nom')
                        ->from($this->table_video)
                        ->where('id', $id_photo)
                        ->get()
                        ->result();
    }

    public function insert_photos($filename, $user_name, $album_file_name, $album_name, $photo_name) {
        $this->db->set(array('Utilisateur_id' => $user_name, 'file_name' => $filename, 'nom' => $photo_name))
                ->insert($this->table_photos);
        $last_id_photos = $this->db->insert_id();
        $photo_last_id = $this->db->insert_id();

        $this->db->set(array('Photos_id' => $last_id_photos, 'like_value' => "0"))
                ->insert('ilike');

        if ($album_name != null || $album_name != '') {
            $this->db->set(array('Utilisateur_id' => $user_name, 'file_name' => $album_file_name, 'nom' => $album_name, 'Photos_id' => $last_id_photos))
                    ->insert($this->table_album);
        /*
            $data_add_cmty_photo = array('Utilisateur_id' => $user_name, 'photos_id' => $photo_last_id, 'albums_media_file_name' => $album_file_name, 'type' => "MU");
            $this->db->insert('wall_melo_component', $data_add_cmty_photo);
        */
        } else {

            $data_add_cmty_photo = array('Utilisateur_id' => $user_name, 'photos_id' => $photo_last_id, 'type' => "MU");
          //  $this->db->insert('wall_melo_component', $data_add_cmty_photo);
        }
    }

    public function update_photo($user_id, $id_photos, $nom_photo, $album_name, $file_name_a, $file_name_photo) {
        $data_photos = array('nom' => $nom_photo, 'file_name' => $file_name_photo);

        $this->db->where('id', $id_photos)
                ->update($this->table_photos, $data_photos);

        if ($album_name != null || $album_name != '') {
            $this->db->where('Photos_id', $id_photos);
            $this->db->delete($this->table_album);

            $this->db->set(array('Utilisateur_id' => $user_id, 'file_name' => $file_name_a, 'nom' => $album_name, 'Photos_id' => $id_photos))
                    ->insert($this->table_album);
        }
    }

    public function update_album($user_id, $file_name_album, $nom_album,$new_path_album) {
        $data_album = array('nom' => $nom_album,'file_name'=>$new_path_album);
        $where_para = array('file_name' => $file_name_album, 'Utilisateur_id' => $user_id);

        $this->db->where($where_para)
                ->update($this->table_album, $data_album);
    }

    public function update_video($user_id, $id_video, $nom_video, $album_name, $file_name_a) {
        $data_videos = array('description' => $nom_video);

        $where_para = array('id' => $id_video, 'Utilisateur_id' => $user_id);

        $this->db->where($where_para)
                ->update($this->table_video, $data_videos);

        if ($album_name != null || $album_name != '') {
            $this->db->where('Videos_id', $id_video);
            $this->db->delete($this->table_album);

            $this->db->set(array('Utilisateur_id' => $user_id, 'file_name' => $file_name_a, 'nom' => $album_name, 'Videos_id' => $id_video))
                    ->insert($this->table_album);
        }
    }

    public function insert_comments() {
        if (!empty($_POST['usercomment']) && !empty($_POST['messageid'])) {
            $wallid = $this->input->post('messageid');
            $comment = $this->input->post('usercomment');
            $created = Date('Y-m-d H:i:s');

            $commentArray = array(
                'photos_id' => $wallid,
                'comment' => $comment,
                'created' => $created,
                'Utilisateur_id' => $this->session->userdata('uid')
            );

            $this->db->insert('commentaires', $commentArray);
            return $this->returnMarkup($comment, $created);
        } else {
            echo 'Oops, une erreur ! Vérifie que tu as bien remplie ton commentaire !';
        }
    }

    private function returnMarkup($comment, $created) {
        return '<div class="comm">
						
    					<img src="' . base_url('/files/profiles/' . $this->session->userdata('thumb')) . '" />
      					<p class="name_comm">' . $this->session->userdata('login') . '</p>
      					<p class="commentaire">' . $comment . '</p> 
    				</div>';
    }

    public function insert_comments_album() {
        if (!empty($_POST['usercomment']) && !empty($_POST['messageid'])) {
            $wallid = $this->input->post('messageid');
            $comment = $this->input->post('usercomment');
            $created = Date('Y-m-d H:i:s');

            $commentArray = array(
                'album_media_file_name' => $wallid,
                'comment' => $comment,
                'created' => $created,
                'Utilisateur_id' => $this->session->userdata('uid')
            );

            $this->db->insert('commentaires', $commentArray);
            return $this->returnMarkup($comment, $created);
        } else {
            echo 'Oops, une erreur ! Vérifie que tu as bien remplie ton commentaire !';
        }
    }

    public function insert_comments_video() {
        if (!empty($_POST['usercomment']) && !empty($_POST['messageid'])) {
            $wallid = $this->input->post('messageid');
            $comment = $this->input->post('usercomment');
            $created = Date('Y-m-d H:i:s');

            $commentArray = array(
                'video_id' => $wallid,
                'comment' => $comment,
                'created' => $created,
                'Utilisateur_id' => $this->session->userdata('uid')
            );

            $this->db->insert('commentaires', $commentArray);
            return $this->returnMarkup($comment, $created);
        } else {
            echo 'Oops, une erreur ! Vérifie que tu as bien remplie ton commentaire !';
        }
    }
    
    public function insert_comments_wall_photo()
    {
     if (!empty($_POST['usercomment']) && !empty($_POST['messageid'])) {
            $wallid = $this->input->post('messageid');
            $comment = $this->input->post('usercomment');
            $created = Date('Y-m-d H:i:s');

            $commentArray = array(
                'Wall_id' => $wallid,
                'comment' => $comment,
                'created' => $created,
                'Utilisateur_id' => $this->session->userdata('uid')
            );

            $this->db->insert('commentaires', $commentArray);
            return $this->returnMarkup($comment, $created);
        } else {
            echo 'Oops, une erreur ! Vérifie que tu as bien remplie ton commentaire !';
        }
    }

    public function insert_like($id_photo, $id_user) {
        //$data_album =  array('like_total'=> like_total+1);
//+1
        $requete_photo = 'UPDATE photos SET like_total = like_total +1 WHERE id= ?';
        $this->db->query($requete_photo, array($id_photo));

        $requet_like = 'UPDATE ilike SET like_value = like_value +1 WHERE Photos_id= ?';
        $this->db->query($requet_like, array($id_photo));

        $this->db->set(array('Photo_id' => $id_photo, 'Utilisateur_id' => $id_user))
                ->insert('like_activity_pav');

       /* $data_delete_act = array('Utilisateur_id' => $id_user, 'photos_id' => $id_photo, 'type' => "ME");
        $this->db->insert('wall_melo_component', $data_delete_act);*/
    }

    public function insert_like_a($file_name_album, $id_user) {
        //$data_album =  array('like_total'=> like_total+1);
//+1
        $requete_photo = 'UPDATE album_media SET like_total = like_total +1 WHERE file_name= ?';
        $this->db->query($requete_photo, array($file_name_album));

        $requet_like = 'UPDATE ilike SET like_value = like_value +1 WHERE Album_media_file_name= ?';
        $this->db->query($requet_like, array($file_name_album));

        $this->db->set(array('Album_media_file_name' => $file_name_album, 'Utilisateur_id' => $id_user))
                ->insert('like_activity_pav');
    }

    public function insert_like_v($video_id, $id_user) {
        //$data_album =  array('like_total'=> like_total+1);
//+1
        $requete_photo = 'UPDATE videos SET like_total = like_total +1 WHERE id= ?';
        $this->db->query($requete_photo, array($video_id));

        $requet_like = 'UPDATE ilike SET like_value = like_value +1 WHERE Videos_id= ?';
        $this->db->query($requet_like, array($video_id));

        $this->db->set(array('Video_id' => $video_id, 'Utilisateur_id' => $id_user))
                ->insert('like_activity_pav');

        /*$data_delete_act = array('Utilisateur_id' => $id_user, 'videos_id' => $video_id, 'type' => "ME");
        $this->db->insert('wall_melo_component', $data_delete_act);*/
    }

    public function delete_like($id_photo, $id_user) {
        //$data_album =  array('like_total'=> like_total+1);
//+1
        $requete_photo = 'UPDATE photos SET like_total = like_total -1 WHERE id= ?';
        $this->db->query($requete_photo, array($id_photo));

        $requet_like = 'UPDATE ilike SET like_value = like_value -1 WHERE Photos_id= ?';
        $this->db->query($requet_like, array($id_photo));

        $this->db->where(array('Photo_id' => $id_photo, 'Utilisateur_id' => $id_user))
                ->delete('like_activity_pav');

        $data_delete_act = array('Utilisateur_id' => $id_user, 'photos_id' => $id_photo, 'type' => "ME");
        $this->db->delete('wall_melo_component', $data_delete_act);
    }

    public function delete_like_a($file_name_album, $id_user) {
        //$data_album =  array('like_total'=> like_total+1);
//+1
        $requete_photo = 'UPDATE album_media SET like_total = like_total -1 WHERE file_name= ?';
        $this->db->query($requete_photo, array($file_name_album));

        $requet_like = 'UPDATE ilike SET like_value = like_value -1 WHERE Album_media_file_name= ?';
        $this->db->query($requet_like, array($file_name_album));

        $this->db->where(array('Album_media_file_name' => $file_name_album, 'Utilisateur_id' => $id_user))
                ->delete('like_activity_pav');
    }

    public function delete_like_v($video_id, $id_user) {
        //$data_album =  array('like_total'=> like_total+1);
//+1
        $requete_photo = 'UPDATE videos SET like_total = like_total -1 WHERE id= ?';
        $this->db->query($requete_photo, array($video_id));

        $requet_like = 'UPDATE ilike SET like_value = like_value -1 WHERE Videos_id= ?';
        $this->db->query($requet_like, array($video_id));

        $this->db->where(array('Video_id' => $video_id, 'Utilisateur_id' => $id_user,))
                ->delete('like_activity_pav');

        $data_delete_act = array('Utilisateur_id' => $id_user, 'videos_id' => $video_id, 'type' => "ME");
        $this->db->delete('wall_melo_component', $data_delete_act);
    }

    public function get_like_user($user_id) {
        return $this->db->select('Photo_id , Album_media_file_name, Video_id')
                        ->from('like_activity_pav')
                        ->where(array('Utilisateur_id' => $user_id))
                        ->get()
                        ->result();
    }

    public function add_video($id_video, $user_id, $description, $album_nom,$album_file_name) {
        $this->db->set(array('nom' => $id_video, 'Utilisateur_id' => $user_id, 'description' => $description))
                ->insert('videos');
        $last_id_video = $this->db->insert_id();

        $id_video = $this->db->insert_id();


        if ($album_nom != null || $album_nom != '') {
            $this->db->set(array('Utilisateur_id' => $user_id,'file_name' => $album_file_name,  'nom' => $album_nom, 'Videos_id' => $id_video))
                    ->insert($this->table_album);

            $data_add_cmty_photo = array('Utilisateur_id' => $user_id,'videos_id' => $id_video, 'albums_media_file_name' => $album_nom, 'type' => "MU");
          //  $this->db->insert('wall_melo_component', $data_add_cmty_photo);
        } else {

            $data_add_cmty_photo = array('Utilisateur_id' => $user_id, 'videos_id' => $id_video, 'type' => "MU");
           // $this->db->insert('wall_melo_component', $data_add_cmty_photo);
        }
        


        $data_delete_act = array('Utilisateur_id' => $user_id, 'videos_id' => $last_id_video, 'type' => "MU");

        //$this->db->insert('wall_melo_component', $data_delete_act);
    }

    public function delete_photo($id_photo) {

        $this->db->where(array('id' => $id_photo))
                ->delete('photos');
    }

    public function delete_video($id_video) {

        $this->db->where(array('id' => $id_video))
                ->delete('videos');
    }

    public function delete_album($file_name_album) {
        $this->db->query('DELETE photos FROM photos JOIN album_media ON album_media.photos_id = photos.id WHERE album_media.file_name = "' . $file_name_album . '"');
        $this->db->where(array('file_name' => $file_name_album))
                ->delete('album_media');
    }

    public function get_zoom_photos($id_photo) {
        return $this->db->query('SELECT photos.Utilisateur_id,photos.like_total,photos.file_name,photos.nom,photos.id,album_media.file_name AS alb_fn FROM photos LEFT OUTER JOIN album_media ON album_media.photos_id = photos.id WHERE photos.id=' . $id_photo )
                        ->result();
    }

    public function get_zoom_photos_comment($id_photo) {
        return $this->db->query('SELECT comment,utilisateur.login,Utilisateur_id,utilisateur.thumb FROM commentaires JOIN utilisateur ON utilisateur.id = commentaires.Utilisateur_id WHERE photos_id=' . $id_photo)
                        ->result();
    }

    public function delete_comment($id_com) {
        $this->db->where(array('id' => $id_com))
                ->delete('commentaires');
    }
    

	 public function get_album_wall_all($user_id)
    {
    
    	$query = 'SELECT * 
					FROM wall
						WHERE Utilisateur_id = wallto_utilisateur_id
							AND Utilisateur_id = '.$user_id.'
								AND photo IS NOT NULL 
									AND photo !=  ""';
    /*	return $this->db->select('photo,id')
    			->from('wall')
    			->where(array('Utilisateur_id' => 'wallto_utilisateur_id','wallto_utilisateur_id'=>$user_id, 'photo IS NOT NULL'=> NULL))
    			->get()
    			->result();
    		*/	

    			
    			return $this->db->query($query)
    			->result();
    }

}