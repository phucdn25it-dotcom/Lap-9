<?php require '../includes/app.php'; page('Bài 10 · Đọc SESSION');
notice(isset($_SESSION['name']) ? 'Chào bạn '.$_SESSION['name'].', tuổi: '.$_SESSION['age'] : 'Chưa có thông tin trong session.'); ?>
<form method="post" action="huy_session.php"><?php csrf(); ?><button name="mode" value="name">Xóa tên</button><button name="mode" value="all">Xóa toàn bộ phiên</button></form><p>Tuổi còn lưu: <?= e($_SESSION['age']??'Chưa có') ?></p><a href="session.php">Quay lại nhập thông tin</a>
<?php endpage(); ?>
