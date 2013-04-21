<!DOCTYPE HTML>
<html lang="fr">
  <head>
    <title><?php echo $title; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php if(isset($charset)) echo $charset; ?>" />
    <meta http-equiv="Content-Language" content="fr" />
    <meta http-equiv="Content-Script-Type" content="text/javascript" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="<?php if(isset($description)) echo $description; ?>" />
    <meta name="keywords" content="slyset, project web, social networks, music, réseau social, réseau social musical, musique, écoute, artiste, efficom, projet" />

    <link type="text/css" rel="stylesheet" href="<?php echo css_url('reset') ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo css_url('tpl_header-footer') ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo css_url('tpl_sidebar-left') ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo css_url('tpl_sidebar-right') ?>" />
    
    <?php foreach($css as $url): ?>
      <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $url; ?>" />
    <?php endforeach; ?>
    
    <!--[if IE]>
      <link type="text/css" rel="stylesheet" href="<?php echo css_url('corrections-ie') ?>" />
    <![endif]-->
  </head>

  <body>
    <header>
      <div id="header">
        <a href="<?php echo site_url('welcome'); ?>">
          <img id="logo" src="<?php echo img_url('header/logo.png') ?>" alt="Logo Slyset"/>
        </a>
          
        <div id="ico_menu">
          <a href="<?php echo site_url('welcome'); ?>" id="accueil"><span>Accueil</span></a>
          <a href="#" id="explorer"><span>Explorer</span></a>
          <a href="#" id="inscrire"><span>S'inscrire</span></a>
        </div>

        <div id="connexion">
          <div id="recherche">
            <form>
              <input type="text" value="Chercher un artiste ..." onfocus="javascript:this.value=''" onblur="if (this.value==''){this.value='Chercher un artiste ...';}" name="recherche" />
              <input src="<?php echo img_url('header/loupe.png') ?>" type="image" value="submit" align="middle"/>
            </form>
          </div>
        <a href="#">Se connecter</a>
        </div>

      </div>
    </header>

    <div id="page">
      <?php if(isset($sidebar_left)) echo $sidebar_left; ?>

      <div id="contentAll">
        <!-- Display All Content -->
        <?php if(isset($output)) echo $output; ?>
        <!-- End Display All Content -->

        <?php //if(isset($sidebar_right)) echo $sidebar_right; ?>
      </div>
    </div>  

    <footer>
      <div id="footer">
        <div id="slyset">
          <span>Autour de slyset</span>
          <ul>
            <li><a href="#">> Le blog</a></li>
            <li><a href="#">> Qui sommes-nous ?</a></li>
            <li><a href="#">> Fonctionnalit&eacute;s</a></li>
            <li><a href="#">> Kit presse</a></li>
          </ul>
        </div>

        <div id="aide">
          <span>Obtenir de l'aide</span>
          <ul>
            <li><a href="#">> FAQ</a></li>
            <li><a href="#">> Nous contacter</a></li>
            <li><a href="#">> Paiement s&eacute;curis&eacute;</a></li>
          </ul>
        </div>

        <div id="infos">
          <span>Informations</span>
          <ul>
            <li><a href="#">> CGU & CGV</a></li>
            <li><a href="#">> Mentions l&eacute;gales</a></li>
            <li><a href="#">> Annonceurs</a></li>
          </ul>
        </div>

        <div class="separation">
          <img src="<?php echo img_url('footer/separateur') ?>.jpg" alt="Séparateur" />
        </div>

        <div id="reseaux">
          <h3>SUIVEZ-NOUS !</h3>
          <div id="liens_rsx">
            <a href="#" target="_blank" id="twitter"><span>Twitter</span></a>
            <a href="#" target="_blank" id="fb"><span>Facebook</span></a>
            <a href="#" target="_blank" id="google"><span>Google+</span></a>
          </div>

          <p>Recevez notre newsletter</p>

          <form>
            <div id="fd_form">
              <input type="text" name="news-mail" value="Votre adresse e-mail ici ..." onFocus="javascript:this.value=''" onBlur="if (this.value==''){this.value='Votre adresse e-mail ici ...';}"/>
              <input src="<?php echo img_url('footer/ok') ?>.png" type="image" value="submit" align="middle" /> 
            </div>
          </form>
          <p id="mention">Votre adresse email ne sera en aucun cas<br />revendue, ou utilis&eacute;e par une soci&eacute;t&eacute;.</p>
        </div>
      </div>
    </footer>

    <script type="text/javascript" src="<?php echo js_url('jquery-1.7.1.min') ?>"></script>
    <script type="text/javascript" src="<?php echo js_url('modernizr.custom.63321') ?>"></script>
    
    <?php foreach($js as $url): ?>
          <script type="text/javascript" src="<?php echo $url; ?>"></script> 
    <?php endforeach; ?>
          
    <script type="text/javascript" src="<?php echo js_url('slyset') ?>"></script>
  </body>
</html>