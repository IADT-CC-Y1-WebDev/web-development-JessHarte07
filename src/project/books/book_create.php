<?php
// load database config (DB connection + settings)
require_once 'php/lib/config.php';

// session functions (flash messages, login/session handling)
require_once 'php/lib/session.php';

// form helpers (old(), error(), chosen(), etc.)
require_once 'php/lib/forms.php';

// utility helpers (redirect, etc.)
require_once 'php/lib/utils.php';

// start session so flash messages + form data work
startSession();

try {
    // fetch all publishers for dropdown
    $publishers = Publisher::findAll();

    // fetch all formats for checkbox list
    $formats = Format::findAll();
}
catch (PDOException $e) {
    // if database fails, store error message and redirect home
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
        <!-- flash messages (success / error feedback) -->
        <?php require 'php/inc/flash_message.php'; ?>
    </div>

    <div class="width-12">
        <h1>Create Book</h1>
    </div>

    <div class="width-12">

        <!-- book creation form -->
        <form action="book_store.php"
              id="book_form"
              method="POST"
              enctype="multipart/form-data"
              novalidate>

            <!-- error summary box (JS will show this if validation fails) -->
            <div id="error_summary_top" class="error-summary" style="display:none" role="alert"></div>

            <!-- TITLE FIELD -->
            <div class="input">
                <label class="special" for="title">Title:</label>
                <div>
                    <input type="text" id="title" name="title"
                           value="<?= old('title') ?>" required>

                    <!-- server-side error output -->
                    <p id="title_error"><?= error('title') ?></p>
                </div>
            </div>

            <!-- AUTHOR FIELD -->
            <div class="input">
                <label class="special" for="author">Author:</label>
                <div>
                    <input type="text" id="author" name="author"
                           value="<?= old('author') ?>" required>

                    <p id="author_error"><?= error('author') ?></p>
                </div>
            </div>

            <!-- PUBLISHER DROPDOWN -->
            <div class="input">
                <label class="special" for="publisher_id">Publisher:</label>

                <select id="publisher_id" name="publisher_id">
                    <option value="">-- Select Publisher --</option>

                    <?php foreach ($publishers as $pub): ?>
                        <option value="<?= $pub->id ?>">
                            <!-- pre-select previously chosen value -->
                            <?= chosen('publisher_id', $pub->id) ? 'selected' : '' ?>
                            <?= h($pub->name) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <p id="publisher_id_error"><?= error('publisher_id') ?></p>
            </div>

            <!-- ID ERROR (not really needed here but kept from your system) -->
            <p class="error"><?= error('id') ?></p>

            <!-- YEAR FIELD -->
            <div class="input">
                <label class="special" for="year">Year:</label>
                <div>
                    <input type="number" id="year" name="year"
                           min="1900" max="2099" step="1"
                           value="<?= old('year') ?>" required>

                    <p id="year_error"><?= error('year') ?></p>
                </div>
            </div>

            <!-- ISBN FIELD -->
            <div class="input">
                <label class="special" for="isbn">ISBN:</label>
                <div>
                    <input type="text" id="isbn" name="isbn"
                           value="<?= old('isbn') ?>" required>

                    <p id="isbn_error"><?= error('isbn') ?></p>
                </div>
            </div>

            <!-- DESCRIPTION FIELD -->
            <div class="input">
                <label class="special" for="description">Description:</label>
                <div>
                    <textarea id="description" name="description"
                              required><?= old('description') ?></textarea>

                    <p id="description_error"><?= error('description') ?></p>
                </div>
            </div>

            <!-- FORMATS (MANY-TO-MANY CHECKBOXES) -->
            <div class="input">
                <label class="special">Available Formats:</label>

                <div class="checkbox-group">

                    <?php foreach ($formats as $format): ?>
                        <label class="checkbox-label">

                            <!-- checkbox for format selection -->
                            <input type="checkbox"
                                   name="format_ids[]"
                                   value="<?= $format->id ?>"

                                   <!-- keep checked state after validation failure -->
                                   <?= chosen('format_id', $format->id) ? "checked" : "" ?>>

                            <?= h($format->name) ?>
                        </label>
                    <?php endforeach; ?>

                </div>

                <!-- format validation error -->
                <p id="format_ids_error" class="error">
                    <?= error('format_id') ?>
                </p>
            </div>

            <!-- IMAGE UPLOAD -->
            <div class="input">
                <label class="special" for="image">Image (required):</label>
                <div>
                    <input type="file" id="image" name="image"
                           accept="image/*" required>

                    <p id="image_error"><?= error('image') ?></p>
                </div>
            </div>

            <!-- SUBMIT + CANCEL -->
            <div class="input">
                <button class="button" type="submit" id="submit_btn">
                    Store Book
                </button>

                <div class="button">
                    <a href="index.php">Cancel</a>
                </div>
            </div>

        </form>
    </div>
</div>

<!-- client-side validation script -->
<script src="js/book_validation.js"></script>

</body>
</html>

<?php
// clear saved form values after rendering page
clearFormData();

// clear validation errors after rendering page
clearFormErrors();
?>