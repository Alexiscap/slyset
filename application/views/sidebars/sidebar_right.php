<?php
$session_id = $this->session->userdata('uid');
$uid = (empty($session_id)) ? '' : $session_id;
$uid_visit = (empty($infos_profile)) ? $session_id : $infos_profile->id;
$login = (empty($infos_profile)) ? $this->session->userdata('login') : $infos_profile->login;
$loger = $this->session->userdata('logged_in'); 
?>

<aside id="right">
  <div id="avatar">
    <div id="photo">
      <img src="<?php echo $thumb = (!empty($profile->thumb)) ? files('profiles/'.$profile->thumb) : img_url('sidebar-right/default-photo-profil.png'); ?>" alt="Photo de profil"/>
    </div>
    <div id="description">
      <p id="texte_description"><?php if(!empty($profile->description)) echo ucfirst($profile->description); else echo 'Aucune description n\'a été remplie pour le moment.'; ?></p>
      <p id="style"><?php if(!empty($profile->style_ecoute)) echo ucfirst($profile->style_joue); ?></p>
      <p id="instruments"><?php if(!empty($profile->instrument)) echo ucfirst($profile->instrument); ?></p>
    </div>
  </div>
  
  <?php 
  if(!empty($morceau_right) && $morceau_right > 1):?>
  	<div style="display:none" id="top_titre">
    	
    	<!-- TITRE BLOC -->
    	<img src="<?php echo img_url('sidebar-right/etoile.png'); ?>" alt="etoile"/>

    	<p class="head-title"><?php if($uid_visit == $uid&&$morceau_right_t['type_page']!=1){ echo 'Mon' ;} else if($morceau_right_t['type_page']!=1) { echo 'Son';}; ?> Top 
    		<span>Titres</span>
    	</p>
      
    	<?php
        $cpt = 1;
        $numb_string = '';
      ?>
    	<div id="classement">
          
      <?php foreach($morceau_right as $morceau): ?>
        <?php
            if($cpt % 2){
                $numb_string = 'num_pair';
            } else{
                $numb_string = 'num_impair';
            }
        ?>  
          
        <?php if(isset($morceau)): ?>
          <div class="<?php echo $numb_string; ?>">
        		<p class="position"><?php echo $cpt; ?></p><a href="<?php echo site_url().'/mc_musique/player/'.$profile->id.'/album/'.$morceau->alb_name.'/'.$morceau->id; ?>" class="play open_player"><img src="<?php echo img_url('sidebar-right/lecture.png'); ?>" alt="lecture"/></a><p><?php print $morceau->nom; ?></p>
      		</div>
        <?php endif; ?>
        <?php $cpt++; ?>
      <?php endforeach; ?>
          
      <a href="<?php echo base_url('index.php/musique/'.$profile->id)?>">> Voir toute la musique</a>
    </div>
  </div>
  <?php endif; ?>
  
  <?php if(isset($photo_right[0])&&isset($photo_right[1])&&isset($photo_right[2])&&isset($photo_right[3])): ?>
  <div style="display:none" id="last_photo">
    <img src="<?php echo img_url('sidebar-right/polaroides.png'); ?>" alt="polaroides"/><p class="head-title">Derni&egrave;res <span>photos</span></p>
    <div id="encart_photos">
     <div id="miniatures">
        <img src="<?php echo base_url('files/'.$photo_right[0]->Utilisateur_id.'/photos/'.$photo_right[0]->file_name); ?>" alt="photo1"/>
        <img src="<?php echo base_url('files/'.$photo_right[1]->Utilisateur_id.'/photos/'.$photo_right[1]->file_name); ?>"  alt="photo2"/>
        <img src="<?php echo base_url('files/'.$photo_right[2]->Utilisateur_id.'/photos/'.$photo_right[2]->file_name); ?>"  alt="photo3"/>
      </div>
      <div id="thelast">
        <img  src="<?php echo base_url('files/'.$photo_right[3]->Utilisateur_id.'/photos/'.$photo_right[3]->file_name); ?>" alt="photo4"/>
      </div>
      <a href="<?php echo base_url('index.php/media/'.$photo_right[0]->Utilisateur_id) ?>">> Voir toutes les photos</a>
    </div>
  </div>
  <?php endif;?>
    <div style="display:none" id="reseaux_ailleur">
        <?php if(!empty($profile->twitter) || !empty($profile->facebook) || !empty($profile->googleplus) || !empty($profile->siteweb)): ?>
            <p class="head-title">Ailleurs <span>sur la toile</span></p>
            
            <?php if(!empty($profile->twitter)): ?>
                <a href="<?php echo $profile->twitter; ?>" class="twitter"><span>Twitter</span></a>
            <?php endif; ?>

            <?php if(!empty($profile->facebook)): ?>
                <a href="<?php echo $profile->facebook; ?>" class="fb"><span>Facebook</span></a>
            <?php endif; ?>

            <?php if(!empty($profile->googleplus)): ?>
                <a href="<?php echo $profile->googleplus; ?>" class="google"><span>Google+</span></a>
            <?php endif; ?>

            <?php if(!empty($profile->siteweb)): ?>
                <a href="<?php echo $profile->siteweb; ?>" class="site"><span>Site</span></a>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</aside>