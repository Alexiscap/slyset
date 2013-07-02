<?php
$session_id = $this->session->userdata('uid');
?>

<div id="contentAll">
    <div id="breadcrumbs">
        <ul>
            <li><a href="<?php echo site_url('home'); ?>">Accueil</a></li>
            <li><a href="<?php echo site_url('admin'); ?>">Administration</a></li>
            <li><a href="<?php echo site_url($this->uri->segment(1)); ?>">Artistes à la une</a></li>
        </ul>
    </div>

    <div class="content contentAdmin">
        <h2 id="title-dashboard">Artistes à la une</h2>
        
        <p>Cette page vous permet de sélectionner les musiciens apparaisant dans le <b>Top 5 des artistes à la une</b>.</p>
        
        <div id="artistes-fields">
            <?php            
                echo form_open('admin_artistes/add_artiste');
            
                    $label_attributes = array('class'=>'label_big');
                    
//                    print_r($cover_artistes);
                    
                    echo form_label('Artiste n°1', 'artiste1', $label_attributes);
                    echo form_input('artiste1', $cover_name1 = (!empty($cover_artistes[0])) ? $cover_artistes[0][0]->artiste_1 : set_value('artiste1'), 'placeholder="Nom du musicien ou du groupe"');
                    echo form_error('artiste1', '<span class="error-form">', '</span>');
                    
                    echo form_label('Artiste n°2', 'artiste2', $label_attributes);
                    echo form_input('artiste2', $cover_name2 = (!empty($cover_artistes[1])) ? $cover_artistes[1][0]->artiste_2 : set_value('artiste2'), 'placeholder="Nom du musicien ou du groupe"');
                    echo form_error('artiste2', '<span class="error-form">', '</span>');
                    
                    echo form_label('Artiste n°3', 'artiste3', $label_attributes);
                    echo form_input('artiste3', $cover_name3 = (!empty($cover_artistes[2])) ? $cover_artistes[2][0]->artiste_3 : set_value('artiste3'), 'placeholder="Nom du musicien ou du groupe"');
                    echo form_error('artiste3', '<span class="error-form">', '</span>');
                    
                    echo form_label('Artiste n°4', 'artiste4', $label_attributes);
                    echo form_input('artiste4', $cover_name4 = (!empty($cover_artistes[3])) ? $cover_artistes[3][0]->artiste_4 : set_value('artiste4'), 'placeholder="Nom du musicien ou du groupe"');
                    echo form_error('artiste4', '<span class="error-form">', '</span>');
                    
                    echo form_label('Artiste n°5', 'artiste5', $label_attributes);
                    echo form_input('artiste5', $cover_name5 = (!empty($cover_artistes[4])) ? $cover_artistes[4][0]->artiste_5 : set_value('artiste5'), 'placeholder="Nom du musicien ou du groupe"');
                    echo form_error('artiste5', '<span class="error-form">', '</span>');
            
                    echo form_submit('submit', 'Enregistrer');
                    echo form_error('submit', '<span class="error-form">', '</span>');

                echo form_close();
            ?>
        </div>
    </div>
</div>
