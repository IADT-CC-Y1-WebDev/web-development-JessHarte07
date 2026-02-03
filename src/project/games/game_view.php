<?php
require_once 'php/lib/config.php';
require_once 'php/lib/utils.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET' || !array_key_exists('id', $_GET)) {
    die("<p>Error: No game ID provided.</p>");
}
$id = $_GET['id'];

try {
    $game = Game::findById($id);
    if ($game === null) {
        die("<p>Error: Game not found.</p>");
    }

    $genre = Genre::findById($game->genre_id);
    $platforms = Platform::findByGame($game->id);

    $platformNames = [];
    foreach ($platforms as $platform) {
        $platformNames[] = htmlspecialchars($platform->name);
    }
} 
catch (PDOException $e) {
    setFlashMessage('error', 'Error: ' . $e->getMessage());
    redirect('/index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'php/inc/head_content.php'; ?>
        <title>View Game</title>
    </head>
    <body>
        <div class="container">
            <div class="width-12 header">
                <?php require 'php/inc/flash_message.php'; ?>
            </div>
        </div>
        <div class="container">
            <div class="width-12">
                <div class="hCard">
                    <div class="bottom-content">
                        <img src="images/<?= htmlspecialchars($game->image_filename) ?>" />

                        <div class="actions">
                            <a href="game_edit.php?id=<?= h($game->id) ?>">Edit</a> /
                            <a href="game_delete.php?id=<?= h($game->id) ?>">Delete</a> /
                            <a href="index.php">Back</a>
                        </div>
                    </div>

                    <div class="bottom-content">
                        <h2><?= htmlspecialchars($game->title) ?></h2>
                        <p>Release Year: <?= htmlspecialchars($game->release_date) ?></p>
                        <p>Genre: <?= htmlspecialchars($genre->name) ?></p>
                        <p>Description:<br /><?= nl2br(htmlspecialchars($game->description)) ?></p>
                        <p>Platforms: <?= implode(', ', $platformNames) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>