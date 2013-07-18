<?php
$session_id = $this->session->userdata('uid');
?>

<?php foreach ($musiciens as $musicien): ?>
    <tr>
        <td class="compte-checkbox checkbox-style2"><input type="checkbox" name="checkcompte[]" value="<?php echo $musicien->id ?>" id="compte-<?php echo $musicien->id ?>" class="checkbox-compte" /><?php echo form_label('', "compte-$musicien->id") ?></td>
        <td class="compte-little"><?php echo $musicien->id ?></td>
        <td class="compte-title"><?php echo $musicien->login ?>
            <div class="compte-actions">
                <a href="<?php echo site_url('admin_musiciens/suspend/' . $musicien->id); ?>"><?php echo $etat_txt = ($musicien->suspendu == 0) ? 'Suspendre' : 'Activer'; ?></a>
                | 
                <a href="<?php echo site_url('admin_musiciens/delete/' . $musicien->id); ?>">Supprimer</a>
            </div>
        </td>
        <td class="compte-middle"><?php echo date('d-m-Y', strtotime(str_replace('-', '/', $musicien->created))) ?></td>
        <td class="compte-little"><?php echo $etat = ($musicien->suspendu == 0) ? 'Actif' : 'Suspendu'; ?></td>
    </tr>
<?php endforeach; ?>
