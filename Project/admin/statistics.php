<?php
include 'templates/header_admin.tpl.php';
?>
<?php
//bullet 29
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') 
{
    header('Location: ../login.php');
    exit;
}
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '1970-01-01';
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : date('Y-m-d');
$username = isset($_GET['user_id']) ? $_GET['user_id'] : '';

$query = "SELECT logs.*, users.username FROM logs JOIN users ON logs.user_id = users.id WHERE event_time BETWEEN ? AND ?";
$params = [$start_date, $end_date];
$types = 'ss';

if ($username) {
    $user_stmt = $db->prepare("SELECT id FROM users WHERE username = ?");
    $user_stmt->bind_param('s', $username);
    $user_stmt->execute();
    $user_result = $user_stmt->get_result();
    if ($user_row = $user_result->fetch_assoc()) {
        $user_id = $user_row['id'];
        $query .= " AND user_id = ?";
        $params[] = $user_id;
        $types .= 'i';
    } 
    else 
    {
        $query .= " AND user_id = ?";
        $params[] = -1;
        $types .= 'i';
    }
    $user_stmt->close();
}

$stmt = $db->prepare($query);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

$logs = [];
while ($row = $result->fetch_assoc()) {
    $logs[] = $row;
}

$stmt->close();
?>


        <main>
            <h1>Admin Statistics</h1>
            <form method="GET" action="statistics.php">
                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date" value="<?php echo htmlspecialchars($start_date); ?>">
                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" name="end_date" value="<?php echo htmlspecialchars($end_date); ?>">
                <label for="user_id">User:</label>
                <input type="text" id="user_id" name="user_id" value="<?php echo htmlspecialchars($username); ?>">
                <button type="submit" class="btn">Filter</button>
            </form>
            <h2>Log Events</h2>
            <table>
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Event Type</th>
                        <th>Event Description</th>
                        <th>Event Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($logs as $log): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($log['username']); ?></td>
                            <td><?php echo htmlspecialchars($log['event_type']); ?></td>
                            <td><?php echo htmlspecialchars($log['event_description']); ?></td>
                            <td><?php echo htmlspecialchars($log['event_time']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>
        
<?php
include 'templates/footer_admin.tpl.php';
?>