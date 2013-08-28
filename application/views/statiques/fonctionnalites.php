<?php
$session_id = $this->session->userdata('uid');
?>

<div id="contentAll">
    <div id="breadcrumbs">
        <ul>
            <li><a href="<?php echo site_url('home/' . $session_id); ?>">Accueil</a></li>
            <li><a href="<?php echo site_url($this->uri->segment(1) . '/' . $session_id); ?>">Fonctionnalités</a></li>
        </ul>
    </div>

    <div class="content_static">
        <h1 class="page_static">Fonctionnalités</h1>
        
        <h3 class="titre_static">→ Créez vos playlists</h3>
        <p class="txt_static">
            Ajoutez vos morceaux favoris à vos playlists pour les avoir sous le coude dès que l’envie se fait sentir !
        </p>
        
        <h3 class="titre_static">→ Suivez la communauté Slyset</h3>
        <p class="txt_static">
            Grâce à notre portail, impossible de passer à côté des artistes émergeants, des concerts à ne pas rater...
        </p>
        
        <h3 class="titre_static">→ Suivez vos artistes favoris</h3>
        <p class="txt_static">
            Gardez vos artistes préférés à portée de main ! Suivez-les pour être le premier au courant des sorties, des titres exclusifs, des concerts et des actualités.
        </p>
    </div>
</div>