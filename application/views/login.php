<h1 id="title-identification">Identifiez-vous</h1>

<div class="step-form">

  <?php
    echo $this->session->flashdata('validation');
    echo form_open('login/login_all');
  ?>

  <?php //if(!$fb_data['me']): ?>
<!--    <p class="sub-text-reseaux">Inscrivez-vous avec votre compte Facebook</p>

      <div id="fb-subscription">
            Please login with your FB account: <a href="<?php echo $fb_data['loginUrl']; ?>"><img id="fb-connect" src="<?php echo img_url('subscription/fb_connect.png') ?>" alt="FB Connect" /></a>
             Or you can use XFBML 
            <div class="fb-login-button" data-show-faces="false" data-width="100" data-max-rows="1" data-scope="email,user_birthday,publish_stream,user_location"></div>
      </div>
    <hr>-->
  <?php //endif; ?>
    
<!--  <p class="sub-text-mail">Ou inscrivez-vous en utilisant votre adresse e-mail</p>-->

  <?php
    echo form_input('login',set_value('login'),'placeholder="Nom d\'utilisateur"');
    echo '<div class="ico-placeholder username"></div>';
    echo form_error('login', '<span class="error-form">', '</span>');
  
    echo form_password('password',set_value('password'),'placeholder="Mot de passe"');
    echo '<div class="ico-placeholder password"></div>';
    echo form_error('password', '<span class="error-form">', '</span>');

    echo anchor('login/forgot', 'Mot de passe oublié ?', array('class' => 'forgot_password'));
    
    echo form_submit('submit','Connexion');
    
    echo form_close();
   
    echo '<span class="error-form">';
//      echo validation_errors();
      echo @$error_credentials;
    echo '</span>';
  ?>
</div>