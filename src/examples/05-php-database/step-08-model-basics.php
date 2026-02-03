<?php
require_once __DIR__ . '/lib/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include __DIR__ . '/inc/head_content.php'; ?>
    <title>Step 8: Model Class Basics - PHP Database</title>
</head>
<body>
    <div class="container">
        <div class="back-link">
            <a href="index.php">&larr; Back to Database Access</a>
            <a href="/exercises/05-php-database/step-08-model-basics.php">Go to Exercise &rarr;</a>
        </div>

        <h1>Step 8: Model Class Basics</h1>

        <p>
            A model class represents a database table as a PHP object. Each instance represents
            one row, with properties matching the table columns.
        </p>

        <!-- Why Model Classes -->
        <h2>Why Use Model Classes?</h2>

        <div class="code-comparison">
            <div class="bad">
                <h4>Working with Arrays</h4>
                <pre><code class="language-php">// Data is just an array
$game = [
    'id' => 1,
    'title' => 'Zelda',
    'genre_id' => 2
];

// No type hints, easy to make typos
echo $game['titl'];  // Silent failure

// No methods, logic scattered
function formatGameTitle($game) {
    return strtoupper($game['title']);
}</code></pre>
            </div>
            <div class="good">
                <h4>Working with Objects</h4>
                <pre><code class="language-php">// Data is an object
$game = new Game([
    'id' => 1,
    'title' => 'Zelda',
    'genre_id' => 2
]);

// Clear properties
echo $game->title;

// Methods encapsulate logic
echo $game->getFormattedTitle();

// Easy to convert to array/JSON
$json = json_encode($game->toArray());</code></pre>
            </div>
        </div>

        <!-- Basic Game Class -->
        <h2>Basic Game Class Structure</h2>

        <pre><code class="language-php">&lt;?php
class Game
{
    // Public properties matching database columns
    public $id;
    public $title;
    public $release_date;
    public $genre_id;
    public $description;
    public $image_filename;

    // Private database connection
    private $db;

    // Constructor - can accept data array to populate properties
    public function __construct($data = [])
    {
        // Get database connection from singleton
        $this->db = DB::getInstance()->getConnection();

        // If data provided, populate properties
        if (!empty($data)) {
            $this->id = $data['id'] ?? null;
            $this->title = $data['title'] ?? null;
            $this->release_date = $data['release_date'] ?? null;
            $this->genre_id = $data['genre_id'] ?? null;
            $this->description = $data['description'] ?? null;
            $this->image_filename = $data['image_filename'] ?? null;
        }
    }

    // Convert object to array (useful for JSON APIs)
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
}</code></pre>

        <!-- Creating Game Objects -->
        <h2>Creating Game Objects</h2>

        <h3>Empty Object</h3>
        <pre><code class="language-php">&lt;?php
// Create empty game
$game = new Game();
$game->title = "New Game";
$game->release_date = "2024-06-01";
$game->genre_id = 1;

echo $game->title;  // "New Game"</code></pre>

        <p class="output-label">Output:</p>
        <div class="output">
            <?php
            // Simple Game class for this demo
            class GameBasic
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

            $game = new GameBasic();
            $game->title = "New Game";
            $game->release_date = "2024-06-01";
            $game->genre_id = 1;

            echo "<p>Title: " . htmlspecialchars($game->title) . "</p>";
            echo "<p>Release Date: " . $game->release_date . "</p>";
            echo "<p>Genre ID: " . $game->genre_id . "</p>";
            ?>
        </div>

        <h3>Object from Data Array</h3>
        <pre><code class="language-php">&lt;?php
// Create from data array (like database row)
$data = [
    'id' => 5,
    'title' => 'Portal 2',
    'release_date' => '2011-04-19',
    'genre_id' => 6,
    'description' => 'A puzzle-platform game.',
    'image_filename' => 'portal2.jpg'
];

$game = new Game($data);

echo $game->title;       // "Portal 2"
echo $game->genre_id;    // 6</code></pre>

        <p class="output-label">Output:</p>
        <div class="output">
            <?php
            $data = [
                'id' => 5,
                'title' => 'Portal 2',
                'release_date' => '2011-04-19',
                'genre_id' => 6,
                'description' => 'A puzzle-platform game.',
                'image_filename' => 'portal2.jpg'
            ];

            $game = new GameBasic($data);

            echo "<p>ID: " . $game->id . "</p>";
            echo "<p>Title: " . htmlspecialchars($game->title) . "</p>";
            echo "<p>Release Date: " . $game->release_date . "</p>";
            echo "<p>Genre ID: " . $game->genre_id . "</p>";
            ?>
        </div>

        <!-- Using toArray -->
        <h2>Converting to Array/JSON</h2>

        <pre><code class="language-php">&lt;?php
$game = new Game([
    'id' => 1,
    'title' => 'Test Game',
    'release_date' => '2024-01-01',
    'genre_id' => 1,
    'description' => 'A test game.'
]);

// Convert to array
$array = $game->toArray();
print_r($array);

// Convert to JSON
$json = json_encode($game->toArray(), JSON_PRETTY_PRINT);
echo $json;</code></pre>

        <p class="output-label">Output:</p>
        <div class="output">
            <?php
            $game = new GameBasic([
                'id' => 1,
                'title' => 'Test Game',
                'release_date' => '2024-01-01',
                'genre_id' => 1,
                'description' => 'A test game.',
                'image_filename' => null
            ]);

            echo "<h4>toArray() result:</h4>";
            echo "<pre>" . print_r($game->toArray(), true) . "</pre>";

            echo "<h4>JSON output:</h4>";
            echo "<pre>" . json_encode($game->toArray(), JSON_PRETTY_PRINT) . "</pre>";
            ?>
        </div>

        <!-- Creating from Database -->
        <h2>Creating Objects from Database Rows</h2>

        <pre><code class="language-php">&lt;?php
$db = DB::getInstance()->getConnection();

// Fetch a row as associative array
$stmt = $db->query("SELECT * FROM games WHERE id = 1");
$row = $stmt->fetch();

// Create Game object from the row
$game = new Game($row);

echo $game->title;  // The title from database</code></pre>

        <p class="output-label">Output:</p>
        <div class="output">
            <?php
            $db = DB::getInstance()->getConnection();

            $stmt = $db->query("SELECT * FROM games WHERE id = 1");
            $row = $stmt->fetch();

            if ($row) {
                $game = new GameBasic($row);
                echo "<p class='success'>Created Game object from database row</p>";
                echo "<p>Title: " . htmlspecialchars($game->title) . "</p>";
                echo "<p>Release Date: " . $game->release_date . "</p>";
                echo "<p>Description: " . htmlspecialchars(substr($game->description, 0, 80)) . "...</p>";
            }
            ?>
        </div>

        <!-- Multiple Objects -->
        <h2>Creating Multiple Objects</h2>

        <pre><code class="language-php">&lt;?php
$db = DB::getInstance()->getConnection();
$stmt = $db->query("SELECT * FROM games ORDER BY title LIMIT 5");

$games = [];
while ($row = $stmt->fetch()) {
    $games[] = new Game($row);
}

// Now we have an array of Game objects
foreach ($games as $game) {
    echo $game->title . " (" . $game->release_date . ")\n";
}</code></pre>

        <p class="output-label">Output:</p>
        <div class="output">
            <?php
            $db = DB::getInstance()->getConnection();
            $stmt = $db->query("SELECT * FROM games ORDER BY title LIMIT 5");

            $games = [];
            while ($row = $stmt->fetch()) {
                $games[] = new GameBasic($row);
            }

            echo "<ul>";
            foreach ($games as $game) {
                echo "<li>" . htmlspecialchars($game->title) . " (" . $game->release_date . ")</li>";
            }
            echo "</ul>";
            ?>
        </div>

        <h2>Understanding the Null Coalescing Operator</h2>

        <p>The <code>??</code> operator provides a default value if the left side is null or undefined:</p>

        <pre><code class="language-php">// Without null coalescing
$this->title = isset($data['title']) ? $data['title'] : null;

// With null coalescing (cleaner)
$this->title = $data['title'] ?? null;</code></pre>

        <h2>Key Concepts</h2>

        <ul>
            <li><strong>Model class</strong> - PHP class representing a database table</li>
            <li><strong>Data hydration</strong> - Populating object properties from array data</li>
            <li><strong>Null coalescing (??)</strong> - Provides default when value is null/missing</li>
            <li><strong>toArray()</strong> - Converts object back to array for serialization</li>
            <li><strong>Encapsulation</strong> - Object groups related data and behavior</li>
        </ul>

        <div class="info">
            <strong>Next Step:</strong> We'll add static methods to find games in the database
            and return them as Game objects.
        </div>
    </div>

    <script src="/examples/js/prism-core.min.js"></script>
    <script src="/examples/js/prism-autoloader.min.js" data-autoloader-path="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/"></script>
</body>
</html>
