      <?php 
            //appel à la function "register" du controller "user"
      $user = $this->uri->segment(3);
	  $media = $this->uri->segment(4);
	  $type = $this->uri->segment(5);

      echo form_open('mc_photos/suppression_media/'.$user.'/'.$media.'/'.$type);
     if($type==1)
     {
echo "Etes vous sur de vouloir supprimer cette photo ?" ;
 echo form_submit('delete','Supprimer la photo');
 echo form_submit('no_delete','Annuler');
}

     if($type==2)
     {
echo "Etes vous sur de vouloir supprimer cet album ?" ;
 echo form_submit('delete',"Supprimer l'album");
 echo form_submit('no_delete','Annuler');
}
     if($type==3)
     {
echo "Etes vous sur de vouloir supprimer cette video ?" ;
 echo form_submit("delete","Supprimer la video");
 echo form_submit('no_delete','Annuler');
}

      echo form_close();
?>