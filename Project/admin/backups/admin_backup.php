<?php
session_start();
require '../../db/db.php';
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') 
{
    header('Location: ../../login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Backup</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <div class="grid-container">
        <header class="flex-container">
            <div class="logo">Quiz Application</div>
            <nav>
                <ul class="nav-links">
                    <li><a href="../../index.php">Home</a></li>
                    <li><a href="../../dashboard.php">Main</a></li>
                    <li><a href="../../leaderboard.php">Leaderboard</a></li>
                    <?php if ($role === 'admin'): ?>
                        <li><a href="../sort_page.php">Sort</a></li>
                        <li><a href="../search_page.php">Search</a></li>
                        <li><a href="../statistics.php">Stats</a></li>
                        <li><a href="../manage_users.php">Manage Users</a></li>
                        <li><a href="../manage_questions.php">Manage Questions</a></li>
                        <li><a href="admin_backup.php">Backup</a></li>
                        <li><a href="../admin_settings.php">Settings</a></li>
                    <?php elseif ($role === 'player'): ?>
                        <li><a href="../../quiz.php">Take Quiz</a></li>
                    <?php endif; ?>
                    <li><a href="../../documentation/documentation.php">Documentation</a></li>
                    <li><a href="../../documentation/author.php">Author</a></li>
                    <li><a href="../../fetch_page.php">Fetch data</a></li>
                    <li><a href="../../contact.php">Contact</a></li>
                    <li><a href="../../logout.php">Logout</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <h1>Admin Backup</h1>
            <?php if (isset($_SESSION['backup_message'])): ?>
                <p style="color: green;"><?php echo htmlspecialchars($_SESSION['backup_message']); ?></p>
                <?php unset($_SESSION['backup_message']); ?>
            <?php endif; ?>
            <?php if (isset($_SESSION['restore_message'])): ?>
                <p style="color: green;"><?php echo htmlspecialchars($_SESSION['restore_message']); ?></p>
                <?php unset($_SESSION['restore_message']); ?>
            <?php endif; ?>
            <form action="backup_database.php" method="POST">
                <button type="submit" class="btn">Backup Database</button>
            </form>
            <form action="restore_database.php" method="POST" enctype="multipart/form-data">
                <div>
                    <label for="backup_file">Restore from Backup:</label>
                    <input type="file" id="backup_file" name="backup_file" required>
                </div>
                <button type="submit" class="btn">Restore Database</button>
            </form>
        </main>
        <footer>
            <p>© 2025 Bohdan Panasenko</p>
        </footer>
    </div>
</body>
</html>