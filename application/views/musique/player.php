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

                <div class="current-music" style="background:url('<?php echo base_url() . 'assets/images/player/bkg-current.png'; ?>') no-repeat 0 0 transparent;background-size:100%;">
                    <div class="infos-txt">
                        <h2 class="title">Comme Together</h2>
                        <p class="artist">The Beatles</p>
                    </div>

                    <div class="controls">
                        <audio src="<?php echo base_url() . 'assets/musique/Blue_Light.mp3'; ?>" type="audio/mpeg"  preload="auto" autoplay="autoplay"></audio>
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

                <?php 
                if ($playlists == 'no_track') 
                {
                    if ($this->uri->segment(4)=="playlists")
                    {
                        echo '<div class="no-track">Vous n\'avez aucune playlist</div>';
                    }
                    else
                    {
                         echo '<div class="no-track">aucun morceau n\'est disponible pour cet artiste</div>';
                    }
                }
                else
                {
                    foreach ($playlists[0] as $playlist): ?>
                        <!--<ol><?php // echo ucfirst($this->uri->segment(4));  ?> : <?php // echo $playlist->nom  ?>-->
                        <div class="top">
                            <span class="txt-ecoute"><?php echo ucfirst($this->uri->segment(4))?>: <?php echo $playlist->nom  ?> <?php if($playlists[2]!= null) echo '<span class="more_albpl"> <img width="30px" src="'.img_url('player/tritrait.png').'"> </span>' ?> </span>
                        </div>
                            
                        <?php 
                        if($playlists[2]!= null): 
                        ?>
                           <div class="modal_alert drop"><p>Selectionner une playlist</p>
                               
                                </br>
                    
<?php
                                foreach ($playlists[2] as $all_name_albpl):
                                 ?>
                                    <span><?php echo ucfirst($this->uri->segment(4))?>: <a href="<?php echo base_url('index.php/mc_musique/player/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/'.$all_name_albpl->nom) ?>"><?php echo $all_name_albpl->nom  ?></a></span>

                                <!--<div class="top">
                                    <span class="txt-ecoute"><?php echo ucfirst($this->uri->segment(4))?>: <a href="<?php echo base_url('index.php/mc_musique/player/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/'.$all_name_albpl->nom) ?>"><?php echo $all_name_albpl->nom  ?></a></span>
                                </div>-->
                                <?php 
                                endforeach; 
                            ?>
                            </div>
                            <?php
                        endif;
                        ?>

                        <div class="list-morceaux">
                            <ul>
                                <?php  foreach ($playlists[1] as $morceaux): 
                                    if ($morceaux->nom == $playlist->nom): ?>
                                        <li>
                                            <a href="#" data-src="<?php echo base_url() .'files/'.$this->uri->segment(3).'/musique/'.str_replace(' ','_',$morceaux->title_album).'/'.$morceaux->filename; ?>"><div class="track"><?php if(strlen($morceaux->title_track)<21) { echo $morceaux->title_track ;} else {echo substr($morceaux->title_track, 0,18).' ...';}?></div> <div class="artiste"><?php echo $morceaux->login ?></div></a>
                                            <span class="cover_alb" id="<?php echo $morceaux->id ?>" style="visibility:hidden" href="<?php echo files($morceaux->user_id_cur.'/albums/'.str_replace(' ','_',$morceaux->title_album).'/'.$morceaux->cover_path)?>"></span>
                                        </li>
                                        <!-- <li><a href="#" data-src="<?php echo base_url() . 'assets/musique/Luno.mp3'; ?>">2222<?php  echo $morceaux->title_track  ?></a></li>
                                        <li><a href="#" data-src="<?php echo base_url() . 'assets/musique/Compliments.mp3'; ?>">3333<?php  echo $morceaux->title_track  ?></a></li>
                                        -->
                                    <?php endif; ?>
                                <?php  endforeach; ?>
                            </ul>
                        </div>
                        <!--</ol>-->
                        </br>
                    <?php  
                    endforeach; 
                }
                ?>

                <span style="float:left;" id="duration"></span><span style="float:right;" id="timeleft"></span>
            </div>
        </div>

        <script type="text/javascript" src="<?php echo js_url('audiojs/audio.min') ?>"></script>
        <script type="text/javascript" src="<?php echo js_url('slyset') ?>"></script>
    </body>
</html>