<?php
require '../includes/app.php'; $id=filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);
if (isset($_GET['id']) && (!$id || $id<1)) { http_response_code(404); page('Không tìm thấy sản phẩm'); endpage(); exit; }
if ($_SERVER['REQUEST_METHOD']==='POST') {
    check_post(); $rate=filter_input(INPUT_POST,'rate',FILTER_VALIDATE_INT);
    if (!$id || !$rate || $rate<1 || $rate>5 || !query('SELECT id FROM products WHERE id=?',[$id])->fetch()) { http_response_code(400); exit('Sản phẩm hoặc số sao không hợp lệ.'); }
    query("INSERT INTO rating_info (product_id,rate_$rate) VALUES (?,1) ON DUPLICATE KEY UPDATE rate_$rate=rate_$rate+1",[$id]);
    go('index.php?id='.$id.'&rated=1');
}
$sql='SELECT p.*,r.rate_1,r.rate_2,r.rate_3,r.rate_4,r.rate_5 FROM products p LEFT JOIN rating_info r ON r.product_id=p.id';
$products=query($sql.($id?' WHERE p.id=?':' ORDER BY p.id'),$id?[$id]:[])->fetchAll();
if($id && !$products) http_response_code(404);
page('Bài 12 · Đánh giá sản phẩm'); if(isset($_GET['rated'])) notice('Đã ghi nhận đánh giá của bạn.');
if(!$products) notice('Không tìm thấy sản phẩm.');
foreach($products as $p): $total=0;$sum=0;for($n=1;$n<=5;$n++){ $total+=(int)$p['rate_'.$n];$sum+=$n*(int)$p['rate_'.$n]; } ?>
<section><img class="preview" src="<?= e($p['img_url']) ?>" alt="<?= e($p['title']) ?>"><h2><a href="?id=<?= $p['id'] ?>"><?= e($p['title']) ?></a></h2><p class="stars">★ <?= $total?number_format($sum/$total,2):'0.00' ?>/5 · <?= $total ?> lượt đánh giá</p>
<?php for($n=5;$n>=1;$n--): ?><p><?= $n ?> sao <progress value="<?= (int)$p['rate_'.$n] ?>" max="<?= max(1,$total) ?>"></progress> <?= (int)$p['rate_'.$n] ?> lượt</p><?php endfor ?>
<?php if($id): ?><form method="post"><?php csrf(); ?><fieldset><legend>Chọn mức đánh giá</legend><?php for($n=5;$n>=1;$n--): ?><label><input type="radio" name="rate" value="<?= $n ?>" <?= $n===5?'checked':'' ?>> <?= $n ?> sao</label><?php endfor ?></fieldset><button name="rate_submit">Gửi đánh giá</button></form><?php endif ?></section>
<?php endforeach; if($id): ?><a href="index.php">← Danh sách sản phẩm</a><?php endif; endpage(); ?>
