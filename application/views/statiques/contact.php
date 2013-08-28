<?php
$session_id = $this->session->userdata('uid');
$prenom = $this->session->userdata('prenom');
$nom = $this->session->userdata('nom');
$feedback = $this->session->userdata('flash:old:feedback');
?>

<div id="contentAll">
    <div id="breadcrumbs">
        <ul>
            <li><a href="<?php echo site_url('home/' . $session_id); ?>">Accueil</a></li>
            <li><a href="<?php echo site_url($this->uri->segment(1) . '/' . $session_id); ?>">Contact</a></li>
        </ul>
    </div>

    <?php if (isset($feedback) && !empty($feedback)): ?>
        <div id="message-notification">
          <div class="ico-msg"></div>
          <p><?php echo $feedback; ?></p>
        </div>
    <?php endif; ?>
    
    <div class="content_static contact">
        <h1 class="page_static">Nous contacter</h1>
        
        <p class="txt_static">
            Vous avez une question ? Vous rencontrez un problème ? N’hésitez pas à contacter l’équipe de Slyset. Nous vous recommandons de vérifier votre email d'envoi dans le formulaire afin de vous assurer d'avoir une réponse dans les 48 heures (jours ouvrés et hors fériés). 
        </p>
        
        <?php
            $label_attributes = array('class'=>'label_big');
            
            echo form_open('pages_statiques/contact_form');
            
            echo form_label('Prénom','prenom',$label_attributes);
            echo form_input('prenom',$surname = (!empty($prenom)) ? $prenom : set_value('prenom'),'placeholder="Votre prénom"');
            echo form_error('prenom', '<span class="error-form">', '</span>');
            
            echo form_label('Nom','nom',$label_attributes);
            echo form_input('nom',$name = (!empty($nom)) ? $nom : set_value('nom'),'placeholder="Votre nom"');
            echo form_error('nom', '<span class="error-form">', '</span>');
            
            echo form_label('Mail','mail',$label_attributes);
            echo form_input('mail',set_value('mail'),'placeholder="Votre e-mail"');
            echo form_error('mail', '<span class="error-form">', '</span>');

            echo form_label('Message','message',$label_attributes);
            echo form_textarea('message',set_value('message'),'placeholder="Votre message"');
            echo form_error('message', '<span class="error-form">', '</span>');
            
            echo form_submit('submit', 'Envoyer');
            echo form_error('submit', '<span class="error-form">', '</span>');
            
            echo form_close();
        
        ?>
    </div>
</div>