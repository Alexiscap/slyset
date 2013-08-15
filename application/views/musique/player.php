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

        <link rel="stylesheet" type="text/css" media="screen" href="http://localhost/slyset/assets/css/slyset.css" />

        <!--[if IE]>
          <link type="text/css" rel="stylesheet" href="<?php echo css_url('corrections-ie') ?>" />
        <![endif]-->
        
        <!--<script type="text/javascript" src="<?php echo js_url('jquery-1.7.1.min') ?>"></script>-->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo js_url('modernizr.custom.63321') ?>"></script>
    </head>

    <body <?php if (isset($id_bkg)) echo 'class="' . $id_bkg . '"'; ?>>
        
<div class="content">
    <!--<audio src="<?php echo base_url().'/assets/musique/test.mp3'; ?>" preload="auto"></audio>--> 
    <!--<div class="audiojs " classname="audiojs" id="audiojs_wrapper0">-->
        <audio src="<?php echo base_url().'assets/musique/Tame Impala - Apocalypse Dreams.mp3'; ?>" type="audio/mpeg"  preload="auto" autoplay="autoplay"></audio>
<!--        <div class="play-pause">
            <p class="play"></p>
            <p class="pause"></p>
            <p class="loading"></p>
            <p class="error"></p>
        </div>
        <div class="scrubber">
            <div class="progress" style="width: 0px;"></div>
            <div class="loaded" style="width: 167.82671844430362px;"></div>
        </div>
        <div class="time">
            <em class="played">00:00</em>/<strong class="duration">04:09</strong>
        </div>
        <div class="error-message"></div>
    </div>-->


<!--    <p><a href="#" id="vol-0">Volume: 0.0</a></p>
    <p><a href="#" id="vol-10">Volume: 0.1</a></p>
    <p><a href="#" id="vol-40">Volume: 0.4</a></p>
    <p><a href="#" id="vol-70">Volume: 0.7</a></p>
    <p><a href="#" id="vol-100">Volume: 1.0</a></p>-->
    <?php foreach ($playlists as $playlist): ?>
   		<ol>Plyalist : <?php echo $playlist->nom ?>
   			<?php foreach ($morceaux_playlist as $morceaux):
   				if($morceaux->nom == $playlist->nom ): ?>
        	
        	<li>Morceaux<a href="#" data-src="<?php echo base_url().'/assets/musique/Tame Impala - Apocalypse Dreams.mp3'; ?>"><?php echo $morceaux->title_track ?></a></li>

     	</ol>
     	</br>
      <?php 
      		endif;
      		 endforeach;
      endforeach;?>
    <div id="shortcuts">
      <div>
        <h1>Keyboard shortcuts:</h1>
        <p><em>&rarr;</em> Next track</p>
        <p><em>&larr;</em> Previous track</p>
        <p><em>Space</em> Play/pause</p>
      </div>
    </div>
</div>

        
        <script type="text/javascript" src="http://localhost/slyset/assets/javascript/audiojs/audio.js"></script> 
            
        <script type="text/javascript" src="<?php echo js_url('slyset') ?>"></script>
    </body>
</html>