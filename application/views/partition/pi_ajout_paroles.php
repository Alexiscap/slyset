<link rel="stylesheet" type="text/css" href="<?php echo css_url('pop_in') ?>" media="screen" />
<script  src="<?php echo js_url('jquery-1.8.3.min') ?>" media="screen" ></script>

<script  src="<?php echo js_url('combobox') ?>" media="screen" ></script>
<script  src="<?php echo js_url('slyset') ?>" media="screen" ></script>


<div class="pop-in_cent">
	<span>Ajouter des paroles</span>

    <div class="content-pi-cent" id="paroles">
		<?php echo $error;?>

		<?php  echo form_open_multipart('pop_in_general/do_upload_paroles'); ?>
		<div class="elem_center">
		<div class="label">
				<label>Vos paroles</label>
			</div>
	    <div class="champs">
                <?php
                $data = array(
                    'name' => 'userfile',
                    'type' => 'file',
                    'class' => 'parole_up',
                    'value' => 'Choisir des paroles'
                );
                ?><div class="bt_noir bt_parole_up">
                <?php echo form_upload($data); ?>
				<!--<span class="upload_photo">aucun fichier choisi</span>-->
                </div>
            </div>
			<div class="label">
				<label>Album</label>
			</div>
			<div class="champs">
			 <div class="styled-select">
				<select name="album_doc">
					<option  value=" "> </option>

					<?php foreach($album as $one_album): ?>
						<option id="" name="album" class ="<?php echo $one_album->id?>" value="<?php echo $one_album->nom?>+<?php echo $one_album->id?>"><?php echo $one_album->nom?></option>

					<?php endforeach; ?>
				</select>
			</div>
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
			<div class="label">
				<label>Prix</label>
			</div>
			<div class="champs" >
				<input type='text' name="parole_price"><!--<img id="preview" src="http://127.0.0.1/slyset/assets/images/musicien/apercu_photo.png" alt="visuel photo">-->
			</div>
			<div id="morceaux"></div>
			<?php echo form_submit('submit', 'Ajouter des paroles'); ?>
			<?php echo form_close();?>
		</div>
	</div>
</div>
