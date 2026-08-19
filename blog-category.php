<?php
$slug = trim($_GET['slug'] ?? '');
header('Location: editorial.php?category=' . urlencode($slug));
exit;
