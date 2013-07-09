<?php
$session_id = $this->session->userdata('uid');
?>

<div id="contentAll">
    <div id="breadcrumbs">
        <ul>
            <li><a href="<?php echo site_url('home/' . $session_id); ?>">Accueil</a></li>
            <li><a href="<?php echo site_url($this->uri->segment(1) . '/' . $session_id); ?>">Slyset project</a></li>
        </ul>
    </div>

    <div class="content_static">
        <h2 class="page_static">Qui sommes-nous ?</h2>
        
        <p class="txt_static">
            Le monde de la musique est sous les projecteurs depuis bien longtemps. Les ayants droit sont entrés en conflit direct avec les internautes et ont pour bras armé l’HADOPI.
        </p>
        <br />
        <p class="txt_static">
            Ce conflit touche le plus souvent les artistes qui ont pignon sur rue, ceux qui vendent des disques, beaucoup de disques. Cette musique, c’est celle qu’on voit à la TV, qu’on écoute à la radio et que l’on trouve dans les rayons des supermarchés. Mais il y a une autre musique.
        </p>
        <br />
        <p class="txt_static">
            Une musique qui s’adresse à des publics plus restreints, plus initiés, plus intimes.<br />
Nos contrées regorgent de festivals de toutes sortes qui produisent des musiciens tous différents : pianistes de jazz, guitaristes de blues, trompettiste de salsa, saxophonistes de musique moderne, guitariste Hard, groupes de rock progressif etc.
        </p>
        <br />
        <p class="txt_static">
            Attention, nous ne parlons pas du groupe de copains qui jouent de la musique le soir dans une formation amateur (quoi qu’il y en ait d’excellentes), nous parlons de professionnels, intermittents du spectacle, qui vivent, ou essaient de vivre de leur musique.
        </p>
        <br />
        <p class="txt_static">
            Ils vendent peu de disques, mais leurs apparitions en concert rassemblent à chaque fois un public d’initiés. Il est légitime de penser que la vulgarisation de l’internet a rendu plus aisée la communication de ces musiciens. Faire un site, un blog, une page Facebook est devenu chose aisée. Détrompez-vous. Les musiciens qui n’ont pas les moyens de sous-traiter leur communication à des professionnels disposent de sites internet souvent pitoyables. Et même quand c’est le cas, le résultat est parfois aléatoire.
        </p>
    </div>
</div>