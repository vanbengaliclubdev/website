<?php require_once dirname(__DIR__) . '/config/functions.php'; $_SESSION=[]; session_destroy(); redirect(ADMIN_URL.'/login.php');
