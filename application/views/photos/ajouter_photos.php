<link rel="stylesheet" type="text/css" href="<?php echo css_url('pop_in') ?>" media="screen" />
<script  src="<?php echo js_url('jquery-1.8.3.min') ?>" media="screen" ></script>

<script  src="<?php echo js_url('combobox') ?>" media="screen" ></script>
<script  src="<?php echo js_url('slyset') ?>" media="screen" ></script>
<div class="pop-in_cent">

    <span>Ajouter une photo</span>

    <div class="content-pi-cent">

        <?php
        echo $error;
        $user = $this->uri->segment(3);
        ?>
        <div class="elem_center">
            <?php echo form_open_multipart('pop_in_general/do_upload/' . $user); ?>

            <div class="label"><label>Votre photo</label></div>
             <div class="champs">
                <?php
                $data = array(
                    'name' => 'photo_up',
                    'type' => 'file',
                    'class' => 'photo_up',
                    'value' => 'Choisir une photo'
                );
                ?><div class="bt_noir bt_photo_up">
                <?php echo form_upload($data); ?>
				<span class="upload_photo">Aucun fichier choisi</span>
                </div>
            </div>

            <div class="label"><label>Album</label></div>
            <div class="champs">


                <?php
                $album = array(
                    'name' => 'photo_up',
                    'type' => 'file',
                    'class' => 'photo_up',
                    'value' => 'Choisir une photo'
                );
                ?>
                            <?php 
            $place_alb = null;
            if(isset($info_album_photo)): $place_alb = $info_album_photo[0]->nom ; endif;
            ?>
                <input id="album_select" value="<?php echo $place_alb ?>" placeholder="Choisir un album" name="albums"  autocomplete="off" type="text" /><span onclick="javascript:showInfo()" class="fleche_bas"><img src="<?php echo img_url('common/flb.png'); ?>" alt="Fleche basse" /></span>

                <div id='list_albums'>

                    <ul id='tout_albums'>
                        <?php
                        for ($i = 0; $i < $max_album_user; $i++) {
                            ?>
                            <li onclick="selectalbum(event)"><?php echo $album_by_user[$i]->{'nom'}; ?></li>
                            <?php
                        }
                        ?>	
                    </ul>

                    <div id='un_album'>
                        <input  id="create" type="text" value="" autocomplete="off" placeholder="Cr&eacute;er un nouvel album"/><div id="create_ok"  onclick="selectalbumcreate()"><img src="<?php echo img_url('common/creer_album.png'); ?>" alt="ok" /></div>
                    </div>
                </div>
            </div>
            <div class="label">
                <img id='preview' src="<?php echo img_url('common/apercu_add_photo.png'); ?>" alt="visuel photo" />
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
            <?php echo form_submit('submit', 'Ajouter la photo'); ?>
        </div>
    </div>

    <?php
    echo $error;
    $user = $this->uri->segment(3);
    form_close();
    ?>

</div>
