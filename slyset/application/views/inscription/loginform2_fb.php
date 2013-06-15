<h1 id="title-subscription">Créez votre compte et explorez Slyset</h1>

<div class="step-form">
  <div class="step-head">
    <h2>Étape 2/3</h2>
    <div id="state-step">
      <span class="checked first"></span>
      <span class="current"></span>
      <span class="disable last"></span>
    </div>
  </div>

  <?php
    //appel à la function "register" du controller "user"
    echo form_open('user/register_step_2fb');

    // Loop through the POST variables passed from the previous page
    foreach ($_POST as $key => $value){
      $value = htmlentities(stripslashes(strip_tags($value)));
      echo form_hidden($key, $value);
    }

//      print_r($_POST);
//      echo $fb_data['me'];
//      echo $this->facebook->getUser();
  ?>

  <?php if($fb_data['me']): ?>
    <div class="user_fb_sub">
        <p>Bonjour <?php echo $fb_data['me']['name']; ?><!--,<br />
          <a href="<?php echo site_url('topsecret'); ?>">You can access the top secret page</a> or <a href="<?php echo $fb_data['logoutUrl']; ?>">logout</a>-->
        </p>
        <img src="https://graph.facebook.com/<?php echo $fb_data['uid']; ?>/picture" alt="" class="pic" />
    </div>
  <?php endif; ?>
  
  <p class="sub-text-type">Choisissez votre type de profil</p>

  <div id="type-user">
      <?php
        echo form_checkbox('typeaccount', '1', true, 'class="check_typeaccount_1"');
        echo form_label('Melomane','typeaccount');

        echo form_checkbox('typeaccount', '2', false, 'class="check_typeaccount_2"');
        echo form_label('Musicien','typeaccount');
      ?>

      <span class="change-type"></span>

      <p class="choix-text"><a href="#">Vous ne savez pas quoi choisir ?</a></p>
  </div>

  <?php    
    echo form_submit('submit','Suivant');
    
    echo form_close();
  ?>

</div>