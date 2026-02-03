<?php
require_once __DIR__ . '/lib/config.php';
// =============================================================================
// Create PDO connection
// =============================================================================
try {
    $db = new PDO(DB_DSN, DB_USER, DB_PASS, DB_OPTIONS);
} 
catch (PDOException $e) {
    echo "<p class='error'>Connection failed: " . $e->getMessage() . "</p>";
    exit();
}
// =============================================================================
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include __DIR__ . '/inc/head_content.php'; ?>
    <title>Exercise 3: Prepared Statements - PHP Database</title>
</head>
<body>
    <div class="container">
        <div class="back-link">
            <a href="index.php">&larr; Back to Database Access</a>
            <a href="/examples/05-php-database/step-03-prepared-statements.php">View Example &rarr;</a>
        </div>

        <h1>Exercise 3: Prepared Statements</h1>

        <h2>Task 1: Find Book by ID</h2>
        <p>Use a prepared statement to find a book by its ID.</p>

        <h3>Requirements:</h3>
        <ol>
            <li>Use <code>prepare()</code> with a named parameter <code>:id</code></li>
            <li>Find the book with ID 1</li>
            <li>Display the book's title and author, or "Not found" message</li>
        </ol>

        <h3>Your Solution:</h3>
        <div class="output">
            <?php
            // TODO: Write your solution here
            // 1. Prepare: SELECT * FROM books WHERE id = :id
            // 2. Execute with ['id' => 1]
            // 3. Fetch and display result
            ?>
        </div>

        <h2>Task 2: Find Books by Author</h2>
        <p>Use a prepared statement with LIKE to find books by author name.</p>

        <h3>Requirements:</h3>
        <ol>
            <li>Search for books where author contains "George"</li>
            <li>Display all matching books</li>
        </ol>

        <h3>Your Solution:</h3>
        <div class="output">
            <?php
            // TODO: Write your solution here
            // 1. Prepare: SELECT * FROM books WHERE author LIKE :search
            // 2. Execute with ['search' => '%George%']
            // 3. Loop through and display results
            ?>
        </div>
    </div>
</body>
</html>
