<?php
require_once '../lib/config.php';
require_once '../lib/session.php';
require_once '../lib/forms.php';
require_once '../lib/utils.php';
require_once '../lib/data.php';

startSession();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../inc/head_content.php'; ?>
    <title>Step 10: Complete Form - PHP Form Handling</title>
</head>
<body>
    <div class="back-link">
        <a href="../step-09-file-uploads/product_create.php">&larr; Previous Step</a>
        <a href="../index.php">Index</a>
        <a href="/exercises/04-php-forms/book_create.php">Go to Exercise &rarr;</a>
    </div>

    <h1>Step 10: Complete Form Handling</h1>

    <p>This final step shows the complete form handling pattern with all components working together. The key addition is clearing session data after displaying the form.</p>

    <h2>Cleanup After Display</h2>
    <p>At the end of the form page, clear the stored form data and errors so they don't persist to the next visit.</p>

    <pre><code class="language-php">&lt;!-- End of form HTML --&gt;

&lt;?php
// Clear form data and errors after displaying
// This ensures old data doesn't persist if user refreshes or navigates away
clearFormData();
clearFormErrors();
?&gt;</code></pre>

    <h2>Complete Form Flow Summary</h2>
    <ol>
        <li>User visits form page (GET request)</li>
        <li>User fills form and submits (POST to handler)</li>
        <li>Handler validates data</li>
        <li><strong>If invalid:</strong> Store errors + data in session, redirect to form</li>
        <li><strong>If valid:</strong> Process data, set success message, redirect</li>
        <li>Form displays with errors/success message from session</li>
        <li>Form clears session data after display</li>
    </ol>

    <hr>

    <h2>Complete Working Form</h2>

    <?php require '../inc/flash_message.php'; ?>

    <form action="product_store.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?= h(old('title')) ?>" required>
            <?php if (error('title')): ?>
                <p class="error"><?= error('title') ?></p>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="price">Price (&euro;):</label>
            <input type="number" id="price" name="price" step="0.01" min="0" value="<?= h(old('price')) ?>" required>
            <?php if (error('price')): ?>
                <p class="error"><?= error('price') ?></p>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" required><?= h(old('description')) ?></textarea>
            <?php if (error('description')): ?>
                <p class="error"><?= error('description') ?></p>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="category_id">Category:</label>
            <select id="category_id" name="category_id" required>
                <option value="">-- Select Category --</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>" <?= chosen('category_id', $category['id']) ? 'selected' : '' ?>>
                        <?= h($category['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php if (error('category_id')): ?>
                <p class="error"><?= error('category_id') ?></p>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label>Features:</label>
            <div class="checkbox-group">
                <?php foreach ($features as $feature): ?>
                    <label class="checkbox-label">
                        <input type="checkbox"
                            name="feature_ids[]"
                            value="<?= $feature['id'] ?>"
                            <?= chosen('feature_ids', $feature['id']) ? 'checked' : '' ?>>
                        <?= h($feature['name']) ?>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="form-group">
            <label for="image">Product Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required>
            <?php if (error('image')): ?>
                <p class="error"><?= error('image') ?></p>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <button type="submit" class="button">Create Product</button>
        </div>
    </form>

    <script src="/examples/js/prism-core.min.js"></script>
    <script src="/examples/js/prism-autoloader.min.js" data-autoloader-path="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/"></script>
</body>
</html>
<?php
// Step 10: Clear form data and errors after displaying
clearFormData();
clearFormErrors();
?>
