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
    echo form_open_multipart('user/register_step_3');

    // Loop through the POST variables passed from the previous page
    foreach ($_POST as $key => $value){
      $value = htmlentities(stripslashes(strip_tags($value)));
      echo form_hidden($key, $value);
    }

//      print_r($_POST);
  ?>

  <p class="label_big">Dites-nous en un peu plus sur vous...</p>
  
  <?php
    if($_POST['typeaccount'] == 1):

      echo form_input('login',set_value('login'),'placeholder="Nom d\'utilisateur"');
      echo '<div class="ico-placeholder username"></div>';
      echo form_error('login', '<span class="error-form">', '</span>');

      echo '<hr>';
      
      //$label_attributes = array('class'=>'label_big');
      echo '<p class="label_big">Quel(s) genre(s) de musique écoutez-vous ?</p>';//form_label('Quel(s) genre(s) de musique écoutez-vous ?','stylemusicecoute', $label_attributes);
      echo '<div class="checkbox-style">';
//        echo '<div class="checkbox-group group1">';
          echo form_checkbox('stylemusicecoute[]', 'pop', true, 'id="checkecoutepop"');
          echo form_label('Pop','checkecoutepop');

          echo form_checkbox('stylemusicecoute[]', 'rock', false, 'id="checkecouterock"');
          echo form_label('Rock','checkecouterock');

          echo form_checkbox('stylemusicecoute[]', 'folk', false, 'id="checkecoutefolk"');
          echo form_label('Folk','checkecoutefolk');
//        echo '</div>';

//        echo '<div class="checkbox-group group2">';
          echo form_checkbox('stylemusicecoute[]', 'garage', false, 'id="checkecoutegarage"');
          echo form_label('Garage','checkecoutegarage');

          echo form_checkbox('stylemusicecoute[]', 'punk', false, 'id="checkecoutepunk"');
          echo form_label('Punk','checkecoutepunk');

          echo form_checkbox('stylemusicecoute[]', 'jazz', false, 'id="checkecoutejazz"');
          echo form_label('Jazz','checkecoutejazz');
//        echo '</div>';

//        echo '<div class="checkbox-group group3">';
          echo form_checkbox('stylemusicecoute[]', 'classique1', false, 'id="checkecouteclassique1"');
          echo form_label('Classique1','checkecouteclassique1');

          echo form_checkbox('stylemusicecoute[]', 'classique2', false, 'id="checkecouteclassique2"');
          echo form_label('Classique2','checkecouteclassique2');

          echo form_checkbox('stylemusicecoute[]', 'classique3', false, 'id="checkecouteclassique3"');
          echo form_label('Classique3','checkecouteclassique3');
//        echo '</div>';
      echo '</div>';
      echo form_error('stylemusicecoute[]', '<span class="error-form">', '</span>');
      
//      $attributes_button = array('name' => 'retour', 'class' => 'back', 'type' => 'button', 'content' => 'Retour', 'onClick' => 'history.go(-1)');
//      echo form_button($attributes_button);

    elseif($_POST['typeaccount'] == 2):
      
      echo form_input('nomscene',set_value('nomscene'),'placeholder="Votre nom de scène"');
      echo '<div class="ico-placeholder nomscene"></div>';
      echo form_error('nomscene', '<span class="error-form">', '</span>');

      echo '<hr>';

      //$label_attributes = array('class'=>'label_big');
      echo '<p class="label_big">Quel(s) genre(s) de musique écoutez-vous ?</p>';//form_label('Quel(s) genre(s) de musique écoutez-vous ?','stylemusicecoute', $label_attributes);
      echo '<div class="checkbox-style">';
        echo form_checkbox('stylemusicecoute[]', 'pop', true, 'id="checkecoutepop"');
        echo form_label('Pop','checkecoutepop');

        echo form_checkbox('stylemusicecoute[]', 'rock', false, 'id="checkecouterock"');
        echo form_label('Rock','checkecouterock');

        echo form_checkbox('stylemusicecoute[]', 'folk', false, 'id="checkecoutefolk"');
        echo form_label('Folk','checkecoutefolk');

        echo form_checkbox('stylemusicecoute[]', 'garage', false, 'id="checkecoutegarage"');
        echo form_label('Garage','checkecoutegarage');

        echo form_checkbox('stylemusicecoute[]', 'punk', false, 'id="checkecoutepunk"');
        echo form_label('Punk','checkecoutepunk');

        echo form_checkbox('stylemusicecoute[]', 'jazz', false, 'id="checkecoutejazz"');
        echo form_label('Jazz','checkecoutejazz');

        echo form_checkbox('stylemusicecoute[]', 'classique1', false, 'id="checkecouteclassique1"');
        echo form_label('Classique1','checkecouteclassique1');

        echo form_checkbox('stylemusicecoute[]', 'classique2', false, 'id="checkecouteclassique2"');
        echo form_label('Classique2','checkecouteclassique2');

        echo form_checkbox('stylemusicecoute[]', 'classique3', false, 'id="checkecouteclassique3"');
        echo form_label('Classique3','checkecouteclassique3');
      echo '</div>';
      echo form_error('stylemusicecoute[]', '<span class="error-form">', '</span>');

      echo '<hr>';

      echo '<p class="label_big">Quel(s) genre(s) de musique jouez-vous ?</p>';//echo form_label('Quel(s) genre(s) de musique jouez-vous ?','stylemusicjoue', $label_attributes);
      echo '<div class="checkbox-style">';
        echo form_checkbox('stylemusicjoue[]', 'pop', true, 'id="checkjouepop"');
        echo form_label('Pop','checkjouepop');

        echo form_checkbox('stylemusicjoue[]', 'rock', false, 'id="checkjouerock"');
        echo form_label('Rock','checkjouerock');

        echo form_checkbox('stylemusicjoue[]', 'folk', false, 'id="checkjouefolk"');
        echo form_label('Folk','checkjouefolk');

        echo form_checkbox('stylemusicjoue[]', 'garage', false, 'id="checkjouegarage"');
        echo form_label('Garage','checkjouegarage');

        echo form_checkbox('stylemusicjoue[]', 'punk', false, 'id="checkjouepunk"');
        echo form_label('Punk','checkjouepunk');

        echo form_checkbox('stylemusicjoue[]', 'jazz', false, 'id="checkjouejazz"');
        echo form_label('Jazz','checkjouejazz');

        echo form_checkbox('stylemusicjoue[]', 'classique1', false, 'id="checkjoueclassique1"');
        echo form_label('Classique1','checkjoueclassique1');

        echo form_checkbox('stylemusicjoue[]', 'classique2', false, 'id="checkjoueclassique2"');
        echo form_label('Classique2','checkjoueclassique2');

        echo form_checkbox('stylemusicjoue[]', 'classique3', false, 'id="checkjoueclassique3"');
        echo form_label('Classique3','checkjoueclassique3');
      echo '</div>';
      echo form_error('stylemusicjoue[]', '<span class="error-form">', '</span>');

      echo '<hr>';

      echo '<p class="label_big">De quel(s) instrument(s) jouez-vous ?</p>';//echo form_label('De quel(s) instrument(s) jouez-vous ?','stylemusicinstru', $label_attributes);
      echo '<div class="checkbox-style">';
        echo form_checkbox('stylemusicinstru[]', 'guitare', true, 'id="checkinstruguitare"');
        echo form_label('Guitare','checkinstruguitare');

        echo form_checkbox('stylemusicinstru[]', 'voix', false, 'id="checkinstruvoix"');
        echo form_label('Voix','checkinstruvoix');

        echo form_checkbox('stylemusicinstru[]', 'piano', false, 'id="checkinstrupiano"');
        echo form_label('Piano','checkinstrupiano');

        echo form_checkbox('stylemusicinstru[]', 'accordeon', false, 'id="checkinstruaccordeon"');
        echo form_label('Accordéon','checkinstruaccordeon');

        echo form_checkbox('stylemusicinstru[]', 'harmonica', false, 'id="checkinstruharmonica"');
        echo form_label('Harmonica','checkinstruharmonica');

        echo form_checkbox('stylemusicinstru[]', 'basse', false, 'id="checkinstrubasse"');
        echo form_label('Basse','checkinstrubasse');

        echo form_checkbox('stylemusicinstru[]', 'flute', false, 'id="checkinstruflute"');
        echo form_label('Flûte','checkinstruflute');

        echo form_checkbox('stylemusicinstru[]', 'trompette', false, 'id="checkinstrutrompette"');
        echo form_label('Trompette','checkinstrutrompette');

        echo form_checkbox('stylemusicinstru[]', 'batterie', false, 'id="checkinstrubatterie"');
        echo form_label('Batterie','checkinstrubatterie');
      echo '</div>';
      echo form_error('stylemusicinstru[]', '<span class="error-form">', '</span>');
      
//      $attributes_button = array('name' => 'retour', 'class' => 'back', 'type' => 'button', 'content' => 'Retour', 'onClick' => 'history.go(-1)');
//      echo form_button($attributes_button);

    endif;
    
    $fbdata = $this->session->userdata('fb_data');    
    if(empty($fbdata['me'])):
  ?>
    <hr>

    <p class="label_big">Dites-nous en un peu plus sur vous...</p>
  
    <div id="subscription-upload">
      <div class="upload_images"></div>

      <?php 
        $label_attributes = array('class'=>'label_big');
        echo form_label('Votre photo de couverture','cover', $label_attributes);
      ?>
      <div class="upload-file-container container-cover">
        <input type="file" name="cover" size="200" id="upload_images_cover" />
      </div>
      <span class="upload_photo_name_file"></span>
      
      <?php echo form_label('Votre photo de profil','thumb', $label_attributes); ?>
      <div class="upload-file-container container-thumb">
        <input type="file" name="thumb" size="200" id="upload_images_thumb" />
      </div>
      <span class="upload_photo_name_file"></span>
    </div>
  <?php
    endif;
  
    echo form_submit('submit','Finaliser le compte');
    echo form_error('submit', '<span class="error-form">', '</span>');
    
    echo form_close();
  ?>

</div>









<?php
//      echo form_input('nom',set_value('nom'),'placeholder="Votre nom"');
//      echo '<div class="ico-placeholder firstname"></div>';
//      echo form_error('nom', '<span class="error-form">', '</span>');

//      echo form_input('prenom',set_value('prenom'),'placeholder="Votre prénom"');
//      echo '<div class="ico-placeholder name"></div>';
//      echo form_error('prenom', '<span class="error-form">', '</span>');

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
?>