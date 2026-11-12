<?php require '../includes/app.php'; if (!isset($_SESSION['user'])) go('dangnhap.php?required=1'); page('Bài 10 · Trang quản trị'); notice('Xin chào '.$_SESSION['user']['username']); ?>
<p>Trang này chỉ truy cập được sau khi đăng nhập thành công.</p><form action="logout.php" method="post"><?php csrf(); ?><button>Đăng xuất</button></form>
<?php endpage(); ?>
