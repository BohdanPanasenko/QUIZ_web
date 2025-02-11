<?php
require 'db/db.php';

// Fetch the latest questions
$query = "SELECT id, question FROM questions ORDER BY id DESC LIMIT 10";
$result = $db->query($query);

header('Content-Type: application/rss+xml; charset=UTF-8');

echo '<?xml version="1.0" encoding="UTF-8" ?>';
echo '<rss version="2.0">';
echo '<channel>';
echo '<title>Quiz Application Questions</title>';
echo '<link>http://localhost:84/Project</link>';
echo '<description>Latest questions from the Quiz Application</description>';
echo '<language>en-us</language>';

while ($row = $result->fetch_assoc()) {
    echo '<item>';
    echo '<title>' . htmlspecialchars($row['question']) . '</title>';
    echo '<link>http://localhost:84/Project/question.php?id=' . $row['id'] . '</link>';
    echo '<description>' . htmlspecialchars($row['question']) . '</description>';
    echo '</item>';
}

echo '</channel>';
echo '</rss>';
?>