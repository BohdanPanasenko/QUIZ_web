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
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>

        h1, h2 {
            color: #343a40;
        }

        .content-section {
            margin-bottom: 30px;
        }

        .content-section h2 {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border-radius: 5px;
        }

        .content-section ul {
            list-style-type: none;
            padding-left: 20px;
        }

        .content-section ul li {
            margin-bottom: 5px;
        }

        .technologies {
            background-color: #e9ecef;
            border-radius: 5px;
            padding: 10px;
        }

        .technologies p {
            margin: 0;
        }

        .directory-structure {
            text-align: left;
            background-color: #e9ecef;
            border-radius: 5px;
            padding: 15px;
            font-family: monospace;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="grid-container">
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
            <div class="content-section">
        <h1>Description of the Project 'Quiz'</h1>
        <p>The project is a Quiz Application that allows users to register, log in, take quizzes, and view their scores on a leaderboard. Administrators can manage users, questions, and system settings. The application also includes features such as CAPTCHA verification, responsive design, and print optimization.</p>
    </div>

    <div class="content-section">
        <h2>Project Solution</h2>
        <p>The solution involves creating a web application using PHP, MySQL, HTML, CSS, and JavaScript. The application includes user authentication, quiz management, and administrative functionalities. The design is responsive to adapt to different screen sizes and optimized for printing tabular data.</p>
    </div>

    <div class="content-section">
        <h2>Technologies and Tools Used</h2>
        <div class="technologies">
            <p><strong>Languages:</strong> PHP, HTML, CSS, JavaScript</p>
            <p><strong>Database:</strong> MySQL</p>
            <p><strong>Web Server:</strong> Apache (XAMPP)</p>
            <p><strong>Libraries and Frameworks:</strong> Bootstrap (for responsive design), jQuery (for AJAX requests)</p>
            <p><strong>External Tools:</strong> Google reCAPTCHA (for CAPTCHA verification)</p>
        </div>
    </div>

    <div class="content-section">
        <h2>External Tools and Frameworks</h2>
        <ul>
            <li><strong>Google reCAPTCHA:</strong> Used for CAPTCHA verification during user registration.</li>
            <li><strong>Bootstrap:</strong> Used for responsive design and styling.</li>
        </ul>
    </div>

    <div class="content-section">
        <h2>Project Directory Structure</h2>
        <div class="directory-structure">
            /e:/xampp/htdocs/Project/<br>
            ├── admin/<br>
            │   ├── backups/<br>
            │   │   ├── admin_backup.php<br>
            │   │   ├── backup_database.php<br>
            │   │   ├── restore_database.php<br>
            │   │   └── backup_2025-01-24_16-55-47.sql<br>
            │   ├── admin_settings.php<br>
            │   ├── delete_question.php<br>
            │   ├── edit_question.php<br>
            │   ├── delete_user.php<br>
            │   ├── edit_user.php<br>
            │   ├── statistics.php<br>
            │   ├── manage_users.php<br>
            │   ├── manage_questions.php<br>
            │   ├── sort_page.php<br>
            │   ├── search_page.php<br>
            │   ├── sort_page.php<br>
            │   ├── search.php<br>
            │   ├── statistics.php<br>
            │   └── templates/<br>
            │       ├── header_admin.tpl.php<br>
            │       └── footer_admin.tpl.php<br>
            ├── assets/<br>
            │   ├── css/<br>
            │   │   ├── manage_questions.css<br>
            │   │   ├── manage_users.css<br>
            │   │   └── styles.css<br>
            │   ├── images/<br>
            │   │   ├── diagram.png<br>
            │   │   ├── quiz_logo.jpg<br>
            │   │   └── id_photo.jpg<br>
            │   └── js/<br>
            │       ├── check_username.js<br>
            │       ├── register_validation.js<br>
            │       └── ...<br>
            ├── db/<br>
            │   └── db.php<br>
            ├── documentation/<br>
            │   ├── author.php<br>
            │   └── documentation.html<br>
            ├── templates/<br>
            │   ├── header.tpl.php<br>
            │   └── footer.tpl.php<br>
            ├── check_username.php<br>
            ├── contact_process.php<br>
            ├── contact.php<br>
            ├── dashboard.php<br>
            ├── end_quiz.php<br>
            ├── feedback.php<br>
            ├── fetch_data.php<br>
            ├── fetch_page.php<br>
            ├── index.php<br>
            ├── install.php<br>
            ├── register.php<br>
            ├── register_process.php<br>
            ├── login.php<br>
            ├── login_process.php<br>
            ├── logout.php<br>
            ├── quiz.php<br>
            ├── leaderboard.php<br>
            ├── reset_leaderboard.php<br>
            └── rss_feed.php<br>
        </div>
    </div>

    <div class="content-section">
        <h2>Database Schema</h2>
        <p>The database schema consists of the following tables:</p>
        <ul>
            <li><strong>users:</strong> Contains user information such as username, password, email, role, and registration date.</li>
            <li><strong>questions:</strong> Contains quiz questions, answers, and correct answers.</li>
            <li><strong>logs:</strong> Contains user quiz scores and completion times.</li>
            <li><strong>settings:</strong> Contains system settings such as max login attempts and elements per page.</li>
            <li><strong>leaderboard:</strong> Contains information about user scores.</li>
        </ul>
        <img src="../assets/images/diagram.png" alt="Diagram" style="width: 600px; height: auto;">
    </div>
        </main>

        <footer>
            <p>© 2025 Bohdan Panasenko</p>
        </footer>
    </div>
</body>

</html>