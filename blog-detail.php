<?php

require_once __DIR__ . '/config/functions.php';

/*
|--------------------------------------------------------------------------
| Get Blog Slug
|--------------------------------------------------------------------------
*/
$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';

if ($slug === '') {
    http_response_code(404);
    $blog = null;
} else {

    /*
    |--------------------------------------------------------------------------
    | Get Blog
    |--------------------------------------------------------------------------
    */
    $stmt = db()->prepare("
        SELECT 
            b.*,
            c.name AS category_name,
            c.slug AS category_slug
        FROM blogs b
        LEFT JOIN blog_categories c 
            ON c.id = b.category_id
        WHERE 
            b.slug = ?
            AND b.status = 'published'
            AND (
                b.publish_date IS NULL 
                OR b.publish_date <= NOW()
            )
        LIMIT 1
    ");

    $stmt->execute([$slug]);
    $blog = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$blog) {
        http_response_code(404);
    }
}


/*
|--------------------------------------------------------------------------
| Page Meta
|--------------------------------------------------------------------------
*/
if ($blog) {

    $pageTitle = !empty($blog['meta_title'])
        ? $blog['meta_title']
        : $blog['title'];

    $pageDescription = !empty($blog['meta_description'])
        ? $blog['meta_description']
        : (!empty($blog['short_description'])
            ? $blog['short_description']
            : 'Vancouver Bengali Club Charitable Society Editorial');

} else {

    $pageTitle = 'Blog Not Found';
    $pageDescription = 'The requested editorial could not be found.';
}


/*
|--------------------------------------------------------------------------
| Recent Blogs
|--------------------------------------------------------------------------
*/
$recentBlogs = [];

if ($blog) {

    $recentStmt = db()->prepare("
        SELECT 
            b.id,
            b.title,
            b.slug,
            b.short_description,
            b.featured_image,
            b.publish_date
        FROM blogs b
        WHERE 
            b.status = 'published'
            AND b.id != ?
            AND (
                b.publish_date IS NULL 
                OR b.publish_date <= NOW()
            )
        ORDER BY 
            b.publish_date DESC,
            b.id DESC
        LIMIT 5
    ");

    $recentStmt->execute([$blog['id']]);
    $recentBlogs = $recentStmt->fetchAll(PDO::FETCH_ASSOC);

} else {

    $recentStmt = db()->query("
        SELECT 
            b.id,
            b.title,
            b.slug,
            b.short_description,
            b.featured_image,
            b.publish_date
        FROM blogs b
        WHERE 
            b.status = 'published'
            AND (
                b.publish_date IS NULL 
                OR b.publish_date <= NOW()
            )
        ORDER BY 
            b.publish_date DESC,
            b.id DESC
        LIMIT 5
    ");

    $recentBlogs = $recentStmt->fetchAll(PDO::FETCH_ASSOC);
}


/*
|--------------------------------------------------------------------------
| Categories
|--------------------------------------------------------------------------
*/
$categories = [];

try {

    $catStmt = db()->query("
        SELECT 
            c.id,
            c.name,
            c.slug,
            COUNT(b.id) AS total
        FROM blog_categories c
        LEFT JOIN blogs b
            ON b.category_id = c.id
            AND b.status = 'published'
            AND (
                b.publish_date IS NULL
                OR b.publish_date <= NOW()
            )
        WHERE c.status = 'active'
        GROUP BY c.id, c.name, c.slug
        ORDER BY c.name ASC
    ");

    $categories = $catStmt->fetchAll(PDO::FETCH_ASSOC);

} catch (Exception $e) {

    $categories = [];
}


/*
|--------------------------------------------------------------------------
| Image Helper
|--------------------------------------------------------------------------
*/
function blog_image_url($image)
{
    if (empty($image)) {
        return '';
    }

    /*
    | If database already contains complete URL
    */
    if (
        strpos($image, 'http://') === 0 ||
        strpos($image, 'https://') === 0
    ) {
        return $image;
    }

    /*
    | Remove starting slash
    */
    $image = ltrim($image, '/');

    /*
    | Existing uploads path
    */
    if (strpos($image, 'uploads/') === 0) {
        return '/' . $image;
    }

    /*
    | If only filename is stored
    */
    return '/uploads/blogs/' . $image;
}


/*
|--------------------------------------------------------------------------
| Safe date
|--------------------------------------------------------------------------
*/
function blog_date($date)
{
    if (empty($date)) {
        return '';
    }

    $timestamp = strtotime($date);

    if (!$timestamp) {
        return '';
    }

    return date('F d, Y', $timestamp);
}


/*
|--------------------------------------------------------------------------
| Read Time
|--------------------------------------------------------------------------
*/
$readTime = '5 min read';

if ($blog && !empty($blog['read_time'])) {
    $readTime = $blog['read_time'];
}

?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <meta
        name="description"
        content="<?= htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8'); ?>"
    >

    <meta
        name="theme-color"
        content="#2b0000"
    >

<link rel="icon" href="/assets/images/favicon.png">

    <title>
        <?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?>
        | Vancouver Bengali Club Charitable Society
    </title>


    <!-- =========================================================
         BOOTSTRAP
    ========================================================== -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <!-- =========================================================
         FONT AWESOME
    ========================================================== -->

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    >


    <!-- =========================================================
         GOOGLE FONTS
    ========================================================== -->

    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700;800&display=swap"
        rel="stylesheet"
    >


    <!-- =========================================================
         MAIN WEBSITE CSS
         IMPORTANT: ROOT RELATIVE PATH
    ========================================================== -->

<link rel="stylesheet" href="/css/style.css">


    <!-- =========================================================
         BLOG DETAIL CSS
    ========================================================== -->
<link rel="stylesheet" href="/css/blog.css">
<link rel="stylesheet" href="/css/blog-detail.css">

</head>


<body class="blog-detail-body">


<?php include_once __DIR__ . '/include/header.php'; ?>


<?php include_once __DIR__ . '/include/breadcrumb.php'; ?>

<!-- =========================================================
     BLOG DETAIL
========================================================== -->

<main class="blog-detail-wrapper">


<?php if (!$blog): ?>


    <!-- 404 -->
    <section class="blog-not-found-section">

        <div class="container">

            <div class="blog-not-found">

                <div class="not-found-icon">
                    <i class="fa-regular fa-file-lines"></i>
                </div>

                <h1>Editorial Not Found</h1>

                <p>
                    Sorry, the editorial you are looking for
                    could not be found or may have been removed.
                </p>

                <a
                    href="/editorials"
                    class="blog-primary-btn"
                >
                    <i class="fa-solid fa-arrow-left"></i>
                    Back to Editorials
                </a>

            </div>

        </div>

    </section>


<?php else: ?>


    <!-- =====================================================
         ARTICLE AREA
    ====================================================== -->

    <section class="blog-detail-section">

        <div class="container">

            <div class="blog-detail-grid">


                <!-- =================================================
                     LEFT CONTENT
                ================================================== -->

                <article class="blog-main-content">


                    <!-- Category -->

                    <?php if (!empty($blog['category_name'])): ?>

                        <a
                            href="/editorials?category=<?= urlencode($blog['category_slug']); ?>"
                            class="blog-category-badge"
                        >
                            <?= htmlspecialchars(
                                $blog['category_name'],
                                ENT_QUOTES,
                                'UTF-8'
                            ); ?>
                        </a>

                    <?php endif; ?>


                    <!-- Title -->

                    <h1 class="blog-detail-title">

                        <?= htmlspecialchars(
                            $blog['title'],
                            ENT_QUOTES,
                            'UTF-8'
                        ); ?>

                    </h1>


                    <!-- Meta -->

                    <div class="blog-detail-meta">

                        <span>
                            <i class="fa-regular fa-user"></i>

                            By
                            <?= htmlspecialchars(
                                $blog['author'] ?: 'VBCCS Editorial Team',
                                ENT_QUOTES,
                                'UTF-8'
                            ); ?>
                        </span>

                        <span class="meta-separator">•</span>

                        <span>
                            <i class="fa-regular fa-calendar"></i>

                            <?= blog_date($blog['publish_date']); ?>
                        </span>

                        <span class="meta-separator">•</span>

                        <span>
                            <i class="fa-regular fa-clock"></i>

                            <?= htmlspecialchars(
                                $readTime,
                                ENT_QUOTES,
                                'UTF-8'
                            ); ?>
                        </span>

                    </div>


                    <!-- Featured Image -->

                    <?php

                    $featuredImage = blog_image_url(
                        $blog['featured_image'] ?? ''
                    );

                    ?>

                    <?php if (!empty($featuredImage)): ?>

                        <div class="blog-featured-image-wrap">

                            <img
                                src="<?= htmlspecialchars(
                                    $featuredImage,
                                    ENT_QUOTES,
                                    'UTF-8'
                                ); ?>"
                                alt="<?= htmlspecialchars(
                                    $blog['title'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ); ?>"
                                class="blog-featured-image"
                            >

                        </div>

                    <?php endif; ?>


                    <!-- Short Description -->

                    <?php if (!empty($blog['short_description'])): ?>

                        <div class="blog-introduction">

                            <?= nl2br(
                                htmlspecialchars(
                                    $blog['short_description'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                )
                            ); ?>

                        </div>

                    <?php endif; ?>


                    <!-- =================================================
                         BLOG CONTENT
                         IMPORTANT:
                         DO NOT htmlspecialchars() this field.
                         Editor HTML must render.
                    ================================================== -->

                    <div class="blog-article-content">

                        <?= $blog['content']; ?>

                    </div>


                    <!-- Bottom Category -->

                    <?php if (!empty($blog['category_name'])): ?>

                        <div class="blog-bottom-category">

                            <span>Category:</span>

                            <a
                                href="/editorials?category=<?= urlencode($blog['category_slug']); ?>"
                            >
                                <?= htmlspecialchars(
                                    $blog['category_name'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ); ?>
                            </a>

                        </div>

                    <?php endif; ?>


                </article>


                <!-- =================================================
                     RIGHT SIDEBAR
                ================================================== -->

                <aside class="blog-sidebar">


                    <!-- Recent Editorials -->

                    <div class="sidebar-card">

                        <div class="sidebar-heading">

                            <span class="sidebar-heading-line"></span>

                            <h2>Recent Editorials</h2>

                        </div>


                        <div class="recent-editorials">

                            <?php if (!empty($recentBlogs)): ?>

                                <?php foreach ($recentBlogs as $recent): ?>

                                    <a
                                        href="/blog/<?= rawurlencode($recent['slug']); ?>"
                                        class="recent-editorial-item"
                                    >

                                        <span class="recent-title">

                                            <?= htmlspecialchars(
                                                $recent['title'],
                                                ENT_QUOTES,
                                                'UTF-8'
                                            ); ?>

                                        </span>


                                        <?php if (!empty($recent['short_description'])): ?>

                                            <span class="recent-description">

                                                <?= htmlspecialchars(
                                                    mb_strimwidth(
                                                        strip_tags(
                                                            $recent['short_description']
                                                        ),
                                                        0,
                                                        105,
                                                        '...'
                                                    ),
                                                    ENT_QUOTES,
                                                    'UTF-8'
                                                ); ?>

                                            </span>

                                        <?php endif; ?>

                                    </a>

                                <?php endforeach; ?>

                            <?php else: ?>

                                <p class="sidebar-empty">
                                    No recent editorials available.
                                </p>

                            <?php endif; ?>

                        </div>

                    </div>


                    <!-- Categories -->

                    <div class="sidebar-card">

                        <div class="sidebar-heading">

                            <span class="sidebar-heading-line"></span>

                            <h2>Blog Categories</h2>

                        </div>


                        <div class="sidebar-categories">

                            <?php if (!empty($categories)): ?>

                                <?php foreach ($categories as $category): ?>

                                    <a
                                        href="/editorials?category=<?= urlencode($category['slug']); ?>"
                                    >

                                        <span>
                                            <?= htmlspecialchars(
                                                $category['name'],
                                                ENT_QUOTES,
                                                'UTF-8'
                                            ); ?>
                                        </span>

                                        <span class="category-count">
                                            <?= (int)$category['total']; ?>
                                        </span>

                                    </a>

                                <?php endforeach; ?>

                            <?php else: ?>

                                <p class="sidebar-empty">
                                    No categories available.
                                </p>

                            <?php endif; ?>

                        </div>

                    </div>


                    <!-- Subscribe -->

                    <div class="sidebar-card subscribe-card">

                        <div class="sidebar-heading">

                            <span class="sidebar-heading-line"></span>

                            <h2>Subscribe to Our Editorial</h2>

                        </div>

                        <p>
                            Receive new editorial stories and
                            community updates.
                        </p>


                        <form
                            action="#"
                            method="post"
                            class="subscribe-form"
                            onsubmit="return false;"
                        >

                            <input
                                type="email"
                                name="email"
                                placeholder="Enter your email"
                                required
                            >

                            <button type="submit">

                                <span>Sign Up</span>

                                <i class="fa-solid fa-arrow-right"></i>

                            </button>

                        </form>

                    </div>


                </aside>


            </div>

        </div>

    </section>


<?php endif; ?>


</main>



<?php include_once __DIR__ . '/include/footer.php'; ?>

<script src="/js/main.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  
  <script>
$(document).ready(function () {

    $('.sponsor-carousel').owlCarousel({
        loop: true,
        margin: 20,
        nav: false,
        dots: false,
        autoplay: true,
        autoplayTimeout: 2500,
        autoplayHoverPause: true,
        smartSpeed: 800,

        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 2
            },
            768: {
                items: 3
            },
            992: {
                items: 4
            },
            1200: {
                items: 3
            }
        }
    });

});
</script>
<!-- =========================================================
     BOOTSTRAP JS
========================================================== -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
></script>

</body>
</html>