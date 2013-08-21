 <div class="pop-in">
  <p> Ajouter un livret </p>
  <img src="<?php echo img_url('musicien/pop_close.png'); ?>" alt="Fermer" />
  <div class="content-pi">
			<?php echo $error;?>

<?php echo form_open_multipart('pop_in_general/do_upload_livret');?>

		<div class="label">
			<label>Vos livrets</label>
		</div>
		<div class="champs">
		<!--	<div class="bt_noir">
				<a href="#"><span class="bt_left"></span><span class="bt_middle">Choisir un fichier</span><span class="bt_right"></span></a>
			<p class="nom_img">bob_dylan_lille.jpg</p>
			</div>
			-->

<input type="file" name="userfile" size="20" />

<br /><br />
<!-- upload fichier
par controller : list album
par album : liste morceaux
-->

				
		</div>
		<div class="label">
			<label>Album</label>
		</div>
		<div class="champs">
			<select name="album">
			<option  value=" "> </option>

			<?php foreach($album as $one_album): ?>
			<option id="" name="album" class = "<?php echo $one_album->id?>" value="<?php echo $one_album->nom?>+<?php echo $one_album->id?>"><?php echo $one_album->nom?></option>

			<?php endforeach; ?>
		</select>
		</div>
		<div id="morceaux"></div>
<input type="submit" value="upload" />
	<?php echo form_close();?>
  </div>
</div>