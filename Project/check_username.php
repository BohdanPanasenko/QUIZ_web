<?php
require 'db/db.php';

if (isset($_POST['username'])) {
    $username = trim($_POST['username']);

    $stmt = $db->prepare('SELECT id FROM users WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo json_encode(['exists' => true]);
    } else {
        echo json_encode(['exists' => false]);
    }

    $stmt->close();
}
?>