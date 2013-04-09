<!doctype html>
<html>
  <head>
      <meta charset="utf-8">
      <title>Inscription</title>
  </head>
  <body>
    <div id="main">
        <section class="form">
            <header><h2>Inscription</h2></header>

            <form method="post" action="" id="form_inscription">
                <label for="identifiant">Identifiant<span class="required">*</span> : </label>
                <input type="text" name="identifiant" value="<?php echo set_value('identifiant'); ?>" />
                <?php echo form_error('identifiant'); ?>

                <label for="nom">Nom<span class="required">*</span> : </label>
                <input type="text" name="nom" value="<?php echo set_value('nom'); ?>" />
                <?php echo form_error('nom'); ?>

                <label for="email">Email<span class="required">*</span> : </label>
                <input type="text" name="email" value="<?php echo set_value('email'); ?>" />
                <?php echo form_error('email'); ?>

                <label for="mdp">Mot de passe<span class="required">*</span> : </label>
                <input type="password" name="mdp" value="<?php echo set_value('mdp'); ?>" />
                <?php echo form_error('mdp'); ?>

                <input type="submit" value="Envoyer" />
            </form>

        </section>
    </div>
  </body>
</html>