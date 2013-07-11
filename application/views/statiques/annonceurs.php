<?php
$session_id = $this->session->userdata('uid');
?>

<div id="contentAll">
    <div id="breadcrumbs">
        <ul>
            <li><a href="<?php echo site_url('home/' . $session_id); ?>">Accueil</a></li>
            <li><a href="<?php echo site_url($this->uri->segment(1) . '/' . $session_id); ?>">Annonceurs</a></li>
        </ul>
    </div>

    <div class="content_static">
        <h2 class="page_static">Annonceurs</h2>
        
        <p class="txt_static">
            Slyset est un réseau social musical à destination des musiciens et des mélomanes. Son audience comprend des professionnels de la musique et des passionnés.
        </p>
        <p class="txt_static">
            Annoncer sur Slyset vous permet de promouvoir votre produit, votre service ou votre site internet auprès d’une <span class="bold">communauté ciblée</span> qui a des <span class="bold">centres d’intérêts</span> (la musique, un genre en particulier...). Il s’agit donc d’une opportunité intéressante pour <span class="bold">atteindre une audience qualifiée</span> et pour <span class="bold">augmenter vos conversions</span>.
        </p>
        
        <h3 class="titre_static">Contact</h3>
        <p class="txt_static">
            Vous souhaitez devenir annonceur sur Slyset ? Merci d’adresser votre demande à l’adresse e-mail suivante : annonceurs@slyset.fr ou via notre <a href="<?php echo site_url('contact/'.$session_id); ?>">formulaire de contact</a>.
        </p>
    </div>
</div>