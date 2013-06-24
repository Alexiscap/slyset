<?php if($this->session->userdata('logged_in') == 1): ?>
    <aside>
        <div id="first-block">
            <div id="my-profil">
                <a href="<?php print site_url('home/'.$this->session->userdata('uid')); ?>">
                    <img src="<?php print files('profiles/'.$this->session->userdata('thumb')); ?>" alt="Photo Profil" />
                    <h3><?php print $this->session->userdata('login'); ?></h3>
                    <span>Voir mon profil</span>
                </a>
            </div>
          
            <?php if($this->session->userdata('account') == 0): ?>
                <div id="admin-generale">
                    <a href="<?php print site_url('admin'); ?>">
                        <span>Accès administration</span>
                    </a>
                </div>
            <?php endif; ?>
          
            <div id="listen-playlist">
                <a href="#">
                    <img src="<?php print img_url('sidebar-left/btn-play.png'); ?>" alt="Lecture Playlist" />
                    <span>Écouter mes playlists</span>
                </a>
            </div>
        </div>

        <div id="menu-account">
            <ul>
                <li class="head_menu row row-0"><a href="<?php print site_url('home/'.$this->session->userdata('uid')); ?>"><span class="icon"></span><span class="menu-text">Mon compte</span></a></li>
                <li class="first-row row row-1"><a href="<?php print site_url('my-wall/'.$this->session->userdata('uid')); ?>"><span class="icon"></span><span class="menu-text">Fil d'actualité</span></a></li>
                <li class="row row-2"><a href="<?php print site_url('my-reglages/'.$this->session->userdata('uid')); ?>"><span class="icon"></span><span class="menu-text">Modifier mon profil</span></a></li>
                <li class="row row-3"><a href="<?php print site_url('my-shopping/'.$this->session->userdata('uid')); ?>"><span class="icon"></span><span class="menu-text">Mes achats</span></a></li>
                <li class="row row-4"><a href="<?php print site_url('my-playlists/'.$this->session->userdata('uid')); ?>"><span class="icon"></span><span class="menu-text">Mes playlists</span></a></li>
                 <li class="row row-5"><a href="<?php echo site_url('my-concert/'.$this->session->userdata('uid')) ?>"><span class="icon"></span><span class="menu-text">Mes concerts</span></a></li>
                <li class="last-row row row-6"><a href="<?php echo site_url('my-follower/'.$this->session->userdata('uid')) ?>"><span class="icon"></span><span class="menu-text">Mes abonnements</span></a></li>
            </ul>
        </div>

        <?php
          $user_id = $this->uri->segment(2);        
          if(($this->session->userdata('account') == 2 || $this->session->userdata('account') == 0) && ($user_id == $this->session->userdata('uid'))): ?>
            <div id="menu-profile">
                <ul>
                    <li class="head_menu row row-7"><a href="<?php print site_url('home/'.$this->session->userdata('uid')); ?>"><span class="icon"></span><span class="menu-text">Ma page musicien</span></a></li>
                    <li class="first-row row row-8"><a href="<?php print site_url('actualite/'.$this->session->userdata('uid')); ?>"><span class="icon"></span><span class="menu-text">Actualités</span></a></li>
                    <li class="row row-9"><a href="<?php print site_url('concert/'.$this->session->userdata('uid')); ?>"><span class="icon"></span><span class="menu-text">Concerts</span></a></li>
                    <li class="row row-10"><a href="<?php print site_url('musique/'.$this->session->userdata('uid')); ?>"><span class="icon"></span><span class="menu-text">Musique</span></a></li>
                    <li class="row row-11"><a href="<?php print site_url('media/'.$this->session->userdata('uid')); ?>"><span class="icon"></span><span class="menu-text">Photos et vidéos</span></a></li>
                    <li class="row row-12"><a href="<?php print site_url('document/'.$this->session->userdata('uid'));?>"><span class="icon"></span><span class="menu-text">Livrets et partitions</span></a></li>
                    <li class="row row-13"><a href="<?php print site_url('mc_stats/'.$this->session->userdata('uid')); ?>"><span class="icon"></span><span class="menu-text">Statistiques</span></a></li>
                    <li class="row row-14"><a href="<?php print site_url('follower/'.$this->session->userdata('uid')); ?>"><span class="icon"></span><span class="menu-text">Mes abonnés</span></a></li>
                    <li class="row row-15"><a href="<?php print site_url('personnaliser/'.$this->session->userdata('uid')); ?>"><span class="icon"></span><span class="menu-text">Personnaliser</span></a></li>
                    <li class="last-row row row-16"><a href="<?php print site_url('reglages/'.$this->session->userdata('uid')); ?>"><span class="icon"></span><span class="menu-text">Réglages</span></a></li>
                </ul>
            </div>
        <?php elseif($user_id != $this->session->userdata('uid')): ?>
            <?php $user_info = $this->user_infos->profile_user($user_id) ?>
            <div id="menu-profile" class="active">
                <ul>
                    <li class="head_menu row row-7"><a href="<?php print site_url('home/'.$user_id); ?>"><span class="icon"></span><span class="menu-text"><?php print $user_info->login; ?></span></a></li>
                    <li class="first-row row row-8"><a href="<?php print site_url('actualite/'.$user_id); ?>"><span class="icon"></span><span class="menu-text">Actualités</span></a></li>
                    <li class="row row-9"><a href="<?php print site_url('concert/'.$user_id); ?>"><span class="icon"></span><span class="menu-text">Concerts</span></a></li>
                    <li class="row row-10"><a href="<?php print site_url('musique/'.$user_id); ?>"><span class="icon"></span><span class="menu-text">Musique</span></a></li>
                    <li class="row row-11"><a href="<?php print site_url('media/'.$user_id); ?>"><span class="icon"></span><span class="menu-text">Photos et vidéos</span></a></li>
                    <li class="row row-12"><a href="<?php print site_url('document/'.$user_id);?>"><span class="icon"></span><span class="menu-text">Livrets et partitions</span></a></li>
                </ul>
            </div>
        <?php endif; ?>
    </aside>
<?php else: ?>
    <aside>
        <div id="welcome-slyset">
            <span>Bienvenue sur Slyset !</span>
        </div>

        <div id="identification-block">
            <div class="head_menu">
                <span class="icon"></span>
                <span class="menu-text">Connectez-vous</span>
            </div>

            <?php
              echo form_open('login/login_home');

              echo '<span class="icon log"></span>';
              echo form_input('login',set_value('login'),'placeholder="Nom d\'utilisateur"');
              echo form_error('login', '<span class="error-form">', '</span>');

              echo '<span class="icon pwd"></span>';
              echo form_password('password',set_value('password'),'placeholder="Mot de passe"');
              echo form_error('password', '<span class="error-form">', '</span>');
              
            ?>
              <a href="<?php site_url('/'); ?>" class="forgot_password">Mot de passe oublié ?</a>
            <?php
              
              echo form_submit('submit','Se connecter');

              echo form_close();

              echo '<div class="form_error">'.$this->session->flashdata('error').'</div>';
              echo validation_errors();
              echo @$error_credentials;
            ?>

            <p class="identification-inscrire">Pas encore inscrit ? <a href="<?php print site_url('user'); ?>">Inscrivez-vous</a></p>
        </div>
      
        <?php
          $user_id = $this->uri->segment(2);
          $profile = $this->user_infos->profile_user($user_id);
          if(!empty($user_id)):
              //$infos_user = $this->user_infos->profile_user($user_id, $stdclass);
               ?>
      
              <div id="menu-profile" class="active">
                  <ul>
                      <li class="head_menu row row-7"><a href="<?php print site_url('home/'.$user_id); ?>"><span class="icon"></span><span class="menu-text"><?php print $profile->login; ?></span></a></li>
                      <li class="first-row row row-8"><a href="<?php print site_url('actualite/'.$user_id); ?>"><span class="icon"></span><span class="menu-text">Actualités</span></a></li>
                      <li class="row row-9"><a href="<?php print site_url('concert/'.$user_id); ?>"><span class="icon"></span><span class="menu-text">Concerts</span></a></li>
                      <li class="row row-10"><a href="<?php print site_url('musique/'.$user_id); ?>"><span class="icon"></span><span class="menu-text">Musique</span></a></li>
                      <li class="row row-11"><a href="<?php print site_url('media/'.$user_id); ?>"><span class="icon"></span><span class="menu-text">Photos et vidéos</span></a></li>
                      <li class="row row-12"><a href="<?php print site_url('document/'.$user_id);?>"><span class="icon"></span><span class="menu-text">Livrets et partitions</span></a></li>
                  </ul>
              </div>
          <?php endif; ?>
    </aside>
<?php endif; ?>