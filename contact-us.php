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


           <?php
// Show success/error message
$status = $_GET['status'] ?? '';
$message = $_GET['message'] ?? '';
?>

<?php if ($status === 'success'): ?>
    <div class="vbc-alert vbc-success">
        <?php echo htmlspecialchars($message); ?>
    </div>
<?php elseif ($status === 'error'): ?>
    <div class="vbc-alert vbc-error">
        <?php echo htmlspecialchars($message); ?>
    </div>
<?php endif; ?>


<form class="vbc-contact-form" action="mail.php" method="POST" novalidate>

    <!-- CSRF/basic hidden field -->
    <input type="hidden" name="form_token" value="vbc_contact_form">

    <div class="vbc-form-row">

        <!-- Name -->
        <div class="vbc-form-group">

            <label for="vbc-name">
                Your Name <span>*</span>
            </label>

            <input
                type="text"
                id="vbc-name"
                name="name"
                placeholder="Enter your name"
                maxlength="100"
                required
            >

            <small class="vbc-error-text" id="name-error"></small>

        </div>


        <!-- Email -->
        <div class="vbc-form-group">

            <label for="vbc-email">
                Email Address <span>*</span>
            </label>

            <input
                type="email"
                id="vbc-email"
                name="email"
                placeholder="Enter your email"
                maxlength="150"
                required
            >

            <small class="vbc-error-text" id="email-error"></small>

        </div>

    </div>


    <div class="vbc-form-row">

        <!-- Phone -->
        <div class="vbc-form-group">

            <label for="vbc-phone">
                Phone Number
            </label>

            <input
                type="tel"
                id="vbc-phone"
                name="phone"
                placeholder="Enter your phone number"
                maxlength="20"
            >

            <small class="vbc-error-text" id="phone-error"></small>

        </div>


        <!-- Subject -->
        <div class="vbc-form-group">

            <label for="vbc-subject">
                Subject
            </label>

            <input
                type="text"
                id="vbc-subject"
                name="subject"
                placeholder="How can we help?"
                maxlength="200"
            >

        </div>

    </div>


    <!-- Message -->
    <div class="vbc-form-group">

        <label for="vbc-message">
            Your Message <span>*</span>
        </label>

        <textarea
            id="vbc-message"
            name="message"
            rows="6"
            maxlength="3000"
            placeholder="Write your message here..."
            required
        ></textarea>

        <small class="vbc-error-text" id="message-error"></small>

    </div>


    <!-- Submit -->
    <button type="submit" class="vbc-submit-btn" id="vbc-submit-btn">

        <span class="vbc-btn-text">
            Send Message
        </span>

        <span>
            <i class="fas fa-arrow-right"></i>
        </span>

    </button>

</form>


<style>

.vbc-alert {
    padding: 15px 20px;
    margin-bottom: 25px;
    border-radius: 6px;
    font-size: 15px;
}

.vbc-success {
    background: #e8f8ee;
    color: #18733c;
    border: 1px solid #b7e4c7;
}

.vbc-error {
    background: #fff0f0;
    color: #b42318;
    border: 1px solid #f5c2c0;
}

.vbc-error-text {
    display: block;
    color: #d92d20;
    font-size: 13px;
    margin-top: 5px;
}

.vbc-form-group input.vbc-invalid,
.vbc-form-group textarea.vbc-invalid {
    border-color: #d92d20 !important;
}

.vbc-form-group input.vbc-valid,
.vbc-form-group textarea.vbc-valid {
    border-color: #12b76a !important;
}

.vbc-submit-btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

</style>
        </div>

    </div>

</section>
</main>


<?php include_once 'include/footer.php'; ?>
<script>

document.addEventListener("DOMContentLoaded", function () {

    const form = document.querySelector(".vbc-contact-form");

    if (!form) return;

    const name = document.getElementById("vbc-name");
    const email = document.getElementById("vbc-email");
    const phone = document.getElementById("vbc-phone");
    const message = document.getElementById("vbc-message");

    const nameError = document.getElementById("name-error");
    const emailError = document.getElementById("email-error");
    const phoneError = document.getElementById("phone-error");
    const messageError = document.getElementById("message-error");

    const submitButton = document.getElementById("vbc-submit-btn");
    const buttonText = submitButton.querySelector(".vbc-btn-text");


    function setError(input, errorElement, text) {

        input.classList.add("vbc-invalid");
        input.classList.remove("vbc-valid");
        errorElement.textContent = text;

    }


    function setValid(input, errorElement) {

        input.classList.remove("vbc-invalid");
        input.classList.add("vbc-valid");
        errorElement.textContent = "";

    }


    function validateName() {

        const value = name.value.trim();

        if (value === "") {

            setError(name, nameError, "Please enter your name.");
            return false;

        }

        if (value.length < 2) {

            setError(name, nameError, "Name must be at least 2 characters.");
            return false;

        }

        if (!/^[a-zA-Z\s.'-]+$/.test(value)) {

            setError(name, nameError, "Please enter a valid name.");
            return false;

        }

        setValid(name, nameError);
        return true;

    }


    function validateEmail() {

        const value = email.value.trim();

        const emailPattern =
            /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;

        if (value === "") {

            setError(email, emailError, "Please enter your email address.");
            return false;

        }

        if (!emailPattern.test(value)) {

            setError(email, emailError, "Please enter a valid email address.");
            return false;

        }

        setValid(email, emailError);
        return true;

    }


    function validatePhone() {

        const value = phone.value.trim();

        if (value === "") {

            phone.classList.remove("vbc-invalid");
            phone.classList.remove("vbc-valid");
            phoneError.textContent = "";

            return true;

        }

        if (!/^[0-9+\-\s()]{7,20}$/.test(value)) {

            setError(
                phone,
                phoneError,
                "Please enter a valid phone number."
            );

            return false;

        }

        setValid(phone, phoneError);
        return true;

    }


    function validateMessage() {

        const value = message.value.trim();

        if (value === "") {

            setError(
                message,
                messageError,
                "Please enter your message."
            );

            return false;

        }

        if (value.length < 10) {

            setError(
                message,
                messageError,
                "Message must be at least 10 characters."
            );

            return false;

        }

        setValid(message, messageError);
        return true;

    }


    name.addEventListener("input", validateName);
    email.addEventListener("input", validateEmail);
    phone.addEventListener("input", validatePhone);
    message.addEventListener("input", validateMessage);


    form.addEventListener("submit", function (event) {

        const validName = validateName();
        const validEmail = validateEmail();
        const validPhone = validatePhone();
        const validMessage = validateMessage();

        if (
            !validName ||
            !validEmail ||
            !validPhone ||
            !validMessage
        ) {

            event.preventDefault();

            return;

        }


        submitButton.disabled = true;

        buttonText.textContent = "Sending...";

    });

});

</script> 
