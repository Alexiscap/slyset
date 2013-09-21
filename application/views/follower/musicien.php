<?php
$session_id = $this->session->userdata('uid');
$uid = (empty($session_id)) ? '' : $session_id;
$uid_visit = (empty($infos_profile)) ? $session_id : $infos_profile->id;
$login = (empty($infos_profile)) ? $this->session->userdata('login') : $infos_profile->login;
$loger = $this->session->userdata('logged_in'); 

?>

<div id="contentAll">
    <div id="breadcrumbs">
        <ul>
            <li><a href="<?php echo site_url('home/' . $uid); ?>">Accueil</a></li>
            <li><a href="<?php echo site_url('actualite/' . $uid_visit); ?>"><?php echo 'Artiste : ' . $login; ?></a></li>
            <li><a href="<?php echo site_url($this->uri->segment(1) . '/' . $uid_visit); ?>">Abonnements</a></li>
            <li><a href="<?php echo site_url($this->uri->segment(1) . '/' . $this->uri->segment(2) . '/' . $uid_visit); ?>">Abonnements Musiciens</a></li>
        </ul>
    </div>
    <?php
    ?>

  <div id="cover" style="background-image:url(<?php print files('profiles/'.$cover = (empty($infos_profile)) ? $this->session->userdata('cover') : $infos_profile->cover); ?>);">
    <div id="infos-cover">
          <h2><?php print $login = (empty($infos_profile)) ? $this->session->userdata('login') : $infos_profile->login; ?></h2>
     	<?php 
     		if($loger==1&&$infos_profile->id != $session_id&&$infos_profile->type==2&&substr_count($community_follower,$infos_profile->id)==0): ?>
      			<a href="#" class="add-follow" id="<?php echo $this->uri->segment(3)?>"><span class="button_left"></span><span class="button_center">Suivre</span><span class="button_right"></span></a>
   			<?php endif;
     		if($loger==1&&$infos_profile->id != $session_id&&($infos_profile->type==2)&&(substr_count($community_follower,$infos_profile->id)>0)): ?>
     			<a href="#" class="delete-follow" id="<?php echo $this->uri->segment(3)?>"><span class="button_left_abonne"></span><span class="button_center_abonne">Ne plus suivre</span><span class="button_right_abonne"></span></a>
    		<?php endif;?>
                
            <?php if($loger == 1 && $infos_profile->id != $session_id): ?><a class="contact-user iframe" href="<?php echo site_url('contacter/'.$uid_visit); ?>"><span class="button_left_abonne"></span><span class="button_center_abonne">Contacter</span><span class="button_right_abonne"></span></a><?php endif; ?>
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
	<div id="btn_tmp_follow">
       <a href="<?php echo site_url('follower/'.$infos_profile->id) ?>" class="tous">Tous</a>
       <a href="<?php echo site_url('follower/musicien/'.$infos_profile->id) ?>" class="musiciens active">Musiciens</a>
       <a href="<?php echo site_url('follower/melomane/'.$infos_profile->id) ?>" class="melomanes">Mélomanes</a>
   </div>
 	<?php
 		if (count($all_follower)==1):?>
	<h1>Mes abonnés</h1>
	<?php endif;
	if (count($all_follower)==0):?>
	<h1>Aucun abonné</h1>
	<?php endif;
	if (count($all_follower)>1):?>
	<h1>Mes <?php echo count($all_follower);?> abonnés</h1>
	<?php endif;?>
	<?php
	if(isset($all_follower)):
	foreach($all_follower as $key => $follower):
    $last_key = end(array_keys($all_follower)); ?>
	<div class="follower">
		<div class="photo_follow">
		<!-- dossier de la cover pour un user ? -->
			<a href="<?php echo base_url('index.php/actualite/'.$follower->Follower_id) ?>"><img src="<?php echo files('profiles/'.$follower->thumb) ?>" /></a>
		</div>
		<div class="description">
			<p class="nom_follow"><a href="<?php echo base_url('index.php/actualite/'.$follower->Follower_id) ?>"><?php echo $follower->login ?></a></p>
			<p class="text_follow"><?php echo $follower->description ?></p>
			
			
			<img src="<?php echo img_url('common/casque.png'); ?>" /><span><?php echo $follower->style_joue ?></span>
			</div>
		 	<?php if (substr_count($allifollow, $follower->Follower_id) >= 1) {
                            ?>
                        <div class="bouton" >
                            <a href="#" id="<?php echo $follower->Follower_id ?>" class="participer" ><span class="button_left"></span><span class="button_center">Abonné</span><span class="button_right"></span></a>
                        </div>
                        <?php
                    }
                    if (substr_count($allifollow, $follower->Follower_id) == 0) {
                        ?>
                        <div class="bouton" >
                            <a id="<?php echo $follower->Follower_id ?>" href="#" class="follow_following" ><span class="button_left_red"></span><span class="button_center_red">Suivre</span><span class="button_right_red"></span></a>
                        </div>
			<?php }
	
	
		?>
      
    <?php if($key != $last_key): ?>
        <hr/>
    <?php endif; ?>
	</div>
	<?php
	endforeach;
	endif;
	?>
  </div>


  <?php if(isset($sidebar_right)) echo $sidebar_right; ?>

</div>