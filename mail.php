<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Initialize response data
$data['error'] = false;

// Capture form data
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$subject = isset($_POST['subject']) ? trim($_POST['subject']) : '';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';

// Validate form data
if (empty($name)) {
    $data['error'] = 'Please enter your name.';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $data['error'] = 'Please enter a valid email address.';
} elseif (empty($subject)) {
    $data['error'] = 'Please enter your subject.';
} elseif (empty($message)) {
    $data['error'] = 'The message field is required!';
} else {
    // Prepare email content
    $formcontent = "From: $name\nSubject: $subject\nEmail: $email\nMessage: $message";
    $recipient = "cfajardorojas98@gmail.com";
    $mailheader = "From: $email\r\nReply-To: $email\r\n";

    // Send email
    if (mail($recipient, $subject, $formcontent, $mailheader) === false) {
        $data['error'] = 'Sorry, an error occurred while sending your message.';
    } else {
        $data['error'] = false; // Email sent successfully
    }
}

// Return JSON response
echo json_encode($data);
?>
