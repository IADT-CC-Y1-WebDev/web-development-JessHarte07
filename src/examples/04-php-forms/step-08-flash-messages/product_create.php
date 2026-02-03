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
    <title>Step 8: Flash Messages - PHP Form Handling</title>
</head>
<body>
    <div class="back-link">
        <a href="../step-07-select-checkbox/product_create.php">&larr; Previous Step</a>
        <a href="../index.php">Index</a>
        <a href="/exercises/04-php-forms/book_create.php">Go to Exercise &rarr;</a>
        <a href="../step-09-file-uploads/product_create.php">Next Step &rarr;</a>
    </div>

    <h1>Step 8: Flash Messages</h1>

    <p>Flash messages provide feedback to users after form submission. They're stored in the session and displayed once, then automatically cleared. This is part of the POST-Redirect-GET (PRG) pattern.</p>

    <h2>The Handler (product_store.php)</h2>
    <p>Set a flash message before redirecting, both for success and errors.</p>

    <pre><code class="language-php">&lt;?php
// On success:
setFlashMessage('success', 'Product created successfully!');
redirect('product_create.php');

// On error:
setFlashMessage('error', 'Error: ' . $e->getMessage());
redirect('product_create.php');
?&gt;</code></pre>

    <h2>The Form (product_create.php)</h2>
    <p>Include the flash message display at the top of the form.</p>

    <pre><code class="language-php">&lt;?php require '../inc/flash_message.php'; ?&gt;</code></pre>

    <p>The flash_message.php file contains:</p>

    <pre><code class="language-php">&lt;?php
$flash = getFlashMessage();
if ($flash): ?&gt;
    &lt;div class="flash-message &lt;?= h($flash['type']) ?&gt;"&gt;
        &lt;?= h($flash['message']) ?&gt;
    &lt;/div&gt;
&lt;?php endif; ?&gt;</code></pre>

    <h3>The PRG Pattern</h3>
    <ul>
        <li><strong>POST</strong> - Form submits data to handler</li>
        <li><strong>Redirect</strong> - Handler redirects (prevents resubmission on refresh)</li>
        <li><strong>GET</strong> - Browser loads the redirect target</li>
    </ul>

    <hr>

    <h2>Try It</h2>
    <p>Submit valid data to see a success message, or invalid data to see an error message.</p>

    <?php require '../inc/flash_message.php'; ?>

    <form action="product_store.php" method="POST">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?= h(old('title')) ?>">
            <?php if (error('title')): ?>
                <p class="error"><?= error('title') ?></p>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="price">Price (&euro;):</label>
            <input type="number" id="price" name="price" step="0.01" value="<?= h(old('price')) ?>">
            <?php if (error('price')): ?>
                <p class="error"><?= error('price') ?></p>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="description">Description (min 10 characters):</label>
            <textarea id="description" name="description" rows="4"><?= h(old('description')) ?></textarea>
            <?php if (error('description')): ?>
                <p class="error"><?= error('description') ?></p>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="category_id">Category:</label>
            <select id="category_id" name="category_id">
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
            <button type="submit" class="button">Create Product</button>
        </div>
    </form>

    <script src="/examples/js/prism-core.min.js"></script>
    <script src="/examples/js/prism-autoloader.min.js" data-autoloader-path="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/"></script>
</body>
</html>
<?php
clearFormData();
clearFormErrors();
?>
