<!--<div id="content">-->
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
      echo form_open('user/register_step_2');

      // Loop through the POST variables passed from the previous page
      foreach ($_POST as $key => $value){
        $value = htmlentities(stripslashes(strip_tags($value)));
        echo form_hidden($key, $value);
      }
    ?>
    
    <p class="sub-text-type">Choisissez votre type de profil</p>
    
    <div id="type-user">
      <a href="#" class="active melomane">
        <span></span>
      </a>

      <a href="#" class="musicien">
        <span></span>
      </a>
      
      <span class="change-type"></span>
    </div>
    
    <?php
      echo form_checkbox('melomane', '1', true);
      echo form_label('Melomane','melomane');

      echo form_checkbox('musicien', '2', false);
      echo form_label('Musicien','musicien');
     
      echo form_password('password','','placeholder="Mot de passe"');
      echo '<div class="ico-placeholder username"></div>';
      echo form_error('password', '<span class="error-form">', '</span>');

      echo form_password('confpassword','','placeholder="Confirmer mot de passe"');
      echo '<div class="ico-placeholder username"></div>';
      echo form_error('confpassword', '<span class="error-form">', '</span>');

      echo form_hidden('usertype', '1');
      
      echo form_submit('submit','Créer un compte');
    ?>
    
    <?php
      echo form_close();
    ?>
    
  </div>
<!--</div>-->