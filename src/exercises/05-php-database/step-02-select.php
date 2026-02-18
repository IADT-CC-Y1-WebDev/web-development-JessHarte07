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
    <title>Exercise 2: SELECT Queries - PHP Database</title>
</head>
<body>
    <div class="container">
        <div class="back-link">
            <a href="index.php">&larr; Back to Database Access</a>
            <a href="/examples/05-php-database/step-02-select.php">View Example &rarr;</a>
        </div>

        <h1>Exercise 2: SELECT Queries</h1>

        <h2>Task</h2>
        <p>Fetch all books from the database and display them in an HTML table.</p>

        <h3>Requirements:</h3>
        <ol>
            <li>Execute a SELECT query to get all books ordered by title</li>
            <li>Display the results in a table with columns: ID, Title, Author, Year</li>
            <li>Use <code>htmlspecialchars()</code> to escape output</li>
            <li>Show the total count of books</li>
        </ol>

        <h3>Hints:</h3>
        <ul>
            <li>Use <code>$db->query()</code> for queries without parameters</li>
            <li>Use <code>fetchAll()</code> to get all rows at once</li>
        </ul>

        <h2>Your Solution</h2>
        <div class="output">
            <?php
            // TODO: Write your solution here
            // 1. Execute SELECT * FROM books ORDER BY title
            // 2. Fetch all results
            // 3. Display count
            // 4. Create HTML table with the results

            $stmt = $db->query("SELECT * FROM books ORDER BY title");
                $books = $stmt->fetchAll();

                echo "<p>Found " . count($books) . " books</p>";
                foreach ($books as $book) {
                    echo "<p>" . $book['title'] . " (" . $book['id'] . ") (" . $book['author'] . ") (" . $book['year'] . ")</p>";
                }

                $stmt = $db->query("SELECT * FROM books");
                    $books = $stmt->fetchAll();
                    echo "Total books: " . count($books);

                
$stmt = $db->query("SELECT id, title, author, year, description FROM books ORDER BY title");
$books = $stmt->fetchAll();



?>


                <table class="data-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Year</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($books as $book): ?>
        <tr>
            <td><?= $book['id'] ?></td>
            <td><?= htmlspecialchars($book['title']) ?></td>
            <td><?= $book['author'] ?></td>
            <td><?= $book['year'] ?></td>
            <td><?= htmlspecialchars(substr($book['description'], 0, 50)) ?>...</td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
            
        </div>
    </div>
</body>
</html>
