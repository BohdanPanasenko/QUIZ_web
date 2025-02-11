<?php
include 'templates/header_admin.tpl.php';
?>

<?php
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') 
{
    header('Location: ../login.php');
    exit;
}

if (isset($_GET['query'])) {
    $query = trim($_GET['query']);

    // search users
    $stmt = $db->prepare("SELECT id, username, email FROM users WHERE MATCH(username, email) AGAINST(?)");
    $stmt->bind_param('s', $query);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($user_id, $username, $email);

    $users = [];
    while ($stmt->fetch()) {
        $users[] = ['id' => $user_id, 'username' => $username, 'email' => $email];
    }
    $stmt->close();

    //search ques
    $stmt = $db->prepare("SELECT id, question FROM questions WHERE MATCH(question, option1, option2, option3, option4) AGAINST(?)");
    $stmt->bind_param('s', $query);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($question_id, $question);

    $questions = [];
    while ($stmt->fetch()) {
        $questions[] = ['id' => $question_id, 'question' => $question];
    }
    $stmt->close();
}
?>


        <main>
            <h1>Search Results for "<?php echo htmlspecialchars($query); ?>"</h1>
            <div id="search-results">
                <h2>Users</h2>
                <?php if (!empty($users)): ?>
                    <ul>
                        <?php foreach ($users as $user): ?>
                            <li><?php echo htmlspecialchars($user['username']); ?> (<?php echo htmlspecialchars($user['email']); ?>)</li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>No users found.</p>
                <?php endif; ?>

                <h2>Questions</h2>
                <?php if (!empty($questions)): ?>
                    <ul>
                        <?php foreach ($questions as $question): ?>
                            <li><?php echo htmlspecialchars($question['question']); ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>No questions found.</p>
                <?php endif; ?>
            </div>
        </main>
        

<?php
include 'templates/footer_admin.tpl.php';
?>