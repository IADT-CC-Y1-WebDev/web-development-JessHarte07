<?php
require_once 'php/lib/config.php';
require_once 'php/lib/utils.php';

try {
    $games = Game::findAll();
    $genres = Genre::findAll();
    $platforms = Platform::findAll();
} 
catch (PDOException $e) {
    die("<p>PDO Exception: " . $e->getMessage() . "</p>");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'php/inc/head_content.php'; ?>
        <title>Games</title>
    </head>
    <body>
        <div class="container">
            <div class="width-12 header">
                <?php require 'php/inc/flash_message.php'; ?>
                <div class="button">
                    <a href="game_create.php">Add New Game</a>
                </div>
            </div>
            <?php if (!empty($games)) { ?>
                <div class="width-12 filters">
                    <form>
                        <div>
                            <label for="title_filter">Title:</label>
                            <input type="text" id="title_filter" name="title_filter">
                        </div>
                        <div>
                            <label for="genre_filter">Genre:</label>
                            <select id="genre_filter" name="genre_filter">
                                <option value="">All Genres</option>
                                <?php foreach ($genres as $genre) { ?>
                                    <option value="<?= h($genre->id) ?>"><?= h($genre->name) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div>
                            <label for="platform_filter">Platform:</label>
                            <select id="platform_filter" name="platform_filter">
                                <option value="">All Platforms</option>
                                <?php foreach ($platforms as $platform) { ?>
                                    <option value="<?= h($platform->id) ?>"><?= h($platform->name) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div>
                            <button type="button" id="apply_filters">Apply Filters</button>
                            <button type="button" id="clear_filters">Clear Filters</button>
                        </div>
                    </form>
                </div>
            <?php } ?>
        </div>
        <div class="container">
            <?php if (empty($games)) { ?>
                <p>No games found.</p>
            <?php } else { ?>
                <div class="width-12 cards">
                    <?php foreach ($games as $game) { ?>
                        <div class="card">
                            <div class="top-content">
                                <h2>Title: <?= h($game->title) ?></h2>
                                <p>Release Year: <?= h($game->release_date) ?></p>
                            </div>
                            <div class="bottom-content">
                                <img src="images/<?= h($game->image_filename) ?>" alt="Image for <?= h($game->title) ?>" />
                                <div class="actions">
                                    <a href="game_view.php?id=<?= h($game->id) ?>">View</a>/ 
                                    <a href="game_edit.php?id=<?= h($game->id) ?>">Edit</a>/ 
                                    <a href="game_delete.php?id=<?= h($game->id) ?>">Delete</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </body>
</html>