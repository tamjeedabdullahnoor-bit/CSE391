<?php
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = isset($_POST['name'])
        ? strip_tags(trim($_POST['name']))
        : '';

    $email = isset($_POST['email'])
        ? trim($_POST['email'])
        : '';

    $message = isset($_POST['message'])
        ? strip_tags(trim($_POST['message']))
        : '';

    if (empty($name)) {
        $errors[] = 'Name is empty';
    }

    if (empty($email)) {
        $errors[] = 'Email is empty';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email is invalid';
    }

    if (empty($message)) {
        $errors[] = 'Message is empty';
    }

    if (empty($errors)) {

        $recipient = "tamjeed.abdullah.noor@g.bracu.ac.bd";
        $subject = "Contact Form Message";

        $headers = "From: Website Contact Form\r\n";
        $headers .= "Reply-To: " . $email . "\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        if (mail($recipient, $subject, $message, $headers)) {
            echo "Email sent successfully!";
        } else {
            echo "Failed to send email. Please try again later.";
        }

    } else {

        echo "The form contains the following errors:<br>";

        foreach ($errors as $error) {
            echo "- " . htmlspecialchars($error) . "<br>";
        }
    }

} 

else {
    header("HTTP/1.1 403 Forbidden");
    echo "You are not allowed to access this page.";
}
?>