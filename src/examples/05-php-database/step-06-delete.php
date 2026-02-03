<?php
require_once __DIR__ . '/lib/config.php';

// Create database connection
$db = new PDO(DB_DSN, DB_USER, DB_PASS, DB_OPTIONS);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include __DIR__ . '/inc/head_content.php'; ?>
    <title>Step 6: DELETE Operations - PHP Database</title>
</head>
<body>
    <div class="container">
        <div class="back-link">
            <a href="index.php">&larr; Back to Database Access</a>
            <a href="/exercises/05-php-database/step-06-delete.php">Go to Exercise &rarr;</a>
        </div>

        <h1>Step 6: DELETE Operations</h1>

        <p>
            DELETE operations remove records from your database. Like UPDATE, the WHERE clause
            is critical - without it, you'll delete every row!
        </p>

        <!-- Example 1: Basic DELETE -->
        <h2>Basic DELETE</h2>

        <pre><code class="language-php">&lt;?php
$stmt = $db->prepare("DELETE FROM games WHERE id = :id");
$stmt->execute(['id' => 15]);

$deleted = $stmt->rowCount();

if ($deleted > 0) {
    echo "Deleted $deleted record(s)";
} else {
    echo "No records found to delete";
}</code></pre>

        <p class="output-label">Output:</p>
        <div class="output">
            <?php
            // First, insert a temporary record to delete
            $insertStmt = $db->prepare("INSERT INTO games (title, genre_id, description) VALUES (:title, :genre_id, :description)");
            $insertStmt->execute([
                'title' => 'Temporary Game to Delete',
                'genre_id' => 1,
                'description' => 'This will be deleted.'
            ]);
            $tempId = $db->lastInsertId();
            echo "<p class='info'>Created temporary game with ID: $tempId</p>";

            // Now delete it
            $stmt = $db->prepare("DELETE FROM games WHERE id = :id");
            $stmt->execute(['id' => $tempId]);

            $deleted = $stmt->rowCount();

            if ($deleted > 0) {
                echo "<p class='success'>Deleted $deleted record(s)</p>";
            } else {
                echo "<p class='warning'>No records found to delete</p>";
            }
            ?>
        </div>

        <!-- Example 2: Delete Non-Existent Record -->
        <h2>Handling Non-Existent Records</h2>

        <pre><code class="language-php">&lt;?php
$stmt = $db->prepare("DELETE FROM games WHERE id = :id");
$stmt->execute(['id' => 99999]);  // Non-existent ID

if ($stmt->rowCount() === 0) {
    echo "No game found with that ID";
} else {
    echo "Game deleted";
}</code></pre>

        <p class="output-label">Output:</p>
        <div class="output">
            <?php
            $stmt = $db->prepare("DELETE FROM games WHERE id = :id");
            $stmt->execute(['id' => 99999]);

            if ($stmt->rowCount() === 0) {
                echo "<p class='warning'>No game found with ID 99999</p>";
            } else {
                echo "<p class='success'>Game deleted</p>";
            }
            ?>
        </div>

        <!-- Example 3: Delete Function -->
        <h2>Practical Example: Delete Function</h2>

        <pre><code class="language-php">&lt;?php
function deleteGame($db, $id) {
    // First check if the game exists
    $checkStmt = $db->prepare("SELECT id, title FROM games WHERE id = :id");
    $checkStmt->execute(['id' => $id]);
    $game = $checkStmt->fetch();

    if (!$game) {
        return false;  // Game doesn't exist
    }

    // Delete the game
    $deleteStmt = $db->prepare("DELETE FROM games WHERE id = :id");
    $deleteStmt->execute(['id' => $id]);

    return $deleteStmt->rowCount() === 1;
}

// Usage:
if (deleteGame($db, $id)) {
    echo "Game deleted successfully";
} else {
    echo "Could not delete game";
}</code></pre>

        <p class="output-label">Output:</p>
        <div class="output">
            <?php
            function deleteGame($db, $id) {
                $checkStmt = $db->prepare("SELECT id, title FROM games WHERE id = :id");
                $checkStmt->execute(['id' => $id]);
                $game = $checkStmt->fetch();

                if (!$game) {
                    return ['success' => false, 'message' => 'Game not found'];
                }

                $title = $game['title'];

                $deleteStmt = $db->prepare("DELETE FROM games WHERE id = :id");
                $deleteStmt->execute(['id' => $id]);

                if ($deleteStmt->rowCount() === 1) {
                    return ['success' => true, 'message' => "Deleted: $title"];
                }
                return ['success' => false, 'message' => 'Delete failed'];
            }

            // Create a test game to delete
            $insertStmt = $db->prepare("INSERT INTO games (title, genre_id, description) VALUES (:title, :genre_id, :description)");
            $insertStmt->execute([
                'title' => 'Test Game ' . time(),
                'genre_id' => 2,
                'description' => 'A test game for deletion demo.'
            ]);
            $testId = $db->lastInsertId();

            echo "<p>Created test game with ID: $testId</p>";

            // Test deleting existing game
            $result = deleteGame($db, $testId);
            if ($result['success']) {
                echo "<p class='success'>{$result['message']}</p>";
            } else {
                echo "<p class='error'>{$result['message']}</p>";
            }

            // Test deleting non-existent game
            $result = deleteGame($db, 99999);
            if ($result['success']) {
                echo "<p class='success'>{$result['message']}</p>";
            } else {
                echo "<p class='warning'>{$result['message']}</p>";
            }
            ?>
        </div>

        <!-- Example 4: Foreign Key Constraints -->
        <h2>Foreign Key Constraints</h2>

        <p>When tables have relationships, deleting a record might fail or cascade to related records.</p>

        <pre><code class="language-php">&lt;?php
// This might fail if there are games linked to this genre
try {
    $stmt = $db->prepare("DELETE FROM genres WHERE id = :id");
    $stmt->execute(['id' => 1]);
    echo "Genre deleted";
} catch (PDOException $e) {
    echo "Cannot delete: " . $e->getMessage();
}</code></pre>

        <p class="output-label">Output:</p>
        <div class="output">
            <?php
            try {
                // Check how many games use genre 1
                $countStmt = $db->query("SELECT COUNT(*) as count FROM games WHERE genre_id = 1");
                $count = $countStmt->fetch()['count'];

                echo "<p>Genre 1 (Action) has $count games linked to it.</p>";
                echo "<p class='info'>Attempting to delete would fail due to foreign key constraint.</p>";

                // We won't actually try to delete - just demonstrate the concept
                echo "<p>Our schema uses <code>ON DELETE SET NULL</code>, so deleting a genre would set games' genre_id to NULL rather than failing.</p>";
            } catch (PDOException $e) {
                echo "<p class='error'>Error: " . $e->getMessage() . "</p>";
            }
            ?>
        </div>

        <!-- Example 5: Soft Delete Pattern -->
        <h2>Alternative: Soft Delete Pattern</h2>

        <p>Instead of permanently deleting records, many applications use "soft deletes" by adding a
        <code>deleted_at</code> timestamp column:</p>

        <pre><code class="language-php">&lt;?php
// Add a deleted_at column to your table:
// ALTER TABLE games ADD COLUMN deleted_at TIMESTAMP NULL;

// "Soft delete" - mark as deleted instead of removing
$stmt = $db->prepare("UPDATE games SET deleted_at = NOW() WHERE id = :id");
$stmt->execute(['id' => $id]);

// When querying, exclude deleted records
$stmt = $db->query("SELECT * FROM games WHERE deleted_at IS NULL");

// To "restore" a soft-deleted record
$stmt = $db->prepare("UPDATE games SET deleted_at = NULL WHERE id = :id");
$stmt->execute(['id' => $id]);</code></pre>

        <div class="info">
            <strong>Benefits of soft delete:</strong>
            <ul>
                <li>Records can be recovered if deleted by mistake</li>
                <li>Maintains referential integrity</li>
                <li>Keeps historical data for auditing</li>
            </ul>
        </div>

        <!-- Danger warning -->
        <h2>Danger: DELETE Without WHERE</h2>

        <div class="error">
            <strong>Warning!</strong> A DELETE without a WHERE clause will remove ALL rows:
            <pre><code class="language-sql">-- THIS IS VERY DANGEROUS!
DELETE FROM games;
-- All games are now gone forever!</code></pre>
            <p>Always verify your WHERE clause before executing DELETE statements. Consider using transactions for important operations.</p>
        </div>

        <h2>Key Concepts</h2>

        <ul>
            <li><strong>DELETE FROM ... WHERE</strong> - SQL syntax for removing records</li>
            <li><strong>rowCount()</strong> - Check if any records were actually deleted</li>
            <li><strong>Foreign keys</strong> - May prevent deletion or cascade to related tables</li>
            <li><strong>Soft delete</strong> - Alternative pattern that marks records as deleted</li>
            <li><strong>Transactions</strong> - Can rollback accidental deletes (covered later)</li>
        </ul>
    </div>

    <script src="/examples/js/prism-core.min.js"></script>
    <script src="/examples/js/prism-autoloader.min.js" data-autoloader-path="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/"></script>
</body>
</html>
