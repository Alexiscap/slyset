<link rel="stylesheet" type="text/css" href="<?php echo css_url('pop_in') ?>" media="screen" />
 	 <div class="pop-in_cent confirmation">
		<span></span>
		<div class="content-pi-cent">
			<?php 
				//appel à la function "register" du controller "user"
				$user = $this->uri->segment(3);
				$media = $this->uri->segment(4);
				$type = $this->uri->segment(5);

      echo form_open('/media/supprimer/'.$user.'/'.$media.'/'.$type);
     if($type==1)
     {
 	
					echo "<p class='confirm_sup'>Etes vous sur de vouloir supprimer cette photo ?</p>" ;
					
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
				}

				if($type==2)
				{
					echo "<p class='confirm_sup'>Etes vous sur de vouloir supprimer cet album ?</p>" ;
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
				}
				if($type==3)
				{
					echo "<p class='confirm_sup'>Etes vous sur de vouloir supprimer cette video ?</p>" ;
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
				}

				echo form_close();
			?>
		</div>
	 </div>
