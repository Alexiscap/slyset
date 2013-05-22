<div id="contentAll">

  <div id="breadcrumbs">
    <ul>
      <li><a href="#">Accueil</a></li>
      <li><a href="#">Artistes</a></li>
      <li><a href="#">Bob Dylan</a></li>
      <li><a href="#">Photos & Vidéos</a></li>
    </ul>
  </div>

  <div id="cover">
    <div id="infos-cover">
      <h2>Bob Dylan</h2>
      <a href="#"><span class="button_left"></span><span class="button_center">Suivre</span><span class="button_right"></span></a>
    </div>
  </div>

  <div id="stats-cover">
    <div class="stats_cover_block">
      <span class="stats_number">489</span>
      <span class="stats_title">abonnés</span>
    </div>

    <div class="stats_cover_block">
      <span class="stats_number">18</span>
      <span class="stats_title">albums</span>
    </div>

    <div class="stats_cover_block">
      <span class="stats_number">278</span>
      <span class="stats_title">morceaux</span>
    </div>
  </div>

  <div class="content">
	<h2>Réglage</h2>
	<p class="detail_perso">Personnalisez l’affichage de votre page musicien. Slyset vous propose différents thèmes préconçus mais vous pouvez également créer le votre.</p>
	<div class="reglage_detail">
		<p>Votre photo</p>
		<div class="themes">
			<a href="#" class="profil"><span>t1</span></a>
			<img src="<?php echo img_url('musicien/bt_choisir_photo.png'); ?>">
			<span class="nom_background">bob-dylan-guitare.jpg</span>
		</div>
	</div>
	<div class="clear"></div>
	<div class="reglage_detail">
		<p>Votre photo</p>
		<div class="themes">
			<a href="#" class="tete"><span>t1</span></a>
			<img src="<?php echo img_url('musicien/bt_choisir_tete.png'); ?>">
			<span class="nom_background">bob-dylan-concert.jpg</span>
		</div>
	</div>
	<hr/>
	<div class="reglage_detail_txt">
		<p>Nom de scène</p>
		<div class="themes">
			<input type="text" class="detail_musicien" value="Bob Dylan">
		</div>
	</div>
	<div class="clear"></div>
	<div class="reglage_detail_txt">
		<p>Bio</p>
		<div class="themes">
			<input type="textarea" class="detail_musicien" value="Décrivez-vous en quelques lignes..." maxlength=120>
		</div>
	</div>
	<div class="clear"></div>
	<div class="reglage_detail_txt">
		<p>Google+</p>
		<div class="themes">
			<input type="text" class="detail_musicien">
		</div>
	</div>
	<div class="clear"></div>
	<div class="reglage_detail_txt">
		<p>Site Web</p>
		<div class="themes">
			<input type="text" class="detail_musicien">
		</div>
	</div>
	<div class="clear"></div>
	<div class="reglage_detail_txt">
		<p>Twitter</p>
		<div class="themes">
			<input type="text" class="detail_musicien">
		</div>
	</div>
	<div class="clear"></div>
	<div class="reglage_detail_txt">
		<p>Facebook</p>
		<div class="themes">
			<input type="text" class="detail_musicien">
		</div>
	</div>
	<div class="clear"></div>
	<hr/>
	<div class="reglage_detail_domaine">
		<p>Instruments</p>
		<div class="themes">
			<ul>
				<li><input type="checkbox" name="instru"><span>Guitare</span></li>
				<li><input type="checkbox" name="instru"><span>Voix</span></li>
				<li><input type="checkbox" name="instru"><span>Piano</span></li>
				<li><input type="checkbox" name="instru"><span>Accordéon</span></li>
				<li><input type="checkbox" name="instru"><span>Harmonica</span></li>
				<li><input type="checkbox" name="instru"><span>Flute</span></li>
				<li><input type="checkbox" name="instru"><span>Batterie</span></li>
			</ul>
		</div>
	</div>
	<div class="clear"></div>
	<div class="reglage_detail_domaine">
		<p>Genres musicaux</p>
		<div class="themes">
			<ul>
				<li><input type="checkbox" name="instru"><span>Jazz</span></li>
				<li><input type="checkbox" name="instru"><span>Pop</span></li>
				<li><input type="checkbox" name="instru"><span>Rock</span></li>
				<li><input type="checkbox" name="instru"><span>Classique</span></li>
				<li><input type="checkbox" name="instru"><span>Electro</span></li>
				<li><input type="checkbox" name="instru"><span>House</span></li>
				<li><input type="checkbox" name="instru"><span>Metal</span></li>
			</ul>
		</div>
	</div>
	<div class="clear"></div>
	<input type="submit" value="valider" class="valider">
  </div>

  <?php if(isset($sidebar_right)) echo $sidebar_right; ?>

</div>