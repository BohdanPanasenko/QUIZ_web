<?php
$conn = new mysqli('localhost', 'root', '', '');


if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS quizDB";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully!\n";
} else {
    die("Error creating database: " . $conn->error);
}

$conn->select_db('quizDB');

$sql = "CREATE TABLE IF NOT EXISTS users (
    id int AUTO_INCREMENT primary key,
    username varchar(50) not null,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    role ENUM('admin', 'player') NOT NULL DEFAULT 'player',
    status ENUM('active', 'inactive', 'blocked') NOT NULL DEFAULT 'inactive',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    failed_login_attempts INT not null default 0,
    last_failed_login TIMESTAMP NULL DEFAULT NULL
    )";
$conn->query($sql);


$sql = "CREATE TABLE IF NOT EXISTS questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question TEXT NOT NULL,
    option1 TEXT NOT NULL,
    option2 TEXT NOT NULL,
    option3 TEXT NOT NULL,
    option4 TEXT NOT NULL,
    correct_option INT NOT NULL,
)";

$sql = "CREATE TABLE IF NOT EXISTS leaderboard (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    score INT NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
)";
$conn->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    event_type ENUM('login', 'logout', 'db_modification)) NOT NULL,
    event_description TEXT NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
)";

$sql = "CREATE TABLE if not exists settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_name VARCHAR(255) NOT NULL,
    setting_value VARCHAR(255) NOT NULL
)";

$sql = "ALTER TABLE users ADD FULLTEXT (username, email)";
$conn->query($sql);
$sql = "ALTER TABLE questions ADD FULLTEXT (question, option1, option2, option3, option4)";
$conn->query($sql);

$conn->close();
?>
