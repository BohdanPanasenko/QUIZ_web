<?php
include 'templates/header.tpl.php';
?>

        <main>
            <img src="assets/images/quiz_logo.jpg" alt="Quiz Logo" style="width: 300px; height: auto;">
            <h1>Welcome to the Quiz Application</h1>
            <p>Test your knowledge and compete on the leaderboard!</p>
            <div class="buttons">
                <a href="register.php" class="btn">Register</a>
                <a href="login.php" class="btn">Login</a>
                <a href="rss_feed.php" class = "btn" >RSS Feed</a>
            </div>
        </main>
<?php
include 'templates/footer.tpl.php';
?>