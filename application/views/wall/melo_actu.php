<?php
    $session_id = $this->session->userdata('uid');
    $uid = (empty($session_id)) ? '' : $session_id;
    $uid_visit = (empty($infos_profile)) ? $session_id : $infos_profile->id;
    $login = (empty($infos_profile)) ? $this->session->userdata('login') : $infos_profile->login;
    $loger = $this->session->userdata('logged_in');
?>
<div id="contentAll">
    <!--<h1 class="hd">Votre fil d'actualité</h1>-->
    
    <div id="breadcrumbs">
        <ul>
            <li><a href="<?php echo site_url('home/' . $uid); ?>">Accueil</a></li>
            <li><a href="<?php echo site_url('my-wall/' . $uid_visit); ?>"><?php echo 'Mon compte'; ?></a></li>
            <li><a href="<?php echo site_url($this->uri->segment(1) . '/' . $uid_visit); ?>">Fil d'actualité</a></li>
        </ul>
    </div>

    <div id="cover" style="background-image:url(<?php echo files('profiles/' . $cover = (empty($infos_profile)) ? $this->session->userdata('cover') : $infos_profile->cover); ?>);">
        <div id="infos-cover">
            <h2><?php echo $login; ?></h2><!--
            <a href="#"><span class="button_left"></span><span class="button_center">Suivre</span><span class="button_right"></span></a> -->
                
            <?php if($loger == 1 && $infos_profile->id != $session_id): ?><a class="contact-user iframe" href="<?php echo site_url('contacter/'.$uid_visit); ?>"><span class="button_left_abonne"></span><span class="button_center_abonne">Contacter</span><span class="button_right_abonne"></span></a><?php endif; ?>
        </div>
    </div>

    <div id="stats-cover">
        <div class="stats_cover_block">
            <span class="stats_number">489</span>
            <span class="stats_title">écoutes</span>
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
    
    <div id="content" class="content">  
    <h1>Fil d'actualité</h1>
        <?php
     
         if (isset($data_all_wall)):
            foreach ($data_all_wall as $entity_wall):
            // ------------------------ PHOTO --------------------------

               if ($entity_wall->product == 1):
            // -------------- PHOTO : musicien a ajoute ---------------

                  if ($entity_wall->type == 'MU'):
                        ?>

                     <div id ="<?php echo $entity_wall->id ?>" class="artist_post photo_message">
                        <div class="top"   class="top" id="<?php echo $entity_wall->id ?>">

                           <?php if ($this->uri->segment(2) == $session_id): ?>
                              <a href="#"><img src="<?php echo img_url('musicien/btn_suppr.png'); ?>" alt="Suppression" /></a>
                           <?php endif; ?>

                        </div>
     
      						<div class="left">
       	 						<img src="<?php echo files('profiles/'.$entity_wall->thumb ); ?>" alt="Photo Profil" />
      						</div>
      						
      						<div class="right">
                           <span class="ico_citation"></span>
                           <p class="msg_post"><a href="<?php echo site_url('actualite/'.$entity_wall->Utilisateur_id)?>" ><?php echo $entity_wall->login ?></a> viens d’ajouter une photo :  <a class='iframe' href="<?php echo site_url('media/zoom/'.$entity_wall->idproduit.'/0') ?>"><?php echo $entity_wall->main_nom?></a></p>
                           <a class='iframe' href="<?php echo site_url('media/zoom/'.$entity_wall->idproduit.'/0') ?>">
                              <img src="<?php echo base_url('./files/'.$entity_wall->Utilisateur_id.'/photos/'.$entity_wall->file_name); ?>" alt="Photo message" class="single" />
      					      </a>
                        </div>
      						
      						<div class="bottom">

                           <span class="infos_publi"><?php echo $entity_wall->login ?> - 
        							   <?php	$date_format = (date_create($entity_wall->date, timezone_open('Europe/Paris')));
    					  			    $a =  date_timestamp_get($date_format);
            						echo $data['date_2'] = strftime('Le %d %B %G',$a); ?><!--Le 26 Septembre 2013-->
            					</span>
<!--
    							<span class="infos_publi">
                      <?php // print_r($entity_wall); ?><?php echo $entity_wall->login; ?> - <?php	$date_format = (date_create($entity_wall->date, timezone_open('Europe/Paris')));
                        $a =  date_timestamp_get($date_format);
                        echo $data['date_2'] = date('d-m-Y', strtotime(str_replace('-', '/', $entity_wall->date)));//strftime('Le %d %B %G',$a); ?>
                  </span>-->
      						</div>
    					   </div>

					    <?php
                  endif;
 					
                  if ($entity_wall->type == 'ME'):
      		
      		// ------------------------ PHOTO : J'ai liké (melo)--------------------------

            		    ?>
                     <div id ="<?php echo $entity_wall->id?>" class="artist_post photo_message">
      						<div class="top"   class="top" id="<?php echo $entity_wall->id?>">
                           <?php if ($this->uri->segment(2) == $session_id): ?>
    								   <a href="#"><img src="<?php echo img_url('musicien/btn_suppr.png'); ?>" alt="Suppression" /></a>
         						<?php endif;?>
      						</div>
     					
                        <div class="left">

                           <img src="<?php echo base_url('./files/profiles/'.$profile->thumb); ?>" alt="Photo Profil" />
      						</div>
      					
      						<div class="right">
      							<span class="ico_citation"></span>
        						    <p class="msg_post">Je viens d'aimer la photo de <a href="<?php echo base_url('/index.php/actualite/'.$entity_wall->Utilisateur_id) ?>"><?php echo $entity_wall->login ?></a> :  <a class = "iframe" href="<?php echo base_url('index.php/media/zoom/'.$entity_wall->idproduit.'/0') ?>"><?php echo $entity_wall->main_nom?></a></p>
      							<a class = "iframe" href="<?php echo base_url('index.php/media/zoom/'.$entity_wall->idproduit.'/0') ?>">
                              <img src="<?php echo base_url('./files/'.$entity_wall->Utilisateur_id.'/photos/'.$entity_wall->file_name); ?>" alt="Photo message" class="single" />
                           </a>
      							<!--  <img src="<?php echo base_url('./files/'.$entity_wall->Utilisateur_id.'/photos/'.$entity_wall->file_name); ?>" alt="Photo message" class="single" />
   								-->  
                        </div>
      					
      						<div class="bottom">
    							    <span class="infos_publi"><?php echo $this->uri->segment('')?><!--  - -->  <?php	$date_format = (date_create($entity_wall->date, timezone_open('Europe/Paris')));
    					  		     $a =  date_timestamp_get($date_format);
            					 echo $data['date_2'] = strftime('Le %d %B %G',$a);?><!--Le 26 Septembre 2013--></span>
  							   </div>
<!--
    							<span class="infos_publi">
                      <?php // print_r($entity_wall); ?><?php echo $entity_wall->login; ?> - <?php	$date_format = (date_create($entity_wall->date, timezone_open('Europe/Paris')));
                        $a =  date_timestamp_get($date_format);
                        echo $data['date_2'] = date('d-m-Y', strtotime(str_replace('-', '/', $entity_wall->date)));//strftime('Le %d %B %G',$a); ?>
                  </span>
  							</div>-->
   						</div>
 
 					      <?php
 					   endif;
               endif;
            // ------------------------ VIDEO --------------------------
               if($entity_wall->product==2):
			         // ------------------------ VIDEO : J'ai liké (melo)--------------------------

                  if($entity_wall->type =='ME'):
 					   ?>
 						<!-- ******* ******* ***** LIKE D'UNE VIDEO  ******* ******* **** -->

						   <div id ="<?php echo $entity_wall->id?>" class="artist_post photo_message">
     						 <div class="top"   class="top" id="<?php echo $entity_wall->id?>">
            					<?php if($this->uri->segment(2)==$this->session->userdata('uid')):
?>
        							<a href="#"><img src="<?php echo img_url('musicien/btn_suppr.png'); ?>" alt="Suppression" /></a>
         						<?php endif;?>

     						</div>
      						<div class="left">

	       						<img src="<?php echo base_url('./files/profiles/'.$profile->thumb); ?>" alt="Photo Profil" />
    	 					</div>
      						<div class="right">
        						<span class="ico_citation"></span>
        						<p class="msg_post">Je viens d'aimer la video de <a href="<?php echo base_url('/index.php/actualite/'.$entity_wall->Utilisateur_id) ?>"><?php echo $entity_wall->login ?></a> :  <a href="<?php echo 'http://www.youtube.com/v/'.$entity_wall->file_name.'?version=3' ?>"><?php echo $entity_wall->main_nom?></a></p>
     							<iframe id="ytplayer" type="document" width="455" height="350" src="http://www.youtube.com/v/<?php echo $entity_wall->file_name ?>?version=3" /></iframe>

	    					</div>
    	  					<div class="bottom">
    							<span class="infos_publi">
                      <?php // print_r($entity_wall); ?><?php echo $entity_wall->login; ?> - <?php	$date_format = (date_create($entity_wall->date, timezone_open('Europe/Paris')));
                        $a =  date_timestamp_get($date_format);
                        echo $data['date_2'] = date('d-m-Y', strtotime(str_replace('-', '/', $entity_wall->date)));//strftime('Le %d %B %G',$a); ?>
                  </span>
     						</div>
   						</div>

 					<?php		
   					endif;
   			
   					if($entity_wall->type =='MU'):	
						 ?>
 						<!-- ******* ******* ***** AJOUT D'UNE VIDEO  ******* ******* **** -->

						<div id ="<?php echo $entity_wall->id?>" class="artist_post photo_message">
      						<div class="top"   class="top" id="<?php echo $entity_wall->id?>">
            					<?php if($this->uri->segment(2)==$this->session->userdata('uid')):
									?>
        							<a href="#"><img src="<?php echo img_url('musicien/btn_suppr.png'); ?>" alt="Suppression" /></a>
         						<?php endif;?>

      						</div>
      						
      						<div class="left">
        						<img src="<?php echo files('profiles/'.$entity_wall->thumb); ?>" alt="Photo Profil" />
     	 					</div>
      						
      						<div class="right">
        						<span class="ico_citation"></span>
       							<p class="msg_post"><a href="<?php echo site_url('actualite/'.$entity_wall->Utilisateur_id)?>" ><?php echo $entity_wall->login ?></a> viens d’ajouter une video :  <a href="<?php echo 'http://www.youtube.com/v/'.$entity_wall->file_name.'?version=3' ?>"><?php echo $entity_wall->main_nom?></a></p>
      	 						<iframe id="ytplayer" type="document" width="455" height="350" src="http://www.youtube.com/v/<?php echo $entity_wall->file_name ?>?version=3" /></iframe>
      
      						</div>
      						<div class="bottom">
    							<span class="infos_publi">
                      <?php // print_r($entity_wall); ?><?php echo $entity_wall->login; ?> - <?php	$date_format = (date_create($entity_wall->date, timezone_open('Europe/Paris')));
                        $a =  date_timestamp_get($date_format);
                        echo $data['date_2'] = date('d-m-Y', strtotime(str_replace('-', '/', $entity_wall->date)));//strftime('Le %d %B %G',$a); ?>
                  </span>
      						</div>
    					</div>
 					<?php	
   					endif;
  				endif;
  			  	
  			  	// ------------------------ CONCERT --------------------------
  		if($entity_wall->product==3):
  			if($entity_wall->type =='ME'):
  			?>
  			 	<!-- ******* ******* ***** CONCERT Je  participee  ******* ******* **** -->

  				<div  id ="<?php echo $entity_wall->id?>" class="artist_post photo_message">
     	 			<div class="top"   class="top" id="<?php echo $entity_wall->id?>">
        				<?php if($this->uri->segment(2)==$this->session->userdata('uid')):
?>
    						<a href="#"><img src="<?php echo img_url('musicien/btn_suppr.png'); ?>" alt="Suppression" /></a>
         				<?php endif;?>

      				</div>
     					
     				<div class="left">

        				<img src="<?php echo base_url('./files/profiles/'.$profile->thumb); ?>" alt="Photo Profil" />
      				</div>
      					
      				<div class="right">
      					<span class="ico_citation"></span>
        				<p class="msg_post">Je participe au concert de  <a href="<?php echo base_url('/index.php/actualite/'.$entity_wall->Utilisateur_id) ?>"><?php echo $entity_wall->login ?></a>, à <?php echo $entity_wall->ville ?>   
      					<!--  <img src="<?php echo base_url('./files/'.$entity_wall->Utilisateur_id.'/photos/'.$entity_wall->file_name); ?>" alt="Photo message" class="single" />
   						-->  
   						</br></br>
   						<div id="concert_detail_calendar">
   							<div class="calendar">
   								<div class="calendar-mois">
   							   	<?php $date_format = (date_create($entity_wall->date_concert, timezone_open('Europe/Paris')));
    					  		$a =  date_timestamp_get($date_format);
            					echo $data['date_2'] = '<a>'.strtoupper(strftime('%b',$a)).'</a>';
            					?>
            					</div>
            					<div class="calendar-jour">
   							   
            					<?php $date_format = (date_create($entity_wall->date_concert, timezone_open('Europe/Paris')));
    					  		$a =  date_timestamp_get($date_format);
            					echo $data['date_2'] = '<a>'.strftime('%d',$a).'</a>';
            					?>
   							</div>
   							</div>
   							<div class="calendar-content">
   								<?php echo $entity_wall->login ?>
   								</br>
   								<a href="<?php echo base_url("index.php/concert/".$entity_wall->Utilisateur_id.'/#'.$entity_wall->idproduit)?>">
   									<?php echo $entity_wall->salle?> - <?php echo $entity_wall->ville?>
   								
   								</br>
   								<?php $date_format = (date_create($entity_wall->date_concert, timezone_open('Europe/Paris')));
    					  		$a =  date_timestamp_get($date_format);
            					echo $data['date_2'] = strftime('Le %d %B %G',$a);
            					?>
                      </a>
    						</div>
    					</div>
    					</p>
    				</div>
      					
      				<div class="bottom">
    							<span class="infos_publi">
                      <?php // print_r($entity_wall); ?><?php echo $entity_wall->login; ?> - <?php	$date_format = (date_create($entity_wall->date, timezone_open('Europe/Paris')));
                        $a =  date_timestamp_get($date_format);
                        echo $data['date_2'] = date('d-m-Y', strtotime(str_replace('-', '/', $entity_wall->date)));//strftime('Le %d %B %G',$a); ?>
                  </span>
  					</div>
   				</div>
  			
  			<?php
  			endif;
  			
  			if($entity_wall->type =='MU'):
  			?>
  			 <!-- ******* ******* ***** CONCERT AJout par musicien  ******* ******* **** -->

  				<div id ="<?php echo $entity_wall->id?>" class="artist_post photo_message">
      				<div class="top"   class="top" id="<?php echo $entity_wall->id?>">
        				<?php if($this->uri->segment(2)==$this->session->userdata('uid')):
?>
    						<a href="#"><img src="<?php echo img_url('musicien/btn_suppr.png'); ?>" alt="Suppression" /></a>
         				<?php endif; ?>

      				</div>
     					
     				<div class="left">

        				<img src="<?php echo base_url('./files/profiles/'.$entity_wall->thumb); ?>" alt="Photo Profil" />
      				</div>
      					
      				<div class="right">
      					<span class="ico_citation"></span>
      					<p class="msg_post"><a href="<?php echo base_url('/index.php/actualite/'.$entity_wall->Utilisateur_id) ?>"><?php echo $entity_wall->login ?></a> vient d'ajouter un concert  :

      					
      					</br></br>
   						<div id="concert_detail_calendar">
   							<div class="calendar">
   							<div class="calendar-mois">
   							   	<?php $date_format = (date_create($entity_wall->date_concert, timezone_open('Europe/Paris')));
    					  		$a =  date_timestamp_get($date_format);
            					echo $data['date_2'] = '<a>'.strtoupper(strftime('%b',$a)).'</a>';
            					?>
            					</div>
            					   							<div class="calendar-jour">

            					<?php $date_format = (date_create($entity_wall->date_concert, timezone_open('Europe/Paris')));
    					  		$a =  date_timestamp_get($date_format);
            					echo $data['date_2'] = '<a>'.strftime('%d',$a).'</a>';
            					?>
   							</div>
   							</div>
   							<div class="calendar-content">
   								<?php echo $entity_wall->login ?>
   								</br>
   								<a href="<?php echo base_url("index.php/concert/".$entity_wall->Utilisateur_id.'/#'.$entity_wall->idproduit)?>">
   									<?php echo $entity_wall->salle?> - <?php echo $entity_wall->ville?>
   								</a>
   								</br>
   								<?php $date_format = (date_create($entity_wall->date_concert, timezone_open('Europe/Paris')));
    					  		$a =  date_timestamp_get($date_format);
            					echo $data['date_2'] = '<a>'.strftime('Le %d %B %G',$a).'</a>';
            					?>
    						</div>
    					</div>
    					</p>
    				</div>
      					
      				
      					
      				<div class="bottom">
    							<span class="infos_publi">
                      <?php // print_r($entity_wall); ?><?php echo $entity_wall->login; ?> - <?php	$date_format = (date_create($entity_wall->date, timezone_open('Europe/Paris')));
                        $a =  date_timestamp_get($date_format);
                        echo $data['date_2'] = date('d-m-Y', strtotime(str_replace('-', '/', $entity_wall->date)));//strftime('Le %d %B %G',$a); ?>
                  </span>
  					</div>
   				</div>
  			
  			<?php
  			endif;
  		endif;
  		 
  		 
  		 // ------------------------ MESSAGE --------------------------

  		if($entity_wall->product==4):
  			if($entity_wall->type =='MU'):
  			?>
  				<div id ="<?php echo $entity_wall->id?>" class="artist_post photo_message">
      				<div class="top" class="top" id="<?php echo $entity_wall->id?>">
        				<?php 
        				if($this->uri->segment(2)==$this->session->userdata('uid')):
?>
    						<a href="#"><img src="<?php echo img_url('musicien/btn_suppr.png'); ?>" alt="Suppression" /></a>
         				<?php endif;?>

      				</div>
     					
     				<div class="left">

        				<img src="<?php echo files('profiles/'.$entity_wall->thumb); ?>" alt="Photo Profil" />
      				</div>
      					
      				<div class="right">
      					<span class="ico_citation"></span>
        				<p class="msg_post">
   							<?php echo $entity_wall->main_nom?> 
   						</p>
    				</div>
      					
      				<div class="bottom">
    							<span class="infos_publi">
                      <?php // print_r($entity_wall); ?><?php echo $entity_wall->login; ?> - <?php	$date_format = (date_create($entity_wall->date, timezone_open('Europe/Paris')));
                        $a =  date_timestamp_get($date_format);
                        echo $data['date_2'] = date('d-m-Y', strtotime(str_replace('-', '/', $entity_wall->date)));//strftime('Le %d %B %G',$a); ?>
                  </span>
  					</div>
   				</div>
  			
  			<?php
  			endif;	
  		endif;
		
		
		// ------------------------ ALBUM --------------------------

		if($entity_wall->product==5):
		// ------------------------ ALBUM MUSICIEN --------------------------

  			if($entity_wall->type =='MU'):
  				foreach($photo_by_album as $key => $photo_album):
  					if($photo_album[0]->albums_media_file_name == $entity_wall->idproduit):
?>	
    					<div class="artist_post photo_message" id ="<?php echo $entity_wall->id?>" >
      						<div class="top" class="top" id="<?php echo $entity_wall->id?>">
        						<a href="#"><img src="<?php echo img_url('musicien/btn_suppr.png'); ?>" alt="Suppression" /></a>
      						</div>
      						<div class="left">
        						<img src="<?php echo files('profiles/'.$entity_wall->thumb); ?>" alt="Photo Profil" />
      						</div>
      						<?php 
                       
                        if (count($photo_album)>1): 
                        ?>
      							<div class="right">

 							   		<span class="ico_citation"></span>
        							<p class="msg_post">
        								<a href="<?php echo base_url('/index.php/actualite/'.$entity_wall->Utilisateur_id) ?>"><?php echo $entity_wall->login; ?></a> vient d’ajouter <?php echo count($photo_album) ?> photos à son album <a href="<?php echo base_url('index.php/album/'.$entity_wall->Utilisateur_id.'/'.$photo_album[0]->albums_media_file_name)?>">“<?php echo $entity_wall->main_nom; ?>”</a>
       								</p>
        						<div class="content-mosaic">
        						<?php 
                         $n_p = 0;
                          foreach($photo_album as $photo):
                         $n_p ++;
        						?>
                                                    <?php echo $n_p; ?>

                           <a class="iframe" href="<?php echo site_url('media/zoom/' . $photo->id_produit . '/0') ?>">

        							<img src="<?php echo base_url('files/'.$entity_wall->Utilisateur_id.'/photos/'.$entity_wall->idproduit.'/'.$photo->file_name); ?>" alt="<?php echo $photo->nom ?>" class="mosaic first" />
          						</a>

                           <?php if ($n_p == 4)
                           {

                           break;
                           }
                           ?>
                           <?php endforeach; ?>
                           <?php if ($n_p < 4)
                           {
                              ?>
                              <div class='album_flux_empty_alb'>
                              </div>

<?php
                           }
                           ?>
          					</div>
      					</div>
      
                    <?php endif;
                    if (count($photo_album)==1):
                    ?>
                        <div class="right">
         
                            <span class="ico_citation"></span>
                            <p class="msg_post"><a href="<?php echo base_url('/index.php/actualite/'.$entity_wall->Utilisateur_id) ?>"><?php echo $entity_wall->login;?></a> vient d’ajouter <?php echo count($photo_album) ?> photo à son album <a href="<?php echo base_url('index.php/album/'.$entity_wall->Utilisateur_id.'/'.$photo_album[0]->albums_media_file_name)?>">“<?php echo $entity_wall->main_nom ?>”</a></p>      
                            <!--<a href="<?php echo site_url('media/zoom/'.$entity_wall->idproduit.'/0') ?>">-->
                           <a class="iframe" href="<?php echo site_url('media/zoom/' . $photo_album[0]->id_produit . '/0') ?>">
                              <img src="<?php echo base_url('./files/'.$entity_wall->Utilisateur_id.'/photos/'.$photo_album[0]->albums_media_file_name.'/'.$photo_album[0]->file_name); ?>" alt="Photo message" class="single" /> 
                           </a>
                            <!--</a>-->
                        </div>
        <?php endif; ?>
      
      <div class="bottom">
    							<span class="infos_publi">
                      <?php // print_r($entity_wall); ?><?php echo $entity_wall->login; ?> - <?php	$date_format = (date_create($entity_wall->date, timezone_open('Europe/Paris')));
                        $a =  date_timestamp_get($date_format);
                        echo $data['date_2'] = date('d-m-Y', strtotime(str_replace('-', '/', $entity_wall->date)));//strftime('Le %d %B %G',$a); ?>
                  </span>
      </div>
    </div>
  					
  					<?php endif; ?>
  				<?php endforeach; ?>
  			<?php endif; ?>
  			
  				<?php if($entity_wall->type =='ME'): ?>
  						<div id="<?php echo $entity_wall->id ?>" class="artist_post photo_message">
      <div class="top"  class="top" id="<?php echo $entity_wall->id?>">
            			<?php if($this->uri->segment(2)==$this->session->userdata('uid')):
?>
        					<a href="#"><img src="<?php echo img_url('musicien/btn_suppr.png'); ?>" alt="Suppression" /></a>
         				<?php endif;?>

     				</div>
      				<div class="left">

       					<img src="<?php echo base_url('./files/profiles/'.$profile->thumb); ?>" alt="Photo Profil" />
     				</div>
      				<div class="right">
        				<span class="ico_citation"></span>
        				<p class="msg_post">Je viens d'aimer l'album de <?php echo $entity_wall->login ?> :  <a href="#"><?php echo $entity_wall->main_nom?></a></p>
     					 <!--  <img src="<?php echo base_url('./files/'.$entity_wall->Utilisateur_id.'/photos/'.$entity_wall->file_name); ?>" alt="Photo message" class="single" />
    					-->  
    				</div>
      				<div class="bottom">
    							<span class="infos_publi">
                      <?php // print_r($entity_wall); ?><?php echo $entity_wall->login; ?> - <?php	$date_format = (date_create($entity_wall->date, timezone_open('Europe/Paris')));
                        $a =  date_timestamp_get($date_format);
                        echo $data['date_2'] = date('d-m-Y', strtotime(str_replace('-', '/', $entity_wall->date)));//strftime('Le %d %B %G',$a); ?>
                  </span>
     				</div>
   				</div>
<?php
  			endif;
  			endif;

        if($entity_wall->product==6):
            if($entity_wall->type =='ME'):
               ?>
          <div id ="<?php echo $entity_wall->id?>" class="artist_post photo_message">
                  <div class="top" class="top" id="<?php echo $entity_wall->id?>">
                  <?php 
                  if($this->uri->segment(2)==$this->session->userdata('uid')):
?>
                     <a href="#"><img src="<?php echo img_url('musicien/btn_suppr.png'); ?>" alt="Suppression" /></a>
                     <?php endif;?>

                  </div>
                  
               <div class="left">

                  <img src="<?php echo files('profiles/'.$entity_wall->thumb); ?>" alt="Photo Profil" />
                  </div>
                     
                  <div class="right">
                     <span class="ico_citation"></span>
                  <p class="msg_post">
                        Je viens d'ajouter un morceau à ma playlist : <a href="<?php echo base_url('/index.php/my-playlists/'.$entity_wall->Utilisateur_id) ?>"><?php echo $entity_wall->playlist?> </a>

                        <p class="play_img">
                           <a class="open_player" href="<?php echo base_url('index.php/mc_musique/player/'.$entity_wall->Utilisateur_id.'/playlist/'.$entity_wall->playlist.'/'.$entity_wall->idproduit) ?>">
                           
                              <img  src="<?php echo base_url('assets/images/sidebar-right/lecture.png')?>">
                           </a>
                           <p class="info_morceau"><?php echo $entity_wall->login ?> - <?php echo $entity_wall->main_nom ?> </p>
                        </p>
                     </p>
               </div>
                     
                  <div class="bottom">
                  <span class="infos_publi"><?php echo $entity_wall->login?> - <?php 
                     $date_format = (date_create($entity_wall->date, timezone_open('Europe/Paris')));
                     $a =  date_timestamp_get($date_format);
                        echo $data['date_2'] = strftime('Le %d %B %G',$a);

                     ?><!--Le 26 Septembre 2013-->
                  </span>
               </div>
               </div><?php 
        endif;
          


           if($entity_wall->type =='MU'):
               ?>
          <div id ="<?php echo $entity_wall->id?>" class="artist_post photo_message">
                  <div class="top" class="top" id="<?php echo $entity_wall->id?>">
                  <?php 
                  if($this->uri->segment(2)==$this->session->userdata('uid')):
?>
                     <a href="#"><img src="<?php echo img_url('musicien/btn_suppr.png'); ?>" alt="Suppression" /></a>
                     <?php endif;?>

                  </div>
                  
               <div class="left">

                  <img src="<?php echo files('profiles/'.$entity_wall->thumb); ?>" alt="Photo Profil" />
                  </div>
                     
                  <div class="right">
                     <span class="ico_citation"></span>
                  <p class="msg_post">
                        <a href="<?php echo base_url('index.php/actualite/'.$entity_wall->Utilisateur_id)?>"><?php echo $entity_wall->login ?></a> vient d'ajouter un morceau à son album : <a href="<?php echo base_url('/index.php/musique/'.$entity_wall->Utilisateur_id) ?>"><?php echo $entity_wall->name_alb?> </a>

                        <p class="play_img">
                           <a class="open_player" href="<?php echo base_url('index.php/mc_musique/player/'.$entity_wall->Utilisateur_id.'/playlist/'.$entity_wall->playlist.'/'.$entity_wall->idproduit) ?>">
                              <img src="<?php echo base_url('assets/images/sidebar-right/lecture.png')?>">
                            </a>
                           <p class="info_morceau"><?php echo $entity_wall->login ?> - <?php echo $entity_wall->main_nom ?> </p>
                        </p>
                     </p>
               </div>
                     
                  <div class="bottom">
                  <span class="infos_publi"><?php echo $entity_wall->login?> - <?php 
                     $date_format = (date_create($entity_wall->date, timezone_open('Europe/Paris')));
                     $a =  date_timestamp_get($date_format);
                        echo $data['date_2'] = strftime('Le %d %B %G',$a);

                     ?><!--Le 26 Septembre 2013-->
                  </span>
               </div>
               </div><?php 
        endif;
          endif;
  			
 	endforeach;
 endif; ?>
 
<div class="ajax_loader2"></div>
 
<?php if(empty($data_all_wall)):
    ?><div class="artist_post photo_message">
    <?php echo $login; ?> n'a aucune actualité
    </div>
<?php

 endif;
 ?>
   </div>

 



<?php if (isset($sidebar_right)) echo $sidebar_right; ?>

  
</div>
