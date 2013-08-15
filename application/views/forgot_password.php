<h1 id="title-subscription">Mot de passe oublié ?</h1>

<div class="step-form">
  <div class="step-head">
    <h2>Réinitialisation de votre mot de passe</h2>
  </div>

  <?php
    echo form_open('login/forgot');
  ?>
    
  <p class="sub-text-mail">Entrez votre adresse e-mail pour que nous puissions réinitialiser votre mot de passe.</p>

  <?php
    echo form_input('mail',set_value('mail'),'placeholder="E-Mail"');
    echo '<div class="ico-placeholder email"></div>';
    echo form_error('mail', '<span class="error-form">', '</span>');

    echo form_submit('submit','Réinitialiser');
  ?>

  <?php
    echo form_close();
  ?>
</div>