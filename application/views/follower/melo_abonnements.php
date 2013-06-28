<div id="contentAll">
  <div id="breadcrumbs">
    <ul>
      <li><a href="#">Accueil</a></li>
      <li><a href="#">Artistes</a></li>
      <li><a href="#"><?php print $login = (empty($infos_profile)) ? $this->session->userdata('login') : $infos_profile->login; ?></a></li>
      <li><a href="#">Fil d'actualité</a></li>
    </ul>
  </div>

  <div id="cover" style="background-image:url(<?php print files('profiles/'.$cover = (empty($infos_profile)) ? $this->session->userdata('cover') : $infos_profile->cover); ?>);">
    <div id="infos-cover">
          <h2><?php print $login = (empty($infos_profile)) ? $this->session->userdata('login') : $infos_profile->login; ?></h2>
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
  
	
		<?php
 	if (count($all_follower)==1):?>
	<h2>Mes abonnements</h2>
	<?php endif;
	if (count($all_follower)==0):?>
	<h2>Aucun abonnement</h2>
	<?php endif;
	if (count($all_follower)>1):?>
	<h2>Mes<span class="green_text"> <?php echo count($all_follower);?></span> abonnements</h2>
	<?php endif;
	
		if(isset($all_follower)):
	foreach($all_follower as $follower): ?>
	<div class="follower">
		<div class="photo_follow">
					<img src="<?php echo files('profiles/'.$follower->cover) ?>" />

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
	<hr/>-->
  </div>


  <?php if(isset($sidebar_right)) echo $sidebar_right; ?>

</div>