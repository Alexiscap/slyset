<?php
$session_id = $this->session->userdata('uid');
$uid = (empty($session_id)) ? '' : $session_id;
$uid_visit = (empty($profile)) ? $session_id : $profile->id;
$login = (empty($profile)) ? $this->session->userdata('login') : $profile->login;
?>

<div id="contentAll">
    <div id="breadcrumbs">
        <ul>
            <li><a href="<?php echo site_url('home/' . $uid); ?>">Accueil</a></li>
            <li><a href="<?php echo site_url('actualite/' . $uid_visit); ?>"><?php echo 'Artiste : ' . $login; ?></a></li>
            <li><a href="<?php echo site_url($this->uri->segment(1) . '/' . $uid_visit); ?>">Photos & Vidéos</a></li>
        </ul>
    </div>
    
    <div id="cover" style="background-image:url(<?php print files('profiles/'.$cover = (empty($infos_profile)) ? $this->session->userdata('cover') : $infos_profile->cover); ?>);">
    <div id="infos-cover">
          <h2><?php print $login = (empty($infos_profile)) ? $this->session->userdata('login') : $infos_profile->login; ?></h2>
     <?php 
     		if($profile->type==2&&substr_count($community_follower,$profile->id)==0):?>
      			<a href="#" class="add-follow" id="<?php echo $this->uri->segment(2)?>"><span class="button_left"></span><span class="button_center">Suivre</span><span class="button_right"></span></a>
   			<?php endif;
    		if($profile->type==2&&substr_count($community_follower,$profile->id)>0):?>
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
          <?php if ($this->uri->segment(2) == $uid) { ?>
<!--
        <div class="bt_noir">
        
            <a class="iframe" href="<?php echo site_url('media/ajouter-photo/' . $profile->id) ?>" ><span class="bt_left"></span><span class="bt_middle">Ajouter une photo</span><span class="bt_right"></span></a>
        </div>
        <div class="bt_noir">
            <a class="iframe" href="<?php echo site_url('media/ajouter-video/' . $profile->id) ?>"><span class="bt_left"></span><span class="bt_middle">Ajouter une vidéo</span><span class="bt_right"></span></a>
        </div>-->
        <?php } ?>

  <div class="content">
  	 <?php
	foreach ($all_media_user_result as $media_user_result_unit):
		if($media_user_result_unit->type == 1)
{
		/*  Bloc image orpheline */
			?>
    		<div class="photo box col1">
    		  <?php if ($profile->id == $uid) { ?> 
    		 <div class="edit">
                        <a class="iframe" href="<?php echo site_url('media/editer/' . $profile->id . '/' . $media_user_result_unit->id . '/' . $media_user_result_unit->type) ?>"><img src="<?php echo img_url('musicien/edite.png'); ?>"/></a>
                        <!--  edition : SUPPRESSION *******************-->

                        <a class="iframe" href="<?php echo site_url('media/supprimer/' . $profile->id . '/' . $media_user_result_unit->id . '/' . $media_user_result_unit->type) ?>"><img src="<?php echo img_url('musicien/suppr.png'); ?>"/></a>
                    </div>
                    <?php } ?>
      		<a href="#"><img src="http://127.0.0.1/slyset/files/30/photos/<?php echo $this->uri->segment(3) ?>/<?php echo  $media_user_result_unit->file_name?>" class="img_cover" /></a>
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

                        <?php foreach ($commentaires as $commentaire): ?>
                            <?php if ($media_user_result_unit->id == $commentaire->photos_id): ?>      
                                <div class="comm">
                                    <?php if ($profile->id == $uid) { ?> <img src="<?php echo img_url('common/del.png'); ?>" class="del"/>
                                 <?php } ?>   <img src="<?php echo base_url('/files/profiles/'.$commentaire->thumb); ?>" />
                                    <p class="name_comm"> <?php echo $commentaire->login ?></p>
                                    <p class="commentaire"><?php echo $commentaire->comment ?></p> 
                                </div>

                            <?php endif; ?>
                        <?php endforeach; ?>
                        <div class="comment-form">
                            <img src="<?php echo base_url('/files/profiles/'.$this->session->userdata('thumb')) ?>" />
                            <form  action="" method="post">
                                <input type="text" name="usercomment" id="usercomment"/>
                                <input type="hidden" name="baseurl" value="<?php echo base_url(); ?>" id="baseurl" />
                                <input type="hidden" name="messageid" value="<?php echo $media_user_result_unit->id; ?>" id="messageid" />

                                <input src= "<?php echo img_url('common/valider_comm.png'); ?>" type="submit" value="Valider"/>
                            </form>

                            <div class="ajax_loader"></div>

                        </div>
                    </div>

		   </div>        
           <?php
		}
        // ********************* VIDEO *********************
		else if($media_user_result_unit->type == 2)
 
		{

	

		?><!--
          <div class="comm">
	<img src="<?php echo img_url('common/del.png'); ?>" class="del"/>
      <img src="<?php echo img_url('common/avatar_comm.png'); ?>" />
      <p class="name_comm"> Jim Morrison</p>
      <p class="commentaire"><?php echo $media_user_result_unit->comment?></p> 
    </div>-->
 	<div class="photo box col1">
 	  <?php if ($profile->id == $uid) { ?> 
    			 <div class="edit">
                <a class="iframe" href="<?php echo base_url('/index.php/mc_photos/update_photo/'.$profile->id.'/'.$media_user_result_unit->id.'/'.$media_user_result_unit->type) ?>"><img src="<?php echo img_url('musicien/edite.png'); ?>"/></a>
              <!--  edition : SUPPRESSION *******************-->

               <a class="iframe" href="<?php echo base_url('/index.php/mc_photos/suppression_media/'.$profile->id.'/'.$media_user_result_unit->id.'/'.$media_user_result_unit->type) ?>"><img src="<?php echo img_url('musicien/suppr.png'); ?>"/></a>
             </div>
             <?php } ?>
  				 	<!--  edition : HOVER *******************-->
  				 <!--<object type="text/html" data="http://www.youtube.com/v/zol2MJf6XNE?version=3" style="width:40px;height:35px;"></object>
    			-->	
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
        				 <a onclick='showComment("comm<?php echo $media_user_result_unit->file_name?>")' href="javascript:void(0);"><p><?php if($cpt_comment==0)echo "0 commentaire"; if($cpt_comment==1)echo "1 commentaire"; if($cpt_comment>1)echo $cpt_comment."commentaires"; ?></p></a><img src="<?php echo img_url('musicien/icon_coeur.png'); ?>" class="like" /><p class="nb_like"><?php echo $media_user_result_unit->like_total ?></p>
      				</div>
            		    	<div class="allcomment" id="comm<?php echo $media_user_result_unit->file_name ?>">

    		<?php foreach($commentaires_video as $commentaire): 
					if($media_user_result_unit->id == $commentaire->video_id): ?>  
                	<div class="comm">
                	 <?php if ($profile->id == $uid) { ?>
						<img src="<?php echo img_url('common/del.png'); ?>" class="del"/><?php } ?>
    					 <img src="<?php echo base_url('/files/profiles/'.$commentaire->thumb); ?>" />
      					<p class="name_comm"> <?php $commentaire->login ?></p>
      					<p class="commentaire"><?php echo $commentaire->comment?></p> 
    				</div>
    				

       			<?php endif; ?>
       			
            <?php endforeach; ?>
                  <div class="comment-form-video">
                            <img src="<?php echo base_url('/files/profiles/'.$this->session->userdata('thumb')) ?>" />
      <form  action="" method="post">
           <input type="text" name="usercomment" id="usercomment"/>
        <input type="hidden" name="baseurl" value="<?php echo base_url(); ?>" id="baseurl" />
        	<input type="hidden" name="messageid" value="<?php echo $media_user_result_unit->id; ?>" id="messageid" />

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
    	
    

		<!--
          <div class="comm">
	<img src="<?php echo img_url('common/del.png'); ?>" class="del"/>
      <img src="<?php echo img_url('common/avatar_comm.png'); ?>" />
      <p class="name_comm"> Jim Morrison</p>
      <p class="commentaire"><?php echo $media_user_result_unit->comment?></p> 
    </div>-->
 
    
    </div>

  <?php if(isset($sidebar_right)) echo $sidebar_right; ?>

</div>