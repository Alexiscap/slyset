<<<<<<< HEAD
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<style>

</style>
=======
>>>>>>> 0a5f106366459ee42989c8cd393a8c35e10afe2d
<div id="contentAll">

  <div id="breadcrumbs">
    <ul>
      <li><a href="#">Accueil</a></li>
      <li><a href="#">Artistes</a></li>
      <li><a href="#">Bob Dylan</a></li>
      <li><a href="#">Photos & Vidéos</a></li>
    </ul>
  </div>

  <div id="cover">
    <div id="infos-cover">
      <h2>Bob Dylan</h2>
      <a href="#"><span class="button_left"></span><span class="button_center">Suivre</span><span class="button_right"></span></a>
    </div>
  </div>

  <div id="stats-cover">
    <div class="stats_cover_block">
      <span class="stats_number">489</span>
      <span class="stats_title">abonnés</span>
    </div>

    <div class="stats_cover_block">
      <span class="stats_number">18</span>
      <span class="stats_title">albums</span>
    </div>

    <div class="stats_cover_block">
      <span class="stats_number">278</span>
      <span class="stats_title">morceaux</span>
    </div>
  </div>
<<<<<<< HEAD
  <div class="bt_noir">
    <a class="iframe" href="<?php echo base_url('index.php/mc_photos/upload_photo/'.$user_id) ?>" ><span class="bt_left"></span><span class="bt_middle">Ajouter une photo/vidéo</span><span class="bt_right"></span></a>
  </div>
  <div class="bt_noir">
    <a class="iframe" href="<?php echo base_url('index.php/mc_photos/add_video/'.$user_id) ?>"><span class="bt_left"></span><span class="bt_middle">Supprimer la sélection</span><span class="bt_right"></span></a>
  </div>

  <div class="content">
  	<!-- pour video : 
  	 nom =  id youtube
  	 description : nom ajouté par user-->
  	<?php
	foreach ($all_media_user_result as $media_user_result_unit):
		
		/*  ------------- Bloc image orpheline -------------- */
		
		if($media_user_result_unit->type == 1)
		{
			?>		
    		<div onclick="displayHover" class="photo box col1">
    		<!--  edition : HOVER *******************-->
  				 	<div style="display:none" class="edit">
      					<a href="<?php echo base_url('/index.php/mc_photos/update_photo/'.$user_id.'/'.$media_user_result_unit->id.'/'.$media_user_result_unit->type) ?>"><img src="<?php echo img_url('musicien/edite.png'); ?>"/></a>
     					 <!--  edition : SUPPRESSION *******************-->

     					<a href="<?php echo base_url('/index.php/mc_photos/suppression_media/'.$user_id.'/'.$media_user_result_unit->id.'/'.$media_user_result_unit->type) ?>"><img src="<?php echo img_url('musicien/suppr.png'); ?>"/></a>
   					</div>
    		<!-- image -->
      		<a href="<?php echo base_url('/index.php/mc_photos/zoom_photo/'.$media_user_result_unit->id)?>"><img src="http://127.0.0.1/slyset/files/30/photos/<?php echo  $media_user_result_unit->file_name?>" class="img_cover" /></a>
          	<!-- titre -->

      		<p class="nom_photo"><?php echo $media_user_result_unit->nom ?></p>
      		<!-- commentaire -->
      		
      		 <?php 
			$cpt_comment = 0;
            foreach($commentaires as $commentaire){
                 if($media_user_result_unit->id == $commentaire->photos_id){
                    	 $cpt_comment++;
                 }
            }
            ?>
      		
      		<div class="bord_photo">
       			 <a onclick='showComment("comm<?php echo $media_user_result_unit->id?>")' href="javascript:void(0);"><p><?php if ($cpt_comment==0)print "0 commentaire"; if($cpt_comment==1)print "1 commentaire"; if ($cpt_comment>1)print $cpt_comment."commentaires"  ?></p></a>
       			<?php $count = substr_count($all_photo_like,$media_user_result_unit->id.'/');
    	if ($count>=1)
    	{ ?>
    	       			 <img src="<?php echo img_url('musicien/icon_coeur.png'); ?>" id="<?php echo $media_user_result_unit->id ?>" class="nolike" />

       			<?php }
       			else
       			{ ?>
       			 <img src="<?php echo img_url('musicien/icon_coeur.png'); ?>" id="<?php echo $media_user_result_unit->id ?>" class="like" />

      		<?php } ?>
      		<p class="nb_like" ><?php echo $media_user_result_unit->like_total ?></p>
      		</div> 
     
        	
    	<div class="allcomment" id="comm<?php echo $media_user_result_unit->id ?>">

    		<?php foreach($commentaires as $commentaire): ?>
        		<?php if($media_user_result_unit->id == $commentaire->photos_id): ?>      
                	<div class="comm">
						<img src="<?php echo img_url('common/del.png'); ?>" class="del"/>
    					<img src="<?php echo img_url('common/avatar_comm.png'); ?>" />
      					<p class="name_comm"> Jim Morrison</p>
      					<p class="commentaire"><?php echo $commentaire->comment?></p> 
    				</div>

       			<?php endif; ?>
            <?php endforeach; ?>
                  <div class="comment-form">
      <img src="<?php echo img_url('common/avatar_comm.png'); ?>" />
      <form  action="" method="post">
           <input type="text" name="usercomment" id="usercomment"/>
        <input type="hidden" name="baseurl" value="<?php echo base_url(); ?>" id="baseurl" />
        	<input type="hidden" name="messageid" value="<?php print $media_user_result_unit->id; ?>" id="messageid" />

        <input src= "<?php echo img_url('common/valider_comm.png'); ?>" type="submit" value="Valider"/>
      </form>
      
       		                       <div class="ajax_loader"></div>

    </div>
</div>
		   </div> 
       
           <?php
		}


		else if($media_user_result_unit->type == 2)
 
		{

		    ?>
    			<div class="photo box col1">
    			
  				 	<!--  edition : HOVER *******************-->
  				 	<div class="edit">
      					<a href="<?php echo base_url('/index.php/mc_photos/update_photo/'.$user_id.'/'.$media_user_result_unit->file_name.'/'.$media_user_result_unit->type) ?>"><img src="<?php echo img_url('musicien/edite.png'); ?>"/></a>
     					<a href="<?php echo base_url('/index.php/mc_photos/suppression_media/'.$user_id.'/'.$media_user_result_unit->file_name.'/'.$media_user_result_unit->type) ?>"><img src="<?php echo img_url('musicien/suppr.png'); ?>"/></a>
   					</div>
					<div class="open_alb">
      					<a href="<?php echo base_url('index.php/mc_photos/album/'.$user_id.'/'.$media_user_result_unit->file_name)?>"><img src="<?php echo img_url('musicien/open_plus.png'); ?>"/></a>
    				</div>
    				
   					<a href="http://127.0.0.1/slyset/index.php/mc_photos/album/<?php echo $user_id ?>/<?php echo $media_user_result_unit->file_name ?>"><img src="http://127.0.0.1/slyset/files/30/photos/<?php echo $media_user_result_unit->file_name?>/cover" class="img_cover" /></a>
   					<?php foreach($all_photos as $al_photo): 
                    	if($media_user_result_unit->file_name == $al_photo->file_name): 
                     		foreach ($all_photos_albums as $all_photos_album):
                     			if (($al_photo->Photos_id == $all_photos_album->id)&&(substr_count($all_photos_album->file_name,"cover")<1)):?>
 									<a href="#"><img src="http://127.0.0.1/slyset/files/30/photos/<?php echo $media_user_result_unit->file_name?>/<?php echo $all_photos_album->file_name ?>" class="img_miniat" /></a>
      							<?php                  
      							endif;
                     		endforeach;
                          
    					;endif; 
    				endforeach; ?>
     				<p class="nom_photo"><?php echo $media_user_result_unit->nom ?></p>
     				
     					 <?php 
							$cpt_comment = 0;
          						 foreach($commentaires_albums as $commentaire){
           					      if($media_user_result_unit->file_name == $commentaire->file_name){
                   			 	 $cpt_comment++;
                					 }
           						 }     						
           						 ?>
     				
      				<div class="bord_photo">
        				 <a onclick='showComment("comm<?php echo $media_user_result_unit->file_name?>")' href="javascript:void(0);"><p><?php if($cpt_comment==0)print "0 commentaire"; if($cpt_comment==1)print "1 commentaire"; if($cpt_comment>1)print $cpt_comment."commentaires"; ?></p></a>
        				
        	
      			<?php $count = substr_count($all_album_like,$media_user_result_unit->file_name.'/');
    	if ($count>=1)
    	{ ?>
      		
      		    	      <img src="<?php echo img_url('musicien/icon_coeur.png'); ?>" id="<?php echo $media_user_result_unit->file_name ?>" class="nolike-album" />
<?php }
       			else
       			{ ?>
        				 <img src="<?php echo img_url('musicien/icon_coeur.png'); ?>" class="like-album" id="<?php echo $media_user_result_unit->file_name ?>" />
        				<?php } ?>
        				 <p class="nb_like"><?php echo $media_user_result_unit->like_total ?></p>
      				
      				
      				</div>
      
      		    	<div class="allcomment" id="comm<?php echo $media_user_result_unit->file_name ?>">

    		<?php foreach($commentaires_albums as $commentaire): 
					if($media_user_result_unit->file_name == $commentaire->file_name): ?>  
                	<div class="comm">
						<img src="<?php echo img_url('common/del.png'); ?>" class="del"/>
    					<img src="<?php echo img_url('common/avatar_comm.png'); ?>" />
      					<p class="name_comm"> Jim Morrison</p>
      					<p class="commentaire"><?php echo $commentaire->comment?></p> 
    				</div>
    				

       			<?php endif; ?>
       			
            <?php endforeach; ?>
                  <div class="comment-form-album">
      <img src="<?php echo img_url('common/avatar_comm.png'); ?>" />
      <form  action="" method="post">
           <input type="text" name="usercomment" id="usercomment"/>
        <input type="hidden" name="baseurl" value="<?php echo base_url(); ?>" id="baseurl" />
        	<input type="hidden" name="messageid" value="<?php print $media_user_result_unit->file_name; ?>" id="messageid" />

        <input src= "<?php echo img_url('common/valider_comm.png'); ?>" type="submit" value="Valider"/>
      </form>
      
       		                       <div class="ajax_loader"></div>

    </div>
</div>
            

      
    			</div>
  
    			<?php
    	}
    // ********************* VIDEO *********************
		else if($media_user_result_unit->type == 3)
 
		{

	

		?><!--
          <div class="comm">
	<img src="<?php echo img_url('common/del.png'); ?>" class="del"/>
      <img src="<?php echo img_url('common/avatar_comm.png'); ?>" />
      <p class="name_comm"> Jim Morrison</p>
      <p class="commentaire"><?php echo $media_user_result_unit->comment?></p> 
    </div>-->
 	<div class="photo box col1">
    			
  				 	<!--  edition : HOVER *******************-->
  				 <!--<object type="text/html" data="http://www.youtube.com/v/zol2MJf6XNE?version=3" style="width:40px;height:35px;"></object>
    			-->
   						<!--  edition : HOVER *******************-->
  				 	<div class="edit">
      					<a href="<?php echo base_url('/index.php/mc_photos/update_photo/'.$user_id.'/'.$media_user_result_unit->id.'/'.$media_user_result_unit->type) ?>"><img src="<?php echo img_url('musicien/edite.png'); ?>"/></a>
     				 <!--  edition : SUPPRESSION *******************-->

     					<a href="<?php echo base_url('/index.php/mc_photos/suppression_media/'.$user_id.'/'.$media_user_result_unit->id.'/'.$media_user_result_unit->type) ?>"><img src="<?php echo img_url('musicien/suppr.png'); ?>"/></a>
   					</div>
   					
   					<a href="http://www.youtube.com/v/<?php echo $media_user_result_unit->file_name ?>?version=3"><img src="http://i.ytimg.com/vi/<?php echo $media_user_result_unit->file_name?>/hqdefault.jpg" class="img_cover" /></a>
      					
     				<p class="nom_photo"><?php echo $media_user_result_unit->nom ?></p>
     				
     					 <?php 
							$cpt_comment = 0;
          						 foreach($commentaires_video as $commentaire){
           					      if($media_user_result_unit->id == $commentaire->video_id){
                   			 	 $cpt_comment++;
                					 }
           						 }     						
           						 ?>
     				
      			<div class="bord_photo">
        				 <a onclick='showComment("comm<?php echo $media_user_result_unit->file_name?>")' href="javascript:void(0);"><p><?php if($cpt_comment==0)print "0 commentaire"; if($cpt_comment==1)print "1 commentaire"; if($cpt_comment>1)print $cpt_comment."commentaires"; ?></p>
        				 </a>
        				 
        				
      				
      			<?php $count = substr_count($all_video_like,$media_user_result_unit->id.'/');
    	if ($count>=1)
    	{ ?>
      		
      		    	      <img src="<?php echo img_url('musicien/icon_coeur.png'); ?>" id="<?php echo $media_user_result_unit->id ?>" class="nolike-video" />
<?php }
       			else
       			{ ?>
        				 <img src="<?php echo img_url('musicien/icon_coeur.png'); ?>" class="like-video" id="<?php echo $media_user_result_unit->id ?>" />
        				<?php } ?>
        				
        				 <p class="nb_like"><?php echo $media_user_result_unit->like_total ?></p>
      				
      				
      				
      				
      				</div>
      
      		    	<div class="allcomment" id="comm<?php echo $media_user_result_unit->file_name ?>">

    		<?php foreach($commentaires_video as $commentaire): 
					if($media_user_result_unit->id == $commentaire->video_id): ?>  
                	<div class="comm">
						<img src="<?php echo img_url('common/del.png'); ?>" class="del"/>
    					<img src="<?php echo img_url('common/avatar_comm.png'); ?>" />
      					<p class="name_comm"> Jim Morrison</p>
      					<p class="commentaire"><?php echo $commentaire->comment?></p> 
    				</div>
    				

       			<?php endif; ?>
       			
            <?php endforeach; ?>
                  <div class="comment-form-video">
      <img src="<?php echo img_url('common/avatar_comm.png'); ?>" />
      <form  action="" method="post">
           <input type="text" name="usercomment" id="usercomment"/>
        <input type="hidden" name="baseurl" value="<?php echo base_url(); ?>" id="baseurl" />
        	<input type="hidden" name="messageid" value="<?php print $media_user_result_unit->id; ?>" id="messageid" />

        <input src= "<?php echo img_url('common/valider_comm.png'); ?>" type="submit" value="Valider"/>
      </form>
      
       		                       <div class="ajax_loader"></div>
</div>
</div>
      
    			</div>
    <?php 
    }
    	endforeach;

    ?>
    </div>
=======
    <div class="bts_noir_photo">
	  <div class="bt_noir">
		<a href="#"><span class="bt_left"></span><span class="bt_middle">Ajouter une photo/vidéo</span><span class="bt_right"></span></a>
	  </div>
	  <div class="bt_noir">
		<a href="#"><span class="bt_left"></span><span class="bt_middle">Supprimer la sélection</span><span class="bt_right"></span></a>
	  </div>
	</div>

  <div class="content">
    <div class="photo box col1" onMouseOver="this.id='select';edit_photo();" onMouseOut="cache_photo();this.id='';">
	<div class="edit">
      <a href="#"><img src="<?php echo img_url('musicien/edite.png'); ?>"/></a>
      <a href="#"><img src="<?php echo img_url('musicien/suppr.png'); ?>"/></a>
    </div>
    <div class="open_alb">
      <a href="#"><img src="<?php echo img_url('musicien/open_plus.png'); ?>"/></a>
    </div>
      <a href="#"><img src="<?php echo img_url('musicien/photo2.png'); ?>" class="img_cover" /></a>
      <p class="nom_photo">Concert N.Y, 1971</p>
      <div class="bord_photo">
        <a href="#"><p>3 commentaires</p></a><img src="<?php echo img_url('musicien/icon_coeur.png'); ?>" class="like" /><p class="nb_like">56</p>
      </div>
    </div>
    <div class="photo box col1" onMouseOver="this.id='select';edit_photo();" onMouseOut="cache_photo();this.id='';">
    <div class="edit">
      <a href="#"><img src="<?php echo img_url('musicien/edite.png'); ?>"/></a>
      <a href="#"><img src="<?php echo img_url('musicien/suppr.png'); ?>"/></a>
    </div>
    <div class="open_alb">
      <a href="#"><img src="<?php echo img_url('musicien/open_plus.png'); ?>"/></a>
    </div>
      <a href="#"><img src="<?php echo img_url('musicien/photo2.png'); ?>" class="img_cover" /></a>
      <a href="#"><img src="<?php echo img_url('musicien/photo3.png'); ?>" class="img_miniat" /></a>
      <a href="#"><img src="<?php echo img_url('musicien/photo4.png'); ?>" class="img_miniat" /></a>
      <a href="#"><img src="<?php echo img_url('musicien/photo5.png'); ?>" class="img_miniat" /></a>
      <p class="nom_photo">Concert N.Y, 1972</p>
      <div class="bord_photo">
        <a href="#"><p>1 commentaire</p></a><img src="<?php echo img_url('musicien/icon_coeur.png'); ?>" class="like" /><p class="nb_like">75</p>
      </div>
    </div>
    <div class="photo box col1" onMouseOver="this.id='select';edit_photo();" onMouseOut="cache_photo();this.id='';">
	<div class="edit">
      <a href="#"><img src="<?php echo img_url('musicien/edite.png'); ?>"/></a>
      <a href="#"><img src="<?php echo img_url('musicien/suppr.png'); ?>"/></a>
    </div>
    <div class="open_alb">
      <a href="#"><img src="<?php echo img_url('musicien/open_plus.png'); ?>"/></a>
    </div>
      <img src="<?php echo img_url('musicien/photo2.png'); ?>" class="img_cover" />
      <p class="nom_photo">Concert N.Y, 1973</p>
      <div class="bord_photo">
        <a href="#"><p>3 commentaires</p></a><img src="<?php echo img_url('musicien/icon_coeur.png'); ?>" class="like" /><p class="nb_like">56</p>
      </div>
    </div>
    <div class="photo box col1" onMouseOver="this.id='select';edit_photo();" onMouseOut="cache_photo();this.id='';">
	<div class="edit">
      <a href="#"><img src="<?php echo img_url('musicien/edite.png'); ?>"/></a>
      <a href="#"><img src="<?php echo img_url('musicien/suppr.png'); ?>"/></a>
    </div>
    <div class="open_alb">
      <a href="#"><img src="<?php echo img_url('musicien/open_plus.png'); ?>"/></a>
    </div>
      <img src="<?php echo img_url('musicien/photo2.png'); ?>" class="img_cover" />
      <p class="nom_photo">Concert N.Y, 1974</p>
      <div class="bord_photo">
        <a href="#"><p>3 commentaires</p></a><img src="<?php echo img_url('musicien/icon_coeur.png'); ?>" class="like" /><p class="nb_like">56</p>
      </div>
    </div>
    <div class="photo box col1" onMouseOver="this.id='select';edit_photo();" onMouseOut="cache_photo();this.id='';">
	<div class="edit">
      <a href="#"><img src="<?php echo img_url('musicien/edite.png'); ?>"/></a>
      <a href="#"><img src="<?php echo img_url('musicien/suppr.png'); ?>"/></a>
    </div>
    <div class="open_alb">
      <a href="#"><img src="<?php echo img_url('musicien/open_plus.png'); ?>"/></a>
    </div>
      <img src="<?php echo img_url('musicien/photo2.png'); ?>" class="img_cover" />
      <p class="nom_photo">Concert N.Y, 1975</p>
      <div class="bord_photo">
        <a href="#"><p>3 commentaires</p></a><img src="<?php echo img_url('musicien/icon_coeur.png'); ?>" class="like" /><p class="nb_like">56</p>
      </div>
    </div>
    <div class="photo box col1" onMouseOver="this.id='select';edit_photo();" onMouseOut="cache_photo();this.id='';">
	<div class="edit">
      <a href="#"><img src="<?php echo img_url('musicien/edite.png'); ?>"/></a>
      <a href="#"><img src="<?php echo img_url('musicien/suppr.png'); ?>"/></a>
    </div>
    <div class="open_alb">
      <a href="#"><img src="<?php echo img_url('musicien/open_plus.png'); ?>"/></a>
    </div>
      <img src="<?php echo img_url('musicien/photo2.png'); ?>" class="img_cover" />
      <p class="nom_photo">Concert N.Y, 1976</p>
      <div class="bord_photo">
        <a href="#"><p>3 commentaires</p></a><img src="<?php echo img_url('musicien/icon_coeur.png'); ?>" class="like" /><p class="nb_like">56</p>
      </div>
    </div>
    <div class="photo box col1" onMouseOver="this.id='select';edit_photo();" onMouseOut="cache_photo();this.id='';">
	<div class="edit">
      <a href="#"><img src="<?php echo img_url('musicien/edite.png'); ?>"/></a>
      <a href="#"><img src="<?php echo img_url('musicien/suppr.png'); ?>"/></a>
    </div>
    <div class="open_alb">
      <a href="#"><img src="<?php echo img_url('musicien/open_plus.png'); ?>"/></a>
    </div>
      <img src="<?php echo img_url('musicien/photo2.png'); ?>" class="img_cover" />
      <p class="nom_photo">Concert N.Y, 1977</p>
      <div class="bord_photo">
        <a href="#"><p>3 commentaires</p></a><img src="<?php echo img_url('musicien/icon_coeur.png'); ?>" class="like" /><p class="nb_like">56</p>
      </div>
    <div class="comm">
	<img src="<?php echo img_url('common/del.png'); ?>" class="del"/>
      <img src="<?php echo img_url('common/avatar_comm.png'); ?>" />
      <p class="name_comm"> Jim Morrison</p>
      <p class="commentaire"> Waouuuw </p> 
    </div>
    <div class="comm">
	<img src="<?php echo img_url('common/del.png'); ?>" class="del"/>
      <img src="<?php echo img_url('common/avatar_comm.png'); ?>" />
      <p class="name_comm"> Jim Morrison</p>
      <p class="commentaire"> Waouuuw </p>
    </div>
    <div class="comm">
      <img src="<?php echo img_url('common/avatar_comm.png'); ?>" />
      <p class="name_comm"> Jim Morrison</p>
      <p class="commentaire"> Waouuuw </p>
    </div>
    <div class="comm">
      <img src="<?php echo img_url('common/avatar_comm.png'); ?>" />
      <p class="name_comm"> Jim Morrison</p>
      <p class="commentaire"> Waouuuw </p>
    </div>
    <div class="comm">
      <img src="<?php echo img_url('common/avatar_comm.png'); ?>" />
      <p class="name_comm"> Bob Dylan</p>
      <p class="commentaire"> Ho ! </p>
    </div>
    <div class="comm">
      <img src="<?php echo img_url('common/avatar_comm.png'); ?>" />
      <form>
        <input type="text"/>
        <input src= "<?php echo img_url('common/valider_comm.png'); ?>" type="image"/>
      </form>
    </div>
    </div>
    <div class="photo box col1" onMouseOver="this.id='select';edit_photo();" onMouseOut="cache_photo();this.id='';">
	<div class="edit">
      <a href="#"><img src="<?php echo img_url('musicien/edite.png'); ?>"/></a>
      <a href="#"><img src="<?php echo img_url('musicien/suppr.png'); ?>"/></a>
    </div>
    <div class="open_alb">
      <a href="#"><img src="<?php echo img_url('musicien/open_plus.png'); ?>"/></a>
    </div>
      <img src="<?php echo img_url('musicien/photo2.png'); ?>" class="img_cover" />
      <p class="nom_photo">Concert N.Y, 1978</p>
      <div class="bord_photo">
        <a href="#"><p>3 commentaires</p></a><img src="<?php echo img_url('musicien/icon_coeur.png'); ?>" class="like" /><p class="nb_like">56</p>
      </div>
    </div>
    <div class="photo box col1" onMouseOver="this.id='select';edit_photo();" onMouseOut="cache_photo();this.id='';">
	<div class="edit">
      <a href="#"><img src="<?php echo img_url('musicien/edite.png'); ?>"/></a>
      <a href="#"><img src="<?php echo img_url('musicien/suppr.png'); ?>"/></a>
    </div>
    <div class="open_alb">
      <a href="#"><img src="<?php echo img_url('musicien/open_plus.png'); ?>"/></a>
    </div>
      <img src="<?php echo img_url('musicien/photo2.png'); ?>" class="img_cover" />
      <p class="nom_photo">Concert N.Y, 1979</p>
      <div class="bord_photo">
        <a href="#"><p>3 commentaires</p></a><img src="<?php echo img_url('musicien/icon_coeur.png'); ?>" class="like" /><p class="nb_like">56</p>
      </div>
    </div>
    <div class="photo box col1" onMouseOver="this.id='select';edit_photo();" onMouseOut="cache_photo();this.id='';">
	<div class="edit">
      <a href="#"><img src="<?php echo img_url('musicien/edite.png'); ?>"/></a>
      <a href="#"><img src="<?php echo img_url('musicien/suppr.png'); ?>"/></a>
    </div>
    <div class="open_alb">
      <a href="#"><img src="<?php echo img_url('musicien/open_plus.png'); ?>"/></a>
    </div>
      <img src="<?php echo img_url('musicien/photo2.png'); ?>" class="img_cover" />
      <p class="nom_photo">Concert N.Y, 1971</p>
      <div class="bord_photo">
        <a href="#"><p>3 commentaires</p></a><img src="<?php echo img_url('musicien/icon_coeur.png'); ?>" class="like" /><p class="nb_like">56</p>
      </div>
    </div>
    <div class="photo box col1" onMouseOver="this.id='select';edit_photo();" onMouseOut="cache_photo();this.id='';">
	<div class="edit">
      <a href="#"><img src="<?php echo img_url('musicien/edite.png'); ?>"/></a>
      <a href="#"><img src="<?php echo img_url('musicien/suppr.png'); ?>"/></a>
    </div>
    <div class="open_alb">
      <a href="#"><img src="<?php echo img_url('musicien/open_plus.png'); ?>"/></a>
    </div>
      <img src="<?php echo img_url('musicien/photo2.png'); ?>" class="img_cover" />
      <p class="nom_photo">Concert N.Y, 1972</p>
      <div class="bord_photo">
        <a href="#"><p>3 commentaires</p></a><img src="<?php echo img_url('musicien/icon_coeur.png'); ?>" class="like" /><p class="nb_like">56</p>
      </div>
    <div class="comm">
      <img src="<?php echo img_url('common/avatar_comm.png'); ?>" />
      <p class="name_comm"> Jim Morrison</p>
      <p class="commentaire"> Waouuuw </p>
    </div>
    <div class="comm">
      <img src="<?php echo img_url('common/avatar_comm.png'); ?>" />
      <p class="name_comm"> Jim Morrison</p>
      <p class="commentaire"> Waouuuw </p>
    </div>
    <div class="comm">
      <img src="<?php echo img_url('common/avatar_comm.png'); ?>" />
      <p class="name_comm"> Jim Morrison</p>
      <p class="commentaire"> Waouuuw </p>
    </div>
    <div class="comm">
      <img src="<?php echo img_url('common/avatar_comm.png'); ?>" />
      <form>
        <input type="text"/>
        <input src= "<?php echo img_url('common/valider_comm.png'); ?>" type="image"/>
      </form>
    </div>
    </div>
    <div class="photo box col1" onMouseOver="this.id='select';edit_photo();" onMouseOut="cache_photo();this.id='';">
	<div class="edit">
      <a href="#"><img src="<?php echo img_url('musicien/edite.png'); ?>"/></a>
      <a href="#"><img src="<?php echo img_url('musicien/suppr.png'); ?>"/></a>
    </div>
    <div class="open_alb">
      <a href="#"><img src="<?php echo img_url('musicien/open_plus.png'); ?>"/></a>
    </div>
      <img src="<?php echo img_url('musicien/photo2.png'); ?>" class="img_cover" />
      <p class="nom_photo">Concert N.Y, 1973</p>
      <div class="bord_photo">
        <a href="#"><p>3 commentaires</p></a><img src="<?php echo img_url('musicien/icon_coeur.png'); ?>" class="like" /><p class="nb_like">56</p>
      </div>
    <div class="comm">
      <img src="<?php echo img_url('common/avatar_comm.png'); ?>" />
      <p class="name_comm"> Jim Morrison</p>
      <p class="commentaire"> Waouuuw </p>
    </div>
    <div class="comm">
      <img src="<?php echo img_url('common/avatar_comm.png'); ?>" />
      <p class="name_comm"> Jim Morrison</p>
      <p class="commentaire"> Waouuuw </p>
    </div>
    <div class="comm">
      <img src="<?php echo img_url('common/avatar_comm.png'); ?>" />
      <p class="name_comm"> Jim Morrison</p>
      <p class="commentaire"> Waouuuw </p>
    </div>
    <div class="comm">
      <img src="<?php echo img_url('common/avatar_comm.png'); ?>" />
      <p class="name_comm"> Jim Morrison</p>
      <p class="commentaire"> Waouuuw </p>
    </div>
    <div class="comm">
      <img src="<?php echo img_url('common/avatar_comm.png'); ?>" />
      <p class="name_comm"> Bob Dylan</p>
      <p class="commentaire"> Ho ! </p>
    </div>
    <div class="comm">
      <img src="<?php echo img_url('common/avatar_comm.png'); ?>" />
      <form>
        <input type="text"/>
        <input src= "<?php echo img_url('common/valider_comm.png'); ?>" type="image"/>
      </form>
    </div>
    </div>
	<div class="photo box col1" onMouseOver="this.id='select';edit_photo();" onMouseOut="cache_photo();this.id='';">
	<div class="edit">
      <a href="#"><img src="<?php echo img_url('musicien/edite.png'); ?>"/></a>
      <a href="#"><img src="<?php echo img_url('musicien/suppr.png'); ?>"/></a>
    </div>
    <div class="open_alb">
      <a href="#"><img src="<?php echo img_url('musicien/open_plus.png'); ?>"/></a>
    </div>
      <img src="<?php echo img_url('musicien/photo2.png'); ?>" class="img_cover" />
      <p class="nom_photo">Concert N.Y, 1971</p>
      <div class="bord_photo">
        <a href="#"><p>3 commentaires</p></a><img src="<?php echo img_url('musicien/icon_coeur.png'); ?>" class="like" /><p class="nb_like">56</p>
      </div>
    </div>
	<div class="photo box col1" onMouseOver="this.id='select';edit_photo();" onMouseOut="cache_photo();this.id='';">
	<div class="edit">
      <a href="#"><img src="<?php echo img_url('musicien/edite.png'); ?>"/></a>
      <a href="#"><img src="<?php echo img_url('musicien/suppr.png'); ?>"/></a>
    </div>
    <div class="open_alb">
      <a href="#"><img src="<?php echo img_url('musicien/open_plus.png'); ?>"/></a>
    </div>
      <img src="<?php echo img_url('musicien/photo2.png'); ?>" class="img_cover" />
      <p class="nom_photo">Concert N.Y, 1971</p>
      <div class="bord_photo">
        <a href="#"><p>3 commentaires</p></a><img src="<?php echo img_url('musicien/icon_coeur.png'); ?>" class="like" /><p class="nb_like">56</p>
      </div>
    </div>
	<div class="photo box col1" onMouseOver="this.id='select';edit_photo();" onMouseOut="cache_photo();this.id='';">
	<div class="edit">
      <a href="#"><img src="<?php echo img_url('musicien/edite.png'); ?>"/></a>
      <a href="#"><img src="<?php echo img_url('musicien/suppr.png'); ?>"/></a>
    </div>
    <div class="open_alb">
      <a href="#"><img src="<?php echo img_url('musicien/open_plus.png'); ?>"/></a>
    </div>
      <img src="<?php echo img_url('musicien/photo2.png'); ?>" class="img_cover" />
      <p class="nom_photo">Concert N.Y, 1971</p>
      <div class="bord_photo">
        <a href="#"><p>3 commentaires</p></a><img src="<?php echo img_url('musicien/icon_coeur.png'); ?>" class="like" /><p class="nb_like">56</p>
      </div>
    </div>
	<div class="photo box col1" onMouseOver="this.id='select';edit_photo();" onMouseOut="cache_photo();this.id='';">
	<div class="edit">
      <a href="#"><img src="<?php echo img_url('musicien/edite.png'); ?>"/></a>
      <a href="#"><img src="<?php echo img_url('musicien/suppr.png'); ?>"/></a>
    </div>
    <div class="open_alb">
      <a href="#"><img src="<?php echo img_url('musicien/open_plus.png'); ?>"/></a>
    </div>
      <img src="<?php echo img_url('musicien/photo2.png'); ?>" class="img_cover" />
      <p class="nom_photo">Concert N.Y, 1971</p>
      <div class="bord_photo">
        <a href="#"><p>3 commentaires</p></a><img src="<?php echo img_url('musicien/icon_coeur.png'); ?>" class="like" /><p class="nb_like">56</p>
      </div>
    </div>
	<div class="photo box col1" onMouseOver="this.id='select';edit_photo();" onMouseOut="cache_photo();this.id='';">
	<div class="edit">
      <a href="#"><img src="<?php echo img_url('musicien/edite.png'); ?>"/></a>
      <a href="#"><img src="<?php echo img_url('musicien/suppr.png'); ?>"/></a>
    </div>
    <div class="open_alb">
      <a href="#"><img src="<?php echo img_url('musicien/open_plus.png'); ?>"/></a>
    </div>
      <img src="<?php echo img_url('musicien/photo2.png'); ?>" class="img_cover" />
      <p class="nom_photo">Concert N.Y, 1971</p>
      <div class="bord_photo">
        <a href="#"><p>3 commentaires</p></a><img src="<?php echo img_url('musicien/icon_coeur.png'); ?>" class="like" /><p class="nb_like">56</p>
      </div>
    </div>
	<div class="photo box col1" onMouseOver="this.id='select';edit_photo();" onMouseOut="cache_photo();this.id='';">
	<div class="edit">
      <a href="#"><img src="<?php echo img_url('musicien/edite.png'); ?>"/></a>
      <a href="#"><img src="<?php echo img_url('musicien/suppr.png'); ?>"/></a>
    </div>
    <div class="open_alb">
      <a href="#"><img src="<?php echo img_url('musicien/open_plus.png'); ?>"/></a>
    </div>
      <img src="<?php echo img_url('musicien/photo2.png'); ?>" class="img_cover" />
      <p class="nom_photo">Concert N.Y, 1971</p>
      <div class="bord_photo">
        <a href="#"><p>3 commentaires</p></a><img src="<?php echo img_url('musicien/icon_coeur.png'); ?>" class="like" /><p class="nb_like">56</p>
      </div>
    </div>
	<div class="photo box col1" onMouseOver="this.id='select';edit_photo();" onMouseOut="cache_photo();this.id='';">
	<div class="edit">
      <a href="#"><img src="<?php echo img_url('musicien/edite.png'); ?>"/></a>
      <a href="#"><img src="<?php echo img_url('musicien/suppr.png'); ?>"/></a>
    </div>
    <div class="open_alb">
      <a href="#"><img src="<?php echo img_url('musicien/open_plus.png'); ?>"/></a>
    </div>
      <img src="<?php echo img_url('musicien/photo2.png'); ?>" class="img_cover" />
      <p class="nom_photo">Concert N.Y, 1971</p>
      <div class="bord_photo">
        <a href="#"><p>3 commentaires</p></a><img src="<?php echo img_url('musicien/icon_coeur.png'); ?>" class="like" /><p class="nb_like">56</p>
      </div>
    </div>
  </div>
>>>>>>> 0a5f106366459ee42989c8cd393a8c35e10afe2d

  <?php if(isset($sidebar_right)) echo $sidebar_right; ?>

</div>