<?php
require_once 'lib/config.php';
require_once 'lib/session.php';
require_once 'lib/utils.php';

startSession();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'inc/head_content.php'; ?>
    <title>PHP Form Handling - Exercise</title>
</head>
<body>
    <div class="container">
        <div class="back-link">
            <a href="/index.php">&larr; Back to Module Index</a>
            <a href="/examples/04-php-forms/">View Examples &rarr;</a>
        </div>

        <h1>PHP Form Handling Exercise</h1>

        <p>In this exercise, you will build a <strong>Create Book Form</strong> by progressively implementing form handling techniques. Follow the steps below, referring to the corresponding examples as you go.</p>

        <h2>Your Task</h2>
        <p><a href="book_create.php" class="button">Open Create Book Form &rarr;</a></p>

        <p>The form has the following fields:</p>
        <ul>
            <li><strong>title</strong> - required, text, 3-255 characters</li>
            <li><strong>author</strong> - required, text, 3-255 characters</li>
            <li><strong>publisher_id</strong> - required, integer</li>
            <li><strong>year</strong> - required, integer, four digits, 1900-2026</li>
            <li><strong>isbn</strong> - required, text, 13 characters</li>
            <li><strong>description</strong> - required, text</li>
            <li><strong>cover</strong> - required, file upload, image only, max 2MB</li>
            <li><strong>format_ids</strong> - required, array of integer</li>
        </ul>

        <hr>

        <h2>Implementation Steps</h2>
        <p>Work through each step in order. The starter files (<code>book_create.php</code> and <code>book_store.php</code>) contain TODO comments and hints for each step.</p>

        <table>
            <thead>
                <tr>
                    <th>Step</th>
                    <th>Topic</th>
                    <th>What You'll Learn</th>
                    <th>Example</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Form Submission</td>
                    <td>Use <code>dd($_POST)</code> to view submitted data</td>
                    <td><a href="/examples/04-php-forms/step-01-form-submission/product_create.php">View</a></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Request Method</td>
                    <td>Check <code>$_SERVER['REQUEST_METHOD']</code> is POST</td>
                    <td><a href="/examples/04-php-forms/step-02-request-method/product_create.php">View</a></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Data Extraction</td>
                    <td>Extract form data into a <code>$data</code> array using <code>??</code></td>
                    <td><a href="/examples/04-php-forms/step-03-data-extraction/product_create.php">View</a></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Validation</td>
                    <td>Use the <code>Validator</code> class with rules</td>
                    <td><a href="/examples/04-php-forms/step-04-validation/product_create.php">View</a></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Display Errors</td>
                    <td>Use <code>setFormErrors()</code> and <code>error()</code></td>
                    <td><a href="/examples/04-php-forms/step-05-display-errors/product_create.php">View</a></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Repopulate Fields</td>
                    <td>Use <code>setFormData()</code> and <code>old()</code></td>
                    <td><a href="/examples/04-php-forms/step-06-repopulate-fields/product_create.php">View</a></td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Select &amp; Checkboxes</td>
                    <td>Use <code>chosen()</code> to preserve selections</td>
                    <td><a href="/examples/04-php-forms/step-07-select-checkbox/product_create.php">View</a></td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>Flash Messages</td>
                    <td>Use <code>setFlashMessage()</code> for feedback</td>
                    <td><a href="/examples/04-php-forms/step-08-flash-messages/product_create.php">View</a></td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>File Uploads</td>
                    <td>Handle <code>$_FILES</code> with <code>ImageUpload</code> class</td>
                    <td><a href="/examples/04-php-forms/step-09-file-uploads/product_create.php">View</a></td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>Complete Form</td>
                    <td>Clear session data with <code>clearFormData()</code></td>
                    <td><a href="/examples/04-php-forms/step-10-complete/product_create.php">View</a></td>
                </tr>
            </tbody>
        </table>

        <hr>

        <h2>Validation Rules Reference</h2>
        <p>Use these rules with the <code>Validator</code> class:</p>
        <table>
            <tr><td><code>required</code></td><td>Field must be present and not empty</td></tr>
            <tr><td><code>min:n</code></td><td>Minimum n characters (or n items for arrays)</td></tr>
            <tr><td><code>max:n</code></td><td>Maximum n characters (or n items for arrays)</td></tr>
            <tr><td><code>email</code></td><td>Must be a valid email address</td></tr>
            <tr><td><code>in:a,b,c</code></td><td>Value must be one of the listed options</td></tr>
            <tr><td><code>array</code></td><td>Value must be an array (for checkboxes)</td></tr>
            <tr><td><code>subset:a,b,c</code></td><td>Array values must be from the listed options</td></tr>
            <tr><td><code>file</code></td><td>Must be a valid file upload</td></tr>
            <tr><td><code>image</code></td><td>Must be a valid image file</td></tr>
            <tr><td><code>max_file_size:n</code></td><td>Maximum file size in bytes</td></tr>
        </table>

        <hr>

        <h2>Helper Functions Reference</h2>
        <table>
            <tr><td><code>dd($var)</code></td><td>Dump and display variable for debugging</td></tr>
            <tr><td><code>h($str)</code></td><td>HTML escape string (XSS protection)</td></tr>
            <tr><td><code>redirect($url)</code></td><td>HTTP redirect and exit</td></tr>
            <tr><td><code>old('field')</code></td><td>Get previous form value from session</td></tr>
            <tr><td><code>error('field')</code></td><td>Get validation error for field</td></tr>
            <tr><td><code>chosen('field', $val)</code></td><td>Check if option was selected</td></tr>
            <tr><td><code>setFormData($data)</code></td><td>Store form data in session</td></tr>
            <tr><td><code>setFormErrors($errors)</code></td><td>Store errors in session</td></tr>
            <tr><td><code>clearFormData()</code></td><td>Remove form data from session</td></tr>
            <tr><td><code>clearFormErrors()</code></td><td>Remove errors from session</td></tr>
            <tr><td><code>setFlashMessage($type, $msg)</code></td><td>Set flash message (success/error)</td></tr>
        </table>

        <hr>

        <h2>Files</h2>
        <ul>
            <li><code>book_create.php</code> - The registration form (display)</li>
            <li><code>book_store.php</code> - The form handler (processing)</li>
            <li><code>classes/Validator.php</code> - Validation class</li>
            <li><code>classes/ImageUpload.php</code> - File upload helper</li>
            <li><code>lib/forms.php</code> - Form helper functions (old, error, chosen)</li>
            <li><code>lib/session.php</code> - Session helper functions</li>
            <li><code>lib/utils.php</code> - Utility functions (dd, h, redirect)</li>
        </ul>
    </div>
</body>
</html>
