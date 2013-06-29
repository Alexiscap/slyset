<!--
TODO LIST :

fn + ajax : suppresion des posts
sort big array by date

-->

<?php
    $session_id = $this->session->userdata('uid');
    $uid = (empty($session_id)) ? '' : $session_id;
    $uid_visit = (empty($infos_profile)) ? $session_id : $infos_profile->id;
    $login = (empty($infos_profile)) ? $this->session->userdata('login') : $infos_profile->login;
?>

<div id="contentAll">
    <div id="breadcrumbs">
        <ul>
            <li><a href="<?php print site_url('home/' . $uid); ?>">Accueil</a></li>
            <li><a href="<?php print site_url('my-wall/' . $uid_visit); ?>"><?php print 'Mon compte'; ?></a></li>
            <li><a href="<?php print site_url($this->uri->segment(1) . '/' . $uid_visit); ?>">Fil d'actualité</a></li>
        </ul>
    </div>

    <div id="cover" style="background-image:url(<?php print files('profiles/' . $cover = (empty($infos_profile)) ? $this->session->userdata('cover') : $infos_profile->cover); ?>);">
        <div id="infos-cover">
            <h2><?php print $login; ?></h2>
            <a href="#"><span class="button_left"></span><span class="button_center">Suivre</span><span class="button_right"></span></a>
        </div>
    </div>

    <div id="stats-cover">
        <div class="stats_cover_block">
            <span class="stats_number">489</span>
            <span class="stats_title">écoutes</span>
        </div>

        <div class="stats_cover_block">
            <span class="stats_number">18</span>
            <span class="stats_title">playlists</span>
        </div>

        <div class="stats_cover_block">
            <span class="stats_number">278</span>
            <span class="stats_title">abonnements</span>
        </div>
    </div>


    <div id = "content" class="content">  

        <?php
        if (isset($data_all_wall)):
            foreach ($data_all_wall as $entity_wall):
                if ($entity_wall->product == 1):
                    if ($entity_wall->type == 'MU'):
                        ?>

                        <!--  ******* ******* **** PHOTO SEULE AJOUT PAR UN MUSICIEN  ******* ******* **** -->

                        <div id ="<?php echo $entity_wall->id ?>" class="artist_post photo_message">
                            <div class="top"   class="top" id="<?php echo $entity_wall->id ?>">

                                <?php if ($this->uri->segment(2) == $session_id):
                                    ?>
                                    <a href="#"><img src="<?php echo img_url('musicien/btn_suppr.png'); ?>" alt="Suppression" /></a>
                                <?php endif; ?>

                            </div>
                            <div class="left">

                                <img src="<?php echo files('profiles/' . $entity_wall->thumb); ?>" alt="Photo Profil" />
                            </div>
                            <div class="right">
                                <span class="ico_citation"></span>
                                <p class="msg_post"><?php echo $entity_wall->login ?> viens d’ajouter une photo :  <a href="<?php echo site_url('mc_photos/zoom_photo/' . $entity_wall->idproduit) ?>"><?php echo $entity_wall->main_nom ?></a></p>
                                <img src="<?php echo base_url('./files/' . $entity_wall->Utilisateur_id . '/photos/' . $entity_wall->file_name); ?>" alt="Photo message" class="single" />
                            </div>
                            <div class="bottom">
                                <span class="infos_publi"><?php echo $entity_wall->login ?> - <?php echo $entity_wall->date ?><!--Le 26 Septembre 2013--></span>
                            </div>
                        </div>
                        <?php
                    endif;

                    if ($entity_wall->type == 'ME'):
                        ?>
                        <!-- ******* ******* ***** LIKE D'UNE PHOTO  ******* ******* **** -->

                        <div id ="<?php echo $entity_wall->id ?>" class="artist_post photo_message">
                            <div class="top"   class="top" id="<?php echo $entity_wall->id ?>">
                                <?php if ($this->uri->segment(2) == $session_id):
                                    ?>
                                    <a href="#"><img src="<?php echo img_url('musicien/btn_suppr.png'); ?>" alt="Suppression" /></a>
                                <?php endif; ?>

                            </div>

                            <div class="left">

                                <img src="<?php echo base_url('./files/profiles/' . $info_user[0]->thumb); ?>" alt="Photo Profil" />
                            </div>

                            <div class="right">
                                <span class="ico_citation"></span>
                                <p class="msg_post">Je viens de liker la photo de <?php echo $entity_wall->login ?> :  <a href="<?php echo base_url('index.php/mc_photos/zoom_photo/' . $entity_wall->idproduit) ?>"><?php echo $entity_wall->main_nom ?></a></p>
                                <!--  <img src="<?php echo base_url('./files/' . $entity_wall->Utilisateur_id . '/photos/' . $entity_wall->file_name); ?>" alt="Photo message" class="single" />
                                -->  
                            </div>

                            <div class="bottom">
                                <span class="infos_publi"><?php echo $this->uri->segment('') ?><!--  - --> <?php echo $entity_wall->date ?><!--Le 26 Septembre 2013--></span>
                            </div>
                        </div>

                        <?php
                    endif;
                endif;

                if ($entity_wall->product == 2):
                    if ($entity_wall->type == 'ME'):
                        ?>
                        <!-- ******* ******* ***** LIKE D'UNE VIDEO  ******* ******* **** -->

                        <div id ="<?php echo $entity_wall->id ?>" class="artist_post photo_message">
                            <div class="top"   class="top" id="<?php echo $entity_wall->id ?>">
                <?php if ($this->uri->segment(2) == $session_id):
                    ?>
                                    <a href="#"><img src="<?php echo img_url('musicien/btn_suppr.png'); ?>" alt="Suppression" /></a>
                                <?php endif; ?>

                            </div>
                            <div class="left">

                                <img src="<?php echo base_url('./files/profiles/' . $info_user[0]->thumb); ?>" alt="Photo Profil" />
                            </div>
                            <div class="right">
                                <span class="ico_citation"></span>
                                <p class="msg_post">Je viens de liker la video de <?php echo $entity_wall->login ?> :  <a href="<?php echo 'http://www.youtube.com/v/' . $entity_wall->file_name . '?version=3' ?>"><?php echo $entity_wall->main_nom ?></a></p>
                               <!--  <img src="<?php echo base_url('./files/' . $entity_wall->Utilisateur_id . '/photos/' . $entity_wall->file_name); ?>" alt="Photo message" class="single" />
                                -->  
                            </div>
                            <div class="bottom">
                              <span class="infos_publi"><!--<?php echo $this->session->userdata('login') ?> ---> <?php echo $entity_wall->date ?><!--Le 26 Septembre 2013--></span>
                            </div>
                        </div>

                <?php
            endif;

            if ($entity_wall->type == 'MU'):
                ?>
                        <!-- ******* ******* ***** AJOUT D'UNE VIDEO  ******* ******* **** -->

                        <div id ="<?php echo $entity_wall->id ?>" class="artist_post photo_message">
                            <div class="top"   class="top" id="<?php echo $entity_wall->id ?>">
                        <?php if ($this->uri->segment(2) == $session_id):
                            ?>
                                    <a href="#"><img src="<?php echo img_url('musicien/btn_suppr.png'); ?>" alt="Suppression" /></a>
                <?php endif; ?>

                            </div>
                            <div class="left">

                                <img src="<?php echo files('profiles/' . $entity_wall->thumb); ?>" alt="Photo Profil" />
                            </div>
                            <div class="right">
                                <span class="ico_citation"></span>
                                <p class="msg_post"><a href="<?php echo site_url('actualite/' . $entity_wall->Utilisateur_id) ?>" ><?php echo $entity_wall->login ?></a> viens d’ajouter une video :  <a href="<?php echo 'http://www.youtube.com/v/' . $entity_wall->file_name . '?version=3' ?>"><?php echo $entity_wall->main_nom ?></a></p>

                                <iframe id="ytplayer" type="document" width="455" height="350" src="http://www.youtube.com/v/<?php echo $entity_wall->file_name ?>?version=3" /></iframe>

                            </div>
                            <div class="bottom">
                                <span class="infos_publi"><?php echo $entity_wall->login ?> - <?php echo $entity_wall->date ?><!--Le 26 Septembre 2013--></span>
                            </div>
                        </div>

                <?php
            endif;

        endif;

        if ($entity_wall->product == 3):
            if ($entity_wall->type == 'ME'):
                ?>

                        <!-- ******* ******* ***** CONCERT Je vais participer  ******* ******* **** -->

                        <div  id ="<?php echo $entity_wall->id ?>" class="artist_post photo_message">
                            <div class="top"   class="top" id="<?php echo $entity_wall->id ?>">
                        <?php if ($this->uri->segment(2) == $session_id):
                            ?>
                                    <a href="#"><img src="<?php echo img_url('musicien/btn_suppr.png'); ?>" alt="Suppression" /></a>
                <?php endif; ?>

                            </div>

                            <div class="left">

                                <img src="<?php echo base_url('./files/profiles/' . $info_user[0]->thumb); ?>" alt="Photo Profil" />
                            </div>

                            <div class="right">
                                <span class="ico_citation"></span>
                                <p class="msg_post">Je vais participer au concert de  <a href="<?php echo base_url('/index.php/actualite/' . $entity_wall->Utilisateur_id) ?>"><?php echo $entity_wall->login ?>   </a>
                                <!--  <img src="<?php echo base_url('./files/' . $entity_wall->Utilisateur_id . '/photos/' . $entity_wall->file_name); ?>" alt="Photo message" class="single" />
                                    -->  
                                    </br></br>
                                    <a href="<?php echo base_url("index.php/mc_concerts/" . $entity_wall->Utilisateur_id . '/#' . $entity_wall->idproduit) ?>"><?php echo $entity_wall->salle ?> - <?php echo $entity_wall->ville ?></a></p>
                            </div>

                            <div class="bottom">
                            <span class="infos_publi"><!--<?php echo $this->session->userdata('login') ?> - --><?php echo $entity_wall->date ?><!--Le 26 Septembre 2013--></span>
                            </div>
                        </div>

                <?php
            endif;

            if ($entity_wall->type == 'MU'):
                ?>
                        <div id ="<?php echo $entity_wall->id ?>" class="artist_post photo_message">
                            <div class="top"   class="top" id="<?php echo $entity_wall->id ?>">
                        <?php if ($this->uri->segment(2) == $session_id):
                            ?>
                                    <a href="#"><img src="<?php echo img_url('musicien/btn_suppr.png'); ?>" alt="Suppression" /></a>
                        <?php endif; ?>

                            </div>

                            <div class="left">

                                <img src="<?php echo base_url('./files/profiles/' . $entity_wall->thumb); ?>" alt="Photo Profil" />
                            </div>

                            <div class="right">
                                <span class="ico_citation"></span>
                                <p class="msg_post"><a href="<?php echo base_url('/index.php/actualite/' . $entity_wall->Utilisateur_id) ?>"><?php echo $entity_wall->main_nom ?></a> vient d'ajouter un concert  :
                                <!--  <img src="<?php echo base_url('./files/' . $entity_wall->Utilisateur_id . '/photos/' . $entity_wall->file_name); ?>" alt="Photo message" class="single" />
                                    -->  
                                    </br></br>
                                    <a href="<?php echo base_url("index.php/mc_concerts/" . $entity_wall->Utilisateur_id . '/#' . $entity_wall->idproduit) ?>"><?php echo $entity_wall->salle ?> - <?php echo $entity_wall->ville ?></a></p>
                            </div>

                            <div class="bottom">
                                <span class="infos_publi"><?php echo $entity_wall->login ?> - <?php echo $entity_wall->date ?><!--Le 26 Septembre 2013--></span>
                            </div>
                        </div>

                <?php
            endif;
        endif;

        if ($entity_wall->product == 4):
            if ($entity_wall->type == 'MU'):
                ?>
                        <div id ="<?php echo $entity_wall->id ?>" class="artist_post photo_message">
                            <div class="top"   class="top" id="<?php echo $entity_wall->id ?>">
                        <?php
                        if ($this->uri->segment(2) == $session_id):
                            ?>
                                    <a href="#"><img src="<?php echo img_url('musicien/btn_suppr.png'); ?>" alt="Suppression" /></a>
                <?php endif; ?>

                            </div>

                            <div class="left">

                                <img src="<?php echo files('profiles/' . $entity_wall->thumb); ?>" alt="Photo Profil" />
                            </div>

                            <div class="right">
                                <span class="ico_citation"></span>
                                <p class="msg_post"><a href="<?php echo site_url('actualite/' . $entity_wall->walltouser) ?>"><?php echo $entity_wall->login ?> </a>vient de poster un message sur son mur : 
                                <!--  <img src="<?php echo files($entity_wall->Utilisateur_id . '/photos/' . $entity_wall->file_name); ?>" alt="Photo message" class="single" />
                                    -->  
                                    </br></br>
                                    " <?php echo $entity_wall->main_nom ?> "</p>
                            </div>

                            <div class="bottom">
                                <span class="infos_publi"><?php echo $entity_wall->login ?> - <?php echo $entity_wall->date ?><!--Le 26 Septembre 2013--></span>
                            </div>
                        </div>

                <?php
            endif;

            if ($entity_wall->type == 'ME'):
                ?>
                        <div id ="<?php echo $entity_wall->id ?>" class="artist_post photo_message">
                            <div class="top"   class="top" id="<?php echo $entity_wall->id ?>">
                        <?php
                        if ($this->uri->segment(2) == $session_id):
                            ?>
                                    <a href="#"><img src="<?php echo img_url('musicien/btn_suppr.png'); ?>" alt="Suppression" /></a>
                <?php endif; ?>

                            </div>

                            <div class="left">

                                <img src="<?php echo files('profiles/' . $entity_wall->thumb); ?>" alt="Photo Profil" />
                            </div>

                            <div class="right">
                                <span class="ico_citation"></span>
                                <p class="msg_post">Je vient de poster un message sur le mur de <a href="<?php echo base_url('index.php/actualite/' . $entity_wall->walltouser) ?>"><?php echo $entity_wall->login ?></a>: 
                                <!--  <img src="<?php echo base_url('./files/' . $entity_wall->Utilisateur_id . '/photos/' . $entity_wall->file_name); ?>" alt="Photo message" class="single" />
                                    -->  
                                    </br></br>
                                    " <?php echo $entity_wall->main_nom ?> "</p>
                            </div>

                            <div class="bottom">
                                <span class="infos_publi"><?php /* echo $entity_wall->login */ ?> - <?php echo $entity_wall->date ?><!--Le 26 Septembre 2013--></span>
                            </div>
                        </div>

                <?php
            endif;

        endif;

    endforeach;
endif;
?>

        <!--
           <div class="artist_post photo_message">
             <div class="top">
               <a href="#"><img src="<?php echo img_url('musicien/btn_suppr.png'); ?>" alt="Suppression" /></a>
             </div>
             <div class="left">
               <img src="<?php echo img_url('sidebar-left/photo-profil.png'); ?>" alt="Photo Profil" />
             </div>
             <div class="right">
               <span class="ico_citation"></span>
               <p class="msg_post">Je viens d’ajouter une photo à <a href="#">mon album “Tournée 2013”</a></p>
               <img src="<?php echo img_url('common/post_photo.jpg'); ?>" alt="Photo message" class="single" />
             </div>
             <div class="bottom">
               <span class="infos_publi">Bob Dylan - Le 26 Septembre 2013</span>
             </div>
           </div>
       
       
       
           <div class="artist_post photo_message">
             <div class="top">
               <a href="#"><img src="<?php echo img_url('musicien/btn_suppr.png'); ?>" alt="Suppression" /></a>
             </div>
             <div class="left">
               <img src="<?php echo img_url('sidebar-left/photo-profil.png'); ?>" alt="Photo Profil" />
             </div>
             <div class="right">
               <span class="ico_citation"></span>
               <p class="msg_post">Je viens d’ajouter 3 photos à <a href="#">mon album “Souvenirs, souvenirs”</a></p>
               <img src="<?php echo img_url('common/post_ajout_photo1.jpg'); ?>" alt="Photo message" class="mosaic first" />
               <img src="<?php echo img_url('common/post_ajout_photo2.jpg'); ?>" alt="Photo message" class="mosaic" />
               <img src="<?php echo img_url('common/post_ajout_photo3.jpg'); ?>" alt="Photo message" class="mosaic last" />
             </div>
             <div class="bottom">
               <span class="infos_publi">Bob Dylan - Le 21 Septembre 2013</span>
             </div>
           </div>
       
           <div class="artist_post article">
             <div class="top">
               <a href="#"><img src="<?php echo img_url('musicien/btn_suppr.png'); ?>" alt="Suppression" /></a>
             </div>
             <div class="left">
               <img src="<?php echo img_url('sidebar-left/photo-profil.png'); ?>" alt="Photo Profil" />
             </div>
             <div class="right">
               <span class="ico_citation"></span>
               <p class="msg_post">Découvrez la chronique de mon dernier album !</p>
       
               <div class="post_article">
                 <img src="<?php echo img_url('common/article_photo.jpg'); ?>" alt="Photo d'interview" />
       
                 <a href="#">Dylan toujours à flots après la tempête</a>
                 <p>Bob Dylan revient en pleine lumière avec une collection de ballades country-blues-jazz crépusculaires. Tirés par la swinguante locomotive Duquesne Whistle...</p>
               </div>
             </div>
             <div class="bottom">
               <span class="infos_publi">Jim Morisson - Le 24 Septembre 2013</span>
             </div>
           </div>
       
           <div class="artist_post news_song">
             <div class="top">
               <a href="#"><img src="<?php echo img_url('musicien/btn_suppr.png'); ?>" alt="Suppression" /></a>
             </div>
             <div class="left">
               <img src="<?php echo img_url('sidebar-left/photo-profil.png'); ?>" alt="Photo Profil" />
             </div>
             <div class="right">
               <span class="ico_citation"></span>
               <p class="msg_post">Je viens d’ajouter 2 nouveaux morceaux à <a href="#">ma musique</a></p>
       
               <div class="new_songs">
                 <a href="#"><span class="btn_play"></span>Pretty Pegy</a>
                 <a href="#"><span class="btn_play"></span>Hard Times in New York Town</a>
               </div>
             </div>
             <div class="bottom">
               <span class="infos_publi">Jim Morisson - Le 24 Septembre 2013</span>
             </div>
           </div>
        -->
    </div>

<?php if (isset($sidebar_right)) echo $sidebar_right; ?>

    <div class="pagination">
        <a href="#" id="precedent"><span><</span></a>
        <a href="#" class="page">1</a>
        <a href="#" class="page">2</a>
        <a href="#" class="page">3</a>
        <a href="#" class="page">4</a>
        <a href="#" class="page">5</a>
        <a href="#" id="suivant"><span>></span></a>
    </div>

</div>