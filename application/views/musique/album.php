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
    <?php if($this_album[0]->une == 0): ?>
        <div class="bt_noir une">
            <a href="#">
            	<span class="bt_left">
            	</span>
            	<span class="bt_middle alb">Mettre cet album à la une</span>
            	<span class="bt_right"></span>
            </a>
        </div>
    <?php endif; ?>
    </div>

    <div class="content">
        <h1><a href="<?php echo base_url('index.php/musique/'.$uid_visit)?>"><img width = "23px" src="<?php echo img_url('common/arrow-back.png')?>"></a><?php echo $this_album[0]->nom;  ?> - <?php echo $login; ?></h1>

		<?php
		if(empty($this_album)!=1):
		?>
        <div class="a_la_une">
          <?php if ($this_album[0]->img_cover!= null):?>
            <img src="<?php echo base_url('files/'.$infos_profile->id.'/albums/'.str_replace(' ','_',$this_album[0]->nom).'/'.$this_album[0]->img_cover); ?>"/>
            <?php endif;?>
            <?php if ($this_album[0]->img_cover== null):?>
            <img src="<?php echo img_url('sidebar-right/default-photo-profil.png'); ?>" class="alb_cover"/>
            <?php endif;?>
           <!-- <img src="<?php echo img_url('portail/alaune.png'); ?>" class="bandeau_top"/>-->
            <div class="player">

                <a href="<?php echo site_url('mc_musique/player/'.$uid.'/album/'.$this_album[0]->nom); ?>" class="open_player"><img src="<?php echo img_url('musicien/player_top.png'); ?>"/></a>
            </div>
            <div class="infos">
                <p class="title" id="<?php echo $this_album[0]->id; ?>"><?php echo $this_album[0]->nom; ?></p>
                <p class="annee_crea"><?php echo $this_album[0]->annee; ?></p>
                <p><?php if (isset($this_album[0]->livret_path)): ?><span>> </span><a href="<?php echo base_url('files/'.$infos_profile->id.'/albums/'.str_replace(' ','_',$this_album[0]->nom).'/livret/'.$this_album[0]->livret_path); ?>"><?php  echo 'Voir le livret d\'album'; ?></a><?php endif; ?></p>
                <p><?php if (isset($this_album[0]->doc_id)): ?><span>> </span><a href="<?php echo base_url('index.php/document/'.$uid_visit.'#album-'.$this_album[0]->id) ?>">Voir les partitions</a><?php endif; ?></p>
            </div>
        </div>
        
        <div class="top_album">
            <div>
                <a href="<?php echo site_url('mc_musique/player/'.$uid.'/album/'.$this_album[0]->nom); ?>" class="open_player">
                    <img src="<?php echo img_url('musicien/player_top2.png'); ?>"/>
					<span>Ecouter l'album</span>
				</a>
				 <a href="#">
                    <img src="<?php echo img_url('common/cadis.png'); ?>"/>
                    <span class="panier_alb" id="<?php echo $this_album[0]->id;?>">Acheter l'album</span>
                </a>
            </div>
            <div id="articles-tab">
                <form action="<?php echo site_url('admin_articles/delete_multi_article'); ?>" method="post" accept-charset="utf-8">          
                    <table id="tablesorter-cb">
                        <thead>
                            <tr class="tab-head">
                                <th class="article-checkbox checkbox-style2"><input type="checkbox" name="article-all" value="all" class="check_all checkbox-article" id="article-all"><label for="article-all"></label></th>
                                <th class="article-title">Titre de la chanson</th>
                                <th class="article-date">Durée</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($this_album_morceau as $morceau):?>
                            <tr>
                                <td class="article-checkbox checkbox-style2"><input type="checkbox" name="checkarticle[]" value="<?php echo $morceau->nom; ?>" id="article-<?php echo $morceau->nom; ?>" class="checkbox-article"><label for="article-<?php echo $morceau->nom; ?>"></label></td>
                                <td class="article-title">
                                	<a href="<?php echo site_url('mc_musique/player/'.$this->session->userdata('uid').'/album/'.$this_album[0]->nom.'/'.$morceau->id); ?>" class="open_player">

                                		<img src="<?php echo img_url('common/btn_play.png'); ?>" class="play"/>
                                	</a>


                                    <p class="<?php echo $morceau->id;?> track-id"><?php echo $title = (strlen($morceau->nom) > 20) ? substr($morceau->nom,0,17).'...' : $morceau->nom; ?></p>
                                    <div class="miniat_titre">
                                        <a href="#" class="add"><span>add</span></a>
                                        <a href="#" class="edit"><span>edit</span></a>
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
                                        <!--<a href="#" class="cam"><span>cam</span></a>-->
                                    </div>
                                </td>
                                <td class="article-date"><?php echo substr($morceau->duree,0,5); ?></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                    <input type="button" value="Acheter" class="bt_cadis unealb">
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
        </br>
        <?php foreach($playlists as $playlist):?>
           	<a href ="javascript:void(0)" id="<?php echo $playlist->nom;?>"><?php echo $playlist->nom;?></a>
        	</br>
        <?php endforeach;?>
          <p>Ou crée en une</p>
          <input id="input_alert" type='text'/> <a class="cree" href="javascript:void(0)">Creer</a>
    </div>

    <?php if (isset($sidebar_right)) echo $sidebar_right; ?>

</div>