<?php

if (isset($_POST['contactForm'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $contact = $_POST['contact'];
  $message = $_POST['message'];


  // Validate form data
  if (empty($name) || empty($email) || empty($contact) || empty($message)) {
     echo '<div class="alert alert-danger">All fields are required.</div>';
  } else {
    // Send email to administrator
    // $to = "rajputaman0302@example.com";
    // $subject = "New Contact Form Submission";
    // $body = "Name: $name\nEmail: $email\nContact: $contact\nMessage: $message";
    // $headers = "From: $email";

    // if (mail($to, $subject, $body, $headers)) {
    //   echo "Your message has been sent.";
    // } else {
    //   echo "Failed to send message.";
    // }

      // Connect to database
     include 'config.php';

    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    // Save form data in database
    $sql = "INSERT INTO contact (name, email, contactNumber, message) VALUES ('$name', '$email', '$contact', '$message')";
    if (mysqli_query($conn, $sql)) {
      header('Location: success.php');
      exit;
    } else {
      echo '<div class="alert alert-danger">Error: ' . $sql . '<br>' . mysqli_error($conn) . '</div>';
    }

    // Close connection
    mysqli_close($conn);


  }
}

?>
