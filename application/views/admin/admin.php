<?php
$session_id = $this->session->userdata('uid');
?>

<div id="contentAll">
    <div id="breadcrumbs">
        <ul>
            <li><a href="<?php echo site_url('home'); ?>">Accueil</a></li>
            <li><a href="<?php echo site_url($this->uri->segment(1)); ?>">Administration</a></li>
        </ul>
    </div>

    <div class="content contentAdmin">
        <h2 id="title-dashboard">Administration générale</h2>
        
        <!--<a href="#shadow" rel="shadowbox" id="shadowbox">Open shadowbox</a>-->
        
        <p>Grâce à l’administration de Slyset (le “back-office”), vous pouvez gérer l’ensemble du site et de ses utilisateurs, aussi bien mélomanes que musiciens. Vous pouvez intervenir sur tous les contenus présents sur Slyset et administrer les abus aux conditions générales d’utilisation.</p>

        <div id="admin_notification">
            <h3> Publier une notification générale</h3>

            <?php
                $cookie = $this->input->cookie('notification', TRUE);
                $cookie_notif = (!empty($cookie)) ? $cookie : false;
            
                echo form_open('admin/set_notification');

                    echo form_label('Votre message de notification aux utilisateurs de Slyset (affichage sur le portail) :', 'notification');
                    echo form_textarea('notification', $cookie_notif, 'placeholder="Entrez votre message. Exemple : Les comptes sont en cours de maintenance, veuilez nous excuser pour la gêne occasionée"');//$admin->notification
                    echo form_error('notification', '<span class="error-form">', '</span>');

                    echo form_submit('submit','Enregistrer');
                    echo form_error('submit', '<span class="error-form">', '</span>');

                echo form_close();
            ?>
        </div>
                
        <div id="admin_chiffres">
            <h3> Quelques chiffres...</h3>
            
            <div class="admin_chiffre abuse_attente">
                <div class="ico"></div>
                <div class="count">23</div>
                <div class="raison">abus en attente</div>
            </div>
            
            <div class="admin_chiffre abuse_suspension">
                <div class="ico"></div>
                <div class="count">12</div>
                <div class="raison">comptes suspendus</div>
            </div>
            
            <div class="admin_links">
                <a href="#">Voir et gérer les abus signalés</a>
                <br /><br />
                <a href="#">Gérer les comptes mélomanes</a>
                <a href="#">Gérer les comptes musiciens</a>
            </div>
            
            <?php // print_r($this->session->all_userdata()); ?>
        </div>
    </div>
</div>

 <div id="shadow" class="pop-in"style="display:none;">
  <p> Ajouter un concert </p>
  <img src="<?php echo img_url('musicien/pop_close.png'); ?>" alt="Fermer" />
  <div class="content-pi">
    <form>
		<div class="label">
			<label>Artistes</label>
		</div>
		<div class="champs">
			<input type="text">
			<input type="text">
		</div>
		<div class="label">
			<label>Date</label>
		</div>
		<div class="champs">
			<input type="date">
		</div>
		<div class="label">
			<label>Heure</label>
		</div>
		<div class="champs_heure">
			<input type="text">
			<input type="text">
		</div>
		<div class="label">
			<label>Lieu</label>
		</div>
		<div class="champs_lieu">
			<input type="text">
			<input type="text">
		</div>
		<div class="label">
			<label>Prix</label>
		</div>
		<div class="champs_prix">
			<input type="text"> &euro;
		</div>
		<input type="submit" value="valider">
	</form>
  </div>
</div>