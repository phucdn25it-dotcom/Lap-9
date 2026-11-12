<?php
require '../includes/app.php'; check_post();
$name=is_string($_POST['username']??null)?trim($_POST['username']):'';
$user=query('SELECT * FROM users WHERE username=?',[$name])->fetch();
if (!$user || !is_string($_POST['password']??null) || !password_verify($_POST['password'],$user['password_hash'])) go('dangnhap.php?error=1');
session_regenerate_id(true); $_SESSION['user']=['id'=>$user['id'],'username'=>$user['username']];
setcookie('lab9_username',isset($_POST['remember'])?$name:'',['expires'=>isset($_POST['remember'])?time()+2592000:time()-3600,'path'=>dirname($_SERVER['SCRIPT_NAME']),'httponly'=>true,'samesite'=>'Lax']);
go('trangquantriadmin.php');
