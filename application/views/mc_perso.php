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
	<h2>Personnaliser votre page musicien</h2>
	<p class="detail_perso">Personnalisez l’affichage de votre page musicien. Slyset vous propose différents thèmes préconçus mais vous pouvez également créer le votre.</p>
	<div class="categ_perso">
		<p>Thèmes préconçus</p>
		<div class="themes">
			<a href="#" class="t1"><span>t1</span></a>
			<a href="#" class="t2"><span>t2</span></a>
			<a href="#" class="t3"><span>t3</span></a>
			<a href="#" class="t4"><span>t4</span></a>
		</div>
	</div>
	<hr/>
	<div class="categ_perso_detail">
		<p>Arrière plan personnalisé</p>
		<div class="themes">
			<a href="#" class="t1"><span>t1</span></a>
			<img src="<?php echo img_url('musicien/bt_choisir_background.png'); ?>">
			<span class="nom_background">bob-dylan-guitar.jpg</span>
			<input type="checkbox" name="repeter"><span class="repeat">Répéter l'image</span>
		</div>
	</div>
	<div class="clear"></div>
	<div class="categ_perso_precis">
		<p>Couleur d'arrière plan</p>
		<div class="themes">
			<a href="#" class="t1"><span>t1</span></a>
			<input type="text" value="#19849b">
		</div>
	</div>
	<div class="categ_perso_precis2">
		<p>Contour de votre photo de profil</p>
		<div class="themes">
			<a href="#" class="t1"><span>t1</span></a>
			<input type="text" value="#b3b2bb">
		</div>
	</div>
	<div class="categ_perso_precis3">
		<p>Couleur des liens</p>
		<div class="themes">
			<a href="#" class="t1"><span>t1</span></a>
			<input type="text" value="#323c6a">
		</div>
	</div>
	<div class="categ_perso_precis4">
		<p>Couleur des grands titres</p>
		<div class="themes">
			<a href="#" class="t1"><span>t1</span></a>
			<input type="text" value="#b3b2bb">
		</div>
	</div>
	<div class="clear"></div>
	<input type="submit" value="valider" class="valider">
  </div>

  <?php if(isset($sidebar_right)) echo $sidebar_right; ?>

</div>