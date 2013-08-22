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
    <div class="bts_noir">
        <div class="bt_noir">
            <a href="#"><span class="bt_left"></span><span class="bt_middle">Mettre cet album à la une</span><span class="bt_right"></span></a>
        </div>
        <!--
        <div class="bt_noir">
            <a class="iframe-upload" href="<?php echo site_url() . '/pop_in_general/upload_musique/' . $session_id; ?>"><span class="bt_left"></span><span class="bt_middle">Ajouter un morceau</span><span class="bt_right"></span></a>
        </div>
        -->
    </div>

    <div class="content">
        <h2> <?php echo $this_album[0]->nom;  ?> -   <?php echo $login; ?></h2>

        <!--    <div class="open_player" style="float:left; clear:both; width:100%;">
                <a href="<?php echo site_url() . '/mc_musique/player/' . $session_id; ?>">OPEN FRAME</a>
            </div>-->
		
		<?php
		if(empty($this_album)!=1):
		?>
        <div class="a_la_une">
            <img src="<?php echo base_url('files/'.$infos_profile->id.'/albums/'.str_replace(' ','_',$this_album[0]->nom).'/'.$this_album[0]->img_cover); ?>"/>
           <!-- <img src="<?php echo img_url('portail/alaune.png'); ?>" class="bandeau_top"/>-->
            <div class="player">
                <a href="#"><img src="<?php echo img_url('musicien/player_top.png'); ?>"/></a>
            </div>
            <div class="infos">
                <p class="title"><?php echo $this_album[0]->nom; ?></p>
                <p class="annee_crea"><?php echo $this_album[0]->annee; ?></p>
                <p><?php if (isset($this_album[0]->livret_path)): ?><span>> </span><a href="<?php echo base_url('files/'.$infos_profile->id.'/albums/'.str_replace(' ','_',$this_album[0]->nom).'/'.$this_album[0]->livret_path); ?>"><?php  echo 'Voir le livret d\'album'; ?></a><?php endif; ?></p>
                <p><?php if (isset($this_album[0]->doc_id)): ?><span>> </span><a href="#">Voir les partitions</a><?php endif; ?></p>
            </div>
        </div>
        
        <div class="top_album">
            <div>
                <a href="#">
                    <img src="<?php echo img_url('musicien/player_top2.png'); ?>"/>
                        <a href="<?php echo site_url('mc_musique/player/'.$uid.'/album/'.$this_album[0]->nom); ?>" class="open_player">
							<p> Ecouter l'album</p>
						</a>
					
                    <img src="<?php echo img_url('common/cadis.png'); ?>"/>
                    <p> Acheter l'album</p>
                </a>
            </div>
            <div id="articles-tab">
                <form action="http://127.0.0.1/slyset/index.php/admin_articles/delete_multi_article" method="post" accept-charset="utf-8">          
                    <table>
                        <tbody>
                            <tr class="tab-head odd row-color-2">
                                <th class="article-checkbox checkbox-style2"><input type="checkbox" name="article-all" value="all" class="check_all checkbox-article" id="article-all"><label for="article-all"></label></th>
                                <th class="article-title">Titre de la chanson<span id="titre" class="filter filter-bottom"></span></th>
                                <th class="article-date">Durée<span id="created" class="filter filter-bottom"></span></th>
                            </tr>
                            <?php foreach ($this_album_morceau as $morceau):?>
                            <tr class="even row-color-<?php echo $morceau->nom; ?>">
                                <td class="article-checkbox checkbox-style2"><input type="checkbox" name="checkarticle[]" value="<?php echo $morceau->nom; ?>" id="article-<?php echo $morceau->nom; ?>" class="checkbox-article"><label for="article-<?php echo $morceau->nom; ?>"></label></td>
                                <td class="article-title" onMouseOver="this.id='select';bt_edit();" onMouseOut="cache_edit();this.id=''";>
                                	<a href="<?php echo site_url().'/mc_musique/player/'.$this->session->userdata('uid').'/album/'.$this_album[0]->nom.'/'.$morceau->id; ?>" class="open_player">

                                		<img src="<?php echo img_url('common/btn_play.png'); ?>" class="play"/>
                                	</a>
                                    <p class="<?php echo $morceau->id; ?> "><?php echo $morceau->nom; ?> </p>
                                    <div class="miniat_titre">
                                        <a href="#" class="add"><span>add</span></a>
                                        <a href="#" class="edit"><span>edit</span></a>
                                        <a href="#" class="coeur"><span>coeur</span></a>
                                        <a href="#" class="cam"><span>cam</span></a>
                                    </div>
                                </td>
                                <td class="article-date"><?php echo substr($morceau->duree,10,9); ?></td>
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
         <?php endif; ?>
        
       
    </div>
    <div id="modal">
		<div id="content-info">
			<p>Le morceau a bien été ajouté a votre playlist</p>

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

    <?php if (isset($sidebar_right)) echo $sidebar_right; ?>

</div>