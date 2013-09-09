<link rel="stylesheet" type="text/css" href="<?php echo css_url('pop_in') ?>" media="screen" />
<script  src="<?php echo js_url('jquery-1.8.3.min') ?>" media="screen" ></script>

<script  src="<?php echo js_url('combobox') ?>" media="screen" ></script>
<script  src="<?php echo js_url('slyset') ?>" media="screen" ></script>


<div class="pop-in_cent">
	<span>Modifier le livret de l'album : <?php echo $album[0]->nom?></span>

    <div class="content-pi-cent">
		<?php echo $error;?>

		<?php  echo form_open_multipart('pop_in_general/update_file_livret'); ?>
		<div class="elem_center">
		<div class="label">
				<label>Votre livret</label>
			</div>
			<div class="champs">
                <?php
                $data = array(
                    'name' => 'userfile',
                    'type' => 'file',
                    'class' => 'livret_new',
                    'value' => 'Choisir un livret'
                );
                ?>
                <div class="bt_noir">
                	<?php echo form_upload($data); ?>
                </div>
            </div>
			<div style='visibility: hidden' class="label">
				<label>Album</label>
			</div>
			<div style='visibility: hidden' class="champs">
			
				<select name="livret">

						<option id="" name="album" class ="<?php echo $id_alb?>" value="<?php echo $album[0]->nom?>+<?php echo $album[0]->id?>"><?php echo $album[0]->nom?></option>

				</select>
			</div>
		
			<div id="morceaux"></div>
			
            <?php
                /*
                $album = array(
                    'name' => 'livret_up',
                    'type' => 'file',
                    'class' => 'photo_up',
                    'value' => 'Choisir un album'
                );
                */
                ?>
                <!--
                <input id="album_select" placeholder="Choisir un album" name="albums"  autocomplete="off" type="text" /><span onclick="javascript:showInfo()" class="fleche_bas"><img src="<?php echo img_url('common/flb.png'); ?>" alt="Fleche basse" /></span>

                <div id='test_one'>

                    <ul id='test_two'>
                        <?php
                        /* for ($i = 0; $i < $max_album_user; $i++) {
                            ?>
                            <li onclick="selectalbum(event)"><?php echo $album_by_user[$i]->{'nom'}; ?></li>
                            <?php
                        } */
                        ?>
                    </ul>

                    <div id='test_three'>
						<input  id="create" type="text" value="" autocomplete="off" placeholder="creer un nouvel album"/><div id="create_ok"  onclick="selectalbumcreate()"><img src="<?php echo img_url('common/creer_album.png'); ?>" alt="ok" /></div>
						      
                	</div>
            </div>-->
            
            <!--
			<div class="label">
				<label>Aperçu</label>
			</div>
			<div class="champs" >
				<img id="preview" src="http://127.0.0.1/slyset/assets/images/musicien/apercu_photo.png" alt="visuel photo">
			</div>
			-->
			<div id="morceaux"></div>
			<?php 
				$delete = array(
              'class'        => 'delete',
              'name'          => 'delete',
			  'value'	=> 'Supprimer le livret',
              );
			
			  echo form_submit($delete);
			  
			  $nodelete = array(
              'class'        => 'submit',
              'name'          => 'submit',
			  'value'	=> 'Modifier le livret',
              );
			
			  echo form_submit($nodelete);
			

			 echo form_close();?>
		</div>
	</div>
</div>
