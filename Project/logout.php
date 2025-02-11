<?php
session_start(); 
require 'db/db.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $event_type = 'logout';
    $event_description = 'User logged out';
    $log_stmt = $db->prepare("INSERT INTO logs (user_id, event_type, event_description) VALUES (?, ?, ?)");
    $log_stmt->bind_param('iss', $user_id, $event_type, $event_description);
    $log_stmt->execute();
    $log_stmt->close();

    session_unset();
    session_destroy();
}

header('Location: index.php');
exit;
?>