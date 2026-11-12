<?php
require '../includes/app.php';
if ($_SERVER['REQUEST_METHOD']==='POST') { check_post(); $age=filter_input(INPUT_POST,'age',FILTER_VALIDATE_INT,['options'=>['min_range'=>0,'max_range'=>150]]); if (is_string($_POST['name']??null) && trim($_POST['name'])!=='' && $age!==false && $age!==null) { $_SESSION['name']=trim($_POST['name']); $_SESSION['age']=$age; } }
page('Bài 10 · Lưu tên và tuổi');
?>
<form method="post"><?php csrf(); ?><label>Tên <input name="name" value="<?= e($_SESSION['name']??'hocweb.com.vn') ?>" required maxlength="100"></label><label>Tuổi <input name="age" type="number" min="0" max="150" value="<?= e($_SESSION['age']??20) ?>" required></label><button>Lưu SESSION</button></form><a href="test_session.php">Đọc session ở trang khác →</a>
<?php endpage(); ?>
