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

//      print_r($_POST);
//      echo $fb_data['me'];
//      echo $this->facebook->getUser();
  ?>

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
    echo form_password('password','','placeholder="Mot de passe"');
    echo '<div class="ico-placeholder password"></div>';

    echo form_password('confpassword','','placeholder="Confirmer mot de passe"');
    echo '<div class="ico-placeholder password"></div>';
    echo form_error('password', '<span class="error-form">', '</span>');
    echo form_error('confpassword', '<span class="error-form">', '</span>');

    echo form_submit('submit','Suivant');
  ?>

  <?php
    echo form_close();
  ?>

</div>