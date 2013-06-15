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
<<<<<<< HEAD
  
	
		<?php
 	if (count($all_follower)==1):?>
	<h2>Mon abonnement</h2>
	<?php endif;
	if (count($all_follower)==0):?>
	<h2>Aucun abonnement</h2>
	<?php endif;
	if (count($all_follower)>1):?>
	<h2>Mes <?php echo count($all_follower);?> abonnements</h2>
	<?php endif;
	
		if(isset($all_follower)):
	foreach($all_follower as $follower): ?>
	<div class="follower">
		<div class="photo_follow">
					<img src="<?php echo './files/'.$follower->Utilisateur_id ?>" />

		</div>
		<div class="description">
			<p class="nom_follow"><?php echo $follower->login ?></p>
			<p class="text_follow"><?php echo $follower->description ?></p>
				<img src="<?php print img_url('common/casque.png'); ?>" /><span><?php echo $follower->style_joue ?></span>
		</div>
		<div class="bouton">
			<a href="#" class="participer">
			<span class="button_left_abonne"></span>
			<span class="button_center_abonne">Abonné</span>
			<span class="button_right_abonne"></span></a>
		</div>
	</div>
	<hr/>
	
		<?php
	endforeach;
	endif;
	?>
	<!--<div class="follower">
=======
	<h2>Mes 6 abonnements</h2>
	<div class="follower">
		<div class="photo_follow">
			<img src="<?php print img_url('common/photo_follower.png'); ?>" />
		</div>
		<div class="description">
			<p class="nom_follow">Skip the use</p>
			<p class="text_follow">Du rock, des tatouages, des kilowatts, de la sueur ! Notre album est enfin dans les bacs !</p>
			<img src="<?php print img_url('common/casque.png'); ?>" /><span>Pop-rock, punk, jazz et électro-rock</span>
		</div>
		<div class="bouton">
			<a href="#" class="participer"><span class="button_left_abonne"></span><span class="button_center_abonne">Abonné</span><span class="button_right_abonne"></span></a>
		</div>
	</div>
	<hr/>
	<div class="follower">
>>>>>>> 0a5f106366459ee42989c8cd393a8c35e10afe2d
		<div class="photo_follow">
			<img src="<?php print img_url('common/photo_follower2.png'); ?>" />
		</div>
		<div class="description">
			<p class="nom_follow">Skip the use</p>
			<p class="text_follow">Du rock, des tatouages, des kilowatts, de la sueur ! Notre album est enfin dans les bacs !</p>
			<img src="<?php print img_url('common/casque.png'); ?>" /><span>Pop-rock, punk, jazz et électro-rock</span>
		</div>
		<div class="bouton">
			<a href="#" class="participer"><span class="button_left_abonne"></span><span class="button_center_abonne">Abonné</span><span class="button_right_abonne"></span></a>
		</div>
	</div>
	<hr/>
	<div class="follower">
		<div class="photo_follow">
			<img src="<?php print img_url('common/photo_follower.png'); ?>" />
		</div>
		<div class="description">
			<p class="nom_follow">Skip the use</p>
			<p class="text_follow">Du rock, des tatouages, des kilowatts, de la sueur ! Notre album est enfin dans les bacs !</p>
			<img src="<?php print img_url('common/casque.png'); ?>" /><span>Pop-rock, punk, jazz et électro-rock</span>
		</div>
		<div class="bouton">
			<a href="#" class="participer"><span class="button_left_non"></span><span class="button_center_non">Ne plus suivre</span><span class="button_right_non"></span></a>
		</div>
	</div>
	<hr/>
	<div class="follower">
		<div class="photo_follow">
			<img src="<?php print img_url('common/photo_follower.png'); ?>" />
		</div>
		<div class="description">
			<p class="nom_follow">Skip the use</p>
			<p class="text_follow">Du rock, des tatouages, des kilowatts, de la sueur ! Notre album est enfin dans les bacs !</p>
			<img src="<?php print img_url('common/casque.png'); ?>" /><span>Pop-rock, punk, jazz et électro-rock</span>
		</div>
		<div class="bouton">
			<a href="#" class="participer"><span class="button_left_abonne"></span><span class="button_center_abonne">Abonné</span><span class="button_right_abonne"></span></a>
		</div>
	</div>
	<hr/>
	<div class="follower">
		<div class="photo_follow">
			<img src="<?php print img_url('common/photo_follower.png'); ?>" />
		</div>
		<div class="description">
			<p class="nom_follow">Skip the use</p>
			<p class="text_follow">Du rock, des tatouages, des kilowatts, de la sueur ! Notre album est enfin dans les bacs !</p>
			<img src="<?php print img_url('common/casque.png'); ?>" /><span>Pop-rock, punk, jazz et électro-rock</span>
		</div>
		<div class="bouton">
			<a href="#" class="participer"><span class="button_left_abonne"></span><span class="button_center_abonne">Abonné</span><span class="button_right_abonne"></span></a>
		</div>
	</div>
	<hr/>
	<div class="follower">
		<div class="photo_follow">
			<img src="<?php print img_url('common/photo_follower.png'); ?>" />
		</div>
		<div class="description">
			<p class="nom_follow">Skip the use</p>
			<p class="text_follow">Du rock, des tatouages, des kilowatts, de la sueur ! Notre album est enfin dans les bacs !</p>
			<img src="<?php print img_url('common/casque.png'); ?>" /><span>Pop-rock, punk, jazz et électro-rock</span>
		</div>
		<div class="bouton">
			<a href="#" class="participer"><span class="button_left_non"></span><span class="button_center_non">Ne plus suivre</span><span class="button_right_non"></span></a>
		</div>
	</div>
<<<<<<< HEAD
	<hr/>-->
=======
	<hr/>
>>>>>>> 0a5f106366459ee42989c8cd393a8c35e10afe2d
  </div>


  <?php if(isset($sidebar_right)) echo $sidebar_right; ?>

</div>