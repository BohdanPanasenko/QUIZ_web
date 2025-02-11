<?php
include 'templates/header_admin.tpl.php';
?>

<?php


if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') 
{
    header('Location: ../login.php');
    exit;
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "No user ID provided.";
    exit;
}

$userId = (int)$_GET['id'];

$stmt = $db->prepare('SELECT username, email, role, status FROM users WHERE id = ?');
$stmt->bind_param('i', $userId);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    echo "User not found.";
    exit;
}

$stmt->bind_result($username, $email, $role, $status);
$stmt->fetch();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newUsername = trim($_POST['username']);
    $newRole = $_POST['role'];
    $newStatus = $_POST['status'];
    if (empty($newUsername)) 
    {
        echo "Username cannot be empty.";
        exit;
    }

    $stmt = $db->prepare('UPDATE users SET username = ?, role = ?, status = ? WHERE id = ?');
    $stmt->bind_param('sssi', $newUsername, $newRole, $newStatus, $userId);

    if ($stmt->execute()) 
    {
        header('Location: manage_users.php');
        exit;
    } 
    else 
    {
        echo "Error updating user: " . $db->error;
    }
}
?>



    <main>
        <div class="container">
            <h1>Edit User</h1>
            <form action="" method="POST">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>

                <label for="email">Email:</label>
                <input type="email" id="email" value="<?php echo htmlspecialchars($email); ?>" disabled>

                <label for="role">Role:</label>
                <select name="role" id="role" required>
                    <option value="admin" <?php if ($role === 'admin') echo 'selected'; ?>>Admin</option>
                    <option value="player" <?php if ($role === 'player') echo 'selected'; ?>>Player</option>
                </select>

                <label for="status">Status:</label>
                <select name="status" id="status" required>
                    <option value="active" <?php if ($status === 'active') echo 'selected'; ?>>Active</option>
                    <option value="inactive" <?php if ($status === 'inactive') echo 'selected'; ?>>Inactive</option>
                    <option value="blocked" <?php if ($status === 'blocked') echo 'selected'; ?>>Blocked</option>
                </select>

                <button type="submit" class="btn">Save Changes</button>
            </form>
        </div>
    </main>



<?php
include 'templates/footer_admin.tpl.php';
?>