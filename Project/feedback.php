<?php
include 'templates/header.tpl.php';
?>

<?php
if (!isset($_SESSION['feedback']) || !isset($_SESSION['is_correct'])) {
    header('Location: quiz.php');
    exit;
}

$feedback = $_SESSION['feedback'];
$is_correct = $_SESSION['is_correct'];
$current_question_index = $_SESSION['current_question'];
$total_questions = count($_SESSION['questions']);


$_SESSION['current_question']++;

if ($_SESSION['current_question'] >= $total_questions) {
    header('Location: end_quiz.php');
    exit;
}
?>


    <main>
            <h2><?php echo $feedback; ?></h2>
            <p>Question <?php echo $current_question_index + 1; ?> of <?php echo $total_questions; ?></p>
            <form action="quiz.php" method="GET">
                <button type="submit" class="btn">Next Question</button>
            </form>
    </main>
<?php
include 'templates/footer.tpl.php';
?>

