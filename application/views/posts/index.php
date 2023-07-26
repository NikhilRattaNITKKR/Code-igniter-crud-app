<h2> <?=$title ?></h2>

<?php foreach($posts as $item) : ?>
    <h3> <?= $item['title'] ?> </h3>
    <small><?= 'Created at '. $item['created_at'] ?></small>
    <p>
        <?= $item['body'] ?>
    </p>
    <a class="btn btn-primary" href="<?= site_url('/posts/'.$item['slug'])?>"> Read more </a>

<?php   endforeach ?>


