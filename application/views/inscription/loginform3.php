<h1 id="title-subscription">Créez votre compte et explorez Slyset</h1>

<div class="step-form">
  <div class="step-head">
    <h2>Étape 3/3</h2>
    <div id="state-step">
      <span class="checked first"></span>
      <span class="checked"></span>
      <span class="current last"></span>
    </div>
  </div>

  <?php
    //appel à la function "register" du controller "user"
    echo form_open('user/register_step_3');

    // Loop through the POST variables passed from the previous page
    foreach ($_POST as $key => $value){
      $value = htmlentities(stripslashes(strip_tags($value)));
      echo form_hidden($key, $value);
    }

//      print_r($_POST);
  ?>

  <?php
    if($_POST['typeaccount'] == 1):

//      echo form_input('nom',set_value('nom'),'placeholder="Votre nom"');
//      echo '<div class="ico-placeholder firstname"></div>';
//      echo form_error('nom', '<span class="error-form">', '</span>');

//      echo form_input('prenom',set_value('prenom'),'placeholder="Votre prénom"');
//      echo '<div class="ico-placeholder name"></div>';
//      echo form_error('prenom', '<span class="error-form">', '</span>');

      echo form_input('nomscene',set_value('nomscene'),'placeholder="Votre nom de scène"');
      echo '<div class="ico-placeholder nomscene"></div>';
      echo form_error('nomscene', '<span class="error-form">', '</span>');

//      echo form_input('ville',set_value('ville'),'placeholder="Votre ville"');
//      echo '<div class="ico-placeholder ville"></div>';
//      echo form_error('ville', '<span class="error-form">', '</span>');

//      echo form_input('pays',set_value('pays'),'placeholder="Votre pays"');
//      echo '<div class="ico-placeholder pays"></div>';
//      echo form_error('pays', '<span class="error-form">', '</span>');

//      $optionsSelect = array('genre'=>'Votre genre', 'homme'=>'Homme', 'femme'=>'Femme');
//      echo form_dropdown('genre', $optionsSelect, 'genre');
//      echo form_error('genre', '<span class="error-form">', '</span>');

//      echo form_input('datenaissance',set_value('datenaissance'),'placeholder="Date naissance format jj/mm/aaaa"');
//      echo '<div class="ico-placeholder datenaissance"></div>';
//      echo form_error('datenaissance', '<span class="error-form">', '</span>');

      echo form_label('Votre style','stylemusic');
      echo '<div class="checkbox-style">';
        echo '<div class="checkbox-group group1">';
          echo form_checkbox('stylemusic', 'pop', true, 'id="checkpop"');
          echo form_label('Pop','checkpop');

          echo form_checkbox('stylemusic', 'rock', false, 'id="checkrock"');
          echo form_label('Rock','checkrock');

          echo form_checkbox('stylemusic', 'folk', false, 'id="checkfolk"');
          echo form_label('Folk','checkfolk');
        echo '</div>';

        echo '<div class="checkbox-group group2">';
          echo form_checkbox('stylemusic', 'garage', false, 'id="checkgarage"');
          echo form_label('Garage','checkgarage');

          echo form_checkbox('stylemusic', 'punk', false, 'id="checkpunk"');
          echo form_label('Punk','checkpunk');

          echo form_checkbox('stylemusic', 'jazz', false, 'id="checkjazz"');
          echo form_label('Jazz','checkjazz');
        echo '</div>';

        echo '<div class="checkbox-group group3">';
          echo form_checkbox('stylemusic', 'classique', false, 'id="checkclassique"');
          echo form_label('Classique','checkclassique');

          echo form_checkbox('stylemusic', 'classique', false, 'id="checkclassique"');
          echo form_label('Classique','checkclassique');

          echo form_checkbox('stylemusic', 'classique', false, 'id="checkclassique"');
          echo form_label('Classique','checkclassique');
        echo '</div>';
      echo '</div>';

      echo form_submit('submit','Finaliser le compte');
      echo form_close();

    elseif($_POST['typeaccount'] == 2):

//      echo form_input('nom',set_value('nom'),'placeholder="Votre nom"');
//      echo '<div class="ico-placeholder firstname"></div>';
//      echo form_error('nom', '<span class="error-form">', '</span>');

//      echo form_input('prenom',set_value('prenom'),'placeholder="Votre prénom"');
//      echo '<div class="ico-placeholder name"></div>';
//      echo form_error('prenom', '<span class="error-form">', '</span>');

      echo form_input('login',set_value('login'),'placeholder="Nom d\'utilisateur"');
      echo '<div class="ico-placeholder username"></div>';
      echo form_error('login', '<span class="error-form">', '</span>');

//      echo form_input('ville',set_value('ville'),'placeholder="Votre ville"');
//      echo '<div class="ico-placeholder ville"></div>';
//      echo form_error('ville', '<span class="error-form">', '</span>');

//      echo form_input('pays',set_value('pays'),'placeholder="Votre pays"');
//      echo '<div class="ico-placeholder pays"></div>';
//      echo form_error('pays', '<span class="error-form">', '</span>');

//      $optionsSelect = array('genre'=>'Votre genre', 'homme'=>'Homme', 'femme'=>'Femme');
//      echo form_dropdown('genre', $optionsSelect, 'genre');
//      echo form_error('genre', '<span class="error-form">', '</span>');

//      echo form_input('datenaissance',set_value('datenaissance'),'placeholder="Votre date de naissance au format jj/mm/aaaa"');
//      echo '<div class="ico-placeholder datenaissance"></div>';
//      echo form_error('datenaissance', '<span class="error-form">', '</span>');

      echo form_label('Votre style','stylemusic');
      echo '<div class="checkbox-style">';
        echo '<div class="checkbox-group group1">';
          echo form_checkbox('stylemusic', 'pop', true, 'id="checkpop"');
          echo form_label('Pop','checkpop');

          echo form_checkbox('stylemusic', 'rock', false, 'id="checkrock"');
          echo form_label('Rock','checkrock');

          echo form_checkbox('stylemusic', 'folk', false, 'id="checkfolk"');
          echo form_label('Folk','checkfolk');
        echo '</div>';

        echo '<div class="checkbox-group group2">';
          echo form_checkbox('stylemusic', 'garage', false, 'id="checkgarage"');
          echo form_label('Garage','checkgarage');

          echo form_checkbox('stylemusic', 'punk', false, 'id="checkpunk"');
          echo form_label('Punk','checkpunk');

          echo form_checkbox('stylemusic', 'jazz', false, 'id="checkjazz"');
          echo form_label('Jazz','checkjazz');
        echo '</div>';

        echo '<div class="checkbox-group group3">';
          echo form_checkbox('stylemusic', 'classique', false, 'id="checkclassique"');
          echo form_label('Classique','checkclassique');

          echo form_checkbox('stylemusic', 'classique', false, 'id="checkclassique"');
          echo form_label('Classique','checkclassique');

          echo form_checkbox('stylemusic', 'classique', false, 'id="checkclassique"');
          echo form_label('Classique','checkclassique');
        echo '</div>';
      echo '</div>';

      echo form_submit('submit','Finaliser le compte');
      echo form_close();

    endif;
  ?>

</div>