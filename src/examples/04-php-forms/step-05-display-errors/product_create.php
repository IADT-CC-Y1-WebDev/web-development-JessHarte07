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
    <title>Step 5: Display Errors - PHP Form Handling</title>
</head>
<body>
    <div class="back-link">
        <a href="../step-04-validation/product_create.php">&larr; Previous Step</a>
        <a href="../index.php">Index</a>
        <a href="/exercises/04-php-forms/book_create.php">Go to Exercise &rarr;</a>
        <a href="../step-06-repopulate-fields/product_create.php">Next Step &rarr;</a>
    </div>

    <h1>Step 5: Displaying Validation Errors</h1>

    <p>When validation fails, we need to show the user what went wrong. We store errors in the session, redirect back to the form, and display them next to each field.</p>

    <h2>The Handler (product_store.php)</h2>
    <p>In the catch block, store errors in the session using <code>setFormErrors()</code>, then redirect back to the form.</p>

    <pre><code class="language-php">&lt;?php
try {
    // ... validation code ...

    if ($validator->fails()) {
        // Get first error for each field
        foreach ($validator->errors() as $field => $fieldErrors) {
            $errors[$field] = $fieldErrors[0];
        }
        throw new Exception('Validation failed.');
    }

    // Success...
}
catch (Exception $e) {
    // Store errors in session
    setFormErrors($errors);
    // Redirect back to form
    redirect('product_create.php');
}
?&gt;</code></pre>

    <h2>The Form (product_create.php)</h2>
    <p>Use the <code>error()</code> helper function to display errors next to each field.</p>

    <pre><code class="language-php">&lt;div class="form-group"&gt;
    &lt;label for="title"&gt;Title:&lt;/label&gt;
    &lt;input type="text" id="title" name="title"&gt;
    &lt;?php if (error('title')): ?&gt;
        &lt;p class="error"&gt;&lt;?= error('title') ?&gt;&lt;/p&gt;
    &lt;?php endif; ?&gt;
&lt;/div&gt;</code></pre>

    <h3>Key Functions</h3>
    <ul>
        <li><code>setFormErrors($errors)</code> - Stores errors in <code>$_SESSION['form-errors']</code></li>
        <li><code>error('fieldname')</code> - Retrieves error message for a field (or null)</li>
        <li><code>redirect($url)</code> - Performs HTTP redirect and exits</li>
    </ul>

    <hr>

    <h2>Try It</h2>
    <p>Submit with invalid data to see error messages appear next to each field.</p>

    <form action="product_store.php" method="POST">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title">
            <?php if (error('title')): ?>
                <p class="error"><?= error('title') ?></p>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="price">Price (&euro;):</label>
            <input type="number" id="price" name="price" step="0.01">
            <?php if (error('price')): ?>
                <p class="error"><?= error('price') ?></p>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="description">Description (min 10 characters):</label>
            <textarea id="description" name="description" rows="4"></textarea>
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
// Clear errors after displaying
clearFormErrors();
?>
