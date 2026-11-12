<?php require '../includes/app.php'; require 'editor.php'; page('Bài 8 · Cách 2 dùng PHP'); editor_assets(); ?>
<form method="post" action="posteddata.php"><?php csrf(); ?><label class="editor-label" for="tomtat">Tóm tắt</label><textarea id="tomtat" name="tomtat"></textarea><label class="editor-label" for="noidung">Nội dung</label><textarea id="noidung" name="noidung"></textarea><button>Gửi nội dung</button></form>
<?php editor_replace_all(); endpage(); ?>
