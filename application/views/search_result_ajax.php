<?php
$session_id = $this->session->userdata('uid');
?>

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
