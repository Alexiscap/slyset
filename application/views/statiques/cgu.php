<?php
$session_id = $this->session->userdata('uid');
?>

<div id="contentAll">
    <div id="breadcrumbs">
        <ul>
            <li><a href="<?php echo site_url('home/' . $session_id); ?>">Accueil</a></li>
            <li><a href="<?php echo site_url($this->uri->segment(1) . '/' . $session_id); ?>">Conditions générales</a></li>
        </ul>
    </div>

    <div class="content_static">
        <h2 class="page_static">Conditions Générales</h2>
        
        <h3 class="titre_static">1. Présentation du site</h3>
        <p class="txt_static">
            En vertu de l'article 6 de la loi n° 2004-575 du 21 juin 2004 pour la confiance dans l'économie numérique, il est précisé aux utilisateurs du site http://www.slyset.fr l'identité des différents intervenants dans le cadre de sa réalisation et de son suivi :
            <br /><br />
            Propriétaire : Yves Boisson – Siret n°541546684341 – Camden Town, Londres<br />
            Créateur : Agence PeekABoo<br />
            Responsable publication : Andrew Ramsey – andrew@slyset.fr<br />
            Le responsable publication est une personne physique ou une personne morale.<br />
            Webmaster : Andrew Ramsey – andrew@slyset.fr<br />
            Hébergeur : OVH – 43 rue de Tourcoing, Roubaix
        </p>
        
        <h3 class="titre_static">2. Conditions générales d’utilisation du site et des services proposés</h3>
        <p class="txt_static">
            L’utilisation du site http://www.slyset.fr implique l’acceptation pleine et entière des conditions générales d’utilisation ci-après décrites. Ces conditions d’utilisation sont susceptibles d’être modifiées ou complétées à tout moment, les utilisateurs du site http://www.slyset.fr sont donc invités à les consulter de manière régulière.
            <br /><br />
            Ce site est normalement accessible à tout moment aux utilisateurs. Une interruption pour raison de maintenance technique peut être toutefois décidée par http://www.slyset.fr, qui s’efforcera alors de communiquer préalablement aux utilisateurs les dates et heures de l’intervention.
            <br /><br />
            Le site http://www.slyset.fr est mis à jour régulièrement par Andrew Ramsey. De la même façon, les mentions légales peuvent être modifiées à tout moment : elles s’imposent néanmoins à l’utilisateur qui est invité à s’y référer le plus souvent possible afin d’en prendre connaissance.
        </p>
        
        <h3 class="titre_static">3. Description des services fournis</h3>
        <p class="txt_static">
            Le site http://www.slyset.fr a pour objet de fournir une information concernant l’ensemble des activités de la société.
            <br /><br />
            Yves Boisson s’efforce de fournir sur le site http://www.slyset.fr des informations aussi précises que possible. Toutefois, il ne pourra être tenue responsable des omissions, des inexactitudes et des carences dans la mise à jour, qu’elles soient de son fait ou du fait des tiers partenaires qui lui fournissent ces informations.
            <br /><br />
            Tous les informations indiquées sur le site http://www.slyset.fr sont données à titre indicatif, et sont susceptibles d’évoluer. Par ailleurs, les renseignements figurant sur le site http://www.slyset.fr ne sont pas exhaustifs. Ils sont donnés sous réserve de modifications ayant été apportées depuis leur mise en ligne.
        </p>
        
        <h3 class="titre_static">4. Propriété intellectuelle et contrefaçons</h3>
        <p class="txt_static">
            Yves Boisson est propriétaire des droits de propriété intellectuelle ou détient les droits d’usage sur tous les éléments accessibles sur le site, notamment les textes, images, graphismes, logo, icônes, sons, logiciels.
            <br /><br />
            Toute reproduction, représentation, modification, publication, adaptation de tout ou partie des éléments du site, quel que soit le moyen ou le procédé utilisé, est interdite, sauf autorisation écrite préalable de : Yves Boisson.
            <br /><br />
            Toute exploitation non autorisée du site ou de l’un quelconque des éléments qu’il contient sera considérée comme constitutive d’une contrefaçon et poursuivie conformément aux dispositions des articles L.335-2 et suivants du Code de Propriété Intellectuelle.
        </p>
    </div>
</div>