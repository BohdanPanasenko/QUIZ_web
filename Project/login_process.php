<?php
session_start();
require 'db/db.php';

// Retrieve settings
$settings = [];
$result = $db->query("SELECT setting_name, setting_value FROM settings");
while ($row = $result->fetch_assoc()) {
    $settings[$row['setting_name']] = $row['setting_value'];
}

$max_failed_login_attempts = intval($settings['max_failed_login_attempts']);

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($email) && !empty($password)) {
        $stmt = $db->prepare('SELECT id, username, password, role, status, failed_login_attempts, last_failed_login FROM users WHERE email = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $username, $hashedPassword, $role, $status, $failed_login_attempts, $last_failed_login);
            $stmt->fetch();

            if ($status === 'blocked') {
                $error_message = 'Your account is blocked. Please contact support.';
            } 
            elseif ($status === 'inactive') 
            {
                $error_message = 'Your account is not activated. Please check your email.';
            } 
            else 
            {
                if (password_verify($password, $hashedPassword)) 
                {
                    // Reset 
                    $stmt = $db->prepare('UPDATE users SET failed_login_attempts = 0, last_failed_login = NULL WHERE id = ?');
                    $stmt->bind_param('i', $id);
                    $stmt->execute();
                    $_SESSION['user_id'] = $id;
                    $_SESSION['username'] = $username;
                    $_SESSION['role'] = $role;
                    $event_type = 'login';
                    $event_description = 'User logged in';
                    $log_stmt = $db->prepare("INSERT INTO logs (user_id, event_type, event_description) VALUES (?, ?, ?)");
                    $log_stmt->bind_param('iss', $id, $event_type, $event_description);
                    $log_stmt->execute();
                    $log_stmt->close();

                    header('Location: dashboard.php');
                    exit;
                } 
                else {
                    $stmt = $db->prepare('UPDATE users SET failed_login_attempts = failed_login_attempts + 1, last_failed_login = NOW() WHERE id = ?');
                    $stmt->bind_param('i', $id);
                    $stmt->execute();

                    if ($failed_login_attempts + 1 >= $max_failed_login_attempts) 
                    {
                        $stmt = $db->prepare('UPDATE users SET status = "blocked" WHERE id = ?');
                        $stmt->bind_param('i', $id);
                        $stmt->execute();
                        $error_message = 'Your account has been blocked due to too many failed login attempts.';
                    } 
                    else 
                    {
                        $error_message = 'Invalid email or password.';
                    }
                }
            }
        } 
        else {
            $error_message = 'Invalid email or password.';
        }

        $stmt->close();
    } 
    else {
        $error_message = 'All fields are required.';
    }
}


if (!empty($error_message)) 
{
    $_SESSION['error_message'] = $error_message;
    header('Location: login.php');
    exit;
}
?>