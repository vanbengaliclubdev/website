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
 <section class="vbc-contact-section">

    <div class="vbc-contact-container">

        <!-- LEFT CONTACT INFORMATION -->
        <div class="vbc-contact-info">

            <span class="vbc-section-label">CONTACT US</span>

            <h2>
                We'd love to<br>
                hear from you.
            </h2>

            <p class="vbc-contact-intro">
                Whether you would like to learn more about our programs,
                get involved with our community, volunteer, or simply reach
                out to us, we are always happy to hear from you.
            </p>

            <!-- EMAIL -->
            <div class="vbc-contact-item">

                <div class="vbc-contact-icon">
                    <i class="fas fa-envelope"></i>
                </div>

                <div>
                    <span>Email Us</span>

                    <a href="mailto:info@vancouverbengaliclub.com">
                        info@vancouverbengaliclub.com
                    </a>
                </div>

            </div>


            <!-- TREASURER -->
            <div class="vbc-contact-item">

                <div class="vbc-contact-icon">
                    <i class="fas fa-envelope"></i>
                </div>

                <div>
                    <span>Treasurer</span>

                    <a href="mailto:treasurer@vancouverbengaliclub.com">
                        treasurer@vancouverbengaliclub.com
                    </a>
                </div>

            </div>


            <!-- LOCATION -->
            <div class="vbc-contact-item">

                <div class="vbc-contact-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>

                <div>
                    <span>Our Location</span>

                    <p>Vancouver, British Columbia</p>
                </div>

            </div>


            <!-- LOGO -->
            <div class="vbc-contact-logo">
                <img src="assets/logo.png" alt="Vancouver Bengali Club Charitable Society">
            </div>

        </div>


        <!-- RIGHT FORM -->
        <div class="vbc-contact-form-wrapper">

            <div class="vbc-form-heading">

                <span class="vbc-section-label">GET IN TOUCH</span>

                <h3>Send us a message</h3>

                <p>
                    Have a question or want to connect with us?
                    Fill out the form and our team will get back to you.
                </p>

            </div>


            <form class="vbc-contact-form" action="#" method="post">

                <div class="vbc-form-row">

                    <div class="vbc-form-group">

                        <label for="vbc-name">
                            Your Name <span>*</span>
                        </label>

                        <input
                            type="text"
                            id="vbc-name"
                            name="name"
                            placeholder="Enter your name"
                            required
                        >

                    </div>


                    <div class="vbc-form-group">

                        <label for="vbc-email">
                            Email Address <span>*</span>
                        </label>

                        <input
                            type="email"
                            id="vbc-email"
                            name="email"
                            placeholder="Enter your email"
                            required
                        >

                    </div>

                </div>


                <div class="vbc-form-row">

                    <div class="vbc-form-group">

                        <label for="vbc-phone">
                            Phone Number
                        </label>

                        <input
                            type="tel"
                            id="vbc-phone"
                            name="phone"
                            placeholder="Enter your phone number"
                        >

                    </div>


                    <div class="vbc-form-group">

                        <label for="vbc-subject">
                            Subject
                        </label>

                        <input
                            type="text"
                            id="vbc-subject"
                            name="subject"
                            placeholder="How can we help?"
                        >

                    </div>

                </div>


                <div class="vbc-form-group">

                    <label for="vbc-message">
                        Your Message <span>*</span>
                    </label>

                    <textarea
                        id="vbc-message"
                        name="message"
                        rows="6"
                        placeholder="Write your message here..."
                        required
                    ></textarea>

                </div>


                <button type="submit" class="vbc-submit-btn">

                    Send Message

                    <span>
                        <i class="fas fa-arrow-right"></i>
                    </span>

                </button>

            </form>

        </div>

    </div>

</section>
</main>


<?php include_once 'include/footer.php'; ?>
 