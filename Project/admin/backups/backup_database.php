<?php
session_start();
require '../../db/db.php';


if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') 
{
    header('Location: ../../login.php');
    exit;
}

$backup_file = 'backup_' . date('Y-m-d_H-i-s') . '.sql';
$mysqldump_path = 'E:\\xampp\\mysql\\bin\\mysqldump.exe'; 
$command = "{$mysqldump_path} --user={$username} --password={$password} --host={$server} {$database} > {$backup_file}";

$output = [];
$result = 0;

exec($command, $output, $result);

if ($result === 0) {
    $_SESSION['backup_message'] = 'Database backup created successfully!';
} else {
    $_SESSION['backup_message'] = 'Error creating database backup. Output: ' . implode("\n", $output);
}

header('Location: admin_backup.php');
exit;
?>