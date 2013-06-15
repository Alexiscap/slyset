<div class="pop-in">
  <p> Modifier la video </p>
  <img src="<?php echo img_url('musicien/pop_close.png'); ?>" alt="Fermer" />
  <div class="content-pi">
    <form>
		<div class="label">
			<label>URL de la video </label>
		</div>
		<div class="champs">
			<input type="text">
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
			<img src="<?php echo img_url('musicien/apercu_vid.png'); ?>" alt="visuel video" />
		</div>
		<div class="champs">
			<input type="textarea" class="descript-vid" maxlength="110">
		</div>
		<input type="submit" value="valider">
	</form>
  </div>
</div>