<h1 id="title-subscription">Créez votre compte et explorez Slyset</h1>


  <div class="step-form">
    <h2>Étape 2/3</h2>
    <div id="state-step">
      <span class="checked first"></span>
      <span class="current"></span>
      <span class="disable last"></span>
    </div>

    <div id="type-user">
      <a href="#" class="active melomane">
        <img src="<?php img_url('') ?>" alt="" />
      </a>

      <a href="#" class="musicien">
        <img src="<?php img_url('') ?>" alt="" />
      </a>
    </div>
    

    <?php
    //appel à la function "register" du controller "user"
    echo form_open('user/register_step_2');

    // Loop through the POST variables passed from the previous page
    foreach ($_POST as $key => $value){
      $value = htmlentities(stripslashes(strip_tags($value)));
      echo form_hidden($key, $value);
    }
  
    echo form_label('Mot de passe','password');
    echo form_password('password');

    echo form_label('Confirmation mot de passe','confpassword');
    echo form_password('confpassword');

    echo form_submit('submit','Créer un compte');
  ?>


  <?php
    echo form_close();
    echo validation_errors();	//endroit où s'afficheront les erreurs de validation
  ?>
</div>