<div id="contentAll">
    <div id="breadcrumbs">
        <ul>
            <li><a href="#">Accueil</a></li>
            <li><a href="#">Artistes</a></li>
            <li><a href="#"><?php print $login = (empty($infos_profile)) ? $this->session->userdata('login') : $infos_profile->login; ?></a></li>
            <li><a href="#">Réglages</a></li>
        </ul>
    </div>
  
    <div id="cover" style="background-image:url(<?php print files('profiles/'.$cover = (empty($infos_profile)) ? $this->session->userdata('cover') : $infos_profile->cover); ?>);">
        <div id="infos-cover">
            <h2><?php print $login = (empty($infos_profile)) ? $this->session->userdata('login') : $infos_profile->login; ?></h2>
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
        <h2>Personnaliser votre page musicien</h2>
        
        <p class="detail_perso">Personnalisez l’affichage de votre page musicien. Slyset vous propose différents thèmes préconçus mais vous pouvez également créer le votre.</p>
  
        <?php 
        print_r($perso);
        
//        print "<link rel='stylesheet' type='text/css' media='screen' href='".css_url($perso->theme_css)."'>";
        echo form_open_multipart('personnaliser/update/'.$this->session->userdata('uid')); ?>
        
            <div class="categ_perso">
                <p>Thèmes préconçus</p>
                <div class="themes">
                    <a href="<?php print site_url().'/personnaliser/theme-1/'.$this->session->userdata('uid'); ?>" class="t1"><span>t1</span></a>
                    <a href="<?php print site_url().'/personnaliser/theme2/'.$this->session->userdata('uid'); ?>" class="t2"><span>t2</span></a>
                    <a href="<?php print site_url().'/personnaliser/theme3/'.$this->session->userdata('uid'); ?>" class="t3"><span>t3</span></a>
                    <a href="<?php print site_url().'/personnaliser/theme4/'.$this->session->userdata('uid'); ?>" class="t4"><span>t4</span></a>
                </div>
            </div>

            <hr/>

            <div id="subscription-upload">
                <?php $label_attributes = array('class'=>'label_big'); ?>

                <?php echo form_label('Arrière-plan personnalisé','background', $label_attributes); ?>
                <div class="preview_upload background" style="background:<?php print $background = (empty($perso->background)) ? '#FFFFFF' : 'url('.files($this->uri->segment(2).'/perso/'.$perso->background).')'; ?>;"></div>
                <div class="upload-file-container container-background">
                   <input type="file" name="background" size="200" id="upload_images_background" />
                </div>
                <span class="upload_photo_name_file"></span>
                <div class="checkbox-style">
                    <?php
                        echo form_checkbox('repeat', 'repeat', set_checkbox('repeat', 'repeat', $bool = (!empty($perso->repeat)) ? true : false), 'id="repeat"');
                        echo form_label('Répéter l\'image', 'repeat');
                    ?>
                </div>
            </div>

            <div class="clear"></div>
          
            <div class="categ_perso_precis">
                <?php 
                    echo form_label('Couleur d\'arrière-plan', 'couleur1', $label_attributes);
                ?>
                <div class="themes">
                  <div class="t1 color1" style="background:<?php if(!empty($perso->couleur1)) print $perso->couleur1 ?>;"></div>
                    <?php
                        echo form_input('couleur1', $couleur1 = (empty($perso->couleur1)) ? '' : $perso->couleur1, 'placeholder="#19849b" id="colorpickerField1" maxlength="7"');
                        echo form_error('couleur1', '<span class="error-form">', '</span>');
                    ?>
                </div>
            </div>

            <div class="categ_perso_precis">
                <?php 
                    echo form_label('Contour de votre photo de profil', 'couleur2', $label_attributes);
                ?>
                <div class="themes">
                    <div class="t1 color2" style="background:<?php if(!empty($perso->couleur2)) print $perso->couleur2 ?>;"></div>
                    <?php
                        echo form_input('couleur2', $couleur2 = (empty($perso->couleur2)) ? '' : $perso->couleur2, 'placeholder="#b3b2bb" id="colorpickerField2" maxlength="7"');
                        echo form_error('couleur2', '<span class="error-form">', '</span>');
                    ?>
                </div>
            </div>

            <div class="categ_perso_precis">
                <?php 
                    echo form_label('Couleur des liens', 'couleur3', $label_attributes);
                ?>
                <div class="themes">
                    <div class="t1 color3" style="background:<?php if(!empty($perso->couleur3)) print $perso->couleur3 ?>;"></div>
                    <?php
                        echo form_input('couleur3', $couleur3 = (empty($perso->couleur3)) ? '' : $perso->couleur3, 'placeholder="#323c6a" id="colorpickerField3" maxlength="7"');
                        echo form_error('couleur3', '<span class="error-form">', '</span>');
                    ?>
                </div>
            </div>

            <div class="categ_perso_precis">
                <?php
                    echo form_label('Couleur des grands titres', 'couleur4', $label_attributes);
                ?>
                <div class="themes">
                    <div class="t1 color4" style="background:<?php if(!empty($perso->couleur4)) print $perso->couleur4 ?>;"></div>
                    <?php
                        echo form_input('couleur4', $couleur14 = (empty($perso->couleur4)) ? '' : $perso->couleur4, 'placeholder="#b3b2bb" id="colorpickerField4" maxlength="7"');
                        echo form_error('couleur4', '<span class="error-form">', '</span>');
                    ?>
                </div>
            </div>

            <div class="clear"></div>            
            
            <?php
                echo form_submit('submit', 'Valider');
                echo form_error('submit', '<span class="error-form">', '</span>');
            ?>
            
            <a href="<?php print site_url().'/personnaliser/delete/'.$this->session->userdata('uid'); ?>" class="reset_theme">Thème par défaut</a>

        <?php echo form_close(); ?>
  </div>

  <?php if(isset($sidebar_right)) echo $sidebar_right; ?>

</div>