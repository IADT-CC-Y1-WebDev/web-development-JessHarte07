<?php
require_once __DIR__ . '/lib/config.php';

// Create database connection
$db = new PDO(DB_DSN, DB_USER, DB_PASS, DB_OPTIONS);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include __DIR__ . '/inc/head_content.php'; ?>
    <title>Step 3: Prepared Statements - PHP Database</title>
</head>
<body>
    <div class="container">
        <div class="back-link">
            <a href="index.php">&larr; Back to Database Access</a>
            <a href="/exercises/05-php-database/step-03-prepared-statements.php">Go to Exercise &rarr;</a>
        </div>

        <h1>Step 3: Prepared Statements</h1>

        <p>
            Prepared statements are essential for secure database operations. They separate
            SQL code from data, preventing SQL injection attacks.
        </p>

        <!-- Example 1: Why Prepared Statements Matter -->
        <h2>Why Prepared Statements Matter</h2>

        <div class="code-comparison">
            <div class="bad">
                <h4>Vulnerable Code</h4>
                <pre><code class="language-php">// NEVER DO THIS!
$id = $_GET['id'];
$sql = "SELECT * FROM games WHERE id = $id";
$db->query($sql);
// If user enters: 1; DROP TABLE games;--
// This destroys your database!</code></pre>
            </div>
            <div class="good">
                <h4>Safe Code</h4>
                <pre><code class="language-php">// Always use prepared statements
$id = $_GET['id'];
$stmt = $db->prepare("SELECT * FROM games WHERE id = :id");
$stmt->execute(['id' => $id]);
// User input is safely escaped</code></pre>
            </div>
        </div>

        <!-- Example 2: Named Parameters -->
        <h2>Named Parameters</h2>

        <p>Named parameters use <code>:name</code> placeholders that make queries readable and maintainable.</p>

        <pre><code class="language-php">&lt;?php
$id = 1;

// Prepare the statement with a named parameter
$stmt = $db->prepare("SELECT * FROM games WHERE id = :id");

// Execute with an associative array of values
$stmt->execute(['id' => $id]);

// Fetch the result
$game = $stmt->fetch();

if ($game) {
    echo "Found: " . $game['title'];
} else {
    echo "Game not found";
}</code></pre>

        <p class="output-label">Output:</p>
        <div class="output">
            <?php
            $id = 1;

            $stmt = $db->prepare("SELECT * FROM games WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $game = $stmt->fetch();

            if ($game) {
                echo "<p class='success'>Found: " . htmlspecialchars($game['title']) . "</p>";
            } else {
                echo "<p>Game not found</p>";
            }
            ?>
        </div>

        <!-- Example 3: Multiple Parameters -->
        <h2>Multiple Parameters</h2>

        <pre><code class="language-php">&lt;?php
$genre_id = 3;  // RPG
$year = '2020-01-01';

$stmt = $db->prepare("
    SELECT * FROM games
    WHERE genre_id = :genre_id
    AND release_date > :release_date
    ORDER BY title
");

$stmt->execute([
    'genre_id' => $genre_id,
    'release_date' => $year
]);

$games = $stmt->fetchAll();</code></pre>

        <p class="output-label">Output (RPG games released after 2020):</p>
        <div class="output">
            <?php
            $genre_id = 3;  // RPG
            $year = '2020-01-01';

            $stmt = $db->prepare("
                SELECT * FROM games
                WHERE genre_id = :genre_id
                AND release_date > :release_date
                ORDER BY title
            ");

            $stmt->execute([
                'genre_id' => $genre_id,
                'release_date' => $year
            ]);

            $games = $stmt->fetchAll();

            if (count($games) > 0) {
                echo "<ul>";
                foreach ($games as $game) {
                    echo "<li>" . htmlspecialchars($game['title']) . " (" . $game['release_date'] . ")</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>No games found matching criteria.</p>";
            }
            ?>
        </div>

        <!-- Example 4: Positional Parameters -->
        <h2>Positional Parameters</h2>

        <p>You can also use <code>?</code> placeholders with a numeric array. Named parameters are
        generally preferred for readability.</p>

        <pre><code class="language-php">&lt;?php
$stmt = $db->prepare("SELECT * FROM games WHERE genre_id = ? AND release_date > ?");
$stmt->execute([3, '2020-01-01']);
$games = $stmt->fetchAll();</code></pre>

        <p class="output-label">Output:</p>
        <div class="output">
            <?php
            $stmt = $db->prepare("SELECT * FROM games WHERE genre_id = ? AND release_date > ?");
            $stmt->execute([3, '2020-01-01']);
            $games = $stmt->fetchAll();

            echo "<p>Found " . count($games) . " games using positional parameters.</p>";
            ?>
        </div>

        <!-- Example 5: LIKE Queries -->
        <h2>LIKE Queries with Prepared Statements</h2>

        <p>When using LIKE, include the wildcards in the parameter value, not in the SQL:</p>

        <pre><code class="language-php">&lt;?php
$search = 'The';

// Include wildcards in the value
$stmt = $db->prepare("SELECT * FROM games WHERE title LIKE :search ORDER BY title");
$stmt->execute(['search' => "%$search%"]);

$games = $stmt->fetchAll();</code></pre>

        <p class="output-label">Output (titles containing "The"):</p>
        <div class="output">
            <?php
            $search = 'The';

            $stmt = $db->prepare("SELECT * FROM games WHERE title LIKE :search ORDER BY title");
            $stmt->execute(['search' => "%$search%"]);

            $games = $stmt->fetchAll();

            if (count($games) > 0) {
                echo "<ul>";
                foreach ($games as $game) {
                    echo "<li>" . htmlspecialchars($game['title']) . "</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>No games found.</p>";
            }
            ?>
        </div>

        <!-- Example 6: Find by Genre -->
        <h2>Practical Example: Find Games by Genre</h2>

        <pre><code class="language-php">&lt;?php
function findGamesByGenre($db, $genreId) {
    $stmt = $db->prepare("
        SELECT g.*, ge.name as genre_name
        FROM games g
        JOIN genres ge ON g.genre_id = ge.id
        WHERE g.genre_id = :genre_id
        ORDER BY g.title
    ");

    $stmt->execute(['genre_id' => $genreId]);
    return $stmt->fetchAll();
}

// Get Action games (genre_id = 1)
$actionGames = findGamesByGenre($db, 1);</code></pre>

        <p class="output-label">Output (Action games):</p>
        <div class="output">
            <?php
            function findGamesByGenre($db, $genreId) {
                $stmt = $db->prepare("
                    SELECT g.*, ge.name as genre_name
                    FROM games g
                    JOIN genres ge ON g.genre_id = ge.id
                    WHERE g.genre_id = :genre_id
                    ORDER BY g.title
                ");

                $stmt->execute(['genre_id' => $genreId]);
                return $stmt->fetchAll();
            }

            $actionGames = findGamesByGenre($db, 1);

            if (count($actionGames) > 0) {
                echo "<table class='data-table'>";
                echo "<thead><tr><th>Title</th><th>Genre</th><th>Release Date</th></tr></thead>";
                echo "<tbody>";
                foreach ($actionGames as $game) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($game['title']) . "</td>";
                    echo "<td>" . htmlspecialchars($game['genre_name']) . "</td>";
                    echo "<td>" . $game['release_date'] . "</td>";
                    echo "</tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<p>No action games found.</p>";
            }
            ?>
        </div>

        <h2>Key Concepts</h2>

        <ul>
            <li><strong>prepare()</strong> - Parse SQL with placeholders for later execution</li>
            <li><strong>execute()</strong> - Run the prepared statement with actual values</li>
            <li><strong>Named parameters</strong> - Use <code>:name</code> placeholders (recommended)</li>
            <li><strong>Positional parameters</strong> - Use <code>?</code> placeholders</li>
            <li><strong>SQL Injection</strong> - Attack prevented by prepared statements</li>
        </ul>

        <div class="info">
            <strong>Best Practice:</strong> Always use prepared statements for any query that includes
            external data, even if you think the data is "safe."
        </div>
    </div>

    <script src="/examples/js/prism-core.min.js"></script>
    <script src="/examples/js/prism-autoloader.min.js" data-autoloader-path="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/"></script>
</body>
</html>
