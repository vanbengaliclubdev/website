<?php $pageTitle='Dashboard'; require_once __DIR__.'/includes/header.php';
$pdo=db();
$stats=[
 'blogs'=>(int)$pdo->query("SELECT COUNT(*) FROM blogs")->fetchColumn(),
 'published'=>(int)$pdo->query("SELECT COUNT(*) FROM blogs WHERE status='published'")->fetchColumn(),
 'drafts'=>(int)$pdo->query("SELECT COUNT(*) FROM blogs WHERE status='draft'")->fetchColumn(),
 'categories'=>(int)$pdo->query("SELECT COUNT(*) FROM blog_categories")->fetchColumn(),
];
$recent=$pdo->query("SELECT b.*,c.name category_name FROM blogs b JOIN blog_categories c ON c.id=b.category_id ORDER BY b.created_at DESC LIMIT 8")->fetchAll();
?>
<div class="stats-grid"><div class="stat-card"><span>Total Blogs</span><strong><?=$stats['blogs']?></strong><i class="fa-regular fa-newspaper"></i></div><div class="stat-card"><span>Published</span><strong><?=$stats['published']?></strong><i class="fa-solid fa-circle-check"></i></div><div class="stat-card"><span>Drafts</span><strong><?=$stats['drafts']?></strong><i class="fa-solid fa-file-pen"></i></div><div class="stat-card"><span>Categories</span><strong><?=$stats['categories']?></strong><i class="fa-solid fa-folder-tree"></i></div></div>
<div class="panel"><div class="panel-head"><div><h3>Recent Blogs</h3><p>Latest content added to your editorial system.</p></div><a href="blogs.php" class="btn btn-outline-primary btn-sm">View all</a></div><div class="table-responsive"><table class="table align-middle"><thead><tr><th>Blog</th><th>Category</th><th>Status</th><th>Date</th><th></th></tr></thead><tbody><?php foreach($recent as $b): ?><tr><td><strong><?=e($b['title'])?></strong><div class="small text-muted">/<?=e($b['slug'])?></div></td><td><?=e($b['category_name'])?></td><td><span class="status <?=e($b['status'])?>"><?=ucfirst(e($b['status']))?></span></td><td><?=date('d M Y',strtotime($b['publish_date']))?></td><td><a class="btn btn-sm btn-light" href="blog-form.php?id=<?=$b['id']?>"><i class="fa-solid fa-pen"></i></a></td></tr><?php endforeach; ?></tbody></table></div></div>
<?php require_once __DIR__.'/includes/footer.php'; ?>
