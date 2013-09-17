<link rel="stylesheet" type="text/css" href="<?php echo css_url('pop_in') ?>" media="screen" />
<div class="pop-in_cent">

 	<span> Modifier un concert </span>
 	
  	<div class="content-pi-cent"><?php
      //appel à la function "register" du controller "user"
	  	$user = $this->uri->segment(3);
	  	$concert = $this->uri->segment(4);
	  	$adresse = $this->uri->segment(5);
		?>
		<div class="elem_center"> <?php
      		echo form_open('concert/modifier/' . $user . '/' . $concert . '/' . $adresse);
      		?>
      		<div class="label"><label>Artistes</label>
      		</div>
      		<div class="champs">

				<?php
				$artiste = array(
              		'class'        => 'artiste',
              		'name'         => 'artiste',
	      			'value'	=> $this->session->userdata('login'),
	      			'placeholder'	=> 'Ex : Beach House'
           		);
      			echo form_input($artiste, $info_concert[0]->{'titre'});
      			echo form_error('artiste', '<div class="erreur-form">', '</div>');
	  
      			echo form_input('snd_partie', $info_concert[0]->{'seconde_partie'});
	  
      			?>
      		</div>
      		<div class="label">
      			<label>Date</label>
      		</div>
      		<div class="champs">

				<?php
				$date = array(
              		'class'        	=> 'date',
              		'name'         	=> 'date_concert',
	      			'value'			=> substr($info_concert[0]->{'date'}, 0, 10)
            	);
      			
      			echo form_date($date);     
      			echo form_error('date_concert', '<div class="error-form" >', '</div>');
				?>
			</div>
			
			<div class="label">
				<label>Heure</label>
			</div>
			
			<div class="champs">
				<?php
				$heure = array(
              		'class'        	=> 'heure',
              		'name'          => 'heure_concert',
	      			'value'			=> substr($info_concert[0]->{'date'}, 11, 10)
            	);
      			
      			echo form_time($heure);
      			?>	
      		</div>	
			
			<div class="label">
				<label>Lieu</label>
			</div>
			<div class="champs">
				<?php
				$salle = array(
              		'class'        	=> 'salle',
              		'name'         	=> 'salle',
	      			'value'			=> $info_concert[0]->{'salle'},
	      			'placeholder'	=> 'Nom du bar, de la salle'
            	);
     			 echo form_input($salle, $info_concert[0]->{'salle'});
      			echo form_error('salle', '<div class="error-form" >', '</div>');

				$ville = array(
            		'class'        => 'ville',
              		'name'          => 'ville',
	      			'value'	=>  $info_concert[0]->{'ville'},
	      			'placeholder'	=> 'Ville'
            	);
      			
      			echo form_input($ville);
      			echo form_error('ville', '<div class="error-form" >', '</div>');
				?>
			</div>
			
			<div class="label">
				<label>Prix</label>
			</div>
			
			<div class="champs">

				<?php
				$prix = array(
	              	'class'        	=> 'prix',
    	          	'name'          => 'prix',
	    	  		'value'			=>  $info_concert[0]->{'prix'},
	      			'placeholder'	=> 'Ex : 12'
            	);
     			
     			echo form_int($prix) . "<span class='euro'>";
     			?>
     			€
     		</div>
     		<?php
       		$submit = array(
            	'class'        => 'modif_concert',
            	'name'          => 'submit',
	      		'value'	=> 'Modifier le concert',
            );
      		echo form_submit($submit);

      		echo form_close();

    ?>
		</div>
	</div>
</div>
