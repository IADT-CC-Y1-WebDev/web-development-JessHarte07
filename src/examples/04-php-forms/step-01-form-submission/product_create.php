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
    <title>Step 1: Form Submission - PHP Form Handling</title>
</head>
<body>
    <div class="back-link">
        <a href="../index.php">&larr; Back to Form Handling</a>
        <a href="/exercises/04-php-forms/book_create.php">Go to Exercise &rarr;</a>
    </div>

    <h1>Step 1: Form Submission Basics</h1>

    <p>In this step, we learn how HTML forms submit data to PHP scripts using the POST method. The form's <code>action</code> attribute specifies which script receives the data, and <code>method="POST"</code> sends the data securely in the request body.</p>

    <h2>The Form (product_create.php)</h2>
    <p>Create a basic HTML form with text inputs. The <code>name</code> attribute on each input determines the key used to access the data in PHP.</p>

    <pre><code class="language-html">&lt;form action="product_store.php" method="POST"&gt;
    &lt;div class="form-group"&gt;
        &lt;label for="title"&gt;Title:&lt;/label&gt;
        &lt;input type="text" id="title" name="title" required&gt;
    &lt;/div&gt;

    &lt;div class="form-group"&gt;
        &lt;label for="price"&gt;Price:&lt;/label&gt;
        &lt;input type="number" id="price" name="price" step="0.01" required&gt;
    &lt;/div&gt;

    &lt;div class="form-group"&gt;
        &lt;label for="description"&gt;Description:&lt;/label&gt;
        &lt;textarea id="description" name="description" required&gt;&lt;/textarea&gt;
    &lt;/div&gt;

    &lt;button type="submit"&gt;Create Product&lt;/button&gt;
&lt;/form&gt;</code></pre>

    <h2>The Handler (product_store.php)</h2>
    <p>In the handler script, access the submitted data using the <code>$_POST</code> superglobal array. Use <code>dd()</code> (dump and die) to inspect the data during development.</p>

    <pre><code class="language-php">&lt;?php
// The $_POST superglobal contains all form data sent via POST method
// Use dd() to display the contents for debugging
dd($_POST);
?&gt;</code></pre>

    <hr>

    <h2>Try It</h2>
    <p>Submit the form below to see the <code>$_POST</code> data displayed by the handler.</p>

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
