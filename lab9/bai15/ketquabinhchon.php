<?php
require '../includes/app.php'; $id=filter_input(INPUT_GET,'idBC',FILTER_VALIDATE_INT)?:1;
$poll=query('SELECT * FROM binhchon WHERE idBC=? AND AnHien=1',[$id])->fetch();
if(!$poll) { http_response_code(404); page('Không tìm thấy bình chọn'); endpage(); exit; }
$options=query('SELECT * FROM phuongan WHERE idBC=? ORDER BY idPA',[$id])->fetchAll(); $total=array_sum(array_column($options,'SoLanChon'));
page('Bài 15 · Kết quả bình chọn'); ?>
<section><h2><?= e($poll['MoTa']) ?></h2><table class="poll-results"><tr><th>Phương án</th><th>Tỉ lệ</th><th>Số lượt</th></tr>
<?php foreach($options as $option): $percent=$total?$option['SoLanChon']/$total*100:0; ?><tr><td><?= e($option['MoTa']) ?></td><td><div class="poll-rate"><progress aria-label="Tỉ lệ <?= e($option['MoTa']) ?>" value="<?= $percent ?>" max="100"></progress><span><?= round($percent,2) ?>%</span></div></td><td><?= $option['SoLanChon'] ?></td></tr><?php endforeach ?></table><p>Tổng số lượt bình chọn: <?= $total ?></p></section><a href="index.php?idBC=<?= $id ?>">← Quay lại bình chọn</a><?php endpage(); ?>
