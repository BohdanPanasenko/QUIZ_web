<?php
session_start();
require '../db/db.php'; 

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') 
{
    header('Location: ../login.php');
    exit;
}

if (!isset($_GET['id']) || empty($_GET['id'])) 
{
    echo "No user ID provided.";
    exit;
}

$userId = (int)$_GET['id'];
if ($userId === $_SESSION['user_id']) 
{
    echo "You cannot delete your own account.";
    exit;
}

$stmt = $db->prepare('DELETE FROM users WHERE id = ?');
$stmt->bind_param('i', $userId);

if ($stmt->execute()) {
    header('Location: manage_users.php');
    exit;
} else {
    echo "Error deleting user: " . $db->error;
}
?>
