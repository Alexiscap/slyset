<aside id="right">
  <div id="avatar">
    <div id="photo">
      <img src="<?php if(!empty($profile->thumb)) print files('profiles/'.$profile->thumb); else print img_url('sidebar-right/photo-profil.png'); ?>" alt="Photo de profil"/>
    </div>
    <div id="description">
      <p id="texte_description"><?php if(!empty($profile->description)) print ucfirst($profile->description); else print 'Aucune description n\'a été remplie pour le moment.'; ?></p>
      <p id="style"><?php if(!empty($profile->style_ecoute)) print ucfirst($profile->style_joue); ?></p>
      <p id="instruments"><?php if(!empty($profile->instrument)) print ucfirst($profile->instrument); ?></p>
    </div>
  </div>
  <div id="top_titre">
    <img src="<?php echo img_url('sidebar-right/etoile.png'); ?>" alt="etoile"/><p class="head-title">Top <span>Titres</span></p>
    <div id="classement">
      <div id="num_impair">
        <p class="position">1</p><a href="#" class="play"><img src="<?php echo img_url('sidebar-right/lecture.png'); ?>" alt="lecture"/></a><p>Blowin' in the wild</p>
      </div>
      <div id="num_pair">
        <p class="position">2</p><a href="#" class="play"><img src="<?php echo img_url('sidebar-right/lecture.png'); ?>" alt="lecture"/></a><p>Hurricane</p>
      </div>
      <div id="num_impair">
        <p class="position">3</p><a href="#" class="play"><img src="<?php echo img_url('sidebar-right/lecture.png'); ?>" alt="lecture"/></a><p>Blowin' in the wild</p>
      </div>
      <div id="num_pair">
        <p class="position">4</p><a href="#" class="play"><img src="<?php echo img_url('sidebar-right/lecture.png'); ?>" alt="lecture"/></a><p>Hurricane</p>
      </div>
      <div id="num_impair">
        <p class="position">5</p><a href="#" class="play"><img src="<?php echo img_url('sidebar-right/lecture.png'); ?>" alt="lecture"/></a><p>Blowin' in the wild</p>
      </div>
      <a href="#">> Voir toute la musique</a>
    </div>
  </div>
  <div id="last_photo">
    <img src="<?php echo img_url('sidebar-right/polaroides.png'); ?>" alt="polaroides"/><p class="head-title">Derni&egrave;res <span>photos</span></p>
    <div id="encart_photos">
      <div id="miniatures">
        <img src="<?php echo img_url('sidebar-right/photo1.png'); ?>" alt="photo1"/>
        <img src="<?php echo img_url('sidebar-right/photo2.png'); ?>" alt="photo2"/>
        <img src="<?php echo img_url('sidebar-right/photo3.png'); ?>" alt="photo3"/>
      </div>
      <div id="thelast">
        <img src="<?php echo img_url('sidebar-right/photo4.png'); ?>" alt="photo4"/>
      </div>
      <a href="#">> Voir toutes les photos</a>
    </div>
  </div>
    <div id="reseaux_ailleur">
        <?php if(!empty($profile->twitter) || !empty($profile->facebook) || !empty($profile->googleplus) || !empty($profile->siteweb)): ?>
            <p class="head-title">Ailleurs <span>sur la toile</span></p>
            
            <?php if(!empty($profile->twitter)): ?>
                <a href="<?php print $profile->twitter; ?>" class="twitter"><span>Twitter</span></a>
            <?php endif; ?>

            <?php if(!empty($profile->facebook)): ?>
                <a href="<?php print $profile->facebook; ?>" class="fb"><span>Facebook</span></a>
            <?php endif; ?>

            <?php if(!empty($profile->googleplus)): ?>
                <a href="<?php print $profile->googleplus; ?>" class="google"><span>Google+</span></a>
            <?php endif; ?>

            <?php if(!empty($profile->siteweb)): ?>
                <a href="<?php print $profile->siteweb; ?>" class="site"><span>Site</span></a>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</aside>