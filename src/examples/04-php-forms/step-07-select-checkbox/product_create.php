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
    <title>Step 7: Select &amp; Checkbox - PHP Form Handling</title>
</head>
<body>
    <div class="back-link">
        <a href="../step-06-repopulate-fields/product_create.php">&larr; Previous Step</a>
        <a href="../index.php">Index</a>
        <a href="/exercises/04-php-forms/book_create.php">Go to Exercise &rarr;</a>
        <a href="../step-08-flash-messages/product_create.php">Next Step &rarr;</a>
    </div>

    <h1>Step 7: Select and Checkbox Handling</h1>

    <p>Select dropdowns and checkboxes require special handling. Use the <code>chosen()</code> helper to preserve selections after validation fails.</p>

    <h2>Select Dropdowns</h2>
    <p>Loop through options and use <code>chosen()</code> to add the <code>selected</code> attribute.</p>

    <pre><code class="language-php">&lt;select name="category_id"&gt;
    &lt;?php foreach ($categories as $category): ?&gt;
        &lt;option value="&lt;?= $category['id'] ?&gt;"
            &lt;?= chosen('category_id', $category['id']) ? 'selected' : '' ?&gt;&gt;
            &lt;?= h($category['name']) ?&gt;
        &lt;/option&gt;
    &lt;?php endforeach; ?&gt;
&lt;/select&gt;</code></pre>

    <h2>Checkboxes (Multiple Selection)</h2>
    <p>Use <code>name="feature_ids[]"</code> to send an array of values. The <code>chosen()</code> function handles arrays too.</p>

    <pre><code class="language-php">&lt;?php foreach ($features as $feature): ?&gt;
    &lt;label&gt;
        &lt;input type="checkbox"
            name="feature_ids[]"
            value="&lt;?= $feature['id'] ?&gt;"
            &lt;?= chosen('feature_ids', $feature['id']) ? 'checked' : '' ?&gt;&gt;
        &lt;?= h($feature['name']) ?&gt;
    &lt;/label&gt;
&lt;?php endforeach; ?&gt;</code></pre>

    <h3>Key Concepts</h3>
    <ul>
        <li><code>name="items[]"</code> - Square brackets make PHP receive an array</li>
        <li><code>chosen('field', $value)</code> - Returns true if $value was previously selected</li>
        <li>Works with both single values (select) and arrays (checkboxes)</li>
    </ul>

    <hr>

    <h2>Try It</h2>
    <p>Select a category and some features, then submit with invalid data. Your selections will be preserved!</p>

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
