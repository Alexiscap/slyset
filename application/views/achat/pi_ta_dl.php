<link rel="stylesheet" type="text/css" href="http://127.0.0.1/slyset/assets/css/slyset.css" media="screen" />
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
			<table>
				<tr>
					<td class="check"><input type="checkbox"></td>
					<td class="le_titre">Titre</td>
					<td class="artiste">Artiste</td>
					<td class="type">Type</td>
					<td class="dwl">Télécharger</td>
				</tr>
			</table>
		</div>
		<div class="telechargements">
			<table>
			<?php foreach($cmd_download as $dwld_cmd): ?>
				<tr>
					<td class="select"><input type="checkbox"></td>
					<td class="le_titre"><?php echo $dwld_cmd->nom ?></td>
					<td class="artiste"><?php echo $dwld_cmd->user_login ?></td>
					<td class="type"><?php echo $dwld_cmd->type ?></td>
					<td class="dwl"><img src="<?php echo img_url('common/telecharge.png'); ?>" alt="Telecharger" /></td>
				</tr>
				<?php endforeach;?>
			</table>
		</div>
	</div>
	<div class="clear"></div>
	<input type="submit" value="Télécharger" class="dl_black"/>
	<input type="submit" value="Tout télécharger" class="dl_red"/>
	<div class="clear"></div>
  </div>
</div>