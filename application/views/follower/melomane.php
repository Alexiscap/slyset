<?php
$session_id = $this->session->userdata('uid');
$uid = (empty($session_id)) ? '' : $session_id;
$uid_visit = (empty($infos_profile)) ? $session_id : $infos_profile->id;
$login = (empty($infos_profile)) ? $this->session->userdata('login') : $infos_profile->login;
?>

<div id="contentAll">
    <div id="breadcrumbs">
        <ul>
            <li><a href="<?php echo site_url('home/' . $uid); ?>">Accueil</a></li>
            <li><a href="<?php echo site_url('actualite/' . $uid_visit); ?>"><?php echo 'Artiste : ' . $login; ?></a></li>
            <li><a href="<?php echo site_url($this->uri->segment(1) . '/' . $uid_visit); ?>">Abonnements</a></li>
            <li><a href="<?php echo site_url($this->uri->segment(1) . '/' . $this->uri->segment(2) . '/' . $uid_visit); ?>">Abonnements Mélomane</a></li>
        </ul>
    </div>

  <div id="cover" style="background-image:url(<?php print files('profiles/'.$cover = (empty($infos_profile)) ? $this->session->userdata('cover') : $infos_profile->cover); ?>);">
    <div id="infos-cover">
          <h2><?php print $login = (empty($infos_profile)) ? $this->session->userdata('login') : $infos_profile->login; ?></h2>
     <?php 
     		if(($this->session->userdata('logged_in')!=1)&&($infos_profile->id != $this->session->userdata('uid'))&&($infos_profile->type==2)&&(substr_count($community_follower,$infos_profile->id)==0)): ?>
      			<a href="#" class="add-follow" id="<?php echo $this->uri->segment(2)?>"><span class="button_left"></span><span class="button_center">Suivre</span><span class="button_right"></span></a>
   			<?php endif;
     		if(($this->session->userdata('logged_in')!=1)&&($infos_profile->id != $this->session->userdata('uid'))&&($infos_profile->type==2)&&(substr_count($community_follower,$infos_profile->id)==0)): ?>
     			<a href="#" class="delete-follow" id="<?php echo $this->uri->segment(2)?>"><span class="button_left_abonne"></span><span class="button_center_abonne">Ne plus suivre</span><span class="button_right_abonne"></span></a>
    		<?php endif;?>       </div>
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
	<div id="btn_tmp_follow">
       <a href="<?php echo site_url('follower/'.$infos_profile->id) ?>" class="tous">Tous</a>
       <a href="<?php echo site_url('follower/musicien/'.$infos_profile->id) ?>" class="musiciens">Musiciens</a>
       <a href="<?php echo site_url('follower/melomane/'.$infos_profile->id) ?>" class="melomanes active">Mélomanes</a>
   </div>
 	<?php
 		if (count($all_follower)==1):?>
	<h2>Mes abonnés</h2>
	<?php endif;
	if (count($all_follower)==0):?>
	<h2>Aucun abonné</h2>
	<?php endif;
	if (count($all_follower)>1):?>
	<h2>Mes <?php echo count($all_follower);?> abonnés</h2>
	<?php endif;?>
	<?php
	if(isset($all_follower)):
	foreach($all_follower as $follower):
	?>
	<div class="follower">
		<div class="photo_follow">
		<!-- dossier de la cover pour un user ? -->
			<a href="<?php echo base_url('index.php/actualite/'.$follower->Follower_id) ?>"><img src="<?php echo files('profiles/'.$follower->thumb) ?>" /></a>
		</div>
		<div class="description">
			<p class="nom_follow"><a href="<?php echo base_url('index.php/actualite/'.$follower->Follower_id) ?>"><?php echo $follower->login ?></a></p>
			<p class="text_follow"><?php echo $follower->description ?></p>
			
			<?php 
			if($follower->type==1)
			{?>
			<img src="<?php echo img_url('common/casque.png'); ?>" /><span><?php echo $follower->style_ecoute ?></span>
			</div>
		<div class="bouton" >
            <a href="<?php echo base_url('index.php/my-wall/'.$follower->Follower_id) ?> " onclick="location.href='<?php echo base_url('index.php/my-wall/'.$follower->Follower_id) ?>';" class="melo"><span class="button_left_red"></span><span class="button_center_red">Voir le profil</span><span class="button_right_red"></span></a>
		</div>
			<?php }
	
	
		?>
	
	<hr/>
	</div>
	<?php
	endforeach;
	endif;
	?>
	<!--
	<div class="follower">
		<div class="photo_follow">
			<img src="<?php echo img_url('common/photo_follower.png'); ?>" />
		</div>
		<div class="description">
			<p class="nom_follow">Skip the use</p>
			<p class="text_follow">Du rock, des tatouages, des kilowatts, de la sueur ! Notre album est enfin dans les bacs !</p>
			<img src="<?php echo img_url('common/casque.png'); ?>" /><span>Pop-rock, punk, jazz et électro-rock</span>
		</div>
		<div class="bouton">
			<a href="#" class="participer"><span class="button_left"></span><span class="button_center">Suivre</span><span class="button_right"></span></a>
		</div>
	</div>
	<hr/>
	
	
	<div class="follower">
		<div class="photo_follow">
			<img src="<?php echo img_url('common/photo_follower2.png'); ?>" />
		</div>
		<div class="description">
			<p class="nom_follow">Skip the use</p>
			<p class="text_follow">Du rock, des tatouages, des kilowatts, de la sueur ! Notre album est enfin dans les bacs !</p>
			<img src="<?php echo img_url('common/casque.png'); ?>" /><span>Pop-rock, punk, jazz et électro-rock</span>
		</div>
		<div class="bouton">
			<a href="#" class="participer"><span class="button_left_abonne"></span><span class="button_center_abonne">Abonné</span><span class="button_right_abonne"></span></a>
		</div>
	</div>
	<hr/>
	<div class="follower">
		<div class="photo_follow">
			<img src="<?php echo img_url('common/photo_follower.png'); ?>" />
		</div>
		<div class="description">
			<p class="nom_follow">Skip the use</p>
			<p class="text_follow">Du rock, des tatouages, des kilowatts, de la sueur ! Notre album est enfin dans les bacs !</p>
			<img src="<?php echo img_url('common/casque.png'); ?>" /><span>Pop-rock, punk, jazz et électro-rock</span>
		</div>
		<div class="bouton">
			<a href="#" class="participer"><span class="button_left_non"></span><span class="button_center_non">Ne plus suivre</span><span class="button_right_non"></span></a>
		</div>
	</div>-->
  </div>


  <?php if(isset($sidebar_right)) echo $sidebar_right; ?>

</div>