<?php
require_once __DIR__ . '/lib/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include __DIR__ . '/inc/head_content.php'; ?>
    <title>Step 7: Database Singleton Class - PHP Database</title>
</head>
<body>
    <div class="container">
        <div class="back-link">
            <a href="index.php">&larr; Back to Database Access</a>
            <a href="/exercises/05-php-database/step-07-db-singleton.php">Go to Exercise &rarr;</a>
        </div>

        <h1>Step 7: Database Singleton Class</h1>

        <p>
            The Singleton pattern ensures only one database connection exists throughout your application.
            This is more efficient than creating new connections repeatedly.
        </p>

        <!-- Why Singleton -->
        <h2>Why Use a Singleton?</h2>

        <div class="code-comparison">
            <div class="bad">
                <h4>Without Singleton</h4>
                <pre><code class="language-php">// Creates a NEW connection each time
$db = new PDO($dsn, $user, $pass);
// ... use $db ...

// Another part of code
$db2 = new PDO($dsn, $user, $pass);
// ... another connection!

// Problems:
// - Multiple connections waste resources
// - Connection limits can be exceeded
// - Inconsistent state</code></pre>
            </div>
            <div class="good">
                <h4>With Singleton</h4>
                <pre><code class="language-php">// Always gets the SAME connection
$db = DB::getInstance()->getConnection();
// ... use $db ...

// Another part of code
$db2 = DB::getInstance()->getConnection();
// Same connection as $db!

// Benefits:
// - Single connection reused
// - Efficient resource usage
// - Consistent state</code></pre>
            </div>
        </div>

        <!-- The DB Class -->
        <h2>The DB Singleton Class</h2>

        <p>Here's our <code>classes/DB.php</code> implementation:</p>

        <pre><code class="language-php">&lt;?php
class DB
{
    // The single instance of this class
    private static $instance = null;

    // The PDO connection
    private $connection;

    // Private constructor - prevents direct instantiation
    private function __construct()
    {
        try {
            $this->connection = new PDO(DB_DSN, DB_USER, DB_PASS, DB_OPTIONS);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    // Get the singleton instance
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // Get the PDO connection
    public function getConnection()
    {
        return $this->connection;
    }

    // Prevent cloning
    private function __clone() {}

    // Prevent unserialization
    public function __wakeup()
    {
        throw new Exception("Cannot unserialize a singleton.");
    }
}</code></pre>

        <!-- Using the Singleton -->
        <h2>Using the DB Singleton</h2>

        <pre><code class="language-php">&lt;?php
require_once 'lib/config.php';  // Loads config and autoloader

// Get the database connection
$db = DB::getInstance()->getConnection();

// Use it like a normal PDO connection
$stmt = $db->prepare("SELECT * FROM games WHERE id = :id");
$stmt->execute(['id' => 1]);
$game = $stmt->fetch();

echo $game['title'];</code></pre>

        <p class="output-label">Output:</p>
        <div class="output">
            <?php
            // Get the database connection using the singleton
            $db = DB::getInstance()->getConnection();

            $stmt = $db->prepare("SELECT * FROM games WHERE id = :id");
            $stmt->execute(['id' => 1]);
            $game = $stmt->fetch();

            if ($game) {
                echo "<p class='success'>Found game: " . htmlspecialchars($game['title']) . "</p>";
            }
            ?>
        </div>

        <!-- Proving It's a Singleton -->
        <h2>Proving It's a Singleton</h2>

        <pre><code class="language-php">&lt;?php
// Get instance twice
$instance1 = DB::getInstance();
$instance2 = DB::getInstance();

// They're the same object
if ($instance1 === $instance2) {
    echo "Same instance! Singleton works.";
}

// Get connections
$db1 = $instance1->getConnection();
$db2 = $instance2->getConnection();

// Same connection object
if ($db1 === $db2) {
    echo "Same PDO connection!";
}</code></pre>

        <p class="output-label">Output:</p>
        <div class="output">
            <?php
            $instance1 = DB::getInstance();
            $instance2 = DB::getInstance();

            if ($instance1 === $instance2) {
                echo "<p class='success'>Same instance! Singleton works correctly.</p>";
            } else {
                echo "<p class='error'>Different instances - singleton is broken!</p>";
            }

            $db1 = $instance1->getConnection();
            $db2 = $instance2->getConnection();

            if ($db1 === $db2) {
                echo "<p class='success'>Same PDO connection object!</p>";
            }

            // Show object IDs
            echo "<p>Instance 1 ID: " . spl_object_id($instance1) . "</p>";
            echo "<p>Instance 2 ID: " . spl_object_id($instance2) . "</p>";
            ?>
        </div>

        <!-- Key Components -->
        <h2>Key Components of the Singleton Pattern</h2>

        <table class="reference-table">
            <thead>
                <tr>
                    <th>Component</th>
                    <th>Purpose</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><code>private static $instance</code></td>
                    <td>Holds the single instance of the class</td>
                </tr>
                <tr>
                    <td><code>private __construct()</code></td>
                    <td>Prevents creating instances with <code>new DB()</code></td>
                </tr>
                <tr>
                    <td><code>getInstance()</code></td>
                    <td>Creates instance on first call, returns existing on subsequent calls</td>
                </tr>
                <tr>
                    <td><code>private __clone()</code></td>
                    <td>Prevents cloning the instance</td>
                </tr>
                <tr>
                    <td><code>__wakeup()</code></td>
                    <td>Prevents recreating from serialization</td>
                </tr>
            </tbody>
        </table>

        <!-- Practical Usage -->
        <h2>Practical Usage in Multiple Functions</h2>

        <pre><code class="language-php">&lt;?php
function getAllGames() {
    $db = DB::getInstance()->getConnection();
    $stmt = $db->query("SELECT * FROM games ORDER BY title");
    return $stmt->fetchAll();
}

function getGameById($id) {
    $db = DB::getInstance()->getConnection();
    $stmt = $db->prepare("SELECT * FROM games WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch();
}

function countGames() {
    $db = DB::getInstance()->getConnection();
    $stmt = $db->query("SELECT COUNT(*) as total FROM games");
    return $stmt->fetch()['total'];
}

// All three functions use the SAME connection
$games = getAllGames();
$game = getGameById(1);
$total = countGames();</code></pre>

        <p class="output-label">Output:</p>
        <div class="output">
            <?php
            function getAllGames() {
                $db = DB::getInstance()->getConnection();
                $stmt = $db->query("SELECT * FROM games ORDER BY title");
                return $stmt->fetchAll();
            }

            function getGameById($id) {
                $db = DB::getInstance()->getConnection();
                $stmt = $db->prepare("SELECT * FROM games WHERE id = :id");
                $stmt->execute(['id' => $id]);
                return $stmt->fetch();
            }

            function countGames() {
                $db = DB::getInstance()->getConnection();
                $stmt = $db->query("SELECT COUNT(*) as total FROM games");
                return $stmt->fetch()['total'];
            }

            $total = countGames();
            $game = getGameById(1);
            $games = getAllGames();

            echo "<p>Total games: $total</p>";
            echo "<p>First game by ID: " . ($game ? htmlspecialchars($game['title']) : 'Not found') . "</p>";
            echo "<p>All games loaded: " . count($games) . " records</p>";
            ?>
        </div>

        <h2>Key Concepts</h2>

        <ul>
            <li><strong>Singleton Pattern</strong> - Design pattern ensuring only one instance exists</li>
            <li><strong>Private constructor</strong> - Prevents <code>new ClassName()</code></li>
            <li><strong>Static instance</strong> - Shared across all uses</li>
            <li><strong>Lazy initialization</strong> - Connection created only when first needed</li>
            <li><strong>Resource efficiency</strong> - Single connection reused throughout application</li>
        </ul>

        <div class="info">
            <strong>Next Step:</strong> Now that we have a reusable database connection, we'll create
            a model class that uses it to represent game records as objects.
        </div>
    </div>

    <script src="/examples/js/prism-core.min.js"></script>
    <script src="/examples/js/prism-autoloader.min.js" data-autoloader-path="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/"></script>
</body>
</html>
