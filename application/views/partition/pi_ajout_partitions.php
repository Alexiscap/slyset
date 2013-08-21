<link rel="stylesheet" type="text/css" href="<?php echo css_url('pop_in') ?>" media="screen" />
<script  src="<?php echo js_url('combobox') ?>" media="screen" ></script>

<div class="pop-in_cent">
	<span>Ajouter des partitions</span>

    <div class="content-pi-cent">
		<?php echo $error;?>

		<?php echo form_open_multipart('pi_ajout_partitions/do_upload');?>
		<div class="elem_center">
			<div class="label">
				<label>Vos paroles</label>
			</div>
			<div class="champs">
                <?php
                $data = array(
                    'name' => 'partition_up',
                    'type' => 'file',
                    'class' => 'photo_up',
                    'value' => 'Choisir des paroles'
                );
                ?><div class="bt_noir">
                <?php echo form_upload($data); ?>
                </div>
            </div>
			<div class="label">
				<label>Album</label>
			</div>
			<div class="champs">
                <?php
                $album = array(
                    'name' => 'partition_up',
                    'type' => 'file',
                    'class' => 'photo_up',
                    'value' => 'Choisir un album'
                );
                ?>
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
                </div>
            </div>
			<div id="morceaux"></div>
			<?php echo form_submit('submit', 'Ajouter les partitions'); ?>
			<?php echo form_close();?>
		</div>
	</div>
</div>
