<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Melo_actus_model extends CI_Model {

    protected $table_album = 'album_media';
    protected $table_photos = 'photos';
    protected $table_video = 'videos';
    protected $table_communaute = 'communaute';
    protected $table_message = 'wall';

    public function get_following($user_id) {

        return $this->db->select('Utilisateur_id')
                        ->from($this->table_communaute)
                        ->where(array('Follower_id' => $user_id))
                        ->get()
                        ->result();
    }

    public function get_info_user($user_id) {
        return $this->db->select('*')
                        ->from('utilisateur')
                        ->where(array('id' => $user_id))
                        ->get()
                        ->result();
    }

    public function get_entities_id($list_id, $user_id) {
        if ($list_id != null) {
            $sql_mu = '(SELECT wall_melo_component.id,wall_melo_component.type,wall_melo_component.date,photos_id as idproduit,photos.nom AS main_nom,photos.file_name,photos.Utilisateur_id,utilisateur.thumb,utilisateur.login, "null" AS ville,"null" AS salle,"null" AS walltouser,"null" AS date_concert, 1 as product
				FROM wall_melo_component
				JOIN photos
						ON photos.id = wall_melo_component.Photos_id
				JOIN utilisateur
						ON utilisateur.id = photos.Utilisateur_id
					WHERE wall_melo_component.Utilisateur_id 	
						IN (' . $list_id . ') 
					AND wall_melo_component.type = "MU"
					AND wall_melo_component.albums_media_file_name IS NULL)		
					UNION
			(SELECT MAX(wall_melo_component.id),wall_melo_component.type,wall_melo_component.date,wall_melo_component.albums_media_file_name,album_media.nom AS main_nom,photos.file_name,photos.Utilisateur_id,utilisateur.thumb,utilisateur.login, "null" AS ville,"null" AS salle,"null" AS walltouser,"null", 5 as product
				FROM wall_melo_component
				JOIN photos
						ON photos.id = wall_melo_component.Photos_id
				JOIN utilisateur
						ON utilisateur.id = photos.Utilisateur_id
				JOIN album_media
						ON album_media.file_name = wall_melo_component.albums_media_file_name
					WHERE wall_melo_component.Utilisateur_id 	
						IN (' . $list_id . ') 
					AND wall_melo_component.type = "MU"
					AND wall_melo_component.albums_media_file_name IS NOT NULL
					GROUP BY wall_melo_component.albums_media_file_name)		
			UNION
			(SELECT wall_melo_component.id,wall_melo_component.type,wall_melo_component.date,wall_melo_component.albums_media_file_name,album_media.nom AS main_nom,album_media.file_name,album_media.Utilisateur_id,utilisateur.thumb,utilisateur.login, "null" AS ville,"null" AS salle,"null" AS walltouser,"null", 5 as product
				FROM wall_melo_component
				JOIN album_media
						ON album_media.file_name = wall_melo_component.albums_media_file_name
				JOIN utilisateur
						ON utilisateur.id = album_media.Utilisateur_id		
					WHERE wall_melo_component.Utilisateur_id = ' . $user_id . ' 
					AND wall_melo_component.type = "ME"
					AND wall_melo_component.albums_media_file_name IS NOT NULL
					)
			UNION
			(SELECT wall_melo_component.id,wall_melo_component.type,wall_melo_component.date,videos_id,videos.description,videos.nom,videos.Utilisateur_id,utilisateur.thumb,utilisateur.login,"null","null" ,"null","null", 2 as product
				FROM wall_melo_component
				JOIN videos
						ON videos.id = wall_melo_component.Videos_id
				JOIN utilisateur
						ON utilisateur.id = videos.Utilisateur_id
					WHERE wall_melo_component.Utilisateur_id 	
						IN (' . $list_id . ') 
					AND wall_melo_component.type = "MU")
			UNION
			(SELECT wall_melo_component.id,wall_melo_component.type,wall_melo_component.date,concerts_id,concerts.titre,concerts.seconde_partie,utilisateur.id,Utilisateur.thumb,utilisateur.login,adresse.ville,concerts.salle,"null",concerts.date, 3 as product
				FROM wall_melo_component
				JOIN concerts
						ON concerts.id = wall_melo_component.concerts_id
				JOIN adresse
						ON adresse.id = concerts.Adresse_id
				JOIN Utilisateur
						ON Utilisateur.id = concerts.Utilisateur_id
					WHERE wall_melo_component.Utilisateur_id 	
						IN (' . $list_id . ') 
					AND wall_melo_component.type = "MU")
			UNION
			(SELECT wall_melo_component.id,wall_melo_component.type,wall_melo_component.date,message_id,wall.markup_message,"null",utilisateur.id,utilisateur.thumb,utilisateur.login,"null","null",wall.wallto_utilisateur_id,"null",  4 as product
				FROM wall_melo_component
				JOIN wall
						ON wall.id = wall_melo_component.message_id
				JOIN Utilisateur
						ON Utilisateur.id = wall.wallto_utilisateur_id
					WHERE wall_melo_component.Utilisateur_id 	
						IN (' . $list_id . ') 
					AND wall_melo_component.type = "MU")
			UNION
			
			(SELECT wall_melo_component.id,wall_melo_component.type,wall_melo_component.date,message_id,wall.markup_message,"null",utilisateur.id,utilisateur.thumb,utilisateur.login,"null","null",wall.wallto_utilisateur_id,"null",  4 as product
				FROM wall_melo_component
				JOIN wall
						ON wall.id = wall_melo_component.message_id
				JOIN Utilisateur
						ON Utilisateur.id = wall.wallto_utilisateur_id
					WHERE wall_melo_component.Utilisateur_id 	
						IN (' . $user_id . ') 
					AND wall_melo_component.type = "ME")
			
			UNION 
			(SELECT wall_melo_component.id,wall_melo_component.type,wall_melo_component.date,photos_id,photos.nom,photos.file_name,photos.Utilisateur_id,utilisateur.thumb,utilisateur.login,"null","null","null","null", 1 as product
				FROM wall_melo_component
				JOIN photos
						ON photos.id = wall_melo_component.Photos_id
				JOIN utilisateur
						ON utilisateur.id = wall_melo_component.Utilisateur_id
					WHERE wall_melo_component.Utilisateur_id = ' . $user_id . '
					AND wall_melo_component.type = "ME"
					AND wall_melo_component.albums_media_file_name IS NULL)			

			UNION

			(SELECT wall_melo_component.id,wall_melo_component.type,wall_melo_component.date,videos_id,videos.description,videos.nom,videos.Utilisateur_id,utilisateur.thumb,utilisateur.login,"null","null","null","null",  2 as product
				FROM wall_melo_component
				JOIN videos
						ON videos.id = wall_melo_component.Videos_id
				JOIN utilisateur
						ON utilisateur.id = videos.Utilisateur_id
					WHERE wall_melo_component.Utilisateur_id= ' . $user_id . '
					AND wall_melo_component.type = "ME")
					
			UNION

			(SELECT wall_melo_component.id,wall_melo_component.type,wall_melo_component.date,concerts_id,concerts.titre,concerts.seconde_partie,concerts.Utilisateur_id,Utilisateur.thumb,Utilisateur.login,adresse.ville,concerts.salle,"null",concerts.date,3 as product
				FROM wall_melo_component
				JOIN concerts
						ON concerts.id = wall_melo_component.concerts_id
				JOIN adresse
						ON adresse.id = concerts.Adresse_id
				JOIN utilisateur
						ON concerts.Utilisateur_id = utilisateur.id
					WHERE wall_melo_component.Utilisateur_id= ' . $user_id . '
					AND wall_melo_component.type = "ME")
			ORDER BY date DESC
				'; /* 	
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
              '; */
            return $this->db->query($sql_mu)
                            ->result();
        }
        /* $this->db->select('*')        				
          ->from ('wall_melo_component')
          ->where_in('Utilisateur_id', $user_id)
          ->where('type','MU')
          ->order_by('date','desc')
          ->get()
          ->result();
         */
    }

    public function difference($list_id, $user_id) {
        $sql_diff = 'SELECT id,type,photos_id,message_id,videos_id,morceaux_id,concerts_id,documents_id,Following_id,albums_media_file_name,albums_id FROM wall_melo_component WHERE Utilisateur_id IN (' . $list_id . ') AND albums_id IS NOT NULL AND type ="MU" OR (Utilisateur_id = ' . $user_id . ' AND type="ME")';
        return $this->db->query($sql_diff)
                        ->result();
    }

    public function get_new_item($id_component, $type, $id_photo, $id_video, $id_message, $id_concert, $id_follower) {
        setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');
        date_default_timezone_set('Europe/Paris');

        if ($id_photo != null) {
            $sql_new_item =
                    '(SELECT wall_melo_component.id,wall_melo_component.type,wall_melo_component.date,photos_id as idproduit,photos.nom AS main_nom,photos.file_name,photos.Utilisateur_id,utilisateur.thumb,utilisateur.login, "null" AS ville,"null" AS salle,"null" AS walltouser, UM.thumb AS user_me, 1 as product
				FROM wall_melo_component
				JOIN photos
						ON photos.id = wall_melo_component.Photos_id
				JOIN utilisateur
						ON utilisateur.id = photos.Utilisateur_id
				JOIN utilisateur as UM
						ON UM.id = wall_melo_component.Utilisateur_id
				WHERE wall_melo_component.id = ' . $id_component . '
				AND wall_melo_component.albums_media_file_name IS NULL)';

            $product = 'une photo';

            $result_req = $this->db->query($sql_new_item)
                    ->result();
            if ($result_req[0]->type == "MU") {
                $right = '<span class="ico_citation"></span>
       					<p class="msg_post">' . $result_req[0]->login . ' viens d’ajouter ' . $product . ' :  <a href="' . base_url('index.php/mc_photos/zoom_photo/' . $result_req[0]->idproduit) . '">' . $result_req[0]->main_nom . '</a></p>
     					<img src="' . base_url('./files/' . $result_req[0]->Utilisateur_id . '/photos/' . $result_req[0]->file_name) . '" alt="Photo message" class="single" />';
            }
            if ($result_req[0]->type == "ME") {
                $right = '<span class="ico_citation"></span>
        				<p class="msg_post">Je viens d\'aimer la photo de ' . $result_req[0]->login . ' :  <a href="' . base_url('index.php/mc_photos/zoom_photo/' . $result_req[0]->idproduit) . '">' . $result_req[0]->main_nom . '</a></p>
      				  	<img src="' . base_url('./files/' . $result_req[0]->Utilisateur_id . '/photos/' . $result_req[0]->file_name) . '" alt="Photo message" class="single" />';
            }
            return array($result_req, $product, $right);
        }


        if ($id_video != null) {
            $sql_new_item =
                    'SELECT wall_melo_component.id,wall_melo_component.type,wall_melo_component.date,videos_id as idproduit,videos.description AS main_nom,videos.nom,videos.Utilisateur_id,utilisateur.thumb,utilisateur.login, "null" AS ville,"null" AS salle,"null" AS walltouser, UM.thumb AS user_me, 2 as product
				FROM wall_melo_component
				JOIN videos
						ON videos.id = wall_melo_component.Videos_id
				JOIN utilisateur
						ON utilisateur.id = videos.Utilisateur_id
				JOIN utilisateur as UM
						ON UM.id = wall_melo_component.Utilisateur_id
				WHERE wall_melo_component.id = ' . $id_component;

            $product = 'une video';

            $result_req = $this->db->query($sql_new_item)
                    ->result();
            if ($result_req[0]->type == "MU") {
                $right = '<span class="ico_citation"></span>
        			  <p class="msg_post"><a href="' . base_url('index.php/actualite/' . $result_req[0]->Utilisateur_id) . '">' . $result_req[0]->login . '</a> viens d’ajouter une video :  <a href="http://www.youtube.com/v/' . $result_req[0]->nom . '?version=3"> ' . $result_req[0]->main_nom . '</a></p>
      				 <iframe id="ytplayer" type="document" width="455" height="350" src="http://www.youtube.com/v/' . $result_req[0]->nom . '?version=3"/>
      				 </iframe>';
            }
            if ($result_req[0]->type == "ME") {
                $right = '<span class="ico_citation"></span>
        				<p class="msg_post">Je viens d\'aimer la video de ' . $result_req[0]->login . ' :  <a href="http://www.youtube.com/v/' . $result_req[0]->nom . '?version=3">' . $result_req[0]->main_nom . '</a></p>
     				<iframe id="ytplayer" type="document" width="455" height="350" src="http://www.youtube.com/v/' . $result_req[0]->nom . '?version=3"/>
      				 </iframe>';
            }
            return array($result_req, $product, $right);
        }


        if ($id_message != null) {
            $sql_new_item =
                    'SELECT wall_melo_component.id,wall_melo_component.type,wall_melo_component.date,message_id as idproduit,wall.markup_message AS main_nom,"null",utilisateur.id AS Utilisateur_id,utilisateur.thumb,utilisateur.login,"null"  AS ville,"null" AS salle,wall.wallto_utilisateur_id AS walltouser, UM.thumb AS user_me, 4 as product
				FROM wall_melo_component
				JOIN wall
						ON wall.id = wall_melo_component.message_id
				JOIN Utilisateur
						ON Utilisateur.id = wall.wallto_utilisateur_id
				JOIN utilisateur as UM
						ON UM.id = wall_melo_component.Utilisateur_id
				WHERE wall_melo_component.id = ' . $id_component;

            $product = 'un message';
            $result_req = $this->db->query($sql_new_item)
                    ->result();
            if ($result_req[0]->type == "MU") {


                $right = '<span class="ico_citation"></span>
        				<p class="msg_post">' . $result_req[0]->main_nom . '</p>';
            }

            if ($result_req[0]->type == "ME") {
                $right = '<span class="ico_citation"></span>
							<p class="msg_post">Je vient de poster un message sur le mur de <a href="' . base_url('index.php/actualite/' . $result_req[0]->walltouser) . '">' . $result_req[0]->login . '</a>: 
			    			</br></br>
   							"' . $result_req[0]->main_nom . ' "</p>';
            }


            return array($result_req, $product, $right);
        }

        if ($id_concert != null && $type == "ME") {
            $sql_new_item = 'SELECT wall_melo_component.id,wall_melo_component.type,wall_melo_component.date,concerts_id,concerts.titre,concerts.seconde_partie,utilisateur.id AS Utilisateur_id,Utilisateur.thumb,utilisateur.login,adresse.ville,concerts.salle,"null",concerts.date AS concert_date, UM.thumb AS user_me, 3 as product
				FROM wall_melo_component
				JOIN concerts
						ON concerts.id = wall_melo_component.concerts_id
				JOIN adresse
						ON adresse.id = concerts.Adresse_id
				JOIN Utilisateur
						ON Utilisateur.id = concerts.Utilisateur_id
				JOIN utilisateur as UM
						ON UM.id = wall_melo_component.Utilisateur_id
				WHERE wall_melo_component.id =' . $id_component;
            $result_req = $this->db->query($sql_new_item)
                    ->result();
            $product = '';

            $date_jour = $date_format = (date_create($result_req[0]->concert_date, timezone_open('Europe/Paris')));
            $a = date_timestamp_get($date_format);
            $date_j = '<a>' . strtoupper(strftime('%b', $a)) . '</a>';
            $date_mois = $date_format = (date_create($result_req[0]->concert_date, timezone_open('Europe/Paris')));
            $a = date_timestamp_get($date_format);
            $date_m = '<a>' . strtoupper(strftime('%d', $a)) . '</a>';
            $date_complete = $date_format = (date_create($result_req[0]->concert_date, timezone_open('Europe/Paris')));
            $a = date_timestamp_get($date_format);
            $date_c = '<a>' . strftime('Le %d %B %G', $a) . '</a>';

            $right = '	
	   					<span class="ico_citation"></span>
        				<p class="msg_post">Je participe au concert de  <a href="' . base_url('/index.php/actualite/' . $result_req[0]->Utilisateur_id) . '">' . $result_req[0]->login . '</a>

   						</br></br>
   						<div id="concert_detail_calendar">
   							<div class="calendar">
   							   ' . $date_j . $date_m . '
            					
   							</div>
   							<div class="calendar-content">
   								' . $result_req[0]->login . '
   								</br>
   								<a href="' . base_url("index.php/concert/" . $result_req[0]->Utilisateur_id . '/#' . $result_req[0]->concerts_id) . '">
   									' . $result_req[0]->salle . ' - ' . $result_req[0]->ville . '
   								</a>
   								</br>
   								' . $date_c . '   					
    						</div>
    					</div>
    					</p>';
            return array($result_req, $product, $right);
        }

        if ($id_concert != null && $type == "MU") {
            $sql_new_item = 'SELECT wall_melo_component.id,wall_melo_component.type,wall_melo_component.date,concerts_id,concerts.titre,concerts.seconde_partie,utilisateur.id AS Utilisateur_id,Utilisateur.thumb,utilisateur.login,adresse.ville,concerts.salle,"null", 3 as product
				FROM wall_melo_component
				JOIN concerts
						ON concerts.id = wall_melo_component.concerts_id
				JOIN adresse
						ON adresse.id = concerts.Adresse_id
				JOIN Utilisateur
						ON Utilisateur.id = concerts.Utilisateur_id
					WHERE wall_melo_component.id = ' . $id_component;

            $result_req = $this->db->query($sql_new_item)
                    ->result();

            $product = '';

            $right = '	
	   					<span class="ico_citation"></span>
        				<p class="msg_post"><a href="' . base_url('/index.php/actualite/' . $result_req[0]->Utilisateur_id) . '">' . $result_req[0]->login . '</a> vient d\'ajouter un concert  :  
   						</br></br>
   						<a href="' . base_url("index.php/mc_concerts/" . $result_req[0]->Utilisateur_id . '/#' . $result_req[0]->concerts_id) . '">' . $result_req[0]->salle . ' - ' . $result_req[0]->ville . '</a></p>
    			';
            return array($result_req, $product, $right);
        }

        //	if($id_folower !=null&&$type="MU")

        /*


          ()
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
          '


         */


        //	$result_req = $this->db->query($sql_new_item)
        //				->result();	
        //	return array($result_req,$product,$right);
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

    public function delete_activity_wall($id) {
        $this->db->delete('wall_melo_component', array('id' => $id));
    }

    public function get_photos_album($album, $date) {
        $requete = "SELECT wall_melo_component.id,wall_melo_component.albums_media_file_name,photos.file_name,photos.nom
FROM wall_melo_component
JOIN photos
ON photos.id = wall_melo_component.photos_id
WHERE wall_melo_component.date
BETWEEN  '" . $date . "'
AND  '" . $date . "' + INTERVAL 1 HOUR 
AND wall_melo_component.albums_media_file_name =  '" . $album . "'
AND wall_melo_component.type='MU'
";
        //select le count de photos dans la derniere heure pour chaque labum et retourne les infos des 4 dernieres
        return $result_alubm = $this->db->query($requete)
                ->result();
    }

}

