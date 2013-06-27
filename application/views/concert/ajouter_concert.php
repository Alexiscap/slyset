<link rel="stylesheet" type="text/css" href="http://127.0.0.1/slyset/assets/css/slyset.css" media="screen" />
 	 <div class="pop-in">

 	<p> Ajouter un concert </p>
 		 <img src="<?php echo img_url('musicien/pop_close.png'); ?>" alt="Fermer" />
  <div class="content-pi"><?php
      //appel à la function "register" du controller "user"
      
	  $user = $this->uri->segment(3);

      echo form_open('mc_concerts/ajouter_concert/'.$user);
      		?><div class="label"><label>Artiste principal</label></div>
      				<div class="champs">

<?php
      echo form_input('artiste', $this->session->userdata('login'),'placeholder="Ex : Beach House"')."<pre>";
      echo form_error('artiste', '<div>', '</div>');

      echo form_input('snd_partie',set_value('snd_partie'),'placeholder="Ex : Lower Dens"')."<pre>";
      ?></div><div class="label"><label>Date</label></div>
      		<div class="champs">

<?php
      echo form_date('date_concert',set_value(''))."<pre>";
      
      echo form_error('date_concert', '<div class="error-form" >', '</div>');
?></div><div class="label"><label>Heure</label></div><div class="champs">
<?php
      echo form_time('heure_concert',set_value(''))."<pre>";
      ?>	</div>	
<div class="label"><label>Salle</label></div><div class="champs">
<?php
      echo form_input('salle',set_value('salle'),'placeholder="Ex : Le Grand Mix"')."<pre>";
      echo form_error('salle', '<div class="error-form" >', '</div>');
?></div><div class="label"><label>Ville</label></div><div class="champs">
<?php
      echo form_input('ville',set_value('ville'),'placeholder="Ex : Lille"')."<pre>";
      echo form_error('ville', '<div class="error-form" >', '</div>');
	?></div><div class="label"><label>Prix</label></div><div class="champs_prix">

<?php
      echo form_int('prix',set_value('prix'),'placeholder="Ex : 12"')."<pre>";
      ?></div><?php
      echo form_submit('submit','Ajouter un concert');

      echo form_close();

    ?>
</div>

</div>
</div>