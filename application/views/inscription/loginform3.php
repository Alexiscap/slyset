<?php
  //appel à la function "register" du controller "user"
  echo form_open('user');
  
  // Loop through the POST variables passed from the previous page  
  foreach ($_POST as $key => $value){
    $value = htmlentities(stripslashes(strip_tags($value)));
    echo form_hidden($key, $value);
  }
?>

<div class="step-form">
  <h2>Étape 3/3</h2>
  <div id="state-step">
    <span class="checked"></span>
    <span class="checked"></span>
    <span class="current"></span>
  </div>
</div>

<?php
//  echo form_label('Mot de passe','password');
//  echo form_password('password');
//  
//  echo form_label('Confirmation mot de passe','confpassword');
//  echo form_password('confpassword');

  echo form_submit('submit','Créer un compte');
?>

  
<?php
  echo form_close();
  echo validation_errors();	//endroit où s'afficheront les erreurs de validation
?>