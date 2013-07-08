 <link rel="stylesheet" type="text/css" href="http://127.0.0.1/slyset/assets/css/slyset.css" media="screen" />
<script type="text/javascript" src="http://127.0.0.1/slyset/assets/javascript/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="http://127.0.0.1/slyset/assets/javascript/slyset.js"></script>


 <div class="pop-in_big">
  <p></p>
  <img src="<?php echo img_url('musicien/pop_close.png'); ?>" alt="Fermer" />
  <div class="content-pi">
	<img src="<?php echo base_url('files/'.$zoom[0]->Utilisateur_id.'/photos/'.$zoom[0]->file_name ); ?>" alt="Voir Photo" />
	<p class="titre_visu_photo"><?php echo $zoom[0]->nom ?></p>
	<div class="bord_photo">
        <img src="<?php echo img_url('musicien/icon_coeur.png'); ?>" class="like" /><p class="nb_like"><?php echo $zoom[0]->like_total ?></p>
    </div>
	
	
<?php
	foreach($zoom_comment as $comment): 
?>
	<div class="comm">
	  <img src="<?php echo img_url('common/del.png'); ?>" class="del"/>
      <img src="<?php echo base_url('files/profiles/'.$comment->thumb); ?>" />
      <p class="name_comm"> <?php echo $comment->login; ?> </p>
      <p class="commentaire"> <?php echo $comment->comment; ?> </p> 
	  <div class="clear"></div>
	 
    </div>
    <hr/>
     <?php endforeach; ?>

		<div class="ajout_comm">
      		<img src="<?php echo base_url('files/profiles/'.$this->session->userdata('thumb')) ?>" />
	      		<form action="" method="post">
		 			<input type="text" name="usercomment" id="usercomment"/>
        			<input type="hidden" name="baseurl" value="<?php echo base_url(); ?>" id="baseurl" />
        			<input type="hidden" name="messageid" value="<?php echo $zoom[0]->id; ?>" id="messageid" />
        			<input type="submit" value="Valider" class="test"/>
        		
	  			</form>
	  	<div class="clear"></div>
    </div>

   
    
    
   
  	</div>
    
  	</div>
  	
  
</div>

