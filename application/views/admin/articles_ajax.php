<?php
$session_id = $this->session->userdata('uid');
?>

<?php foreach ($articles as $article): ?>
    <tr>
        <td class="article-checkbox checkbox-style2"><input type="checkbox" name="checkarticle[]" value="<?php echo $article->id ?>" id="article-<?php echo $article->id ?>" class="checkbox-article" /><?php echo form_label('', "article-$article->id") ?></td>
        <td class="article-title"><?php echo $article->titre ?><div class="article-actions"><a href="<?php echo site_url('admin_articles/update_article/' . $article->id); ?>">Modifier</a> | <a href="<?php echo site_url('admin_articles/delete_article/' . $article->id); ?>">Supprimer</a></div></td>
        <td class="article-middle"><?php echo date('d-m-Y H:i', strtotime(str_replace('-', '/', $article->updated))) ?></td>
    </tr>
<?php endforeach; ?>
