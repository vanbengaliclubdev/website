<?php

declare(strict_types=1);

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

// =====================================================
// PHPMailer
// =====================================================

// If you installed PHPMailer manually:
require __DIR__ . 'PHPMailer/src/Exception.php';
require __DIR__ . 'PHPMailer/src/PHPMailer.php';
require __DIR__ . 'PHPMailer/src/SMTP.php';

// If using Composer instead, use this:
// require __DIR__ . '/vendor/autoload.php';


// =====================================================
// ONLY ALLOW POST REQUEST
// =====================================================

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed');
}


// =====================================================
// HELPER FUNCTIONS
// =====================================================

function clean_input(string $value): string
{
    return trim(strip_tags($value));
}

function redirect_with_status(string $status): void
{
    header('Location: contact.php?status=' . urlencode($status));
    exit;
}


// =====================================================
// GET FORM DATA
// =====================================================

$name = clean_input($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = clean_input($_POST['phone'] ?? '');
$subject = clean_input($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');


// =====================================================
// VALIDATION
// =====================================================

// Name
if ($name === '') {
    redirect_with_status('name_required');
}

if (mb_strlen($name) < 2 || mb_strlen($name) > 100) {
    redirect_with_status('invalid_name');
}


// Email
if ($email === '') {
    redirect_with_status('email_required');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    redirect_with_status('invalid_email');
}


// Phone - optional
if ($phone !== '') {

    // Allows +, numbers, spaces, -, (, )
    if (!preg_match('/^[0-9+\-\s()]{7,20}$/', $phone)) {
        redirect_with_status('invalid_phone');
    }
}


// Subject - optional
if ($subject !== '' && mb_strlen($subject) > 200) {
    redirect_with_status('invalid_subject');
}


// Message
if ($message === '') {
    redirect_with_status('message_required');
}

if (mb_strlen($message) < 10) {
    redirect_with_status('short_message');
}

if (mb_strlen($message) > 5000) {
    redirect_with_status('long_message');
}


// =====================================================
// BASIC ANTI-SPAM CHECK
// =====================================================

// Block suspicious header injection attempts
$combinedInput = $name . ' ' . $email . ' ' . $subject . ' ' . $message;

if (
    preg_match('/[\r\n]/', $email) ||
    preg_match('/[\r\n]/', $subject)
) {
    redirect_with_status('invalid_input');
}


// =====================================================
// SMTP CONFIGURATION
// =====================================================

$smtpHost = 'mail.vancouverbengaliclub.com';

$smtpUsername = 'YOUR_EMAIL@vancouverbengaliclub.com';

$smtpPassword = 'YOUR_EMAIL_PASSWORD';

$smtpPort = 587;


// =====================================================
// EMAIL CONFIGURATION
// =====================================================

// Where you want to receive enquiries
$adminEmail = 'YOUR_RECEIVING_EMAIL@gmail.com';

// Sender email should normally be the same SMTP account
$fromEmail = $smtpUsername;

$fromName = 'Vancouver Bengali Club';


// =====================================================
// CREATE PHPMailer
// =====================================================

$mail = new PHPMailer(true);

try {

    // =================================================
    // SMTP SETTINGS
    // =================================================

    $mail->isSMTP();

    $mail->Host = $smtpHost;

    $mail->SMTPAuth = true;

    $mail->Username = $smtpUsername;

    $mail->Password = $smtpPassword;

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    $mail->Port = $smtpPort;

    $mail->CharSet = 'UTF-8';


    // =================================================
    // SENDER
    // =================================================

    $mail->setFrom(
        $fromEmail,
        $fromName
    );


    // =================================================
    // ADMIN / WEBSITE OWNER
    // =================================================

    $mail->addAddress(
        $adminEmail,
        'Vancouver Bengali Club'
    );


    // =================================================
    // REPLY TO VISITOR
    // =================================================

    $mail->addReplyTo(
        $email,
        $name
    );


    // =================================================
    // EMAIL SUBJECT
    // =================================================

    $emailSubject = $subject !== ''
        ? 'Website Enquiry: ' . $subject
        : 'New Website Enquiry';


    $mail->Subject = $emailSubject;


    // =================================================
    // HTML EMAIL
    // =================================================

    $safeName = htmlspecialchars(
        $name,
        ENT_QUOTES,
        'UTF-8'
    );

    $safeEmail = htmlspecialchars(
        $email,
        ENT_QUOTES,
        'UTF-8'
    );

    $safePhone = htmlspecialchars(
        $phone !== '' ? $phone : 'Not provided',
        ENT_QUOTES,
        'UTF-8'
    );

    $safeSubject = htmlspecialchars(
        $subject !== '' ? $subject : 'Not provided',
        ENT_QUOTES,
        'UTF-8'
    );

    $safeMessage = nl2br(
        htmlspecialchars(
            $message,
            ENT_QUOTES,
            'UTF-8'
        )
    );


    $mail->isHTML(true);

    $mail->Body = '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>New Website Enquiry</title>
    </head>

    <body style="
        margin:0;
        padding:20px;
        background:#f5f5f5;
        font-family:Arial,Helvetica,sans-serif;
    ">

        <div style="
            max-width:650px;
            margin:auto;
            background:#ffffff;
            border-radius:8px;
            overflow:hidden;
            border:1px solid #e5e5e5;
        ">

            <div style="
                background:#003b66;
                color:#ffffff;
                padding:22px;
            ">
                <h2 style="margin:0;">
                    New Website Enquiry
                </h2>
            </div>

            <div style="padding:25px;">

                <p>
                    <strong>Name:</strong><br>
                    ' . $safeName . '
                </p>

                <p>
                    <strong>Email:</strong><br>
                    ' . $safeEmail . '
                </p>

                <p>
                    <strong>Phone:</strong><br>
                    ' . $safePhone . '
                </p>

                <p>
                    <strong>Subject:</strong><br>
                    ' . $safeSubject . '
                </p>

                <p>
                    <strong>Message:</strong><br>
                    ' . $safeMessage . '
                </p>

            </div>

            <div style="
                background:#f7f7f7;
                padding:15px 25px;
                font-size:12px;
                color:#666;
            ">
                This enquiry was submitted through
                Vancouver Bengali Club website.
            </div>

        </div>

    </body>
    </html>
    ';


    // =================================================
    // PLAIN TEXT VERSION
    // =================================================

    $mail->AltBody =
        "New Website Enquiry\n\n" .
        "Name: " . $name . "\n" .
        "Email: " . $email . "\n" .
        "Phone: " . ($phone ?: 'Not provided') . "\n" .
        "Subject: " . ($subject ?: 'Not provided') . "\n\n" .
        "Message:\n" . $message;


    // =================================================
    // SEND
    // =================================================

    $mail->send();


    // =================================================
    // SUCCESS
    // =================================================

    redirect_with_status('success');


} catch (Exception $e) {

    // Do not expose SMTP credentials or technical errors
    // to the visitor.

    error_log(
        'VBC Contact Form Error: ' . $mail->ErrorInfo
    );

    redirect_with_status('error');
}
