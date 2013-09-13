<link rel="stylesheet" type="text/css" href="<?php echo css_url('pop_in') ?>" media="screen" />

<div class="pop-in_cent">
    <?php // print_r($infos_profile); ?>
    <span>Prenez contact avec <?php echo $infos_profile->login; ?></span>

    <div class="content-pi-cent">
        <?php $user_visit = $this->uri->segment(3); ?>
        <?php $user = (!empty($user_visit)) ? $user_visit : $this->uri->segment(2); ?>
        <?php $uid = $this->session->userdata('uid'); ?>

        <p class="explication">Envoyez ici un message à <?php echo $infos_profile->login; ?>, celui-ci le recevra directement sur son adresse e-mail et pourra vous répondre sur la votre (inscrite dans vos réglages).</p>

        <div class="elem_center">
            <?php if(isset($success)) echo $success; ?>
            <?php echo validation_errors(); ?>

            <?php echo form_open_multipart('contacter/' . $user); ?>
            <div class="label"><label for="object">Objet</label></div>
            <div class="champs">
                <?php echo form_input('object', set_value('object'), 'placeholder="Le sujet de votre contact"'); ?>
            </div>

            <div class="label"><label for="message">Message</label></div>
            <div class="champs">
				<?php
                $message = array(
                    'name' => 'message',
                    'class' => 'contact_mess',
                    'resize' => 'none',
                    'placeholder' => 'Entrez ici votre message.',
                );
                echo form_textarea($message);
                ?>
            </div>

            <?php echo form_submit('valider', 'Valider'); ?>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
