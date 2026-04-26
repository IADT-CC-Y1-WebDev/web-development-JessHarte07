<?php
// Load required configuration, session handling, form helpers, and utility functions
require_once 'php/lib/config.php';
require_once 'php/lib/session.php';
require_once 'php/lib/forms.php';
require_once 'php/lib/utils.php';

// Start session for flash messages and form handling
startSession();

try {
    // Only allow GET requests (this page is for loading the edit form)
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        throw new Exception('Invalid request method.');
    }

    // Ensure an ID is provided in the URL
    if (!array_key_exists('id', $_GET)) {
        throw new Exception('No book ID provided.');
    }

    // Get book ID from URL
    $id = $_GET['id'];

    // Fetch the book from database using ID
    $book = Book::findById($id);

    // If no book found, stop execution
    if ($book === null) {
        throw new Exception("Book not found.");
    }

    // Get all formats linked to this book (many-to-many relationship)
    $bookFormats = Format::findByBook($id);

    // Store only format IDs in an array (used for checkbox "checked" state)
    $bookFormatsIds = [];
    foreach ($bookFormats as $format) {
        $bookFormatsIds[] = $format->id;
    }

    // Get all publishers for dropdown list
    $publishers = Publisher::findAll();

    // Get all formats for checkbox list
    $formats = Format::findAll();
}
catch (PDOException $e) {
    // Handle database errors and show flash message
    setFlashMessage('error', 'Error: ' . $e->getMessage());

    // redirect('/index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Shared head content (CSS, meta tags, etc.) -->
    <?php include 'php/inc/head_content.php'; ?>
    <title>Edit Book</title>
</head>

<body>
<div class="container">

    <!-- Flash message output (success/error messages) -->
    <div class="width-12">
        <?php require 'php/inc/flash_message.php'; ?>
    </div>

    <!-- Page title -->
    <div class="width-12">
        <h1>Edit Book</h1>
    </div>

    <!-- Edit form -->
    <div class="width-12">
        <form action="book_update.php" method="POST" enctype="multipart/form-data">

            <!-- Hidden field to store book ID -->
            <input type="hidden" id="id" name="id" value="<?= old('id', $book->id) ?>" required>

            <!-- Title input -->
            <div class="input">
                <label class="special" for="title">Title:</label>
                <div>
                    <input type="text" id="title" name="title"
                           value="<?= old('title', $book->title) ?>" required>
                    <p><?= error('title') ?></p>
                </div>
            </div>

            <!-- Author input -->
            <div class="input">
                <label class="special" for="author">Author:</label>
                <div>
                    <input type="text" id="author" name="author"
                           value="<?= old('author', $book->author) ?>" required>
                    <p><?= error('author') ?></p>
                </div>
            </div>

            <!-- Publisher dropdown -->
            <div class="input">
                <label for="publisher_id">Publisher:</label>
                <select id="publisher_id" name="publisher_id">

                    <option value="">-- Select Publisher --</option>

                    <?php foreach ($publishers as $pub): ?>
                        <option value="<?= $pub->id ?>"
                            <?= chosen('publisher_id', $pub->id, $book->publisher_id) ? 'selected' : '' ?>>
                            <?= h($pub->name) ?>
                        </option>
                    <?php endforeach; ?>

                </select>
                <p><?= error('publisher_id') ?></p>
            </div>

            <!-- Year input -->
            <div class="input">
                <label class="special" for="year">Year:</label>
                <div>
                    <input type="number" id="year" name="year"
                           min="1900" max="2099" step="1"
                           value="<?= old('year', $book->year) ?>" required>
                    <p><?= error('year') ?></p>
                </div>
            </div>

            <!-- ISBN input -->
            <div class="input">
                <label class="special" for="isbn">ISBN:</label>
                <div>
                    <input type="text" id="isbn" name="isbn"
                           value="<?= old('isbn', $book->isbn) ?>" required>
                    <p><?= error('isbn') ?></p>
                </div>
            </div>

            <!-- Description textarea -->
            <div class="input">
                <label class="special" for="description">Description:</label>
                <div>
                    <textarea id="description" name="description" required><?= old('description', $book->description) ?></textarea>
                    <p><?= error('description') ?></p>
                </div>
            </div>

            <!-- Formats checkboxes (many-to-many relationship) -->
            <div class="input">
                <label class="special">Available Formats:</label>

                <div class="checkbox-group">
                    <?php foreach ($formats as $format): ?>
                        <label class="checkbox-label">

                            <input type="checkbox"
                                   name="format_ids[]"
                                   value="<?= $format->id ?>"
                                   <?= chosen('format_ids', $format->id, $bookFormatsIds) ? "checked" : "" ?>>

                            <?= h($format->name) ?>

                        </label>
                    <?php endforeach; ?>
                </div>

                <!-- Format validation error -->
                <?php if (error('format_id')): ?>
                    <p class="error"><?= error('format_id') ?></p>
                <?php endif; ?>
            </div>

            <!-- Current book image -->
            <div>
                <img src="images/<?= $book->cover_filename ?>" />
            </div>

            <!-- Optional new image upload -->
            <div class="input-img">
                <label class="special" for="image">Image (optional):</label>
                <div>
                    <input type="file" id="image" name="image" accept="image/*">
                    <p><?= error('image') ?></p>
                </div>
            </div>

            <!-- Submit + cancel buttons -->
            <div class="input">
                <button class="button" type="submit">Update Book</button>
                <div class="button"><a href="index.php">Cancel</a></div>
            </div>

        </form>
    </div>
</div>
</body>
</html>

<?php
// Clear old form data after page loads
clearFormData();

// Clear old validation errors after page loads
clearFormErrors();
?>