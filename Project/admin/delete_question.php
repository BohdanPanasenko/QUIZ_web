<?php
session_start();
require '../db/db.php'; 
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') 
{
    header('Location: ../login.php');
    exit;
}

if (isset($_GET['id']) && !empty($_GET['id'])) 
{
    $id = intval($_GET['id']);
    $stmt = $db->prepare("DELETE FROM questions WHERE id = ?");
    $stmt->bind_param('i', $id);
    
    if ($stmt->execute()) 
    {
        header('Location: manage_questions.php');
        exit;
    } 
    else {
        echo "Error deleting question: " . $stmt->error;
    }
    $stmt->close();
} else 
{
    header('Location: manage_questions.php');
    exit;
}
?>
