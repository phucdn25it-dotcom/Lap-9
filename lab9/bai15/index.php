<?php
require '../includes/app.php'; $id=filter_input(INPUT_GET,'idBC',FILTER_VALIDATE_INT)?:1;
$poll=query('SELECT * FROM binhchon WHERE idBC=? AND AnHien=1',[$id])->fetch();
if(!$poll) { http_response_code(404); page('Không tìm thấy bình chọn'); endpage(); exit; }
$options=query('SELECT * FROM phuongan WHERE idBC=? ORDER BY idPA',[$id])->fetchAll();
page('Bài 15 · Bình chọn trực tuyến'); ?>
<nav><?php foreach(query('SELECT * FROM binhchon WHERE AnHien=1 ORDER BY ThuTu,idBC') as $item): ?><a href="?idBC=<?= $item['idBC'] ?>"><?= e($item['MoTa']) ?></a><?php endforeach ?></nav>
<form method="post" action="xulybinhchon.php"><?php csrf(); ?><h2><?= e($poll['MoTa']) ?></h2><input type="hidden" name="idBC" value="<?= $id ?>">
<?php foreach($options as $i=>$option): ?><label><input type="radio" name="idPA" value="<?= $option['idPA'] ?>" <?= $i===0?'checked':'' ?> required> <?= e($option['MoTa']) ?></label><?php endforeach ?>
<?php if($options): ?><button>Bình chọn</button><?php endif ?><a href="ketquabinhchon.php?idBC=<?= $id ?>">Xem kết quả</a></form><?php endpage(); ?>
