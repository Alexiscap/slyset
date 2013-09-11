<?php
    $session_id = $this->session->userdata('uid');
    $uid = (empty($session_id)) ? '' : $session_id;
    $uid_visit = (empty($infos_profile)) ? $session_id : $infos_profile->id;
    $login = (empty($infos_profile)) ? $this->session->userdata('login') : $infos_profile->login;
?>

<div id="contentAll">
    <div id="breadcrumbs">
        <ul>
            <li><a href="<?php echo site_url('home/' . $uid); ?>">Accueil</a></li>
            <li><a href="<?php echo site_url('my-wall/' . $uid_visit); ?>">Mon compte</a></li>
            <li><a href="<?php echo site_url($this->uri->segment(1) . '/' . $uid_visit); ?>">Mes réglages</a></li>
        </ul>
    </div>
  
    <div id="cover" style="background-image:url(<?php echo files('profiles/'.$cover = (empty($infos_profile)) ? $this->session->userdata('cover') : $infos_profile->cover); ?>);">
        <div id="infos-cover">
            <h2><?php echo $login; ?></h2><!--
            <a href="#"><span class="button_left"></span><span class="button_center">Suivre</span><span class="button_right"></span></a>
       --> </div>
    </div>

    <div id="stats-cover">
        <div class="stats_cover_block">
            <span class="stats_number">489</span>
            <span class="stats_title">écoutes</span>
        </div>
       
        <div class="stats_cover_block">
                
            <span class="stats_number">
                <?php 
                $npl = 0;
                if(empty($playlists)!=1):
                    $npl =  count($playlists);
                endif;
                echo $npl;?>
            </span>
            <span class="stats_title">
                <?php
                if($npl == 0 || $npl == 1){
                    echo 'playlist';
                }
                else
                {
                    echo 'playlists';
                }
                ?>
            </span>
        </div>

        <div class="stats_cover_block">
            <span class="stats_number">
                <?php
                $nab = 0;
                if(empty($all_following)!=1):
                    $nab =  count($all_following);
                endif;
                echo $nab;
                 ?>
            </span>       
            <span class="stats_title">
                <?php
                if($nab == 0 || $nab == 1){
                    echo 'abonnement';
                }
                else
                {
                    echo 'abonnements';
                }
                ?>
            </span>
        </div>
    </div>

    <div class="content">
        <h1>Modifier mon profil</h1>
        
        <p class="detail_reglages">Cette page vous permet d’ajouter et/ou de modifier les informations qui figurent sur votre profil.</p>

        <?php
            echo form_open_multipart('my-reglages/update_user/'.$session_id);
        ?>
        
        
        <div id="subscription-upload">
            <!--<div class="upload_images"></div>-->

            <?php $label_attributes = array('class'=>'label_big'); ?>
            <?php $label_attributes_password = array('class'=>'label_big label_password'); ?>
            
            <?php echo form_label('Votre photo','thumb', $label_attributes); ?>
            <div class="preview_upload thumb" style="background-image:url(<?php echo files('profiles/'.$this->session->userdata('thumb')); ?>);"></div>
            <div class="upload-file-container container-thumb">
               <input type="file" name="thumb" size="200" id="upload_images_thumb" />
            </div>
            <?php $thb_name = $this->session->userdata('thumb'); ?>
            <span class="upload_photo_name_file"><?php echo $thumb_name = (empty($thb_name)) ? '' : $thb_name; ?></span>
            <?php echo form_error('thumb', '<span class="error-form">', '</span>'); ?>
            
            <?php echo form_label('Votre en-tête','cover', $label_attributes); ?>
            <div class="preview_upload cover" style="background-image:url(<?php echo files('profiles/'.$this->session->userdata('cover')); ?>);"></div>
            <div class="upload-file-container container-cover">
                <input type="file" name="cover" size="200" id="upload_images_cover" />
            </div>
            <?php $cov_name = $this->session->userdata('cover'); ?>
            <span class="upload_photo_name_file"><?php echo $cover_name = (empty($cov_name)) ? '' : $cov_name; ?></span>
            <?php echo form_error('cover', '<span class="error-form">', '</span>'); ?>
        </div>

        <hr>

    <?php
        $ph = '';
//          print_r($profile);
            echo form_label($ph = ($this->session->userdata('account') == 2) ? 'Nom de scène' : 'Nom d\'utilisateur', 'login', $label_attributes);
            echo form_input('login', $profile->login,'placeholder="Votre nom d\'utilisateur"');
            echo form_error('login', '<span class="error-form">', '</span>');
            
            echo form_label('Prenom', 'prénom', $label_attributes);
            echo form_input('prenom', $profile->prenom,'placeholder="Votre prénom"');
            echo form_error('prenom', '<span class="error-form">', '</span>');

            echo form_label('Nom', 'nom', $label_attributes);
            echo form_input('nom', $profile->nom,'placeholder="Votre nom"');
            echo form_error('nom', '<span class="error-form">', '</span>');

            echo form_label('Email', 'email', $label_attributes);
            echo form_input('email', $profile->mail,'placeholder="Votre email"');
            echo form_error('email', '<span class="error-form">', '</span>');
            
            echo form_label('Bio', 'bio', $label_attributes);
            echo form_textarea('description', $profile->description,'placeholder="Votre description"');
            echo form_error('description', '<span class="error-form">', '</span>');

            echo '<hr>';
            
            echo form_label('Nouveau mot de passe', 'password', $label_attributes_password);
            echo form_password('password','','placeholder="Mot de passe"');
            echo '<div class="ico-placeholder password"></div>';

            echo form_label('Confirmer mot de passe', 'confpassword', $label_attributes_password);
            echo form_password('confpassword','','placeholder="Confirmez le mot de passe"');
            echo '<div class="ico-placeholder password"></div>';
            echo form_error('password', '<span class="error-form">', '</span>');
            echo form_error('confpassword', '<span class="error-form">', '</span>');
            
            echo '<hr>';

            $array_ecoute = explode(', ', $profile->style_ecoute);
            echo form_label('Genres musicaux','stylemusicecoute[]',$label_attributes);
            echo '<div class="checkbox-style">';
                echo form_checkbox('stylemusicecoute[]', 'pop', set_checkbox('stylemusicecoute', 'pop', $bool = (in_array("pop", $array_ecoute)) ? true : false), 'id="checkecoutepop"');
                echo form_label('Pop','checkecoutepop');

                echo form_checkbox('stylemusicecoute[]', 'rock', set_checkbox('stylemusicecoute', 'rock', $bool = (in_array("rock", $array_ecoute)) ? true : false), 'id="checkecouterock"');
                echo form_label('Rock','checkecouterock');

                echo form_checkbox('stylemusicecoute[]', 'folk', set_checkbox('stylemusicecoute', 'folk', $bool = (in_array("folk", $array_ecoute)) ? true : false), 'id="checkecoutefolk"');
                echo form_label('Folk','checkecoutefolk');

                echo form_checkbox('stylemusicecoute[]', 'garage', set_checkbox('stylemusicecoute', 'garage', $bool = (in_array("garage", $array_ecoute)) ? true : false), 'id="checkecoutegarage"');
                echo form_label('Garage','checkecoutegarage');

                echo form_checkbox('stylemusicecoute[]', 'punk', set_checkbox('stylemusicecoute', 'punk', $bool = (in_array("punk", $array_ecoute)) ? true : false), 'id="checkecoutepunk"');
                echo form_label('Punk','checkecoutepunk');

                echo form_checkbox('stylemusicecoute[]', 'jazz', set_checkbox('stylemusicecoute', 'jazz', $bool = (in_array("jazz", $array_ecoute)) ? true : false), 'id="checkecoutejazz"');
                echo form_label('Jazz','checkecoutejazz');

                echo form_checkbox('stylemusicecoute[]', 'classique1', set_checkbox('stylemusicecoute', 'classique1', $bool = (in_array("classique1", $array_ecoute)) ? true : false), 'id="checkecouteclassique1"');
                echo form_label('Classique1','checkecouteclassique1');

                echo form_checkbox('stylemusicecoute[]', 'classique2', set_checkbox('stylemusicecoute', 'classique2', $bool = (in_array("classique2", $array_ecoute)) ? true : false), 'id="checkecouteclassique2"');
                echo form_label('Classique2','checkecouteclassique3');

                echo form_checkbox('stylemusicecoute[]', 'classique3', set_checkbox('stylemusicecoute', 'classique3', $bool = (in_array("classique3", $array_ecoute)) ? true : false), 'id="checkecouteclassique3"');
                echo form_label('Classique3','checkecouteclassique3');
            echo '</div>';
            echo form_error('stylemusicecoute[]', '<span class="error-form">', '</span>');

            echo form_submit('submit', 'Valider');
            echo form_error('submit', '<span class="error-form">', '</span>');
        ?>

            <a href="<?php echo site_url('my-reglages/confirm/' . $session_id); ?>" class="iframe delete_account">Supprimer mon compte</a>
            
        <?php
            echo form_close();
        ?>
            
    </div>
  <?php if(isset($sidebar_right)) echo $sidebar_right; ?>

</div>
