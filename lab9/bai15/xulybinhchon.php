<?php
require '../includes/app.php'; check_post();
$id=filter_input(INPUT_POST,'idBC',FILTER_VALIDATE_INT); $option=filter_input(INPUT_POST,'idPA',FILTER_VALIDATE_INT);
$pdo=db(); $pdo->beginTransaction();
try {
    $poll=query('SELECT idBC FROM binhchon WHERE idBC=? AND AnHien=1 FOR UPDATE',[$id])->fetch();
    if(!$poll) throw new RuntimeException('Bình chọn không tồn tại.');
    $s=query('UPDATE phuongan SET SoLanChon=SoLanChon+1 WHERE idPA=? AND idBC=?',[$option,$id]);
    if($s->rowCount()!==1) throw new RuntimeException('Phương án không thuộc bình chọn này.');
    query('UPDATE binhchon SET SoLanChon=SoLanChon+1 WHERE idBC=?',[$id]); $pdo->commit();
} catch(Throwable $ex) { $pdo->rollBack(); http_response_code(400); exit('Không ghi nhận được bình chọn: '.e($ex->getMessage())); }
go('ketquabinhchon.php?idBC='.$id);
