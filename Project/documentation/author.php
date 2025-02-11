<?php
session_start();

$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Quiz Application for Basics of Web Programming">
    <meta name="author" content="Bohdan Panasenko">
    <title>Quiz Application</title>
    <link rel="stylesheet" href="../assets/css/styles_error.css">
</head>

<body>
    <div class="grid-contrainer">
        <header class="flex-container">
            <div class="logo">Quiz Application</div>
            <nav>
                <ul class="nav-links">
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="../dashboard.php">Main</a></li>
                    <li><a href="../leaderboard.php">Leaderboard</a></li>
                    <?php if ($role === 'admin'): ?>
                    <li><a href="../admin/sort_page.php">Sort</a></li>
                    <li><a href="../admin/search_page.php">Search</a></li>
                    <li><a href="../admin/statistics.php">Stats</a></li>
                    <li><a href="../admin/manage_users.php">Manage Users</a></li>
                    <li><a href="../admin/manage_questions.php">Manage Questions</a></li>
                    <li><a href="../admin/backups/admin_backup.php">Backup</a></li>
                    <li><a href="../admin/admin_settings.php">Settings</a></li>
                    <?php elseif ($role === 'player'): ?>
                    <li><a href="../quiz.php">Take Quiz</a></li>
                    <?php endif; ?>
                    <li><a href="documentation.php">Documentation</a></li>
                    <li><a href="author.php">Author</a></li>
                    <li><a href="../fetch_page.php">Fetch data</a></li>
                    <li><a href="../contact.php">Contact</a></li>
                    <li><a href="../logout.php">Logout</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <section>
                <h2>Personal Details</h2>
                <p><strong>Full Name: </strong>Panasenko Bohdan Vadimovich</p>
                <p><strong>Personal ID Number: </strong>GE531996</p>
                <p><strong>Student Index Number: </strong>HR:0333014624</p>
                <p><strong>University Email: </strong>bohdan.panasenko@aspira.hr</p>
                <p><strong>Personal Email: </strong>bogdanvadimovichpanasenko@gmail.com</p>
                <p><strong>Photo:</strong></p>
                <img src="../assets/images/id_photo.jpg" alt="ID Photo" style="width: 200px; height: auto;">
            </section>
        </main>
        <footer>
            <p>© 2025 Bohdan Panasenko</p>
        </footer>
    </div>
</body>

</html>