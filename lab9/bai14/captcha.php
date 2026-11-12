<?php
require '../includes/app.php';
$alphabet='ABCDEFGHJKLMNPQRSTUVWXYZabcdefghjkmnpqrstuvwxyz23456789';$code='';for($i=0;$i<6;$i++) $code.=$alphabet[random_int(0,strlen($alphabet)-1)];
$_SESSION['captcha']=$code; header('Content-Type: image/svg+xml; charset=UTF-8'); header('Cache-Control: no-store, no-cache, must-revalidate');
echo '<svg xmlns="http://www.w3.org/2000/svg" width="210" height="65" viewBox="0 0 210 65"><rect width="210" height="65" fill="#e7edf5"/>';
for($i=0;$i<9;$i++) echo '<path d="M'.random_int(0,210).' '.random_int(0,65).' L'.random_int(0,210).' '.random_int(0,65).'" stroke="#a6b3c6"/>';
for($i=0;$i<6;$i++) { $x=18+$i*30; $y=random_int(39,49); echo '<text x="'.$x.'" y="'.$y.'" transform="rotate('.random_int(-14,14).' '.$x.' '.$y.')" font-family="monospace" font-weight="bold" font-size="32" fill="#17334f">'.$code[$i].'</text>'; }
echo '</svg>';
