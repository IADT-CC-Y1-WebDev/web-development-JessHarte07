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
    <title>PHP Form Handling - Examples</title>
</head>
<body>
    <div class="container">
        <div class="back-link">
            <a href="/index.php">&larr; Back to Module Index</a>
        </div>

        <h1>PHP Form Handling</h1>

        <p>This series of examples demonstrates how to handle HTML forms in PHP, including validation, error display, form repopulation, and file uploads. Work through each step in order to build your understanding.</p>

        <h2>Phase 1: Form Fundamentals</h2>

        <ol class="step-list">
            <li>
                <a href="step-01-form-submission/product_create.php"><strong>Form Submission Basics</strong></a>
                <p>Learn how forms submit data via POST and access it using <code>$_POST</code></p>
            </li>
            <li>
                <a href="step-02-request-method/product_create.php"><strong>Request Method Validation</strong></a>
                <p>Verify the request is POST using <code>$_SERVER['REQUEST_METHOD']</code></p>
            </li>
            <li>
                <a href="step-03-data-extraction/product_create.php"><strong>Data Extraction</strong></a>
                <p>Extract form data into a structured array using null coalescing (<code>??</code>)</p>
            </li>
            <li>
                <a href="step-04-validation/product_create.php"><strong>Validation</strong></a>
                <p>Validate data using the <code>Validator</code> class with declarative rules</p>
            </li>
        </ol>

        <h2>Phase 2: Error Handling &amp; UX</h2>

        <ol class="step-list" start="5">
            <li>
                <a href="step-05-display-errors/product_create.php"><strong>Displaying Errors</strong></a>
                <p>Store errors in session and display them next to form fields</p>
            </li>
            <li>
                <a href="step-06-repopulate-fields/product_create.php"><strong>Repopulating Fields</strong></a>
                <p>Preserve user input after validation fails using <code>old()</code></p>
            </li>
            <li>
                <a href="step-07-select-checkbox/product_create.php"><strong>Select &amp; Checkbox</strong></a>
                <p>Handle select dropdowns and checkboxes with <code>chosen()</code></p>
            </li>
            <li>
                <a href="step-08-flash-messages/product_create.php"><strong>Flash Messages</strong></a>
                <p>Show success/error feedback using the POST-Redirect-GET pattern</p>
            </li>
        </ol>

        <h2>Phase 3: Files &amp; Complete</h2>

        <ol class="step-list" start="9">
            <li>
                <a href="step-09-file-uploads/product_create.php"><strong>File Uploads</strong></a>
                <p>Handle file uploads with <code>$_FILES</code> and validation</p>
            </li>
            <li>
                <a href="step-10-complete/product_create.php"><strong>Complete Form</strong></a>
                <p>The complete form handling pattern with all components</p>
            </li>
        </ol>

        <hr>

        <h2>Helper Functions Reference</h2>

        <table>
            <thead>
                <tr>
                    <th>Function</th>
                    <th>Purpose</th>
                    <th>File</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><code>dd($var)</code></td>
                    <td>Dump variable for debugging</td>
                    <td>lib/utils.php</td>
                </tr>
                <tr>
                    <td><code>h($string)</code></td>
                    <td>HTML escape output (XSS protection)</td>
                    <td>lib/utils.php</td>
                </tr>
                <tr>
                    <td><code>redirect($url)</code></td>
                    <td>HTTP redirect and exit</td>
                    <td>lib/utils.php</td>
                </tr>
                <tr>
                    <td><code>setFormData($data)</code></td>
                    <td>Store form data in session</td>
                    <td>lib/session.php</td>
                </tr>
                <tr>
                    <td><code>setFormErrors($errors)</code></td>
                    <td>Store validation errors in session</td>
                    <td>lib/session.php</td>
                </tr>
                <tr>
                    <td><code>clearFormData()</code></td>
                    <td>Remove form data from session</td>
                    <td>lib/session.php</td>
                </tr>
                <tr>
                    <td><code>clearFormErrors()</code></td>
                    <td>Remove errors from session</td>
                    <td>lib/session.php</td>
                </tr>
                <tr>
                    <td><code>setFlashMessage($type, $msg)</code></td>
                    <td>Set one-time message</td>
                    <td>lib/session.php</td>
                </tr>
                <tr>
                    <td><code>old($field, $default)</code></td>
                    <td>Get previous field value</td>
                    <td>lib/forms.php</td>
                </tr>
                <tr>
                    <td><code>error($field)</code></td>
                    <td>Get error message for field</td>
                    <td>lib/forms.php</td>
                </tr>
                <tr>
                    <td><code>chosen($field, $value, $default)</code></td>
                    <td>Check if option was selected</td>
                    <td>lib/forms.php</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
