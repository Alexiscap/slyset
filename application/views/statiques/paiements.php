<?php
$session_id = $this->session->userdata('uid');
?>

<div id="contentAll">
    <div id="breadcrumbs">
        <ul>
            <li><a href="<?php echo site_url('home/' . $session_id); ?>">Accueil</a></li>
            <li><a href="<?php echo site_url($this->uri->segment(1) . '/' . $session_id); ?>">Paiement sécurisé</a></li>
        </ul>
    </div>

    <div class="content_static">
        <h1 class="page_static">Paiement sécurisé</h1>
        
        <h3 class="titre_static">Slyset utilise le système de paiement sécurisé 3D Secure</h3>
        <p class="txt_static">
            Lors de chacun de vos paiements par carte en ligne, une demande d’authentification est transmise à votre banque.<br />
            La méthode d’authentification est laissée au libre choix de votre Banque (date de naissance, mot de passe...). Attention, ce système appelé "3D Secure"ne doit pas être confondu avec votre code de sécurité de votre carte bancaire.<br />
            Le système "3D Secure" permet d´éviter toute opération frauduleuse. Le principe de 3D-Secure consiste en un programme mis en place par Visa/Mastercard et proposé par l’ensemble des banques françaises. Ce programme vous demandera de vous authentifier au moment du paiement afin de limiter l’utilisation frauduleuse d’un numéro de carte.
        </p>
        
        <h3 class="titre_static">Comment vérifier que vous vous trouvez sur une page sécurisée ?</h3>
        <p class="txt_static">
            Lorsque vous passez sur la page de paiement où vous devez saisir vos numéros de carte bancaire, vous vous trouvez sur une page totalement sécurisée. Vous remarquerez que l’adresse de la page de paiement commence par " https ://www. " contrairement aux autres pages web classiques qui commencent par "http://www.". Ce "s" est le "s" de secure
qui signifie en anglais sécurisé. Vous trouverez également en bas à droite de votre navigateur un pictogramme symbolisant un Cadenas ou une clef selon le navigateur de votre PC vous informant que vous vous trouvez également sur une page entièrement sécurisée.
        </p>
        
        <h3 class="titre_static">Moyens de paiement acceptées</h3>
        <p class="txt_static">
            Pour régler vos achats sur www.slyset.fr, rien de plus simple ! 10 cartes de paiement et Paypal vous sont offerts.
        </p>
        
        <h3 class="titre_static">Les cartes bancaires classiques</h3>
        <p class="txt_static">
            Vous pouvez régler vos achats à l’aide d’une carte Bleue, Visa, Mastercard / Eurocard.
        </p>
        <p class="img_static">
            <img class="select" src="<?php echo img_url('common/pmt_cb.png'); ?>" alt="CB" />
            <img src="<?php echo img_url('common/pmt_ppal.png'); ?>" alt="Paypal" />
        </p>
        <p class="txt_static">
            Si vous payez à l’aide d’une de ces cartes de paiement, vous réglez en ligne 100 % de votre commande.
        </p>
    </div>
</div>