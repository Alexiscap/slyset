<?php
      //appel à la function "register" du controller "user"
      $user = $this->uri->segment(3);
	  $concert = $this->uri->segment(4);
	  $adresse = $this->uri->segment(5);

      echo form_open('mc_concerts/modifier_concert/'.$user.'/'.$concert.'/'.$adresse);
     
      echo form_label('Artiste principal', 'artiste');
      echo form_input('artiste',$info_concert[0]->{'titre'});

      echo "2eme partie".form_input('snd_partie',$info_concert[0]->{'seconde_partie'})."<pre>";
      echo "Date".form_date('date_concert',substr($info_concert[0]->{'date'},0,10))."<pre>";
      

      echo "Heure".form_time('heure_concert',substr($info_concert[0]->{'date'},11,10))."<pre>";
      echo "Salle".form_input('salle',$info_concert[0]->{'salle'})."<pre>";

      echo "Ville".form_input('ville',$info_concert[0]->{'ville'})."<pre>";

      echo "Prix".form_int('prix',$info_concert[0]->{'prix'})."<pre>";
      
      echo form_submit('submit','Modifier le concert');

      echo form_close();

    ?>
