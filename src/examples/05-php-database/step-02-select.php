<?php
require_once __DIR__ . '/lib/config.php';

// Create database connection
$db = new PDO(DB_DSN, DB_USER, DB_PASS, DB_OPTIONS);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include __DIR__ . '/inc/head_content.php'; ?>
    <title>Step 2: SELECT Queries - PHP Database</title>
</head>
<body>
    <div class="container">
        <div class="back-link">
            <a href="index.php">&larr; Back to Database Access</a>
            <a href="/exercises/05-php-database/step-02-select.php">Go to Exercise &rarr;</a>
        </div>

        <h1>Step 2: SELECT Queries</h1>

        <p>
            Once connected, you can execute SQL queries to retrieve data. PDO provides several
            methods for fetching results in different formats.
        </p>

        <!-- Example 1: Basic Query -->
        <h2>Basic SELECT Query</h2>

        <p>Use <code>query()</code> for simple queries without user input. Never use this for
        queries that include user-provided values.</p>

        <pre><code class="language-php">&lt;?php
$stmt = $db->query("SELECT * FROM games ORDER BY title");
$games = $stmt->fetchAll();

echo "&lt;p&gt;Found " . count($games) . " games&lt;/p&gt;";
foreach ($games as $game) {
    echo "&lt;p&gt;" . $game['title'] . " (" . $game['release_date'] . ")&lt;/p&gt;";
}</code></pre>

        <p class="output-label">Output:</p>
        <div class="output">
            <?php
            $stmt = $db->query("SELECT * FROM games ORDER BY title");
            $games = $stmt->fetchAll();

            echo "<p>Found " . count($games) . " games</p>";
            foreach ($games as $game) {
                echo "<p>" . htmlspecialchars($game['title']) . " (" . $game['release_date'] . ")</p>";
            }
            ?>
        </div>

        <!-- Example 2: Displaying in a Table -->
        <h2>Displaying Results in an HTML Table</h2>

        <pre><code class="language-php">&lt;?php
$stmt = $db->query("SELECT id, title, release_date, description FROM games ORDER BY title");
$games = $stmt->fetchAll();
?&gt;
&lt;table class="data-table"&gt;
    &lt;thead&gt;
        &lt;tr&gt;
            &lt;th&gt;ID&lt;/th&gt;
            &lt;th&gt;Title&lt;/th&gt;
            &lt;th&gt;Release Date&lt;/th&gt;
            &lt;th&gt;Description&lt;/th&gt;
        &lt;/tr&gt;
    &lt;/thead&gt;
    &lt;tbody&gt;
        &lt;?php foreach ($games as $game): ?&gt;
        &lt;tr&gt;
            &lt;td&gt;&lt;?= $game['id'] ?&gt;&lt;/td&gt;
            &lt;td&gt;&lt;?= htmlspecialchars($game['title']) ?&gt;&lt;/td&gt;
            &lt;td&gt;&lt;?= $game['release_date'] ?&gt;&lt;/td&gt;
            &lt;td&gt;&lt;?= htmlspecialchars(substr($game['description'], 0, 50)) ?&gt;...&lt;/td&gt;
        &lt;/tr&gt;
        &lt;?php endforeach; ?&gt;
    &lt;/tbody&gt;
&lt;/table&gt;</code></pre>

        <p class="output-label">Output:</p>
        <div class="output">
            <?php
            $stmt = $db->query("SELECT id, title, release_date, description FROM games ORDER BY title");
            $games = $stmt->fetchAll();
            ?>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Release Date</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($games as $game): ?>
                    <tr>
                        <td><?= $game['id'] ?></td>
                        <td><?= htmlspecialchars($game['title']) ?></td>
                        <td><?= $game['release_date'] ?></td>
                        <td><?= htmlspecialchars(substr($game['description'], 0, 50)) ?>...</td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Example 3: Fetch Modes -->
        <h2>Fetch Modes</h2>

        <p>PDO can return results in different formats:</p>

        <h3>FETCH_ASSOC (Associative Array)</h3>
        <pre><code class="language-php">$row = $stmt->fetch(PDO::FETCH_ASSOC);
// Access: $row['title'], $row['release_date']</code></pre>

        <h3>FETCH_OBJ (Object)</h3>
        <pre><code class="language-php">$row = $stmt->fetch(PDO::FETCH_OBJ);
// Access: $row->title, $row->release_date</code></pre>

        <h3>FETCH_NUM (Numeric Array)</h3>
        <pre><code class="language-php">$row = $stmt->fetch(PDO::FETCH_NUM);
// Access: $row[0], $row[1]</code></pre>

        <p class="output-label">Comparison:</p>
        <div class="output">
            <?php
            // FETCH_ASSOC
            $stmt = $db->query("SELECT title, release_date FROM games LIMIT 1");
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            echo "<p><strong>FETCH_ASSOC:</strong> " . print_r($row, true) . "</p>";

            // FETCH_OBJ
            $stmt = $db->query("SELECT title, release_date FROM games LIMIT 1");
            $row = $stmt->fetch(PDO::FETCH_OBJ);
            echo "<p><strong>FETCH_OBJ:</strong> title = {$row->title}, release_date = {$row->release_date}</p>";

            // FETCH_NUM
            $stmt = $db->query("SELECT title, release_date FROM games LIMIT 1");
            $row = $stmt->fetch(PDO::FETCH_NUM);
            echo "<p><strong>FETCH_NUM:</strong> " . print_r($row, true) . "</p>";
            ?>
        </div>

        <!-- Example 4: fetch() vs fetchAll() -->
        <h2>fetch() vs fetchAll()</h2>

        <table class="reference-table">
            <thead>
                <tr>
                    <th>Method</th>
                    <th>Returns</th>
                    <th>Use When</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><code>fetch()</code></td>
                    <td>Single row (or false)</td>
                    <td>Expecting one result, or processing row by row</td>
                </tr>
                <tr>
                    <td><code>fetchAll()</code></td>
                    <td>Array of all rows</td>
                    <td>Need all results at once</td>
                </tr>
            </tbody>
        </table>

        <h3>Using fetch() in a Loop</h3>
        <pre><code class="language-php">&lt;?php
$stmt = $db->query("SELECT title FROM games ORDER BY title LIMIT 5");

// Fetch one row at a time
while ($row = $stmt->fetch()) {
    echo "&lt;p&gt;" . $row['title'] . "&lt;/p&gt;";
}</code></pre>

        <p class="output-label">Output:</p>
        <div class="output">
            <?php
            $stmt = $db->query("SELECT title FROM games ORDER BY title LIMIT 5");
            while ($row = $stmt->fetch()) {
                echo "<p>" . htmlspecialchars($row['title']) . "</p>";
            }
            ?>
        </div>

        <!-- Example 5: Counting Results -->
        <h2>Counting Results</h2>

        <pre><code class="language-php">&lt;?php
// Count with SQL
$stmt = $db->query("SELECT COUNT(*) as total FROM games");
$result = $stmt->fetch();
echo "Total games: " . $result['total'];

// Or count PHP array (less efficient for large datasets)
$stmt = $db->query("SELECT * FROM games");
$games = $stmt->fetchAll();
echo "Total games: " . count($games);</code></pre>

        <p class="output-label">Output:</p>
        <div class="output">
            <?php
            $stmt = $db->query("SELECT COUNT(*) as total FROM games");
            $result = $stmt->fetch();
            echo "<p>Total games (SQL COUNT): " . $result['total'] . "</p>";

            $stmt = $db->query("SELECT * FROM games");
            $games = $stmt->fetchAll();
            echo "<p>Total games (count array): " . count($games) . "</p>";
            ?>
        </div>

        <div class="warning">
            <strong>Security Note:</strong> The <code>query()</code> method is only safe for queries
            with no user input. In the next step, we'll learn about prepared statements which
            protect against SQL injection.
        </div>

        <h2>Key Concepts</h2>

        <ul>
            <li><strong>query()</strong> - Execute SQL and return a statement object</li>
            <li><strong>fetch()</strong> - Retrieve the next row from a result set</li>
            <li><strong>fetchAll()</strong> - Retrieve all rows as an array</li>
            <li><strong>Fetch modes</strong> - Control the format of returned data (ASSOC, OBJ, NUM)</li>
            <li><strong>htmlspecialchars()</strong> - Always escape output to prevent XSS attacks</li>
        </ul>
    </div>

    <script src="/examples/js/prism-core.min.js"></script>
    <script src="/examples/js/prism-autoloader.min.js" data-autoloader-path="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/"></script>
</body>
</html>
