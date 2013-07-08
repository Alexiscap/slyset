     <?php 
            //appel à la function "register" du controller "user"
      $user = $this->uri->segment(3);
	  $concert = $this->uri->segment(4);
	  $adresse = $this->uri->segment(5);

      echo form_open('mc_concerts/suppression_concert/'.$user.'/'.$concert.'/'.$adresse);
     
echo "Etes vous sur de vouloir supprimer ce concert ?" ;
 echo form_submit('delete','Supprimer le concert');
 echo form_submit('no_delete','Annuler');

      echo form_close();

?>