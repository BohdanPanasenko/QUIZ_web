<?php
include 'templates/header.tpl.php';
?>

<?php
if (!isset($_SESSION['score']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'player') {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$score = $_SESSION['score'];
$total_questions = count($_SESSION['questions']);

$stmt = $db->prepare('SELECT id FROM leaderboard WHERE user_id = ?');
$stmt->bind_param('i', $user_id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows == 0) {
    $stmt = $db->prepare('INSERT INTO leaderboard (user_id, score) VALUES (?, ?)');
    $stmt->bind_param('ii', $user_id, $score);
    $stmt->execute();
}

$stmt->close();

unset($_SESSION['questions'], $_SESSION['current_question'], $_SESSION['score']);
?>


        <main>
            <h1>Quiz Completed</h1>
            <p>You've completed the quiz!</p>
            <p>Your score: <?php echo $score; ?></p>
            <a href="leaderboard.php">View Leaderboard</a>
        </main>

        <?php
include 'templates/footer.tpl.php';
?>