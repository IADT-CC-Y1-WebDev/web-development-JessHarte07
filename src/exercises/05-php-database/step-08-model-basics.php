<?php
require_once __DIR__ . '/lib/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include __DIR__ . '/inc/head_content.php'; ?>
    <title>Exercise 8: Model Class Basics - PHP Database</title>
</head>
<body>
    <div class="container">
        <div class="back-link">
            <a href="index.php">&larr; Back to Database Access</a>
            <a href="/examples/05-php-database/step-08-model-basics.php">View Example &rarr;</a>
        </div>

        <h1>Exercise 8: Book Class Basics</h1>

        <h2>Task</h2>
        <p>Implement the basic structure of the Book class in <code>classes/Book.php</code>.</p>

        <h3>Requirements:</h3>
        <ol>
            <li>Implement the constructor to:
                <ul>
                    <li>Get the DB connection from the singleton</li>
                    <li>Populate properties from $data array if provided</li>
                </ul>
            </li>
            <li>Implement the <code>toArray()</code> method</li>
        </ol>

        <h3>Test Your Implementation:</h3>
        <div class="output">
            <?php
            // Test 1: Create empty Book
            $book = new Book();
            echo "<h4>Test 1: Empty Book</h4>";
            echo "<p>Title: " . ($book->title ?? 'null') . "</p>";

            // Test 2: Create Book from data
            $data = [
                'id' => 99,
                'title' => 'Test Book',
                'author' => 'Test Author',
                'publisher_id' => 1,
                'year' => 2024,
                'isbn' => '123-456-789',
                'description' => 'A test book',
                'cover_filename' => 'test.jpg'
            ];
            $book2 = new Book($data);
            echo "<h4>Test 2: Book from Data</h4>";
            echo "<p>Title: " . htmlspecialchars($book2->title ?? 'NOT IMPLEMENTED') . "</p>";
            echo "<p>Author: " . htmlspecialchars($book2->author ?? 'NOT IMPLEMENTED') . "</p>";

            // Test 3: toArray
            echo "<h4>Test 3: toArray()</h4>";
            $array = $book2->toArray();
            if (empty($array)) {
                echo "<p class='warning'>toArray() not implemented yet</p>";
            } else {
                echo "<pre>" . print_r($array, true) . "</pre>";
            }
            ?>
        </div>
    </div>
</body>
</html>
