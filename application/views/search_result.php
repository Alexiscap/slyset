<?php
$session_id = $this->session->userdata('uid');
?>

<div id="contentAll">
    <div id="breadcrumbs">
        <ul>
            <li><a href="<?php echo site_url('home/'.$session_id); ?>">Accueil</a></li>
            <li><a href="#">Recherche : <?php echo $keyword; ?></a></li>
        </ul>
    </div>

    <div class="content contentAdmin">
        <h2 id="title-dashboard">Résultats de recherche pour "<?php echo $keyword; ?>"</h2>
        
        <hr>
        
        <div class="search_results_wrapper">
            <?php foreach ($results as $row): ?>
<!--                <tr>
                    <td><?php echo $row->id ?></td>
                    <td><a href="<?php echo site_url('home/' . $row['id']); ?>"><?php echo $row['login'] ?></a></td>
                    <td><?php echo $row->mail ?></td>
                    <td><?php echo $row->type ?></td>
                    <td><?php echo $row->created ?></td>
                    <td><?php echo $row->updated ?></td>
                </tr>-->
            
                <div class="search_result">
                    <p class="newbies-picture">
                      <a href="<?php echo site_url('actualite/' . $row['id']); ?>">
                        <img src="<?php echo $thumb = (!empty($row['thumb'])) ? files('profiles/' . $row['thumb']) : img_url('sidebar-right/defaultphoto-profil.png'); ?>" height="38px" alt="Photo Profil" />
                      </a>
                    </p>
                    <div class="newbies-people">
                      <a href="<?php echo site_url('actualite/' . $row['id']); ?>">
        <?php echo $row['login']; ?>
                      </a>
                      </br>
                      <span class="newbies-people-type"><?php echo $type = ($row['type'] == 1) ? 'Musicien' : 'Mélomane'; ?></span>
                    </div>
                  </div>
            <?php endforeach; ?>
        </div>   
    </div>

    <div class="pagination">
        <a href="#" id="precedent"><span><</span></a>
        <a href="#" class="page">1</a>
        <a href="#" class="page">2</a>
        <a href="#" class="page">3</a>
        <a href="#" class="page">4</a>
        <a href="#" class="page">5</a>
        <a href="#" id="suivant"><span>></span></a>
    </div>

</div>
</div>