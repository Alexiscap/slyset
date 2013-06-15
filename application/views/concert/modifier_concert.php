<?php
      //appel à la function "register" du controller "user"
	  $concert = $this->uri->segment(3);
	  $adresse = $this->uri->segment(4);
/*

echo form_label('What is your Name', 'username');

// Would produce: 
<label for="username">What is your Name</label>*/

      echo form_open('mc_concerts/modifier_concert/'.$concert.'/'.$adresse);
     
      echo form_label('Artiste principal', 'artiste');
      echo form_input('artiste','allez');

      echo "2eme partie".form_input('snd_partie',set_value('snd_partie'))."<pre>";
      echo "Date".form_date('date_concert',set_value(''))."<pre>";
      

      echo "Heure".form_time('heure_concert',set_value(''))."<pre>";
      echo "Salle".form_input('salle',set_value('salle'))."<pre>";

      echo "Ville".form_input('ville',set_value(''))."<pre>";

      echo "Prix".form_int('prix',set_value('prix'))."<pre>";
      
      echo form_submit('submit','Modifier le concert');

      echo form_close();

    ?>
