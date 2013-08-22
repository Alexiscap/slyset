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
            <li><a href="<?php echo site_url($this->uri->segment(1) . '/' . $uid_visit); ?>">Musique</a></li>
        </ul>
    </div>

    <div id="cover" style="background-image:url(<?php print files('profiles/' . $cover = (empty($infos_profile)) ? $this->session->userdata('cover') : $infos_profile->cover); ?>);">
        <div id="infos-cover">
            <h2><?php print $login = (empty($infos_profile)) ? $this->session->userdata('login') : $infos_profile->login; ?></h2>
            <?php if ($loger == 1 && $infos_profile->id != $session_id && $infos_profile->type == 2 && substr_count($community_follower, $infos_profile->id) == 0): ?>
                <a href="#" class="add-follow" id="<?php echo $infos_profile->id ?>"><span class="button_left"></span><span class="button_center">Suivre</span><span class="button_right"></span></a>
            <?php endif;
            if ($loger == 1 && $infos_profile->id != $session_id && ($infos_profile->type == 2) && (substr_count($community_follower, $infos_profile->id) > 0)):
                ?>
                <a href="#" class="delete-follow" id="<?php echo $infos_profile->id ?>"><span class="button_left_abonne"></span><span class="button_center_abonne">Ne plus suivre</span><span class="button_right_abonne"></span></a>
            <?php endif; ?>
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
    
    <?php if($uid == $uid_visit): ?>
    <div class="bts_noir">
        <div class="bt_noir">
            <a href="javascript:void(0)"><span class="bt_left"></span><span class="bt_middle">Mettre un album à la une</span><span class="bt_right"></span></a>
        </div>
        <div class="bt_noir">
            <a class="iframe-upload" href="<?php echo site_url() . '/pop_in_general/upload_musique/' . $session_id; ?>"><span class="bt_left"></span><span class="bt_middle">Ajouter un morceau</span><span class="bt_right"></span></a>
        </div>
    </div>
	<?php endif;?>
    <div class="content">
        <h2>Musique de <?php echo $login; ?></h2>

        <!--    <div class="open_player" style="float:left; clear:both; width:100%;">
                <a href="<?php echo site_url() . '/mc_musique/player/' . $session_id; ?>">OPEN FRAME</a>
            </div>-->
		
		<?php
		if(empty($album_alaune)!=1):
		?>
		<div id="une_alb">
        <div class="a_la_une">
            <img src="<?php echo base_url('files/'.$infos_profile->id.'/albums/'.str_replace(' ','_',$album_alaune[0]->nom).'/'.$album_alaune[0]->img_cover); ?>"/>
            <img src="<?php echo img_url('portail/alaune.png'); ?>" class="bandeau_top bandeau_une"/>
            <div class="player">
                <a href="<?php echo site_url('mc_musique/player/'.$uid.'/album/'.$album_alaune[0]->nom); ?>" class="open_player"><img src="<?php echo img_url('musicien/player_top.png'); ?>"/></a>
            </div>
            <div class="infos">
                <p class="title"><?php echo $album_alaune[0]->nom; ?></p>
                <p class="annee_crea"><?php echo $album_alaune[0]->annee; ?></p>
                <p><?php if (isset($album_alaune[0]->livret_path)): ?><span>> </span><a href="<?php echo base_url('files/'.$infos_profile->id.'/albums/'.str_replace(' ','_',$album_alaune[0]->nom).'/'.$album_alaune[0]->livret_path); ?>"><?php  echo 'Voir le livret d\'album'; ?></a><?php endif; ?></p>
                <p><?php if (isset($album_alaune[0]->doc_id)): ?><span>> </span><a href="#">Voir les partitions</a><?php endif; ?></p>
            </div>
        </div>
        
        
        <div class="top_album">
            <div>
               
                    <a href="<?php echo site_url('mc_musique/player/'.$uid.'/album/'.$album_alaune[0]->nom); ?>" class="open_player">

                    	<img src="<?php echo img_url('musicien/player_top2.png'); ?>"/>
						<span> Ecouter l'album</span>
					</a>
					<a href="javascript:void(0)"> 

                    	<img src="<?php echo img_url('common/cadis.png'); ?>"/>
                  		<span class="panier_alb" id="<?php echo $album_alaune[0]->id; ?>"> Acheter l'album</span>
            		</a>
                
            </div>
            <div id="articles-tab">
                <form action="http://127.0.0.1/slyset/index.php/admin_articles/delete_multi_article" method="post" accept-charset="utf-8">          
                    <table>
                        <tbody>
                            <tr class="tab-head odd row-color-2">
                                <th class="article-checkbox checkbox-style2"><input type="checkbox" name="article-all" value="all" class="check_all checkbox-article" id="article-all"><label for="article-all"></label></th>
                                <th class="article-title">Titre de la chanson</th>
                                <th class="article-date">Durée</th>
                            </tr>
                            <?php foreach ($morceaux_alaune as $morceau_alune):?>
                            <tr class="even row-color-<?php echo $morceau_alune->nom; ?>">
                                <td class="article-checkbox checkbox-style2"><input type="checkbox" name="checkarticle[]" value="<?php echo $morceau_alune->nom; ?>" id="article-<?php echo $morceau_alune->nom; ?>" class="checkbox-article"><label for="article-<?php echo $morceau_alune->nom; ?>"></label></td>
                                <td class="article-title" onMouseOver="this.id='select';bt_edit();show_play();" onMouseOut="cache_edit();cache_play();this.id='';">
                                	<a href="<?php echo site_url().'/mc_musique/player/'.$uid_visit.'/album/'.$album_alaune[0]->nom.'/'.$morceau_alune->id; ?>" class="open_player">

                                		<img src="<?php echo img_url('common/btn_play.png'); ?>" class="play"/>
                                	</a>
                                    <p class="<?php echo $morceau_alune->id; ?>"><?php echo $morceau_alune->nom; ?> </p>
                                    <div class="miniat_titre">
                                        <a href="#" class="add"><span>add</span></a>
                                        <a href="#" class="edit"><span>edit</span></a>
                                        <a href="#" class="coeur"><span>coeur</span></a>
                                        <a href="#" class="cam"><span>cam</span></a>
                                    </div>
                                </td>
                                <td class="article-date"><?php echo substr($morceau_alune->duree,10,9); ?></td>
                            </tr>
                            <?php endforeach;?>
                          <!--  <tr class="even row-color-2">
                                <td class="article-checkbox checkbox-style2"><input type="checkbox" name="checkarticle[]" value="19" id="article-19" class="checkbox-article"><label for="article-19"></label></td>
                                <td class="article-title" onMouseOver="this.id='select';bt_edit();" onMouseOut="cache_edit();this.id=''";><a href="#"><img src="<?php echo img_url('common/btn_play.png'); ?>" class="play"/></a>
                                    <p> Rainy Day Women </p>
                                    <div class="miniat_titre">
                                        <a href="#" class="add"><span>add</span></a>
                                        <a href="#" class="edit"><span>edit</span></a>
                                        <a href="#" class="coeur"><span>coeur</span></a>
                                        <a href="#" class="cam"><span>cam</span></a>
                                    </div>
                                </td>
                                <td class="article-date">4:19</td>
                            </tr>-->
                        </tbody>
                    </table>
                    <input type="button" value="Acheter" class="bt_cadis">
                    <input type="button" value="Dans ma playlist" class="bt_playlist">
                </form>
            </div>
        </div>
        <hr />
        </div>
         <?php endif; ?>
        
        <!-- LISTE DES MORCEAUX -->
        
        
        <div class="tout_titre">
            <input type="button" value="Acheter" class="bt_cadis"/>
            <input type="button" value="Dans ma playlist" class="bt_playlist"/>
            <a href="<?php echo site_url().'/mc_musique/player/'.$uid_visit.'/album'; ?>" class="open_player">
                <img src="<?php echo img_url('musicien/player_top2.png'); ?>"/>
                <p> Ecouter les morceaux de <?php echo $login?></p>
            </a>
            <div id="articles-tab">
                <form action="http://127.0.0.1/slyset/index.php/admin_articles/delete_multi_article" method="post" accept-charset="utf-8">          
                    <table>
                        <tbody>
                            <tr class="tab-head odd row-color-2">
                                <th class="article-checkbox checkbox-style2"><input type="checkbox" name="article-all" value="all" class="check_all checkbox-article" id="article-all"><label for="article-all"></label></th>
                                <th class="article-title">Titre de la chanson</th>
                                <th class="article-album">Album</th>

                                <th class="article-date">Durée</th>
                            </tr>
                            <?php foreach ($all_morceau_artiste as $morceau_artiste): ?>
                            <tr class="even row-color-<?php echo $morceau_artiste->id?>">
                                <td class="article-checkbox checkbox-style2"><input type="checkbox" name="checkarticle[]" value="<?php echo $morceau_artiste->id?>" id="article-<?php echo $morceau_artiste->id?>" class="checkbox-article"><label for="article-<?php echo $morceau_artiste->id?>"></label></td>
                                <td class="article-title" onMouseOver="this.id='select';bt_edit();show_play();" onMouseOut="cache_edit();cache_play();this.id='';">														
                                	<a href="<?php echo site_url().'/mc_musique/player/'.$uid_visit.'/album/'.$morceau_artiste->title_alb.'/'.$morceau_artiste->id; ?>" class="open_player" >
										<img src="<?php echo img_url('common/btn_play.png'); ?>" class="play"/>
									</a>
                                    <p class="<?php echo $morceau_artiste->id; ?>"> <?php echo $morceau_artiste->nom?></p>
                                    <div class="miniat_titre">
                                        <a href="#" class="add"><span>add</span></a>
                                        <a href="#" class="edit"><span>edit</span></a>
                                        <a href="#" class="coeur"><span>coeur</span></a>
                                        <a href="#" class="cam"><span>cam</span></a>
                                    </div>
                                </td>
                                 <td class="article-album"><a href="<?php echo base_url('index.php/musique/album/'.$uid_visit.'/'.$morceau_artiste->id_alb) ?>"><?php echo $morceau_artiste->title_alb?></a></td>
                                <td class="article-date"><?php echo substr($morceau_artiste->duree,10,9); ?></td>
                            </tr>
                            <?php endforeach;?>
                         <!--   <tr class="even row-color-2">
                                <td class="article-checkbox checkbox-style2"><input type="checkbox" name="checkarticle[]" value="21" id="article-21" class="checkbox-article"><label for="article-21"></label></td>
                                <td class="article-title" onMouseOver="this.id='select';bt_edit();" onMouseOut="cache_edit();this.id=''";><a href="#"><img src="<?php echo img_url('common/btn_play.png'); ?>" class="play"/></a>
                                    <p> Rainy Day Women </p>
                                    <div class="miniat_titre">
                                        <a href="#" class="add"><span>add</span></a>
                                        <a href="#" class="edit"><span>edit</span></a>
                                        <a href="#" class="coeur"><span>coeur</span></a>
                                        <a href="#" class="cam"><span>cam</span></a>
                                    </div>
                                </td>
                                <td class="article-date">4:19</td>
                            </tr>-->
                        </tbody>
                    </table><!--
                    <input type="button" value="Acheter" class="bt_cadis">
                    <input type="button" value="Dans ma playlist" class="bt_playlist">
                    -->
                    
                </form>
            </div>
        </div>
    </div>

	<div id="modal">
		<div id="content-info">
			<p>Le morceau a bien été ajouté a votre playlist</p>

			<a href="javascript:void(0)" class="button_info green close"><img src="<?php echo base_url('/assets/images/validation_pi/tick.png')?>">OK</a>

		</div>
	</div>
	
	<div id="modal-panier">
		<div id="content-info">
			<p>L'album a bien été ajouté a votre panier</p>

			<a href="javascript:void(0)" class="button_info green close"><img src="<?php echo base_url('/assets/images/validation_pi/tick.png')?>">OK</a>

		</div>
	</div>
	<div id="modal-already-panier">
		<div id="content-info">
			<p>Cet album est déjà dans votre panier</p>

			<a href="javascript:void(0)" class="button_info green close"><img src="<?php echo base_url('/assets/images/validation_pi/tick.png')?>">OK</a>

		</div>
	</div>
	
	<div id="playlist_alert"><p>Ajouter à une playlist existante</p>
        </br>
        <?php foreach($playlists as $playlist):?>
           	<a href ="javascript:void(0)" id="<?php echo $playlist->nom;?>"><?php echo $playlist->nom;?></a>
        	</br>
        <?php endforeach;?>
    </div>
    
    <div id="album_une_alert"><p>Selectionner l'album à mettre à la une</p>
        </br>
        <?php foreach($all_alb as $album):?>
           	<a href ="javascript:void(0)" id="<?php echo $album->id;?>"><?php echo $album->nom;?></a>
        	</br>
        <?php endforeach;?>
    </div>
    <?php if (isset($sidebar_right)) echo $sidebar_right; ?>

</div>