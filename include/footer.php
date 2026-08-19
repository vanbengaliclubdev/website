 <!-- Footer -->
  <footer class="site-footer">
    <div class="container">
      <div class="row g-5">
        <div class="col-lg-4">
          <img src="assets/logo.png" alt="VBCCS" class="footer-logo">
          <p class="footer-about">
            Vancouver Bengali Club Charitable Society is committed to building healthier,
            stronger and more inclusive communities through service, wellness, sports,
            education, culture and connection.
          </p>
          <div class="social-row footer-social">
            <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
            <a href="#" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
            <a href="#" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
          </div>
        </div>

        <div class="col-6 col-lg-2">
          <h4>Explore</h4>
          <a href="#about">About Us</a>
          <a href="#programs">Programs </a>
          <a href="#events">Events</a>
          <a href="#news">Our Team </a>
        </div>

        <div class="col-6 col-lg-2">
          <h4>Get Involved</h4>
          <a href="#membership">Volunteer </a>
          <a href="#volunteers">Donate </a>
           <a href="#volunteers">Sponsors </a>
          <a href="#sponsors">Contact Us </a>
        </div>

        <div class="col-lg-4">
          <h4>Contact</h4>
          <p><i class="fa-regular fa-envelope"></i> info@vancouverbengaliclub.com </p>
           <p><i class="fa-regular fa-envelope"></i> treasurer@vancouverbengaliclub.com  </p>
          <p><i class="fa-solid fa-location-dot"></i> Vancouver, British Columbia</p>
          <a class="footer-donate" href="#donate">Support Our Mission <i class="fa-solid fa-arrow-right"></i></a>
        </div>
      </div>

      <div class="footer-bottom">
        <span>© 2026 Vancouver Bengali Club Charitable Society. All rights reserved.</span>
        <span>Designed by<a href="https://attractivewebsolutions.com/" target="_blank"> AWS</a></span>
      </div>
    </div>
  </footer>

  <button class="back-to-top" id="backToTop" aria-label="Back to top"><i class="fa-solid fa-arrow-up"></i></button>

  <div class="toast-message" id="formToast">
    <i class="fa-solid fa-circle-check"></i>
    <span>Thank you! Your message has been captured in this demo.</span>
  </div>
<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/main.js"></script>
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
</body>
</html>
