<?php
require_once __DIR__ . '/lib/config.php';

// Create database connection
$db = new PDO(DB_DSN, DB_USER, DB_PASS, DB_OPTIONS);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include __DIR__ . '/inc/head_content.php'; ?>
    <title>Step 4: INSERT Operations - PHP Database</title>
</head>
<body>
    <div class="container">
        <div class="back-link">
            <a href="index.php">&larr; Back to Database Access</a>
            <a href="/exercises/05-php-database/step-04-insert.php">Go to Exercise &rarr;</a>
        </div>

        <h1>Step 4: INSERT Operations</h1>

        <p>
            INSERT operations add new records to your database. Always use prepared statements
            to prevent SQL injection when inserting user-provided data.
        </p>

        <!-- Example 1: Basic INSERT -->
        <h2>Basic INSERT</h2>

        <pre><code class="language-php">&lt;?php
$stmt = $db->prepare("
    INSERT INTO games (title, release_date, genre_id, description)
    VALUES (:title, :release_date, :genre_id, :description)
");

$stmt->execute([
    'title' => 'New Game Title',
    'release_date' => '2024-01-15',
    'genre_id' => 1,
    'description' => 'An exciting new game.'
]);

echo "Game inserted successfully!";</code></pre>

        <p class="output-label">Output:</p>
        <div class="output">
            <?php
            // Check if we've already inserted this game (to avoid duplicates on refresh)
            $checkStmt = $db->prepare("SELECT id FROM games WHERE title = :title");
            $checkStmt->execute(['title' => 'Cyberpunk Demo']);
            $existing = $checkStmt->fetch();

            if (!$existing) {
                $stmt = $db->prepare("
                    INSERT INTO games (title, release_date, genre_id, description)
                    VALUES (:title, :release_date, :genre_id, :description)
                ");

                $stmt->execute([
                    'title' => 'Cyberpunk Demo',
                    'release_date' => '2024-01-15',
                    'genre_id' => 1,
                    'description' => 'A demo game for learning INSERT.'
                ]);

                echo "<p class='success'>Game inserted successfully!</p>";
            } else {
                echo "<p class='info'>Demo game already exists (ID: {$existing['id']}). Refresh won't create duplicates.</p>";
            }
            ?>
        </div>

        <!-- Example 2: Getting the Last Insert ID -->
        <h2>Getting the Last Insert ID</h2>

        <p>After an INSERT, use <code>lastInsertId()</code> to get the auto-generated primary key.</p>

        <pre><code class="language-php">&lt;?php
$stmt = $db->prepare("
    INSERT INTO games (title, release_date, genre_id, description)
    VALUES (:title, :release_date, :genre_id, :description)
");

$stmt->execute([
    'title' => 'Another New Game',
    'release_date' => '2024-06-01',
    'genre_id' => 2,
    'description' => 'Testing lastInsertId().'
]);

// Get the ID of the newly inserted record
$newId = $db->lastInsertId();
echo "Inserted game with ID: $newId";</code></pre>

        <p class="output-label">Output:</p>
        <div class="output">
            <?php
            $checkStmt = $db->prepare("SELECT id FROM games WHERE title = :title");
            $checkStmt->execute(['title' => 'Adventure Quest Demo']);
            $existing = $checkStmt->fetch();

            if (!$existing) {
                $stmt = $db->prepare("
                    INSERT INTO games (title, release_date, genre_id, description)
                    VALUES (:title, :release_date, :genre_id, :description)
                ");

                $stmt->execute([
                    'title' => 'Adventure Quest Demo',
                    'release_date' => '2024-06-01',
                    'genre_id' => 2,
                    'description' => 'Testing lastInsertId().'
                ]);

                $newId = $db->lastInsertId();
                echo "<p class='success'>Inserted game with ID: $newId</p>";
            } else {
                echo "<p class='info'>Demo game already exists with ID: {$existing['id']}</p>";
            }
            ?>
        </div>

        <!-- Example 3: Checking for Success -->
        <h2>Checking for Success</h2>

        <p>Use <code>rowCount()</code> to verify the INSERT affected exactly one row.</p>

        <pre><code class="language-php">&lt;?php
$stmt = $db->prepare("
    INSERT INTO games (title, release_date, genre_id, description)
    VALUES (:title, :release_date, :genre_id, :description)
");

$success = $stmt->execute([
    'title' => 'Verified Game',
    'release_date' => '2024-03-15',
    'genre_id' => 3,
    'description' => 'Testing rowCount().'
]);

if ($success && $stmt->rowCount() === 1) {
    echo "Successfully inserted 1 row";
} else {
    echo "Insert failed";
}</code></pre>

        <p class="output-label">Output:</p>
        <div class="output">
            <?php
            $checkStmt = $db->prepare("SELECT id FROM games WHERE title = :title");
            $checkStmt->execute(['title' => 'Verified Game Demo']);
            $existing = $checkStmt->fetch();

            if (!$existing) {
                $stmt = $db->prepare("
                    INSERT INTO games (title, release_date, genre_id, description)
                    VALUES (:title, :release_date, :genre_id, :description)
                ");

                $success = $stmt->execute([
                    'title' => 'Verified Game Demo',
                    'release_date' => '2024-03-15',
                    'genre_id' => 3,
                    'description' => 'Testing rowCount().'
                ]);

                if ($success && $stmt->rowCount() === 1) {
                    echo "<p class='success'>Successfully inserted 1 row (ID: " . $db->lastInsertId() . ")</p>";
                } else {
                    echo "<p class='error'>Insert failed</p>";
                }
            } else {
                echo "<p class='info'>Demo game already exists with ID: {$existing['id']}</p>";
            }
            ?>
        </div>

        <!-- Example 4: Error Handling -->
        <h2>Error Handling</h2>

        <pre><code class="language-php">&lt;?php
try {
    $stmt = $db->prepare("
        INSERT INTO games (title, release_date, genre_id, description)
        VALUES (:title, :release_date, :genre_id, :description)
    ");

    $stmt->execute([
        'title' => 'Error Test Game',
        'release_date' => '2024-01-01',
        'genre_id' => 999,  // Invalid genre_id
        'description' => 'This might fail due to foreign key constraint.'
    ]);

    echo "Inserted successfully!";
} catch (PDOException $e) {
    echo "Insert failed: " . $e->getMessage();
}</code></pre>

        <p class="output-label">Output:</p>
        <div class="output">
            <?php
            try {
                $stmt = $db->prepare("
                    INSERT INTO games (title, release_date, genre_id, description)
                    VALUES (:title, :release_date, :genre_id, :description)
                ");

                $stmt->execute([
                    'title' => 'Error Test Game ' . time(),
                    'release_date' => '2024-01-01',
                    'genre_id' => 999,  // Invalid genre_id
                    'description' => 'This might fail due to foreign key constraint.'
                ]);

                echo "<p class='success'>Inserted successfully!</p>";
            } catch (PDOException $e) {
                echo "<p class='warning'>Insert failed (expected): Foreign key constraint violation</p>";
            }
            ?>
        </div>

        <!-- Example 5: Insert Function -->
        <h2>Practical Example: Insert Function</h2>

        <pre><code class="language-php">&lt;?php
function insertGame($db, $title, $releaseDate, $genreId, $description) {
    $stmt = $db->prepare("
        INSERT INTO games (title, release_date, genre_id, description)
        VALUES (:title, :release_date, :genre_id, :description)
    ");

    $params = [
        'title' => $title,
        'release_date' => $releaseDate,
        'genre_id' => $genreId,
        'description' => $description
    ];

    $status = $stmt->execute($params);

    if (!$status || $stmt->rowCount() !== 1) {
        throw new Exception("Failed to insert game.");
    }

    return $db->lastInsertId();
}

// Usage:
$newId = insertGame($db, 'My New Game', '2024-12-01', 1, 'A great game!');</code></pre>

        <p class="output-label">Output:</p>
        <div class="output">
            <?php
            function insertGame($db, $title, $releaseDate, $genreId, $description) {
                $stmt = $db->prepare("
                    INSERT INTO games (title, release_date, genre_id, description)
                    VALUES (:title, :release_date, :genre_id, :description)
                ");

                $params = [
                    'title' => $title,
                    'release_date' => $releaseDate,
                    'genre_id' => $genreId,
                    'description' => $description
                ];

                $status = $stmt->execute($params);

                if (!$status || $stmt->rowCount() !== 1) {
                    throw new Exception("Failed to insert game.");
                }

                return $db->lastInsertId();
            }

            // Check if demo game exists
            $checkStmt = $db->prepare("SELECT id FROM games WHERE title = :title");
            $checkStmt->execute(['title' => 'Function Demo Game']);
            $existing = $checkStmt->fetch();

            if (!$existing) {
                try {
                    $newId = insertGame($db, 'Function Demo Game', '2024-12-01', 1, 'Inserted via function!');
                    echo "<p class='success'>Inserted 'Function Demo Game' with ID: $newId</p>";
                } catch (Exception $e) {
                    echo "<p class='error'>" . $e->getMessage() . "</p>";
                }
            } else {
                echo "<p class='info'>Demo game already exists with ID: {$existing['id']}</p>";
            }
            ?>
        </div>

        <h2>Key Concepts</h2>

        <ul>
            <li><strong>INSERT ... VALUES</strong> - SQL syntax to add new records</li>
            <li><strong>lastInsertId()</strong> - Get the auto-generated ID after INSERT</li>
            <li><strong>rowCount()</strong> - Check how many rows were affected</li>
            <li><strong>Foreign keys</strong> - Constraints that prevent invalid data</li>
            <li><strong>Exception handling</strong> - Catch and handle database errors</li>
        </ul>
    </div>

    <script src="/examples/js/prism-core.min.js"></script>
    <script src="/examples/js/prism-autoloader.min.js" data-autoloader-path="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/"></script>
</body>
</html>
