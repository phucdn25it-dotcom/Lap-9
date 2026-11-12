<?php require '../includes/app.php'; check_post(); unset($_SESSION['user']); session_regenerate_id(true); go('dangnhap.php');
