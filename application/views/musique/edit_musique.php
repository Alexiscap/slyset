<link rel="stylesheet" type="text/css" href="<?php echo css_url('slyset') ?>" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo css_url('pop_in') ?>" media="screen" />

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
                <div class="label"><label for="titre">Titre</label></div>
				<div class="champs">
					<?php echo form_input('titre', $track->nom, array('id' => 'track-title', 'placeholder' => 'Nom du morceau')); ?>
				</div>

                <div class="label"><label for="artiste">Artiste</label></div>
				<div class="champs">
					<?php echo form_input('artiste', $track->artiste, array('id' => 'track-artist', 'placeholder' => 'Nom d\'artiste du morceau')); ?>
				</div>

                <div class="label"><label for="album">Album</label></div>
				<div class="champs alb_morceau">
					<?php 
						$options = array();
						$options[0] = 'aucun';
						foreach($albums as $album){
							$options[$album->id] = $album->nom;                     
						}
					?>
					<?php echo form_dropdown('album', $options, $track->id_alb); ?>
				</div>
				
				<div class="label"><label for="piste">N° de piste</label></div>
				<div class="champs num_morceau">
					<?php echo form_input('piste', $track->tracknumero, array('id' => 'track-piste', 'placeholder' => 'Numéro de piste', 'maxlength' => 2,'class' => 'num_piste')); ?>
				</div>
				
				<div class="label"><label for="genre">Genre</label></div>
				<div class="champs">
					<?php echo form_input('genre', $track->genre, array('id' => 'track-genre', 'placeholder' => 'Genre du morceau')); ?>
				</div>
				
                <div class="label"><label for="annee">Année</label></div>
				<div class="champs annee_morceau">
					<?php echo form_input('annee', $track->annee, array('id' => 'track-year', 'placeholder' => 'Année de production du morceau', 'maxlength' => 4)); ?>
				</div>

                <div class="label"><label for="prix">Prix</label></div>
				<div class="champs prix_morceau">
					<?php echo form_input('prix', $track->prix, array('id' => 'track-price', 'placeholder' => 'Prix du morceau')); ?>€
				</div>

                <?php echo form_submit('valider', 'Valider'); ?>
            <?php echo form_close(); ?>
        </div>
        <!--<p><a href="javascript:jQuery('#userfile').uploadifyClearQueue()">Cancel All Uploads</a></p>-->
    </div>
</div>
