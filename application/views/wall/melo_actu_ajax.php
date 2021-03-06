<?php
    $session_id = $this->session->userdata('uid');
    $uid = (empty($session_id)) ? '' : $session_id;
    $uid_visit = (empty($infos_profile)) ? $session_id : $infos_profile->id;
    $login = (empty($infos_profile)) ? $this->session->userdata('login') : $infos_profile->login;
?>

<?php foreach ($data_all_wall as $entity_wall):
    // ------------------------ PHOTO --------------------------

    if ($entity_wall->product == 1):
        // -------------- PHOTO : musicient a ajoute ---------------

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
                    <img src="<?php echo files('profiles/' . $entity_wall->thumb); ?>" alt="Photo Profil" />
                </div>

                <div class="right">
                    <span class="ico_citation"></span>
                    <p class="msg_post"><a href="<?php echo site_url('actualite/' . $entity_wall->Utilisateur_id) ?>" ><?php echo $entity_wall->login ?></a> viens d’ajouter une photo :  <a href="<?php echo site_url('mc_photos/zoom_photo/' . $entity_wall->idproduit) ?>"><?php echo $entity_wall->main_nom ?></a></p>
                    <img src="<?php echo base_url('./files/' . $entity_wall->Utilisateur_id . '/photos/' . $entity_wall->file_name); ?>" alt="Photo message" class="single" />
                </div>

                <div class="bottom">
    							<span class="infos_publi">
                      <?php // print_r($entity_wall); ?><?php echo $entity_wall->login; ?> - <?php	$date_format = (date_create($entity_wall->date, timezone_open('Europe/Paris')));
                        $a =  date_timestamp_get($date_format);
                        echo $data['date_2'] = date('d-m-Y', strtotime(str_replace('-', '/', $entity_wall->date)));//strftime('Le %d %B %G',$a); ?>
                  </span>
                </div>
            </div>

            <?php
        endif;

        if ($entity_wall->type == 'ME'):

            // ------------------------ PHOTO : J'ai liké (melo)--------------------------
            ?>
            <div id ="<?php echo $entity_wall->id ?>" class="artist_post photo_message">
                <div class="top"   class="top" id="<?php echo $entity_wall->id ?>">
                    <?php if ($this->uri->segment(2) == $session_id):
                        ?>
                        <a href="#"><img src="<?php echo img_url('musicien/btn_suppr.png'); ?>" alt="Suppression" /></a>
            <?php endif; ?>
                </div>

                <div class="left">

                    <img src="<?php echo base_url('./files/profiles/' . $profile->thumb); ?>" alt="Photo Profil" />
                </div>

                <div class="right">
                    <span class="ico_citation"></span>
                    <p class="msg_post">Je viens d'aimer la photo de <?php echo $entity_wall->login ?> :  <a href="<?php echo base_url('index.php/mc_photos/zoom_photo/' . $entity_wall->idproduit) ?>"><?php echo $entity_wall->main_nom ?></a></p>
                    <img src="<?php echo base_url('./files/' . $entity_wall->Utilisateur_id . '/photos/' . $entity_wall->file_name); ?>" alt="Photo message" class="single" />

                                <!--  <img src="<?php echo base_url('./files/' . $entity_wall->Utilisateur_id . '/photos/' . $entity_wall->file_name); ?>" alt="Photo message" class="single" />
                    -->  
                </div>

                <div class="bottom">
    							<span class="infos_publi">
                      <?php // print_r($entity_wall); ?><?php echo $entity_wall->login; ?> - <?php	$date_format = (date_create($entity_wall->date, timezone_open('Europe/Paris')));
                        $a =  date_timestamp_get($date_format);
                        echo $data['date_2'] = date('d-m-Y', strtotime(str_replace('-', '/', $entity_wall->date)));//strftime('Le %d %B %G',$a); ?>
                  </span>
                </div>
            </div>

            <?php
        endif;
    endif;
    // ------------------------ VIDEO --------------------------
    if ($entity_wall->product == 2):
        // ------------------------ VIDEO : J'ai liké (melo)--------------------------

        if ($entity_wall->type == 'ME'):
            ?>
            <!-- ******* ******* ***** LIKE D'UNE VIDEO  ******* ******* **** -->

            <div id ="<?php echo $entity_wall->id ?>" class="artist_post photo_message">
                <div class="top"   class="top" id="<?php echo $entity_wall->id ?>">
                    <?php if ($this->uri->segment(2) == $this->session->userdata('uid')):
                        ?>
                        <a href="#"><img src="<?php echo img_url('musicien/btn_suppr.png'); ?>" alt="Suppression" /></a>
            <?php endif; ?>

                </div>
                <div class="left">

                    <img src="<?php echo base_url('./files/profiles/' . $profile->thumb); ?>" alt="Photo Profil" />
                </div>
                <div class="right">
                    <span class="ico_citation"></span>
                    <p class="msg_post">Je viens d'aimer la video de <?php echo $entity_wall->login ?> :  <a href="<?php echo 'http://www.youtube.com/v/' . $entity_wall->file_name . '?version=3' ?>"><?php echo $entity_wall->main_nom ?></a></p>
                    <iframe id="ytplayer" type="document" width="455" height="350" src="http://www.youtube.com/v/<?php echo $entity_wall->file_name ?>?version=3" /></iframe>

                </div>
                <div class="bottom">
    							<span class="infos_publi">
                      <?php // print_r($entity_wall); ?><?php echo $entity_wall->login; ?> - <?php	$date_format = (date_create($entity_wall->date, timezone_open('Europe/Paris')));
                        $a =  date_timestamp_get($date_format);
                        echo $data['date_2'] = date('d-m-Y', strtotime(str_replace('-', '/', $entity_wall->date)));//strftime('Le %d %B %G',$a); ?>
                  </span>
                </div>
            </div>

            <?php
        endif;

        if ($entity_wall->type == 'MU'):
            ?>
            <!-- ******* ******* ***** AJOUT D'UNE VIDEO  ******* ******* **** -->

            <div id ="<?php echo $entity_wall->id ?>" class="artist_post photo_message">
                <div class="top"   class="top" id="<?php echo $entity_wall->id ?>">
            <?php if ($this->uri->segment(2) == $this->session->userdata('uid')):
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
    							<span class="infos_publi">
                      <?php // print_r($entity_wall); ?><?php echo $entity_wall->login; ?> - <?php	$date_format = (date_create($entity_wall->date, timezone_open('Europe/Paris')));
                        $a =  date_timestamp_get($date_format);
                        echo $data['date_2'] = date('d-m-Y', strtotime(str_replace('-', '/', $entity_wall->date)));//strftime('Le %d %B %G',$a); ?>
                  </span>
                </div>
            </div>
            <?php
        endif;
    endif;

    // ------------------------ CONCERT --------------------------
    if ($entity_wall->product == 3):
        if ($entity_wall->type == 'ME'):
            ?>
            <!-- ******* ******* ***** CONCERT Je  participee  ******* ******* **** -->

            <div  id ="<?php echo $entity_wall->id ?>" class="artist_post photo_message">
                <div class="top"   class="top" id="<?php echo $entity_wall->id ?>">
            <?php if ($this->uri->segment(2) == $this->session->userdata('uid')):
                ?>
                        <a href="#"><img src="<?php echo img_url('musicien/btn_suppr.png'); ?>" alt="Suppression" /></a>
            <?php endif; ?>

                </div>

                <div class="left">

                    <img src="<?php echo base_url('./files/profiles/' . $profile->thumb); ?>" alt="Photo Profil" />
                </div>

                <div class="right">
                    <span class="ico_citation"></span>
                    <p class="msg_post">Je participe au concert de  <a href="<?php echo base_url('/index.php/actualite/' . $entity_wall->Utilisateur_id) ?>"><?php echo $entity_wall->login ?>, à <?php echo $entity_wall->ville ?>   </a>
                    <!--  <img src="<?php echo base_url('./files/' . $entity_wall->Utilisateur_id . '/photos/' . $entity_wall->file_name); ?>" alt="Photo message" class="single" />
                        -->  
                        </br></br>
                    <div id="concert_detail_calendar">
                        <div class="calendar">
                            <div class="calendar-mois">
                                <?php
                                $date_format = (date_create($entity_wall->date_concert, timezone_open('Europe/Paris')));
                                $a = date_timestamp_get($date_format);
                                echo $data['date_2'] = '<a>' . strtoupper(strftime('%b', $a)) . '</a>';
                                ?>
                            </div>
                            <div class="calendar-jour">

            <?php
            $date_format = (date_create($entity_wall->date_concert, timezone_open('Europe/Paris')));
            $a = date_timestamp_get($date_format);
            echo $data['date_2'] = '<a>' . strftime('%d', $a) . '</a>';
            ?>
                            </div>
                        </div>
                        <div class="calendar-content">
                            <?php echo $entity_wall->login ?>
                            </br>
                            <a href="<?php echo base_url("index.php/concert/" . $entity_wall->Utilisateur_id . '/#' . $entity_wall->idproduit) ?>">
            <?php echo $entity_wall->salle ?> - <?php echo $entity_wall->ville ?>
                            </a>
                            </br>
            <?php
            $date_format = (date_create($entity_wall->date_concert, timezone_open('Europe/Paris')));
            $a = date_timestamp_get($date_format);
            echo $data['date_2'] = '<a>' . strftime('Le %d %B %G', $a) . '</a>';
            ?>
                        </div>
                    </div>
                    </p>
                </div>

                <div class="bottom">
    							<span class="infos_publi">
                      <?php // print_r($entity_wall); ?><?php echo $entity_wall->login; ?> - <?php	$date_format = (date_create($entity_wall->date, timezone_open('Europe/Paris')));
                        $a =  date_timestamp_get($date_format);
                        echo $data['date_2'] = date('d-m-Y', strtotime(str_replace('-', '/', $entity_wall->date)));//strftime('Le %d %B %G',$a); ?>
                  </span>
                </div>
            </div>

                    <?php
                endif;

                if ($entity_wall->type == 'MU'):
                    ?>
            <!-- ******* ******* ***** CONCERT AJout par musicien  ******* ******* **** -->

            <div id ="<?php echo $entity_wall->id ?>" class="artist_post photo_message">
                <div class="top"   class="top" id="<?php echo $entity_wall->id ?>">
            <?php if ($this->uri->segment(2) == $this->session->userdata('uid')):
                ?>
                        <a href="#"><img src="<?php echo img_url('musicien/btn_suppr.png'); ?>" alt="Suppression" /></a>
            <?php endif; ?>

                </div>

                <div class="left">

                    <img src="<?php echo base_url('./files/profiles/' . $entity_wall->thumb); ?>" alt="Photo Profil" />
                </div>

                <div class="right">
                    <span class="ico_citation"></span>
                    <p class="msg_post"><a href="<?php echo base_url('/index.php/actualite/' . $entity_wall->Utilisateur_id) ?>"><?php echo $entity_wall->login ?></a> vient d'ajouter un concert  :


                        </br></br>
                    <div id="concert_detail_calendar">
                        <div class="calendar">
                            <div class="calendar-mois">
            <?php
            $date_format = (date_create($entity_wall->date_concert, timezone_open('Europe/Paris')));
            $a = date_timestamp_get($date_format);
            echo $data['date_2'] = '<a>' . strtoupper(strftime('%b', $a)) . '</a>';
            ?>
                            </div>
                            <div class="calendar-jour">

                            <?php
                            $date_format = (date_create($entity_wall->date_concert, timezone_open('Europe/Paris')));
                            $a = date_timestamp_get($date_format);
                            echo $data['date_2'] = '<a>' . strftime('%d', $a) . '</a>';
                            ?>
                            </div>
                        </div>
                        <div class="calendar-content">
            <?php echo $entity_wall->login ?>
                            </br>
                            <a href="<?php echo base_url("index.php/concert/" . $entity_wall->Utilisateur_id . '/#' . $entity_wall->idproduit) ?>">
            <?php echo $entity_wall->salle ?> - <?php echo $entity_wall->ville ?>
                            </a>
                            </br>
                        <?php
                        $date_format = (date_create($entity_wall->date_concert, timezone_open('Europe/Paris')));
                        $a = date_timestamp_get($date_format);
                        echo $data['date_2'] = '<a>' . strftime('Le %d %B %G', $a) . '</a>';
                        ?>
                        </div>
                    </div>
                    </p>
                </div>



                <div class="bottom">
    							<span class="infos_publi">
                      <?php // print_r($entity_wall); ?><?php echo $entity_wall->login; ?> - <?php	$date_format = (date_create($entity_wall->date, timezone_open('Europe/Paris')));
                        $a =  date_timestamp_get($date_format);
                        echo $data['date_2'] = date('d-m-Y', strtotime(str_replace('-', '/', $entity_wall->date)));//strftime('Le %d %B %G',$a); ?>
                  </span>
                </div>
            </div>

            <?php
        endif;
    endif;


    // ------------------------ MESSAGE --------------------------

    if ($entity_wall->product == 4):
        if ($entity_wall->type == 'MU'):
            ?>
            <div id ="<?php echo $entity_wall->id ?>" class="artist_post photo_message">
                <div class="top"   class="top" id="<?php echo $entity_wall->id ?>">
            <?php
            if ($this->uri->segment(2) == $this->session->userdata('uid')):
                ?>
                        <a href="#"><img src="<?php echo img_url('musicien/btn_suppr.png'); ?>" alt="Suppression" /></a>
                        <?php endif; ?>

                </div>

                <div class="left">

                    <img src="<?php echo files('profiles/' . $entity_wall->thumb); ?>" alt="Photo Profil" />
                </div>

                <div class="right">
                    <span class="ico_citation"></span>
                    <p class="msg_post">
            <?php echo $entity_wall->main_nom ?> 
                    </p>
                </div>

                <div class="bottom">
    							<span class="infos_publi">
                      <?php // print_r($entity_wall); ?><?php echo $entity_wall->login; ?> - <?php	$date_format = (date_create($entity_wall->date, timezone_open('Europe/Paris')));
                        $a =  date_timestamp_get($date_format);
                        echo $data['date_2'] = date('d-m-Y', strtotime(str_replace('-', '/', $entity_wall->date)));//strftime('Le %d %B %G',$a); ?>
                  </span>
                </div>
            </div>

            <?php
        endif;
    endif;


    // ------------------------ ALBUM --------------------------

    if ($entity_wall->product == 5):
        // ------------------------ ALBUM MUSICIEN --------------------------

        if ($entity_wall->type == 'MU'):
            foreach ($photo_by_album as $key => $photo_album):
                if ($photo_album[0]->albums_media_file_name == $entity_wall->idproduit):
                    ?>	
                    <div class="artist_post photo_message">
                        <div class="top">
                            <a href="#"><img src="<?php echo img_url('musicien/btn_suppr.png'); ?>" alt="Suppression" /></a>
                        </div>
                        <div class="left">
                            <img src="<?php echo files('profiles/' . $entity_wall->thumb); ?>" alt="Photo Profil" />
                        </div>
                        <?php if (count($photo_album) > 1): ?>
                            <div class="right">
                                <span class="ico_citation"></span>
                                <p class="msg_post">
                        <?php echo $entity_wall->login; ?> vient d’ajouter <?php echo count($photo_album) ?> photos à <a href="<?php echo base_url('index.php/media/album/' . $entity_wall->Utilisateur_id . '/' . $photo_album[0]->albums_media_file_name) ?>">son album “<?php echo $entity_wall->main_nom ?>”</a>
                                </p>
                                <div class="content-mosaic">
                                    <?php foreach ($photo_album as $photo):
                                        ?>
                                        <img src="<?php echo base_url('files/' . $entity_wall->Utilisateur_id . '/photos/' . $entity_wall->idproduit . '/' . $photo->file_name); ?>" alt="<?php echo $photo->nom ?>" class="mosaic first" />
                        <?php endforeach; ?>
                                </div>
                            </div>

                    <?php
                    endif;
                    if (count($photo_album) == 1):
                        ?>
                            <div class="right">

                                <span class="ico_citation"></span>


                                <p class="msg_post"><?php echo $entity_wall->login;
                        ?> vient d’ajouter <?php echo count($photo_album) ?> photo à <a href="#">son album “<?php echo $entity_wall->main_nom ?>”</a></p>

                                <img src="<?php echo base_url('./files/' . $entity_wall->Utilisateur_id . '/photos/' . $photo_album[0]->albums_media_file_name . '/' . $photo_album[0]->file_name); ?>" alt="Photo message" class="single" />


                            </div>
                            <?php endif; ?>

                        <div class="bottom">
    							<span class="infos_publi">
                      <?php // print_r($entity_wall); ?><?php echo $entity_wall->login; ?> - <?php	$date_format = (date_create($entity_wall->date, timezone_open('Europe/Paris')));
                        $a =  date_timestamp_get($date_format);
                        echo $data['date_2'] = date('d-m-Y', strtotime(str_replace('-', '/', $entity_wall->date)));//strftime('Le %d %B %G',$a); ?>
                  </span>
                        </div>
                    </div>

                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if ($entity_wall->type == 'ME'): ?>
            <div id="<?php echo $entity_wall->id ?>" class="artist_post photo_message">
                <div class="top"  class="top" id="<?php echo $entity_wall->id ?>">
                        <?php if ($this->uri->segment(2) == $this->session->userdata('uid')):
                            ?>
                        <a href="#"><img src="<?php echo img_url('musicien/btn_suppr.png'); ?>" alt="Suppression" /></a>
            <?php endif; ?>

                </div>
                <div class="left">

                    <img src="<?php echo base_url('./files/profiles/' . $profile->thumb); ?>" alt="Photo Profil" />
                </div>
                <div class="right">
                    <span class="ico_citation"></span>
                    <p class="msg_post">Je viens d'aimer l'album de <?php echo $entity_wall->login ?> :  <a href="#"><?php echo $entity_wall->main_nom ?></a></p>
                   <!--  <img src="<?php echo base_url('./files/' . $entity_wall->Utilisateur_id . '/photos/' . $entity_wall->file_name); ?>" alt="Photo message" class="single" />
                    -->  
                </div>
                <div class="bottom">
    							<span class="infos_publi">
                      <?php // print_r($entity_wall); ?><?php echo $entity_wall->login; ?> - <?php	$date_format = (date_create($entity_wall->date, timezone_open('Europe/Paris')));
                        $a =  date_timestamp_get($date_format);
                        echo $data['date_2'] = date('d-m-Y', strtotime(str_replace('-', '/', $entity_wall->date)));//strftime('Le %d %B %G',$a); ?>
                  </span>
                </div>
            </div>
            <?php
        endif;
    endif;

endforeach; ?>

<div class="ajax_loader2"></div>