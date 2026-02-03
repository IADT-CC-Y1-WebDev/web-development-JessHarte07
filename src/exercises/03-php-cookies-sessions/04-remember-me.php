<?php
// =============================================================================
// EXERCISE: Remember Me - Cookies + Sessions Combined
// =============================================================================
// Complete the TODO sections to implement a "Remember Me" login simulation.
// This shows how cookies and sessions work together.
// =============================================================================

// TODO Exercise 1: Start the session


// Available users (this is provided for you)
$users = ['alice', 'bob', 'charlie', 'dana'];

// TODO Exercise 2: Handle "Login" action
// When $_GET['login'] is set:
// 1. Get the username from $_GET['login']
// 2. Check if the username is in the $users array (use in_array())
// 3. If valid, set $_SESSION['logged_in_user'] to the username
// 4. If $_GET['remember'] is also set, save a cookie 'remembered_user' (30 days)
// 5. Redirect back to this page


// TODO Exercise 3: Handle "Logout" action
// When $_GET['logout'] is set:
// 1. Unset $_SESSION['logged_in_user']
// 2. If $_GET['forget'] is also set, delete the 'remembered_user' cookie
// 3. Redirect back to this page


// TODO Exercise 4: Handle "Clear Remember Cookie" action
// When $_GET['clear_cookie'] is set:
// 1. Delete the 'remembered_user' cookie
// 2. Redirect back to this page


// Determine current state (this is provided for you)
$isLoggedIn = isset($_SESSION['logged_in_user']);
$currentUser = $isLoggedIn ? $_SESSION['logged_in_user'] : null;
$rememberedUser = isset($_COOKIE['remembered_user']) ? $_COOKIE['remembered_user'] : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remember Me Exercise - PHP Cookies &amp; Sessions</title>
    <link rel="stylesheet" href="/exercises/css/style.css">
    <style>
        .status-box {
            padding: 1.5rem;
            border-radius: 8px;
            margin: 1rem 0;
        }
        .logged-in { background: #d4edda; border: 1px solid #c3e6cb; }
        .logged-out { background: #f8f9fa; border: 1px solid #dee2e6; }
        .remember-notice {
            background: #fff3cd;
            border: 1px solid #ffeeba;
            padding: 1rem;
            border-radius: 8px;
            margin: 1rem 0;
        }
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
        .user-buttons a.remember { background: #27ae60; }
        .user-buttons a.remember:hover { background: #219a52; }
        .state-display {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin: 1rem 0;
        }
        .state-box {
            padding: 1rem;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        @media (max-width: 600px) {
            .state-display { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to Cookies &amp; Sessions</a>
        <a href="/examples/03-php-cookies-sessions/04-remember-me.php">View Example &rarr;</a>
    </div>

    <h1>Remember Me Exercise</h1>

    <!-- Current State Display -->
    <h2>Current State</h2>
    <div class="state-display">
        <div class="state-box">
            <h4>Session</h4>
            <p><strong>Logged in as:</strong>
                <?= $currentUser ? htmlspecialchars($currentUser) : '<em>None</em>' ?>
            </p>
        </div>
        <div class="state-box">
            <h4>Cookie</h4>
            <p><strong>Remembered user:</strong>
                <?= $rememberedUser ? htmlspecialchars($rememberedUser) : '<em>None</em>' ?>
            </p>
        </div>
    </div>

    <!-- Exercise 2: Login -->
    <h2>Exercise 2: Implement Login</h2>
    <p>
        <strong>Task:</strong> Complete the login handler at the top of the file.
        Clicking a name should set the session. Clicking "Name + Remember"
        should also set a cookie.
    </p>

    <?php if ($isLoggedIn): ?>
        <div class="status-box logged-in">
            <h3>Welcome, <?= htmlspecialchars($currentUser) ?>!</h3>
            <p>
                <a href="?logout=1">Logout (keep cookie)</a> |
                <a href="?logout=1&forget=1">Logout and forget me</a>
            </p>
        </div>
    <?php else: ?>
        <div class="status-box logged-out">
            <h3>Not logged in</h3>

            <?php if ($rememberedUser): ?>
                <div class="remember-notice">
                    <p>Welcome back, <strong><?= htmlspecialchars($rememberedUser) ?></strong>!</p>
                    <p>
                        <a href="?login=<?= htmlspecialchars($rememberedUser) ?>">Login as <?= htmlspecialchars($rememberedUser) ?></a> |
                        <a href="?clear_cookie=1">That's not me</a>
                    </p>
                </div>
            <?php endif; ?>

            <p>Choose a user to login as:</p>
            <div class="user-buttons">
                <?php foreach ($users as $user): ?>
                    <a href="?login=<?= $user ?>"><?= ucfirst($user) ?></a>
                    <a href="?login=<?= $user ?>&remember=1" class="remember"><?= ucfirst($user) ?> + Remember</a>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Exercise 3: Logout -->
    <h2>Exercise 3: Implement Logout</h2>
    <p>
        <strong>Task:</strong> Complete the logout handler at the top of the file.
        "Logout (keep cookie)" should only clear the session.
        "Logout and forget me" should clear both.
    </p>

    <!-- Exercise 4: Clear Cookie -->
    <h2>Exercise 4: Clear Cookie</h2>
    <p>
        <strong>Task:</strong> Complete the handler for clearing the remember cookie
        (used by the "That's not me" link).
    </p>

    <!-- Testing Instructions -->
    <h2>Exercise 5: Test Your Implementation</h2>
    <p>
        <strong>Task:</strong> Test the following scenarios:
        <ol>
            <li>Login without "Remember" → Close browser → Reopen → You should be logged out</li>
            <li>Login with "Remember" → Close browser → Reopen → You should see "Welcome back"</li>
            <li>Click "Logout (keep cookie)" → The cookie should remain</li>
            <li>Click "Logout and forget me" → Both session and cookie should be cleared</li>
        </ol>
    </p>

    <p class="output-label">Write your observations here:</p>
    <div class="output">
        <?php
        // TODO: After testing, write a comment explaining:
        // 1. What is the session used for?
        // 2. What is the cookie used for?
        // 3. Why use both together?
        ?>
    </div>

</body>
</html>
