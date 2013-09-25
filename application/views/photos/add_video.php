<link rel="stylesheet" type="text/css" href="<?php echo css_url('pop_in') ?>" media="screen" />
<script  src="<?php echo js_url('combobox') ?>" media="screen" ></script>

<div class="pop-in_cent">
	
	<span> Ajouter une vidéo </span>
	
	<div class="content-pi-cent">
     

	<?php 
	$user = $this->uri->segment(3);
	?><div class="elem_center"><?php
	echo validation_errors(); 

	 echo form_open('media/ajouter-video/'.$user);
	?>
	
	<div class="label">
		<label>URL de la video </label>
	</div>
	<div class="champs">
		<input id="url_vid" name="url_video" placeholder="renseigner une url youtube" type="text" />
	</div>
	<div class="label">
			<label>Album</label>
		</div>
		 <?php 
            $place_alb = "";
            if(isset($info_album_photo[0]->nom)): $place_alb = $info_album_photo[0]->nom ; endif;
            ?>
		<div class="champs">
			<input id="album_select" value="<?php echo $place_alb ?>" placeholder="Choisir un album" name="albums"  autocomplete="off" type="text" /><span onclick="javascript:showInfo()" class="fleche_bas"><img src="<?php echo img_url('common/flb.png'); ?>" alt="Fleche basse" /></span>

			<div id='list_albums'>
		
				<ul id='tout_albums'>
					<?php 
				
					for($i=0;$i<$max_album_user;$i++)
					{	?>
						<li onclick="selectalbum(event)"><?php echo $album_by_user[$i]->{'nom'};?></li>
						<?php  		
					}
					?>	
				</ul>
				
				<div id='un_album'>
					<input  id="create" type="text" value="" autocomplete="off" placeholder="creer un nouvel album"/><div id="create_ok"  onclick="selectalbumcreate()"><img src="<?php echo img_url('common/creer_album.png'); ?>" alt="ok" /></div>
				</div>
			</div>
		</div>
		
		<div class="label">
			<!--<img src="<?php echo img_url('musicien/apercu_vid.png'); ?>" alt="visuel video" />-->
		</div>
		
		<div class="champs">
			<?php echo form_textarea('description',"",'placeholder="Ajouter une description."'); ?>
		</div>
		<?php echo form_submit('submit', 'Ajouter la video'); ?>

		<?php form_close(); ?>
	</div>
</div>
