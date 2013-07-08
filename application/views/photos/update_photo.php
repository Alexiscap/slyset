
<link rel="stylesheet" type="text/css" href="http://127.0.0.1/slyset/assets/css/slyset.css" media="screen" />
<script  src="http://127.0.0.1/slyset/assets/javascript/combobox.js" media="screen" ></script>

<div class="content-pi">
     

	<?php 
	$user = $this->uri->segment(3);
	$photo = $this->uri->segment(4);
	$type = $this->uri->segment(5);

	echo validation_errors(); 

	 echo form_open('mc_photos/update_photo/'.$user.'/'.$photo.'/'.$type);
	?>

	</br>

	<!-- ne pas changer la structure ! --> 
	<?php 

	if($type == 1||$type == 3)
	{?>
	<input value="<?php if(isset($info_album_photo[0]->nom)) echo $info_album_photo[0]->nom ?>" id="album_select" placeholder="Choisir un album" name="albums"  autocomplete="off" type="text" /><span onclick="javascript:showInfo()">fleche basse</span>


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
<?php }?>
	<br /><br />
	<?php if(isset($info_photo[0]->nom)) {$info_photo = $info_photo[0]->nom ;} else {$info_photo = '';}
	 echo form_textarea('description',$info_photo,'placeholder="Ajouter une description."'); ?>
	
	<?php 

	
	if($type == 1)
	{
		echo form_submit('submit', 'Modifier la photo'); 
	}
	if($type == 2)
	{
		echo form_submit('submit', "Modifier l'album"); 
	}
	if($type == 3)
	{
		echo form_submit('submit', 'Modifier la video'); 
	}
	
	 form_close(); ?>

</div>