<?php
include 'templates/header_admin.tpl.php';
?>

<?php
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') 
{
    header('Location: ../login.php');
    exit;
}

$results_per_page = 10;

//bullet 13 (separate pagination function)
function paginate($db, $table, $columns, $page, $results_per_page, $sort_by, $order) 
{
    $offset = ($page - 1) * $results_per_page;
    $query = "SELECT $columns FROM $table ORDER BY $sort_by $order LIMIT ?, ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('ii', $offset, $results_per_page);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    $result = $db->query("SELECT COUNT(*) AS total FROM $table");
    $row = $result->fetch_assoc();
    $total_rows = $row['total'];

    return [
        'data' => $data,
        'total_rows' => $total_rows,
        'total_pages' => ceil($total_rows / $results_per_page),
    ];
}


$sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'username';
$order = isset($_GET['order']) ? $_GET['order'] : 'asc';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$valid_sort_by = ['username', 'email', 'question'];
$valid_order = ['asc', 'desc'];

if (!in_array($sort_by, $valid_sort_by) || !in_array($order, $valid_order)) {
    die('Invalid sorting criteria.');
}

$users = [];
$total_pages = 0;
if ($sort_by === 'username' || $sort_by === 'email') {
    $pagination = paginate($db, 'users', 'id, username, email', $page, $results_per_page, $sort_by, $order);
    $users = $pagination['data'];
    $total_pages = $pagination['total_pages'];
}

$questions = [];
if ($sort_by === 'question') {
    $pagination = paginate($db, 'questions', 'id, question', $page, $results_per_page, $sort_by, $order);
    $questions = $pagination['data'];
    $total_pages = $pagination['total_pages'];
}
?>


        <main>
            <h1>Sorted Results</h1>
            <div id="sort-results">
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

                <div class="pagination">
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <a href="?sort_by=<?php echo $sort_by; ?>&order=<?php echo $order; ?>&page=<?php echo $i; ?>" class="btn"><?php echo $i; ?></a>
                    <?php endfor; ?>
                </div>
            </div>
        </main>
        

<?php
include 'templates/footer_admin.tpl.php';
?>