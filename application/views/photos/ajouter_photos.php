<link rel="stylesheet" type="text/css" href="http://127.0.0.1/slyset/assets/css/slyset.css" media="screen" />
<script  src="http://127.0.0.1/slyset/assets/javascript/combobox.js" media="screen" ></script>

<div class="pop-in_cent">

    <span> Ajouter une photo </span>

    <div class="content-pi-cent">

        <?php
        echo $error;
        $user = $this->uri->segment(3);
        ?>
        <div class="elem_center">
            <?php echo form_open_multipart('mc_photos/do_upload/' . $user); ?>

            <div class="label"><label>Votre photo</label></div>
            <div class="champs">
                <?php
                $data = array(
                    'name' => 'photo_up',
                    'type' => 'file',
                    'class' => 'photo_up',
                    'value' => 'Choisir une photo'
                );
                ?><div class="bt_noir">
                <?php echo form_upload($data); ?>
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
                <input id="album_select" placeholder="Choisir un album" name="albums"  autocomplete="off" type="text" /><span onclick="javascript:showInfo()" class="fleche_bas"><img src="<?php echo img_url('common/flb.png'); ?>" alt="Fleche basse" /></span>

                <div id='test_one'>

                    <ul id='test_two'>
                        <?php
                        for ($i = 0; $i < $max_album_user; $i++) {
                            ?>
                            <li onclick="selectalbum(event)"><?php echo $album_by_user[$i]->{'nom'}; ?></li>
                            <?php
                        }
                        ?>	
                    </ul>

                    <div id='test_three'>
                        <input  id="create" type="text" value="" autocomplete="off" placeholder="creer un nouvel album"/><div id="create_ok"  onclick="selectalbumcreate()">ok</div>
                    </div>
                </div>
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
            <?php echo form_submit('submit', 'Ajouter la photo'); ?>
        </div>
    </div>

    <?php
    echo $error;
    $user = $this->uri->segment(3);
    form_close();
    ?>

</div>