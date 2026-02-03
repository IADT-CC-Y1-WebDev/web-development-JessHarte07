<?php
require_once '../lib/config.php';
require_once '../lib/session.php';
require_once '../lib/forms.php';
require_once '../lib/utils.php';

startSession();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../inc/head_content.php'; ?>
    <title>Step 6: Repopulate Fields - PHP Form Handling</title>
</head>
<body>
    <div class="back-link">
        <a href="../step-05-display-errors/product_create.php">&larr; Previous Step</a>
        <a href="../index.php">Index</a>
        <a href="/exercises/04-php-forms/book_create.php">Go to Exercise &rarr;</a>
        <a href="../step-07-select-checkbox/product_create.php">Next Step &rarr;</a>
    </div>

    <h1>Step 6: Repopulating Form Fields</h1>

    <p>When validation fails, users shouldn't have to re-enter all their data. We store the submitted data in the session and use it to repopulate the form fields.</p>

    <h2>The Handler (product_store.php)</h2>
    <p>In the catch block, store the form data using <code>setFormData()</code> before redirecting.</p>

    <pre><code class="language-php">&lt;?php
catch (Exception $e) {
    setFormErrors($errors);
    // Store the submitted data so we can repopulate the form
    setFormData($data);
    redirect('product_create.php');
}
?&gt;</code></pre>

    <h2>The Form (product_create.php)</h2>
    <p>Use the <code>old()</code> helper function to get the previously submitted value for each field.</p>

    <pre><code class="language-php">&lt;!-- For text inputs, use old() in the value attribute --&gt;
&lt;input type="text" name="title" value="&lt;?= h(old('title')) ?&gt;"&gt;

&lt;!-- For textareas, use old() between the tags --&gt;
&lt;textarea name="description"&gt;&lt;?= h(old('description')) ?&gt;&lt;/textarea&gt;</code></pre>

    <h3>Key Functions</h3>
    <ul>
        <li><code>setFormData($data)</code> - Stores form data in <code>$_SESSION['form-data']</code></li>
        <li><code>old('fieldname')</code> - Retrieves the previous value for a field (or null)</li>
        <li><code>h()</code> - HTML-escapes output to prevent XSS attacks</li>
    </ul>

    <hr>

    <h2>Try It</h2>
    <p>Fill in the form with some data, then submit with an invalid description (too short). Notice your other data is preserved!</p>

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
            <button type="submit" class="button">Create Product</button>
        </div>
    </form>

    <script src="/examples/js/prism-core.min.js"></script>
    <script src="/examples/js/prism-autoloader.min.js" data-autoloader-path="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/"></script>
</body>
</html>
<?php
// Clear form data and errors after displaying
clearFormData();
clearFormErrors();
?>
