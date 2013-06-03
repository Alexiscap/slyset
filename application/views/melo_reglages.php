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
    </div>
  </div>

  <div id="stats-cover_melo">
    <div class="stats_cover_block">
      <span class="stats_number">489</span>
      <span class="stats_title">écoutes</span>
    </div>

    <div class="stats_cover_block">
      <span class="stats_number">18</span>
      <span class="stats_title">playlists</span>
    </div>

    <div class="stats_cover_block">
      <span class="stats_number">278</span>
      <span class="stats_title">abonnements</span>
    </div>
  </div>

  <div class="content">
	<h2>Modifier mon profil</h2>
	<p class="detail_perso">Cette page vous permet d'ajouter et/ou de modifier les informations qui figurent sur votre profil.</p>
	<div class="reglage_detail">
		<p>Votre photo</p>
		<div class="themes">
			<a href="#" class="profil"><span>photo</span></a>
			<img src="<?php echo img_url('musicien/bt_choisir_photo.png'); ?>">
			<span class="nom_background">bob-dylan-guitare.jpg</span>
		</div>
	</div>
	<div class="clear"></div>
	<div class="reglage_detail">
		<p>Votre en-tête</p>
		<div class="themes">
			<a href="#" class="tete"><span>en-tete</span></a>
			<img src="<?php echo img_url('musicien/bt_choisir_tete.png'); ?>">
			<span class="nom_background">bob-dylan-concert.jpg</span>
		</div>
	</div>
	<hr/>
	<div class="reglage_detail_txt">
		<p>Nom d'utilisateur</p>
		<div class="themes">
			<input type="text" class="detail_musicien" value="Bob Dylan">
		</div>
	</div>
	<div class="reglage_detail_txt">
		<p>Prénom</p>
		<div class="themes">
			<input type="text" class="detail_musicien">
		</div>
	</div>
	<div class="reglage_detail_txt">
		<p>Nom</p>
		<div class="themes">
			<input type="text" class="detail_musicien">
		</div>
	</div>
	<div class="reglage_detail_txt">
		<p>Email</p>
		<div class="themes">
			<input type="text" class="detail_musicien">
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
	<hr/>
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