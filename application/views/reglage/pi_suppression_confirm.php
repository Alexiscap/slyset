<link rel="stylesheet" type="text/css" href="<?php echo css_url('pop_in') ?>" media="screen" />

 	 <div class="pop-in_cent">

 	<span>Confirmation suppression</span>

  <div class="content-pi-cent"><?php
      //appel à la function "register" du controller "user"
      
	  $user = $this->uri->segment(3);
	?> <div class="elem_center"> <?php
      echo form_open('melo_reglages/delete_user/'.$user);
      		?>
      				<!--<div class="champs">-->
      <div>Êtes-vous sûr de vouloir supprimer votre compte Slyset ? Cette opération est irreversible !</div>

<?php
//print_r($this->session->all_userdata());

      echo form_submit('confirm-oui','Oui');
      echo form_submit('confirm-non','Non');

      echo form_close();

    ?>
	<!--</div>-->
</div>


</div>
