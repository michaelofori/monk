<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = htmlspecialchars($_POST['name']);
    $email   = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    $to      = "michaelofori10@gmail.com";  // Your email address
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $emailBody = "You have received a new message from your website contact form.\n\n" .
                 "Name: $name\n" .
                 "Email: $email\n" .
                 "Subject: $subject\n" .
                 "Message:\n$message";

    if (mail($to, $subject, $emailBody, $headers)) {
        echo "success";
    } else {
        http_response_code(500);
        echo "Something went wrong. Please try again.";
    }
}
?>
