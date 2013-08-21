<?php date_default_timezone_set('Europe/Paris'); ?>

<!DOCTYPE HTML>
<html lang="fr">
    <head>
        <title><?php echo $title = (isset($titre)) ? $titre : 'Slyset'; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="Content-Language" content="fr" />
        <meta http-equiv="Content-Script-Type" content="text/javascript" />
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <meta name="description" content="<?php echo $desc = (isset($description)) ? $description : 'Description Slyset'; ?>" />
        <meta name="keywords" content="slyset, project web, social networks, music, réseau social, réseau social musical, musique, écoute, artiste, efficom, projet" />

        <!--<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />-->
        <link type="text/css" rel="stylesheet" href="<?php echo css_url('reset') ?>" />
        <link type="text/css" rel="stylesheet" href="<?php echo css_url('player') ?>" />

        <!--[if IE]>
          <link type="text/css" rel="stylesheet" href="<?php echo css_url('corrections-ie') ?>" />
        <![endif]-->

        <!--<script type="text/javascript" src="<?php echo js_url('jquery-1.7.1.min') ?>"></script>-->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo js_url('jquery-ui-1.10.3.min') ?>"></script>
    </head>

    <body class="player-audio">
        <div class="content">
            <div class="content-left">
                <div class="top">
                    <span class="ico-ecoute"></span>
                    <span class="txt-ecoute">Vous écoutez ...</span>
                </div>

                <div class="current-music" style="background:url('<?php echo base_url() . 'assets/images/player/bkg-current.png'; ?>') no-repeat 0 0 transparent;">
                    <div class="infos-txt">
                        <h2 class="title">Comme Together</h2>
                        <p class="artist">The Beatles</p>
                    </div>

                    <div class="controls">
                        <audio src="<?php echo base_url() . 'assets/musique/Anxiety.mp3'; ?>" type="audio/mpeg"  preload="auto"></audio>
                    </div>
                </div>

            <div class="extra-controls">
                <div class="random disable"></div>
                <div class="loop disable"></div>
                <div class="addto disable"></div>
                <div class="like disable"></div>
                
                <div class="vol disable">
                    <div id="vol-slider"></div>
                </div>
            </div>
        </div>

        <div class="content-right">

            <?php // foreach ($playlists[0] as $playlist): ?>
                <!--<ol><?php // echo ucfirst($this->uri->segment(4)); ?> : <?php // echo $playlist->nom ?>-->
                <div class="top">
                    <span class="txt-ecoute">Playlist : <?php // echo $playlist->nom ?></span>
                </div>
            
            
<!--<p>
  <label for="amount">Volume:</label>
  <input type="text" id="amount" style="border: 0; color: #f6931f; font-weight: bold;" />
</p>
 
<div id="slider-vertical" style="height: 200px; width:10px; background:red;"></div>-->

                <div class="list-morceaux">
                    <ul>
                        <?php // foreach ($playlists[1] as $morceaux): ?>
                            <?php // if ($morceaux->nom == $playlist->nom): ?>
                                <li><a href="#" data-src="<?php echo base_url() . 'assets/musique/Anxiety.mp3'; ?>">1111<?php // echo $morceaux->title_track ?></a></li>
                                <li><a href="#" data-src="<?php echo base_url() . 'assets/musique/Luno.mp3'; ?>">2222<?php // echo $morceaux->title_track ?></a></li>
                                <li><a href="#" data-src="<?php echo base_url() . 'assets/musique/Helicopter.mp3'; ?>">3333<?php // echo $morceaux->title_track ?></a></li>
                            <?php // endif; ?>
                        <?php // endforeach; ?>
                    </ul>
                </div>
                <!--</ol>-->
                </br>
            <?php // endforeach; ?>
                
                
            <span style="float:left;" id="duration"></span><span style="float:right;" id="timeleft"></span>
        </div>
    </div>

    <script type="text/javascript" src="<?php echo js_url('audiojs/audio') ?>"></script>
    <script type="text/javascript" src="<?php echo js_url('slyset') ?>"></script>
</body>
</html>