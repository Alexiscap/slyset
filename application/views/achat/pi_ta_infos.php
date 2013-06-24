<div class="pop-in_ta">
  <span class="info et_active">Informations</span><span  class="paiement">Paiement</span><span  class="telechargement">Téléchargements</span>
  <img src="<?php echo img_url('musicien/pop_close.png'); ?>" alt="Fermer" />
  <div class="content-pi">
  <?php echo form_open(base_url('index'));
  $nom= $this->session->userdata('nom');
 $prenom= $this->session->userdata('prenom');
  $email=  $this->session->userdata('mail');
  
  ?>

    <h2>Vérifiez vos informations</h2>
	<span>Prénom</span>
	<?php echo form_input('prenom',$prenom) ?>
	<span>Nom</span>
	<?php echo form_input('nom',$nom) ?>
	<span>Email</span>
	<?php echo form_input('email',$email) ?>
	
	<div class="espace"></div>
	<h2>Vérifiez votre panier et choisissez le format </h2>
	<div class="en_tete">
		<table>
			<tr>
				<td class="le_titre">Titre</td>
				<td class="artiste">Artiste</td>
				<td class="type">Type</td>
				<td class="format">Format</td>
				<td class="prix">Prix</td>
			</tr>
		</table>
	</div>
	<div class="achats">
		<table>

		
			<?php
			 foreach ($cmd as $commande):
					if($commande->status=="P"): ?>
		
			<tr>
				<td class="le_titre"><?php echo $commande->nom ?></td>
				<td class="artiste"><?php echo $commande->user_login ?></td>
				<td class="type"><?php echo $commande->type ?></td>
				<td class="format">
					<?php $formats = ( explode('/',$commande->format))
					
					 ?>
					 <select>
					 <?php foreach ($formats as $format)
						{ ?>
						<option value="320Kbps"><?php echo $format ?></option>
						<?php
						}			
					 ?>

					
						

						
					</select>
				</td>
				<td class="prix"><?php echo $commande->prix ?> €</td>
			</tr>
			
			<?php 
					endif;
				endforeach;?>
			
			
		</table>
	</div>
	<p class="total">10,80€</p><p>Montant total :</p>
	
	<?php
	echo form_submit('submit', 'Paiment sécurisé');

	 form_close(); ?>
	<div class="clear"></div>
  </div>
</div>