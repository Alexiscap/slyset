<?php date_default_timezone_set('Europe/Paris'); ?>

<!DOCTYPE HTML>
<html lang="fr">
    <head>
        <title><?php echo $title = (isset($titre)) ? $titre : 'Slyset'; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=<?php if (isset($charset)) echo $charset; ?>" />
        <meta http-equiv="Content-Language" content="fr" />
        <meta http-equiv="Content-Script-Type" content="text/javascript" />
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <meta name="description" content="<?php echo $desc = (isset($description)) ? $description : 'Description Slyset'; ?>" />
        <meta name="keywords" content="slyset, project web, social networks, music, réseau social, réseau social musical, musique, écoute, artiste, efficom, projet" />

        <link type="text/css" rel="stylesheet" href="<?php echo css_url('reset') ?>" />
        <link type="text/css" rel="stylesheet" href="<?php echo css_url('fonts') ?>" />
        <link type="text/css" rel="stylesheet" href="<?php echo css_url('tpl_header-footer') ?>" />
        <link type="text/css" rel="stylesheet" href="<?php echo css_url('tpl_sidebar-left') ?>" />
        <link type="text/css" rel="stylesheet" href="<?php echo css_url('tpl_sidebar-right') ?>" />

        <?php foreach ($css as $url): ?>
            <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $url; ?>" />
        <?php endforeach; ?>

        <?php foreach ($dynamic_css as $url): ?>
            <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $url; ?>" />
        <?php endforeach; ?>

        <!--[if IE]>
          <link type="text/css" rel="stylesheet" href="<?php echo css_url('corrections-ie') ?>" />
        <![endif]-->

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo js_url('jquery-1.8.3.min') ?>">\x3C/script>')</script>
    </head>

    <body <?php if (isset($id_bkg)) echo 'class="' . $id_bkg . '"'; ?>>
        <header>
            <div id="header">
                <a href="<?php echo site_url('home/' . $this->session->userdata('uid')); ?>" class="link_logo">
                    <img id="logo" src="<?php echo img_url('header/logo.png') ?>" alt="Logo Slyset" />
                </a>

                <div id="ico_menu">
                    <a href="<?php echo site_url('home/' . $this->session->userdata('uid')); ?>" id="accueil"><span>Accueil</span></a>
                    <!--<a href="#" id="explorer"><span>Rechercher</span></a>-->
                    
<!--                    <div id="execution-times">
                        <p><?php echo $this->benchmark->memory_usage(); ?></p>
                        <p><?php echo $this->benchmark->elapsed_time() . 'ms'; ?></p>
                    </div>-->
                    
                    <div id="played">
                        <div class="ico"></div>
                        <div class="infos">
                            <span class="label">Vous écoutez...</span>
                            <span class="ecoute"></span>
                        </div>                        
                    </div>
                </div>

                <div id="connexion">
                    <div id="recherche">
                        <?php $val = (!empty($_POST['recherche'])) ? $_POST['recherche'] : ''; ?>
                        <form action="<?php echo site_url('search/' . $this->session->userdata('uid')); ?>" method="post">
                            <input src="<?php echo img_url('header/loupe.png') ?>" type="image" value="submit" align="middle"/>
                            <input type="text" value="<?php print $val; ?>" placeholder="Rechercher un artiste..." name="recherche" />
                        </form>
                    </div>

                    <div id="identification">
                        <?php if ($this->session->userdata('logged_in') == 1): ?>
                            <a href="<?php echo site_url('home/' . $this->session->userdata('uid')) ?>"><?php echo $login_substr = (strlen($this->session->userdata('login')) > 16) ? substr($this->session->userdata('login'),0,13).'...' : $this->session->userdata('login'); ?></a>
                            <span class="separator">|</span>
                            <a href="<?php echo site_url('login/logout'); ?>">Déconnexion</a>
                        <?php else: ?>
                            <a href="<?php echo site_url('login'); ?>" id="connexion">Connexion</a>
                            <span class="separator">|</span>
                            <a href="<?php echo site_url('user');?>" id="inscrire">Inscription</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </header>

        <div id="any-background<?php if (isset($id_bkg)) echo '-' . $id_bkg; ?>">
            <div id="page">                
                <?php if (isset($sidebar_left)) echo $sidebar_left; ?>

                <?php if (isset($output)) echo $output; ?>
            </div>
        </div>

        <footer>
            <div id="footer">
                <div class="slyset">
                    <span>Autour de slyset</span>
                    <ul>
                        <li><a href="http://slyset.wordpress.com" target="_blank">Le blog</a></li>
                        <li><a href="<?php echo site_url('slyset-project/' . $this->session->userdata('uid')); ?>">Qui sommes-nous ?</a></li>
                        <li><a href="<?php echo site_url('fonctionnalites/' . $this->session->userdata('uid')); ?>">Fonctionnalités</a></li>
                        <li><a href="#">Kit presse</a></li>
                    </ul>
                </div>

                <div class="aide">
                    <span>Obtenir de l'aide</span>
                    <ul>
                        <li><a href="<?php echo site_url('faq/' . $this->session->userdata('uid')); ?>">FAQ</a></li>
                        <li><a href="<?php echo site_url('contact/' . $this->session->userdata('uid')); ?>">Nous contacter</a></li>
                        <li><a href="<?php echo site_url('paiements/' . $this->session->userdata('uid')); ?>">Paiement sécurisé</a></li>
                    </ul>
                </div>

                <div class="infos">
                    <span>Informations</span>
                    <ul>
                        <li><a href="<?php echo site_url('conditions-generales/' . $this->session->userdata('uid')); ?>">CGU & CGV</a></li>
                        <li><a href="<?php echo site_url('mentions-legales/' . $this->session->userdata('uid')); ?>">Mentions légales</a></li>
                        <li><a href="<?php echo site_url('annonceurs/' . $this->session->userdata('uid')); ?>">Annonceurs</a></li>
                    </ul>
                </div>

                <div class="separation">
                    <img src="<?php echo img_url('footer/separateur') ?>.jpg" alt="Séparateur" />
                </div>

                <div class="reseaux">
                    <h3>Suivez-nous !</h3>
                    <div id="liens-rsx">
                        <a href="#" target="_blank" id="twitter"><span>Twitter</span></a>
                        <a href="#" target="_blank" id="fb"><span>Facebook</span></a>
                        <a href="#" target="_blank" id="google"><span>Google+</span></a>
                    </div>

                    <p>Recevez notre newsletter</p>

                    <form>
                        <div class="fd_form">
                            <input type="text" name="news-mail" value="Votre adresse e-mail ici ..." onFocus="javascript:this.value=''" onBlur="if (this.value==''){this.value='Votre adresse e-mail ici ...';}"/>
                            <input src="<?php echo img_url('footer/ok') ?>.png" type="image" value="submit" align="middle" /> 
                        </div>
                    </form>
                    <p id="mention">Votre adresse email ne sera en aucun cas<br />revendue, ou utilisée par une société.</p>
                </div>
            </div>
        </footer>

        <?php foreach ($js as $url): ?>
            <script type="text/javascript" src="<?php echo $url; ?>"></script> 
        <?php endforeach; ?>

        <script type="text/javascript" src="<?php echo js_url('audiojs/audio') ?>"></script>
        <script type="text/javascript" src="<?php echo js_url('jquery.placeheld.min') ?>"></script>
        <script type="text/javascript" src="<?php echo js_url('slyset') ?>"></script>

        <!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  _paq.push(["trackPageView"]);
  _paq.push(["enableLinkTracking"]);

  (function() {
    var u=(("https:" == document.location.protocol) ? "https" : "http") + "://localhost/~camille/slyset/assets/piwik/";
    _paq.push(["setTrackerUrl", u+"piwik.php"]);
    _paq.push(["setSiteId", "1"]);
    var d=document, g=d.createElement("script"), s=d.getElementsByTagName("script")[0]; g.type="text/javascript";
    g.defer=true; g.async=true; g.src=u+"piwik.js"; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Piwik Code -->
    </body>
</html>