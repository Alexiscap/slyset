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
            <li><a href="<?php echo site_url($this->uri->segment(1) . '/' . $this->uri->segment(2) . '/' . $uid_visit . '/' . $this_album[0]->id); ?>"><?php echo $this_album[0]->nom; ?></a></li>
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
                
            <?php if($loger == 1 && $infos_profile->id != $session_id): ?><a class="contact-user iframe" href="<?php echo site_url('contacter/'.$uid_visit); ?>"><span class="button_left_abonne"></span><span class="button_center_abonne">Contacter</span><span class="button_right_abonne"></span></a><?php endif; ?>
        </div>
    </div>

    <div id="stats-cover">
        <div class="stats_cover_block">
            <span class="stats_number">
            	<?php
            	$nab = 0;
            	if(empty($all_follower)!=1){ $nab =  count($all_follower); }
            	echo $nab;
            	?>
            </span>       
            <span class="stats_title">
            	<?php if($nab == 0 || $nab == 1){ echo 'abonné'; } else { echo 'abonnés'; } ?>
            </span>
        </div>

        <div class="stats_cover_block">
            <span class="stats_number"><?php print $album_nbr[0]->n_alb;?></span>
            <span class="stats_title">
            	<?php if($album_nbr[0]->n_alb == 0 || $album_nbr[0]->n_alb == 1){ echo 'album'; } else { echo 'albums'; } ?>
            </span>
        </div>

        <div class="stats_cover_block">
        	 <span class="stats_number">
            	<?php
            	$nm = 0;
            	if(empty($all_morceau_artiste)!=1){ $nm =  count($all_morceau_artiste); }
            	echo $nm;
            	 ?>
            </span>       
            <span class="stats_title">
            	<?php if($nm == 0 || $nm == 1){ echo 'morceau'; } else { echo 'morceaux'; } ?>
            </span>
        </div>
    </div>
    
    <?php if ($infos_profile->id == $uid): ?>
        <div class="bts_noir">
            <!--<?php if($this_album[0]->une == 0): ?>
                <div class="bt_noir une">
                    <a href="#"><span class="bt_left"></span><span class="bt_middle alb">Album en une</span><span class="bt_right"></span></a>
                </div>
            <?php endif; ?>-->
            
            <div class="bt_noir">
                <a class="iframe-upload" href="<?php echo site_url() . '/pop_in_general/upload_musique/' . $session_id . '/'. $this_album[0]->id; ?>"><span class="bt_left"></span><span class="bt_middle">Ajouter morceau</span><span class="bt_right"></span></a>
            </div>

            <div class="bt_noir">
                <a class="iframe" href="<?php echo site_url() . '/pop_in_general/edit_album/' . $this_album[0]->id; ?>"><span class="bt_left"></span><span class="bt_middle">Editer album</span><span class="bt_right"></span></a>
            </div>

            <div class="bt_noir">
                <a href="<?php echo site_url() . '/mc_musique/delete_album/' . $this_album[0]->id; ?>"><span class="bt_left"></span><span class="bt_middle">Supprimer album</span><span class="bt_right"></span></a>
            </div>
        </div>
    <?php endif;?>

    <div class="content">
		<?php
		if(empty($this_album)!=1):
		?>
        <div class="a_la_une album_page">
          <?php if ($this_album[0]->img_cover!= null):?>
            <?php $str_album = str_replace(' ', '_', strtolower($this_album[0]->nom)); ?>
            <img src="<?php echo files($infos_profile->id.'/musique/'.$str_album.'/'.$this_album[0]->img_cover); ?>" alt="Couverture album"/>
            <?php endif;?>
            <?php if ($this_album[0]->img_cover== null):?>
            <img src="<?php echo img_url('sidebar-right/default-photo-profil.png'); ?>" class="alb_cover"/>
            <?php endif;?>
           <!-- <img src="<?php echo img_url('portail/alaune.png'); ?>" class="bandeau_top"/>-->
            <div class="player">
                <a href="<?php echo site_url('mc_musique/player/'.$uid.'/album/'.$this_album[0]->nom); ?>" class="open_player"><img src="<?php echo img_url('musicien/player_top.png'); ?>"/></a>
            </div>
        </div>
        
        <div class="infos">
            <h1><a href="<?php echo base_url('index.php/musique/'.$uid_visit)?>"><img width = "23px" src="<?php echo img_url('common/arrow-back.png')?>"></a><span><?php echo $this_album[0]->nom;  ?> - <?php echo $login; ?></span></h1>
        
            <!--<p class="title" id="<?php echo $this_album[0]->id; ?>"><?php echo ucwords($this_album[0]->nom); ?></p>-->
            <?php if(isset($this_album[0]->annee)): ?><p class="annee_crea"><?php echo $this_album[0]->annee; ?><?php endif; ?><?php if (isset($this_album[0]->producteur)): ?><?php echo ' - '.$this_album[0]->producteur; ?></p><?php endif; ?>
            
            <?php if (isset($this_album[0]->description)): ?><p class="infos_alb_desc"><?php echo ucfirst($this_album[0]->description); ?></p><?php else: ?><p>Aucune description d'album renseignée.</p><?php endif; ?>
            <?php if (isset($this_album[0]->participants)): ?><p><?php echo $this_album[0]->participants; ?></p><?php endif; ?>
            <?php if (isset($this_album[0]->prix)): ?><p class="infos_alb_prix"><?php echo $this_album[0]->prix; ?> €</p><?php endif; ?>
            <br>
            <?php if (isset($this_album[0]->livret_path)): ?><p><span>> </span><a href="<?php echo base_url('files/'.$infos_profile->id.'/albums/'.str_replace(' ','_',$this_album[0]->nom).'/livret/'.$this_album[0]->livret_path); ?>"><?php  echo 'Voir le livret d\'album'; ?></a></p><?php endif; ?>
            <?php if (isset($this_album[0]->doc_id)): ?><p><span>> </span><a href="<?php echo base_url('index.php/document/'.$uid_visit.'#album-'.$this_album[0]->id) ?>">Voir les partitions</a></p><?php endif; ?>
        </div>
        
        <div class="top_album album_page">
            <div>
                <a href="<?php echo site_url('mc_musique/player/'.$uid.'/album/'.$this_album[0]->nom); ?>" class="open_player">
                    <img src="<?php echo img_url('musicien/player_top2.png'); ?>" alt="Ouvrir player"/>
					<span>Ecouter l'album</span>
				</a>
				 <a href="#">
                    <img src="<?php echo img_url('common/cadis.png'); ?>" alt="Acheter"/>
                    <span class="panier_alb" id="<?php echo $this_album[0]->id;?>">Acheter l'album</span>
                </a>
            </div>
            <div id="articles-tab">
                <input type="button" value="Acheter" class="bt_cadis unealb">
                <input type="button" value="Dans ma playlist" class="bt_playlist">
                    
                <form action="<?php echo site_url('admin_articles/delete_multi_article'); ?>" method="post" accept-charset="utf-8">          
                    <table id="tablesorter-cb">
                        <thead>
                            <tr class="tab-head">
                                <th class="article-checkbox checkbox-style2"><input type="checkbox" name="article-all" value="all" class="check_all checkbox-article" id="article-all"><label for="article-all"></label></th>
                                <th class="article-date">#</th>
                                <th class="article-title">Titre de la chanson</th>
                                <th class="article-date">Durée</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($this_album_morceau as $morceau):?>
                            <tr>
                                <td class="article-checkbox checkbox-style2"><input type="checkbox" name="checkarticle[]" value="<?php echo $morceau->nom; ?>" id="article-<?php echo $morceau->nom; ?>" class="checkbox-article"><label for="article-<?php echo $morceau->nom; ?>"></label></td>
                                <td class="article-date"><?php echo $morceau->tracknumero; ?></td>
                                <td class="article-title">
                                	<a href="<?php echo site_url('mc_musique/player/'.$this->session->userdata('uid').'/album/'.$this_album[0]->nom.'/'.$morceau->id); ?>" class="open_player">

                                		<img src="<?php echo img_url('common/btn_play.png'); ?>" class="play" alt="Bouton Lecture"/>
                                	</a>

                                    <p class="<?php echo $morceau->id;?> track-id"><?php echo $title = (strlen($morceau->nom) > 43) ? substr($morceau->nom,0,40).'...' : $morceau->nom; ?></p>
                                    <?php if($loger == 1): ?>
                                        <div class="miniat_titre">
                                            <?php if($session_id == $uid_visit): ?>
                                                <a href="#" class="delete"><span></span></a>
                                                <a href="<?php echo site_url('pop_in_general/edit_musique/'.$session_id.'/'.$morceau->id); ?>" class="edit iframe"><span></span></a>
                                            <?php endif; ?>
                                            <!--<a href="#" class="coeur"><span></span></a>-->
                                            <!-- ICON COEUR / LIKE -->
                                                <?php 
                                                if(substr_count($all_my_like,'/'.$morceau->id.'/')>=1)
                                                {?>
                                        
                                                    <a href="javascript:void(0)" class="coeur_actif"></a>
                                                
                                                <?php }
                                                if(substr_count($all_my_like,'/'.$morceau->id.'/')==0)
    
                                                {   ?>  
                                                    <a href="javascript:void(0)" class="coeur"></a><?php
                                                }?>
                                            <a href="#" class="add"><span></span></a>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td class="article-date"><?php echo substr($morceau->duree,0,5); ?></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
         <?php endif; ?>
        
       
    </div>
    <div id="modal">
		<div id="content-info">
			<p>Le morceau a bien été ajouté a votre playlist</p>

			<a href="javascript:void(0)" class="button_info green close"><img src="<?php echo base_url('/assets/images/validation_pi/tick.png')?>">OK</a>

		</div>
	</div>
	
	 <div id="modal_une">
		<div id="content-info">
			<p>Cet album est désormais à la une</p>

			<a href="javascript:void(0)" class="button_info green close"><img src="<?php echo base_url('/assets/images/validation_pi/tick.png')?>">OK</a>

		</div>
	</div>
	
		<div id="modal-panier">
		<div id="content-info">
			<p>L'album a bien été ajouté a votre panier</p>

			<a href="javascript:void(0)" class="button_info green close"><img src="<?php echo base_url('/assets/images/validation_pi/tick.png')?>">OK</a>

		</div>
	</div>
	<div id="modal-already-panier_track">
		<div id="content-info">
			<p>Ce morceau est déjà dans votre panier</p>

			<a href="javascript:void(0)" class="button_info green close"><img src="<?php echo base_url('/assets/images/validation_pi/tick.png')?>">OK</a>

		</div>
	</div>
	
			<div id="modal-panier_track">
		<div id="content-info">
			<p>Le morceau bien été ajouté a votre panier</p>

			<a href="javascript:void(0)" class="button_info green close"><img src="<?php echo base_url('/assets/images/validation_pi/tick.png')?>">OK</a>

		</div>
	</div>
	<div id="modal-already-panier">
		<div id="content-info">
			<p>Cet album est déjà dans votre panier</p>

			<a href="javascript:void(0)" class="button_info green close"><img src="<?php echo base_url('/assets/images/validation_pi/tick.png')?>">OK</a>

		</div>
	</div>
    
    <div id="playlist_alert" class="modal_alert"><p>Ajouter à une playlist existante</p>
        <?php if(!empty($playlists)): ?>
            <?php foreach($playlists as $playlist):?>
                    <a href ="javascript:void(0)" id="<?php echo $playlist->nom;?>"><?php echo $playlist->nom;?></a>
            <?php endforeach;?>
        <?php else: ?>
            <span>Aucune playlist existante</span>
        <?php endif; ?>
        </br></br>
        <p>Ou créé en une</p>
        <input id="input_alert" type='text'/> <a class="cree" href="javascript:void(0)">Créer</a>
    </div>

    <?php if (isset($sidebar_right)) echo $sidebar_right; ?>

</div>