<?php
include 'templates/header_admin.tpl.php';
?>
<?php


if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') 
{
    header('Location: ../login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $question = trim($_POST['question']);
    $option1 = trim($_POST['option1']);
    $option2 = trim($_POST['option2']);
    $option3 = trim($_POST['option3']);
    $option4 = trim($_POST['option4']);
    $correctOption = intval($_POST['correct_option']);

    if (!empty($question) && !empty($option1) && !empty($option2) && !empty($option3) && !empty($option4) && $correctOption >= 1 && $correctOption <= 4) 
    {
        $stmt = $db->prepare("INSERT INTO questions (question, option1, option2, option3, option4, correct_option) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sssssi', $question, $option1, $option2, $option3, $option4, $correctOption);
        if ($stmt->execute()) 
        {
            $message = "Question added successfully!";
        } else 
        {
            $message = "Error adding question: " . $stmt->error;
        }
        $stmt->close();
    } else 
    {
        $message = "Please fill in all fields correctly.";
    }
}
$sql = "SELECT id, question, option1, option2, option3, option4, correct_option FROM questions";
$result = $db->query($sql);
?>


    <main>
            <h1>Manage Questions</h1>

            <?php if (!empty($message)): ?>
                <p class="message"><?php echo htmlspecialchars($message); ?></p>
            <?php endif; ?>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Question</th>
                        <th>Option 1</th>
                        <th>Option 2</th>
                        <th>Option 3</th>
                        <th>Option 4</th>
                        <th>Correct Option</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['id']); ?></td>
                                <td><?php echo htmlspecialchars($row['question']); ?></td>
                                <td><?php echo htmlspecialchars($row['option1']); ?></td>
                                <td><?php echo htmlspecialchars($row['option2']); ?></td>
                                <td><?php echo htmlspecialchars($row['option3']); ?></td>
                                <td><?php echo htmlspecialchars($row['option4']); ?></td>
                                <td><?php echo htmlspecialchars($row['correct_option']); ?></td>
                                <td>
                                    <a href="edit_question.php?id=<?php echo $row['id']; ?>">Edit</a> | 
                                    <a href="delete_question.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this question?')">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8">No questions found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <form action="" method="POST" class="add-question-form">
                <h2>Add New Question</h2>
                <label>Question:</label>
                <input type="text" name="question" required>
                
                <label>Option 1:</label>
                <input type="text" name="option1" required>
                
                <label>Option 2:</label>
                <input type="text" name="option2" required>
                
                <label>Option 3:</label>
                <input type="text" name="option3" required>
                
                <label>Option 4:</label>
                <input type="text" name="option4" required>
                
                <label>Correct Option (1-4):</label>
                <input type="number" name="correct_option" min="1" max="4" required>
                
                <button type="submit">Add Question</button>
            </form>
    </main>

    <?php
include 'templates/footer_admin.tpl.php';
?>

    <link rel="stylesheet" href="../assets/css/manage_questions.css">