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
            <li><a href="<?php echo site_url('actualite/' . $uid_visit); ?>"><?php echo 'Artiste : ' . $login; ?></a></li>
            <li><a href="<?php echo site_url($this->uri->segment(1) . '/' . $uid_visit); ?>">Réglages</a></li>
        </ul>
    </div>

    <div id="cover" style="background-image:url(<?php echo files('profiles/' . $cover = (empty($infos_profile)) ? $this->session->userdata('cover') : $infos_profile->cover); ?>);">
        <div id="infos-cover">
            <h2><?php echo $login; ?></h2>
            <a href="#"><span class="button_left"></span><span class="button_center">Suivre</span><span class="button_right"></span></a>
        </div>
    </div>

    <div id="stats-cover">
        <div class="stats_cover_block">
            <span class="stats_number">489</span>
            <span class="stats_title">abonnés</span>
        </div>

        <div class="stats_cover_block">
            <span class="stats_number">18</span>
            <span class="stats_title">albums</span>
        </div>

        <div class="stats_cover_block">
            <span class="stats_number">278</span>
            <span class="stats_title">morceaux</span>
        </div>
    </div>

    <div class="content">
        <h2>Réglages</h2>
        
        <p class="detail_reglages">Cette page vous permet d’ajouter et/ou de modifier les informations qui figurent sur votre profil musicien public.</p>

        <?php
            echo form_open_multipart('reglages/update_user/'.$session_id);
        ?>
        
        
        <div id="subscription-upload">
            <!--<div class="upload_images"></div>-->

            <?php $label_attributes = array('class'=>'label_big'); ?>
            
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
        if($this->session->userdata('account') == 2) $ph = 'Nom de scène'; else $ph = 'Nom d\'utilisateur';
            echo form_label($ph,'login',$label_attributes);
            echo form_input('login',$profile->login,'placeholder="Votre login"');
            echo form_error('login', '<span class="error-form">', '</span>');

            echo form_label('Bio','bio',$label_attributes);
            echo form_textarea('description',$profile->description,'placeholder="Votre description"');
            echo form_error('description', '<span class="error-form">', '</span>');

            echo form_label('Google +','googleplus',$label_attributes);
            echo form_input('googleplus',$profile->googleplus,'placeholder="URL Google +"');
            echo form_error('googleplus', '<span class="error-form">', '</span>');

            echo form_label('Twitter','twitter',$label_attributes);
            echo form_input('twitter',$profile->twitter,'placeholder="URL Twitter"');
            echo form_error('twitter', '<span class="error-form">', '</span>');

            echo form_label('Facebook','facebook',$label_attributes);
            echo form_input('facebook',$profile->facebook,'placeholder="URL Facebook"');
            echo form_error('facebook', '<span class="error-form">', '</span>');

            echo form_label('Site Web','site',$label_attributes);
            echo form_input('site',$profile->siteweb,'placeholder="URL de votre site"');
            echo form_error('site', '<span class="error-form">', '</span>');

            echo '<hr>';

            $array_instru = explode(', ', $profile->instrument);
            echo form_label('Instruments','stylemusicinstru[]',$label_attributes);
            echo '<div class="checkbox-style">';
                echo form_checkbox('stylemusicinstru[]', 'guitare', set_checkbox('stylemusicinstru', 'guitare', $bool = (in_array("guitare", $array_instru)) ? true : false), 'id="checkinstruguitare"');
                echo form_label('Guitare','checkinstruguitare');

                echo form_checkbox('stylemusicinstru[]', 'voix', set_checkbox('stylemusicinstru', 'voix', $bool = (in_array("voix", $array_instru)) ? true : false), 'id="checkinstruvoix"');
                echo form_label('Voix','checkinstruvoix');

                echo form_checkbox('stylemusicinstru[]', 'piano', set_checkbox('stylemusicinstru', 'piano', $bool = (in_array("piano", $array_instru)) ? true : false), 'id="checkinstrupiano"');
                echo form_label('Piano','checkinstrupiano');

                echo form_checkbox('stylemusicinstru[]', 'accordeon', set_checkbox('stylemusicinstru', 'accordeon', $bool = (in_array("accordeon", $array_instru)) ? true : false), 'id="checkinstruaccordeon"');
                echo form_label('Accordéon','checkinstruaccordeon');

                echo form_checkbox('stylemusicinstru[]', 'harmonica', set_checkbox('stylemusicinstru', 'harmonica', $bool = (in_array("harmonica", $array_instru)) ? true : false), 'id="checkinstruharmonica"');
                echo form_label('Harmonica','checkinstruharmonica');

                echo form_checkbox('stylemusicinstru[]', 'basse', set_checkbox('stylemusicinstru', 'basse', $bool = (in_array("basse", $array_instru)) ? true : false), 'id="checkinstrubasse"');
                echo form_label('Basse','checkinstrubasse');

                echo form_checkbox('stylemusicinstru[]', 'flute', set_checkbox('stylemusicinstru', 'flute', $bool = (in_array("flute", $array_instru)) ? true : false), 'id="checkinstruflute"');
                echo form_label('Flûte','checkinstruflute');

                echo form_checkbox('stylemusicinstru[]', 'trompette', set_checkbox('stylemusicinstru', 'trompette', $bool = (in_array("trompette", $array_instru)) ? true : false), 'id="checkinstrutrompette"');
                echo form_label('Trompette','checkinstrutrompette');

                echo form_checkbox('stylemusicinstru[]', 'batterie', set_checkbox('stylemusicinstru', 'batterie', $bool = (in_array("batterie", $array_instru)) ? true : false), 'id="checkinstrubatterie"');
                echo form_label('Batterie','checkinstrubatterie');
            echo '</div>';
            echo form_error('stylemusicinstru[]', '<span class="error-form">', '</span>');
            
            $array_joue = explode(', ', $profile->style_joue);
            echo form_label('Genres musicaux','stylemusicjoue[]',$label_attributes);
            echo '<div class="checkbox-style">';
                echo form_checkbox('stylemusicjoue[]', 'pop', set_checkbox('stylemusicjoue', 'pop', $bool = (in_array("pop", $array_joue)) ? true : false), 'id="checkjouepop"');
                echo form_label('Pop','checkjouepop');

                echo form_checkbox('stylemusicjoue[]', 'rock', set_checkbox('stylemusicjoue', 'rock', $bool = (in_array("rock", $array_joue)) ? true : false), 'id="checkjouerock"');
                echo form_label('Rock','checkjouerock');

                echo form_checkbox('stylemusicjoue[]', 'folk', set_checkbox('stylemusicjoue', 'folk', $bool = (in_array("folk", $array_joue)) ? true : false), 'id="checkjouefolk"');
                echo form_label('Folk','checkjouefolk');

                echo form_checkbox('stylemusicjoue[]', 'garage', set_checkbox('stylemusicjoue', 'garage', $bool = (in_array("garage", $array_joue)) ? true : false), 'id="checkjouegarage"');
                echo form_label('Garage','checkjouegarage');

                echo form_checkbox('stylemusicjoue[]', 'punk', set_checkbox('stylemusicjoue', 'punk', $bool = (in_array("punk", $array_joue)) ? true : false), 'id="checkjouepunk"');
                echo form_label('Punk','checkjouepunk');

                echo form_checkbox('stylemusicjoue[]', 'jazz', set_checkbox('stylemusicjoue', 'jazz', $bool = (in_array("jazz", $array_joue)) ? true : false), 'id="checkjouejazz"');
                echo form_label('Jazz','checkjouejazz');

                echo form_checkbox('stylemusicjoue[]', 'classique1', set_checkbox('stylemusicjoue', 'classique1', $bool = (in_array("classique1", $array_joue)) ? true : false), 'id="checkjoueclassique1"');
                echo form_label('Classique1','checkjoueclassique1');

                echo form_checkbox('stylemusicjoue[]', 'classique2', set_checkbox('stylemusicjoue', 'classique2', $bool = (in_array("classique2", $array_joue)) ? true : false), 'id="checkjoueclassique2"');
                echo form_label('Classique2','checkjoueclassique2');

                echo form_checkbox('stylemusicjoue[]', 'classique3', set_checkbox('stylemusicjoue', 'classique3', $bool = (in_array("classique3", $array_joue)) ? true : false), 'id="checkjoueclassique3"');
                echo form_label('Classique3','checkjoueclassique3');
            echo '</div>';
            echo form_error('stylemusicjoue[]', '<span class="error-form">', '</span>');

            echo form_submit('submit', 'Valider');
            echo form_error('submit', '<span class="error-form">', '</span>');
        ?>

            <a href="<?php echo site_url('reglage/pi_delete_user/' . $session_id); ?>" class="iframe delete_account">Supprimer mon compte</a>
        <?php
            echo form_close();
        ?>
        
    </div>
  <?php if(isset($sidebar_right)) echo $sidebar_right; ?>

</div>