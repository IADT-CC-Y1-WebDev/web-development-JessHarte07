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
    <title>Exercise 4: INSERT Operations - PHP Database</title>
</head>
<body>
    <div class="container">
        <div class="back-link">
            <a href="index.php">&larr; Back to Database Access</a>
            <a href="/examples/05-php-database/step-04-insert.php">View Example &rarr;</a>
        </div>

        <h1>Exercise 4: INSERT Operations</h1>

        <h2>Task</h2>
        <p>Insert a new book into the database.</p>

        <h3>Requirements:</h3>
        <ol>
            <li>Use a prepared statement to insert a new book</li>
            <li>Include title, author, publisher_id (use 1), year, and description</li>
            <li>Get and display the new book's ID using <code>lastInsertId()</code></li>
            <li>Verify the insert using <code>rowCount()</code></li>
        </ol>

        <h3>Book to Insert:</h3>
        <ul>
            <li>Title: "My Favorite Book"</li>
            <li>Author: "Your Name"</li>
            <li>Publisher ID: 1</li>
            <li>Year: 2024</li>
            <li>Description: "A book I created for learning PDO"</li>
        </ul>

        <h3>Your Solution:</h3>
        <div class="output">
            <?php
            // TODO: Write your solution here
            // 1. Prepare INSERT INTO books (title, author, ...) VALUES (:title, :author, ...)
            // 2. Execute with the book data
            // 3. Check rowCount() === 1
            // 4. Get lastInsertId()
            // 5. Display success message with the new ID

            $stmt = $db->prepare("
                INSERT INTO books (title, author, publisher_id, year, description)
                VALUES (:title, :author, :publisher_id, :year, :description)
            ");

            $success = $stmt->execute([
                'title' => 'My Favorite Book',
                'author' => 'Your Name',
                'publisher_id' => 1,
                'year' => 2024,  
                'description' => 'A book I created for learning PDO'
            ]);


            
            if ($success && $stmt->rowCount() === 1) {
                $newId = $db->lastInsertId();
                echo "<p>Book inserted successfully! New ID: $newId</p>";
            } else {
                echo "<p class='error'>Insert failed</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
