<?php
$session_id = $this->session->userdata('uid');
?>

<div id="contentAll">
    <div id="breadcrumbs">
        <ul>
            <li><a href="<?php echo site_url('home/'.$session_id); ?>">Accueil</a></li>
            <li><a href="<?php echo site_url('admin'); ?>">Administration</a></li>
            <li><a href="<?php echo site_url($this->uri->segment(1)); ?>">Musiciens</a></li>
        </ul>
    </div>

    <div class="content contentAdmin">
        <h2 id="title-dashboard">Comptes musiciens</h2>
        
        <p>Cette page vous permet d'administrer les comptes musiciens Slyset.</p>
                  
        <div id="comptes-tab" class="comptes_musiciens">
            <?php            
                echo form_open('admin_musiciens/submit_multi_musiciens');
            ?>
          
                <table id="tablesorter-cb">
                    <thead>
                        <tr class="tab-head">
                            <th class="compte-checkbox checkbox-style2"><input type="checkbox" name="compte-all" value="all" class="check_all checkbox-compte" id="compte-all"/><?php echo form_label('', "compte-all") ?></th>
                            <th class="compte-little">#ID<!--<span id="id" class="filter filter-bottom"></span>--></th>
                            <th class="compte-title">Nom d'utilisateur<!--<span id="titre" class="filter filter-bottom"></span>--></th>
                            <th class="compte-middle">Date d'inscription<!--<span id="created" class="filter filter-bottom"></span>--></th>
                            <th class="compte-little">Etat<!--<span id="etat" class="filter filter-bottom"></span>--></th>
                        </tr>
                    </thead>
                    
                    <tbody>                        
                        <?php foreach($musiciens as $musicien): ?>
                            <tr>
                                <td class="compte-checkbox checkbox-style2"><input type="checkbox" name="checkcompte[]" value="<?php echo $musicien->id ?>" id="compte-<?php echo $musicien->id ?>" class="checkbox-compte" /><?php echo form_label('', "compte-$musicien->id") ?></td>
                                <td class="compte-little"><?php echo $musicien->id ?></td>
                                <td class="compte-title"><?php echo $musicien->login ?>
                                    <div class="compte-actions">
                                        <a href="<?php echo site_url('admin_musiciens/suspend/'.$musicien->id); ?>"><?php echo $etat_txt = ($musicien->suspendu == 0) ? 'Suspendre' : 'Activer'; ?></a>
                                        | 
                                        <a href="<?php echo site_url('admin_musiciens/delete/'.$musicien->id); ?>">Supprimer</a>
                                    </div>
                                </td>
                                <td class="compte-middle"><?php echo date('d-m-Y', strtotime(str_replace('-', '/', $musicien->created)))?></td>
                                <td class="compte-little"><?php echo $etat = ($musicien->suspendu == 0) ? 'Actif' : 'Suspendu'; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </thead>
                </table>
            <?php
                    echo form_submit('supprimer','Supprimer');
                    echo form_error('supprimer', '<span class="error-form">', '</span>');
                    
                    echo form_submit('suspendre','Suspendre');
                    echo form_error('suspendre', '<span class="error-form">', '</span>');

                echo form_close();
            ?>
            
            <div class="ajax_loader"></div
        </div>
    </div>
</div>
