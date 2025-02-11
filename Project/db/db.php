<?php
$server = 'localhost'; 
$username = 'root'; 
$password = ''; 
$database = 'quizDB'; 

$db = @new MySQLi($server, $username, $password, $database);

if ($db->connect_error) 
{
    print 'Error connecting: ' . $db->connect_error;
 exit();
}
?>