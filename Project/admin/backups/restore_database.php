<?php
session_start();
require '../../db/db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') 
{
    header('Location: ../../login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['backup_file'])) {
    $backup_file = $_FILES['backup_file']['tmp_name'];
    $mysql_path = 'E:\\xampp\\mysql\\bin\\mysql.exe';
    $command = "{$mysql_path} --user={$username} --password={$password} --host={$server} {$database} < {$backup_file}";

    $output = [];
    $result = 0;

    exec($command, $output, $result);
    if ($result === 0) {
        $_SESSION['restore_message'] = 'Database restored successfully!';
    } else {
        $_SESSION['restore_message'] = 'Error restoring database. Output: ' . implode("\n", $output);
    }
    header('Location: admin_backup.php');
    exit;
}
?>