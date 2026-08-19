# VBCCS Blog System — Installation

This package adds a Core PHP/MySQL editorial/blog CMS without replacing the existing VBCCS header, footer or front-end styles.

## 1. Upload
Copy the package files into the same public root where `index.php`, `include/`, `assets/` and `css/` already exist.

## 2. Database
Create a MySQL database and import:

`database/vbccs_blog.sql`

The SQL creates:
- `users`
- `blog_categories`
- `blogs`

It also inserts sample categories, sample published blogs and an admin user.

## 3. Database credentials
Edit:

`config/config.php`

Set:

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'your_database');
define('DB_USER', 'your_user');
define('DB_PASS', 'your_password');
define('SITE_URL', 'https://your-domain.com');
```

## 4. Upload folder permission
Make sure:

`uploads/blogs/`

is writable by PHP. Usually `755` works; use `775` only if your hosting requires it.

## 5. Admin login
Open:

`/admin/login.php`

Default credentials:

- Username: `admin`
- Password: `Admin@123`

Change the password after installation by updating the `users.password` hash or adding a password-management page.

## 6. Public pages
- `/editorial.php` — blog listing
- `/blog-detail.php?slug=...` — blog detail
- `/editorial.php?category=community` — category-wise listing

The existing `include/header.php` already links to `editorial.php`.

## 7. Optional SEO-friendly URLs
The current package works without URL rewriting. If your existing `.htaccess` is known and safe to modify, you can later add rewrite rules for `/blog/slug` and `/blog/category/slug`. Do not overwrite an existing `.htaccess` blindly.

## 8. Security notes
- Admin routes require a session.
- Forms use CSRF tokens.
- Database operations use PDO prepared statements.
- Uploaded blog images are MIME-checked and limited to 5 MB.
- Category deletion is blocked when blogs are assigned.
- Blog content is passed through a basic HTML allowlist.
