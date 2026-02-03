<?php
// =============================================================================
// EXERCISE: Theme Selector - Cookies vs Sessions
// =============================================================================
// Complete the TODO sections to implement theme selection using both
// cookies (persistent) and sessions (temporary).
// =============================================================================

// =============================================================================
// Exercise 1: Start the session
// Hint: Check if session is not already started, then call session_start()
// -----------------------------------------------------------------------------
// TODO: Start the session here

// =============================================================================

// =============================================================================
// Exercise 2: Handle cookie-based theme selection
// When $_GET['cookie_theme'] is set:
// 1. Get the theme value from $_GET
// 2. Set a cookie named 'theme' with this value (expire in 30 days)
// 3. Redirect back to this page
// 4. Call exit
// -----------------------------------------------------------------------------
// TODO: Handle cookie theme selection here

// =============================================================================

// =============================================================================
// Exercise 3: Handle session-based theme selection
// When $_GET['session_theme'] is set:
// 1. Get the theme value from $_GET
// 2. Store it in $_SESSION['theme']
// 3. Redirect back to this page
// 4. Call exit
// -----------------------------------------------------------------------------
// TODO: Handle session theme selection here

// =============================================================================

// =============================================================================
// Exercise 4: Handle reset actions
// For $_GET['reset_cookie']: delete the theme cookie
// For $_GET['reset_session']: unset $_SESSION['theme']
// -----------------------------------------------------------------------------
// TODO: Handle reset actions here

// =============================================================================

// Get current theme values (these are provided for you)
$cookieTheme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'not set';
$sessionTheme = isset($_SESSION['theme']) ? $_SESSION['theme'] : 'not set';

// Available themes with their colors
$themes = [
    'light' => ['bg' => '#ffffff', 'text' => '#333333'],
    'dark' => ['bg' => '#1a1a2e', 'text' => '#eaeaea'],
    'blue' => ['bg' => '#e3f2fd', 'text' => '#1565c0'],
    'green' => ['bg' => '#e8f5e9', 'text' => '#2e7d32'],
];

// =============================================================================
// Bonus Exercise: Apply selected theme to page background and text color
// -----------------------------------------------------------------------------
// TODO: Determine which theme to apply (cookie takes precedence over session)

// =============================================================================
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Theme Selector Exercise - PHP Cookies &amp; Sessions</title>
    <link rel="stylesheet" href="/exercises/css/style.css">
    <style>
        .theme-preview {
            padding: 1rem;
            border-radius: 8px;
            margin: 0.5rem 0;
            border: 2px solid #ddd;
        }
        .theme-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin: 1rem 0;
        }
        .theme-box {
            padding: 1rem;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        @media (max-width: 600px) {
            .theme-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<?php
// =============================================================================
// Bonus Exercise: Apply selected theme to page background and text color
// -----------------------------------------------------------------------------
// TODO: Apply the selected theme to the page by setting inline styles on <body>
?>
<body style="">
<?php
// =============================================================================
?>
    <div class="back-link">
        <a href="index.php">&larr; Back to Cookies &amp; Sessions</a>
        <a href="/examples/03-php-cookies-sessions/02-theme-selector.php">View Example &rarr;</a>
    </div>

    <h1>Theme Selector Exercise</h1>

    <!-- Exercise 1: Session Setup -->
    <h2>Exercise 1: Start the Session</h2>
    <p>
        <strong>Task:</strong> At the top of this file, add the code to start a PHP session.
        Use the pattern that checks if a session is already started before calling <code>session_start()</code>.
    </p>

    <!-- Exercise 2 & 3: Theme Selection -->
    <h2>Exercise 2 & 3: Implement Theme Selection</h2>
    <p>
        <strong>Task:</strong> Complete the handlers at the top of the file for:
        <ul>
            <li><strong>Cookie theme:</strong> When <code>$_GET['cookie_theme']</code> is set</li>
            <li><strong>Session theme:</strong> When <code>$_GET['session_theme']</code> is set</li>
        </ul>
    </p>

    <div class="theme-grid">
        <!-- Cookie Theme -->
        <div class="theme-box">
            <h3>Cookie-Based Theme</h3>
            <p>Current: <strong><?= htmlspecialchars($cookieTheme) ?></strong></p>

            <?php if ($cookieTheme !== 'not set' && isset($themes[$cookieTheme])): ?>
                <div class="theme-preview" style="background: <?= $themes[$cookieTheme]['bg'] ?>; color: <?= $themes[$cookieTheme]['text'] ?>;">
                    Preview: <?= ucfirst($cookieTheme) ?> theme
                </div>
            <?php endif; ?>

            <p>
                <a href="?cookie_theme=light">Light</a> |
                <a href="?cookie_theme=dark">Dark</a> |
                <a href="?cookie_theme=blue">Blue</a> |
                <a href="?cookie_theme=green">Green</a>
            </p>
            <p><a href="?reset_cookie=1">Reset</a></p>
        </div>

        <!-- Session Theme -->
        <div class="theme-box">
            <h3>Session-Based Theme</h3>
            <p>Current: <strong><?= htmlspecialchars($sessionTheme) ?></strong></p>

            <?php if ($sessionTheme !== 'not set' && isset($themes[$sessionTheme])): ?>
                <div class="theme-preview" style="background: <?= $themes[$sessionTheme]['bg'] ?>; color: <?= $themes[$sessionTheme]['text'] ?>;">
                    Preview: <?= ucfirst($sessionTheme) ?> theme
                </div>
            <?php endif; ?>

            <p>
                <a href="?session_theme=light">Light</a> |
                <a href="?session_theme=dark">Dark</a> |
                <a href="?session_theme=blue">Blue</a> |
                <a href="?session_theme=green">Green</a>
            </p>
            <p><a href="?reset_session=1">Reset</a></p>
        </div>
    </div>

    <!-- Exercise 4: Reset Handlers -->
    <h2>Exercise 4: Implement Reset</h2>
    <p>
        <strong>Task:</strong> Complete the reset handlers at the top of the file:
        <ul>
            <li>Reset cookie: Delete the 'theme' cookie by setting expiry in the past</li>
            <li>Reset session: Use <code>unset()</code> to remove <code>$_SESSION['theme']</code></li>
        </ul>
    </p>

    <!-- Exercise 5: Understanding the Difference -->
    <h2>Exercise 5: Test the Difference</h2>
    <p>
        <strong>Task:</strong> After completing the exercises above, test the difference:
        <ol>
            <li>Set both themes to "dark"</li>
            <li>Close your browser completely</li>
            <li>Reopen this page</li>
            <li>What happened to each theme? Why?</li>
        </ol>
    </p>

    <p class="output-label">Write your answer here:</p>
    <div class="output">
        <?php
        // =====================================================================
        // Exercise 5: Understanding the Difference
        // ---------------------------------------------------------------------
        // TODO: After testing, write a comment explaining the difference
        // between cookie persistence and session persistence.
        echo "Answer: The cookie-based theme remains 'dark' because cookies " . 
             "are stored on the client's browser and persist even after closing " . 
             "the browser. The session-based theme resets to 'not set' because " . 
             "sessions are temporary and stored on the server; they end when the " . 
             "browser is closed.";
        ?>
    </div>

    <!-- Bonus Exercise -->
    <h2>Bonus Exercise: Apply Theme to Page</h2>
    <p>
        <strong>Task:</strong> Modify the page so that one of the selected themes
        actually applies to the page background and text color.
    </p>
    <p>
        <strong>Hint:</strong> In the <code>&lt;body&gt;</code> tag, add a style attribute:
        <code>&lt;body style="background: ...; color: ...;"&gt;</code>
    </p>

</body>
</html>
