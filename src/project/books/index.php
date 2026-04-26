<?php
// load database config and helper functions
require_once 'php/lib/config.php';
require_once 'php/lib/utils.php';

try {
    // get all books from database
    $books = Book::findAll();
    // get all publishers for filter dropdown
    $publishers = Publisher::findAll();
    // get all formats for filter dropdown
    $formats = Format::findAll();
} 
catch (PDOException $e) {
    // stop page and show error if database fails
    die("<p>PDO Exception: " . $e->getMessage() . "</p>");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- include shared head content (css, meta etc) -->
        <?php include 'php/inc/head_content.php'; ?>
        <title>Books</title>
    </head>
    <body>
        <div class="container">
            <!-- show flash messages (success/error) -->
                <?php require 'php/inc/flash_message.php'; ?>
            <div class="width-12 header">
                <h1> HERE YE!</H1>
                

                <!-- button to go to create book page -->
                <div class="button">
                    <a href="book_create.php">Add New Book</a>
                </div>
            </div>

            <!-- only show filters if books exist -->
            <?php if (!empty($books)) { ?>
                <div class="width-12 filters">
                    <form id="filters">

                        <!-- filter by title -->
                        <div class="input">
                            <label for="title_filter">Title:</label>
                            <input type="text" id="title_filter" name="title_filter">
                        </div>

                        <!-- filter by publisher -->
                        <div class="input">
                            <label for="publisher_filter">Publishers:</label>
                            <select id="publisher_filter" name="publisher_filter">
                                <option value="">All Publishers</option>
                                <?php foreach ($publishers as $publisher) { ?>
                                    <!-- option value is publisher id -->
                                    <option value="<?= h($publisher->id) ?>">
                                        <?= h($publisher->name) ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <!-- filter by format -->
                        <div class="input">
                            <label for="format_filter">Format:</label>
                            <select id="format_filter" name="format_filter">
                                <option value="">All Formats</option>
                                <?php foreach ($formats as $format) { ?>
                                    <!-- option value is format id -->
                                    <option value="<?= h($format->id) ?>">
                                        <?= h($format->name) ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <!-- sorting options -->
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

                        <!-- buttons to apply or clear filters -->
                        <div>
                            <button type="button" id="apply_filters">Apply Filters</button>
                            <button type="button" id="clear_filters">Clear Filters</button>
                        </div>

                    </form>
                </div>
            <?php } ?>
        </div>

        <div class="container">
            <!-- if no books, show message -->
            <?php if (empty($books)) { ?>
                <p>No books found.</p>
            <?php } else { ?>

                <!-- container for all book cards -->
                <div id="book_cards" class="width-12 cards">

                    <!-- loop through each book -->
                    <?php foreach ($books as $book) { ?>

                        <!-- each book card -->
                        <div class="card"

                            
                            data-title="<?= htmlspecialchars($book->title)?>"
                            data-publisher="<?= htmlspecialchars($book->publisher_id)?>"
                            data-format="<?= htmlspecialchars($book->format_ids ?? '') ?>"
                            data-year="<?= (int)$book->year ?>">

                            <div class="top-content">
                                <!-- book title -->
                                <h2><?= h($book->title) ?></h2>

                                <!-- book author -->
                                <p>Author: <?= h($book->author) ?></p>
                            </div>

                            <div class="bottom-content">
                                <!-- book image -->
                                <img src="images/<?= h($book->cover_filename) ?>" 
                                     alt="Image for <?= h($book->title) ?>" />

                                <!-- action links -->
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

        <!-- javascript file for filtering books -->
        <script src="js/book_filters.js"></script>
    </body>
</html>