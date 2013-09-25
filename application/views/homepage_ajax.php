<?php
setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
$session_id = $this->session->userdata('uid');
?>

<?php foreach ($articles as $article): ?>
    <div class="wall-flux-content" >
        <p class="wall-flux-content-title">
            <?php echo $article->titre; ?>
        </p>

        <p class="wall-flux-content-subtitle">
            Publié par Slyset, le <?php echo strftime("%A %d %B %Y à %Hh%M ", strtotime($article->updated)); ?>
        </p>

        <div class="wall-flux-content-text">
            <?php echo htmlspecialchars_decode($article->article); ?>
            
            <div class="partage">
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo current_url(); ?>" target="_blank"><span class="facebook"></span></a>
                <a href="https://twitter.com/share?text=<?php echo $article->titre; ?> - Slyset <?php echo current_url() ?>"><span class="twitter"></span></a>
                <a href="https://plus.google.com/share?url=<?php echo current_url(); ?>" ><span class="google"></span></a>
            </div>
        </div>
    </div>
<?php endforeach; ?>