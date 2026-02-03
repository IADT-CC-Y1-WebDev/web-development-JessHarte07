<?php
// =============================================================================
// COOKIE LOGIC - Must be at the top BEFORE any HTML output
// =============================================================================

// Get the current visit count from the cookie (default to 0 if not set)
$visitCount = isset($_COOKIE['visit_count']) ? (int)$_COOKIE['visit_count'] : 0;

// Increment the visit count
$visitCount++;

// Set the cookie to expire in 30 days
$expiryTime = time() + (60 * 60 * 24 * 30); // 30 days from now
setcookie('visit_count', $visitCount, $expiryTime, '/');

// Also track the last visit time
$lastVisit = isset($_COOKIE['last_visit']) ? $_COOKIE['last_visit'] : null;
$currentTime = date('Y-m-d H:i:s');
setcookie('last_visit', $currentTime, $expiryTime, '/');

// Handle reset action
if (isset($_GET['reset'])) {
    // Delete cookies by setting expiry in the past
    setcookie('visit_count', '', time() - 3600, '/');
    setcookie('last_visit', '', time() - 3600, '/');
    // Redirect to remove the query parameter
    header('Location: 01-visit-counter.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visit Counter - PHP Cookies &amp; Sessions</title>
    <link rel="stylesheet" href="/examples/css/style.css">
    <link rel="stylesheet" href="/examples/css/prism-tomorrow.min.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to Cookies &amp; Sessions</a>
        <a href="/exercises/03-php-cookies-sessions/01-visit-counter.php">Go to Exercise &rarr;</a>
    </div>

    <h1>Visit Counter (Cookies)</h1>

    <p>This example demonstrates how cookies persist data between page visits.
    Cookies are small pieces of data stored in the user's browser.</p>

    <!-- Live Demo -->
    <h2>Live Demo</h2>
    <div class="output">
        <?php if ($visitCount === 1 && $lastVisit === null): ?>
            <p><strong>Welcome, first-time visitor!</strong></p>
        <?php else: ?>
            <p><strong>Welcome back!</strong></p>
        <?php endif; ?>

        <p>You have visited this page <strong><?= $visitCount ?></strong> time<?= $visitCount !== 1 ? 's' : '' ?>.</p>

        <?php if ($lastVisit !== null): ?>
            <p>Your last visit was: <strong><?= htmlspecialchars($lastVisit) ?></strong></p>
        <?php endif; ?>

        <p>
            <a href="01-visit-counter.php">Refresh Page</a> |
            <a href="01-visit-counter.php?reset=1">Reset Counter</a>
        </p>
    </div>

    <!-- Example 1: Setting a Cookie -->
    <h2>Setting a Cookie</h2>
    <p>The <code>setcookie()</code> function must be called <strong>before</strong> any HTML output.
    It takes the cookie name, value, and expiry time as parameters.</p>
    <pre><code class="language-php">// Calculate expiry time: 30 days from now
$expiryTime = time() + (60 * 60 * 24 * 30);

// Set the cookie
setcookie('visit_count', 1, $expiryTime, '/');</code></pre>

    <p>The parameters are:</p>
    <ul>
        <li><code>'visit_count'</code> - The name of the cookie</li>
        <li><code>1</code> - The value to store</li>
        <li><code>$expiryTime</code> - When the cookie expires (Unix timestamp)</li>
        <li><code>'/'</code> - The path where the cookie is available (/ means entire site)</li>
    </ul>

    <!-- Example 2: Reading a Cookie -->
    <h2>Reading a Cookie</h2>
    <p>Cookies are accessed through the <code>$_COOKIE</code> superglobal array.
    Always check if a cookie exists before using it.</p>
    <pre><code class="language-php">// Check if the cookie exists
if (isset($_COOKIE['visit_count'])) {
    $visitCount = (int)$_COOKIE['visit_count'];
    echo "You have visited $visitCount times.";
} else {
    echo "This is your first visit!";
}</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        if (isset($_COOKIE['visit_count'])) {
            $count = (int)$_COOKIE['visit_count'];
            echo "You have visited $count times.";
        } else {
            echo "This is your first visit!";
        }
        ?>
    </div>

    <!-- Example 3: Deleting a Cookie -->
    <h2>Deleting a Cookie</h2>
    <p>To delete a cookie, set its expiry time to the past. This tells the browser to remove it.</p>
    <pre><code class="language-php">// Delete a cookie by setting expiry in the past
setcookie('visit_count', '', time() - 3600, '/');</code></pre>

    <!-- Example 4: Cookie Timing -->
    <h2>Understanding Cookie Timing</h2>
    <p><strong>Important:</strong> When you set a cookie, it is NOT immediately available in
    <code>$_COOKIE</code>. The cookie is sent to the browser in the HTTP response headers,
    and only becomes available on the <em>next</em> page request.</p>
    <pre><code class="language-php">// This pattern handles the timing issue
$visitCount = isset($_COOKIE['visit_count']) ? (int)$_COOKIE['visit_count'] : 0;
$visitCount++;  // Increment locally
setcookie('visit_count', $visitCount, $expiryTime, '/');  // Save for next time

// Use $visitCount (not $_COOKIE['visit_count']) for display</code></pre>

    <script src="/examples/js/prism-core.min.js"></script>
    <script src="/examples/js/prism-autoloader.min.js" data-autoloader-path="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/"></script>
</body>
</html>
