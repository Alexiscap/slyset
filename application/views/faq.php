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
        <h2 class="page_static">FAQ : la foire aux questions</h2>
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
        <p class="section_faq">Mon inscription</p>
        <p class="titre_mention">Pourquoi s'inscrire ?</p>
        <br />
        <p class="txt_mention">
            Une fois inscrit, vous rejoindrez la communauté Slyset et créerez votre espace personnel. Vous pourrez créer vos propres playlists, envoyer des messages à vos contacts, laisser des commentaires, ajouter des artistes et des albums dans vos favoris.
        </p>
        <br />
        <p class="titre_mention">Comment m'inscrire ?</p>
        <br />
        <p class="txt_mention">
            Pour vous inscrire dès maintenant, cliquez sur le lien "Créer un compte" situé en haut à droite du site puis renseignez le formulaire.
        </p>
        <br />
        <p class="titre_mention">Que faire si j'ai oublié mon mot de passe ?</p>
        <br />
        <p class="txt_mention">
            Si vous avez oublié votre mot de passe, il vous est possible d'en changer en cliquant sur "S'identifier" et "mot de passe oublié" ou directement sur ce lien. Il ne faut pas être connecté sur Deezer pour utiliser cette fonction.
        </p>
        <br />
        <p class="titre_mention">Quelles sont les différences entre un compte mélomane et un compte musicien ?</p>
        <br />
        <p class="txt_mention">
            Si vous avez oublié votre mot de passe, il vous est possible d'en changer en cliquant sur "S'identifier" et "mot de passe oublié" ou directement sur ce lien. Il ne faut pas être connecté sur Deezer pour utiliser cette fonction.
        </p>
        <br />
    </div>
</div>