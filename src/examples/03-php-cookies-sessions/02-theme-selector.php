<?php
// =============================================================================
// SESSION AND COOKIE LOGIC - Must be at the top
// =============================================================================

// Start the session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Handle theme changes via query parameters
if (isset($_GET['cookie_theme'])) {
    // Set theme using a COOKIE (persists after browser closes)
    $theme = $_GET['cookie_theme'];
    setcookie('theme', $theme, time() + (60 * 60 * 24 * 30), '/');
    header('Location: 02-theme-selector.php');
    exit;
}

if (isset($_GET['session_theme'])) {
    // Set theme using a SESSION (only lasts until browser closes)
    $_SESSION['theme'] = $_GET['session_theme'];
    header('Location: 02-theme-selector.php');
    exit;
}

// Handle reset actions
if (isset($_GET['reset_cookie'])) {
    setcookie('theme', '', time() - 3600, '/');
    header('Location: 02-theme-selector.php');
    exit;
}

if (isset($_GET['reset_session'])) {
    unset($_SESSION['theme']);
    header('Location: 02-theme-selector.php');
    exit;
}

// Get current theme values
$cookieTheme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'not set';
$sessionTheme = isset($_SESSION['theme']) ? $_SESSION['theme'] : 'not set';

// Theme styles
$themes = [
    'light' => ['bg' => '#ffffff', 'text' => '#333333', 'accent' => '#0066cc'],
    'dark' => ['bg' => '#1a1a2e', 'text' => '#eaeaea', 'accent' => '#4da6ff'],
    'nature' => ['bg' => '#f0f7e6', 'text' => '#2d5016', 'accent' => '#4a7c23'],
    'sunset' => ['bg' => '#fff5e6', 'text' => '#8b4513', 'accent' => '#ff6b35'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Theme Selector - PHP Cookies &amp; Sessions</title>
    <link rel="stylesheet" href="/examples/css/style.css">
    <link rel="stylesheet" href="/examples/css/prism-tomorrow.min.css">
    <style>
        .theme-demo {
            padding: 1.5rem;
            border-radius: 8px;
            margin: 1rem 0;
            border: 2px solid #ddd;
        }
        .theme-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            margin: 0.5rem 0;
        }
        .theme-buttons a {
            padding: 0.5rem 1rem;
            border-radius: 4px;
            text-decoration: none;
            border: 1px solid #ccc;
        }
        .comparison-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin: 1rem 0;
        }
        .comparison-box {
            padding: 1rem;
            border-radius: 8px;
            border: 2px solid #ddd;
        }
        @media (max-width: 600px) {
            .comparison-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to Cookies &amp; Sessions</a>
        <a href="/exercises/03-php-cookies-sessions/02-theme-selector.php">Go to Exercise &rarr;</a>
    </div>

    <h1>Theme Selector (Cookies vs Sessions)</h1>

    <p>This example demonstrates the difference between cookies and sessions by
    implementing the same feature (theme selection) using both approaches.</p>

    <!-- Live Demo -->
    <h2>Live Demo: Compare Cookies vs Sessions</h2>
    <p>Try selecting themes below, then <strong>close your browser completely</strong>
    and reopen this page. The cookie-based theme will persist, but the session-based theme will reset!</p>

    <div class="comparison-grid">
        <!-- Cookie-based Theme -->
        <div class="comparison-box">
            <h3>Cookie-Based Theme</h3>
            <p>Current: <strong><?= htmlspecialchars($cookieTheme) ?></strong></p>

            <?php if ($cookieTheme !== 'not set' && isset($themes[$cookieTheme])): ?>
                <div class="theme-demo" style="background: <?= $themes[$cookieTheme]['bg'] ?>; color: <?= $themes[$cookieTheme]['text'] ?>;">
                    <p>This is how the <strong style="color: <?= $themes[$cookieTheme]['accent'] ?>"><?= $cookieTheme ?></strong> theme looks!</p>
                </div>
            <?php endif; ?>

            <div class="theme-buttons">
                <a href="?cookie_theme=light">Light</a>
                <a href="?cookie_theme=dark">Dark</a>
                <a href="?cookie_theme=nature">Nature</a>
                <a href="?cookie_theme=sunset">Sunset</a>
            </div>
            <p><a href="?reset_cookie=1">Reset Cookie</a></p>
        </div>

        <!-- Session-based Theme -->
        <div class="comparison-box">
            <h3>Session-Based Theme</h3>
            <p>Current: <strong><?= htmlspecialchars($sessionTheme) ?></strong></p>

            <?php if ($sessionTheme !== 'not set' && isset($themes[$sessionTheme])): ?>
                <div class="theme-demo" style="background: <?= $themes[$sessionTheme]['bg'] ?>; color: <?= $themes[$sessionTheme]['text'] ?>;">
                    <p>This is how the <strong style="color: <?= $themes[$sessionTheme]['accent'] ?>"><?= $sessionTheme ?></strong> theme looks!</p>
                </div>
            <?php endif; ?>

            <div class="theme-buttons">
                <a href="?session_theme=light">Light</a>
                <a href="?session_theme=dark">Dark</a>
                <a href="?session_theme=nature">Nature</a>
                <a href="?session_theme=sunset">Sunset</a>
            </div>
            <p><a href="?reset_session=1">Reset Session</a></p>
        </div>
    </div>

    <!-- Example 1: Starting a Session -->
    <h2>Starting a Session</h2>
    <p>Sessions must be started with <code>session_start()</code> before you can use <code>$_SESSION</code>.
    This must be called before any HTML output, just like <code>setcookie()</code>.</p>
    <pre><code class="language-php">// Start or resume a session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Now you can use $_SESSION
$_SESSION['theme'] = 'dark';</code></pre>

    <!-- Example 2: Cookie-based Theme -->
    <h2>Setting Theme with Cookies</h2>
    <p>Cookies are stored in the browser and persist even after the browser is closed (until they expire).</p>
    <pre><code class="language-php">// Handle theme selection via URL parameter
if (isset($_GET['cookie_theme'])) {
    $theme = $_GET['cookie_theme'];

    // Store in cookie for 30 days
    setcookie('theme', $theme, time() + (60 * 60 * 24 * 30), '/');

    // Redirect to remove the query parameter
    header('Location: 02-theme-selector.php');
    exit;
}

// Read the theme from the cookie
$cookieTheme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'light';</code></pre>

    <!-- Example 3: Session-based Theme -->
    <h2>Setting Theme with Sessions</h2>
    <p>Sessions are stored on the server and only last until the browser is closed
    (or the session times out).</p>
    <pre><code class="language-php">// Handle theme selection via URL parameter
if (isset($_GET['session_theme'])) {
    $_SESSION['theme'] = $_GET['session_theme'];

    // Redirect to remove the query parameter
    header('Location: 02-theme-selector.php');
    exit;
}

// Read the theme from the session
$sessionTheme = isset($_SESSION['theme']) ? $_SESSION['theme'] : 'light';</code></pre>

    <!-- Comparison Table -->
    <h2>Cookies vs Sessions: When to Use Each</h2>
    <table style="width: 100%; border-collapse: collapse; margin: 1rem 0;">
        <tr style="background: #f5f5f5;">
            <th style="padding: 0.75rem; border: 1px solid #ddd; text-align: left;">Feature</th>
            <th style="padding: 0.75rem; border: 1px solid #ddd; text-align: left;">Cookies</th>
            <th style="padding: 0.75rem; border: 1px solid #ddd; text-align: left;">Sessions</th>
        </tr>
        <tr>
            <td style="padding: 0.75rem; border: 1px solid #ddd;"><strong>Storage Location</strong></td>
            <td style="padding: 0.75rem; border: 1px solid #ddd;">User's browser</td>
            <td style="padding: 0.75rem; border: 1px solid #ddd;">Server</td>
        </tr>
        <tr>
            <td style="padding: 0.75rem; border: 1px solid #ddd;"><strong>Persistence</strong></td>
            <td style="padding: 0.75rem; border: 1px solid #ddd;">Until expiry date</td>
            <td style="padding: 0.75rem; border: 1px solid #ddd;">Until browser closes</td>
        </tr>
        <tr>
            <td style="padding: 0.75rem; border: 1px solid #ddd;"><strong>Size Limit</strong></td>
            <td style="padding: 0.75rem; border: 1px solid #ddd;">~4KB per cookie</td>
            <td style="padding: 0.75rem; border: 1px solid #ddd;">Limited by server memory</td>
        </tr>
        <tr>
            <td style="padding: 0.75rem; border: 1px solid #ddd;"><strong>Security</strong></td>
            <td style="padding: 0.75rem; border: 1px solid #ddd;">User can view/modify</td>
            <td style="padding: 0.75rem; border: 1px solid #ddd;">User cannot access</td>
        </tr>
        <tr>
            <td style="padding: 0.75rem; border: 1px solid #ddd;"><strong>Best For</strong></td>
            <td style="padding: 0.75rem; border: 1px solid #ddd;">Preferences, "remember me"</td>
            <td style="padding: 0.75rem; border: 1px solid #ddd;">Shopping carts, login state</td>
        </tr>
    </table>

    <script src="/examples/js/prism-core.min.js"></script>
    <script src="/examples/js/prism-autoloader.min.js" data-autoloader-path="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/"></script>
</body>
</html>
