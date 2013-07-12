<link rel="stylesheet" type="text/css" href="<?php echo css_url('pop_in') ?>" media="screen" />
 	 <div class="pop-in_cent">

 	<span> Modifier un concert </span>
 	
  <div class="content-pi-cent"><?php
      //appel à la function "register" du controller "user"
      
	  $user = $this->uri->segment(3);
	  $concert = $this->uri->segment(4);
	  $adresse = $this->uri->segment(5);
	?> <div class="elem_center"> <?php
      echo form_open('concert/modifier/' . $user . '/' . $concert . '/' . $adresse);
      		?><div class="label"><label>Artistes</label></div>
      				<div class="champs">

<?php
	$artiste = array(
              'class'        => 'artiste',
              'name'          => 'artiste',
	      'value'	=> $this->session->userdata('login'),
	      'placeholder'	=> 'Ex : Beach House'
            );
      echo form_input($artiste, $info_concert[0]->{'titre'});
      echo form_error('artiste', '<div class="erreur-form">', '</div>');
	  
      echo form_input('snd_partie', $info_concert[0]->{'seconde_partie'}) . "<pre>";
	  
      ?></div><div class="label"><label>Date</label></div>
      		<div class="champs">

<?php
	$date = array(
              'class'        => 'date',
              'name'          => 'date_concert',
	      'value'	=> set_value('')
            );
      echo form_date($date, substr($info_concert[0]->{'date'}, 0, 10)) . "<pre>";     
      echo form_error('date_concert', '<div class="error-form" >', '</div>');
?></div><div class="label"><label>Heure</label></div><div class="champs">
<?php
	$heure = array(
              'class'        => 'heure',
              'name'          => 'heure_concert',
	      'value'	=> set_value('')
            );
      echo form_time($heure, substr($info_concert[0]->{'date'}, 11, 10)) . "<pre>";
      ?>	</div>	
<div class="label"><label>Lieu</label></div><div class="champs">
<?php
	$salle = array(
              'class'        => 'salle',
              'name'          => 'salle',
	      'value'	=> set_value('salle'),
	      'placeholder'	=> 'Nom du bar, de la salle'
            );
      echo form_input($salle, $info_concert[0]->{'salle'});
      echo form_error('salle', '<div class="error-form" >', '</div>');
?>
<?php
	$ville = array(
              'class'        => 'ville',
              'name'          => 'ville',
	      'value'	=> set_value('ville'),
	      'placeholder'	=> 'Ville'
            );
      echo form_input($ville, $info_concert[0]->{'ville'}) . "<pre>";
      echo form_error('ville', '<div class="error-form" >', '</div>');
	?></div><div class="label"><label>Prix</label></div><div class="champs">

<?php
	$prix = array(
              'class'        => 'prix',
              'name'          => 'prix',
	      'value'	=> set_value('prix'),
	      'placeholder'	=> 'Ex : 12'
            );
      echo form_int($prix, $info_concert[0]->{'prix'}) . "<pre>";
      ?>€</div><?php
      echo form_submit('submit', 'Modifier le concert');

      echo form_close();

    ?>
	</div>
</div>


</div>
