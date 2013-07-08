<link rel="stylesheet" type="text/css" href="http://127.0.0.1/slyset/assets/css/slyset.css" media="screen" />
<script  src="http://127.0.0.1/slyset/assets/javascript/combobox.js" media="screen" ></script>

<div class="pop-in_cent">
	
	<span> Ajouter une vidéo </span>
	
	<div class="content-pi-cent">
     

	<?php 
	$user = $this->uri->segment(3);
	?><div class="elem_center"><?php
	echo validation_errors(); 

	 echo form_open('mc_photos/add_video/'.$user);
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
		<div class="champs">
			<input id="album_select" placeholder="Choisir un album" name="albums"  autocomplete="off" type="text" /><span onclick="javascript:showInfo()" class="fleche_bas"><img src="<?php echo img_url('common/flb.png'); ?>" alt="Fleche basse" /></span>

			<div id='test_one'>
		
				<ul id='test_two'>
					<?php 
				
					for($i=0;$i<$max_album_user;$i++)
					{	?>
						<li onclick="selectalbum(event)"><?php echo $album_by_user[$i]->{'nom'};?></li>
						<?php  		
					}
					?>	
				</ul>
				
				<div id='test_three'>
					<input  id="create" type="text" value="" autocomplete="off" placeholder="creer un nouvel album"/><div id="create_ok"  onclick="selectalbumcreate()">ok</div>
				</div>
			</div>
		</div>
		<div class="label">
			<img src="<?php echo img_url('musicien/apercu_vid.png'); ?>" alt="visuel video" />
		</div>
		<div class="champs">
			<?php echo form_textarea('description',"",'placeholder="Ajouter une description."'); ?>
		</div>
		<?php echo form_submit('submit', 'Ajouter la video'); ?>

		<?php form_close(); ?>
	</div>
</div>