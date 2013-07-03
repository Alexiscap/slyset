<?php
$session_id = $this->session->userdata('uid');
?>


<!--<div class="search_results_wrapper">-->
<?php foreach ($results as $row): ?>            
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
<!--</div>-->   
