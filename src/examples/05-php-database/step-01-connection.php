<?php
require_once __DIR__ . '/lib/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include __DIR__ . '/inc/head_content.php'; ?>
    <title>Step 1: PDO Connection - PHP Database</title>
</head>
<body>
    <div class="container">
        <div class="back-link">
            <a href="index.php">&larr; Back to Database Access</a>
            <a href="/exercises/05-php-database/step-01-connection.php">Go to Exercise &rarr;</a>
        </div>

        <h1>Step 1: PDO Connection</h1>

        <p>
            PDO (PHP Data Objects) is a database abstraction layer that provides a consistent
            interface for accessing databases in PHP. It supports multiple database systems
            including MySQL, PostgreSQL, SQLite, and more.
        </p>

        <!-- Example 1: Basic Connection -->
        <h2>Basic PDO Connection</h2>

        <p>To connect to a database, you need to create a new PDO object with a DSN (Data Source Name),
        username, and password.</p>

        <pre><code class="language-php">&lt;?php
// Database credentials
$host = 'mysql-container';
$dbname = 'testdb';
$username = 'testuser';
$password = 'mysecret';

// Build the DSN
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

try {
    // Create PDO connection
    $db = new PDO($dsn, $username, $password);
    echo "Connected successfully!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}</code></pre>

        <p class="output-label">Output:</p>
        <div class="output">
            <?php
            // Database credentials
            $host = 'mysql-container';
            $dbname = 'testdb';
            $username = 'testuser';
            $password = 'mysecret';

            // Build the DSN
            $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

            try {
                // Create PDO connection
                $db = new PDO($dsn, $username, $password);
                echo "<p class='success'>Connected successfully!</p>";
            } catch (PDOException $e) {
                echo "<p class='error'>Connection failed: " . $e->getMessage() . "</p>";
            }
            ?>
        </div>

        <!-- Example 2: PDO Options -->
        <h2>Configuring PDO Options</h2>

        <p>PDO can be configured with various options to control its behavior. The most important ones are:</p>

        <ul>
            <li><strong>ERRMODE_EXCEPTION</strong> - Throws exceptions on errors (recommended)</li>
            <li><strong>FETCH_ASSOC</strong> - Returns rows as associative arrays by default</li>
            <li><strong>EMULATE_PREPARES = false</strong> - Uses native prepared statements</li>
        </ul>

        <pre><code class="language-php">&lt;?php
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $db = new PDO($dsn, $username, $password, $options);
    echo "Connected with options configured!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}</code></pre>

        <p class="output-label">Output:</p>
        <div class="output">
            <?php
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            try {
                $db = new PDO($dsn, $username, $password, $options);
                echo "<p class='success'>Connected with options configured!</p>";
            } catch (PDOException $e) {
                echo "<p class='error'>Connection failed: " . $e->getMessage() . "</p>";
            }
            ?>
        </div>

        <!-- Example 3: Using Config Constants -->
        <h2>Using Configuration Constants</h2>

        <p>In a real application, you would store database credentials in a configuration file.
        Our <code>lib/config.php</code> defines constants for this purpose:</p>

        <pre><code class="language-php">// In lib/config.php:
define('DB_HOST', 'mysql-container');
define('DB_NAME', 'testdb');
define('DB_USER', 'testuser');
define('DB_PASS', 'mysecret');
define('DB_CHARSET', 'utf8mb4');

define('DB_DSN', 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET);

define('DB_OPTIONS', [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
]);

// Usage:
$db = new PDO(DB_DSN, DB_USER, DB_PASS, DB_OPTIONS);
echo "<p class='success'>Connected using config constants!</p>";</code></pre>

        <p class="output-label">Output:</p>
        <div class="output">
            <?php
            try {
                $db = new PDO(DB_DSN, DB_USER, DB_PASS, DB_OPTIONS);
                echo "<p class='success'>Connected using config constants!</p>";
            } catch (PDOException $e) {
                echo "<p class='error'>Connection failed: " . $e->getMessage() . "</p>";
            }
            ?>
        </div>

        <!-- Example 4: Error Modes Comparison -->
        <h2>Understanding Error Modes</h2>

        <p>PDO has three error handling modes:</p>

        <table class="reference-table">
            <thead>
                <tr>
                    <th>Mode</th>
                    <th>Behavior</th>
                    <th>Use Case</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><code>ERRMODE_SILENT</code></td>
                    <td>Sets error codes only (check with errorInfo())</td>
                    <td>Legacy code</td>
                </tr>
                <tr>
                    <td><code>ERRMODE_WARNING</code></td>
                    <td>Emits PHP warnings</td>
                    <td>Development/debugging</td>
                </tr>
                <tr>
                    <td><code>ERRMODE_EXCEPTION</code></td>
                    <td>Throws PDOException</td>
                    <td><strong>Recommended</strong></td>
                </tr>
            </tbody>
        </table>

        <div class="warning">
            <strong>Always use ERRMODE_EXCEPTION</strong> - It allows you to use try/catch blocks
            for proper error handling, and errors won't silently fail.
        </div>

        <h2>Key Concepts</h2>

        <ul>
            <li><strong>DSN (Data Source Name)</strong> - Connection string specifying the database type, host, name, and charset</li>
            <li><strong>PDOException</strong> - Exception thrown when connection or query fails</li>
            <li><strong>PDO Options</strong> - Configuration settings passed as the fourth parameter</li>
        </ul>
    </div>

    <script src="/examples/js/prism-core.min.js"></script>
    <script src="/examples/js/prism-autoloader.min.js" data-autoloader-path="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/"></script>
</body>
</html>
