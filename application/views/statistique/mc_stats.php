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
            <li><a href="<?php echo site_url('actualite/' . $uid_visit); ?>"><?php echo 'Artiste : ' . $login; ?></a></li>
            <li><a href="<?php echo site_url($this->uri->segment(1) . '/' . $uid_visit); ?>">Statistiques</a></li>
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
   
    
    	<span class="stats_number">
            	<?php
            	echo $count_follower[0]->count_follower;
            	?>
            </span>       
            <span class="stats_title">
            	<?php
            	if($count_follower[0]->count_follower == 0 || $count_follower[0]->count_follower == 1){
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
      <span class="stats_number">18</span>
      <span class="stats_title">albums</span>
    </div>

    <div class="stats_cover_block">
      <span class="stats_number">278</span>
      <span class="stats_title">morceaux</span>
    </div>
  </div>

  <div class="content">
	<h1>Statistiques</h1>
	<h2 style="font-size:15px;">Cette année : </h2>
	<div class="stats_carre">
		<div class="abonnes"><span>&nbsp;<?php echo $count_follower[0]->count_follower?></span></div>
		<div class="visites"><span><?php echo $stats_visit->nb_visits ?></span></div>
		<div class="vues"><span><?php echo $stats_page->nb_pageviews ?></span></div>
		<div class="ventes"><span>&nbsp;<?php echo $count_vente_titre[0]->vente_titre ?></span></div>
	</div>
	<div class="clear"></div>
	<div class="visites_quotidiennes">
		<span>Nombre de visistes quotidiennes</span>
		<div class="legende"><div class="visites"></div><span>Visites</span><div class="unique"></div><span>Visites Uniques</span></div>
		<div class="clear"></div>
		<div class="graph_stats">
			
			<canvas id="myChart" width="500px" height="200px"></canvas>
		</div>
	</div>
	<div class="provenance">
		<span>D'où viennent vos visiteurs ?</span>
		<div class="graph">
			<div class="stats">
				<div class="portail"><span><?php if(!isset($direct)){$direct = 0 ;} echo $direct.'%'; ?></span></div>
				<div class="google"><span><?php if(!isset($se)) {$se =  0;} echo $se.'%';?></span></div>
				<div class="site"><span><?php if(!isset($site_ref)){$site_ref =  0;} echo $site_ref.'%'; ?></span></div>
				<div class="autre"><span><?php $autre_source = 100 - $se - $site_ref - $direct; echo $autre_source.'%' ?></span></div>
			</div>
			<div class="cercle">
			<canvas id="piechart" width="140" height="140"></canvas>
			<div style="font-size : 10px; float:right">(cette année)</div>
			</div>
		</div>
	</div>
	<div class="vente">
		<span>Vos ventes</span>
		<div class="resume_vente">
			<img src="<?php echo img_url('common/cadis.png'); ?>"/>
			<p class="nb_vente"><?php echo $count_vente_titre[0]->vente_titre ?></p>
			<p class="titres_vendus"> <?php if($count_vente_titre[0]->vente_titre<2){echo 'titre vendu';} else { echo 'titres vendus';} ?></p>
			<div class="source">Revenus générés</div><div class="revenu"><?php echo $total_gain?> €</div>
			<div class="source_detail">dont musiques</div><div class="revenu"><?php echo $total_gain_music?> €</div>
			<div class="source_detail">dont documents</div><div class="revenu"> <?php echo $stat_euro_doc[0]->gain_doc ;?> €</div>
			<div class="source">Acheteurs</div><div class="revenu"><?php echo $count_distinc_buyer[0]->n_client ?></div>
		</div>
	</div>
	<div class="clear"></div>
	<div class="ecoutes">
		

		<?php if(empty($stat_by_track)!= 1)
		{ ?>
			<span>Détail des écoutes et des achats</span>

			<select>
				<option value="titre">titres</option>
				<option value="ecoutes">écoutes</option>
				<option value="achats">achats</option>
			</select>

			<div class="en_tete">
				<table>
					<tr>
						<td class="le_titre">Titre de la chanson</td>
						<td class="paroles">Ecoutes<span>Depuis mise en ligne<!--ces 7 derniers jours--></span></td>
						<td class="partitions">Achats<span>Depuis mise en ligne</span></td>
					</tr>
				</table>
			</div>
			<div class="titres">
				<table>
					<?php 
					foreach($stat_by_track as $stat_track):
					?>
						<tr>
							<td class="le_titre"><?php echo $stat_track->nom ?></td>
							<td class="paroles"><?php echo $stat_track->nombre_lectures ?></td>
							<td class="partitions"><?php echo $stat_track->vente_by_titre ?></td>
						</tr>
					<?php endforeach; ?>
				</table>
			</div>
		<?php } ?>
	</div>
		
  </div>

	

  <?php if(isset($sidebar_right)) echo $sidebar_right; ?>

</div>
<script>
	var chart_month = [<?php echo $all_date ?>];
	var value_charts = [<?php echo $value_graph_uniq ?>] ;
	var chart_visit = [<?php echo $value_graph ?>];
 	var direct = <?php echo $direct ?>;
 	var se =<?php echo $se ?>;
	var site_ref = <?php echo $site_ref ?>;
	var other_s = <?php echo $autre_source ?>;
	var step =<?php echo $decimal / 10; ?>;

</script>