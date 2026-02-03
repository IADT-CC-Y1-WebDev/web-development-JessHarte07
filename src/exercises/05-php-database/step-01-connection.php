<?php
require_once __DIR__ . '/lib/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include __DIR__ . '/inc/head_content.php'; ?>
    <title>Exercise 1: PDO Connection - PHP Database</title>
</head>
<body>
    <div class="container">
        <div class="back-link">
            <a href="index.php">&larr; Back to Database Access</a>
            <a href="/examples/05-php-database/step-01-connection.php">View Example &rarr;</a>
        </div>

        <h1>Exercise 1: PDO Connection</h1>

        <h2>Task</h2>
        <p>Create a PDO connection to the database and display the connection status.</p>

        <h3>Requirements:</h3>
        <ol>
            <li>Create a PDO connection using the credentials from config.php</li>
            <li>Set the error mode to ERRMODE_EXCEPTION</li>
            <li>Display a success message if connected</li>
            <li>Catch and display any connection errors</li>
        </ol>

        <h3>Hints:</h3>
        <ul>
            <li>Use the constants DB_DSN, DB_USER, DB_PASS, and DB_OPTIONS</li>
            <li>Wrap the connection in a try/catch block</li>
        </ul>

        <h2>Your Solution</h2>
        <div class="output">
            <?php
            // TODO: Write your solution here
            // 1. Create a PDO connection
            // 2. Display success message
            // 3. Handle errors with try/catch
            ?>
        </div>
    </div>
</body>
</html>
