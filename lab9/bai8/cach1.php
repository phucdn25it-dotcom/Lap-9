<?php require '../includes/app.php'; require 'editor.php'; page('Bài 8 · Cách 1 dùng JavaScript'); editor_assets(); ?>
<form method="post" action="posteddata.php"><?php csrf(); ?><label for="tomtat">Tóm tắt</label><textarea id="tomtat" name="tomtat">Chào mừng bạn đến với CKEditor!</textarea><button>Gửi nội dung</button></form>
<script>attachEditor(document.querySelector('#tomtat'));</script>
<?php endpage(); ?>
