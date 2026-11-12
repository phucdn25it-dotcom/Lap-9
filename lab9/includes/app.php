<?php
session_name('php_lab9');
session_start();
function e($value) { return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }
function token() { return $_SESSION['csrf'] ?? ($_SESSION['csrf'] = bin2hex(random_bytes(24))); }
function csrf() { echo '<input type="hidden" name="csrf" value="'.e(token()).'">'; }
function check_post() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !is_string($_POST['csrf'] ?? null) || !hash_equals(token(), $_POST['csrf'])) {
        http_response_code(400); exit('Yêu cầu không hợp lệ. Vui lòng quay lại biểu mẫu.');
    }
}
function db() {
    static $pdo;
    if (!$pdo) {
        $c = require __DIR__.'/../config.php';
        try { $pdo = new PDO("mysql:host={$c['host']};port={$c['port']};dbname={$c['database']};charset=utf8mb4", $c['user'], $c['password'], [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES=>false]); }
        catch (PDOException $ex) { http_response_code(503); exit('Chưa kết nối được cơ sở dữ liệu. Hãy bật MySQL, kiểm tra config.php và chạy lab9/setup.php.'); }
    }
    return $pdo;
}
function query($sql, $params = []) { $s = db()->prepare($sql); $s->execute($params); return $s; }
function go($url) { header('Location: '.$url, true, 303); exit; }
function page($title) {
    $base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
    if (preg_match('~/bai\d+$~', $base)) $base = rtrim(str_replace('\\', '/', dirname($base)), '/');
    $current = preg_match('~/bai(\d+)/~', $_SERVER['SCRIPT_NAME'], $match) ? (int)$match[1] : 0;
    echo '<!doctype html><html lang="vi"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>'.e($title).'</title><link rel="stylesheet" href="'.e($base).'/assets/style.css?v=20261112-3"></head><body><header class="site-header"><div class="header-inner"><a class="brand" href="'.e($base).'/index.php"><span class="brand-mark">&lt;/&gt;</span><span>Thực hành PHP<small>LẬP TRÌNH WEB · LAB 9</small></span></a><a class="header-link" href="'.e($base).'/index.php">Danh sách bài ↗</a></div></header><div class="site-layout"><aside class="sidebar"><p class="nav-caption">NỘI DUNG THỰC HÀNH</p><nav class="lesson-nav" aria-label="Các bài thực hành">';
    foreach ([8=>'Soạn thảo văn bản',9=>'Upload hình ảnh',10=>'Session & đăng nhập',11=>'Phân trang dữ liệu',12=>'Đánh giá sản phẩm',13=>'Nguồn tin RSS',14=>'Mã CAPTCHA',15=>'Bình chọn'] as $number=>$label) {
        echo '<a href="'.e($base).'/bai'.$number.'/index.php"'.($current===$number?' class="active" aria-current="page"':'').'><span class="nav-number">'.$number.'</span><span>'.e($label).'</span></a>';
    }
    echo '</nav><div class="sidebar-note"><span class="status-dot"></span> PHP & MySQL<p>Học qua từng bài thực hành.</p></div></aside><main><div class="page-heading"><p class="eyebrow">'.($current?'BÀI THỰC HÀNH / '.str_pad((string)$current,2,'0',STR_PAD_LEFT):'GÓC THỰC HÀNH').'</p><h1>'.e($title).'</h1></div>';
}
function endpage() { echo '<footer><span>Thực hành lập trình web</span><span>Lab 9 · PHP & MySQL</span></footer></main></div></body></html>'; }
function notice($text) { echo '<p class="notice" role="status">'.e($text).'</p>'; }
