<link rel="stylesheet" type="text/css" href="<?php echo css_url('pop_in') ?>" media="screen" />
 	 <div class="pop-in_cent confirmation">
		<span></span>
	  <div class="content-pi-cent content-pi-cent_success">
		<?php 
				//appel à la function "register" du controller "user"
				$user = $this->uri->segment(3);
				$media = $this->uri->segment(4);
				$type = $this->uri->segment(5);

		if($type==1)
			{echo "<p class='confirm_sup'>Votre photo a bien été ajoutée !</p>" ;}
		if($type==2)
			{echo "<p class='confirm_sup'>Votre album a bien été modifié !</p>" ;}
		if($type==3)
			{echo "<p class='confirm_sup'>Votre vidéo a bien été ajoutée !</p>" ;}
	?>
	  </div>
	 </div>
