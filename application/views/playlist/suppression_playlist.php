<link rel="stylesheet" type="text/css" href="<?php echo css_url('pop_in') ?>" media="screen" />
 
 	 <div class="pop-in_cent confirmation">
		<span></span>
		<div class="content-pi-cent content-pi-cent_success">
			<?php 
            //appel à la function "register" du controller "user"
			  $user = $this->uri->segment(3);
			  $concert = $this->uri->segment(4);
			  $adresse = $this->uri->segment(5);

			  echo form_open('pop_in_general/delete_playlist/'.$user);
     
			  echo "<p class='confirm_sup'>Etes vous sur de vouloir supprimer cette playlist ?</p><br />" ;
			  
			  $delete = array(
              'class'        => 'delete',
              'name'          => 'delete',
			  'value'	=> 'Supprimer',
              );
			
			  echo form_submit($delete);
			  
			  $nodelete = array(
              'class'        => 'nodelete',
              'name'          => 'no_delete',
			  'value'	=> 'Annuler',
              );
			
			  echo form_submit($nodelete);

			  echo form_close();
			?>
		</div>
	 </div>