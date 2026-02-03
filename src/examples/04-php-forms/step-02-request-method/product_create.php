<?php
require_once '../lib/config.php';
require_once '../lib/session.php';
require_once '../lib/utils.php';

startSession();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../inc/head_content.php'; ?>
    <title>Step 2: Request Method - PHP Form Handling</title>
</head>
<body>
    <div class="back-link">
        <a href="../step-01-form-submission/product_create.php">&larr; Previous Step</a>
        <a href="../index.php">Index</a>
        <a href="/exercises/04-php-forms/book_create.php">Go to Exercise &rarr;</a>
        <a href="../step-03-data-extraction/product_create.php">Next Step &rarr;</a>
    </div>

    <h1>Step 2: Request Method Validation</h1>

    <p>Form handlers should verify they're receiving a POST request before processing data. This prevents errors when users access the handler URL directly (via GET) and provides security against unexpected access.</p>

    <h2>The Handler (product_store.php)</h2>
    <p>Check <code>$_SERVER['REQUEST_METHOD']</code> at the start of the handler. If it's not POST, throw an exception.</p>

    <pre><code class="language-php">&lt;?php
try {
    // Check request method - only accept POST requests
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }

    // If we get here, we have a valid POST request
    dd($_POST);
}
catch (Exception $e) {
    // Display the error message
    echo "Error: " . $e->getMessage();
}
?&gt;</code></pre>

    <h3>Key Concepts</h3>
    <ul>
        <li><code>$_SERVER['REQUEST_METHOD']</code> - Contains the HTTP method used (GET, POST, etc.)</li>
        <li><code>throw new Exception()</code> - Throws an error that can be caught</li>
        <li><code>try/catch</code> - Handles exceptions gracefully</li>
    </ul>

    <hr>

    <h2>Try It</h2>
    <p>Submit the form below, or try <a href="product_store.php">accessing the handler directly</a> (via GET) to see the error message.</p>

    <form action="product_store.php" method="POST">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
        </div>

        <div class="form-group">
            <label for="price">Price (&euro;):</label>
            <input type="number" id="price" name="price" step="0.01" min="0" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <button type="submit" class="button">Create Product</button>
        </div>
    </form>

    <script src="/examples/js/prism-core.min.js"></script>
    <script src="/examples/js/prism-autoloader.min.js" data-autoloader-path="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/"></script>
</body>
</html>
