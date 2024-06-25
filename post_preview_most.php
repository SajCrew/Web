<div class="box">
    <img src="<?= $post['image_url'] ?>" alt="img" class="box-images">
    <div class="box-information">
        <div class="box-text">
            <a class="box-title" href='/post.php?id=<?= $post['post_id'] ?>'><?= $post['title'] ?></a>
            <p class="box-description"><?=$post['subtitle']?></p>
        </div>
        <div class="box-footer">
            <div class="box-context">
                <img class="avatar" src=<?=$post['author_url']?> alt="img">
                <p class="context_author"><?=$post['author']?></p>
            </div>
            <h6 class="box-data"><?=date('n/d/Y', strtotime($post['publish_date']))?></h6>
        </div>
    </div>
</div>