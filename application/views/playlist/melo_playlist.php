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
            <li><a href="<?php echo site_url($this->uri->segment(1) . '/' . $uid_visit); ?>">Mes playlists</a></li>
        </ul>
    </div>
  
    <div id="cover" style="background-image:url(<?php echo files('profiles/'.$cover = (empty($infos_profile)) ? $this->session->userdata('cover') : $infos_profile->cover); ?>);">
        <div id="infos-cover">
            <h2><?php echo $login; ?></h2>
            <!--
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
	<h1>Mes playlists</h1>
	
	    <?php 
	    if(empty($playlists)!=1):
	    	foreach ($playlists as $playlist): ?>

				<div class="playlist">
				
					<div class="visu_playlist">
						<?php $cover = 'sidebar-right/default-photo-profil.png'; 
						if($playlist->img_cover != null)
						{ ?>
						<img src="<?php echo base_url('files/'.$playlist->user_alb.'/musique/'.strtolower(str_replace(' ','_',$playlist->name_alb)).'/'.$playlist->img_cover) ; ?>" alt="Couverture playlist"/>

						<?php
						}
						else
						{
						?>
						<img src="<?php echo img_url($cover) ; ?>" alt="Couverture defaut"/>
						<?php 
						}
						?>
						
					</div>
					<div class="descri_playlist">
					<form>
						<span class="nom_pl"><?php echo $playlist->nom?></span>
					</form>
						<span class="detail_pl"><?php echo $playlist->n_morceau;  if($playlist->n_morceau > 1){echo ' chansons';} else {echo ' chanson';} ?> </span>
						<span class="detail_pl"><?php echo $playlist ->n_artiste ;if($playlist->n_artiste > 1){echo ' artistes';} else {echo ' artiste';} ?></span>
						<div class="edit">
							<a class="edit-pl" href="javascript:void(0)"><img src="<?php echo img_url('musicien/btn_edit.png'); ?>"/></a>
			 				<a class='iframe' href="<?php echo site_url('my-playlists/delete/'.$playlist->nom)?>"><img src="<?php echo img_url('musicien/btn_suppr.png'); ?>"/></a>
						</div>
						<hr/>
						<div class="lecture_pl">
                            <a href="<?php echo site_url('mc_musique/player/'.$this->session->userdata('uid').'/playlist/'.$playlist->nom); ?>" class="open_player">
                                <img src="<?php echo img_url('musicien/player_top2.png'); ?>" alt="Lecture"/>
								<span class="ecouter_pl">Ecouter toute la playlist</span>
							</a>
						</div>
					</div>
					<div class="clear"></div>
					<div id="articles-tab">
            <input type="button" value="Acheter" class="cadis_pl">
            <input type="button" value="Supprimer" class="bt_supp_playlist">
            
						<form action="<?php echo site_url('admin_articles/delete_multi_article'); ?>" method="post" accept-charset="utf-8">          
							<table id="tablesorter-cb">
                <thead>
                    <tr class="tab-head">
                        <th class="article-checkbox checkbox-style2"><input type="checkbox" name="article-all" value="all" class="check_all checkbox-article" id="article-all"><label for="article-all"></label></th>
                        <th class="article-title">Titre</th>
                        <th class="article-album">Artiste</th>
                        <th class="article-album">Album</th>
                        <th class="article-date">Durée</th>
                    </tr>
                </thead>
                  
								<tbody>
									<?php 
									foreach ($morceaux_playlist as $key => $morceaux):
                      $last_key = end(array_keys($morceaux_playlist));
                  
   										if($morceaux->nom == $playlist->nom ): ?>

											<tr class="even row-color-<?php echo $morceaux->Morceaux_id ?>" id='<?php echo $morceaux->Morceaux_id ?>'>
												<td class="article-checkbox checkbox-style2"><input type="checkbox" name="checkarticle[]" value="<?php echo $morceaux->Morceaux_id.$playlist->nom ?>" id="article-<?php echo $morceaux->Morceaux_id.$playlist->nom ?>" class="checkbox-article"><label for="article-<?php echo $morceaux->Morceaux_id.$playlist->nom ?>"></label></td>
												<td class="article-title" onMouseOver="this.id='select';bt_edit();" onMouseOut="cache_edit();this.id='';">
														<a href="<?php echo site_url().'/mc_musique/player/'.$this->session->userdata('uid').'/playlist/'.$playlist->nom.'/'.$morceaux->Morceaux_id; ?>" class="open_player">

															<img src="<?php echo img_url('common/btn_play2.png'); ?>" alt="Lire"/>
														</a>
                                                    <?php echo $title = (strlen($morceaux->title_track) > 20) ? substr($morceaux->title_track,0,17).'...' : $morceaux->title_track; ?>
													<div class="miniat_titre">
														<!-- ICON CADIS / MISE PANIER -->
														<!-- FIN ICON CADIS / MISE PANIER -->
														<?php if(substr_count($all_panier,'/'.$morceaux->Morceaux_id.'/')>=1)
														{?>
										
															<a href="javascript:void(0)" class="cadis_actif"></a>
												
														<?php }
														if(substr_count($all_panier,'/'.$morceaux->Morceaux_id.'/')==0)
	
														{	?>	
															<a href="javascript:void(0)" class="cadis"></a><?php
														}?>
															
														<!-- ICON COEUR / LIKE -->
														<?php 
                                                        if(substr_count($all_my_like,'/'.$morceaux->Morceaux_id.'/')>=1)
														{?>
										
															<a href="javascript:void(0)" class="coeur_actif"></a>
												
														<?php }
														if(substr_count($all_my_like,'/'.$morceaux->Morceaux_id.'/')==0)
	
														{	?>	
															<a href="javascript:void(0)" class="coeur"></a><?php
														}?>
														<!-- FIN ICON COEUR / LIKE -->

														<!--<a href="#" class="cam"></a>-->
													</div>
												</td>
												<td class="article-artiste"><a href="<?php echo base_url('index.php/musique/'.$morceaux->user_id); ?>"><?php echo $morceaux->login ?></a></td>
												<td class="article-album"><a href="<?php echo base_url('index.php/musique/album/'.$morceaux->user_id.'/'.$morceaux->id_alb); ?>"><?php echo $morceaux->title_album ?></a></td>
									
												<td class="article-duree"><?php echo $morceaux->duree; ?></td>
											</tr>
										<?php endif;
      						 		endforeach;?>
							
								</tbody>
							</table>        
						</form>
					</div>
				</div>
        <?php if($key != $last_key): ?>
            <hr/>
        <?php endif; ?>
			<?php endforeach;
		endif;
		if(empty($playlists)==1): ?>
			<div class='text-empty'>Vous n'avez aucune playlist</div>
		<?php endif; ?>
		
	<div id="modal">
		<div id="content-info">
			<p>Le morceau a bien été ajouté au panier</p>

			<a href="javascript:void(0)" class="button_info green close"><img src="<?php echo base_url('/assets/images/validation_pi/tick.png')?>">OK</a>

		</div>
	</div>
	
		<div id="modal_already">
		<div id="content-info">
			<p class="morceau_panier_already"><p>
			<a href="javascript:void(0)" class="button_info green close"><img src="<?php echo base_url('/assets/images/validation_pi/tick.png')?>">OK</a>

		</div>
	</div>
	
  </div>

    <?php if (isset($sidebar_right)) echo $sidebar_right; ?>

</div>
