 <link rel="stylesheet" type="text/css" href="<?php echo css_url('pop_in') ?>" media="screen" />
<script type="text/javascript" src="http://127.0.0.1/slyset/assets/javascript/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="http://127.0.0.1/slyset/assets/javascript/slyset.js"></script>

<span></span>
 <div class="pop-in_cent">
  <div class="content-pi_photo">
	<div class="zoom_photo">
		<img src="<?php echo base_url('files/'.$zoom[0]->Utilisateur_id.'/photos/'.$zoom[0]->file_name ); ?>" alt="Voir Photo" />
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
      <img src="<?php echo base_url('files/profiles/'.$comment->thumb); ?>" />
	  <div class="info_comm">
		<p class="name_comm"> <?php echo $comment->login; ?> </p>
		<p class="commentaire"> <?php echo $comment->comment; ?> </p> 
	  </div>
	  <img src="<?php echo img_url('common/del.png'); ?>" class="del"/>
	  <div class="clear"></div>
	 
    </div>
    <hr/>
     <?php endforeach; ?>

		<div class="ajout_comm">
      		<img src="<?php echo base_url('files/profiles/'.$this->session->userdata('thumb')) ?>" />
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

