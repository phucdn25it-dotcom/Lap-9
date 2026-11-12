<?php require '../includes/app.php'; $news=query('SELECT * FROM news ORDER BY id DESC')->fetchAll(); page('Bài 13 · RSS cho trang web'); ?>
<a class="button" href="rss.php">Mở nguồn RSS 2.0</a>
<?php foreach($news as $item): ?><section><h2><a href="<?= e($item['link']) ?>"><?= e($item['title']) ?></a></h2><p><?= e($item['description']) ?></p></section><?php endforeach; endpage(); ?>
