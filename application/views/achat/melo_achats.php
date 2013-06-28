
<div id="contentAll">

  <div id="breadcrumbs">
    <ul>
      <li><a href="#">Accueil</a></li>
      <li><a href="#">Artistes</a></li>
      <li><a href="#">Bob Dylan</a></li>
      <li><a href="#">Photos & Vidéos</a></li>
    </ul>
  </div>
  <div id="cover">
    <div id="infos-cover">
      <h2>Bob Dylan</h2>
    </div>
  </div>

  <div id="stats-cover_melo">
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
	<h2>Mes achats</h2>
	<div class="panier">
		<div class="descri_panier">
			<span class="nom_pl">Mon panier</span>
			<span class="detail_pl"><?php if (isset($total_document_panier)){ if ($total_document_panier==1){ echo $total_document_panier.' partition';} if  ($total_document_panier>1){ echo $total_document_panier.' partitions';}} else{echo '0 partition';}   ?></span>
			<span class="detail_pl"><?php if (isset($total_album_panier)){ if ($total_album_panier==1){ echo $total_album_panier.' album';} if  ($total_album_panier>1){ echo $total_album_panier.' albums';}} else{echo '0 album';}   ?></span>
			<span class="detail_pl"><?php if(isset($total_morceaux_panier)){ if ($total_morceaux_panier==1){ echo $total_morceaux_panier.' chanson';} if  ($total_morceaux_panier>1){ echo $total_morceaux_panier.' chansons';}} else{echo '0 chanson';} ?> </span>
			<img src="<?php echo img_url('common/caddis_achat.png'); ?>" class="detail_pl"/>
		</div>
		<hr />
		<div class="clear"></div>
		<div id="articles-tab">
			<form action="http://127.0.0.1/slyset/index.php/admin_articles/delete_multi_article" method="post" accept-charset="utf-8">          
				<table>
					<tbody>
						<tr class="tab-head odd row-color-2">
							<th class="article-checkbox checkbox-style2"><input type="checkbox" name="article-all" value="all" class="check_all checkbox-article" id="article-all"><label for="article-all"><span></span></label></th>
							<th class="article-title">Titre<span id="titre" class="filter filter-bottom"></span></th>
							<th class="article-artiste">Artiste<span id="titre" class="filter filter-bottom"></span></th>
							<th class="article-type">Type<span id="titre" class="filter filter-bottom"></span></th>
							<th class="article-prix">Prix<span id="created" class="filter filter-bottom"></span></th>
						</tr>
						<?php foreach ($cmd as $commande):
						if($commande->status=="P"): ?>
							<tr class="even row-color-1">
								<td class="article-checkbox checkbox-style2"><input type="checkbox" name="checkarticle[]" value="20" id="article-20" class="checkbox-article"><label for="article-20"><span></span></label></td>
								<td class="article-title"><a href="#"><img src="<?php echo img_url('common/btn_play2.png'); ?>"/>
								<?php echo $commande->nom ?></td>
								<td class="article-artiste"><?php echo $commande->user_login ?></td>
								<td class="article-type"><?php echo $commande->type ?></td>
								<td class="article-prix"><?php echo $commande->prix ?> €</td>
							</tr>
						<?php 
						endif;
						endforeach;?>
					</tbody>
				</table>
			</form>
		</div>
		<p class="total_panier">Montant total <span>10,00€</span></p>
			<div class="clear"></div>
			<a class="bigiframe" href="<?php echo base_url('index.php/pi_ta_infos/index/'.$this->session->userdata('uid')) ?>"><input type="button" value="Paiement sécurisé" class="cadis_panier"></a>
			<input type="button" value="Supprimer" class="bt_supp_playlist">
	</div>
	
	<div class="clear"></div>
	<div class="historique">
		<div class="descri_historique">
			<span class="nom_pl">Historique d'achats</span>
			<span class="detail_pl"><?php if (isset($total_document_history)){ if ($total_document_history==1){ echo $total_document_history.' partition';} if  ($total_document_history>1){ echo $total_document_history.' partitions';}} else{echo '0 partition';}   ?></span>
			<span class="detail_pl"><?php if (isset($total_album_history)){ if ($total_album_history==1){ echo $total_album_history.' album';} if  ($total_album_history>1){ echo $total_album_history.' albums';}} else{echo '0 album';}   ?></span>
			<span class="detail_pl"><?php if(isset($total_morceaux_history)){ if ($total_morceaux_history==1){ echo $total_morceaux_history.' chanson';} if  ($total_morceaux_history>1){ echo $total_morceaux_history.' chansons';}} else{echo '0 chanson';} ?> </span>
			<img src="<?php echo img_url('common/sac_historique.png'); ?>" class="detail_pl"/>
		</div>
		<hr />
		<div class="clear"></div>
		<div id="articles-tab">
			<form action="http://127.0.0.1/slyset/index.php/admin_articles/delete_multi_article" method="post" accept-charset="utf-8">          
				<table>
					<tbody>
						<tr class="tab-head odd row-color-2">
							<th class="article-checkbox checkbox-style2"><input type="checkbox" name="article-all" value="all" class="check_all checkbox-article" id="article-all"><label for="article-all"><span></span></label></th>
							<th class="article-title">Titre<span id="titre" class="filter filter-bottom"></span></th>
							<th class="article-artiste">Artiste<span id="titre" class="filter filter-bottom"></span></th>
							<th class="article-type">Type<span id="titre" class="filter filter-bottom"></span></th>
							<th class="article-prix">Prix<span id="created" class="filter filter-bottom"></span></th>
						</tr>
						<?php foreach ($cmd as $commande):
						if($commande->status=="P"): ?>
							<tr class="even row-color-1">
								<td class="article-checkbox checkbox-style2"><input type="checkbox" name="checkarticle[]" value="20" id="article-20" class="checkbox-article"><label for="article-20"><span></span></label></td>
								<td class="article-title"><a href="#"><img src="<?php echo img_url('common/btn_play2.png'); ?>"/>
								<?php echo $commande->nom ?></td>
								<td class="article-artiste"><?php echo $commande->user_login ?></td>
								<td class="article-type"><?php echo $commande->type ?></td>
								<td class="article-prix"><?php echo $commande->prix ?> €</td>
							</tr>
						<?php 
						endif;
						endforeach;?>
					</tbody>
				</table>
			</form>
		</div>
			<input type="button" value="Télécharger" class="telecharge_select">
	</div>

	
	
	
  </div>

  <?php if(isset($sidebar_right)) echo $sidebar_right; ?>

</div>