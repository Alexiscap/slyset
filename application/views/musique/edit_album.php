<link rel="stylesheet" type="text/css" href="<?php echo css_url('pop_in') ?>" media="screen" />
<script type="text/javascript">
    $(document).ready(function () {
        //Appel de la fonction
        if($("input[type=file]").length > 0){
            $(".upload-file-container").change(function(e){
                $in = $(this).find("input[type=file]");
                $(this).next(".upload_photo_name_file").html($in.val().replace(/C:\\fakepath\\/i, ''));
            });
        }
    });
</script>

<div class="pop-in_cent">
    <?php // print_r($album); ?>
    <span>Modifier album : <?php echo $album[0]->nom; ?></span>
        
    <div class="content-pi-cent">
        <?php // $user = $this->uri->segment(3); ?>
        <?php $uid = $this->session->userdata('uid'); ?>
        
        <p class="explication">Modifiez les informations de votre album.</p>

        <div class="elem_center">       
            <?php if(isset($success)) echo $success; ?>
            <?php if(isset($warning)) echo $warning; ?>
            <?php if(isset($failed)) echo $failed; ?>
            <?php if(isset($error)) echo $error; ?>
            <?php echo validation_errors(); ?>

            <?php echo form_open_multipart('pop_in_general/edit_album/'.$album[0]->id); ?>
            
                <?php $label_attributes = array('class'=>'label_big'); ?>
                <?php echo form_label('Cover','cover', $label_attributes); ?>
                <?php $str_album = str_replace(' ', '_', strtolower($album[0]->nom)); ?>
                <div class="preview_upload thumb" style="background-image:url('<?php echo files($uid.'/musique/'.$str_album.'/'.$album[0]->img_cover); ?>');"></div>
                <div class="upload-file-container container-thumb">
                   <input type="file" name="cover" size="200" id="upload_images_thumb" />
                </div>
                <?php $cover_name = $album[0]->img_cover; ?>
                <span class="upload_photo_name_file"><?php echo $cov_name = (empty($cover_name)) ? '' : $cover_name; ?></span>
                <?php echo form_error('cover', '<span class="error-form">', '</span>'); ?>
            
                <div class="champs">
                    <?php echo form_label('Titre','titre', $label_attributes); ?>
                    <?php echo form_input('titre', $album[0]->nom, 'id="album-title" placeholder="Nom de l\'album"'); ?>
                </div>
                
                <div class="champs">
                    <?php echo form_label('Description','description', $label_attributes); ?>
                    <?php echo form_textarea('description', $album[0]->description, 'id="album-description" placeholder="Description de l\'album"'); ?>
                </div>
                
                <div class="champs">
                    <?php echo form_label('Participants','participants', $label_attributes); ?>
                    <?php echo form_input('participants', $album[0]->participants, 'id="album-participants" placeholder="Participants à l\'album, séparez-les par une virgule"'); ?>
                </div>
                
                <div class="champs">
                    <?php echo form_label('Producteur','producteur', $label_attributes); ?>
                    <?php echo form_input('producteur', $album[0]->producteur, 'id="album-producteur" placeholder="Producteur de l\'album"'); ?>
                </div>
                
                <div class="champs">
                    <?php echo form_label('Prix','prix', $label_attributes); ?>
                    <?php echo form_input('prix', $album[0]->prix, 'id="album-prix" placeholder="Prix de l\'album"'); ?>
                </div>
                
                <div class="champs">
                    <?php echo form_label('Année','annee', $label_attributes); ?>
                    <?php echo form_input('annee', $album[0]->annee, 'id="album-annee" placeholder="Année de production de l\'album"'); ?>
                </div>

                <?php echo form_submit('valider', 'Valider'); ?>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
