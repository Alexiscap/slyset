<link rel="stylesheet" type="text/css" href="<?php echo css_url('pop_in') ?>" media="screen" />
<script  src="<?php echo js_url('combobox') ?>" media="screen" ></script>

<div class="pop-in_cent">

    <span> Modifier une photo </span>

    <div class="content-pi-cent">
     

	  <?php
        $user = $this->uri->segment(3);
		$photo = $this->uri->segment(4);
		$type = $this->uri->segment(5);
      ?>
        <div class="elem_center">
            <?php 
			echo validation_errors(); 

			echo form_open('mc_photos/update_photo/'.$user.'/'.$photo.'/'.$type);
			?>

            <div class="label"><label>Album</label></div>
            <div class="champs">
                <?php
                $album = array(
                    'name' => 'photo_up',
                    'type' => 'file',
                    'class' => 'photo_up',
                    'value' => 'Choisir une photo'
                );

               	if($type == 1||$type == 3)
				{ ?>
				
				<input value="<?php if(isset($info_album_photo[0]->nom)) echo $info_album_photo[0]->nom ?>" id="album_select" placeholder="Choisir un album" name="albums"  autocomplete="off" type="text" /><span onclick="javascript:showInfo()" class="fleche_bas"><img src="<?php echo img_url('common/flb.png'); ?>" alt="Fleche basse" /></span>
				
					<div id='test_one'>
		
						<ul id='test_two'>
						<?php 
		
						for($i=0;$i<$max_album_user;$i++)
						{	?>
							<li onclick="selectalbum(event)"><?php echo $album_by_user[$i]->{'nom'};?></li>
							<?php  		
						}
						?>	
					</ul>
					
					<div id='test_three'>
                        <input  id="create" type="text" value="" autocomplete="off" placeholder="creer un nouvel album"/><div id="create_ok"  onclick="selectalbumcreate()"><img src="<?php echo img_url('common/creer_album.png'); ?>" alt="ok" /></div>
                    </div>
				</div>
			<?php }?>

            </div>
            <div class="label">
                <img src="<?php echo img_url('musicien/apercu_photo.png'); ?>" alt="visuel photo" />
            </div>
            <div class="champs">
                <?php
                $descri = array(
                    'name' => 'description',
                    'class' => 'descript-vid',
                    'maxlength' => '110',
                    'placeholder' => 'Ajouter une description',
                );
                echo form_textarea($descri);
                ?>
            </div>
            <?php echo form_submit('submit', 'Modifier la photo'); ?>
        </div>
    </div>

    <?php
    $user = $this->uri->segment(3);
    form_close();
    ?>

</div>
	 
	 
	 
	 
	 
	 
	 
	 
	 


