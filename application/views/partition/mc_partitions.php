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
    <div class="bts_noir_partition">
	  <div class="bt_noir">
		<a href="#"><span class="bt_left"></span><span class="bt_middle">Ajouter des paroles</span><span class="bt_right"></span></a>
	  </div>
	  <div class="bt_noir">
		<a href="#"><span class="bt_left"></span><span class="bt_middle">Ajouter un morceau</span><span class="bt_right"></span></a>
	  </div>
	</div>

  <div class="content">
	<h2>Partitions, livrets et paroles de <?php echo $this->session->userdata('login') ?></h2>
	<?php foreach($get_doc as $doc): 
	//if($doc->type == 2): 
	?>
	<div class="a_la_une">
	<?php if($doc->img_cover!=null){ ?>
		<img src="<?php echo base_url('./files/'.$this->session->userdata('uid').'/albums/'.$doc->Albums_id.'/'.$doc->img_cover) ?>"/>
		<?php }
		else
		{
		print 'path image defaut';
		} ?>
		<div class="infos">
			<p class="title"><?php echo $doc->nom ?></p>
			<p class="annee_crea"><?php if(isset($doc->annee))echo $doc->annee ?></p>
			<?php if($doc->livret_path != null): ?>
			<p><span>> </span><a href="#">Voir le livret d'album</a></p>
			<?php endif;?>
		</div>
	</div>
	<div class="top_partition">
		<div>
			<a href="#">
				<img src="<?php echo img_url('musicien/player_top2.png'); ?>"/>
				<p> Ecouter l'album</p>
			</a>
		</div>
		<div class="liste_partitions">
			<div class="en_tete">
				<table>
					<tr>
						<td class="le_titre">Titre de la chanson</td>
						<td class="paroles">Paroles</td>
						<td class="partitions">Partitions</td>
					</tr>
				</table>
			</div>
			<div class="titres">
				<table>
				<?php 

				foreach($get_morc as $morceau):
				
				if($morceau->Albums_id == $doc->Albums_id):
?>
					<tr>
						<td class="le_titre">
							<p>		<?php 		print $morceau->nom;?>
</p>
						</td>
						<!--ajouter type-->
						<?php if ($morceau->path!=null)
						{ ?>
						<td class="paroles"><a href="<?php echo base_url('./files/'.$this->session->userdata('uid').'/albums/'.$doc->Albums_id.'/partition/'.$morceau->path) ?>">Voir</a>
							<div class="miniat_titre">
								<a href="#" class="edit"><span>edit</span></a>
							</div>
						</td>
						
						<?php
						}
						else
						{
						?>
						<td class="paroles"><a href="#"> - </a>
							<div class="miniat_titre">
								<a href="#" class="edit"><span>edit</span></a>
							</div>
						</td>
						<?php
						}
						 ?>												<?php if ($morceau->prix!=null) { ?>

						<td class="partitions">

							Acheter
							<div class="miniat_titre">
								<a href="#" class="cadis"><span>cadis</span></a>
								<a href="#" class="edit"><span>edit</span></a>
							</div>
							</td>
							<?php
							}
							else {
							?>						<td class="partitions">

							-
							<div class="miniat_titre">
								<a href="#" class="cadis"><span>cadis</span></a>
								<a href="#" class="edit"><span>edit</span></a>
							</div>
													</td>

							<?php
							}
							?>
					</tr>
					<?php  
									endif; 
									endforeach;?>
					
				
				</table>
			</div>
		</div>
	</div>
	<hr />




	<?php
	//endif;
	
	
	endforeach; ?>
	
	<!--
	<div class="a_la_une">
		<img src="<?php echo img_url('musicien/logo_slyset_partition.png'); ?>"/>
		<div class="infos">
			<p class="title">Tempest</p>
			<p class="annee_crea">2012</p>
			<p><span>> </span><a href="#">Ajouter le livret</a></p>
		</div>
	</div>
	<div class="top_partition">
		<div>
			<a href="#">
				<img src="<?php echo img_url('musicien/player_top2.png'); ?>"/>
				<p> Ecouter l'album</p>
			</a>
		</div>
		<div class="liste_partitions">
			<div class="en_tete">
				<table>
					<tr>
						<td class="le_titre">Titre de la chanson</td>
						<td class="paroles">Paroles</td>
						<td class="partitions">Partitions</td>
					</tr>
				</table>
			</div>
			<div class="titres">
				<table>
					<tr>
						<td class="le_titre">
							<p> Rainy Day Women </p>
						</td>
						<td class="paroles"><a href="#">Voir</a>
							<div class="miniat_titre">
								<a href="#" class="edit"><span>edit</span></a>
							</div>
						</td>
						<td class="partitions">
							Acheter
							<div class="miniat_titre">
								<a href="#" class="cadis"><span>cadis</span></a>
								<a href="#" class="edit"><span>edit</span></a>
							</div>
						</td>
					</tr>
					<tr>
						<td class="le_titre">
							<p> Hurricane </p>
						</td>
						<td class="paroles"><a href="#">Voir</a>
							<div class="miniat_titre">
								<a href="#" class="edit"><span>edit</span></a>
							</div>
						</td>
						<td class="partitions">
							Acheter
							<div class="miniat_titre">
								<a href="#" class="cadis"><span>cadis</span></a>
								<a href="#" class="edit"><span>edit</span></a>
							</div>
						</td>
					</tr>
					<tr>
						<td class="le_titre">
							<p> I Want You </p>
						</td>
						<td class="paroles"><a href="#">Voir</a>
							<div class="miniat_titre">
								<a href="#" class="edit"><span>edit</span></a>
							</div>
						</td>
						<td class="partitions">
							Acheter
							<div class="miniat_titre">
								<a href="#" class="cadis"><span>cadis</span></a>
								<a href="#" class="edit"><span>edit</span></a>
							</div>
						</td>
					</tr>
					<tr>
						<td class="le_titre">
							<p> I Want You </p>
						</td>
						<td class="paroles"><a href="#">Voir</a>
							<div class="miniat_titre">
								<a href="#" class="edit"><span>edit</span></a>
							</div>
						</td>
						<td class="partitions">
							Acheter
							<div class="miniat_titre">
								<a href="#" class="cadis"><span>cadis</span></a>
								<a href="#" class="edit"><span>edit</span></a>
							</div>
						</td>
					</tr>
					<tr>
						<td class="le_titre">
							<p> I Want You </p>
						</td>
						<td class="paroles"><a href="#">Voir</a>
							<div class="miniat_titre">
								<a href="#" class="edit"><span>edit</span></a>
							</div>
						</td>
						<td class="partitions">
							Acheter
							<div class="miniat_titre">
								<a href="#" class="cadis"><span>cadis</span></a>
								<a href="#" class="edit"><span>edit</span></a>
							</div>
						</td>
					</tr>
					<tr>
						<td class="le_titre">
							<p> I Want You </p>
						</td>
						<td class="paroles"><a href="#">Voir</a>
							<div class="miniat_titre">
								<a href="#" class="edit"><span>edit</span></a>
							</div>
						</td>
						<td class="partitions">
							Acheter
							<div class="miniat_titre">
								<a href="#" class="cadis"><span>cadis</span></a>
								<a href="#" class="edit"><span>edit</span></a>
							</div>
						</td>
					</tr>
					<tr>
						<td class="le_titre">
							<p> I Want You </p>
						</td>
						<td class="paroles"><a href="#">Voir</a>
							<div class="miniat_titre">
								<a href="#" class="edit"><span>edit</span></a>
							</div>
						</td>
						<td class="partitions">
							Acheter
							<div class="miniat_titre">
								<a href="#" class="cadis"><span>cadis</span></a>
								<a href="#" class="edit"><span>edit</span></a>
							</div>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
 -->
  </div>

  <?php if(isset($sidebar_right)) echo $sidebar_right; ?>

</div>