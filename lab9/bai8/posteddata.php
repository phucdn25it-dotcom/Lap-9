<?php require '../includes/app.php'; check_post(); page('Bài 8 · Nội dung đã gửi'); ?>
<?php foreach (['tomtat'=>'Tóm tắt','noidung'=>'Nội dung'] as $key=>$label): if (!is_string($_POST[$key] ?? null)) continue; ?>
<section><h2><?= e($label) ?></h2><iframe title="<?= e($label) ?>" sandbox srcdoc="<?= e('<meta charset="utf-8">'.$_POST[$key]) ?>" style="width:100%;height:220px;border:1px solid #ddd"></iframe><details><summary>Mã HTML</summary><pre><?= e($_POST[$key]) ?></pre></details></section>
<?php endforeach ?><a href="index.php">Quay lại bài 8</a><?php endpage(); ?>
