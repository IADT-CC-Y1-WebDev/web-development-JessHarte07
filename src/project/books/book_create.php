<?php
require_once 'php/lib/config.php';
require_once 'php/lib/session.php';
require_once 'php/lib/forms.php';
require_once 'php/lib/utils.php';

startSession();

try {
    $publishers = Publisher::findAll();
    $formats = Format::findAll();
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
        <title>Create Book</title>
    </head>
    <body>
        <div class="container">
            <div class="width-12">
                <?php require 'php/inc/flash_message.php'; ?>
            </div>
            <div class="width-12">
                <h1>Create Book</h1>
            </div>
            <div class="width-12">
                <form action="book_store.php" method="POST" enctype="multipart/form-data" novalidate>
                    <div class="input">
                        <label class="special" for="title">Title:</label>
                        <div>
                            <input type="text" id="title" name="title" value="<?= old('title') ?>" required>
                            <p><?= error('title') ?></p>
                        </div>
                    </div>
                    <div class="input">
                        <label class="special" for="author">Author:</label>
                        <div>
                            <input type="text" id="author" name="author" value="<?= old('author') ?>" required>
                            <p><?= error('author') ?></p>
                        </div>
                    </div>
                    <div class="input">
                        <label class="special" for="publisher_id">Publisher:</label>
                        <select id="publisher_id" name="publisher_id">
                            <option value="">-- Select Publisher --</option>
                            <?php foreach ($publishers as $pub): ?>
                                <option value="<?= $pub->id ?>">
                                    <?= chosen('publisher_id', $pub->id) ? 'selected' : '' ?>
                                    <?= h($pub->name) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <p><?= error('publisher_id') ?></p>
                    </div>
                    <p class="error"><?= error('id') ?></p>
                    <div class="input">
                        <label class="special" for="year">Year:</label>
                        <div>
                            <input type="number" id="year" name="year" min="1900" max="2099" step="1" value="<?= old('year') ?>" required>
                            <p><?= error('year') ?></p>
                        </div>
                    </div>
                    
                    <div class="input">
                        <label class="special" for="isbn">ISBN:</label>
                        <div>
                            <input type="1234567890123" id="isbn" name="isbn" value="<?= old('isbn') ?>" required>
                            <p><?= error('isbn') ?></p>
                        </div>
                    </div>

                    <div class="input">
                        <label class="special" for="description">Description:</label>
                        <div>
                            <textarea id="description" name="description" required><?= old('description') ?></textarea>
                            <p><?= error('description') ?></p>
                        </div>
                    </div>

                    <div class="input">
                        <label class="special">Available Formats:</label>
                        <div class="checkbox-group">
                            <?php foreach ($formats as $format): ?>
                                <label class="checkbox-label">
                                    <input type="checkbox" 
                                    name="format_ids[]" 
                                    value="<?= $format->id ?>"
                                    <?= chosen('format_id', $format->id) ? "checked" : "" ?>
                                    >
                                    <?= h($format->name) ?>
                                </label>
                            <?php endforeach; ?>
                        </div>

                        <!-- TODO: Display error message if formats validation fails     -->
                        <?php if (error('format_id')): ?>
                    <p class="error"><?= error('format_id') ?></p>
                <?php endif; ?>

                    </div>
                   
                    
                    <div class="input">
                        <label class="special" for="image">Image (required):</label>
                        <div>
                            <input type="file" id="image" name="image" accept="image/*" required>
                            <p><?= error('image') ?></p>
                        </div>
                    </div>
                    <div class="input">
                        <button  class="button" type="submit">Store Book</button>
                        <div class="button"><a href="index.php">Cancel</a></div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
<?php
// Clear form data after displaying
clearFormData();
// Clear errors after displaying
clearFormErrors();
?>