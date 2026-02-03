<?php
/**
 * Book Creation Form - Exercise
 *
 * Follow the steps below to progressively implement form handling for books.
 * Each step corresponds to an example in /examples/04-php-forms/
 *
 * Form Fields (from books.sql):
 * - title (required, text, 3-255 characters)
 * - author (required, text, 3-255 characters)
 * - publisher_id (required, integer)
 * - year (required, integer, four digits, 1900-2026)
 * - isbn (required, text, 13 characters)
 * - description (required, text)
 * - cover (required, file upload, image only, max 2MB)
 * - format_ids (required, array of integer)
 */

// Include the required library files
require_once './lib/config.php';
require_once './lib/session.php';
require_once './lib/forms.php';
require_once './lib/utils.php';

// Start the session
startSession();

/**
 * Mock data for the form. 
 * In a real application, these would be fetched from the database tables.
 */
$publishers = [
    ['id' => 1, 'name' => 'Penguin Random House'],
    ['id' => 2, 'name' => 'HarperCollins'],
    ['id' => 3, 'name' => 'Simon & Schuster'],
    ['id' => 4, 'name' => 'Hachette Book Group'],
    ['id' => 5, 'name' => 'Macmillan Publishers'],
    ['id' => 6, 'name' => 'Scholastic Corporation'],
    ['id' => 7, 'name' => 'O\'Reilly Media']
];

$formats = [
    ['id' => 1, 'name' => 'Hardcover'],
    ['id' => 2, 'name' => 'Paperback'],
    ['id' => 3, 'name' => 'Ebook'],
    ['id' => 4, 'name' => 'Audiobook']
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './inc/head_content.php'; ?>
    <title>Add New Book - Exercise</title>
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to Form Handling </a>
    </div>

    <h1>Add New Book</h1>

    <!-- Display form data and errors for debugging purposes                 -->
    <?php dd(getFormData()); ?>
    <?php dd(getFormErrors()); ?>

    <!-- =================================================================== -->
    <!-- STEP 8: Flash Messages                                              -->
    <!-- See: /examples/04-php-forms/step-08-flash-messages/                 -->
    <!-- =================================================================== -->
    <!-- TODO: Include the flash message component here                      -->


    <!-- =================================================================== -->
    <!-- STEP 9: File Uploads                                                -->
    <!-- See: /examples/04-php-forms/step-09-file-uploads/                   -->
    <!-- =================================================================== -->
    <!-- TODO: Add enctype="multipart/form-data" to enable file uploads      -->
    <form action="book_store.php" method="POST">

        <!-- =============================================================== -->
        <!-- Book Title Field                                                -->
        <!-- =============================================================== -->
        <div class="form-group">
            <label for="title">Book Title:</label>
            <!-- ===========================================================
                 STEP 6: Repopulate Fields
                 See: /examples/04-php-forms/step-06-repopulate-fields/
                 ===========================================================
                 TODO: Repopulate title field
            -->
            <input type="text" id="title" name="title" value="">

            <!-- ===========================================================
                 STEP 5: Display Errors
                 See: /examples/04-php-forms/step-05-display-errors/
                 ===========================================================
                 TODO: Display error message if title validation fails
            -->

        </div>

        <!-- =============================================================== -->
        <!-- Author Field                                                    -->
        <!-- =============================================================== -->
        <div class="form-group">
            <label for="author">Author:</label>
            <!-- TODO: Repopulate author field                               -->
            <input type="text" id="author" name="author" value="">

            <!-- TODO: Display error message if author validation fails      -->

        </div>

        <!-- =============================================================== -->
        <!-- Publisher Select Field                                          -->
        <!-- See: /examples/04-php-forms/step-07-select-checkbox/            -->
        <!-- =============================================================== -->
        <div class="form-group">
            <label for="publisher_id">Publisher:</label>
            <select id="publisher_id" name="publisher_id">
                <option value="">-- Select Publisher --</option>
                <!-- =======================================================
                     STEP 7: Select & Checkbox Handling
                     See: /examples/04-php-forms/step-07-select-checkbox/
                     ======================================================= 
                     TODO: Use chosen() to repopulate selected option 
                -->
                <?php foreach ($publishers as $pub): ?>
                    <option value="<?= $pub['id'] ?>">
                        <?= h($pub['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <!-- TODO: Display error message if publisher validation fails   -->

        </div>

        <!-- =============================================================== -->
        <!-- Year Field                                                      -->
        <!-- =============================================================== -->
        <div class="form-group">
            <label for="year">Year:</label>
            <!-- TODO: Repopulate year field                                 -->
            <input type="text" id="year" name="year" value="">

            <!-- TODO: Display error message if year validation fails        -->

        </div>

        <!-- =============================================================== -->
        <!-- ISBN Field                                                      -->
        <!-- =============================================================== -->
        <div class="form-group">
            <label for="isbn">ISBN:</label>
            <!-- TODO: Repopulate ISBN field                                 -->
            <input type="text" id="isbn" name="isbn" value="">

            <!-- TODO: Display error message if ISBN validation fails        -->

        </div>

        <!-- =============================================================== -->
        <!-- Format Checkboxes                                              -->
        <!-- See: /examples/04-php-forms/step-07-select-checkbox/            -->
        <!-- =============================================================== -->
        <div class="form-group">
            <label>Available Formats:</label>
            <div class="checkbox-group">
                <!-- =======================================================
                     STEP 7: Select & Checkbox Handling
                     See: /examples/04-php-forms/step-07-select-checkbox/
                     =======================================================
                      TODO: Use chosen() to repopulate checkbox state
                -->
                <?php foreach ($formats as $format): ?>
                    <label class="checkbox-label">
                        <input type="checkbox" name="format_ids[]" value="<?= $format['id'] ?>">
                        <?= h($format['name']) ?>
                    </label>
                <?php endforeach; ?>
            </div>

            <!-- TODO: Display error message if formats validation fails     -->

        </div>

        <!-- =============================================================== -->
        <!-- Description Field                                               -->
        <!-- =============================================================== -->
        <div class="form-group">
            <label for="description">Description:</label>
            <!-- TODO: Repopulate description field                          -->
            <textarea id="description" name="description" rows="5"></textarea>

            <!-- TODO: Display error message if description validation fails -->

        </div>

        <!-- =============================================================== -->
        <!-- Cover Image File Upload                                         -->
        <!-- See: /examples/04-php-forms/step-09-file-uploads/               -->
        <!-- =============================================================== -->
        <div class="form-group">
            <label for="cover">Book Cover Image (max 2MB):</label>
            <!-- NOTE: File inputs cannot be repopulated for security reasons -->
            <input type="file" id="cover" name="cover" accept="image/*">

            <!-- TODO: Display error message if cover validation fails       -->

        </div>

        <!-- =============================================================== -->
        <!-- Submit Button                                                   -->
        <!-- =============================================================== -->
        <div class="form-group">
            <button type="submit" class="button">Save Book</button>
        </div>
    </form>

    <!-- =================================================================== -->
    <!-- STEP 10: Clean Up                                                   -->
    <!-- See: /examples/04-php-forms/step-10-complete/                       -->
    <!-- =================================================================== -->
    <!-- TODO: Clear form data and errors after displaying the page          -->
    <?php
    //   Clear form data and errors
    ?>
    </body>
</html>