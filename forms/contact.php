<?php
  /**
  * Requires the "PHP Email Form" library
  * The "PHP Email Form" library is available only in the pro version of the template
  * The library should be uploaded to: vendor/php-email-form/php-email-form.php
  * For more info and help: https://bootstrapmade.com/php-email-form/
  */

  // Replace contact@example.com with your real receiving email address
  $receiving_email_address = 'michaelofori87@gmail.com';

  // Check if it's an AJAX request
  $is_ajax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
      strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

  // Validate and sanitize input
  $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
  $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

  // Validate email
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo json_encode(['status' => 'error', 'message' => 'Invalid email format']);
      exit;
  }

  // Prepare email content
  $email_subject = "Contact Form: $subject";
  $email_body = "You have received a new message from your website contact form.\n\n" .
      "Here are the details:\n\n" .
      "Name: $name\n\n" .
      "Email: $email\n\n" .
      "Message:\n$message";

  $headers = "From: $email\r\n" .
      "Reply-To: $email\r\n" .
      "X-Mailer: PHP/" . phpversion();

  // Send email
  $mail_sent = mail($receiving_email_address, $email_subject, $email_body, $headers);

  if ($mail_sent) {
      echo json_encode(['status' => 'success', 'message' => 'Message sent successfully']);
  } else {
      echo json_encode(['status' => 'error', 'message' => 'Failed to send message']);
  }
?>
