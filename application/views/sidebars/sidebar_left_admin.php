<?php if($this->session->userdata('logged_in') == 1 && $this->session->userdata('account') == 0): ?>
    <aside>
        <div id="first-block">
            <div id="my-profil">
                <a href="<?php print site_url('home/'.$this->session->userdata('uid')); ?>">
                    <img src="<?php print files('profiles/'.$this->session->userdata('thumb')); ?>" alt="Photo Profil" />
                    <h3><?php print $this->session->userdata('login'); ?></h3>
                    <span>Bienvenue</span>
                </a>
            </div>

            <div id="admin-generale">
                <a href="<?php print site_url('home/'.$this->session->userdata('uid')); ?>">
                    <span>Accès Accueil</span>
                </a>
            </div>
        </div>

        <div id="menu-account">
            <ul>
                <li class="head_menu row row-0"><a href="<?php print site_url('admin'); ?>"><span class="icon"></span><span class="menu-text">Gestion du portail</span></a></li>
                <li class="first-row row row-1"><a href="<?php print site_url('admin_articles'); ?>"><span class="icon"></span><span class="menu-text">Actualités à la une</span></a></li>
                <li class="row row-2"><a href="<?php print site_url('admin_artistes'); ?>"><span class="icon"></span><span class="menu-text">Artistes à la une</span></a></li>
                <!--<li class="row row-3"><a href="#"><span class="icon"></span><span class="menu-text">Calendrier concerts</span></a></li>-->
            </ul>
        </div>
      
        <div id="menu-profile">
            <ul>
                <li class="head_menu row row-7"><a href="<?php print site_url('home/'.$this->session->userdata('uid')); ?>"><span class="icon"></span><span class="menu-text">Utilisateurs</span></a></li>
                <li class="first-row row row-8"><a href="<?php print site_url('actualite/'.$this->session->userdata('uid')); ?>"><span class="icon"></span><span class="menu-text">Mélomanes</span></a></li>
                <li class="row row-9"><a href="<?php print site_url('mc_concerts/'.$this->session->userdata('uid')); ?>"><span class="icon"></span><span class="menu-text">Musiciens</span></a></li>
                <li class="row row-10"><a href="<?php print site_url('musique/'.$this->session->userdata('uid')); ?>"><span class="icon"></span><span class="menu-text">Signalements</span></a></li>
            </ul>
        </div>
    </aside>
<?php endif; ?>