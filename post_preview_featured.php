<div class="card" style="background-image: url(<?=$post['image_url'] ?>);">
    <div class="tag tag-<?= $post['tag_type'] ?>">
        <p class="teg_text"><?= $post['tag_text'] ?></p>
    </div>
    <div class="card-text">
        <a class="card-title" href='/post.php?id=<?= $post['post_id'] ?>'> <?= $post['title'] ?> </a>
        <p class="card-description"><?=$post['subtitle']?></p>
            <div class="card-context">
                <img class="avatar" src=<?=$post['author_url']?>>
                <p class="context_author"><?=$post['author']?></p>
            </div>
        <p class="card-data"><?=date('F j,Y', strtotime($post['publish_date']))?></p>
    </div>
</div>
