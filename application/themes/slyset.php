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
        
<!--        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url().'assets/css/fileupload/bootstrap.css'; ?>">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url().'assets/css/fileupload/bootstrap-image-gallery.min.css'; ?>">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url().'assets/css/fileupload/jquery.fileupload-ui.css'; ?>">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url().'assets/css/fileupload/jquery-ui.css'; ?>">-->
        
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
        
        <!--<script type="text/javascript" src="<?php echo js_url('jquery-1.7.1.min') ?>"></script>-->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <!--<script type="text/javascript" src="<?php echo js_url('modernizr.custom.63321') ?>"></script>-->
        
        <?php foreach ($js as $url): ?>
            <!--<script type="text/javascript" src="<?php echo $url; ?>"></script>--> 
        <?php endforeach; ?>
    </head>

    <body <?php if (isset($id_bkg)) echo 'class="' . $id_bkg . '"'; ?>>
        <header>
            <div id="header">
                <a href="<?php echo site_url('home/' . $this->session->userdata('uid')); ?>" class="link_logo">
                    <img id="logo" src="<?php echo img_url('header/logo.png') ?>" alt="Logo Slyset" />
                </a>

                <div id="ico_menu">
                    <a href="<?php echo site_url('home/' . $this->session->userdata('uid')); ?>" id="accueil"><span>Accueil</span></a>
                    <a href="#" id="explorer"><span>Rechercher</span></a>
                        <?php if ($this->session->userdata('logged_in') != 1): ?>
                            <a href="<?php echo site_url('user'); ?>" id="inscrire"><span>S'inscrire</span></a>
                        <?php endif; ?>

                    <div id="execution-times">
                        <p><?php echo $this->benchmark->memory_usage(); ?></p>
                        <p><?php echo $this->benchmark->elapsed_time() . 'ms'; ?></p>
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
                            <a href="<?php echo site_url('home/' . $this->session->userdata('uid')) ?>"><?php echo $this->session->userdata('login'); ?></a> | <a href="<?php echo site_url('login/logout'); ?>">Déconnexion</a>
                        <?php else: ?>
                            <a href="<?php echo site_url('login'); ?>">Connexion</a>
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
<!--<script>
/*jslint unparam: true, regexp: true */
/*global window, $ */
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = '../upload_img',
        uploadButton = $('<button/>')
            .addClass('btn btn-primary')
            .prop('disabled', true)
            .text('Processing...')
            .on('click', function () {
                var $this = $(this),
                    data = $this.data();
                $this
                    .off('click')
                    .text('Abort')
                    .on('click', function () {
                        $this.remove();
                        data.abort();
                    });
                data.submit().always(function () {
                    $this.remove();
                });
            });
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png|mp3)$/i,
        maxFileSize: 500000000, // 5 MB
        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/
            .test(window.navigator.userAgent),
        previewMaxWidth: 100,
        previewMaxHeight: 100,
        previewCrop: true
    }).on('fileuploadadd', function (e, data) {
        data.context = $('<div/>').appendTo('#files');
        $.each(data.files, function (index, file) {
            var node = $('<p/>')
                    .append($('<span/>').text(file.name));
            if (!index) {
                node
                    .append('<br>')
                    .append(uploadButton.clone(true).data(data));
            }
            node.appendTo(data.context);
        });
    }).on('fileuploadprocessalways', function (e, data) {
        var index = data.index,
            file = data.files[index],
            node = $(data.context.children()[index]);
        if (file.preview) {
            node
                .prepend('<br>')
                .prepend(file.preview);
        }
        if (file.error) {
            node
                .append('<br>')
                .append(file.error);
        }
        if (index + 1 === data.files.length) {
            data.context.find('button')
                .text('Upload')
                .prop('disabled', !!data.files.error);
        }
    }).on('fileuploadprogressall', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .progress-bar').css(
            'width',
            progress + '%'
        );
    }).on('fileuploaddone', function (e, data) {
        $.each(data.result.files, function (index, file) {
            var link = $('<a>')
                .attr('target', '_blank')
                .prop('href', file.url);
            $(data.context.children()[index])
                .wrap(link);
        });
    }).on('fileuploadfail', function (e, data) {
        $.each(data.result.files, function (index, file) {
            var error = $('<span/>').text(file.error);
            $(data.context.children()[index])
                .append('<br>')
                .append(error);
        });
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
</script>-->

        <script type="text/javascript" src="<?php echo js_url('jquery.placeheld.min') ?>"></script>
        <script type="text/javascript" src="<?php echo js_url('slyset') ?>"></script>
    </body>
</html>