<?php
$session_id = $this->session->userdata('uid');
$uid = (empty($session_id)) ? '' : $session_id;
$uid_visit = (empty($infos_profile)) ? $session_id : $infos_profile->id;
$login = (empty($infos_profile)) ? $this->session->userdata('login') : $infos_profile->login;
?>

<div id="contentAll">
    <div id="breadcrumbs">
        <ul>
            <li><a href="<?php echo site_url('home/' . $uid); ?>">Accueil</a></li>
            <li><a href="<?php echo site_url('my-wall/' . $uid_visit); ?>">Mon compte</a></li>
            <li><a href="<?php echo site_url($this->uri->segment(1) . '/' . $uid_visit); ?>">Mes achats</a></li>
        </ul>
    </div>

    <div id="cover" style="background-image:url(<?php echo files('profiles/' . $cover = (empty($infos_profile)) ? $this->session->userdata('cover') : $infos_profile->cover); ?>);">
        <div id="infos-cover">
            <h2><?php echo $login; ?></h2>
            <!--
            <a href="#"><span class="button_left"></span><span class="button_center">Suivre</span><span class="button_right"></span></a>
      -->  </div>
    </div>

    <div id="stats-cover">
        <div class="stats_cover_block">
            <span class="stats_number">489</span>
            <span class="stats_title">écoutes</span>
        </div>

        <div class="stats_cover_block">
            <span class="stats_number">18</span>
            <span class="stats_title">playlists</span>
        </div>

        <div class="stats_cover_block">
            <span class="stats_number">278</span>
            <span class="stats_title">abonnements</span>
        </div>
    </div>

    <div class="content">
        <h2>Mes achats</h2>

        <!-- ************************ PANIER ************************ -->
        <div class="panier">
            <div class="descri_panier">
                <span class="nom_pl">Mon panier</span>
                <!-- ************************ RESUME ************************ -->

                <span class="detail_pl">
                    <?php
                    if ($total_document_panier == 1) {
                        echo $total_document_panier . ' partition';
                    } if ($total_document_panier > 1) {
                        echo $total_document_panier . ' partitions';
                    } if ($total_document_panier == 0) {
                        echo '0 partition';
                    }
                    ?>
                </span>
                <span class="detail_pl"><?php
                    if ($total_album_panier == 1) {
                        echo $total_album_panier . ' album,';
                    } if ($total_album_panier > 1) {
                        echo $total_album_panier . ' albums,';
                    } else {
                        echo '0 album,';
                    }
                 
                    ?></span>
                
                <span class="detail_pl"><?php
                    if ($total_morceaux_panier == 1) {
                        echo $total_morceaux_panier . ' chanson,';
                    } if ($total_morceaux_panier > 1) {
                        echo $total_morceaux_panier . ' chansons,';
                    } else {
                        echo '0 chanson,';
                    }
                    ?> </span>
                <img src="<?php echo img_url('common/caddis_achat.png'); ?>" class="detail_pl"/>
            </div>
            <hr />
            <div class="clear"></div>
             <?php if($total_album_panier + $total_document_panier + $total_morceaux_panier !=0)
                  { ?>
            <div id="articles-tab">
                <form action="<?php echo site_url('melo_achats/delete_panier'); ?>" method="post" accept-charset="utf-8">          
                 
                    <table>
                        <tbody>
                            <tr class="tab-head odd row-color-2">
                                <th class="article-checkbox checkbox-style2">
                                    <input type="checkbox" name="article-all" value="all" class="check_all checkbox-article" id="article-all">
                                    <label for="article-all">

                                    </label>
                                </th>
                                <th class="article-title">Titre<span id="titre" class="filter filter-bottom"></span></th>
                                <th class="article-artiste">Artiste<span id="titre" class="filter filter-bottom"></span></th>
                                <th class="article-type">Type<span id="titre" class="filter filter-bottom"></span></th>
                                <th class="article-prix">Prix<span id="created" class="filter filter-bottom"></span></th>
                            </tr>

                            <?php
                            $total = 0;
                            $tot = "";
                            
                            foreach ($cmd as $commande):
                                if ($commande->status == "P"):
                              ?>
                                    <tr class="even row-color-<?php echo $commande->id ?>">
                                        <td class="article-checkbox checkbox-style2"><input type="checkbox" name="checkarticle[]" value="<?php echo $commande->id ?>" id="article-<?php echo $commande->id ?>" class="checkbox-article"><label for="article-<?php echo $commande->id ?>"></label></td>
                                        <td class="article-title"><a href="#"><img src="<?php echo img_url('common/btn_play2.png'); ?>"/>
        <?php echo $commande->nom ?></td>
                                        <td class="article-artiste"><?php echo $commande->user_login ?></td>
                                        <td class="article-type"><?php echo $commande->type ?></td>
                                        <td class="article-prix"><?php echo $commande->prix ?> €</td>
                                        <?php
                                        $total = $total + $commande->prix;
                                        ?>
                                    </tr>
                                    <?php
                                endif;
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                  

            </div>
             
            <p class="total_panier">Montant total <span><?php if(isset($total))echo $total; else print '0'; ?> €</span></p>
            <div class="clear"></div>
            <a class="bigiframe" href="<?php echo site_url('pi_ta_infos/index/' . $session_id) ?>"><input type="button" value="Paiement sécurisé" class="cadis_panier"></a>
            <input type="button" value="Supprimer" class="bt_supp_playlist">
             <?php }
                    else
                    {
                    echo "<div class='panier_vide'>Votre panier est vide</div>";
                    } ?>
        </div>
        </form>
        <div class="clear"></div>
        <div class="historique">
            <div class="descri_historique">
                <span class="nom_pl">Historique d'achats</span>
                <span class="detail_pl"><?php
                            if ($total_document_history == 1) {
                                echo $total_document_history . ' partition';
                            } if ($total_document_history > 1) {
                                echo $total_document_history . ' partitions';
                            }
                            if ($total_document_history == 0) {
                                echo '0 partition';
                            }
                            ?></span>
                <span class="detail_pl"><?php
                    if ($total_album_history == 1) {
                        echo $total_album_history . ' album,';
                    } if ($total_album_history > 1) {
                        echo $total_album_history . ' albums,';
                    }
                    if ($total_album_history == 0) {
                        echo '0 album,';
                    }
                            ?></span>
                <span class="detail_pl"><?php
                        if ($total_morceaux_history == 1) {
                            echo $total_morceaux_history . ' chanson,';
                        } if ($total_morceaux_history > 1) {
                            echo $total_morceaux_history . ' chansons,';
                        }
                     else {
                        echo '0 chanson,';
                    }
                            ?> </span>
                <img src="<?php echo img_url('common/sac_historique.png'); ?>" class="detail_pl"/>
            </div>
            <hr />
            <div class="clear"></div>
             <?php if($total_album_history + $total_document_history + $total_morceaux_history !=0)
                  { ?>
            <div id="articles-tab">
           
                <form action="<?php echo site_url('admin_articles/delete_multi_article'); ?>" method="post" accept-charset="utf-8">          
                    <table id="tablesorter-cb">
                        <thead>
                            <tr class="tab-head odd row-color-2">
                                <th class="article-checkbox checkbox-style2"><input type="checkbox" name="article-all" value="all" class="check_all checkbox-article" id="article-all"><label for="article-all"></label></th>
                                <th class="article-title">Titre<span id="titre" class="filter filter-bottom"></span></th>
                                <th class="article-artiste">Artiste<span id="titre" class="filter filter-bottom"></span></th>
                                <th class="article-type">Type<span id="titre" class="filter filter-bottom"></span></th>
                                <th class="article-prix">Prix<span id="created" class="filter filter-bottom"></span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($cmd as $commande):
                                if ($commande->status == "V"):
                                    ?>
                                    <tr class="even row-color-<?php echo $commande->id ?>">
                                        <td class="article-checkbox checkbox-style2"><input type="checkbox" name="checkarticle[]" value="20" id="article-20" class="checkbox-article"><label for="article-20"></label></td>
                                        <td class="article-title"><a href="#" class ="play_achat" style="visibility:hidden"><img  src="<?php echo img_url('common/btn_play2.png'); ?>"/></a>
        <?php echo $commande->nom ?></td>
                                        <td class="article-artiste"><?php echo $commande->user_login ?></td>
                                        <td class="article-type"><?php echo $commande->type ?></td>
                                        <td class="article-prix"><?php echo $commande->prix ?> €</td>
                                    </tr>
                                    <?php
                                endif;
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </form>
            </div>
            <input type="button" value="Télécharger" class="telecharge_select">
              <?php }
                    else
                    {
                    echo "<div class='panier_vide'>Vous n'avez pas encore passé de commande</div>";
                    } ?>
        </div>




    </div>

<?php if (isset($sidebar_right)) echo $sidebar_right; ?>

</div>