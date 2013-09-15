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
			{echo "<span class='confirm_sup'>Modifier une photo</span><br />" ;}
		if($type==2)
			{echo "<span class='confirm_sup'>Modifier un album</span><br />" ;}
		if($type==3)
			{echo "<span class='confirm_sup'>Modifier une vidéo</span><br />" ;}
	?>
	  </div>
	 </div>
