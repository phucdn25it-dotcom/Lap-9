<?php
require __DIR__.'/includes/app.php';
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    check_post(); $c = require __DIR__.'/config.php';
    try {
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $c['database'])) throw new RuntimeException('Tên cơ sở dữ liệu không hợp lệ.');
        $pdo = new PDO("mysql:host={$c['host']};port={$c['port']};charset=utf8mb4",$c['user'],$c['password'],[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
        $pdo->exec('CREATE DATABASE IF NOT EXISTS `'.$c['database'].'` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');
        $pdo->exec('USE `'.$c['database'].'`');
        $pdo->exec(file_get_contents(__DIR__.'/database.sql'));
        $news = $pdo->prepare('INSERT IGNORE INTO tintuc (id,title) VALUES (?,?)');
        for ($i=1;$i<=105;$i++) $news->execute([$i,'Tin số '.$i.' — Thực hành lập trình PHP và MySQL']);
        $s=$pdo->prepare('INSERT IGNORE INTO users (username,password_hash) VALUES (?,?)');
        $s->execute(['admin',password_hash('admin123',PASSWORD_DEFAULT)]);
        $message='Khởi tạo thành công. Tài khoản mẫu: admin / admin123. Dữ liệu đã có được giữ nguyên.';
    } catch (Throwable $ex) { $message='Không khởi tạo được. Hãy bật MySQL và kiểm tra config.php. Chi tiết: '.$ex->getMessage(); }
}
page('Khởi tạo dữ liệu Lab 9'); if ($message) notice($message);
?>
<p>Bật MySQL trong XAMPP trước khi tiếp tục. Thao tác này chỉ tạo cơ sở dữ liệu riêng cho Lab 9 và bổ sung dữ liệu mẫu còn thiếu.</p>
<form method="post"><?php csrf(); ?><button>Khởi tạo dữ liệu mẫu</button></form>
<?php endpage(); ?>
