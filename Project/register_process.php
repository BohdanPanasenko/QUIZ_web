<?php
require 'db/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    $secretKey = '6LfmGLwqAAAAAEyd6eWx5V9jxvQwVe0Ew6LBzM3R';
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$recaptchaResponse");
    $responseKeys = json_decode($response, true);

    if (intval($responseKeys["success"]) !== 1) {
        echo '<span style="color: red;">Please complete the CAPTCHA.</span>';
        exit;
    }

    

    //validation on the server side usiing php
    $errors = [];
    if (strlen($username) < 5) 
    {
        $errors[] = 'Username must be at least 5 characters long.';
    }

    if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $password)) 
    {
        $errors[] = 'Password must be at least 8 characters long and contain at least one letter and one number.';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
        $errors[] = 'Please enter a valid email address.';
    }

    if (!empty($errors)) 
    {
        include 'templates/header.tpl.php';
        foreach ($errors as $error) {
            echo '<span style="color: red;">' . htmlspecialchars($error) . '</span><br>';
        }
        include 'templates/footer.tpl.php';
        exit;
    }

    if (!empty($username) && !empty($email) && !empty($password)) {
        $stmt = $db->prepare('SELECT id FROM users WHERE username = ?');
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            include 'templates/header_error.tpl.php';
            echo '<span style="color: red;">Username already taken.</span>';
            include 'templates/footer_error.tpl.php';
            $stmt->close();
            exit;
        }
        $stmt->close();

        $stmt = $db->prepare('SELECT id FROM users WHERE email = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            include 'templates/header_error.tpl.php';
            echo '<span style="color: red;">Email already taken.</span>';
            include 'templates/footer_error.tpl.php';
            $stmt->close();
            exit;
        }
        $stmt->close();

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $db->prepare('INSERT INTO users (username, email, password, role, status) VALUES (?, ?, ?, "player", "inactive")');
        $stmt->bind_param('sss', $username, $email, $hashedPassword);

        if ($stmt->execute()) {
            include 'templates/header_error.tpl.php';
            echo "Registration successful. Please check your email to verify your account.";     
            include 'templates/footer_error.tpl.php';
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "All fields are required.";
    }
}
?>