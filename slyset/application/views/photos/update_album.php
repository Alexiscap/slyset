
<link rel="stylesheet" type="text/css" href="http://127.0.0.1/slyset/assets/css/slyset.css" media="screen" />
<script  src="http://127.0.0.1/slyset/assets/javascript/combobox.js" media="screen" ></script>

<div class="content-pi">
     

	<?php 
	$user = $this->uri->segment(3);
	$file_album = $this->uri->segment(4);
	 echo form_open('mc_photos/update_album/'.$user.'/'.$file_album);
	?>

	</br>

	<!-- ne pas changer la structure ! --> 
	
	<input id="album_select" placeholder="Choisir un album" name="albums"  autocomplete="off" type="text" /><span onclick="javascript:showInfo()">fleche basse</span>


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

	<br /><br />


	<?php echo form_submit('submit', 'Ajouter la photo'); ?>

	<?php form_close(); ?>

</div>