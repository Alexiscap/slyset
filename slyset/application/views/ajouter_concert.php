<?php
      //appel à la function "register" du controller "user"
      
	  $user = $this->uri->segment(3);

      echo form_open('mc_concerts/ajouter_concert/'.$user);
      echo "Artiste principal".form_input('artiste',set_value('artiste'),'placeholder="Ex : Beach House"')."<pre>";
      echo form_error('artiste', '<div>', '</div>');

      echo "2eme partie".form_input('snd_partie',set_value('snd_partie'),'placeholder="Ex : Lower Dens"')."<pre>";
      echo "Date".form_date('date_concert',set_value(''))."<pre>";
      
      echo form_error('date_concert', '<div class="error-form" >', '</div>');

      echo "Heure".form_time('heure_concert',set_value(''))."<pre>";
      echo "Salle".form_input('salle',set_value('salle'),'placeholder="Ex : Le Grand Mix"')."<pre>";
      echo form_error('salle', '<div class="error-form" >', '</div>');

      echo "Ville".form_input('ville',set_value('ville'),'placeholder="Ex : Lille"')."<pre>";
      echo form_error('ville', '<div class="error-form" >', '</div>');

      echo "Prix".form_int('prix',set_value('prix'),'placeholder="Ex : 12"')."<pre>";
      
      echo form_submit('submit','Ajouter un concert');

      echo form_close();

    ?>
