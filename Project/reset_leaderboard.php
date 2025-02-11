<?php
session_start();
require 'db/db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$db->query('TRUNCATE TABLE leaderboard');

header('Location: leaderboard.php');
exit;
?>