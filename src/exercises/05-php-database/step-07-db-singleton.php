<?php
require_once __DIR__ . '/lib/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include __DIR__ . '/inc/head_content.php'; ?>
    <title>Exercise 7: Database Singleton - PHP Database</title>
</head>
<body>
    <div class="container">
        <div class="back-link">
            <a href="index.php">&larr; Back to Database Access</a>
            <a href="/examples/05-php-database/step-07-db-singleton.php">View Example &rarr;</a>
        </div>

        <h1>Exercise 7: Database Singleton Class</h1>

        <h2>Task</h2>
        <p>Use the DB singleton class to get database connections.</p>

        <h3>Requirements:</h3>
        <ol>
            <li>Get a connection using <code>DB::getInstance()->getConnection()</code></li>
            <li>Execute a simple query to count books</li>
            <li>Prove it's a singleton by getting the instance twice and comparing</li>
        </ol>

        <h3>Your Solution:</h3>
        <div class="output">
            <?php
            // TODO: Write your solution here
            // 1. Get connection: $db = DB::getInstance()->getConnection();
            // 2. Execute: SELECT COUNT(*) as total FROM books
            // 3. Display the count
            // 4. Get DB::getInstance() twice and compare with ===
            // 5. Display whether they are the same instance

            
                
                $dbInstance1 = DB::getInstance();
                $db = $dbInstance1->getConnection();

                
                $stmt = $db->query("SELECT COUNT(*) AS total_books FROM books");
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                
                echo "<p>Total books in the database: " . $result['total_books'] . "</p>";

                
                $dbInstance2 = DB::getInstance();

                
                if ($dbInstance1 === $dbInstance2) {
                    echo "<p>Singleton confirmed: both instances are identical.</p>";
                } else {
                    echo "<p class='error'>Singleton failed: instances are different!</p>";
                }
                

            
            ?>
        </div>
    </div>
</body>
</html>
