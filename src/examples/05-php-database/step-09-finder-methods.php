<?php
require_once __DIR__ . '/lib/config.php';

// Game class with finder methods
class GameWithFinders
{
    public $id;
    public $title;
    public $release_date;
    public $genre_id;
    public $description;
    public $image_filename;

    private $db;

    public function __construct($data = [])
    {
        $this->db = DB::getInstance()->getConnection();

        if (!empty($data)) {
            $this->id = $data['id'] ?? null;
            $this->title = $data['title'] ?? null;
            $this->release_date = $data['release_date'] ?? null;
            $this->genre_id = $data['genre_id'] ?? null;
            $this->description = $data['description'] ?? null;
            $this->image_filename = $data['image_filename'] ?? null;
        }
    }

    // Find all games
    public static function findAll()
    {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM games ORDER BY title");
        $stmt->execute();

        $games = [];
        while ($row = $stmt->fetch()) {
            $games[] = new GameWithFinders($row);
        }

        return $games;
    }

    // Find game by ID
    public static function findById($id)
    {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM games WHERE id = :id");
        $stmt->execute(['id' => $id]);

        $row = $stmt->fetch();
        if ($row) {
            return new GameWithFinders($row);
        }

        return null;
    }

    // Find games by genre
    public static function findByGenre($genreId)
    {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM games WHERE genre_id = :genre_id ORDER BY title");
        $stmt->execute(['genre_id' => $genreId]);

        $games = [];
        while ($row = $stmt->fetch()) {
            $games[] = new GameWithFinders($row);
        }

        return $games;
    }

    // Find games by platform (requires JOIN)
    public static function findByPlatform($platformId)
    {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("
            SELECT g.*
            FROM games g
            INNER JOIN game_platform gp ON g.id = gp.game_id
            WHERE gp.platform_id = :platform_id
            ORDER BY g.title
        ");
        $stmt->execute(['platform_id' => $platformId]);

        $games = [];
        while ($row = $stmt->fetch()) {
            $games[] = new GameWithFinders($row);
        }

        return $games;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'release_date' => $this->release_date,
            'genre_id' => $this->genre_id,
            'description' => $this->description,
            'image_filename' => $this->image_filename
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include __DIR__ . '/inc/head_content.php'; ?>
    <title>Step 9: Static Finder Methods - PHP Database</title>
</head>
<body>
    <div class="container">
        <div class="back-link">
            <a href="index.php">&larr; Back to Database Access</a>
            <a href="/exercises/05-php-database/step-09-finder-methods.php">Go to Exercise &rarr;</a>
        </div>

        <h1>Step 9: Static Finder Methods</h1>

        <p>
            Static finder methods encapsulate database queries within the model class itself.
            They return objects (or arrays of objects) instead of raw database rows.
        </p>

        <!-- Why Static Methods -->
        <h2>Why Static Methods?</h2>

        <p>Static methods can be called without creating an instance first:</p>

        <pre><code class="language-php">// Instance method - need object first
$game = new Game();
$game->someMethod();

// Static method - call directly on class
$games = Game::findAll();
$game = Game::findById(1);</code></pre>

        <p>This makes sense for "finder" methods that <em>create</em> objects rather than operate on existing ones.</p>

        <!-- findAll -->
        <h2>findAll() - Get All Records</h2>

        <pre><code class="language-php">&lt;?php
public static function findAll()
{
    $db = DB::getInstance()->getConnection();
    $stmt = $db->prepare("SELECT * FROM games ORDER BY title");
    $stmt->execute();

    $games = [];
    while ($row = $stmt->fetch()) {
        $games[] = new Game($row);
    }

    return $games;
}

// Usage:
$games = Game::findAll();
foreach ($games as $game) {
    echo $game->title;
}</code></pre>

        <p class="output-label">Output:</p>
        <div class="output">
            <?php
            $games = GameWithFinders::findAll();
            echo "<p>Found " . count($games) . " games:</p>";
            echo "<ul>";
            foreach (array_slice($games, 0, 5) as $game) {
                echo "<li>" . htmlspecialchars($game->title) . " (ID: {$game->id})</li>";
            }
            if (count($games) > 5) {
                echo "<li>... and " . (count($games) - 5) . " more</li>";
            }
            echo "</ul>";
            ?>
        </div>

        <!-- findById -->
        <h2>findById($id) - Get Single Record</h2>

        <pre><code class="language-php">&lt;?php
public static function findById($id)
{
    $db = DB::getInstance()->getConnection();
    $stmt = $db->prepare("SELECT * FROM games WHERE id = :id");
    $stmt->execute(['id' => $id]);

    $row = $stmt->fetch();
    if ($row) {
        return new Game($row);
    }

    return null;  // Return null if not found
}

// Usage:
$game = Game::findById(1);
if ($game) {
    echo $game->title;
} else {
    echo "Game not found";
}</code></pre>

        <p class="output-label">Output:</p>
        <div class="output">
            <?php
            // Test with existing game
            $game = GameWithFinders::findById(1);
            if ($game) {
                echo "<p class='success'>Found game ID 1: " . htmlspecialchars($game->title) . "</p>";
                echo "<p>Release Date: " . $game->release_date . "</p>";
            } else {
                echo "<p class='error'>Game not found</p>";
            }

            // Test with non-existent game
            $game = GameWithFinders::findById(9999);
            if ($game) {
                echo "<p class='success'>Found game: " . htmlspecialchars($game->title) . "</p>";
            } else {
                echo "<p class='warning'>Game ID 9999 not found (returns null)</p>";
            }
            ?>
        </div>

        <!-- findByGenre -->
        <h2>findByGenre($genreId) - Custom Finder</h2>

        <pre><code class="language-php">&lt;?php
public static function findByGenre($genreId)
{
    $db = DB::getInstance()->getConnection();
    $stmt = $db->prepare("SELECT * FROM games WHERE genre_id = :genre_id ORDER BY title");
    $stmt->execute(['genre_id' => $genreId]);

    $games = [];
    while ($row = $stmt->fetch()) {
        $games[] = new Game($row);
    }

    return $games;
}

// Usage:
$rpgGames = Game::findByGenre(3);  // Genre 3 = RPG</code></pre>

        <p class="output-label">Output (RPG Games - Genre ID 3):</p>
        <div class="output">
            <?php
            $rpgGames = GameWithFinders::findByGenre(3);
            if (count($rpgGames) > 0) {
                echo "<ul>";
                foreach ($rpgGames as $game) {
                    echo "<li>" . htmlspecialchars($game->title) . " (" . $game->release_date . ")</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>No RPG games found.</p>";
            }
            ?>
        </div>

        <!-- findByPlatform with JOIN -->
        <h2>findByPlatform($platformId) - Using JOINs</h2>

        <p>This finder demonstrates using a JOIN to query through a many-to-many relationship:</p>

        <pre><code class="language-php">&lt;?php
public static function findByPlatform($platformId)
{
    $db = DB::getInstance()->getConnection();
    $stmt = $db->prepare("
        SELECT g.*
        FROM games g
        INNER JOIN game_platform gp ON g.id = gp.game_id
        WHERE gp.platform_id = :platform_id
        ORDER BY g.title
    ");
    $stmt->execute(['platform_id' => $platformId]);

    $games = [];
    while ($row = $stmt->fetch()) {
        $games[] = new Game($row);
    }

    return $games;
}

// Usage:
$switchGames = Game::findByPlatform(4);  // Platform 4 = Nintendo Switch</code></pre>

        <p class="output-label">Output (Nintendo Switch Games - Platform ID 4):</p>
        <div class="output">
            <?php
            $switchGames = GameWithFinders::findByPlatform(4);
            if (count($switchGames) > 0) {
                echo "<p>Found " . count($switchGames) . " games for Nintendo Switch:</p>";
                echo "<ul>";
                foreach ($switchGames as $game) {
                    echo "<li>" . htmlspecialchars($game->title) . "</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>No Switch games found.</p>";
            }
            ?>
        </div>

        <!-- Comparison with PC -->
        <p class="output-label">Output (PC Games - Platform ID 1):</p>
        <div class="output">
            <?php
            $pcGames = GameWithFinders::findByPlatform(1);
            if (count($pcGames) > 0) {
                echo "<p>Found " . count($pcGames) . " games for PC:</p>";
                echo "<ul>";
                foreach ($pcGames as $game) {
                    echo "<li>" . htmlspecialchars($game->title) . "</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>No PC games found.</p>";
            }
            ?>
        </div>

        <!-- Summary of Finder Methods -->
        <h2>Summary: Finder Method Patterns</h2>

        <table class="reference-table">
            <thead>
                <tr>
                    <th>Method</th>
                    <th>Returns</th>
                    <th>Use Case</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><code>findAll()</code></td>
                    <td>Array of objects</td>
                    <td>List all records</td>
                </tr>
                <tr>
                    <td><code>findById($id)</code></td>
                    <td>Object or null</td>
                    <td>Get single record by primary key</td>
                </tr>
                <tr>
                    <td><code>findByX($value)</code></td>
                    <td>Array of objects</td>
                    <td>Filter by a specific column</td>
                </tr>
                <tr>
                    <td><code>findByX($value)</code> with JOIN</td>
                    <td>Array of objects</td>
                    <td>Query through relationships</td>
                </tr>
            </tbody>
        </table>

        <h2>Key Concepts</h2>

        <ul>
            <li><strong>Static methods</strong> - Called on class, not instance (<code>Game::findAll()</code>)</li>
            <li><strong>Return objects</strong> - Finder methods return model instances, not arrays</li>
            <li><strong>Null for not found</strong> - <code>findById()</code> returns null if record doesn't exist</li>
            <li><strong>Empty array</strong> - Collection finders return empty array if no matches</li>
            <li><strong>Encapsulation</strong> - SQL queries are hidden inside the model class</li>
        </ul>

        <div class="info">
            <strong>Next Step:</strong> We'll complete the Active Record pattern by adding
            <code>save()</code> and <code>delete()</code> instance methods.
        </div>
    </div>

    <script src="/examples/js/prism-core.min.js"></script>
    <script src="/examples/js/prism-autoloader.min.js" data-autoloader-path="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/"></script>
</body>
</html>
