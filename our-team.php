<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Vancouver Bengali Club Charitable Society — building healthier, stronger and more inclusive communities through sports, wellness, charitable service and cultural programs.">
  <link rel="icon" type="image/png" href="assets/images/favicon.png">
  <meta name="theme-color" content="#2b0000">
  <title>VBCCS | Vancouver Bengali Club Charitable Society</title>

  <!-- Bootstrap 5.3.8 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

  <link rel="stylesheet" href="css/style.css">
</head>

<body>
<?php include_once 'include/header.php'; ?>

<?php include_once __DIR__ . '/include/breadcrumb.php'; ?>

<main id="home">
  <!-- Leadership -->
    <section class="section-padding leadership-section">
      <div class="container">
        <div class="text-center section-heading">
          <div class="section-kicker">Our Leadership</div>
          <h2 class="section-title">Our  <em>Team</em></h2>
          <p class="section-subtitle">Professional profile cards are ready for board photos, biographies and official emails.</p>
        </div>

        <div class="row g-4 mt-2" id="leadershipCards">
          <div class="col-sm-6 col-lg-3">
            <article class="leader-card">
              <div class="leader-photo"><img src="assets/avijit-das.jpeg" class="w-100" alt=""></div>
              <div class="leader-info"><h3>Avijit </h3><span>President</span><a href="mailto:info@example.com"><i class="fa-regular fa-envelope"></i></a></div>
            </article>
          </div>
          <div class="col-sm-6 col-lg-3">
            <article class="leader-card">
              <div class="leader-photo"><i class="fa-solid fa-user"></i></div>
              <div class="leader-info"><h3>Board Member</h3><span>Vice President</span><a href="mailto:info@example.com"><i class="fa-regular fa-envelope"></i></a></div>
            </article>
          </div>
          <div class="col-sm-6 col-lg-3">
            <article class="leader-card">
              <div class="leader-photo"><i class="fa-solid fa-user"></i></div>
              <div class="leader-info"><h3>Board Member</h3><span>Secretary</span><a href="mailto:info@example.com"><i class="fa-regular fa-envelope"></i></a></div>
            </article>
          </div>
          <div class="col-sm-6 col-lg-3">
            <article class="leader-card">
              <div class="leader-photo"><i class="fa-solid fa-user"></i></div>
              <div class="leader-info"><h3>Board Member</h3><span>Treasurer</span><a href="mailto:info@example.com"><i class="fa-regular fa-envelope"></i></a></div>
            </article>
          </div>
        </div>

        <div class="advisory-row" id="advisory">
          <div>
            <div class="section-kicker">Advisory Board</div>
            <h3>Guidance with purpose.</h3>
            <p>Our Advisory Board provides strategic guidance and experience to help VBCCS grow its community impact.</p>
          </div>
          <div class="advisory-person"><i class="fa-solid fa-user-shield"></i><span>Advisor Profile</span></div>
          <div class="advisory-person"><i class="fa-solid fa-user-shield"></i><span>Advisor Profile</span></div>
          <div class="advisory-person"><i class="fa-solid fa-user-shield"></i><span>Advisor Profile</span></div>
        </div>
      </div>
    </section>
</main>


<?php include_once 'include/footer.php'; ?>
 