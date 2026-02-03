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
    <title>Step 4: Validation - PHP Form Handling</title>
</head>
<body>
    <div class="back-link">
        <a href="../step-03-data-extraction/product_create.php">&larr; Previous Step</a>
        <a href="../index.php">Index</a>
        <a href="/exercises/04-php-forms/book_create.php">Go to Exercise &rarr;</a>
        <a href="../step-05-display-errors/product_create.php">Next Step &rarr;</a>
    </div>

    <h1>Step 4: Validation with the Validator Class</h1>

    <p>Never trust user input! All form data must be validated before use. The <code>Validator</code> class provides a declarative way to define validation rules.</p>

    <h2>The Handler (product_store.php)</h2>
    <p>Define validation rules as an associative array, then create a <code>Validator</code> instance. Rules are separated by <code>|</code> (pipe) characters.</p>

    <pre><code class="language-php">&lt;?php
try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }

    $data = [
        'title' => $_POST['title'] ?? null,
        'price' => $_POST['price'] ?? null,
        'description' => $_POST['description'] ?? null
    ];

    // Define validation rules for each field
    $rules = [
        'title' => 'required|notempty|min:1|max:255',
        'price' => 'required|float|minvalue:0',
        'description' => 'required|notempty|min:10|max:1000'
    ];

    // Create validator and check for failures
    $validator = new Validator($data, $rules);

    if ($validator->fails()) {
        // Get all validation errors and terminate
        dd($validator->errors(), true);
    }

    // If we get here, validation passed
    echo "Validation passed!";
    dd($data);
}
catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?&gt;</code></pre>

    <h3>Common Validation Rules</h3>
    <ul>
        <li><code>required</code> - Field must be present</li>
        <li><code>notempty</code> - Field cannot be empty string</li>
        <li><code>min:n</code> - Minimum length (or count for arrays)</li>
        <li><code>max:n</code> - Maximum length (or count for arrays)</li>
        <li><code>float</code> - Must be a valid decimal number</li>
        <li><code>integer</code> - Must be a whole number</li>
        <li><code>minvalue:n</code> - Minimum numeric value</li>
        <li><code>maxvalue:n</code> - Maximum numeric value</li>
    </ul>

    <hr>

    <h2>Try It</h2>
    <p>Try submitting with invalid data (empty fields, very short description, negative price) to see validation errors.</p>

    <form action="product_store.php" method="POST">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title">
        </div>

        <div class="form-group">
            <label for="price">Price (&euro;):</label>
            <input type="number" id="price" name="price" step="0.01">
        </div>

        <div class="form-group">
            <label for="description">Description (min 10 characters):</label>
            <textarea id="description" name="description" rows="4"></textarea>
        </div>

        <div class="form-group">
            <button type="submit" class="button">Create Product</button>
        </div>
    </form>

    <script src="/examples/js/prism-core.min.js"></script>
    <script src="/examples/js/prism-autoloader.min.js" data-autoloader-path="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/"></script>
</body>
</html>
