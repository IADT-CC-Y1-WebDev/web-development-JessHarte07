<?php
require_once 'php/lib/config.php';
require_once 'php/lib/utils.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET' || !array_key_exists('id', $_GET)) {
    die("<p>Error: No book ID provided.</p>");
}
$id = $_GET['id'];

try {
    $book = Book::findById($id);
    if ($book === null) {
        die("<p>Error: Book not found.</p>");
    }
    // $year = year::findById($book->year);

    // $platforms = Platform::findByBook($book->id);

    // $platformNames = [];
    // foreach ($platforms as $platform) {
    //     $platformNames[] = htmlspecialchars($platform->name);
    // }
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
        <title>View Book</title>
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
                        <img src="images/<?= htmlspecialchars($book->cover_filename) ?>" />

                        <div class="actions">
                            <a href="book_edit.php?id=<?= h($book->id) ?>">Edit</a> /
                            <a href="book_delete.php?id=<?= h($book->id) ?>">Delete</a> /
                            <a href="index.php">Back</a>
                        </div>
                    </div>

                    <div class="bottom-content">
                        <h2><?= htmlspecialchars($book->title) ?></h2>
                        <p>Author: <?= htmlspecialchars($book->author) ?></p>
                        <p>Year: <?= htmlspecialchars($book->year) ?></p>
                        <p>Description:<br /><?= nl2br(htmlspecialchars($book->description)) ?></p>
                        <!-- <p>Platforms: <?= implode(', ', $platformNames) ?></p> -->
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>