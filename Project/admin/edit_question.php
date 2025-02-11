<?php
include 'templates/header_admin.tpl.php';
?>
<?php


if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') 
{
    header('Location: ../login.php');
    exit;
}


if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = intval($_GET['id']);
    
    $stmt = $db->prepare("SELECT question, option1, option2, option3, option4, correct_option FROM questions WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($question, $option1, $option2, $option3, $option4, $correct_option);
        $stmt->fetch();
    } else {
        header('Location: manage_questions.php');
        exit;
    }
    $stmt->close();
} else {
    header('Location: manage_questions.php');
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question = trim($_POST['question']);
    $option1 = trim($_POST['option1']);
    $option2 = trim($_POST['option2']);
    $option3 = trim($_POST['option3']);
    $option4 = trim($_POST['option4']);
    $correctOption = $_POST['correct_option']; //??
    
    if (!empty($question) && !empty($option1) && !empty($option2) && !empty($option3) && !empty($option4) && !empty($correctOption)) 
    {
        $stmt = $db->prepare("UPDATE questions SET question = ?, option1 = ?, option2 = ?, option3 = ?, option4 = ?, correct_option = ? WHERE id = ?");
        $stmt->bind_param('ssssssi', $question, $option1, $option2, $option3, $option4, $correctOption, $id);
        
        if ($stmt->execute()) 
        {
            $message = "Question updated successfully!";
        } else 
        {
            $message = "Error updating question: " . $stmt->error;
        }
        $stmt->close();
    } 
    else {
        $message = "Please fill in all fields correctly.";
    }
}
?>


    <main>
        <div class="container">
            <h1>Edit Question</h1>
            <?php if (!empty($message)): ?>
                <p class="message"><?php echo htmlspecialchars($message); ?></p>
            <?php endif; ?>

            <form action="" method="POST" class="edit-question-form">
                <label>Question:</label>
                <input type="text" name="question" value="<?php echo htmlspecialchars($question); ?>" required>
                
                <label>Option 1:</label>
                <input type="text" name="option1" value="<?php echo htmlspecialchars($option1); ?>" required>
                
                <label>Option 2:</label>
                <input type="text" name="option2" value="<?php echo htmlspecialchars($option2); ?>" required>
                
                <label>Option 3:</label>
                <input type="text" name="option3" value="<?php echo htmlspecialchars($option3); ?>" required>
                
                <label>Option 4:</label>
                <input type="text" name="option4" value="<?php echo htmlspecialchars($option4); ?>" required>
                
                <label>Correct Option:</label>
                <select name="correct_option" required>
                    <option value="1" <?php if($correct_option == 1) echo 'selected'; ?>>1</option>
                    <option value="2" <?php if($correct_option == 2) echo 'selected'; ?>>2</option>
                    <option value="3" <?php if($correct_option == 3) echo 'selected'; ?>>3</option>
                    <option value="4" <?php if($correct_option == 4) echo 'selected'; ?>>4</option>
                </select>
                
                <button type="submit">Update Question</button>
            </form>
        </div>
    </main>


<?php
include 'templates/footer_admin.tpl.php';
?>