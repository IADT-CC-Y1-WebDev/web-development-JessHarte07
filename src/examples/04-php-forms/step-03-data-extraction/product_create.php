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
    <title>Step 3: Data Extraction - PHP Form Handling</title>
</head>
<body>
    <div class="back-link">
        <a href="../step-02-request-method/product_create.php">&larr; Previous Step</a>
        <a href="../index.php">Index</a>
        <a href="/exercises/04-php-forms/book_create.php">Go to Exercise &rarr;</a>
        <a href="../step-04-validation/product_create.php">Next Step &rarr;</a>
    </div>

    <h1>Step 3: Extracting Data into an Array</h1>

    <p>Rather than accessing <code>$_POST</code> values directly throughout your code, it's better practice to extract them into a structured array. This makes the data easier to work with and prepares it for validation.</p>

    <h2>The Handler (product_store.php)</h2>
    <p>Create a <code>$data</code> array containing all form values. Use the null coalescing operator (<code>??</code>) to provide default values if a field is missing.</p>

    <pre><code class="language-php">&lt;?php
try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }

    // Extract form data into an associative array
    // The ?? operator provides a default value if the key doesn't exist
    $data = [
        'title' => $_POST['title'] ?? null,
        'price' => $_POST['price'] ?? null,
        'description' => $_POST['description'] ?? null
    ];

    // Now we can work with $data instead of $_POST
    dd($data);
}
catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?&gt;</code></pre>

    <h3>Key Concepts</h3>
    <ul>
        <li><code>$_POST['key'] ?? null</code> - Returns the value if it exists, or <code>null</code> if not</li>
        <li>Structured array - Easier to pass to functions, validate, and manipulate</li>
        <li>Single source of truth - All form data in one place</li>
    </ul>

    <hr>

    <h2>Try It</h2>
    <p>Submit the form to see the extracted <code>$data</code> array.</p>

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
