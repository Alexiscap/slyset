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
            <li><a href="<?php echo site_url($this->uri->segment(1) . '/' . $this->uri->segment(2) . '/' . $uid_visit); ?>">Mes anciens concerts</a></li>
        </ul>
    </div>

    <div id="cover" style="background-image:url(<?php echo files('profiles/' . $cover = (empty($infos_profile)) ? $this->session->userdata('cover') : $infos_profile->cover); ?>);">
        <div id="infos-cover">
            <h2><?php echo $login; ?></h2><!--
            <a href="#"><span class="button_left"></span><span class="button_center">Suivre</span><span class="button_right"></span></a>
       --> </div>
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
        <div id="btn_tmp">
            <a href="<?php echo site_url('my-concert/' . $infos_profile->id) ?>"><div class="avenir">&Aacute; venir</div></a>
            <a href="<?php echo site_url('my-concert/archive/' . $infos_profile->id) ?>"><div class="cpasse actif">Concerts passés</div></a>
   </div>
    <h1>Mes concerts passés</h1>
   
     <!-- Boucle : tous les concerts pour un artiste -->
   	  <?php 
  if($nbr_concert_par_melo!=0)
   { 

   	    foreach($concert_all as $concert_unit): ?>
 <div class="all-info-concert">
  		<p  class="date-heure"><span><?php
		get_date($concert_unit->date,'complete');?> <?php if(isset($concert_unit->prix))echo ' - '.$concert_unit->prix.'&euro;'?></span></p>
   		 <hr/>
   			 <div class="infos_concert">
      			 <div class="calendrier"><p class="mois"><?php
		get_date($concert_unit->date,'mois_trois');?></p><p class="jour"><?php
	get_date($concert_unit->date,'jour_texte');?></p></div>
     			 <p><?php echo $concert_unit->titre ?></p>
     			 <p><?php if(isset($concert_unit->seconde_partie)) echo '+ '.$concert_unit->seconde_partie ?></p>
    		 </div>
   			 <div class="adr_concert">
     	 		<img src="<?php echo img_url('musicien/localisation.png'); ?>" />
    	 		<p class="adr_lieu"><?php echo $concert_unit->salle ?></p>
      	 		<p class="adr_rue"><?php if(isset($concert_unit->numero_adresse,$concert_unit->voie_adresse))echo $concert_unit->numero_adresse." ".$concert_unit->voie_adresse ?> <!--Bis Rue de Bagnolet--></p>
      			 <p class="adr_ville"><?php echo $concert_unit->ville.", ".$concert_unit->pays ?></p>
   		 	</div>
   		 <a href="javascript:void(0);" class="more" id="more_<?php echo $concert_unit->id ?>" onclick='showInfo(more_<?php echo $concert_unit->id ?>,more_info_<?php echo $concert_unit->id ?>)' >Voir plus d'informations</a>
    	<!-- <a href="#" class="participer" id="<?php echo $concert_unit->concerts_id; ?>"><span class="button_left"></span><span class="button_center">J'y vais</span><span class="button_right"></span></a>
    -->
   
    
    
    <div class="info_sup" id="more_info_<?php echo $concert_unit->id ?>" style="display:none">
      <div class="informations">
        <p class="nom_date"><?php echo $concert_unit->titre.',' ?> <!--le 28/11/13 &agrave; 20h30--></p>
        <p class="lieu_salle"><?php echo $concert_unit->salle.',' ?></p>
        <p class="lieu_rue"><?php if(isset($concert_unit->numero_adresse,$concert_unit->voie_adresse))echo $concert_unit->numero_adresse." ".$concert_unit->voie_adresse."," ?> </p>
        <p class="lieu_ville"><?php if(isset($concert_unit->code_postal))echo $concert_unit->code_postal." ".$concert_unit->ville;?></p>
        <p class="tel"><?php if (isset($concert_unit->phone_number)) echo "Tel. : ".$concert_unit->phone_number ;?> </p>
        <p class="site"><?php if (isset($concert_unit->website)) echo "Site web :<a href='".$concert_unit->website."'> ".$concert_unit->website."</a>" ;?></p>
        <p class="partager">Partager l'événement :</p>
        <div class="partage_reseaux">
        	<a href="https://twitter.com/share?text=Je vais participer au concert de <?php echo $concert_unit->titre ?>"  data-lang="en"><span class="twitter">twitter</span></a>
        	<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo current_url(); ?>" target="_blank"><span class="facebook">fb</span></a>
          	<a href="https://plus.google.com/share?url=http://127.0.0.1/slyset/index.php/concert/ <?php echo $concert_unit->id ?>" ><span class="google">g+</span></a>
  
                        </div>
                    </div>
                    <div class="plan_google">
                        <img src="http://maps.googleapis.com/maps/api/staticmap?center=<?php echo $concert_unit->numero_adresse . "+" . $concert_unit->voie_adresse . "+" . $concert_unit->ville ?>&zoom=16&size=233x198&maptype=roadmap&markers=size:mid%7Ccolor:red%7C<?php echo $concert_unit->numero_adresse . "+" . $concert_unit->voie_adresse . "+" . $concert_unit->ville ?>&sensor=false">

                    </div>
                </div>
                </div>
                <?php
            endforeach;
        }
        else {

            echo "<div class='text-empty'>Vous n'avez aucun concert à votre actif.</div>";
        }
        ?>





    </div>

    <?php if (isset($sidebar_right)) echo $sidebar_right; ?>

    <!--<div class="pagination">
        <a href="#" id="precedent"><span><</span></a>
        <a href="#" class="page">1</a>
        <a href="#" class="page">2</a>
        <a href="#" class="page">3</a>
        <a href="#" class="page">4</a>
        <a href="#" class="page">5</a>
        <a href="#" id="suivant"><span>></span></a>
    </div>-->

</div>