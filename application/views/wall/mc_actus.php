<?php
    $session_id = $this->session->userdata('uid');
    $uid = (empty($session_id)) ? '' : $session_id;
    $uid_visit = $this->uri->segment(2);
    $login = (empty($infos_profile)) ? $this->session->userdata('login') : $infos_profile->login;
    $loger = $this->session->userdata('logged_in');
?>

<div id="contentAll">
    <h1 class="hd">Vos actualités musicales</h1>
    
    <div id="breadcrumbs">
        <ul>
            <li><a href="<?php echo site_url('home/' . $uid); ?>">Accueil</a></li>
            <li><a href="<?php echo site_url('actualite/' . $uid_visit); ?>"><?php echo 'Artiste : '.$login; ?></a></li>
            <li><a href="<?php echo site_url($this->uri->segment(1) . '/' . $uid_visit); ?>">Fil d'actualité</a></li>
        </ul>
    </div>

    <div id="cover" style="background-image:url(<?php echo files('profiles/' . $cover = (empty($infos_profile)) ? $this->session->userdata('cover') : $infos_profile->cover); ?>);">
        <div id="infos-cover">
            <h2><?php echo $login; ?></h2>

     	<?php 
     		if($loger==1&&$infos_profile->id != $session_id&&$infos_profile->type==2&&substr_count($community_follower,$infos_profile->id)==0): ?>
      			<a href="#" class="add-follow" id="<?php echo $this->uri->segment(2)?>"><span class="button_left"></span><span class="button_center">Suivre</span><span class="button_right"></span></a>
   			<?php endif;
     		if($loger==1&&$infos_profile->id != $session_id&&($infos_profile->type==2)&&(substr_count($community_follower,$infos_profile->id)>0)): ?>
     			<a href="#" class="delete-follow" id="<?php echo $this->uri->segment(2)?>"><span class="button_left_abonne"></span><span class="button_center_abonne">Ne plus suivre</span><span class="button_right_abonne"></span></a>
    		<?php endif;?>
                
            <?php if($loger == 1 && $infos_profile->id != $session_id): ?><a class="contact-user iframe" href="<?php echo site_url('contacter/'.$uid_visit); ?>"><span class="button_left_abonne"></span><span class="button_center_abonne">Contacter</span><span class="button_right_abonne"></span></a><?php endif; ?>
    	  </div>
    </div>

  <div id="stats-cover">
        <div class="stats_cover_block">
            <span class="stats_number">
                <?php
                $nab = 0;
                if(empty($all_follower)!=1):
                    $nab =  count($all_follower);
                endif;
                echo $nab;
                 ?>
            </span>       
            <span class="stats_title">
                <?php
                if($nab == 0 || $nab == 1){
                    echo 'abonné';
                }
                else
                {
                    echo 'abonnés';
                }
                ?>
            </span>
        </div>
        
        <div class="stats_cover_block">
            <span class="stats_number"><?php print $album_nbr[0]->n_alb;?></span>
            <span class="stats_title">
                <?php
                if($album_nbr[0]->n_alb == 0 || $album_nbr[0]->n_alb == 1){
                    echo 'album';
                }
                else
                {
                    echo 'albums';
                }
                ?>
            
            </span>
        </div>

        <div class="stats_cover_block">
             <span class="stats_number">
                <?php
                $nm = 0;
                if(empty($all_morceau_artiste)!=1):
                    $nm =  count($all_morceau_artiste);
                endif;
                echo $nm;
                 ?>
            </span>       
            <span class="stats_title">
                <?php
                if($nm == 0 || $nm == 1){
                    echo 'morceau';
                }
                else
                {
                    echo 'morceaux';
                }
                ?>
            </span>
        </div>
  </div>

  <div class="content">
    <div class="actus_post">
      <div class="actus_post_links">
        <a href="#comments-msg" class="active">Message</a>
        <a href="#comments-photo">Photo</a>
        <a href="#comments-link-video">Vidéo</a>
      </div>
      <?php
        $form_comments_1 = array("id" => "comments-msg", "style" => "display:block;");
        echo form_open('mc_actus/form_wall_musicien_message/'.$uid_form = (empty($infos_profile)) ? $session_id : $infos_profile->id, $form_comments_1);
        
          $textarea = array("name" => "comment1", "placeholder" => "Exprimez-vous");
          echo form_textarea($textarea);
          echo form_error('comment1', '<span class="error-form">', '</span>');
          
          echo form_submit('submit','Valider');
        echo form_close();
        
        
        $form_comments_2 = array("id" => "comments-photo", "style" => "display:none;");
        echo form_open_multipart('mc_actus/form_wall_musicien_photo/'.$uid_form2 = (empty($infos_profile)) ? $session_id : $infos_profile->id, $form_comments_2);
          $textarea = array("name" => "comment2","placeholder" => "Votre description ici ...");
          echo form_textarea($textarea);
          echo form_error('comment2', '<span class="error-form">', '</span>');
      ?>
          <div class="upload-file-container container-photo">
            <input type="file" name="photo" size="200" id="upload-photo-comments" />
          </div>
          <span class="upload_photo_name_file"></span>
      <?php
          echo form_submit('submit','Valider');
        echo form_close();
        
        
        $form_comments_3 = array("id" => "comments-link-video", "style" => "display:none;");
        echo form_open('mc_actus/form_wall_musicien_link/'.$uid_form3 = (empty($infos_profile)) ? $session_id : $infos_profile->id, $form_comments_3);
        
          $textarea = array("name" => "comment3","placeholder" => "Votre description ici ...");
          echo form_textarea($textarea);
          echo form_error('comment3', '<span class="error-form">', '</span>');
          
          echo form_input('linkurl',set_value('linkurl'),'placeholder="L’URL de votre lien youtube, ex : http://www.youtube.com/watch?v=9I9Ar6upx34"');
          echo form_error('linkurl', '<span class="error-form">', '</span>');
          
          echo form_submit('submit','Valider');
        echo form_close();
      ?>
    </div>
    
    <div class="empty"></div>
    
    <?php foreach($messages as $message): ?>
        <?php if(empty($message->photo) && empty($message->video)): ?>
            <div class="artist_post simple_message">
                <div class="top">
                    <?php if($uid_visit == $uid): ?>
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
                                    <?php if($uid_visit == $uid || $commentaire->utilisateuridB == $uid): ?>
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
                    <?php if($uid_visit == $uid): ?>
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
                                    <?php if($uid_visit == $uid || $commentaire->utilisateuridB == $uid): ?>
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
                    <?php if($uid_visit == $uid): ?>
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
                        $url_preg = preg_replace('#https?://www.youtube.com/watch\?v=(.+)+#i', '$1', $url);
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
                                    <?php if($uid_visit == $uid || $commentaire->utilisateuridB == $uid): ?>
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
  </div>

  <?php if(isset($sidebar_right)) echo $sidebar_right; ?>
  
</div>