<link rel="stylesheet" type="text/css" href="<?php echo css_url('pop_in') ?>" media="screen" />
 	 <div class="pop-in_cent confirmation">
		<span></span>
	  <div class="content-pi-cent content-pi-cent_success">
		<?php 
				//appel à la function "register" du controller "user"
				$user = $this->uri->segment(3);
				$media = $this->uri->segment(4);
				$type = $this->uri->segment(3);
			echo "<span class='confirm_sup'>".$message_success."</span><br />";
		//if($type==1)
		//	{echo "<span class='confirm_sup'>La photo a bien été ".$verbe."</span><br />" ;}
		//if($type==2)
		//	{echo "<span class='confirm_sup'>La photo a bien été ".$verbe."</span><br />" ;}
		//if($type==3)
		//	{echo "<span class='confirm_sup'>La video a bien été ".$verbe."</span><br />" ;}
	?>
	
	  </div>
	 </div>
