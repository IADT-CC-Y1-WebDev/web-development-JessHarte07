<?php
require_once __DIR__ . '/lib/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include __DIR__ . '/inc/head_content.php'; ?>
    <title>Exercise 9: Finder Methods - PHP Database</title>
</head>
<body>
    <div class="container">
        <div class="back-link">
            <a href="index.php">&larr; Back to Database Access</a>
            <a href="/examples/05-php-database/step-09-finder-methods.php">View Example &rarr;</a>
        </div>

        <h1>Exercise 9: Static Finder Methods</h1>

        <h2>Task</h2>
        <p>Implement the static finder methods in the Book class.</p>

        <h3>Methods to Implement:</h3>
        <ol>
            <li><code>findAll()</code> - Return array of all Book objects</li>
            <li><code>findById($id)</code> - Return single Book or null</li>
            <li><code>findByPublisher($publisherId)</code> - Return array of Books</li>
        </ol>

        <h3>Test findAll():</h3>
        <div class="output">
            <?php
            $books = Book::findAll();
            if (empty($books)) {
                echo "<p class='warning'>findAll() not implemented or returns empty</p>";
            } else {
                echo "<p class='success'>Found " . count($books) . " books</p>";
                echo "<ul>";
                foreach (array_slice($books, 0, 3) as $book) {
                    echo "<li>" . htmlspecialchars($book->title ?? 'No title') . "</li>";
                }
                if (count($books) > 3) {
                    echo "<li>... and " . (count($books) - 3) . " more</li>";
                }
                echo "</ul>";
            }
            ?>
        </div>

        <h3>Test findById(1):</h3>
        <div class="output">
            <?php
            $book = Book::findById(1);
            if ($book === null) {
                echo "<p class='warning'>findById() not implemented or book not found</p>";
            } else {
                echo "<p class='success'>Found book: " . htmlspecialchars($book->title ?? 'No title') . "</p>";
                echo "<p>Author: " . htmlspecialchars($book->author ?? 'No author') . "</p>";
            }
            ?>
        </div>

        <h3>Test findById(9999) - Non-existent:</h3>
        <div class="output">
            <?php
            $book = Book::findById(9999);
            if ($book === null) {
                echo "<p class='success'>Correctly returned null for non-existent book</p>";
            } else {
                echo "<p class='warning'>Should return null for non-existent ID</p>";
            }
            ?>
        </div>

        <h3>Test findByPublisher(1):</h3>
        <div class="output">
            <?php
            $books = Book::findByPublisher(1);
            if (empty($books)) {
                echo "<p class='warning'>findByPublisher() not implemented or no books found</p>";
            } else {
                echo "<p class='success'>Found " . count($books) . " books for publisher 1:</p>";
                echo "<ul>";
                foreach ($books as $book) {
                    echo "<li>" . htmlspecialchars($book->title ?? 'No title') . "</li>";
                }
                echo "</ul>";
            }
            ?>
        </div>
    </div>
</body>
</html>
