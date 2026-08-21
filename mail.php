<?php

declare(strict_types=1);

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

// =====================================================
// ERROR REPORTING
// =====================================================

error_reporting(E_ALL);
ini_set('display_errors', '0');

// =====================================================
// PHPMailer
// =====================================================

require __DIR__ . '/PHPMailer/src/Exception.php';
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';

// =====================================================
// ONLY ALLOW POST REQUEST
// =====================================================

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo 'Invalid request method.';
    exit;
}

// =====================================================
// GET FORM DATA
// =====================================================

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');

// =====================================================
// VALIDATION
// =====================================================

// Name
if ($name === '') {
    http_response_code(400);
    echo 'Please enter your name.';
    exit;
}

if (mb_strlen($name) < 2) {
    http_response_code(400);
    echo 'Please enter a valid name.';
    exit;
}

// Email
if ($email === '') {
    http_response_code(400);
    echo 'Please enter your email address.';
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo 'Please enter a valid email address.';
    exit;
}

// Phone - optional, but validate if entered
if ($phone !== '') {

    $cleanPhone = preg_replace('/[^0-9+\-\s()]/', '', $phone);

    if ($cleanPhone !== $phone) {
        http_response_code(400);
        echo 'Please enter a valid phone number.';
        exit;
    }
}

// Message
if ($message === '') {
    http_response_code(400);
    echo 'Please enter your message.';
    exit;
}

if (mb_strlen($message) < 5) {
    http_response_code(400);
    echo 'Please enter a meaningful message.';
    exit;
}

// =====================================================
// SANITIZE SUBJECT
// =====================================================

$subject = $subject !== ''
    ? $subject
    : 'New Contact Form Enquiry';

$subject = preg_replace('/[\r\n]+/', ' ', $subject);

// =====================================================
// CREATE PHPMailer OBJECT
// =====================================================

$mail = new PHPMailer(true);

try {

    // =================================================
    // SMTP SETTINGS
    // =================================================

    $mail->isSMTP();

    /*
     * -------------------------------------------------
     * OPTION 1: GMAIL SMTP
     * -------------------------------------------------
     *
     * Host: smtp.gmail.com
     * Port: 587
     * Encryption: STARTTLS
     *
     * Use a Gmail APP PASSWORD, NOT your normal password.
     */

    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;

    // CHANGE THIS
    $mail->Username = 'YOUR_GMAIL@gmail.com';

    // CHANGE THIS
    $mail->Password = 'YOUR_16_DIGIT_APP_PASSWORD';

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;


    // =================================================
    // CHARACTER SET
    // =================================================

    $mail->CharSet = 'UTF-8';


    // =================================================
    // SENDER
    // =================================================

    /*
     * IMPORTANT:
     * For Gmail SMTP, use the same Gmail address
     * that you used in $mail->Username.
     */

    $mail->setFrom(
        'YOUR_GMAIL@gmail.com',
        'Vancouver Bengali Club Website'
    );


    // =================================================
    // RECEIVER
    // =================================================

    // CHANGE THIS TO YOUR RECEIVING EMAIL
    $mail->addAddress(
        'YOUR_RECEIVING_EMAIL@gmail.com',
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
    // EMAIL FORMAT
    // =================================================

    $mail->isHTML(true);


    // =================================================
    // EMAIL SUBJECT
    // =================================================

    $mail->Subject = $subject;


    // =================================================
    // ESCAPE USER INPUT
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
        $subject,
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


    // =================================================
    // HTML EMAIL
    // =================================================

    $mail->Body = '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>New Contact Form Enquiry</title>
    </head>

    <body style="
        margin:0;
        padding:0;
        background:#f5f5f5;
        font-family:Arial,Helvetica,sans-serif;
    ">

        <div style="
            max-width:650px;
            margin:30px auto;
            background:#ffffff;
            border:1px solid #e5e5e5;
        ">

            <div style="
                background:#003f68;
                padding:25px;
                text-align:center;
            ">
                <h2 style="
                    color:#ffffff;
                    margin:0;
                    font-size:24px;
                ">
                    New Contact Form Enquiry
                </h2>
            </div>

            <div style="padding:30px;">

                <p style="font-size:16px;">
                    You have received a new enquiry from your website.
                </p>

                <table
                    width="100%"
                    cellpadding="10"
                    cellspacing="0"
                    style="
                        border-collapse:collapse;
                        margin-top:20px;
                    "
                >

                    <tr>
                        <td style="
                            font-weight:bold;
                            border-bottom:1px solid #eeeeee;
                            width:30%;
                        ">
                            Name
                        </td>

                        <td style="
                            border-bottom:1px solid #eeeeee;
                        ">
                            ' . $safeName . '
                        </td>
                    </tr>

                    <tr>
                        <td style="
                            font-weight:bold;
                            border-bottom:1px solid #eeeeee;
                        ">
                            Email
                        </td>

                        <td style="
                            border-bottom:1px solid #eeeeee;
                        ">
                            ' . $safeEmail . '
                        </td>
                    </tr>

                    <tr>
                        <td style="
                            font-weight:bold;
                            border-bottom:1px solid #eeeeee;
                        ">
                            Phone
                        </td>

                        <td style="
                            border-bottom:1px solid #eeeeee;
                        ">
                            ' . $safePhone . '
                        </td>
                    </tr>

                    <tr>
                        <td style="
                            font-weight:bold;
                            border-bottom:1px solid #eeeeee;
                        ">
                            Subject
                        </td>

                        <td style="
                            border-bottom:1px solid #eeeeee;
                        ">
                            ' . $safeSubject . '
                        </td>
                    </tr>

                </table>

                <div style="
                    margin-top:25px;
                ">

                    <h3 style="
                        color:#003f68;
                        margin-bottom:10px;
                    ">
                        Message
                    </h3>

                    <div style="
                        background:#f8f8f8;
                        padding:20px;
                        line-height:1.6;
                        border-left:4px solid #003f68;
                    ">
                        ' . $safeMessage . '
                    </div>

                </div>

            </div>

            <div style="
                background:#f5f5f5;
                padding:15px;
                text-align:center;
                font-size:13px;
                color:#777777;
            ">
                This email was sent from the Vancouver Bengali Club website contact form.
            </div>

        </div>

    </body>
    </html>
    ';


    // =================================================
    // PLAIN TEXT VERSION
    // =================================================

    $mail->AltBody =
        "New Contact Form Enquiry\n\n" .
        "Name: " . $name . "\n" .
        "Email: " . $email . "\n" .
        "Phone: " . ($phone !== '' ? $phone : 'Not provided') . "\n" .
        "Subject: " . $subject . "\n\n" .
        "Message:\n" .
        $message;


    // =================================================
    // SEND EMAIL
    // =================================================

    $mail->send();


    // =================================================
    // SUCCESS RESPONSE
    // =================================================

    echo 'success';

} catch (Exception $e) {

    // =================================================
    // ERROR RESPONSE
    // =================================================

    error_log(
        'PHPMailer Error: ' . $mail->ErrorInfo
    );

    http_response_code(500);

    echo 'Unable to send your message right now. Please try again later.';
}
