<?php
  //appel à la function "register" du controller "user"
  echo form_open('user/register_step_1');
?>

<div class="step-form">
  <h2>Étape 1/3</h2>
  <div id="state-step">
    <span class="current"></span>
    <span class="disable"></span>
    <span class="disable"></span>
  </div>
</div>

<?php
  echo form_label('Nom d\'utilisateur','login');
  echo form_input('login',set_value('login'));

  echo form_label('E-mail','mail');
  echo form_input('mail',set_value('mail'));

  echo form_submit('submit','Créer un compte');
?>


<?php
  echo form_close();
  echo validation_errors();	//endroit où s'afficheront les erreurs de validation
?>