<link rel="stylesheet" type="text/css" href="<?php echo css_url('pop_in') ?>" media="screen" />
<script  src="<?php echo js_url('combobox') ?>" media="screen" ></script>

<div class="pop-in_cent">

	<?php 
				//appel à la function "register" du controller "user"
				$user = $this->uri->segment(3);
				$media = $this->uri->segment(4);
				$type = $this->uri->segment(5);

		if($type==1)
			{echo "<span class='confirm_sup'>Modifier une photo</span><br />" ;}
		if($type==2)
			{echo "<span class='confirm_sup'>Modifier l'album</span><br />" ;}
		if($type==3)
			{echo "<span class='confirm_sup'>Modifier une vidéo</span><br />" ;}
	?>

    <div class="content-pi-cent">
     

	  <?php
        $user = $this->uri->segment(3);
		$photo = $this->uri->segment(4);
		$type = $this->uri->segment(5);
      ?>
        <div class="elem_center">
            <?php 
			 

			echo form_open('media/editer/'.$user.'/'.$photo.'/'.$type);
			
	if($type == 1||$type == 3)
				{ ?>
            <div class="label"><label>Album</label></div>
            <?php } ?>
            
                <?php
               /* $album = array(
                    'name' => 'photo_up',
                    'type' => 'file',
                    'class' => 'photo_up',
                    'value' => 'Choisir une photo'
                );*/

               	if($type == 1||$type == 3)
				{ ?>
				<div class="champs">
				<input value="<?php if(isset($info_album_photo[0]->nom)) echo $info_album_photo[0]->nom ?>" id="album_select" placeholder="Choisir un album" name="albums"  autocomplete="off" type="text" /><span onclick="javascript:showInfo()" class="fleche_bas"><img src="<?php echo img_url('common/flb.png'); ?>" alt="Fleche basse" /></span>
				
					<div id='list_albums'>
		
						<ul id='tout_albums'>
							<?php 
		
							for($i=0;$i<$max_album_user;$i++)
							{	?>
								<li onclick="selectalbum(event)"><?php echo $album_by_user[$i]->{'nom'};?></li>
								<?php  		
							}
							?>	
						</ul>
					
					<div id='un_album'>
                        <input  id="create" type="text" value="" autocomplete="off" placeholder="Créer un nouvel album"/><div id="create_ok"  onclick="selectalbumcreate()"><img src="<?php echo img_url('common/creer_album.png'); ?>" alt="ok" /></div>
                    </div>
				</div>
				</div>
			<?php }else if($type == 2)
				{ ?>
				<!--
				<div class="champs">
				<input value="<?php if(isset($info_album_photo[0]->nom)) echo $info_album_photo[0]->nom ?>" id="album_select" placeholder="<?php if(isset($info_album_photo[0]->nom)) echo $info_album_photo[0]->nom ?>" name="albums"  autocomplete="off" type="text" /><span onclick="javascript:showInfo()" class="fleche_bas"><img src="<?php echo img_url('common/flb.png'); ?>" alt="Fleche basse" /></span>
				
					<div id='list_albums'>
		
						<ul id='tout_albums'>
						<?php 
		
						for($i=0;$i<$max_album_user;$i++)
						{	?>
							<li onclick="selectalbum(event)"><?php echo $album_by_user[$i]->{'nom'};?></li>
							<?php  		
						}
						?>	
					</ul>
					
					<div id='un_album'>
                        <input  id="create" type="text" value="" autocomplete="off" placeholder="creer un nouvel album"/><div id="create_ok"  onclick="selectalbumcreate()"><img src="<?php echo img_url('common/creer_album.png'); ?>" alt="ok" /></div>
                    </div>
				</div>
		

            </div>
            -->
            	<?php  }?>
            <?php
            if($type==1)
            {
            	?>
            	 			<div class="label">
            	 			<?php
            	 			if(isset($info_album_photo[0]))
            	 			{

            	 				?>
            	 			                <img id='preview' src="<?php echo base_url('/files/'.$user.'/photos/'.$info_album_photo[0]->file_name.'/'.$info_photo[0]->file_name); ?>" alt="visuel photo" />
<?php }
else{ ?>
                <img id='preview' src="<?php echo base_url('/files/'.$user.'/photos/'.$info_photo[0]->file_name); ?>" alt="visuel photo" />
           <?php } ?>
            </div>
            <?php }
            else{ ?>
            <div class="label">
                <label>Description</label>
            </div>
            <?php }?>
            <div class="champs">
                <?php
                $place_alb = "Ajouter une description" ;
                 if(isset($info_album_photo[0]->nom)): $place_alb = $info_album_photo[0]->nom ; endif;
                 if(isset($info_photo[0]->nom)): $place_alb = $info_photo[0]->nom ; endif;

                $descri = array(
                    'name' => 'description',
                    'class' => 'descript-vid',
                    'maxlength' => '110',
                    'placeholder' => $place_alb,
                    'value' => $place_alb,
                );
                echo form_textarea($descri);
                ?>
            </div>

			<?php
				echo validation_errors();
			?>
		


            <?php 
				if($type==1)
					{echo form_submit('submit', 'Modifier la photo');}
				if($type==2)
					{echo form_submit('submit', 'Modifier l\'album');}
				if($type==3)
					{echo form_submit('submit', 'Modifier la vidéo');}
			?>
        </div>
    </div>

    <?php
    $user = $this->uri->segment(3);
    form_close();
    ?>

</div>
	 
	 
	 
	 
	 
	 
	 
	 
	 


