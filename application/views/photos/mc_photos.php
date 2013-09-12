<?php
$session_id = $this->session->userdata('uid');
$uid = (empty($session_id)) ? '' : $session_id;
$uid_visit = (empty($infos_profile)) ? $session_id : $infos_profile->id;
$login = (empty($infos_profile)) ? $this->session->userdata('login') : $infos_profile->login;
$loger = $this->session->userdata('logged_in');
?>

<div id="contentAll">
    <h1 class="hd">Photos et vidéos</h1>
    
   	<div id="breadcrumbs">
        <ul>
            <li><a href="<?php echo site_url('home/' . $uid); ?>">Accueil</a></li>
            <li><a href="<?php echo site_url('actualite/' . $uid_visit); ?>"><?php echo 'Artiste : ' . $login; ?></a></li>
            <li><a href="<?php echo site_url($this->uri->segment(1) . '/' . $uid_visit); ?>">Photos & Vidéos</a></li>
        </ul>
    </div>

    <div id="cover" style="background-image:url(<?php print files('profiles/' . $cover = (empty($infos_profile)) ? $this->session->userdata('cover') : $infos_profile->cover); ?>);">
        <div id="infos-cover">
            <h2><?php print $login = (empty($infos_profile)) ? $this->session->userdata('login') : $infos_profile->login; ?></h2>
            <?php if ($loger == 1 && $infos_profile->id != $session_id && $infos_profile->type == 2 && substr_count($community_follower, $infos_profile->id) == 0): ?>
                <a href="#" class="add-follow" id="<?php echo $infos_profile->id ?>"><span class="button_left"></span><span class="button_center">Suivre</span><span class="button_right"></span></a>
            <?php endif;
            if ($loger == 1 && $infos_profile->id != $session_id && ($infos_profile->type == 2) && (substr_count($community_follower, $infos_profile->id) > 0)):
                ?>
                <a href="#" class="delete-follow" id="<?php echo $infos_profile->id ?>"><span class="button_left_abonne"></span><span class="button_center_abonne">Ne plus suivre</span><span class="button_right_abonne"></span></a>
            <?php endif; ?>
                
            <?php if($loger == 1 && $infos_profile->id != $session_id): ?><a class="contact-user iframe" href="<?php echo site_url('contacter/'.$uid_visit); ?>"><span class="button_left_abonne"></span><span class="button_center_abonne">Contacter</span><span class="button_right_abonne"></span></a><?php endif; ?>
        </div>
    </div>

    <div id="stats-cover">
        <div class="stats_cover_block">
            <span class="stats_number">489</span>
            <span class="stats_title">abonnés</span>
        </div>

        <div class="stats_cover_block">
            <span class="stats_number">18</span>
            <span class="stats_title">albums</span>
        </div>

        <div class="stats_cover_block">
            <span class="stats_number">278</span>
            <span class="stats_title">morceaux</span>
        </div>
    </div>

    <div class="bts_noir_photo">
        <?php if ($infos_profile->id == $uid) { ?>

            <div class="bt_noir">
                <a class="iframe" href="<?php echo site_url('media/ajouter-photo/' . $infos_profile->id) ?>" ><span class="bt_left"></span><span class="bt_middle">Ajouter une photo</span><span class="bt_right"></span></a>
            </div>
            <div class="bt_noir">
                <a class="iframe" href="<?php echo site_url('media/ajouter-video/' . $infos_profile->id) ?>"><span class="bt_left"></span><span class="bt_middle">Ajouter une vidéo</span><span class="bt_right"></span></a>
            </div>
        <?php } ?>
    </div>

    <div class="content">

        <?php
        foreach ($all_media_user_result as $media_user_result_unit):
//var_dump($media_user_result_unit);
            /*  ------------- Bloc image orpheline -------------- */

            if ($media_user_result_unit->type == 1) {
                ?>		
                <div class="box col1">
                    <div class="photo">
						<!--  edition : HOVER *******************-->
                    <?php if ($profile->id == $uid) { ?> 
                        <div class="edit">

                            <!--  edition : SUPPRESSION *******************-->

                            <a class="iframe" href="<?php echo site_url('media/supprimer/' . $infos_profile->id . '/' . $media_user_result_unit->id . '/' . $media_user_result_unit->type) ?>"><img src="<?php echo img_url('musicien/suppr.png'); ?>"/></a>
                            <a class="iframe" href="<?php echo site_url('media/editer/' . $infos_profile->id . '/' . $media_user_result_unit->id . '/' . $media_user_result_unit->type) ?>"><img src="<?php echo img_url('musicien/edite.png'); ?>"/></a>
                        </div>
                    <?php } ?>
                    <!-- image -->
                    <a class="iframe" href="<?php echo site_url('media/zoom/' . $media_user_result_unit->id . '/0') ?>"><img src="<?php echo files($infos_profile->id . '/photos/' . $media_user_result_unit->file_name); ?>" class="img_cover" /></a>
                    <!-- titre -->

                    <p class="nom_photo"><?php echo $media_user_result_unit->nom ?></p>
                    <!-- commentaire -->

                    <?php
                    $cpt_comment = 0;
                    foreach ($commentaires as $commentaire) {
                        if ($media_user_result_unit->id == $commentaire->photos_id) {
                            $cpt_comment++;
                        }
                    }
                    ?>
					</div>

                    <div class="bord_photo">
                        <a href="javascript:void(0);">
                            <p><?php if ($cpt_comment == 0) print "0 commentaire"; if ($cpt_comment == 1) print "1 commentaire"; if ($cpt_comment > 1) print $cpt_comment . "commentaires" ?></p></a>
                        <?php
                        $count = substr_count($all_photo_like, $media_user_result_unit->id . '/');
                        if ($count >= 1) {
                            ?>
                            <img src="<?php echo img_url('musicien/pink_heart.png'); ?>" id="<?php echo $media_user_result_unit->id ?>" class="nolike" />

                        <?php
                        } else {
                            ?>
                            <img src="<?php echo img_url('musicien/icon_coeur.png'); ?>" id="<?php echo $media_user_result_unit->id ?>" class="like" />

        <?php } ?>
                        <p class="nb_like" ><?php echo $media_user_result_unit->like_total ?></p>
                    </div> 
                    <div class="allcomment" id="comm<?php echo $media_user_result_unit->id ?>">

                        <?php foreach ($commentaires as $commentaire): ?>
                                <?php if ($media_user_result_unit->id == $commentaire->photos_id): ?>  
                                <div class="comm">
                                    <?php if ($infos_profile->id == $uid) { ?>
                                        <img id="<?php echo $commentaire->comm_id ?>" src="<?php echo img_url('common/del.png'); ?>" class="del"/>
                <?php } ?>   <img src="<?php echo base_url('/files/profiles/' . $commentaire->thumb); ?>"  />

                                    <p class="name_comm"> <?php echo $commentaire->login ?></p>
                                    <p class="commentaire"><?php echo $commentaire->comment ?></p> 
                                </div>

                            <?php endif; ?>
        <?php endforeach; ?>
                        <div class="comment-form">
                            <img src="<?php echo base_url('/files/profiles/' . $this->session->userdata('thumb')) ?>" />
                            <form  action="" method="post">
                                <input type="text" name="usercomment" id="usercomment"/>
                                <input type="hidden" name="baseurl" value="<?php echo base_url(); ?>" id="baseurl" />
                                <input type="hidden" name="messageid" value="<?php echo $media_user_result_unit->id; ?>" id="messageid" />

                                <input src= "<?php echo img_url('common/valider_comm.png'); ?>" type="submit" value="Valider"/>
                            </form>

                            <div class="ajax_loader"></div>

                        </div>
                    </div>
                </div> 

                <?php
            }

            // album
            else if ($media_user_result_unit->type == 2) {
                ?>
                <!--<div class="cnt_box">-->
                <div class="box col1">
					<div class="photo">
						<!--  edition : HOVER *******************-->
                    <?php
                    if ($profile->id == $uid) {
                        ?> 
                        <div class="edit">

                            <a class="iframe" href="<?php echo site_url('media/supprimer/' . $infos_profile->id . '/' . $media_user_result_unit->file_name . '/' . $media_user_result_unit->type) ?>"><img src="<?php echo img_url('musicien/suppr.png'); ?>"/></a>
                            <a class="iframe" href="<?php echo site_url('media/editer/' . $infos_profile->id . '/' . $media_user_result_unit->file_name . '/' . $media_user_result_unit->type) ?>"><img src="<?php echo img_url('musicien/edite.png'); ?>"/></a>
                        </div>
                        <div class="open_alb">
                            <a href="<?php echo site_url('album/' . $infos_profile->id . '/' . $media_user_result_unit->file_name) ?>"><img src="<?php echo img_url('musicien/open_plus.png'); ?>"/></a>
                        </div>


                    <?php
                    } else {
                        ?>
                        <div class="edit" style="background:rgba(255, 255, 255, 0.5);">  <!-- METTRE CE STYLE DANS LE JS -->
                        </div>
                        <div class="open_alb">
                            <a href="<?php echo site_url('album/' . $infos_profile->id . '/' . $media_user_result_unit->file_name) ?>"><img src="<?php echo img_url('musicien/open_plus.png'); ?>"/></a>
                        </div>
                        <?php }
                    ?> 
                    <?php
                    $a = 0;
                    foreach ($all_photos as $al_photo):
                        if ($media_user_result_unit->file_name == $al_photo->file_name):
                            foreach ($all_photos_albums as $all_photos_album):
                                if (($al_photo->Photos_id == $all_photos_album->photo_id) || ($al_photo->Videos_id == $all_photos_album->video_id)):
                                    $a++;
                                    if ($a == 1):
                                        if ($all_photos_album->video_path == 'null') {
                                            ?>
                                            <a href="<?php echo site_url('media/album/' . $infos_profile->id . '/' . $media_user_result_unit->file_name); ?>"><img src="<?php echo files($infos_profile->id . '/photos/' . $media_user_result_unit->file_name . '/' . $all_photos_album->file_name); ?>" class="img_cover" /></a>
                                            <?php
                                        } else {
                                            ?>
                                            <a href="http://www.youtube.com/v/<?php echo $all_photos_album->video_path ?>?version=3"><img src="http://i.ytimg.com/vi/<?php echo $all_photos_album->video_path ?>/hqdefault.jpg" class="img_cover" /></a>
                                            <?php
                                        }
                                    endif;

                                    if ($a > 1):

                                        if ($all_photos_album->video_path == 'null') {
                                            ?>
                                            <a href="#"><img src="<?php echo files($infos_profile->id . '/photos/' . $media_user_result_unit->file_name . '/' . $all_photos_album->file_name); ?>" class="img_miniat" /></a>
                                            <?php
                                        } else {
                                            ?>
                                            <a href="#"><img src="http://i.ytimg.com/vi/<?php echo $all_photos_album->video_path ?>/hqdefault.jpg"  class="img_miniat" /></a>

                                <?php
                            }
                        endif;
                    endif;
                endforeach;
                if ($a == 4)
                    break;
            endif;
        endforeach;
        for ($i = $a; $i < 4; $i++) {
            ?>
                        <a href="#" class="empty_photo_alb" ><img src="<?php echo img_url('common/empty_photo_alb.png'); ?>" /></a>
                        <?php
                    }
                    ?>
                    <p class="nom_photo"><?php echo $media_user_result_unit->nom ?></p>
                    <?php
                    $cpt_comment = 0;
                    foreach ($commentaires_albums as $commentaire) {
                        if ($media_user_result_unit->file_name == $commentaire->file_name) {
                            $cpt_comment++;
                        }
                    }
                    ?>
					</div>
                    
                    <div class="bord_photo">
                        <a href="javascript:void(0);"><p><?php if ($cpt_comment == 0) echo "0 commentaire"; if ($cpt_comment == 1) echo "1 commentaire"; if ($cpt_comment > 1) echo $cpt_comment . "commentaires"; ?></p></a>
        <?php
        $count = substr_count($all_album_like, $media_user_result_unit->file_name . '/');
        if ($count >= 1) {
            ?>
                            <img src="<?php echo img_url('musicien/pink_heart.png'); ?>" id="<?php echo $media_user_result_unit->file_name ?>" class="nolike-album" />
                            <?php
                        } else {
                            ?>
                            <img src="<?php echo img_url('musicien/icon_coeur.png'); ?>" class="like-album" id="<?php echo $media_user_result_unit->file_name ?>" />
                            <?php
                        }
                        ?>
                        <p class="nb_like"><?php echo $media_user_result_unit->like_total ?></p>
                    </div>

                    <!-- </div>-->
                    <div class="allcomment" id="comm<?php echo $media_user_result_unit->file_name ?>">

        <?php
        foreach ($commentaires_albums as $commentaire):
            if ($media_user_result_unit->file_name == $commentaire->file_name):
                ?>  
                                <div class="comm">
                                <?php if ($infos_profile->id == $uid) { ?>

                                        <img id="<?php echo $commentaire->comm_id ?>"  src="<?php echo img_url('common/del.png'); ?>" class="del"/>
                                        <?php }
                                    ?> 
                                    <img src="<?php echo base_url('/files/profiles/' . $commentaire->thumb); ?>" />
                                    <p class="name_comm"><?php echo $commentaire->login ?></p>
                                    <p class="commentaire"><?php echo $commentaire->comment ?></p> 
                                </div>
                                    <?php endif;
                                ?>

            <?php endforeach; ?>
                        <div class="comment-form-album">
                            <img src="<?php echo base_url('/files/profiles/' . $this->session->userdata('thumb')) ?>" />
                            <form  action="" method="post">
                                <input type="text" name="usercomment" id="usercomment"/>
                                <input type="hidden" name="baseurl" value="<?php echo base_url(); ?>" id="baseurl" />
                                <input type="hidden" name="messageid" value="<?php echo $media_user_result_unit->file_name; ?>" id="messageid" />

                                <input src= "<?php echo img_url('common/valider_comm.png'); ?>" type="submit" value="Valider"/>
                            </form>

                            <div class="ajax_loader"></div>
                        </div>
                    </div>
                </div>

        <?php
    } else if ($media_user_result_unit->type == 3) {
        ?>
                <div class="box col1">
				<div class="photo">
                    <!--  edition : HOVER *******************-->
                <?php
                if ($profile->id == $uid) {
                    ?> 
                        <div class="edit">
                            <a class="iframe" href="<?php echo base_url('/index.php/media/editer/' . $infos_profile->id . '/' . $media_user_result_unit->id . '/' . $media_user_result_unit->type) ?>"><img src="<?php echo img_url('musicien/edite.png'); ?>"/></a>
                            <!--  edition : SUPPRESSION *******************-->
                            <a class="iframe" href="<?php echo base_url('/index.php/media/supprimer/' . $infos_profile->id . '/' . $media_user_result_unit->id . '/' . $media_user_result_unit->type) ?>"><img src="<?php echo img_url('musicien/suppr.png'); ?>"/></a>
                        </div>
                        <?php
                    }
                    ?>


                    <a href="http://www.youtube.com/v/<?php echo $media_user_result_unit->file_name ?>?version=3"><img src="http://i.ytimg.com/vi/<?php echo $media_user_result_unit->file_name ?>/hqdefault.jpg" class="img_cover" /></a>
                    <p class="nom_photo"><?php echo $media_user_result_unit->nom ?></p>

                    <?php
                    $cpt_comment = 0;
                    foreach ($commentaires_video as $commentaire) {
                        if ($media_user_result_unit->id == $commentaire->video_id) {
                            $cpt_comment++;
                        }
                    }
                    ?>
				</div>
                    <div class="bord_photo">
                        <a href="javascript:void(0);"><p><?php if ($cpt_comment == 0) print "0 commentaire"; if ($cpt_comment == 1) print "1 commentaire"; if ($cpt_comment > 1) print $cpt_comment . "commentaires"; ?></p>
                        </a>
                    <?php
                    $count = substr_count($all_video_like, $media_user_result_unit->id . '/');
                    if ($count >= 1) {
                        ?>
                            <img src="<?php echo img_url('musicien/pink_heart.png'); ?>" id="<?php echo $media_user_result_unit->id ?>" class="nolike-video" />
                        <?php
                    } else {
                        ?>
                            <img src="<?php echo img_url('musicien/icon_coeur.png'); ?>" class="like-video" id="<?php echo $media_user_result_unit->id ?>" />
            <?php }
        ?>
                        <p class="nb_like"><?php echo $media_user_result_unit->like_total ?></p>
                    </div>

                    <div class="allcomment" id="comm<?php echo $media_user_result_unit->file_name ?>">

                        <?php
                        foreach ($commentaires_video as $commentaire):
                            if ($media_user_result_unit->id == $commentaire->video_id):
                                ?>  
                                <div class="comm">                                 
                                <?php
                                if ($infos_profile->id == $uid) {
                                    ?>
                                        <img id="<?php echo $commentaire->comm_id ?>" src="<?php echo img_url('common/del.png'); ?>" class="del"/>
                    <?php }
                ?>  
                                    <img src="<?php echo base_url('/files/profiles/' . $commentaire->thumb); ?>" />
                                    <p class="name_comm"> <?php echo $commentaire->login ?></p>
                                    <p class="commentaire"><?php echo $commentaire->comment ?></p> 
                                </div>
                                    <?php
                                endif;
                            endforeach;
                            ?>
                        <div class="comment-form-video">
                            <img src="<?php echo base_url('/files/profiles/' . $this->session->userdata('thumb')) ?>" />
                            <form  action="" method="post">
                                <input type="text" name="usercomment" id="usercomment"/>
                                <input type="hidden" name="baseurl" value="<?php echo base_url(); ?>" id="baseurl" />
                                <input type="hidden" name="messageid" value="<?php print $media_user_result_unit->id; ?>" id="messageid" />

                                <input src= "<?php echo img_url('common/valider_comm.png'); ?>" type="submit" value="Valider"/>
                            </form>

                            <div class="ajax_loader"></div>
                        </div>
                    </div>	
                </div>
        <?php
    }
    // album wall
    else if ($media_user_result_unit->type == 4) {
        ?>    
                <div class="box col1">
				<div class="photo">
                    <!--  edition : HOVER *******************-->
        <?php { ?> <!--
                          <div class="edit">
                      
                              <a class="iframe" href="<?php echo site_url('media/supprimer/' . $infos_profile->id . '/' . $media_user_result_unit->file_name . '/' . $media_user_result_unit->type) ?>"><img src="<?php echo img_url('musicien/suppr.png'); ?>"/></a>
                  <a class="iframe" href="<?php echo base_url('/index.php/media/editer/' . $infos_profile->id . '/' . $media_user_result_unit->file_name . '/' . $media_user_result_unit->type) ?>"><img src="<?php echo img_url('musicien/edite.png'); ?>"/></a>
                            </div>
                          <div class="open_alb">
                                  <a href="<?php echo site_url('album/' . $infos_profile->id . '/' . $media_user_result_unit->file_name) ?>"><img src="<?php echo img_url('musicien/open_plus.png'); ?>"/></a>
                        </div>
                        -->


                        <div class="edit" style="background:rgba(255, 255, 255, 0.5);">  <!-- METTRE CE STYLE DANS LE JS -->
                        </div>
                        <div class="open_alb">
                            <a href="<?php echo site_url('album/' . $infos_profile->id . '/wall') ?>"><img src="<?php echo img_url('musicien/open_plus.png'); ?>"/></a>
                        </div>
            <?php }
        ?> 
        <?php
        $a = 0;
        foreach ($wall_photos as $wall_photo):
            $a++;
            if ($a == 1):
                ?>
                            <a href="#"><img src="<?php echo files($infos_profile->id . '/wall/' . $wall_photo->photo); ?>" class="img_cover" /></a>
                <?php
            endif;

            if ($a > 1):
                ?>
                            <a href="#"><img src="<?php echo files($infos_profile->id . '/wall/' . $wall_photo->photo); ?>" class="img_miniat" /></a>
                            <?php
                        endif;


                        if ($a == 4)
                            break;
                    endforeach;
                    ?>
                    <p class="nom_photo">Wall album</p>
                    <?php
                    $cpt_comment = count($comments_wall);
                    ?>
				</div>
                    <div class="bord_photo">
                        <a href="javascript:void(0);"><p><?php if ($cpt_comment == 0) echo "0 commentaire"; if ($cpt_comment == 1) echo "1 commentaire"; if ($cpt_comment > 1) echo $cpt_comment . " commentaires"; ?></p></a>

                    </div>

                    <!-- </div>-->
                    <div class="allcomment" id="comm<?php echo $media_user_result_unit->file_name ?>">

                    <?php
                    foreach ($comments_wall as $comment_wall):
                        //	if ($media_user_result_unit->file_name == $commentaire->file_name):
                        ?>  
                            <div class="comm">
                        <?php if ($infos_profile->id == $uid) { ?>

                                    <img id="<?php echo $comment_wall->comm_id ?>"  src="<?php echo img_url('common/del.png'); ?>" class="del"/>
                <?php }
            ?> 
                                <img src="<?php echo base_url('/files/profiles/' . $comment_wall->thumb); ?>" />
                                <p class="name_comm"><?php echo $comment_wall->login ?></p>
                                <p class="commentaire"><?php echo $comment_wall->comment ?></p> 
                            </div>
                            <?php
                            //endif; 
                            ?>

                            <?php endforeach; ?>
                        <div class="comment-form-alb-wall">
                            <img src="<?php echo base_url('/files/profiles/' . $this->session->userdata('thumb')) ?>" />
                            <form  action="" method="post">
                                <input type="text" name="usercomment" id="usercomment"/>
                                <input type="hidden" name="baseurl" value="<?php echo base_url(); ?>" id="baseurl" />
                                <input type="hidden" name="messageid" value="<?php echo $wall_photo->id; ?>" id="messageid" />

                                <input src= "<?php echo img_url('common/valider_comm.png'); ?>" type="submit" value="Valider"/>
                            </form>

                            <div class="ajax_loader"></div>
                        </div>
                    </div>
                </div>

                        <?php
                    }


                endforeach;
                ?>
    </div>

<?php if (isset($sidebar_right)) echo $sidebar_right; ?>

</div>
