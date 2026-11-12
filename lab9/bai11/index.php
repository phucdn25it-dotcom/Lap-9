<?php
require '../includes/app.php';
$total=(int)query('SELECT COUNT(*) FROM tintuc')->fetchColumn(); $limit=10; $pages=max(1,(int)ceil($total/$limit));
$page=filter_input(INPUT_GET,'page',FILTER_VALIDATE_INT); $page=max(1,min($pages,$page?:1)); $offset=($page-1)*$limit;
$rows=query("SELECT * FROM tintuc ORDER BY id LIMIT $limit OFFSET $offset")->fetchAll();
page('Bài 11 · Phân trang tin tức'); ?>
<p><?= $total ?> tin · 10 tin mỗi trang · Trang <?= $page ?>/<?= $pages ?></p><table><tr><th>ID</th><th>Tiêu đề</th></tr>
<?php foreach($rows as $row): ?><tr><td><?= $row['id'] ?></td><td><?= e($row['title']) ?></td></tr><?php endforeach ?></table>
<?php if(!$rows) notice('Chưa có tin tức. Hãy chạy trang khởi tạo dữ liệu.'); ?>
<nav aria-label="Phân trang"><?php if($page>1): ?><a href="?page=1">Đầu</a><a href="?page=<?= $page-1 ?>">Trước</a><?php endif ?>
<?php for($i=max(1,$page-2);$i<=min($pages,$page+2);$i++): if($i===$page): ?><strong aria-current="page"><?= $i ?></strong><?php else: ?><a href="?page=<?= $i ?>"><?= $i ?></a><?php endif; endfor ?>
<?php if($page<$pages): ?><a href="?page=<?= $page+1 ?>">Sau</a><a href="?page=<?= $pages ?>">Cuối</a><?php endif ?></nav><?php endpage(); ?>
