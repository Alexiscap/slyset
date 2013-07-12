<?php
$session_id = $this->session->userdata('uid');
?>

<div id="contentAll">
    <div id="breadcrumbs">
        <ul>
            <li><a href="<?php echo site_url('home/' . $session_id); ?>">Accueil</a></li>
            <li><a href="#">Recherche : <?php echo $keyword; ?></a></li>
        </ul>
    </div>

    <div class="content contentAdmin">
        <h2 id="title-dashboard">
            <?php if($nb_results == 0): ?>
                Aucun résultat de recherche pour "<?php echo $keyword; ?>"
            <?php elseif($nb_results == 1): ?>
                <?php echo $nb_results; ?> Résultat de recherche pour "<?php echo $keyword; ?>"
            <?php else: ?>
                <?php echo $nb_results; ?> Résultat de recherche pour "<?php echo $keyword; ?>"
            <?php endif; ?>
        </h2>

        <hr>

        <div class="search_results_wrapper" id="results-tab">
            <table id="tablesorter-nocb">
                <thead>
                    <tr class="tab-head">
                        <th class="result-photo">Profil</th>
                        <th class="result-title">Nom d'utilisateur<span id="titre" class="filter filter-bottom"></span></th>
                        <th class="result-middle">Style d'écoute</th>
                        <th class="result-middle">Style joué</th>
                        <th class="result-middle">Type de compte</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php foreach ($results as $row): ?>
                        <tr class="search_result">
                            <td class="result-photo">
                                <a href="<?php echo site_url('my-wall/' . $row['id']); ?>">
                                    <img src="<?php echo $thumb = (!empty($row['thumb'])) ? files('profiles/' . $row['thumb']) : img_url('sidebar-right/default-photo-profil.png'); ?>" height="38" alt="Photo Profil" />
                                </a>
                            </td>
                            <td class="result-title">
                                <a href="<?php echo site_url('my-wall/' . $row['id']); ?>">
                                    <?php echo $row['login']; ?>
                                </a>
                            </td>
                            <td class="result-middle"><?php echo $style_ecoute = (!empty($row['style_ecoute'])) ? $row['style_ecoute'] : '-'; ?></td>
                            <td class="result-middle"><?php echo $style_joue = (!empty($row['style_joue'])) ? $row['style_joue'] : '-'; ?></td>
                            <td class="result-middle"><?php echo $type = ($row['type'] == 2) ? 'Musicien' : 'Mélomane'; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="ajax_loader"></div>
        </div>   
    </div>
</div>