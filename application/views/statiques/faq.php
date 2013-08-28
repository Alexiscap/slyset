<?php
$session_id = $this->session->userdata('uid');
?>

<div id="contentAll">
    <div id="breadcrumbs">
        <ul>
            <li><a href="<?php echo site_url('home/' . $session_id); ?>">Accueil</a></li>
            <li><a href="<?php echo site_url($this->uri->segment(1) . '/' . $session_id); ?>">FAQ</a></li>
        </ul>
    </div>

    <div class="content_static">
        <h1 class="page_static">FAQ : la foire aux questions</h1>
        
        <div class="menu_faq">
            <div class="left">
                <p>Mon inscription</p>
                <ul>
                    <li>> Pourquoi s'inscrire ?</li>
                    <li>> Comment m'inscrire ?</li>
                    <li>> Que faire si j'ai oublié mon mot de passe ?</li>
                    <li>> Quelles sont les différences entre un compte mélomane et un compte musicien ?</li>
                </ul>
            </div>
            <div class="right">
                <p>Mon compte et mon profil</p>
                <ul>
                    <li>> Pourquoi s'inscrire ?</li>
                    <li>> Comment m'inscrire ?</li>
                    <li>> Que faire si j'ai oublié mon mot de passe ?</li>
                    <li>> Quelles sont les différences entre réglage et personnalisation ?</li>
                </ul>
            </div>
        </div>
        
        <div class="clear"></div>
        
        <h2 class="section_faq">Mon inscription</h2>
        <h3 class="titre_static">Pourquoi s'inscrire ?</h3>
        <p class="txt_static">
            Une fois inscrit, vous rejoindrez la communauté Slyset et créerez votre espace personnel. Vous pourrez créer vos propres playlists, envoyer des messages à vos contacts, laisser des commentaires, ajouter des artistes et des albums dans vos favoris.
        </p>
        
        <h3 class="titre_static">Comment m'inscrire ?</h3>
        <p class="txt_static">
            Pour vous inscrire dès maintenant, cliquez sur le lien "Créer un compte" situé en haut à droite du site puis renseignez le formulaire.
        </p>
        
        <h3 class="titre_static">Que faire si j'ai oublié mon mot de passe ?</h3>
        <p class="txt_static">
            Si vous avez oublié votre mot de passe, il vous est possible d'en changer en cliquant sur "S'identifier" et "mot de passe oublié" ou directement sur ce lien. Il ne faut pas être connecté sur Deezer pour utiliser cette fonction.
        </p>
        
        <h3 class="titre_static">Quelles sont les différences entre un compte mélomane et un compte musicien ?</h3>
        <p class="txt_static">
            Si vous avez oublié votre mot de passe, il vous est possible d'en changer en cliquant sur "S'identifier" et "mot de passe oublié" ou directement sur ce lien. Il ne faut pas être connecté sur Deezer pour utiliser cette fonction.
        </p>
    </div>
</div>