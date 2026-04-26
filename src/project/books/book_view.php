<?php
// Load database configuration and helper functions
require_once 'php/lib/config.php';
require_once 'php/lib/utils.php';

// Check request is GET and ID exists in URL
if ($_SERVER['REQUEST_METHOD'] !== 'GET' || !array_key_exists('id', $_GET)) {
    die("<p>Error: No book ID provided.</p>");
}

// Get book ID from URL
$id = $_GET['id'];

try {
    // Fetch book from database using ID
    $book = Book::findById($id);

    // If no book found, stop execution
    if ($book === null) {
        die("<p>Error: Book not found.</p>");
    }


} 
catch (PDOException $e) {
    // If database error happens, show flash message and redirect home
    setFlashMessage('error', 'Error: ' . $e->getMessage());
    redirect('/index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Shared head content (CSS, meta tags, etc.) -->
    <?php include 'php/inc/head_content.php'; ?>
    <title>View Book</title>
</head>

<body>
<div class="container">

    <!-- Flash message area (success/error messages) -->
    <div class="width-12 header">
        <?php require 'php/inc/flash_message.php'; ?>
    </div>

</div>

<div class="container">
    <div class="width-12">

        <!-- Book card container -->
        <div class="hCard">

            <!-- Book image + action buttons -->
            <div class="bottom-content">

                <!-- Book cover image -->
                <img src="images/<?= htmlspecialchars($book->cover_filename) ?>" />

                <!-- Action links -->
                <div class="actions">
                    <a href="book_edit.php?id=<?= h($book->id) ?>">Edit</a> /
                    <a href="book_delete.php?id=<?= h($book->id) ?>">Delete</a> /
                    <a href="index.php">Back</a>
                </div>

            </div>

            <!-- Book details -->
            <div class="bottom-content">

                <!-- Title -->
                <h2><?= htmlspecialchars($book->title) ?></h2>

                <!-- Author -->
                <p>Author: <?= htmlspecialchars($book->author) ?></p>

                <!-- Year -->
                <p>Year: <?= htmlspecialchars($book->year) ?></p>

                <!-- Description (nl2br keeps line breaks) -->
                <p>
                    Description:<br />
                    <?= nl2br(htmlspecialchars($book->description)) ?>
                </p>

                <!-- (Optional) platforms list - currently disabled -->
                <!-- <p>Platforms: <?= implode(', ', $platformNames) ?></p> -->

            </div>

        </div>

    </div>
</div>

</body>
</html>