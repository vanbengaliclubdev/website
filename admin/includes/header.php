<?php require_once dirname(__DIR__,2) . '/config/functions.php'; require_admin(); $pageTitle = $pageTitle ?? 'Blog Dashboard'; ?>
<!doctype html><html lang="en"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($pageTitle) ?> | VBCCS Admin</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
<link href="assets/admin.css" rel="stylesheet">
</head><body class="admin-body">
<div class="admin-shell">
<aside class="sidebar" id="sidebar">
<div class="brand"><img src="../assets/logo.png" alt="VBCCS"><div><strong>VBCCS</strong><span>Blog Manager</span></div></div>
<nav>
<a href="index.php" class="<?= basename($_SERVER['PHP_SELF'])==='index.php'?'active':'' ?>"><i class="fa-solid fa-chart-pie"></i> Dashboard</a>
<a href="blogs.php" class="<?= in_array(basename($_SERVER['PHP_SELF']),['blogs.php','blog-form.php'])?'active':'' ?>"><i class="fa-regular fa-newspaper"></i> Blogs</a>
<a href="categories.php" class="<?= in_array(basename($_SERVER['PHP_SELF']),['categories.php','category-form.php'])?'active':'' ?>"><i class="fa-solid fa-folder-tree"></i> Categories</a>
<a href="../editorial.php" target="_blank"><i class="fa-solid fa-arrow-up-right-from-square"></i> View Website</a>
</nav>
<div class="sidebar-bottom"><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></div>
</aside>
<main class="admin-main">
<header class="topbar"><button class="sidebar-toggle" onclick="document.getElementById('sidebar').classList.toggle('show')"><i class="fa-solid fa-bars"></i></button><div><h1><?= e($pageTitle) ?></h1><span>Manage your editorial content</span></div><a href="blog-form.php" class="btn btn-primary"><i class="fa-solid fa-plus me-1"></i> Add Blog</a></header>
<div class="content-wrap">
<?php if($flash=get_flash()): ?><div class="alert alert-<?= e($flash['type']) ?> alert-dismissible fade show"><?= e($flash['message']) ?><button class="btn-close" data-bs-dismiss="alert"></button></div><?php endif; ?>
