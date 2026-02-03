<?php
require_once 'lib/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'inc/head_content.php'; ?>
    <title>PHP Database with PDO - Examples</title>
</head>
<body>
    <div class="container">
        <div class="back-link">
            <a href="/index.php">&larr; Back to Module Index</a>
            <a href="/exercises/05-php-database/">Go to Exercises &rarr;</a>
        </div>

        <h1>PHP Database with PDO</h1>

        <p>
            Learn how to interact with MySQL databases using PHP's PDO (PHP Data Objects) extension.
            This series progresses from basic connections through to implementing the Active Record
            design pattern for clean, object-oriented database code.
        </p>

        <div class="info">
            <strong>Prerequisites:</strong> Before starting, run the SQL script at
            <code>/sql/games.sql</code> to create the required tables and sample data.
        </div>

        <h2>Phase 1: PDO Fundamentals</h2>

        <ol class="step-list">
            <li>
                <a href="step-01-connection.php"><strong>PDO Connection</strong></a>
                <p>Connect to MySQL using PDO, configure error handling, and test your connection.</p>
            </li>
            <li>
                <a href="step-02-select.php"><strong>SELECT Queries</strong></a>
                <p>Fetch data using query(), fetch modes, and display results in HTML tables.</p>
            </li>
            <li>
                <a href="step-03-prepared-statements.php"><strong>Prepared Statements</strong></a>
                <p>Use prepared statements with named parameters to prevent SQL injection.</p>
            </li>
        </ol>

        <h2>Phase 2: CRUD Operations</h2>

        <ol class="step-list" start="4">
            <li>
                <a href="step-04-insert.php"><strong>INSERT Operations</strong></a>
                <p>Add new records to the database and retrieve auto-generated IDs.</p>
            </li>
            <li>
                <a href="step-05-update.php"><strong>UPDATE Operations</strong></a>
                <p>Modify existing records and verify changes with rowCount().</p>
            </li>
            <li>
                <a href="step-06-delete.php"><strong>DELETE Operations</strong></a>
                <p>Remove records safely and handle related data considerations.</p>
            </li>
        </ol>

        <h2>Phase 3: Active Record Pattern</h2>

        <ol class="step-list" start="7">
            <li>
                <a href="step-07-db-singleton.php"><strong>Database Singleton Class</strong></a>
                <p>Create a reusable DB class using the Singleton pattern for connection management.</p>
            </li>
            <li>
                <a href="step-08-model-basics.php"><strong>Model Class Basics</strong></a>
                <p>Build a Game class with properties, constructor, and data hydration.</p>
            </li>
            <li>
                <a href="step-09-finder-methods.php"><strong>Static Finder Methods</strong></a>
                <p>Add findAll(), findById(), and custom finder methods that return objects.</p>
            </li>
            <li>
                <a href="step-10-active-record.php"><strong>Complete Active Record</strong></a>
                <p>Implement save() and delete() methods for full CRUD through objects.</p>
            </li>
        </ol>

        <hr>

        <h2>Quick Reference</h2>

        <table class="reference-table">
            <thead>
                <tr>
                    <th>Method/Concept</th>
                    <th>Purpose</th>
                    <th>Example</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><code>new PDO()</code></td>
                    <td>Create database connection</td>
                    <td><code>new PDO($dsn, $user, $pass)</code></td>
                </tr>
                <tr>
                    <td><code>prepare()</code></td>
                    <td>Prepare a SQL statement</td>
                    <td><code>$db->prepare("SELECT * FROM games WHERE id = :id")</code></td>
                </tr>
                <tr>
                    <td><code>execute()</code></td>
                    <td>Execute prepared statement</td>
                    <td><code>$stmt->execute(['id' => 1])</code></td>
                </tr>
                <tr>
                    <td><code>fetch()</code></td>
                    <td>Get single row</td>
                    <td><code>$row = $stmt->fetch()</code></td>
                </tr>
                <tr>
                    <td><code>fetchAll()</code></td>
                    <td>Get all rows</td>
                    <td><code>$rows = $stmt->fetchAll()</code></td>
                </tr>
                <tr>
                    <td><code>lastInsertId()</code></td>
                    <td>Get auto-generated ID</td>
                    <td><code>$id = $db->lastInsertId()</code></td>
                </tr>
                <tr>
                    <td><code>rowCount()</code></td>
                    <td>Count affected rows</td>
                    <td><code>$count = $stmt->rowCount()</code></td>
                </tr>
            </tbody>
        </table>

        <h2>Files Overview</h2>

        <table class="reference-table">
            <thead>
                <tr>
                    <th>File</th>
                    <th>Purpose</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><code>lib/config.php</code></td>
                    <td>Database credentials and autoloader configuration</td>
                </tr>
                <tr>
                    <td><code>classes/DB.php</code></td>
                    <td>Singleton class for database connection management</td>
                </tr>
                <tr>
                    <td><code>classes/Game.php</code></td>
                    <td>Active Record model for the games table</td>
                </tr>
            </tbody>
        </table>
    </div>

    <script src="/examples/js/prism-core.min.js"></script>
    <script src="/examples/js/prism-autoloader.min.js" data-autoloader-path="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/"></script>
</body>
</html>
