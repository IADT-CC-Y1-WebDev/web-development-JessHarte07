<?php
require_once 'lib/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'inc/head_content.php'; ?>
    <title>PHP Database with PDO - Exercises</title>
</head>
<body>
    <div class="container">
        <div class="back-link">
            <a href="/index.php">&larr; Back to Module Index</a>
            <a href="/examples/05-php-database/">View Examples &rarr;</a>
        </div>

        <h1>PHP Database with PDO - Exercises</h1>

        <p>
            Practice database access using PHP's PDO extension. These exercises use a
            <strong>Books</strong> case study with Publisher (one-to-many) and Format
            (many-to-many) relationships.
        </p>

        <div class="info">
            <strong>Setup Required:</strong> Before starting, run the SQL script at
            <code>/sql/books.sql</code> to create the required tables and sample data.
        </div>

        <h2>Phase 1: PDO Fundamentals</h2>

        <ol class="step-list">
            <li>
                <a href="step-01-connection.php"><strong>Exercise 1: PDO Connection</strong></a>
                <p>Connect to the database and display connection status.</p>
            </li>
            <li>
                <a href="step-02-select.php"><strong>Exercise 2: SELECT Queries</strong></a>
                <p>Fetch all books and display them in an HTML table.</p>
            </li>
            <li>
                <a href="step-03-prepared-statements.php"><strong>Exercise 3: Prepared Statements</strong></a>
                <p>Find books by ID and by author using safe parameterized queries.</p>
            </li>
        </ol>

        <h2>Phase 2: CRUD Operations</h2>

        <ol class="step-list" start="4">
            <li>
                <a href="step-04-insert.php"><strong>Exercise 4: INSERT Operations</strong></a>
                <p>Add a new book to the database.</p>
            </li>
            <li>
                <a href="step-05-update.php"><strong>Exercise 5: UPDATE Operations</strong></a>
                <p>Modify an existing book's details.</p>
            </li>
            <li>
                <a href="step-06-delete.php"><strong>Exercise 6: DELETE Operations</strong></a>
                <p>Remove a book from the database.</p>
            </li>
        </ol>

        <h2>Phase 3: Active Record Pattern</h2>

        <ol class="step-list" start="7">
            <li>
                <a href="step-07-db-singleton.php"><strong>Exercise 7: Database Singleton</strong></a>
                <p>Use the DB singleton class for connection management.</p>
            </li>
            <li>
                <a href="step-08-model-basics.php"><strong>Exercise 8: Book Class Basics</strong></a>
                <p>Create the Book class with properties and constructor.</p>
            </li>
            <li>
                <a href="step-09-finder-methods.php"><strong>Exercise 9: Finder Methods</strong></a>
                <p>Implement findAll(), findById(), and findByPublisher().</p>
            </li>
            <li>
                <a href="step-10-active-record.php"><strong>Exercise 10: Complete Active Record</strong></a>
                <p>Implement save() and delete() methods to complete the pattern.</p>
            </li>
        </ol>

        <hr>

        <h2>Books Schema Reference</h2>

        <table class="reference-table">
            <thead>
                <tr>
                    <th>Column</th>
                    <th>Type</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><code>id</code></td>
                    <td>INT (PK, AUTO_INCREMENT)</td>
                    <td>Primary key</td>
                </tr>
                <tr>
                    <td><code>title</code></td>
                    <td>VARCHAR(255)</td>
                    <td>Book title</td>
                </tr>
                <tr>
                    <td><code>author</code></td>
                    <td>VARCHAR(255)</td>
                    <td>Author name</td>
                </tr>
                <tr>
                    <td><code>publisher_id</code></td>
                    <td>INT (FK)</td>
                    <td>Reference to publishers table</td>
                </tr>
                <tr>
                    <td><code>year</code></td>
                    <td>INT</td>
                    <td>Year published</td>
                </tr>
                <tr>
                    <td><code>isbn</code></td>
                    <td>VARCHAR(20)</td>
                    <td>ISBN number</td>
                </tr>
                <tr>
                    <td><code>description</code></td>
                    <td>TEXT</td>
                    <td>Book description</td>
                </tr>
                <tr>
                    <td><code>cover_filename</code></td>
                    <td>VARCHAR(255)</td>
                    <td>Cover image filename</td>
                </tr>
            </tbody>
        </table>

        <h2>Related Tables</h2>

        <table class="reference-table">
            <thead>
                <tr>
                    <th>Table</th>
                    <th>Relationship</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><code>publishers</code></td>
                    <td>One-to-Many</td>
                    <td>A book has a single publisher; a publisher can have many books</td>
                </tr>
                <tr>
                    <td><code>formats</code></td>
                    <td>Many-to-Many</td>
                    <td>A book can have multiple formats; a format can have multiple books</td>
                </tr>
                <tr>
                    <td><code>book_format</code></td>
                    <td>-</td>
                    <td>Implements many-to-many relationship between books and formats</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
