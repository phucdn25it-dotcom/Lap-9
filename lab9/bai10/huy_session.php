<?php require '../includes/app.php'; check_post(); if (($_POST['mode']??'')==='all') { $_SESSION=[]; session_destroy(); } else unset($_SESSION['name']); go('test_session.php');
