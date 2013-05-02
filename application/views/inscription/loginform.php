<!--<div id="content">-->
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
      //appel à la function "register" du controller "user"
      echo form_open('user/register_step_1');
    ?>
    
    <p class="sub-text-reseaux">Inscrivez-vous avec votre compte Facebook ou Twitter</p>
    
    <div>
        <?php if(!$fb_data['me']): ?>
            Please login with your FB account: <a href="<?php echo $fb_data['loginUrl']; ?>">login</a>
            <!-- Or you can use XFBML -->
            <div class="fb-login-button" data-show-faces="false" data-width="100" data-max-rows="1" data-scope="email,user_birthday,publish_stream"></div>
        <?php else: ?>
            <img src="https://graph.facebook.com/<?php echo $fb_data['uid']; ?>/picture" alt="" class="pic" />
            <p>Hi <?php echo $fb_data['me']['name']; ?>,<br />
              <a href="<?php echo site_url('topsecret'); ?>">You can access the top secret page</a> or <a href="<?php echo $fb_data['logoutUrl']; ?>">logout</a>
            </p>
        <?php endif; ?>
    </div>
    
    <hr>
    <p class="sub-text-mail">Ou inscrivez-vous en utilisant votre adresse e-mail</p>
    
    <?php    
//      echo form_label('Nom d\'utilisateur','login');
//      echo form_input('login',set_value('login'),'placeholder="Nom d\'utilisateur"');
//      echo '<div class="ico-placeholder username"></div>';
//      echo form_error('login', '<span class="error-form">', '</span>');
      
//      echo form_label('E-mail','mail');
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
<!--</div>-->