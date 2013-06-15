<<<<<<< HEAD
<link rel="stylesheet" type="text/css" href="http://127.0.0.1/slyset/assets/css/slyset.css" media="screen" />
 	 <div class="pop-in">

 	<p> Ajouter un concert </p>
 		 <img src="<?php echo img_url('musicien/pop_close.png'); ?>" alt="Fermer" />
  <div class="content-pi"><?php
      //appel à la function "register" du controller "user"
      
	  $user = $this->uri->segment(3);

      echo form_open('mc_concerts/ajouter_concert/'.$user);
      		?><div class="label">Artiste principal</div>
      				<div class="champs">

<?php
      echo form_input('artiste', $this->session->userdata('login'),'placeholder="Ex : Beach House"')."<pre>";
      echo form_error('artiste', '<div>', '</div>');

      echo form_input('snd_partie',set_value('snd_partie'),'placeholder="Ex : Lower Dens"')."<pre>";
      ?></div><div class="label">Date</div>
      		<div class="champs">

<?php
      echo form_date('date_concert',set_value(''))."<pre>";
      
      echo form_error('date_concert', '<div class="error-form" >', '</div>');
?></div><div class="label">Heure</div><div class="champs">
<?php
      echo form_time('heure_concert',set_value(''))."<pre>";
      ?>	</div>	
<div class="label">Salle</div><div class="champs">
<?php
      echo form_input('salle',set_value('salle'),'placeholder="Ex : Le Grand Mix"')."<pre>";
      echo form_error('salle', '<div class="error-form" >', '</div>');
?></div><div class="label">Ville</div><div class="champs">
<?php
      echo form_input('ville',set_value('ville'),'placeholder="Ex : Lille"')."<pre>";
      echo form_error('ville', '<div class="error-form" >', '</div>');
	?></div><div class="label">Prix</div><div class="champs_prix">

<?php
      echo form_int('prix',set_value('prix'),'placeholder="Ex : 12"')."<pre>";
      ?></div><?php
      echo form_submit('submit','Ajouter un concert');

      echo form_close();

    ?>
</div>

</div>
=======
 <div class="pop-in">
  <p> Ajouter un concert </p>
  <img src="<?php echo img_url('musicien/pop_close.png'); ?>" alt="Fermer" />
  <div class="content-pi">
    <form>
		<div class="label">
			<label>Artistes</label>
		</div>
		<div class="champs">
			<input type="text">
			<input type="text">
		</div>
		<div class="label">
			<label>Date</label>
		</div>
		<div class="champs">
			<input type="date">
		</div>
		<div class="label">
			<label>Heure</label>
		</div>
		<div class="champs_heure">
			<input type="text">
			<input type="text">
		</div>
		<div class="label">
			<label>Lieu</label>
		</div>
		<div class="champs_lieu">
			<input type="text">
			<input type="text">
		</div>
		<div class="label">
			<label>Prix</label>
		</div>
		<div class="champs_prix">
			<input type="text"> &euro;
		</div>
		<input type="submit" value="valider">
	</form>
  </div>
>>>>>>> 0a5f106366459ee42989c8cd393a8c35e10afe2d
</div>