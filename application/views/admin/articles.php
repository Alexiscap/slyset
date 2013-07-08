<div id="contentAll">

    <div id="breadcrumbs">
        <ul>
            <li><a href="#">Accueil</a></li>
            <li><a href="#">Administration</a></li>
            <li><a href="#">Actualités à la une</a></li>
        </ul>
    </div>

    <div class="content contentAdmin">
        <h2 id="title-dashboard">Actualités à la une</h2>
        
        <p>Cette page vous permet de gérer et rédiger vos articles d'actualité ou de fond.</p>
        
        <a href="#open" id="wysiwyg-link" class="new_article btn_admin">Nouvel article</a>
  
        <div id="wysiwyg-block" style="display:none;">
            <h2>Nouvel article</h2>

            <?php
                echo form_open('admin_articles/add_article');

                    echo form_input('title', set_value('title'), 'placeholder="Titre de l\'article"');
                    echo form_error('title', '<span class="error-form">', '</span>');

                    echo form_textarea('article', set_value('article'), 'placeholder="Corps de l\'article" id="redactor"');
                    echo form_error('article', '<span class="error-form">', '</span>');

                    echo form_submit('submit','Publier l\'article');
                    echo form_error('submit', '<span class="error-form">', '</span>');

                echo form_close();
            ?>
        </div>
        
        <div id="articles-tab">
            <?php            
                echo form_open('admin_articles/delete_multi_article');
            ?>
          
                <table>
                    <tr class="tab-head">
                        <th class="article-checkbox checkbox-style2"><input type="checkbox" name="article-all" value="all" class="check_all checkbox-article" id="article-all"/><?php echo form_label('', "article-all") ?></th>
                        <th class="article-title">Titre de l'article<span id="titre" class="filter filter-bottom"></span></th>
                        <th class="article-date">Date<span id="created" class="filter filter-bottom"></span></th>
                    </tr>

                    <?php foreach($articles as $article): ?>
                        <tr>
                            <td class="article-checkbox checkbox-style2"><input type="checkbox" name="checkarticle[]" value="<?php print $article->id ?>" id="article-<?php print $article->id ?>" class="checkbox-article" /><?php echo form_label('', "article-$article->id") ?></td>
                            <td class="article-title"><?php print $article->titre ?><div class="article-actions"><a href="<?php print site_url('admin_articles/update_article/'.$article->id); ?>">Modifier</a> | <a href="<?php print site_url('admin_articles/delete_article/'.$article->id); ?>">Supprimer</a></div></td>
                            <td class="article-date"><?php print date('d-m-Y H:i', strtotime(str_replace('-', '/', $article->updated)))?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php
                    echo form_submit('submit','Supprimer');
                    echo form_error('submit', '<span class="error-form">', '</span>');

                echo form_close();
            ?>
          
            <?php            
//            foreach($articles as $article){
////              print_r($article);
//              echo $article->titre.'<br/>';
//              echo $article->article.'<br/>';
//              echo $article->created.'<br/>';
//              echo '<br/><br/>';
//            } 
            ?>
        </div>
    </div>
</div>
