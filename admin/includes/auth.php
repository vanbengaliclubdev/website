<?php require_once dirname(__DIR__,2) . '/config/functions.php';
if (admin_logged_in()) redirect(ADMIN_URL . '/index.php');
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $username = trim($_POST['username'] ?? ''); $password = $_POST['password'] ?? '';
    $st = db()->prepare("SELECT * FROM users WHERE username=? AND status='active' LIMIT 1"); $st->execute([$username]); $user = $st->fetch();
    if ($user && password_verify($password, $user['password'])) { session_regenerate_id(true); $_SESSION['admin_id']=$user['id']; $_SESSION['admin_name']=$user['name']; redirect(ADMIN_URL . '/index.php'); }
    $error='Invalid username or password.';
}
?>
