<!--<div id="content">-->
    <h1 id="title-subscription">Créez votre compte et explorez Slyset</h1>

    <div class="step-form">
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
      
      print_r($_POST);
    ?>
    
    <?php
      if($_POST['typeaccount'] == 1):
    
        echo form_input('nom',set_value('nom'),'placeholder="Votre nom"');
        echo '<div class="ico-placeholder firstname"></div>';
        echo form_error('nom', '<span class="error-form">', '</span>');

        echo form_input('prenom',set_value('prenom'),'placeholder="Votre prénom"');
        echo '<div class="ico-placeholder name"></div>';
        echo form_error('prenom', '<span class="error-form">', '</span>');

        echo form_submit('submit','Finaliser le compte');
        
        echo form_close();
        
      elseif($_POST['typeaccount'] == 2):
          
        echo form_input('nom',set_value('nom'),'placeholder="Votre nom"');
        echo '<div class="ico-placeholder firstname"></div>';
        echo form_error('nom', '<span class="error-form">', '</span>');

        echo form_submit('submit','Finaliser le compte 2');
        
        echo form_close();
        
      endif;
    ?>
    
    
  </div>
<!-- </div> -->