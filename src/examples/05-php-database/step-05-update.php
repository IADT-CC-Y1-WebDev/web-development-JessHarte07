<?php
require_once __DIR__ . '/lib/config.php';

// Create database connection
$db = new PDO(DB_DSN, DB_USER, DB_PASS, DB_OPTIONS);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include __DIR__ . '/inc/head_content.php'; ?>
    <title>Step 5: UPDATE Operations - PHP Database</title>
</head>
<body>
    <div class="container">
        <div class="back-link">
            <a href="index.php">&larr; Back to Database Access</a>
            <a href="/exercises/05-php-database/step-05-update.php">Go to Exercise &rarr;</a>
        </div>

        <h1>Step 5: UPDATE Operations</h1>

        <p>
            UPDATE operations modify existing records in your database. The WHERE clause
            is critical - without it, you'll update every row in the table!
        </p>

        <!-- Show current state -->
        <h2>Current Games (Before Updates)</h2>
        <div class="output">
            <?php
            $stmt = $db->query("SELECT id, title, release_date, description FROM games ORDER BY id LIMIT 5");
            $games = $stmt->fetchAll();
            ?>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Release Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($games as $game): ?>
                    <tr>
                        <td><?= $game['id'] ?></td>
                        <td><?= htmlspecialchars($game['title']) ?></td>
                        <td><?= $game['release_date'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Example 1: Basic UPDATE -->
        <h2>Basic UPDATE</h2>

        <pre><code class="language-php">&lt;?php
$stmt = $db->prepare("
    UPDATE games
    SET description = :description
    WHERE id = :id
");

$stmt->execute([
    'description' => 'Updated description text.',
    'id' => 1
]);

echo "Updated " . $stmt->rowCount() . " row(s)";</code></pre>

        <p class="output-label">Output:</p>
        <div class="output">
            <?php
            $stmt = $db->prepare("
                UPDATE games
                SET description = :description
                WHERE id = :id
            ");

            $stmt->execute([
                'description' => 'An open-world action-adventure game set in the kingdom of Hyrule. (Updated: ' . date('H:i:s') . ')',
                'id' => 1
            ]);

            echo "<p class='success'>Updated " . $stmt->rowCount() . " row(s)</p>";

            // Show the updated record
            $showStmt = $db->prepare("SELECT title, description FROM games WHERE id = :id");
            $showStmt->execute(['id' => 1]);
            $game = $showStmt->fetch();
            if ($game) {
                echo "<p><strong>Game:</strong> " . htmlspecialchars($game['title']) . "</p>";
                echo "<p><strong>New Description:</strong> " . htmlspecialchars($game['description']) . "</p>";
            }
            ?>
        </div>

        <!-- Example 2: Multiple Columns -->
        <h2>Updating Multiple Columns</h2>

        <pre><code class="language-php">&lt;?php
$stmt = $db->prepare("
    UPDATE games
    SET title = :title,
        release_date = :release_date,
        description = :description
    WHERE id = :id
");

$stmt->execute([
    'title' => 'Updated Game Title',
    'release_date' => '2024-06-15',
    'description' => 'A completely updated description.',
    'id' => 2
]);</code></pre>

        <p class="output-label">Output:</p>
        <div class="output">
            <?php
            // Get original data first
            $origStmt = $db->prepare("SELECT title, release_date FROM games WHERE id = :id");
            $origStmt->execute(['id' => 2]);
            $original = $origStmt->fetch();

            // We won't actually change the title permanently - just show the concept
            echo "<p class='info'>In a real application, this would update game ID 2.</p>";
            echo "<p>Current values for ID 2:</p>";
            if ($original) {
                echo "<ul>";
                echo "<li><strong>Title:</strong> " . htmlspecialchars($original['title']) . "</li>";
                echo "<li><strong>Release Date:</strong> " . $original['release_date'] . "</li>";
                echo "</ul>";
            }
            ?>
        </div>

        <!-- Example 3: Checking Affected Rows -->
        <h2>Checking Affected Rows</h2>

        <p>The <code>rowCount()</code> method tells you how many rows were actually changed.</p>

        <pre><code class="language-php">&lt;?php
$stmt = $db->prepare("
    UPDATE games
    SET genre_id = :genre_id
    WHERE id = :id
");

$stmt->execute([
    'genre_id' => 3,
    'id' => 999  // Non-existent ID
]);

$affected = $stmt->rowCount();

if ($affected === 0) {
    echo "No rows updated - record may not exist";
} else {
    echo "Updated $affected row(s)";
}</code></pre>

        <p class="output-label">Output:</p>
        <div class="output">
            <?php
            $stmt = $db->prepare("
                UPDATE games
                SET genre_id = :genre_id
                WHERE id = :id
            ");

            $stmt->execute([
                'genre_id' => 3,
                'id' => 999  // Non-existent ID
            ]);

            $affected = $stmt->rowCount();

            if ($affected === 0) {
                echo "<p class='warning'>No rows updated - record with ID 999 does not exist</p>";
            } else {
                echo "<p class='success'>Updated $affected row(s)</p>";
            }
            ?>
        </div>

        <!-- Example 4: Update Function -->
        <h2>Practical Example: Update Function</h2>

        <pre><code class="language-php">&lt;?php
function updateGame($db, $id, $title, $releaseDate, $genreId, $description) {
    $stmt = $db->prepare("
        UPDATE games
        SET title = :title,
            release_date = :release_date,
            genre_id = :genre_id,
            description = :description
        WHERE id = :id
    ");

    $params = [
        'title' => $title,
        'release_date' => $releaseDate,
        'genre_id' => $genreId,
        'description' => $description,
        'id' => $id
    ];

    $status = $stmt->execute($params);

    if (!$status) {
        $error_info = $stmt->errorInfo();
        throw new Exception("Update failed: " . $error_info[2]);
    }

    if ($stmt->rowCount() === 0) {
        throw new Exception("No game found with ID: $id");
    }

    return true;
}</code></pre>

        <p class="output-label">Output:</p>
        <div class="output">
            <?php
            function updateGame($db, $id, $title, $releaseDate, $genreId, $description) {
                $stmt = $db->prepare("
                    UPDATE games
                    SET title = :title,
                        release_date = :release_date,
                        genre_id = :genre_id,
                        description = :description
                    WHERE id = :id
                ");

                $params = [
                    'title' => $title,
                    'release_date' => $releaseDate,
                    'genre_id' => $genreId,
                    'description' => $description,
                    'id' => $id
                ];

                $status = $stmt->execute($params);

                if (!$status) {
                    $error_info = $stmt->errorInfo();
                    throw new Exception("Update failed: " . $error_info[2]);
                }

                return $stmt->rowCount();
            }

            // Test with valid ID
            try {
                // Get game ID 3
                $stmt = $db->prepare("SELECT * FROM games WHERE id = :id");
                $stmt->execute(['id' => 3]);
                $game = $stmt->fetch();

                if ($game) {
                    $updated = updateGame($db, 3, $game['title'], $game['release_date'], $game['genre_id'],
                        $game['description'] . ' (Verified at ' . date('H:i:s') . ')');
                    echo "<p class='success'>Update function returned: $updated row(s) affected</p>";
                }
            } catch (Exception $e) {
                echo "<p class='error'>" . $e->getMessage() . "</p>";
            }

            // Test with invalid ID
            try {
                $updated = updateGame($db, 9999, 'Test', '2024-01-01', 1, 'Test');
                echo "<p class='success'>Updated successfully</p>";
            } catch (Exception $e) {
                echo "<p class='warning'>Expected: " . $e->getMessage() . "</p>";
            }
            ?>
        </div>

        <!-- Warning about UPDATE without WHERE -->
        <h2>Danger: UPDATE Without WHERE</h2>

        <div class="error">
            <strong>Warning!</strong> An UPDATE without a WHERE clause will modify EVERY row in the table:
            <pre><code class="language-sql">-- THIS IS DANGEROUS!
UPDATE games SET genre_id = 1;
-- All games are now genre 1!</code></pre>
            <p>Always double-check your WHERE clause before running UPDATE statements.</p>
        </div>

        <h2>Key Concepts</h2>

        <ul>
            <li><strong>UPDATE ... SET ... WHERE</strong> - SQL syntax for modifying records</li>
            <li><strong>WHERE clause</strong> - Essential for targeting specific records</li>
            <li><strong>rowCount()</strong> - Returns 0 if no matching records found</li>
            <li><strong>Multiple columns</strong> - Separate with commas in SET clause</li>
        </ul>
    </div>

    <script src="/examples/js/prism-core.min.js"></script>
    <script src="/examples/js/prism-autoloader.min.js" data-autoloader-path="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/"></script>
</body>
</html>
