<h1 id="title-subscription">Créez votre compte et explorez Slyset</h1>

<div class="step-form">
  <div class="step-head">
    <h2>Étape 1/3</h2>
    <div id="state-step">
      <span class="current first"></span>
      <span class="disable"></span>
      <span class="disable last"></span>
    </div>
  </div>

  <?php
    echo form_open('user/register_step_1');
  ?>

  <?php if(!$fb_data['me']): ?>
    <p class="sub-text-reseaux">Inscrivez-vous avec votre compte Facebook</p>

      <div id="fb-subscription">
            <!--Please login with your FB account: --><a href="<?php echo $fb_data['loginUrl']; ?>"><img id="fb-connect" src="<?php echo img_url('subscription/fb_connect.png') ?>" alt="FB Connect" /></a>
            <!-- Or you can use XFBML -->
            <div class="fb-login-button" data-show-faces="false" data-width="100" data-max-rows="1" data-scope="email,user_birthday,publish_stream,user_location"></div>
      </div>
    <hr>
  <?php endif; ?>
    
  <p class="sub-text-mail">Ou inscrivez-vous en utilisant votre adresse e-mail</p>

  <?php
    echo form_input('mail',set_value('mail'),'placeholder="E-Mail"');
    echo '<div class="ico-placeholder email"></div>';
    echo form_error('mail', '<span class="error-form">', '</span>');

    echo form_submit('submit','Créer un compte');
  ?>

  <p class="sub-text-inscrit">Vous avez déjà un compte ? <a href="#">Connectez-vous</a></p>

  <?php
    echo form_close();
  ?>
</div>