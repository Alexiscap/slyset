<link rel="stylesheet" type="text/css" href="<?php echo css_url('pop_in') ?>" media="screen" />
<script  src="<?php echo js_url('jquery-1.8.3.min') ?>" media="screen" ></script>

<script  src="<?php echo js_url('combobox') ?>" media="screen" ></script>
<script  src="<?php echo js_url('slyset') ?>" media="screen" ></script>


<div class="pop-in_cent">
    <span>Ajouter une partition</span>

    <div class="content-pi-cent" id="partition">
        <?php echo $error;?>

        <?php  echo form_open_multipart('pop_in_general/do_upload_partition'); ?>
        <div class="elem_center">
        <div class="label">
                <label>Votre partition</label>
            </div>
        <div class="champs">
                <?php
                $data = array(
                    'name' => 'userfile',
                    'type' => 'file',
                    'class' => 'partition_up',
                    'value' => 'Choisir une partition'
                );
                ?><div class="bt_noir bt_partition_up">
                <?php echo form_upload($data); ?>
                <!--<span class="upload_photo">aucun fichier choisi</span>-->
                </div>
            </div>
            <div class="label">
                <label>Album</label>
            </div>
            <div class="champs">
            
                <select name="album_doc">
                    <option  value=" "> </option>

                    <?php foreach($album as $one_album): ?>
                        <option id="" name="album" class ="<?php echo $one_album->id?>" value="<?php echo $one_album->nom?>+<?php echo $one_album->id?>"><?php echo $one_album->nom?></option>

                    <?php endforeach; ?>
                </select>
            </div>
        
            <div id="morceaux"></div>

            <div class="label">
                <label>Prix</label>
            </div>
            <div class="champs" >
                <input type='text' name="partition_price"><!--<img id="preview" src="http://127.0.0.1/slyset/assets/images/musicien/apercu_photo.png" alt="visuel photo">-->
            </div>
            <div id="morceaux"></div>
            <?php echo form_submit('submit', 'Ajouter une partition'); ?>
            <?php echo form_close();?>
        </div>
    </div>
</div>
