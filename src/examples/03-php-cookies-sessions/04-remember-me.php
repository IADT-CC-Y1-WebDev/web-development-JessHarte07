<?php
// =============================================================================
// SESSION AND COOKIE LOGIC - Must be at the top
// =============================================================================

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Available users (in a real app, this would be a database)
$users = ['alice', 'bob', 'charlie'];

// Handle "Login" action
if (isset($_GET['login'])) {
    $username = $_GET['login'];

    if (in_array($username, $users)) {
        // Set session (logged in for this browser session)
        $_SESSION['logged_in_user'] = $username;

        // If "remember me" is also set, save to cookie
        if (isset($_GET['remember'])) {
            setcookie('remembered_user', $username, time() + (60 * 60 * 24 * 30), '/');
        }
    }

    header('Location: 04-remember-me.php');
    exit;
}

// Handle "Logout" action
if (isset($_GET['logout'])) {
    // Clear session
    unset($_SESSION['logged_in_user']);

    // Optionally clear the remember cookie too
    if (isset($_GET['forget'])) {
        setcookie('remembered_user', '', time() - 3600, '/');
    }

    header('Location: 04-remember-me.php');
    exit;
}

// Handle "Clear Remember Cookie" action
if (isset($_GET['clear_cookie'])) {
    setcookie('remembered_user', '', time() - 3600, '/');
    header('Location: 04-remember-me.php');
    exit;
}

// Determine current state
$isLoggedIn = isset($_SESSION['logged_in_user']);
$currentUser = $isLoggedIn ? $_SESSION['logged_in_user'] : null;
$rememberedUser = isset($_COOKIE['remembered_user']) ? $_COOKIE['remembered_user'] : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remember Me - PHP Cookies &amp; Sessions</title>
    <link rel="stylesheet" href="/examples/css/style.css">
    <link rel="stylesheet" href="/examples/css/prism-tomorrow.min.css">
    <style>
        .status-box {
            padding: 1.5rem;
            border-radius: 8px;
            margin: 1rem 0;
        }
        .logged-in { background: #d4edda; border: 1px solid #c3e6cb; }
        .logged-out { background: #f8f9fa; border: 1px solid #dee2e6; }
        .user-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            margin: 1rem 0;
        }
        .user-buttons a {
            padding: 0.5rem 1rem;
            border-radius: 4px;
            text-decoration: none;
            background: #3498db;
            color: white;
        }
        .user-buttons a:hover { background: #2980b9; }
        .user-buttons a.remember {
            background: #27ae60;
        }
        .user-buttons a.remember:hover { background: #219a52; }
        .info-box {
            background: #e7f3ff;
            border: 1px solid #b8daff;
            padding: 1rem;
            border-radius: 8px;
            margin: 1rem 0;
        }
        .state-display {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin: 1rem 0;
        }
        .state-box {
            padding: 1rem;
            border-radius: 8px;
            border: 1px solid #ddd;
        }
        .state-box h4 { margin-top: 0; }
        @media (max-width: 600px) {
            .state-display { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to Cookies &amp; Sessions</a>
        <a href="/exercises/03-php-cookies-sessions/04-remember-me.php">Go to Exercise &rarr;</a>
    </div>

    <h1>Remember Me (Cookies + Sessions)</h1>

    <p>This example shows how cookies and sessions work together. Sessions track
    "logged in" status during a browser session, while cookies remember users
    across browser restarts.</p>

    <!-- Current State Display -->
    <h2>Current State</h2>
    <div class="state-display">
        <div class="state-box">
            <h4>Session (Server-side)</h4>
            <p><strong>Logged in user:</strong>
                <?= $currentUser ? htmlspecialchars($currentUser) : '<em>None</em>' ?>
            </p>
            <p><small>Cleared when browser closes</small></p>
        </div>
        <div class="state-box">
            <h4>Cookie (Browser-side)</h4>
            <p><strong>Remembered user:</strong>
                <?= $rememberedUser ? htmlspecialchars($rememberedUser) : '<em>None</em>' ?>
            </p>
            <p><small>Persists for 30 days</small></p>
        </div>
    </div>

    <!-- Login Status -->
    <?php if ($isLoggedIn): ?>
        <div class="status-box logged-in">
            <h3>Welcome, <?= htmlspecialchars($currentUser) ?>!</h3>
            <p>You are currently logged in.</p>
            <p>
                <a href="?logout=1">Logout (keep remember cookie)</a> |
                <a href="?logout=1&forget=1">Logout and forget me</a>
            </p>
        </div>
    <?php else: ?>
        <div class="status-box logged-out">
            <h3>You are not logged in</h3>

            <?php if ($rememberedUser): ?>
                <div class="info-box">
                    <p><strong>Welcome back!</strong> We remember you as <strong><?= htmlspecialchars($rememberedUser) ?></strong>.</p>
                    <p>
                        <a href="?login=<?= htmlspecialchars($rememberedUser) ?>">Login as <?= htmlspecialchars($rememberedUser) ?></a> |
                        <a href="?clear_cookie=1">That's not me</a>
                    </p>
                </div>
            <?php endif; ?>

            <p>Login as a user:</p>
            <div class="user-buttons">
                <?php foreach ($users as $user): ?>
                    <a href="?login=<?= $user ?>"><?= ucfirst($user) ?></a>
                    <a href="?login=<?= $user ?>&remember=1" class="remember"><?= ucfirst($user) ?> + Remember</a>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- How to Test -->
    <h2>How to Test This</h2>
    <ol>
        <li><strong>Login without "Remember":</strong> Click a name (e.g., "Alice"). Close your browser completely, reopen this page. You'll be logged out.</li>
        <li><strong>Login with "Remember":</strong> Click "Alice + Remember". Close your browser, reopen this page. You'll be logged out BUT the page remembers your name.</li>
        <li><strong>Logout options:</strong> Try both logout options to see the difference.</li>
    </ol>

    <!-- Code Explanation -->
    <h2>How It Works</h2>

    <h3>1. Login with "Remember Me"</h3>
    <p>When the user logs in with "Remember Me", we set both a session AND a cookie.</p>
    <pre><code class="language-php">if (isset($_GET['login'])) {
    $username = $_GET['login'];

    // Set session (for this browser session)
    $_SESSION['logged_in_user'] = $username;

    // If "remember me" is set, also save to cookie (30 days)
    if (isset($_GET['remember'])) {
        setcookie('remembered_user', $username, time() + (60 * 60 * 24 * 30), '/');
    }
}</code></pre>

    <h3>2. Checking Login Status</h3>
    <p>We check the session to determine if the user is currently logged in.</p>
    <pre><code class="language-php">$isLoggedIn = isset($_SESSION['logged_in_user']);
$currentUser = $isLoggedIn ? $_SESSION['logged_in_user'] : null;
$rememberedUser = isset($_COOKIE['remembered_user']) ? $_COOKIE['remembered_user'] : null;</code></pre>

    <h3>3. Welcome Back Message</h3>
    <p>If the user is not logged in but we have a "remember" cookie, we can greet them by name
    and offer a quick login option.</p>
    <pre><code class="language-php">if (!$isLoggedIn && $rememberedUser) {
    echo "Welcome back, $rememberedUser!";
    echo "&lt;a href='?login=$rememberedUser'&gt;Click to login&lt;/a&gt;";
}</code></pre>

    <h3>4. Logout Options</h3>
    <p>Users can choose to logout but keep the remember cookie, or logout and clear everything.</p>
    <pre><code class="language-php">if (isset($_GET['logout'])) {
    // Always clear the session
    unset($_SESSION['logged_in_user']);

    // Only clear cookie if user wants to be "forgotten"
    if (isset($_GET['forget'])) {
        setcookie('remembered_user', '', time() - 3600, '/');
    }
}</code></pre>

    <!-- Key Concept -->
    <h2>Key Concept: Why Use Both?</h2>
    <table style="width: 100%; border-collapse: collapse; margin: 1rem 0;">
        <tr style="background: #f5f5f5;">
            <th style="padding: 0.75rem; border: 1px solid #ddd;">Scenario</th>
            <th style="padding: 0.75rem; border: 1px solid #ddd;">Session</th>
            <th style="padding: 0.75rem; border: 1px solid #ddd;">Cookie</th>
        </tr>
        <tr>
            <td style="padding: 0.75rem; border: 1px solid #ddd;">User is actively logged in</td>
            <td style="padding: 0.75rem; border: 1px solid #ddd;">Tracks login state securely</td>
            <td style="padding: 0.75rem; border: 1px solid #ddd;">Not needed for login state</td>
        </tr>
        <tr>
            <td style="padding: 0.75rem; border: 1px solid #ddd;">User closes browser</td>
            <td style="padding: 0.75rem; border: 1px solid #ddd;">Session destroyed</td>
            <td style="padding: 0.75rem; border: 1px solid #ddd;">Cookie persists</td>
        </tr>
        <tr>
            <td style="padding: 0.75rem; border: 1px solid #ddd;">User returns later</td>
            <td style="padding: 0.75rem; border: 1px solid #ddd;">New empty session</td>
            <td style="padding: 0.75rem; border: 1px solid #ddd;">Can identify returning user</td>
        </tr>
    </table>

    <script src="/examples/js/prism-core.min.js"></script>
    <script src="/examples/js/prism-autoloader.min.js" data-autoloader-path="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/"></script>
</body>
</html>
