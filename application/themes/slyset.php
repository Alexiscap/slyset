<!DOCTYPE HTML>
<html lang="fr">
  <head>
    <title><?php if(isset($titre)) { print $titre; } else { 'Slyset'; } ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php if(isset($charset)) print $charset; ?>" />
    <meta http-equiv="Content-Language" content="fr" />
    <meta http-equiv="Content-Script-Type" content="text/javascript" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="<?php if(isset($description)) print $description; ?>" />
    <meta name="keywords" content="slyset, project web, social networks, music, réseau social, réseau social musical, musique, écoute, artiste, efficom, projet" />

    <link type="text/css" rel="stylesheet" href="<?php echo css_url('reset') ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo css_url('tpl_header-footer') ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo css_url('tpl_sidebar-left') ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo css_url('tpl_sidebar-right') ?>" />
    
    <?php foreach($css as $url): ?>
      <link rel="stylesheet" type="text/css" media="screen" href="<?php print $url; ?>" />
    <?php endforeach; ?>
      
    <?php foreach($dynamic_css as $url): ?>
      <link rel="stylesheet" type="text/css" media="screen" href="<?php print $url; ?>" />
    <?php endforeach; ?>
      
    <!--[if IE]>
      <link type="text/css" rel="stylesheet" href="<?php print css_url('corrections-ie') ?>" />
    <![endif]-->
    
    <script type="text/javascript" src="<?php echo js_url('jquery-1.7.1.min') ?>"></script>
    <script type="text/javascript" src="<?php echo js_url('modernizr.custom.63321') ?>"></script>
    
    <?php foreach($js as $url): ?>
          <script type="text/javascript" src="<?php echo $url; ?>"></script> 
    <?php endforeach; ?>
  </head>

  <body <?php if(isset($id_bkg)) print 'class="'.$id_bkg.'"'; ?>>
    <header>
      <div id="header">
        <a href="<?php echo site_url('home/'.$this->session->userdata('uid')); ?>" class="link_logo">
          <img id="logo" src="<?php echo img_url('header/logo.png') ?>" alt="Logo Slyset" />
        </a>
          
        <div id="ico_menu">
          <a href="<?php echo site_url('home/'.$this->session->userdata('uid')); ?>" id="accueil"><span>Accueil</span></a>
          <a href="#" id="explorer"><span>Explorer</span></a>
          <?php if($this->session->userdata('logged_in') != 1): ?>
            <a href="<?php echo site_url('user'); ?>" id="inscrire"><span>S'inscrire</span></a>
          <?php endif; ?>
        </div>

        <div id="connexion">
          <div id="identification">
            <?php if($this->session->userdata('logged_in') == 1): ?>
              <a href="#"><?php echo $this->session->userdata('login'); ?></a> | <a href="<?php echo site_url('login/logout'); ?>">Se déconnecter</a>
            <?php else: ?>
              <a href="<?php echo site_url('login'); ?>">Se connecter</a>
            <?php endif; ?>
          </div>
            
          <div id="recherche">
            <form>
              <input type="text" value="Chercher un artiste ..." onfocus="javascript:this.value=''" onblur="if (this.value==''){this.value='Chercher un artiste ...';}" name="recherche" />
              <input src="<?php echo img_url('header/loupe.png') ?>" type="image" value="submit" align="middle"/>
            </form>
          </div>
        </div>
      </div>
    </header>

    <div id="any-background<?php if(isset($id_bkg)) echo '-'.$id_bkg; ?>">
      <div id="page">
        <?php if(isset($sidebar_left)) echo $sidebar_left; ?>

<!--        <div id="contentAll">-->
          <?php if(isset($output)) echo $output; ?>

          <?php //if(isset($sidebar_right)) echo $sidebar_right; 
          ?>
<!--        </div>-->
      </div>
    </div>

    <footer>
      <div id="footer">
        <div class="slyset">
          <span>Autour de slyset</span>
          <ul>
            <li><a href="#">Le blog</a></li>
            <li><a href="#">Qui sommes-nous ?</a></li>
            <li><a href="#">Fonctionnalités</a></li>
            <li><a href="#">Kit presse</a></li>
          </ul>
        </div>

        <div class="aide">
          <span>Obtenir de l'aide</span>
          <ul>
            <li><a href="#">FAQ</a></li>
            <li><a href="#">Nous contacter</a></li>
            <li><a href="#">Paiement sécurisé</a></li>
          </ul>
        </div>

        <div class="infos">
          <span>Informations</span>
          <ul>
            <li><a href="#">CGU & CGV</a></li>
            <li><a href="#">Mentions légales</a></li>
            <li><a href="#">Annonceurs</a></li>
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


          
    <script type="text/javascript" src="<?php echo js_url('slyset') ?>"></script>
  </body>
</html>