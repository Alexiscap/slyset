<div id="contentAll">
  <div id="breadcrumbs">
    <ul>
      <li><a href="#">Accueil</a></li>
      <li><a href="#">Artistes</a></li>
      <li><a href="#"><?php print $login = (empty($infos_profile)) ? $this->session->userdata('login') : $infos_profile->login; ?></a></li>
      <li><a href="#">Fil d'actualité</a></li>
    </ul>
  </div>

  <div id="cover" style="background-image:url(<?php print files('profiles/'.$cover = (empty($infos_profile)) ? $this->session->userdata('cover') : $infos_profile->cover); ?>);">
    <div id="infos-cover">
          <h2><?php print $login = (empty($infos_profile)) ? $this->session->userdata('login') : $infos_profile->login; ?></h2>
     <?php 
     		if($infos_profile->type==2&&substr_count($community_follower,$infos_profile->id)==0):?>
      			<a href="#" class="add-follow" id="<?php echo $this->uri->segment(2)?>"><span class="button_left"></span><span class="button_center">Suivre</span><span class="button_right"></span></a>
   			<?php endif;
    		if($infos_profile->type==2&&substr_count($community_follower,$infos_profile->id)>0):?>
     			<a href="#" class="delete-follow" id="<?php echo $this->uri->segment(2)?>"><span class="button_left_abonne"></span><span class="button_center_abonne">Ne plus suivre</span><span class="button_right_abonne"></span></a>
    		<?php endif;?>
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
    <div class="bts_noir_photo">
	 <div class="bt_noir">
    <a class="iframe" href="<?php echo base_url('index.php/mc_photos/upload_photo/'.$infos_profile->id) ?>" ><span class="bt_left"></span><span class="bt_middle">Ajouter une photo/vidéo</span><span class="bt_right"></span></a>
  </div>
  <div class="bt_noir">
    <a class="iframe" href="<?php echo base_url('index.php/mc_photos/add_video/'.$infos_profile->id) ?>"><span class="bt_left"></span><span class="bt_middle">Supprimer la sélection</span><span class="bt_right"></span></a>
  </div>
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
  				 	<div class="edit">
      					<a href="<?php echo base_url('/index.php/mc_photos/update_photo/'.$infos_profile->id.'/'.$media_user_result_unit->id.'/'.$media_user_result_unit->type) ?>"><img src="<?php echo img_url('musicien/edite.png'); ?>"/></a>
     					 <!--  edition : SUPPRESSION *******************-->

     					<a href="<?php echo base_url('/index.php/mc_photos/suppression_media/'.$infos_profile->id.'/'.$media_user_result_unit->id.'/'.$media_user_result_unit->type) ?>"><img src="<?php echo img_url('musicien/suppr.png'); ?>"/></a>
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
    	       			 <img src="<?php echo img_url('musicien/pink_heart.png'); ?>" id="<?php echo $media_user_result_unit->id ?>" class="nolike" />

       			<?php }
       			else
       			{ ?>
       			 <img src="<?php echo img_url('musicien/icon_coeur.png'); ?>" id="<?php echo $media_user_result_unit->id ?>" class="like" />

      		<?php } ?>
      		<p class="nb_like" ><?php echo $media_user_result_unit->like_total ?></p>
      		</div> 
     
        	
    	<div class="allcomment" id="comm<?php echo $media_user_result_unit->id ?>">

    		<?php foreach($commentaires as $commentaire): 
    		?>
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
      					
      					<a href="<?php echo base_url('/index.php/mc_photos/update_photo/'.$infos_profile->id.'/'.$media_user_result_unit->file_name.'/'.$media_user_result_unit->type) ?>"><img src="<?php echo img_url('musicien/edite.png'); ?>"/></a>
     					<a href="<?php echo base_url('/index.php/mc_photos/suppression_media/'.$infos_profile->id.'/'.$media_user_result_unit->file_name.'/'.$media_user_result_unit->type) ?>"><img src="<?php echo img_url('musicien/suppr.png'); ?>"/></a>
   					<div class="open_alb">
      					<a href="<?php echo base_url('index.php/mc_photos/album/'.$infos_profile->id.'/'.$media_user_result_unit->file_name)?>"><img src="<?php echo img_url('musicien/open_plus.png'); ?>"/></a>
    					</div>
   					
   					</div>
					
    				
   					<a href="http://127.0.0.1/slyset/index.php/mc_photos/album/<?php echo $infos_profile->id ?>/<?php echo $media_user_result_unit->file_name ?>"><img src="http://127.0.0.1/slyset/files/30/photos/<?php echo $media_user_result_unit->file_name?>/cover" class="img_cover" /></a>
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
      					<a href="<?php echo base_url('/index.php/mc_photos/update_photo/'.$infos_profile->id.'/'.$media_user_result_unit->id.'/'.$media_user_result_unit->type) ?>"><img src="<?php echo img_url('musicien/edite.png'); ?>"/></a>
     				 <!--  edition : SUPPRESSION *******************-->

     					<a href="<?php echo base_url('/index.php/mc_photos/suppression_media/'.$infos_profile->id.'/'.$media_user_result_unit->id.'/'.$media_user_result_unit->type) ?>"><img src="<?php echo img_url('musicien/suppr.png'); ?>"/></a>
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

  <?php if(isset($sidebar_right)) echo $sidebar_right; ?>

</div>