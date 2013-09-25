<div id="fb-root"></div>


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
            <li><a href="<?php echo site_url($this->uri->segment(1) . '/' . $uid_visit); ?>">Concerts</a></li>
        </ul>
  </div>

  <div id="cover" style="background-image:url(<?php print files('profiles/'.$cover = (empty($infos_profile)) ? $this->session->userdata('cover') : $infos_profile->cover); ?>);">
    <div id="infos-cover">
        	<h2>
        	<?php print $login = (empty($infos_profile)) ? $this->session->userdata('login') : $infos_profile->login; ?></h2>    
			<?php 
     		if($loger==1&&$infos_profile->id != $session_id&&$infos_profile->type==2&&substr_count($community_follower,$infos_profile->id)==0): ?>
      			<a href="#" class="add-follow" id="<?php echo $this->uri->segment(2)?>"><span class="button_left"></span><span class="button_center">Suivre</span><span class="button_right"></span></a>
   			<?php endif;
     		if($loger==1&&$infos_profile->id != $session_id&&($infos_profile->type==2)&&(substr_count($community_follower,$infos_profile->id)>0)): ?>
     			<a href="#" class="delete-follow" id="<?php echo $this->uri->segment(2)?>"><span class="button_left_abonne"></span><span class="button_center_abonne">Ne plus suivre</span><span class="button_right_abonne"></span></a>
    		<?php endif;?>
                
            <?php if($loger == 1 && $infos_profile->id != $session_id): ?><a class="contact-user iframe" href="<?php echo site_url('contacter/'.$uid_visit); ?>"><span class="button_left_abonne"></span><span class="button_center_abonne">Contacter</span><span class="button_right_abonne"></span></a><?php endif; ?>
        </div>
    </div>

    <div id="stats-cover">
                <div class="stats_cover_block">
            <span class="stats_number">
                <?php
                $nab = 0;
                if(empty($all_follower)!=1):
                    $nab =  count($all_follower);
                endif;
                echo $nab;
                 ?>
            </span>       
            <span class="stats_title">
                <?php
                if($nab == 0 || $nab == 1){
                    echo 'abonné';
                }
                else
                {
                    echo 'abonnés';
                }
                ?>
            </span>
        </div>
        
        <div class="stats_cover_block">
            <span class="stats_number"><?php print $album_nbr[0]->n_alb;?></span>
            <span class="stats_title">
                <?php
                if($album_nbr[0]->n_alb == 0 || $album_nbr[0]->n_alb == 1){
                    echo 'album';
                }
                else
                {
                    echo 'albums';
                }
                ?>
            
            </span>
        </div>

        <div class="stats_cover_block">
             <span class="stats_number">
                <?php
                $nm = 0;
                if(empty($all_morceau_artiste)!=1):
                    $nm =  count($all_morceau_artiste);
                endif;
                echo $nm;
                 ?>
            </span>       
            <span class="stats_title">
                <?php
                if($nm == 0 || $nm == 1){
                    echo 'morceau';
                }
                else
                {
                    echo 'morceaux';
                }
                ?>
            </span>
        </div>
   
  </div>
    
	<div class="bts_noir">
		<?php if ($infos_profile->id == $uid) { ?>
			<div class="bt_noir">
				<a class="iframe" href="<?php echo site_url('concert/ajouter/' . $infos_profile->id) ?>"><span class="bt_left"></span><span class="bt_middle">Ajouter un concert</span><span class="bt_right"></span></a>
			</div>
		<?php } 
			else {
				// y mettre les bouton des melomanes : suivre ect
			} ?>
	 </div>

    <div class="content">
        <div id="btn_tmp">
            <a href="<?php echo site_url('concert/' . $infos_profile->id) ?>"><div class="avenir actif">&Aacute; venir</div></a>
            <a href="<?php echo site_url('concert/archive/' . $infos_profile->id) ?>"><div class="cpasse">Concerts passés</div></a>
		</div>
   
   	 	<h1>Les concerts de <?php echo $infos_profile->login; ?> &agrave; venir</h1>
   
     	<!-- Boucle : tous les concerts pour un artiste -->
   	  	<?php 
		if($nbr_concert_par_artiste != 0)
   		{ 
   	   		foreach($concert_all as $concert_unit): ?>
        <div class="concert-wrapper">
  				<p id='<?php echo $concert_unit->id;?>' class="date-heure">
  					<span><?php
						get_date($concert_unit->date,'complete');?> <?php if(isset($concert_unit->prix))echo ' - '.$concert_unit->prix.'&euro;'?>
					</span>
				</p>
				<?php
  		 		if( $this->uri->segment(2) ==$this->session->userdata('uid'))
  		 		{ ?>
   					<div class="edition">
   		 				<a class="iframe" href="<?php echo base_url('index.php/concert/modifier/'.$infos_profile->id.'/'.$concert_unit->id.'/'.$concert_unit->Adresse_id );?>">
   		 					<span class="edit">editer</span>
   		 				</a>
   		 				<a class="iframe" href="<?php echo base_url('index.php/concert/supprimer/'.$infos_profile->id.'/'.$concert_unit->id.'/'.$concert_unit->Adresse_id );?>">
   		 					<span class="suppr">supprimer</span>
   		 				</a>
   					</div>

   		<?php }?> <hr/>	 
   			 <div class="infos_concert">
      			 <div class="calendrier"><p class="mois"><?php
					get_date($concert_unit->date,'mois_trois');?></p><p class="jour"><?php
					get_date($concert_unit->date,'jour_texte');?></p></div>
     			 <p><?php echo $concert_unit->titre ?></p>
     			 <p><?php if(isset($concert_unit->seconde_partie)) echo '+ '.$concert_unit->seconde_partie ?></p>
     			 <?php      			 $nparticipant = '0 participant';

     			 foreach($publics as $public):
     			 if($public->concerts_id == $concert_unit->id):
     			 if($public->nperson == 1): $nparticipant =  $public->nperson.' participant'; endif;$nparticipant =  $public->nperson.' participants';  endif;
     			
     			  endforeach;
     			   ?><p> <?php echo $nparticipant;?></p>
    		 </div>
   			 <div class="adr_concert">
     	 		<img src="<?php echo img_url('musicien/localisation.png'); ?>" alt="Adresse concert" />
    	 		<p class="adr_lieu"><?php echo $concert_unit->salle ?></p>
      	 		<p class="adr_rue"><?php if(isset($concert_unit->numero_adresse,$concert_unit->voie_adresse))echo $concert_unit->numero_adresse." ".$concert_unit->voie_adresse ?> <!--Bis Rue de Bagnolet--></p>
      			 <p class="adr_ville"><?php echo $concert_unit->ville.", ".$concert_unit->pays ?></p>
   		 	</div>
   		 <a href="javascript:void(0);" class="more" id="more_<?php echo $concert_unit->id ?>" onclick='showInfo(more_<?php echo $concert_unit->id ?>,more_info_<?php echo $concert_unit->id ?>)' >Voir plus d'informations</a>
    	    	<div id="concert_activity>">

    	<?php 
    	$count = substr_count($all_concert_act,$concert_unit->id.'/');
    	if ($count>=1)
    	{?>
    	    		<a id="<?php echo $concert_unit->id;?>" href="#" class="noparticiper"><span class="button_left"></span><span  class="button_center">J'y vais</span><span class="button_right"></span></a>

    	<?php
    	}
    	else{?>
    	    	 	<a id="<?php echo $concert_unit->id;?>" href="#" class="participer"><span class="button_left_red"></span><span  class="button_center_red">Je veux y aller</span><span class="button_right_red"></span></a>

		<?php }
    	 ?> 
    	 </div>

  
    
    <div class="info_sup" id="more_info_<?php echo $concert_unit->id ?>" style="display:none">
      <div class="informations">
        <p class="nom_date"><?php echo $concert_unit->titre.',' ?> <!--le 28/11/13 &agrave; 20h30--></p>
        <p id='<?php echo $concert_unit->id;?>' class="lieu_salle">
  					<span><?php
						get_date($concert_unit->date,'complete');?>
					</span>
				</p>
        <p class="lieu_salle"><?php echo $concert_unit->salle.',' ?></p>
        <p class="lieu_rue"><?php if(isset($concert_unit->numero_adresse,$concert_unit->voie_adresse))echo $concert_unit->numero_adresse." ".$concert_unit->voie_adresse."," ?> </p>
        <p class="lieu_ville"><?php if(isset($concert_unit->code_postal))echo $concert_unit->code_postal." ".$concert_unit->ville;?></p>
        <p class="tel"><?php if (isset($concert_unit->phone_number)) echo "Tel. : ".$concert_unit->phone_number ;?> </p>
        <p class="site"><?php if (isset($concert_unit->website)) echo "Site web :<a href='.$concert_unit->website.'> ".$concert_unit->website."</a>" ;?></p>
        <p class="partager">Partager l'événement :</p>
        <div class="partage_reseaux">
          
          	<a href="https://twitter.com/share?text=Je vais participer au concert de <?php echo $concert_unit->titre ?>"  data-lang="en"><span class="twitter">twitter</span></a>
        	<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo current_url(); ?>" target="_blank"><span class="facebook">fb</span></a>
          	<a href="https://plus.google.com/share?url=<?php echo base_url('index.php/concert/'.$concert_unit->id);?>" ><span class="google">g+</span></a>
      


                        </div>
                    </div>
                    <div id="plan_google">
                        <img src="http://maps.googleapis.com/maps/api/staticmap?center=<?php echo $concert_unit->numero_adresse . "+" . $concert_unit->voie_adresse . "+" . $concert_unit->ville ?>&zoom=16&size=233x198&maptype=roadmap&markers=size:mid%7Ccolor:red%7C<?php echo $concert_unit->numero_adresse . "+" . $concert_unit->voie_adresse . "+" . $concert_unit->ville ?>&sensor=false" alt="GoogleMap">
                    </div>
                </div>
        </div>
    <?php
    endforeach;
}
else {
    echo "<div class='text-empty'>" . $login . " n'a aucun concert à venir.</div>";
}
?>



    </div>

<?php if (isset($sidebar_right)) echo $sidebar_right; ?>

</div>
