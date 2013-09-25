<link rel="stylesheet" type="text/css" href="<?php echo css_url('pop_in') ?>" media="screen" />
<script  src="<?php echo js_url('jquery-1.8.3.min') ?>" media="screen" ></script>

<script  src="<?php echo js_url('combobox') ?>" media="screen" ></script>
<script  src="<?php echo js_url('slyset') ?>" media="screen" ></script>


<div class="pop-in_cent">
	<span>Modifier les paroles du morceau: <?php echo $document[0]->name_track ?></span>

    <div class="content-pi-cent">
		<?php echo $error;?>

		<?php  echo form_open_multipart('pop_in_general/update_file_paroles/'.$document[0]->doc_id); ?>
		<div class="elem_center">
		<div class="label">
				<label>Vos paroles</label>
			</div>
			<div class="champs">
                <?php
                $data = array(
                    'name' => 'userfile',
                    'type' => 'file',
                    'class' => 'livret_up',
                    'value' => 'Choisir des paroles'
                );
                ?>
                <div class="bt_noir bt_livret_up">
                	<?php echo form_upload($data); ?>
                </div>
            </div>

            <div class="label">
                <label>Prix</label>
            </div>
            <div class="champs" >
                <input type='text' name="parole_price" value="<?php if(isset($document[0]->prix)) echo $document[0]->prix ?>"><!--<img id="preview" src="http://127.0.0.1/slyset/assets/images/musicien/apercu_photo.png" alt="visuel photo">-->
            </div>

		
			
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
			
			<?php 
				$delete = array(
              'class'        => 'delete',
              'name'          => 'delete',
			  'value'	=> 'Supprimer',
              );
			
			  echo form_submit($delete);
			  
			  $nodelete = array(
              'class'        => 'submit submit_paroles',
              'name'          => 'submit',
			  'value'	=> 'Modifier les paroles',
              );
			
			  echo form_submit($nodelete);
			

			 echo form_close();?>
		</div>
	</div>
</div>
