<<<<<<< HEAD
<?php
$session_id = $this->session->userdata('uid');
?>

<?php foreach ($melos as $melo): ?>
    <tr>
        <td class="compte-checkbox checkbox-style2"><input type="checkbox" name="checkcompte[]" value="<?php echo $melo->id ?>" id="compte-<?php echo $melo->id ?>" class="checkbox-compte" /><?php echo form_label('', "compte-$melo->id") ?></td>
        <td class="compte-little"><?php echo $melo->id ?></td>
        <td class="compte-title"><?php echo $melo->login ?>
            <div class="compte-actions">
                <a href="<?php echo site_url('admin_melomanes/suspend/' . $melo->id); ?>"><?php echo $etat_txt = ($melo->suspendu == 0) ? 'Suspendre' : 'Activer'; ?></a>
                | 
                <a href="<?php echo site_url('admin_melomanes/delete/' . $melo->id); ?>">Supprimer</a>
            </div>
        </td>
        <td class="compte-middle"><?php echo date('d-m-Y', strtotime(str_replace('-', '/', $melo->created))) ?></td>
        <td class="compte-little"><?php echo $etat = ($melo->suspendu == 0) ? 'Actif' : 'Suspendu'; ?></td>
    </tr>
=======
<?php
$session_id = $this->session->userdata('uid');
?>

<?php foreach ($melos as $melo): ?>
    <tr>
        <td class="compte-checkbox checkbox-style2"><input type="checkbox" name="checkcompte[]" value="<?php echo $melo->id ?>" id="compte-<?php echo $melo->id ?>" class="checkbox-compte" /><?php echo form_label('', "compte-$melo->id") ?></td>
        <td class="compte-little"><?php echo $melo->id ?></td>
        <td class="compte-title"><?php echo $melo->login ?>
            <div class="compte-actions">
                <a href="<?php echo site_url('admin_melomanes/suspend/' . $melo->id); ?>"><?php echo $etat_txt = ($melo->suspendu == 0) ? 'Suspendre' : 'Activer'; ?></a>
                | 
                <a href="<?php echo site_url('admin_melomanes/delete/' . $melo->id); ?>">Supprimer</a>
            </div>
        </td>
        <td class="compte-middle"><?php echo date('d-m-Y', strtotime(str_replace('-', '/', $melo->created))) ?></td>
        <td class="compte-little"><?php echo $etat = ($melo->suspendu == 0) ? 'Actif' : 'Suspendu'; ?></td>
    </tr>
>>>>>>> 288ecf8... correction de mes bugs
<?php endforeach; ?>