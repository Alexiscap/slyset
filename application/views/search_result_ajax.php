<?php
$session_id = $this->session->userdata('uid');
?>

<?php foreach ($results as $row): ?>
    <tr class="search_result">
        <td class="result-photo">
            <a href="<?php echo site_url('actualite/' . $row['id']); ?>">
                <img src="<?php echo $thumb = (!empty($row['thumb'])) ? files('profiles/' . $row['thumb']) : img_url('sidebar-right/defaultphoto-profil.png'); ?>" height="38" alt="Photo Profil" />
            </a>
        </td>
        <td class="result-title">
            <a href="<?php echo site_url('actualite/' . $row['id']); ?>">
                <?php echo $row['login']; ?>
            </a>
        </td>
        <td class="result-type"><?php echo $type = ($row['type'] == 1) ? 'Musicien' : 'Mélomane'; ?></td>
    </tr>
<?php endforeach; ?>

<div class="ajax_loader"></div>
