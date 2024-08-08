<?php

$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

$mailheader = "From:".$name."<".$email.">\r\n";

$recipient = "tanase.ted.164@gmail.com";

mail($recipient, $subject, $message, $mailheader) or die("Error!");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $recaptchaSecret = '6LebRSIqAAAAADoA4q2_xAHqkNhmQEFM-p4otEGc';
  $recaptchaResponse = $_POST['g-recaptcha-response'];

  // Make a POST request to Google's reCAPTCHA API
  $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptchaSecret&response=$recaptchaResponse");
  $responseKeys = json_decode($response, true);

  // Check if the reCAPTCHA was successful
  if (intval($responseKeys["success"]) !== 1) {
      echo 'Please complete the reCAPTCHA.';
  } else {
      // Continue with form processing
      echo 'Form submitted successfully.';
  }
}

?>