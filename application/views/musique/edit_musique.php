<link rel="stylesheet" type="text/css" href="<?php echo css_url('pop_in') ?>" media="screen" />
<script type="text/javascript">
//    $(document).ready(function () {
//        var base_url = '<?php echo base_url(); ?>';
//
//        $('#upload-file').click(function (e) {
//            e.preventDefault();
//            $('#userfile').uploadify('upload', '*');
//        });
//    });
</script>

<div class="pop-in_cent">
    <?php // print_r($track); ?>
    <span>Modifier morceau : <?php echo $track->nom; ?></span>
        
    <div class="content-pi-cent">
        <?php $user = $this->uri->segment(3); ?>
        <?php $uid = $this->session->userdata('uid'); ?>
        
        <p class="explication">Modifier vos tags ID3 vous permettra de changer les informations pour chacune de vos musiques, mais aussi d'en modifier l'affichage sur Slyset. Le changement des tags influent directement sur les fichiers-même.</p>

        <div class="elem_center">       
            <?php if(isset($success)) echo $success; ?>
            <?php if(isset($warning)) echo $warning; ?>
            <?php if(isset($failed)) echo $failed; ?>
            <?php if(isset($error)) echo $error; ?>
            <?php echo validation_errors(); ?>

            <?php echo form_open_multipart('pop_in_general/edit_musique/'.$uid.'/'.$track->id); ?>
            <ul class="unstyled">
                <?php echo form_label('Titre', 'titre'); ?>
                <?php echo form_input('titre', $track->nom, array('id' => 'track-title', 'placeholder' => 'Nom du morceau')); ?>

                <?php echo form_label('Artiste', 'artiste'); ?>
                <?php echo form_input('artiste', $track->artiste, array('id' => 'track-artist', 'placeholder' => 'Nom d\'artiste du morceau')); ?>

                <?php echo form_label('N° de piste', 'piste'); ?>
                <?php echo form_input('piste', $track->tracknumero, array('id' => 'track-piste', 'placeholder' => 'Numéro de poste', 'maxlength' => 2)); ?>

                <?php echo form_label('Album', 'album'); ?>
                <?php 
                    $options = array();
                    $options[0] = 'aucun';
                    foreach($albums as $album){
                        $options[$album->id] = $album->nom;                     
                    }
                ?>
                <?php echo form_dropdown('album', $options, $track->id_alb); ?>

                <?php echo form_label('Année', 'annee'); ?>
                <?php echo form_input('annee', $track->annee, array('id' => 'track-year', 'placeholder' => 'Année de production du morceau', 'maxlength' => 4)); ?>

                <?php echo form_label('Genre', 'genre'); ?>
                <?php echo form_input('genre', $track->genre, array('id' => 'track-genre', 'placeholder' => 'Genre du morceau')); ?>

                <?php echo form_label('Prix', 'prix'); ?>
                <?php echo form_input('prix', $track->prix, array('id' => 'track-price', 'placeholder' => 'Prix du morceau')); ?>

                <?php echo form_submit('valider', 'Valider'); ?>
            </ul>
            <?php echo form_close(); ?>
        </div>
        
        <!--<p><a href="javascript:jQuery('#userfile').uploadifyClearQueue()">Cancel All Uploads</a></p>-->
    </div>
</div>