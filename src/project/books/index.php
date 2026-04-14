<?php
require_once 'php/lib/config.php';
require_once 'php/lib/utils.php';

try {
    $books = Book::findAll();
    $publishers = Publisher::findAll();
    $formats = Format::findAll();
} 
catch (PDOException $e) {
    die("<p>PDO Exception: " . $e->getMessage() . "</p>");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'php/inc/head_content.php'; ?>
        <title>Books</title>
    </head>
    <body>
        <div class="container">
            <div class="width-12 header">
                <?php require 'php/inc/flash_message.php'; ?>
                <div class="button">
                    <a href="book_create.php">Add New Book</a>
                </div>
            </div>
            <?php if (!empty($books)) { ?>
                <div class="width-12 filters">
                    <form id="filters">
                        <div class="input">
                        
                            <label for="title_filter">Title:</label>
                            <input type="text" id="title_filter" name="title_filter">
                        </div>
                        <div class="input">
                            <label for="publisher_filter">Publishers:</label>
                            <select id="publisher_filter" name="publisher_filter">
                                <option value="">All Publishers</option>
                                <?php foreach ($publishers as $publisher) { ?>
                                    <option value="<?= h($publisher->id) ?>"><?= h($publisher->name) ?></option>
                                <?php } ?>
                            </select>
                        </div>
        <div class="input">
                            <label for="format_filter">Format:</label>
                            <select id="format_filter" name="format_filter">
                                <option value="">All Formats</option>
                                <?php foreach ($formats as $format) { ?>
                                    <option value="<?= h($format->id) ?>"><?= h($format->name) ?></option>
                                <?php } ?>
                            </select>
                        </div>
        <div class="input">
            <label class="filter-label" for="sort_by">Sort:</label>
            <div>
                <select id="sort_by" name="sort_by">
                    <option value="title_asc">Title A–Z</option>
                    <option value="year_desc">Year (newest first)</option>
                    <option value="year_asc">Year (oldest first)</option>
                </select>
            </div>
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
            <?php if (empty($books)) { ?>
                <p>No books found.</p>
            <?php } else { ?>
                <div id="book_cards" class="width-12 cards">
                    <?php foreach ($books as $book) { ?>
                        <div class="card"
                         data-title="<?= htmlspecialchars($book->title)?>"
                         data-publisher="<?= htmlspecialchars($book->publisher_id)?>"
                         data-format="<?= htmlspecialchars($format->name)?>"
                         data-year ="<?= $book->year?>">
                            <div class="top-content">
                                <h2> <?= h($book->title) ?></h2>
                                <p>Author: <?= h($book->author) ?></p>
                            </div>
                            <div class="bottom-content">
                                <img src="images/<?= h($book->cover_filename) ?>" alt="Image for <?= h($book->title) ?>" />
                                <div class="actions">
                                    <a href="book_view.php?id=<?= h($book->id) ?>">View</a>/ 
                                    <a href="book_edit.php?id=<?= h($book->id) ?>">Edit</a>/ 
                                    <a href="book_delete.php?id=<?= h($book->id) ?>">Delete</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
      <script src="js/book_filters.js"></script>
    </body>
</html>