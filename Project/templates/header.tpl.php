<?php
session_start();
require 'db/db.php';

$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Quiz Application for Basics of Web Programming">
    <title>Quiz Application</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="grid-container">
        <header class="flex-container">
            <div class="logo">Quiz Application</div>
            <nav>
                <ul class="nav-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="dashboard.php">Main</a></li>
                    <li><a href="leaderboard.php">Leaderboard</a></li>
                    <?php if ($role === 'admin'): ?>
                        <li><a href="admin/sort_page.php">Sort</a></li>
                        <li><a href="admin/search_page.php">Search</a></li>
                        <li><a href="admin/statistics.php">Stats</a></li>
                        <li><a href="admin/manage_users.php">Manage Users</a></li>
                        <li><a href="admin/manage_questions.php">Manage Questions</a></li>
                        <li><a href="admin/backups/admin_backup.php">Backup</a></li>
                        <li><a href="admin/admin_settings.php">Settings</a></li>
                    <?php elseif ($role === 'player'): ?>
                        <li><a href="quiz.php">Take Quiz</a></li>
                    <?php endif; ?>
                    <li><a href="documentation/documentation.php">Documentation</a></li>
                    <li><a href="documentation/author.php">Author</a></li>
                    <li><a href="fetch_page.php">Fetch data</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </header>