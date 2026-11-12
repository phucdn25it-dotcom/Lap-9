<?php
require '../includes/app.php'; $message='';
if($_SERVER['REQUEST_METHOD']==='POST') {
    check_post(); $input=$_POST['input']??''; $saved=$_SESSION['captcha']??null;
    $message=is_string($input) && is_string($saved) && hash_equals($saved,$input)?'Nhập CAPTCHA chính xác!':'CAPTCHA sai hoặc hết hiệu lực. Vui lòng thử mã mới.';
    unset($_SESSION['captcha']);
}
page('Bài 14 · Kiểm tra CAPTCHA'); if($message) notice($message); ?>
<form method="post"><?php csrf(); ?><p>Nhập chính xác chữ hoa, chữ thường và chữ số trong ảnh.</p><p><img id="captcha" src="captcha.php?v=<?= bin2hex(random_bytes(6)) ?>" alt="Mã CAPTCHA cần nhập" width="210" height="65"></p><button type="button" onclick="document.getElementById('captcha').src='captcha.php?v='+Date.now()">Đổi mã</button><label>Mã CAPTCHA <input name="input" required autocomplete="off" maxlength="6"></label><button name="submit">Kiểm tra</button></form>
<?php endpage(); ?>
