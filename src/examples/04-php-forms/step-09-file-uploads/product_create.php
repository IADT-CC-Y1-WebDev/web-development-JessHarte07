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
    <title>Step 9: File Uploads - PHP Form Handling</title>
</head>
<body>
    <div class="back-link">
        <a href="../step-08-flash-messages/product_create.php">&larr; Previous Step</a>
        <a href="../index.php">Index</a>
        <a href="/exercises/04-php-forms/book_create.php">Go to Exercise &rarr;</a>
        <a href="../step-10-complete/product_create.php">Next Step &rarr;</a>
    </div>

    <h1>Step 9: File Uploads</h1>

    <p>File uploads require special handling: the form needs <code>enctype="multipart/form-data"</code>, and uploaded files are accessed via <code>$_FILES</code> instead of <code>$_POST</code>.</p>

    <h2>The Form</h2>
    <p>Add <code>enctype="multipart/form-data"</code> to the form tag and include a file input.</p>

    <pre><code class="language-html">&lt;form action="product_store.php" method="POST" enctype="multipart/form-data"&gt;
    &lt;!-- other fields... --&gt;

    &lt;input type="file" name="image" accept="image/*"&gt;
&lt;/form&gt;</code></pre>

    <h2>The Handler</h2>
    <p>Access uploaded files via <code>$_FILES</code>. Use the <code>ImageUpload</code> class to process and save the file.</p>

    <pre><code class="language-php">&lt;?php
// Extract file from $_FILES (not $_POST)
$data['image'] = $_FILES['image'] ?? null;

// Add file validation rules
$rules['image'] = 'required|file|image|mimes:jpg,jpeg,png|max_file_size:5242880';

// After validation passes, process the upload
$uploader = new ImageUpload();
$imageFilename = $uploader->process($_FILES['image']);
?&gt;</code></pre>

    <h3>File Validation Rules</h3>
    <ul>
        <li><code>file</code> - Must be a valid file upload</li>
        <li><code>image</code> - Must be a valid image file</li>
        <li><code>mimes:jpg,jpeg,png</code> - Allowed file types</li>
        <li><code>max_file_size:5242880</code> - Maximum size in bytes (5MB)</li>
    </ul>

    <hr>

    <h2>Try It</h2>
    <p>Upload an image with your product. Try uploading an invalid file type to see validation errors.</p>

    <?php require '../inc/flash_message.php'; ?>

    <form action="product_store.php" method="POST" enctype="multipart/form-data">
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
            <label for="image">Product Image:</label>
            <input type="file" id="image" name="image" accept="image/*">
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
clearFormData();
clearFormErrors();
?>
