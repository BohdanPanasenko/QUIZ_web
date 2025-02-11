<?php
include 'templates/header_admin.tpl.php';
?>


<?php
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') 
{
    header('Location: ../login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $elements_per_page = intval($_POST['elements_per_page']);
    $max_failed_login_attempts = intval($_POST['max_failed_login_attempts']);

    $stmt = $db->prepare("UPDATE settings SET setting_value = ? WHERE setting_name = 'elements_per_page'");
    $stmt->bind_param('s', $elements_per_page);
    $stmt->execute();

    $stmt = $db->prepare("UPDATE settings SET setting_value = ? WHERE setting_name = 'max_failed_login_attempts'");
    $stmt->bind_param('s', $max_failed_login_attempts);
    $stmt->execute();

    $stmt->close();

    $message = "Settings updated successfully.";
}


$settings = [];
$result = $db->query("SELECT setting_name, setting_value FROM settings");
while ($row = $result->fetch_assoc()) {
    $settings[$row['setting_name']] = $row['setting_value'];
}
?>

<main>
    <h1>Admin Settings</h1>
    <?php if (isset($message)): ?>
        <p style="color: green;"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
    <form action="admin_settings.php" method="POST">
        <label for="elements_per_page">Elements Per Page:</label>
        <input type="number" id="elements_per_page" name="elements_per_page" value="<?php echo htmlspecialchars($settings['elements_per_page']); ?>" required>
        <br>
        <label for="max_failed_login_attempts">Max Failed Login Attempts:</label>
        <input type="number" id="max_failed_login_attempts" name="max_failed_login_attempts" value="<?php echo htmlspecialchars($settings['max_failed_login_attempts']); ?>" required>
        <br>
        <button type="submit" class="btn">Update Settings</button>
    </form>
</main>

<?php include 'templates/footer_admin.tpl.php'; ?>