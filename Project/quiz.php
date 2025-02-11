<?php
include 'templates/header.tpl.php';
?>


<?php
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'player') {
    header('Location: login.php');
    exit;
}

if (!isset($_SESSION['questions'])) 
{
    $result = $db->query('SELECT * FROM questions ORDER BY RAND() LIMIT 10');
    $questions = $result->fetch_all(MYSQLI_ASSOC);

    $_SESSION['questions'] = $questions;
    $_SESSION['current_question'] = 0;
    $_SESSION['score'] = 0;
}

$current_question_index = $_SESSION['current_question'];
$total_questions = count($_SESSION['questions']);
$current_question = $_SESSION['questions'][$current_question_index];

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $question_id = $_POST['question_id'];
    $answer = $_POST['answer'];

    $stmt = $db->prepare('SELECT correct_option FROM questions WHERE id = ?');
    $stmt->bind_param('i', $question_id);
    $stmt->execute();
    $stmt->bind_result($correct_option);
    $stmt->fetch();
    $stmt->close();

    if ($answer == $correct_option) 
    {
        $_SESSION['score'] += 100;
        $_SESSION['feedback'] = "Correct!";
        $_SESSION['is_correct'] = true;
    } 
    else 
    {
        $_SESSION['feedback'] = "Wrong! The correct answer was Option $correct_option.";
        $_SESSION['is_correct'] = false;
    }
    header('Location: feedback.php');
    exit;
}
?>


        <main>
            <h2>Question <?php echo $current_question_index + 1; ?> of <?php echo $total_questions; ?></h2>
            <p><strong><?php echo htmlspecialchars($current_question['question']); ?></strong></p>
            <p id="timer">Remaining time: 15 seconds</p>
            <form id="quiz-form" action="quiz.php" method="POST">
                <input type="hidden" name="question_id" value="<?php echo $current_question['id']; ?>">
                <div>
                    <input type="radio" id="option1" name="answer" value="1">
                    <label for="option1"><?php echo htmlspecialchars($current_question['option1']); ?></label>
                </div>
                <div>
                    <input type="radio" id="option2" name="answer" value="2">
                    <label for="option2"><?php echo htmlspecialchars($current_question['option2']); ?></label>
                </div>
                <div>
                    <input type="radio" id="option3" name="answer" value="3">
                    <label for="option3"><?php echo htmlspecialchars($current_question['option3']); ?></label>
                </div>
                <div>
                    <input type="radio" id="option4" name="answer" value="4">
                    <label for="option4"><?php echo htmlspecialchars($current_question['option4']); ?></label>
                </div>
                <button type="submit" class="btn">Submit</button>
            </form>
        </main>
        <?php
include 'templates/footer.tpl.php';
?>
    <script src="assets/js/quiz_script.js"></script>