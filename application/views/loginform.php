<?php

  //appel à la function "register" du controller "user"
  echo form_open('user');

  echo form_label('E-mail','mail');
  echo form_input('mail',set_value('mail'));

  echo form_label('Mot de passe','password');
  echo form_password('password');

  echo form_submit('submit','Connexion');
  echo form_close();
  echo validation_errors();	//endroit où s'afficheront les erreurs de validation

?>