<?php
    $session_id = $this->session->userdata('uid');
    $uid_visit  = $this->uri->segment(3);
    $loger = $this->session->userdata('logged_in'); 
    
//    print_r($this->session->userdata);
?>

<?php foreach($messages as $message): ?>
    <?php if(empty($message->photo) && empty($message->video)): ?>
        <div class="artist_post simple_message">
            <div class="top">
                <?php if($uid_visit == $session_id): ?>
                    <a href="<?php echo site_url('mc_actus/delete/'.$message->id); ?>" class="post_delete"><img src="<?php echo img_url('musicien/btn_suppr.png'); ?>" alt="Suppression" /></a>
                <?php endif; ?>
            </div>
            <div class="left">
                <a href="<?php echo site_url('home/'.$message->idU); ?>"><img src="<?php echo files('profiles/'.$message->thumbU); ?>" alt="Photo Profil" /></a>
            </div>
            <div class="right">
                <span class="ico_citation"></span>
                <p class="msg_post"><?php echo $message->markup_message; ?></p>
            </div>
            <div class="bottom">
                <span class="infos_publi"><?php echo $message->loginU; ?> - Le <?php echo date('d-m-Y', strtotime(str_replace('-', '/', $message->created)))?> à <?php echo date('H:i', strtotime(str_replace('-', '/', $message->created)))?></span>

                <?php 
                    $cpt_comment = 0;
                    foreach($commentaires as $commentaire){
                        if($message->id == $commentaire->wallidB){
                            $cpt_comment++;
                        }
                    }
                ?>

                <span class="infos_coms"><?php echo count_comments($cpt_comment); ?></span>
            </div>

            <?php foreach($commentaires as $commentaire): ?>
                <?php if($message->id == $commentaire->wallidB): ?>
                    <div class="comments">
                        <div class="com_left">
                          <a href="<?php echo site_url('home/'.$commentaire->idU); ?>"><img src="<?php echo files('profiles/'.$commentaire->thumbU); ?>" alt="Photo Profil" /></a>
                        </div>
                        <div class="com_right">
                            <div class="com_top">
                                <?php if($uid_visit == $session_id || $commentaire->utilisateuridB == $session_id): ?>
                                    <a href="<?php echo site_url('mc_actus/delete_comment/'.$uid_visit.'/'.$commentaire->idB); ?>"><img src="<?php echo img_url('musicien/btn_suppr.png'); ?>" alt="Suppression" /></a>
                                <?php endif; ?>
                            </div>
                            <div class="com_bottom">
                                <span class="com_publi_infos"><?php echo $commentaire->loginU; ?><small> - <?php echo my_time($commentaire->createdB); ?></small></span>
                                <span class="com_publi_msg"><?php echo $commentaire->commentB; ?></span>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>

            <?php if(isset($loger) && $loger == 1): ?>
                <div class="form_comments">
                    <form action="" method="post">
                        <input type="text" name="usercomment" id="usercomment" placeholder="Ajoutez votre commentaire..." />
                        <input type="hidden" name="baseurl" value="<?php echo base_url(); ?>" id="baseurl" />
                        <input type="hidden" name="messageid" value="<?php echo $message->id; ?>" id="messageid" />

                        <input type="submit" value="Envoyer" />
                    </form>
                    <div class="ajax_loader"></div>
                </div>
            <?php endif; ?>
        </div>
    <?php elseif(!empty($message->photo) && empty($message->video)): ?>
        <div class="artist_post photo_message">
            <div class="top">
                <?php if($uid_visit == $session_id): ?>
                    <a href="<?php echo site_url('mc_actus/delete/'.$message->id); ?>" class="post_delete"><img src="<?php echo img_url('musicien/btn_suppr.png'); ?>" alt="Suppression" /></a>
                <?php endif; ?>
            </div>
            <div class="left">
                <a href="<?php echo site_url('home/'.$message->idU); ?>"><img src="<?php echo files('profiles/'.$message->thumbU); ?>" alt="Photo Profil" /></a>
            </div>
            <div class="right">
                <span class="ico_citation"></span>
                <p class="msg_post"><?php echo $message->markup_message; ?></p>
                <div class="singleWrapper">
                    <img src="<?php echo files($uid_visit.'/wall/'.$message->photo); ?>" alt="Photo message" class="single" />
                </div>
            </div>
            <div class="bottom">
                <span class="infos_publi"><?php echo $message->loginU; ?> - Le <?php echo date('d-m-Y', strtotime(str_replace('-', '/', $message->created)))?> à <?php echo date('H:i', strtotime(str_replace('-', '/', $message->created)))?></span>

                <?php 
                    $cpt_comment = 0;
                    foreach($commentaires as $commentaire){
                        if($message->id == $commentaire->wallidB){
                            $cpt_comment++;
                        }
                    }
                ?>

                <span class="infos_coms"><?php echo count_comments($cpt_comment); ?></span>
            </div>

            <?php foreach($commentaires as $commentaire): ?>
                <?php if($message->id == $commentaire->wallidB): ?>
                    <div class="comments">
                        <div class="com_left">
                            <a href="<?php echo site_url('home/'.$commentaire->idU); ?>"><img src="<?php echo files('profiles/'.$commentaire->thumbU); ?>" alt="Photo Profil" /></a>
                        </div>
                        <div class="com_right">
                            <div class="com_top">
                                <?php if($uid_visit == $session_id || $commentaire->utilisateuridB == $session_id): ?>
                                    <a href="<?php echo site_url('mc_actus/delete_comment/'.$uid_visit.'/'.$commentaire->idB); ?>"><img src="<?php echo img_url('musicien/btn_suppr.png'); ?>" alt="Suppression" /></a>
                                <?php endif; ?>
                            </div>
                            <div class="com_bottom">
                                <span class="com_publi_infos"><?php echo $commentaire->loginU; ?><small> - <?php echo my_time($commentaire->createdB); ?></small></span>
                                <span class="com_publi_msg"><?php echo $commentaire->commentB; ?></span>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>

            <?php if(isset($loger) && $loger == 1): ?>
                <div class="form_comments">
                    <form action="" method="post">
                        <input type="text" name="usercomment" id="usercomment" placeholder="Ajouter votre commentaire..." />
                        <input type="hidden" name="baseurl" value="<?php echo base_url(); ?>" id="baseurl" />
                        <input type="hidden" name="messageid" value="<?php echo $message->id; ?>" id="messageid" />

                        <input type="submit" value="Envoyer" />
                    </form>
                    <div class="ajax_loader"></div>
                </div>
            <?php endif; ?>
        </div>
    <?php elseif(empty($message->photo) && !empty($message->video)): ?>
        <div class="artist_post video_message">
            <div class="top">
                <?php if($uid_visit == $session_id): ?>
                    <a href="<?php echo site_url('mc_actus/delete/'.$message->id); ?>" class="post_delete"><img src="<?php echo img_url('musicien/btn_suppr.png'); ?>" alt="Suppression" /></a>
                <?php endif; ?>
            </div>
            <div class="left">
                <a href="<?php echo site_url('home/'.$message->idU); ?>"><img src="<?php echo files('profiles/'.$message->thumbU); ?>" alt="Photo Profil" /></a>
            </div>
            <div class="right">
                <span class="ico_citation"></span>
                <p class="msg_post"><?php echo $message->markup_message; ?></p>

                <?php 
                    $url = $message->video;
                    $url_preg = preg_replace('#http://www.youtube.com/watch\?v=(.+)+#i', '$1', $url);
                ?>

                <iframe width="455" height="300" src="http://www.youtube.com/embed/<?php echo $url_preg; ?>" frameborder="0" allowfullscreen></iframe>
            </div>
            <div class="bottom">
                <span class="infos_publi"><?php echo $message->loginU; ?> - Le <?php echo date('d-m-Y', strtotime(str_replace('-', '/', $message->created)))?> à <?php echo date('H:i', strtotime(str_replace('-', '/', $message->created)))?></span>

                <?php 
                    $cpt_comment = 0;
                    foreach($commentaires as $commentaire){
                        if($message->id == $commentaire->wallidB){
                            $cpt_comment++;
                        }
                    }
                ?>

                <span class="infos_coms"><?php echo count_comments($cpt_comment); ?></span>
            </div>

            <?php foreach($commentaires as $commentaire): ?>
                <?php if($message->id == $commentaire->wallidB): ?>
                    <div class="comments">
                        <div class="com_left">
                            <a href="<?php echo site_url('home/'.$commentaire->idU); ?>"><img src="<?php echo files('profiles/'.$commentaire->thumbU); ?>" alt="Photo Profil" /></a>
                        </div>
                        <div class="com_right">
                            <div class="com_top">
                                <?php if($uid_visit == $session_id || $commentaire->utilisateuridB == $session_id): ?>
                                    <a href="<?php echo site_url('mc_actus/delete_comment/'.$uid_visit.'/'.$commentaire->idB); ?>"><img src="<?php echo img_url('musicien/btn_suppr.png'); ?>" alt="Suppression" /></a>
                                <?php endif; ?>
                            </div>
                            <div class="com_bottom">
                                <span class="com_publi_infos"><?php echo $commentaire->loginU; ?><small> - <?php echo my_time($commentaire->createdB); ?></small></span>
                                <span class="com_publi_msg"><?php echo $commentaire->commentB; ?></span>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>

            <?php if(isset($loger) && $loger == 1): ?>
                <div class="form_comments">
                    <form action="" method="post">
                        <input type="text" name="usercomment" id="usercomment" placeholder="Ajouter votre commentaire..." />
                        <input type="hidden" name="baseurl" value="<?php echo base_url(); ?>" id="baseurl" />
                        <input type="hidden" name="messageid" value="<?php echo $message->id; ?>" id="messageid" />

                        <input type="submit" value="Envoyer" />
                    </form>
                    <div class="ajax_loader"></div>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
<?php endforeach; ?>

<div class="ajax_loader2"></div>