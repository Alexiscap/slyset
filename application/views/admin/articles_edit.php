<?php
$session_id = $this->session->userdata('uid');
?>

<div id="contentAll">
    <div id="breadcrumbs">
        <ul>
            <li><a href="<?php echo site_url('home/'.$session_id); ?>">Accueil</a></li>
            <li><a href="<?php echo site_url('admin'); ?>">Administration</a></li>
            <li><a href="<?php echo site_url($this->uri->segment(1)); ?>">Actualités à la une</a></li>
            <li><a href="<?php echo site_url($this->uri->segment(1) . '/editer' . $article->id); ?>">Edition de "<?php echo $article->titre; ?>"</a></li>
        </ul>
    </div>
  
    <div class="content contentAdmin">
        <h2 id="title-dashboard">Edition de <?php echo $article->titre ?></h2>
        
        <p>Cette page vous permet de mettre à jour votre article.</p>
        
        <a href="<?php echo site_url('admin_articles'); ?>" id="back-articles" class="btn_admin">Retour aux articles</a>
  
        <div id="edit-block">
            <?php
                echo form_open('admin_articles/update_article/'.$article->id);

                    echo form_input('title', $article->titre, 'placeholder="Titre de l\'article"');
                    echo form_error('title', '<span class="error-form">', '</span>');

                    echo form_textarea('article', $article->article, 'placeholder="Corps de l\'article" id="redactor"');
                    echo form_error('article', '<span class="error-form">', '</span>');

                    echo form_submit('submit','Editer l\'article');
                    echo form_error('submit', '<span class="error-form">', '</span>');

                echo form_close();
            ?>
        </div>
    </div>
</div>
