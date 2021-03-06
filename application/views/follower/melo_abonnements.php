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
            <li><a href="<?php echo site_url('my-wall/' . $uid_visit); ?>">Mon compte</a></li>
            <li><a href="<?php echo site_url($this->uri->segment(1) . '/' . $uid_visit); ?>">Mes abonnements</a></li>
        </ul>
    </div>
  
    <div id="cover" style="background-image:url(<?php echo files('profiles/'.$cover = (empty($infos_profile)) ? $this->session->userdata('cover') : $infos_profile->cover); ?>);">
        <div id="infos-cover">
            <h2><?php echo $login; ?></h2><!--
            <a href="#"><span class="button_left"></span><span class="button_center">Suivre</span><span class="button_right"></span></a>
    -->   </div>
    </div>

  <div id="stats-cover">
 <div class="stats_cover_block">
          <span class="stats_number">
            <?php 
            echo $concert_cover[0]->n_concert ; ?>
          </span>
          <span class="stats_title">
            <?php
            if($concert_cover[0]->n_concert == 0 || $concert_cover[0]->n_concert == 1){
              echo 'concert';
            }
            else
            {
              echo 'concerts';
            }
            ?>
          </span>
        </div>

        <div class="stats_cover_block">
          <span class="stats_number">
            <?php 
            $npl = 0;
            if(empty($playlists)!=1):
              $npl =  count($playlists);
            endif;
            echo $npl;?>
          </span>
          <span class="stats_title">
            <?php
            if($npl == 0 || $npl == 1){
              echo 'playlist';
            }
            else
            {
              echo 'playlists';
            }
            ?>
          </span>
        </div>
        
        <div class="stats_cover_block">
          <span class="stats_number">
            <?php
            $nab = 0;
            if(empty($all_following)!=1):
              $nab =  count($all_following);
            endif;
            echo $nab;
            ?>
          </span>       
          <span class="stats_title">
            <?php
            if($nab == 0 || $nab == 1){
              echo 'abonnement';
            }
            else
            {
              echo 'abonnements';
            }
            ?>
          </span>
        </div>
  </div>
  <div class="content">
  
	
		<?php
 	if (count($all_follower)==1):?>
	<h1>Mes abonnements</h1>
	<?php endif;
	if (count($all_follower)==0):?>
	<h1>Aucun abonnement</h1>
	<?php endif;
	if (count($all_follower)>1):?>
	<h1>Mes<span class="green_text"> <?php echo count($all_follower);?></span> abonnements</h1>
	<?php endif;
	
		if(isset($all_follower)):
	foreach($all_follower as $key => $follower):
    $last_key = end(array_keys($all_follower)); ?>
	<div class="follower">
		<div class="photo_follow">
					<a href="<?php echo base_url('index.php/actualite/'.$follower->Utilisateur_id) ?>"><img src="<?php echo files('profiles/'.$follower->thumb) ?>" /></a>

		</div>
		<div class="description">
			<p class="nom_follow"><a href="<?php echo base_url('index.php/actualite/'.$follower->Utilisateur_id) ?>"><?php echo $follower->login ?></a></p>
			<p class="text_follow"><?php echo $follower->description ?></p>
				<img src="<?php echo img_url('common/casque.png'); ?>" alt="Musique jouée"/><span> <?php echo $follower->style_joue ?></span>
		</div>
		<div class="bouton" id="<?php echo $follower->id ?>">
			<a href="#" class="participer">
			<span class="button_left"></span>
			<span class="button_center">Abonné</span>
			<span class="button_right"></span></a>
		</div>
      
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