
<div id="contentAll">

  <div id="breadcrumbs">
    <ul>
      <li><a href="#">Accueil</a></li>
      <li><a href="#">Artistes</a></li>
      <li><a href="#">Bob Dylan</a></li>
      <li><a href="#">Concerts</a></li>
    </ul>
  </div>

  <div id="cover">
    <div id="infos-cover">
      <h2>Bob Dylan</h2>
    </div>
  </div>

  <div id="stats-cover">
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
    <div id="btn_tmp">
      <a href="<?php echo base_url('index.php/melo_concerts/index/'.$user_id) ?>"><img src="<?php echo img_url('musicien/filtre_avenir.png'); ?>" alt="A venir"/></a>
      <a href="<?php echo base_url('index.php/melo_concerts/concert_passe/'.$user_id) ?>"><img src="<?php echo img_url('musicien/filtre_passe.png'); ?>" alt="A venir"/></a>
    </div>
    <h2>Mes concerts passés </h2>
   
     <!-- Boucle : tous les concerts pour un artiste -->
   	  <?php 
  if($nbr_concert_par_melo!=0)
   { 

   	    foreach($concert_all as $concert_unit): ?>
 
  		<p  class="date-heure"><span><?php
		get_date($concert_unit->date,'complete');?> <?php if(isset($concert_unit->prix))echo ' - '.$concert_unit->prix.'&euro;'?></span></p>
   		 <hr/>
   			 <div class="infos_concert">
      			 <div class="calendrier"><p class="mois"><?php
		get_date($concert_unit->date,'mois_trois');?></p><p class="jour"><?php
	get_date($concert_unit->date,'jour_texte');?></p></div>
     			 <p><?php echo $concert_unit->titre ?></p>
     			 <p><?php if(isset($concert_unit->prix)) echo '+ '.$concert_unit->seconde_partie ?></p>
    		 </div>
   			 <div class="adr_concert">
     	 		<img src="<?php echo img_url('musicien/localisation.png'); ?>" />
    	 		<p class="adr_lieu"><?php echo $concert_unit->salle ?></p>
      	 		<p class="adr_rue"><?php if(isset($concert_unit->numero_adresse,$concert_unit->voie_adresse))echo $concert_unit->numero_adresse." ".$concert_unit->voie_adresse ?> <!--Bis Rue de Bagnolet--></p>
      			 <p class="adr_ville"><?php echo $concert_unit->ville.", ".$concert_unit->pays ?></p>
   		 	</div>
   		 <a href="javascript:void(0);" class="more" id="more_<?php echo $concert_unit->id ?>" onclick='showInfo(more_<?php echo $concert_unit->id ?>,more_info_<?php echo $concert_unit->id ?>)' >Voir plus d'informations</a>
    	 <a href="#" class="participer"><span class="button_left"></span><span class="button_center">J'y vais</span><span class="button_right"></span></a>
    
   
    
    
    <div class="info_sup" id="more_info_<?php echo $concert_unit->id ?>" style="display:none">
      <div class="informations">
        <p class="nom_date"><?php echo $concert_unit->titre.',' ?> <!--le 28/11/13 &agrave; 20h30--></p>
        <p class="lieu_salle"><?php echo $concert_unit->salle.',' ?></p>
        <p class="lieu_rue"><?php if(isset($concert_unit->numero_adresse,$concert_unit->voie_adresse))echo $concert_unit->numero_adresse." ".$concert_unit->voie_adresse."," ?> </p>
        <p class="lieu_ville"><?php if(isset($concert_unit->code_postal))echo $concert_unit->code_postal." ".$concert_unit->ville;?></p>
        <p class="tel"><?php if (isset($concert_unit->phone_number)) echo "Tel. : ".$concert_unit->phone_number ;?> </p>
        <p class="site"><?php if (isset($concert_unit->website)) echo "Site web :<a href='".$concert_unit->website."'> ".$concert_unit->website."</a>" ;?></p>
        <p class="partager">partager l'&eacute;v&egrave;nement :</p>
        <div class="partage_reseaux">
          <a href="#"><span class="twitter">twitter</span></a>
          <a href="#"><span class="facebook">fb</span></a>
          <a href="#"><span class="google">g+</span></a>
        </div>
      </div>
      <div class="plan_google">

      </div>
    </div>
 <?php endforeach; }
 else 
 {
 
 echo "Pas de concerts passés pour ".$info_user[0]->{'login'};
 }
 ?>
   

  
   
  
     </div>

  <?php if(isset($sidebar_right)) echo $sidebar_right; ?>

  <div class="pagination">
    <a href="#" id="precedent"><span><</span></a>
    <a href="#" class="page">1</a>
    <a href="#" class="page">2</a>
    <a href="#" class="page">3</a>
    <a href="#" class="page">4</a>
    <a href="#" class="page">5</a>
    <a href="#" id="suivant"><span>></span></a>
  </div>
  
</div>