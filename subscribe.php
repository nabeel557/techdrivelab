<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer library files
require './PHPMailer-master/src/Exception.php';
require './PHPMailer-master/src/PHPMailer.php';
require './PHPMailer-master/src/SMTP.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate email input
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Invalid email address. Please try again.';
        exit;
    }

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'imnabeelahmed817@gmail.com'; // Your email address
        $mail->Password   = 'nicz cdoj myfs iffw';       // Your email password or App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Recipients
        $mail->setFrom('imnabeelahmed817@gmail.com', 'Subscription');
        $mail->addAddress('imnabeelahmed817@gmail.com'); // Send to your email
        $mail->addReplyTo($email); // Reply to subscriber's email

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'New Subscription';
        $mail->Body    = "<p>You have a new subscriber:</p><p><strong>Email:</strong> $email</p>";
        $mail->AltBody = "You have a new subscriber: Email: $email";

        // Send email
        $mail->send();
        echo 'Thank you for subscribing!';
    } catch (Exception $e) {
        echo "Subscription failed. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
