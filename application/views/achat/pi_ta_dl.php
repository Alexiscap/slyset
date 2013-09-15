<link rel="stylesheet" type="text/css" href="<?php echo css_url('slyset') ?>" media="screen" />

<script  src="<?php echo js_url('jquery-1.8.3.min') ?>" media="screen" ></script>

<script  src="<?php echo js_url('slyset') ?>" media="screen" ></script>


<div class="pop-in_ta pop_in3">
  <span class="info">Informations</span><span  class="paiement">Paiement</span><span  class="telechargement et_active">Téléchargements</span>
  <img src="<?php echo img_url('musicien/pop_close.png'); ?>" alt="Fermer" />
  <div class="content-pi">
    <h2>Transaction réussie, merci d’avoir choisi Slyset !</h2>
	<div class="remercier">
		<p>Nous souhaitons seulement vous faire savoir... que votre <span>commande n°<?php echo $numero_cmd ?> a bien été prise en compte</span> ! Vous pouvez désormais télécharger et apprécier vos nouvelles acquisitions.</p>
		<p>Vous manquez de temps ? Rassurez-vous, vous pourrez télécharger vos morceaux, vos albums et vos partitions dans la rubrique <a href="<?php echo base_url('index.php/my-shopping/'.$this->session->userdata('uid')) ?>">Mes achats</a>.</p>
		<p>Vous recevrez sous peu un <span>email de confirmation</span> comprenant tout le détail de votre commande.</p>
		<p>L'équipe Slyset vous remercie de votre confiance et vous souhaite une bonne écoute !</p>
	</div>
	<div class="clear"></div>
	<h2>Téléchargez vos morceaux</h2>
	<div class="titre_achete">
		<div class="en_tete">
		     <form class="last_tunnel" action="" method="post" accept-charset="utf-8">          

			<table>
				<tr>
					<th class="article-checkbox checkbox-style2">
                        <input type="checkbox" name="article-all" value="all" class="check_all checkbox-article" id="article-all">
                        <label for="article-all">

                        </label>
                    </th>
					<th class="le_titre">Titre</th>
					<th class="artiste">Artiste</th>
					<th class="type">Type</th>
					<th class="dwl">Télécharger</th>
				</tr>

			<?php 
				$all_id = "";
				foreach($cmd_download as $dwld_cmd): ?>
				<tr>
					<td class="article-checkbox checkbox-style2"><input type="checkbox" name="checkarticle[]" value="<?php echo $dwld_cmd->id_info ?>" id="article-<?php echo $dwld_cmd->id_info ?>" class="checkbox-article"><label for="article-<?php echo $dwld_cmd->id_info ?>"></label></td>



					<td class="le_titre"><?php echo $dwld_cmd->nom ?></td>
					<td class="artiste"><?php echo $dwld_cmd->user_login ?></td>
					<td class="type"><?php echo $dwld_cmd->type ?></td>
					<td class="dwl">
						<?php echo anchor('melo_achats/download_file/'.$this->session->userdata('uid').'/'.$dwld_cmd->id_info,' <img src="'.img_url("common/telecharge.png").'" alt="Telecharger" />',array('class'=>'ctr_dnw')); ?>

						
					</td>
				</tr>
				
				<?php 
				$all_id .= $dwld_cmd->id_info."%20";
				endforeach;?>
			</table>
			</form>
		</div>
	</div>
	<div class="clear"></div>
	<?php echo anchor('melo_achats/download_file/'.$this->session->userdata('uid'),'<input type="submit" value="Télécharger" class="dl_black"/>',array('class'=>'ctr_dnw_part')); ?>

	<?php echo anchor('melo_achats/download_file/'.$this->session->userdata('uid').'/'.$all_id,'<input type="submit" value="Tout télécharger" class="dl_red"/>',array('class'=>'ctr_dnw')); ?>

	
	<div class="clear"></div>
  </div>
</div>