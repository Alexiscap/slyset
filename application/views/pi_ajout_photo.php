 <div class="pop-in">
  <p> Ajouter une photo </p>
  <img src="<?php echo img_url('musicien/pop_close.png'); ?>" alt="Fermer" />
  <div class="content-pi">
    <form>
		<div class="label">
			<label>Votre photo</label>
		</div>
		<div class="champs">
			<div class="bt_noir">
				<a href="#"><span class="bt_left"></span><span class="bt_middle">Choisir une photo</span><span class="bt_right"></span></a>
				<p class="nom_img">bob_dylan_lille.jpg</p>
			</div>
		</div>
		<div class="label">
			<label>Album</label>
		</div>
		<div class="champs">
			<select>
			<option value="1">1</option>
		</select>
		</div>
		<div class="label">
			<img src="<?php echo img_url('musicien/apercu_photo.png'); ?>" alt="visuel photo" />
		</div>
		<div class="champs">
			<input type="textarea" class="descript-vid" maxlength="110">
		</div>
		<input type="submit" value="valider">
	</form>
  </div>
</div>