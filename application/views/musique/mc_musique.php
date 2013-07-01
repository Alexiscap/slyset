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
            <li><a href="<?php echo site_url('actualite/' . $uid_visit); ?>"><?php echo 'Artiste : '.$login; ?></a></li>
            <li><a href="<?php echo site_url($this->uri->segment(1) . '/' . $uid_visit); ?>">Musique</a></li>
        </ul>
    </div>

    <div id="cover" style="background-image:url(<?php echo files('profiles/' . $cover = (empty($infos_profile)) ? $this->session->userdata('cover') : $infos_profile->cover); ?>);">
        <div id="infos-cover">
            <h2><?php echo $login; ?></h2>
            <a href="#"><span class="button_left"></span><span class="button_center">Suivre</span><span class="button_right"></span></a>
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
		<a href="#"><span class="bt_left"></span><span class="bt_middle">Mettre un album à la une</span><span class="bt_right"></span></a>
	  </div>
	  <div class="bt_noir">
		<a href="#"><span class="bt_left"></span><span class="bt_middle">Ajouter un morceau</span><span class="bt_right"></span></a>
	  </div>
	</div>

  <div class="content">
    <h2>Musique de <?php echo $login; ?></h2>
	<div class="a_la_une">
		<img src="<?php echo img_url('musicien/album_top.jpg'); ?>"/>
		<img src="<?php echo img_url('portail/alaune.png'); ?>" class="bandeau_top"/>
		<div class="player">
			<a href="#"><img src="<?php echo img_url('musicien/player_top.png'); ?>"/></a>
		</div>
		<div class="infos">
			<p class="title">Blonde on blonde</p>
			<p class="annee_crea">1966</p>
			<p><span>> </span><a href="#">Voir le livret d'album</a></p>
			<p><span>> </span><a href="#">Voir les partitions</a></p>
		</div>
	</div>
	<div class="top_album">
		<div>
			<a href="#">
				<img src="<?php echo img_url('musicien/player_top2.png'); ?>"/>
				<p> Ecouter l'album</p>
				<img src="<?php echo img_url('common/cadis.png'); ?>"/>
				<p> Acheter l'album</p>
			</a>
		</div>
	<div id="articles-tab">
		<form action="http://127.0.0.1/slyset/index.php/admin_articles/delete_multi_article" method="post" accept-charset="utf-8">          
			<table>
				<tbody>
					<tr class="tab-head odd row-color-2">
						<th class="article-checkbox checkbox-style2"><input type="checkbox" name="article-all" value="all" class="check_all checkbox-article" id="article-all"><label for="article-all"><span></span></label></th>
						<th class="article-title">Titre de la chanson<span id="titre" class="filter filter-bottom"></span></th>
						<th class="article-date">Durée<span id="created" class="filter filter-bottom"></span></th>
					</tr>
					<tr class="even row-color-1">
						<td class="article-checkbox checkbox-style2"><input type="checkbox" name="checkarticle[]" value="18" id="article-18" class="checkbox-article"><label for="article-18"><span></span></label></td>
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
					</tr>
					<tr class="even row-color-2">
						<td class="article-checkbox checkbox-style2"><input type="checkbox" name="checkarticle[]" value="19" id="article-19" class="checkbox-article"><label for="article-19"><span></span></label></td>
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
					</tr>
				</tbody>
			</table>
			<input type="button" value="Acheter" class="bt_cadis">
			<input type="button" value="Dans ma playlist" class="bt_playlist">
		</form>
    </div>
</div>
	<hr />
	<div class="tout_titre">
		<input type="button" value="Acheter" class="bt_cadis"/>
		<input type="button" value="Dans ma playlist" class="bt_playlist"/>
		<a href="#">
			<img src="<?php echo img_url('musicien/player_top2.png'); ?>"/>
			<p> Ecouter l'album</p>
		</a>
		<div id="articles-tab">
			<form action="http://127.0.0.1/slyset/index.php/admin_articles/delete_multi_article" method="post" accept-charset="utf-8">          
				<table>
					<tbody>
						<tr class="tab-head odd row-color-2">
							<th class="article-checkbox checkbox-style2"><input type="checkbox" name="article-all" value="all" class="check_all checkbox-article" id="article-all"><label for="article-all"><span></span></label></th>
							<th class="article-title">Titre de la chanson<span id="titre" class="filter filter-bottom"></span></th>
							<th class="article-date">Durée<span id="created" class="filter filter-bottom"></span></th>
						</tr>
						<tr class="even row-color-1">
							<td class="article-checkbox checkbox-style2"><input type="checkbox" name="checkarticle[]" value="20" id="article-20" class="checkbox-article"><label for="article-20"><span></span></label></td>
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
						</tr>
						<tr class="even row-color-2">
							<td class="article-checkbox checkbox-style2"><input type="checkbox" name="checkarticle[]" value="21" id="article-21" class="checkbox-article"><label for="article-21"><span></span></label></td>
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
						</tr>
					</tbody>
				</table>
				<input type="button" value="Acheter" class="bt_cadis">
				<input type="button" value="Dans ma playlist" class="bt_playlist">
			</form>
		</div>
	</div>
  </div>

  <?php if(isset($sidebar_right)) echo $sidebar_right; ?>

</div>