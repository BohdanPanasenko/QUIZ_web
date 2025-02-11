<?php
include 'templates/header.tpl.php';
?>

<?php


if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
   header('Location: login.php');
    exit;
}

require 'db/db.php'; 

$username = $_SESSION['username'];
$role = $_SESSION['role'];
?>
        <main>
            <section class="welcome">
                <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
                <p>You are logged in as <strong><?php echo htmlspecialchars($role); ?></strong>.</p>

                <?php if ($role === 'admin'): ?>
                    <p>Use the options above to manage users, questions, and logs.</p>
                <?php else: ?>
                    <p>Get ready to test your knowledge! You can take a quiz or view the leaderboard.</p>
                <?php endif; ?>
            </section>
        </main>
        
<?php
include 'templates/footer.tpl.php';
?>