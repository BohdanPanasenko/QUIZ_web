<?php
include 'templates/header.tpl.php';
?>
<?php

$is_admin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
$result = $db->query('
    SELECT u.username, l.score
    FROM leaderboard l
    JOIN users u ON l.user_id = u.id
    ORDER BY l.score DESC
');
$scores = $result->fetch_all(MYSQLI_ASSOC);
?>


        <main>
            <h1>Leaderboard</h1>
            <table>
                <thead>
                    <tr>
                        <th>Rank</th>
                        <th>Username</th>
                        <th>Score</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($scores)): ?>
                        <?php foreach ($scores as $index => $row): ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo htmlspecialchars($row['username']); ?></td>
                                <td><?php echo htmlspecialchars($row['score']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">No data available</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        <?php if ($is_admin): ?>
            <form action="reset_leaderboard.php" method="POST">
                <button type="submit" class="btn">Reset</button>
            </form>
        <?php endif; ?>
        </main>

        <?php
include 'templates/footer.tpl.php';
?>