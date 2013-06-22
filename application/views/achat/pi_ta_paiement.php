<div class="pop-in_ta pop_in2">
  <span class="info">Informations</span><span  class="paiement et_active">Paiement</span><span  class="telechargement">Téléchargements</span>
  <img src="<?php echo img_url('musicien/pop_close.png'); ?>" alt="Fermer" />
  <div class="content-pi">
    <h2>Choisissez votre moyen de paiement</h2>
	<div class="moyen_pmt">
		<img src="<?php echo img_url('common/pmt_cb.png'); ?>" alt="CB" />
		<img src="<?php echo img_url('common/pmt_ppal.png'); ?>" alt="Paypal" />
		<span>Payer avec une carte bancaire</span>
		<span>Payer avec un compte Paypal</span>
	</div>
	<div class="clear"></div>
	<h2>Complétez vos informations bancaires</h2>
	<div class="infos_cb">
		<span>Type de carte</span>
		<img src="<?php echo img_url('common/visa.png'); ?>" alt="Visa" onClick="this.src='<?php echo img_url('common/visa_select.png'); ?>'"/>
		<img src="<?php echo img_url('common/maestro.png'); ?>" alt="Maestro" onClick="this.src='<?php echo img_url('common/maestro_select.png'); ?>'"/>
		<img src="<?php echo img_url('common/mastercard.png'); ?>" alt="Mastercard" onClick="this.src='<?php echo img_url('common/mastercard_select.png'); ?>'"/>
		<img src="<?php echo img_url('common/amex.png'); ?>" alt="American express" onClick="this.src='<?php echo img_url('common/amex_select.png'); ?>'"/>
		<span>Numéro de carte bancaire</span>
		<input type="text">
		<div class="clear"></div>
		<span>Date d’expiration</span>
		<select>
			<option value="janvier">Janvier</option>
		</select>
		<select>
			<option value="2015">2015</option>
		</select>
		<div class="clear"></div>
		<span>Code de sécurité</span>
		<input type="text">
		<input type="submit" value="Continuer">
	</div>
	<div class="clear"></div>
  </div>
</div>