 <link rel="stylesheet" type="text/css" href="<?php echo css_url('pop_in') ?>" media="screen" />
<script  src="<?php echo js_url('jquery-1.8.3.min') ?>" media="screen" ></script>
<script  src="<?php echo js_url('slyset') ?>" media="screen" ></script>


<span></span>
 <div class="pop-in_cent">
  <div class="content-pi_photo">
	<div class="zoom_photo">
		<?php if($zoom[0]->alb_fn == null ) : ?>
			<img src="<?php echo base_url('files/'.$zoom[0]->Utilisateur_id.'/photos/'.$zoom[0]->file_name ); ?>" alt="Voir Photo" />
		<?php endif;?>
		<?php if($zoom[0]->alb_fn != null ) : ?>
			<img src="<?php echo base_url('files/'.$zoom[0]->Utilisateur_id.'/photos/'.$zoom[0]->alb_fn .'/'.$zoom[0]->file_name ); ?>" alt="Voir Photo" />
		<?php endif;?>		
	</div>
	<div class="name_like">
		<p class="titre_visu_photo"><?php echo $zoom[0]->nom ?></p>
		<div class="bord_photo">
			<p class="nb_like"><?php echo $zoom[0]->like_total ?></p><img src="<?php echo img_url('musicien/icon_coeur.png'); ?>" class="like" />
		</div>
	</div>
	
<?php
	foreach($zoom_comment as $comment): 
?>
	<div class="comm">
      <img src="<?php echo base_url('files/profiles/'.$comment->thumb); ?>" alt="Photo profil"/>
	  <div class="info_comm">
		<p class="name_comm"> <?php echo $comment->login; ?> </p>
		<p class="commentaire"> <?php echo $comment->comment; ?> </p> 
	  </div>
	  <img src="<?php echo img_url('common/del.png'); ?>" class="del" alt="Suppression"/>
	  <div class="clear"></div>
	 
    </div>
    <hr/>
     <?php endforeach; ?>

		<div class="ajout_comm">
      		<img src="<?php echo base_url('files/profiles/'.$this->session->userdata('thumb')) ?>" alt="Photo profil"/>
	      		<form action="" method="post">
		 			<input type="text" name="usercomment" id="usercomment" class="commz"/>
        			<input type="hidden" name="baseurl" value="<?php echo base_url(); ?>" id="baseurl" />
        			<input type="hidden" name="messageid" value="<?php echo $zoom[0]->id; ?>" id="messageid" />
        			<input type="submit" value="Valider" class="test"/>
	  			</form>
	  	<div class="clear"></div>
    </div>

   
    
    
   
  	</div>
    
  	</div>
  	
  
</div>

