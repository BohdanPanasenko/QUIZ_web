<?php
session_start();
require 'db/db.php';

$is_logged_in = isset($_SESSION['user_id']);

$settings = [];
$result = $db->query("SELECT setting_name, setting_value FROM settings");
while ($row = $result->fetch_assoc()) 
{
    $settings[$row['setting_name']] = $row['setting_value'];
}

if ($is_logged_in) 
{
    // Registered (for  bullet 20)
    $query = "SELECT id, username, email FROM users";
} 
else 
{
    // Unregistered
    $elements_per_page = intval($settings['elements_per_page']);
    $query = "SELECT username FROM users LIMIT $elements_per_page";
}

$result = $db->query($query);

$users = [];
while ($row = $result->fetch_assoc()) 
{
    $users[] = $row;
}
$server_time = date('Y-m-d H:i:s');

//json
header('Content-Type: application/json');
echo json_encode(['users' => $users, 'server_time' => $server_time]);
?>