<?php
require_once __DIR__ . '/lib/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include __DIR__ . '/inc/head_content.php'; ?>
    <title>Step 10: Complete Active Record - PHP Database</title>
</head>
<body>
    <div class="container">
        <div class="back-link">
            <a href="index.php">&larr; Back to Database Access</a>
            <a href="/exercises/05-php-database/step-10-active-record.php">Go to Exercise &rarr;</a>
        </div>

        <h1>Step 10: Complete Active Record Pattern</h1>

        <p>
            The Active Record pattern combines data and behavior in a single class. Each object
            knows how to save and delete itself. This step adds <code>save()</code> and
            <code>delete()</code> methods to complete the pattern.
        </p>

        <!-- The save() Method -->
        <h2>The save() Method</h2>

        <p>The <code>save()</code> method handles both INSERT (new records) and UPDATE (existing records):</p>

        <pre><code class="language-php">&lt;?php
public function save()
{
    if ($this->id) {
        // Update existing record
        $stmt = $this->db->prepare("
            UPDATE games
            SET title = :title,
                release_date = :release_date,
                genre_id = :genre_id,
                description = :description,
                image_filename = :image_filename
            WHERE id = :id
        ");

        $params = [
            'title' => $this->title,
            'release_date' => $this->release_date,
            'genre_id' => $this->genre_id,
            'description' => $this->description,
            'image_filename' => $this->image_filename,
            'id' => $this->id
        ];
    } else {
        // Insert new record
        $stmt = $this->db->prepare("
            INSERT INTO games (title, release_date, genre_id, description, image_filename)
            VALUES (:title, :release_date, :genre_id, :description, :image_filename)
        ");

        $params = [
            'title' => $this->title,
            'release_date' => $this->release_date,
            'genre_id' => $this->genre_id,
            'description' => $this->description,
            'image_filename' => $this->image_filename
        ];
    }

    $status = $stmt->execute($params);

    if (!$status || $stmt->rowCount() !== 1) {
        throw new Exception("Failed to save game.");
    }

    // Set ID for new records
    if ($this->id === null) {
        $this->id = $this->db->lastInsertId();
    }
}</code></pre>

        <!-- Creating New Records -->
        <h2>Creating New Records</h2>

        <pre><code class="language-php">&lt;?php
// Create a new game object
$game = new Game();
$game->title = "My New Game";
$game->release_date = "2024-06-15";
$game->genre_id = 1;  // Action
$game->description = "An exciting new adventure!";

// Save to database (INSERT)
$game->save();

echo "Created game with ID: " . $game->id;</code></pre>

        <p class="output-label">Output:</p>
        <div class="output">
            <?php
            // Check if demo game exists
            $db = DB::getInstance()->getConnection();
            $checkStmt = $db->prepare("SELECT id FROM games WHERE title = :title");
            $checkStmt->execute(['title' => 'Active Record Demo Game']);
            $existing = $checkStmt->fetch();

            if (!$existing) {
                try {
                    $game = new Game();
                    $game->title = "Active Record Demo Game";
                    $game->release_date = "2024-06-15";
                    $game->genre_id = 1;
                    $game->description = "Created using the Active Record pattern!";

                    $game->save();

                    echo "<p class='success'>Created game with ID: " . $game->id . "</p>";
                    echo "<p>Title: " . htmlspecialchars($game->title) . "</p>";
                } catch (Exception $e) {
                    echo "<p class='error'>Error: " . $e->getMessage() . "</p>";
                }
            } else {
                echo "<p class='info'>Demo game already exists with ID: " . $existing['id'] . "</p>";
            }
            ?>
        </div>

        <!-- Updating Existing Records -->
        <h2>Updating Existing Records</h2>

        <pre><code class="language-php">&lt;?php
// Find an existing game
$game = Game::findById(1);

if ($game) {
    // Modify properties
    $game->description = "Updated description at " . date('H:i:s');

    // Save changes (UPDATE)
    $game->save();

    echo "Updated: " . $game->title;
}</code></pre>

        <p class="output-label">Output:</p>
        <div class="output">
            <?php
            $game = Game::findById(1);

            if ($game) {
                $originalDesc = $game->description;
                $game->description = "Updated via Active Record at " . date('H:i:s');

                try {
                    $game->save();
                    echo "<p class='success'>Updated: " . htmlspecialchars($game->title) . "</p>";
                    echo "<p>New description: " . htmlspecialchars($game->description) . "</p>";

                    // Restore original
                    $game->description = $originalDesc;
                    $game->save();
                    echo "<p class='info'>(Restored original description)</p>";
                } catch (Exception $e) {
                    echo "<p class='error'>Error: " . $e->getMessage() . "</p>";
                }
            } else {
                echo "<p class='warning'>Game not found</p>";
            }
            ?>
        </div>

        <!-- The delete() Method -->
        <h2>The delete() Method</h2>

        <pre><code class="language-php">&lt;?php
public function delete()
{
    if (!$this->id) {
        return false;  // Can't delete unsaved game
    }

    $stmt = $this->db->prepare("DELETE FROM games WHERE id = :id");
    return $stmt->execute(['id' => $this->id]);
}</code></pre>

        <!-- Deleting Records -->
        <h2>Deleting Records</h2>

        <pre><code class="language-php">&lt;?php
// Create a game to delete
$game = new Game();
$game->title = "Temporary Game";
$game->genre_id = 1;
$game->save();

echo "Created game ID: " . $game->id;

// Now delete it
$game->delete();

echo "Game deleted!";</code></pre>

        <p class="output-label">Output:</p>
        <div class="output">
            <?php
            try {
                // Create a temporary game
                $game = new Game();
                $game->title = "Temporary Game " . time();
                $game->genre_id = 1;
                $game->description = "This will be deleted immediately.";
                $game->save();

                $createdId = $game->id;
                echo "<p>Created game ID: $createdId</p>";

                // Delete it
                $result = $game->delete();

                if ($result) {
                    echo "<p class='success'>Game deleted successfully!</p>";

                    // Verify deletion
                    $check = Game::findById($createdId);
                    if ($check === null) {
                        echo "<p class='info'>Verified: Game ID $createdId no longer exists.</p>";
                    }
                }
            } catch (Exception $e) {
                echo "<p class='error'>Error: " . $e->getMessage() . "</p>";
            }
            ?>
        </div>

        <!-- Complete Workflow -->
        <h2>Complete CRUD Workflow</h2>

        <pre><code class="language-php">&lt;?php
// CREATE
$game = new Game();
$game->title = "CRUD Demo Game";
$game->release_date = "2024-01-01";
$game->genre_id = 2;
$game->description = "Demonstrating full CRUD operations.";
$game->save();
echo "Created ID: " . $game->id;

// READ
$found = Game::findById($game->id);
echo "Found: " . $found->title;

// UPDATE
$found->title = "Updated CRUD Demo";
$found->save();
echo "Updated title: " . $found->title;

// DELETE
$found->delete();
echo "Deleted!";</code></pre>

        <p class="output-label">Output:</p>
        <div class="output">
            <?php
            try {
                // CREATE
                $game = new Game();
                $game->title = "CRUD Demo Game " . time();
                $game->release_date = "2024-01-01";
                $game->genre_id = 2;
                $game->description = "Demonstrating full CRUD operations.";
                $game->save();
                echo "<p><strong>CREATE:</strong> Created ID: " . $game->id . "</p>";

                // READ
                $found = Game::findById($game->id);
                echo "<p><strong>READ:</strong> Found: " . htmlspecialchars($found->title) . "</p>";

                // UPDATE
                $found->title = "Updated CRUD Demo " . time();
                $found->save();
                echo "<p><strong>UPDATE:</strong> Updated title: " . htmlspecialchars($found->title) . "</p>";

                // DELETE
                $found->delete();
                echo "<p><strong>DELETE:</strong> Deleted successfully!</p>";

                echo "<p class='success'>Complete CRUD cycle demonstrated!</p>";
            } catch (Exception $e) {
                echo "<p class='error'>Error: " . $e->getMessage() . "</p>";
            }
            ?>
        </div>

        <!-- Complete Class Reference -->
        <h2>Complete Game Class</h2>

        <p>The complete <code>classes/Game.php</code> file includes:</p>

        <table class="reference-table">
            <thead>
                <tr>
                    <th>Member</th>
                    <th>Type</th>
                    <th>Purpose</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><code>$id, $title, ...</code></td>
                    <td>Properties</td>
                    <td>Map to database columns</td>
                </tr>
                <tr>
                    <td><code>__construct($data)</code></td>
                    <td>Constructor</td>
                    <td>Hydrate from array data</td>
                </tr>
                <tr>
                    <td><code>findAll()</code></td>
                    <td>Static</td>
                    <td>Get all games</td>
                </tr>
                <tr>
                    <td><code>findById($id)</code></td>
                    <td>Static</td>
                    <td>Get single game by ID</td>
                </tr>
                <tr>
                    <td><code>findByGenre($id)</code></td>
                    <td>Static</td>
                    <td>Get games by genre</td>
                </tr>
                <tr>
                    <td><code>findByPlatform($id)</code></td>
                    <td>Static</td>
                    <td>Get games by platform (JOIN)</td>
                </tr>
                <tr>
                    <td><code>save()</code></td>
                    <td>Instance</td>
                    <td>INSERT or UPDATE record</td>
                </tr>
                <tr>
                    <td><code>delete()</code></td>
                    <td>Instance</td>
                    <td>DELETE record</td>
                </tr>
                <tr>
                    <td><code>toArray()</code></td>
                    <td>Instance</td>
                    <td>Convert to array</td>
                </tr>
            </tbody>
        </table>

        <!-- Benefits of Active Record -->
        <h2>Benefits of the Active Record Pattern</h2>

        <ul>
            <li><strong>Encapsulation</strong> - Database logic is hidden inside the model</li>
            <li><strong>Clean API</strong> - Simple methods like <code>save()</code> and <code>delete()</code></li>
            <li><strong>Type safety</strong> - Work with objects instead of arrays</li>
            <li><strong>Reusability</strong> - Same class used throughout the application</li>
            <li><strong>Testability</strong> - Easy to mock for unit tests</li>
            <li><strong>Maintainability</strong> - Change database queries in one place</li>
        </ul>

        <div class="success">
            <strong>Congratulations!</strong> You've learned the Active Record pattern from the ground up:
            PDO connections, CRUD operations, and object-oriented database access.
        </div>

        <h2>Key Concepts</h2>

        <ul>
            <li><strong>Active Record</strong> - Pattern where objects know how to persist themselves</li>
            <li><strong>save()</strong> - Single method for both INSERT and UPDATE</li>
            <li><strong>delete()</strong> - Instance method to remove the record</li>
            <li><strong>Static finders</strong> - Class methods that return instances</li>
            <li><strong>Instance methods</strong> - Methods that operate on a specific record</li>
        </ul>
    </div>

    <script src="/examples/js/prism-core.min.js"></script>
    <script src="/examples/js/prism-autoloader.min.js" data-autoloader-path="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/"></script>
</body>
</html>
