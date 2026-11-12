<?php
require '../includes/app.php'; $message=''; $image='';
if ($_SERVER['REQUEST_METHOD']==='POST') {
    check_post(); $f=$_FILES['ufile'] ?? null;
    if (!$f || $f['error']!==UPLOAD_ERR_OK) $message='Upload thất bại: chưa chọn ảnh, ảnh quá lớn hoặc tệp tải lên chưa hoàn tất.';
    elseif ($f['size']>5000000) $message='Ảnh không được vượt quá 5.000.000 byte.';
    else {
        $mime=(new finfo(FILEINFO_MIME_TYPE))->file($f['tmp_name']);
        $allowed=['image/jpeg'=>['jpg','jpeg'],'image/gif'=>['gif'],'image/png'=>['png']];
        $ext=strtolower(pathinfo($f['name'],PATHINFO_EXTENSION));
        if (!isset($allowed[$mime]) || !in_array($ext,$allowed[$mime],true) || !getimagesize($f['tmp_name'])) $message='Chỉ nhận ảnh JPG, GIF, PNG hợp lệ.';
        else {
            $name=bin2hex(random_bytes(16)).'.'.$ext;
            if (move_uploaded_file($f['tmp_name'],__DIR__.'/uploads/'.$name)) { $image='uploads/'.$name; $message='Đã tải ảnh '.basename($f['name']).' thành công. Tên lưu ngẫu nhiên để tránh trùng.'; }
            else $message='Không lưu được ảnh. Kiểm tra quyền ghi thư mục uploads.';
        }
    }
}
page('Bài 9 · Upload hình ảnh'); if($message) notice($message);
?>
<form method="post" enctype="multipart/form-data"><?php csrf(); ?><input type="hidden" name="MAX_FILE_SIZE" value="5000000"><label>Chọn ảnh JPG, GIF hoặc PNG (tối đa 5 MB)<input type="file" name="ufile" accept="image/jpeg,image/gif,image/png" required></label><button>Upload ảnh</button></form>
<?php if($image): ?><section><img class="preview" src="<?= e($image) ?>" alt="Ảnh vừa tải lên"><p>Đường dẫn: <?= e($image) ?></p></section><?php endif; endpage(); ?>
