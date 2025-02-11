<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) 
    {
        $log_file = 'message_log.txt';
        $log_message = "Name: $name\nEmail: $email\nSubject: $subject\nMessage:\n$message\n\n";
        file_put_contents($log_file, $log_message, FILE_APPEND);


        $_SESSION['contact_message'] = 'Your message has been sent successfully!';
    } 
    else 
    {
        $_SESSION['contact_message'] = 'All fields are required.';
    }

    header('Location: contact.php');
    exit;
}
?>