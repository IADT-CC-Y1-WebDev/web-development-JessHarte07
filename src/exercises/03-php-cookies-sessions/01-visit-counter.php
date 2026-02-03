<?php
// =============================================================================
// EXERCISE: Visit Counter with Cookies
// =============================================================================
// Complete the TODO sections below to create a visit counter using cookies.
// Remember: setcookie() must be called BEFORE any HTML output!
// =============================================================================

// =============================================================================
// Exercise 1: Display Visit Count
// Task: Complete the PHP code at the top of this file to:
// 1. Read the current visit count from the cookie (or default to 0)
// 2. Increment the visit count
// 3. Save the new count back to the cookie
// -----------------------------------------------------------------------------
// TODO Exercise 1: Write your solution here

if (isset($_COOKIE['visit_count'])){
            $visitCount = $_COOKIE['visit_count'];
        }
        else{
            $visitCount=0;
        }

        $visitCount++;
        $expiry = time() + 60 * 60 * 24 * 30;
        setcookie('visit_count',$visitCount, $expiry,'/'); 


// =============================================================================

// =============================================================================
// Exercise 3: Handle the reset action
// When $_GET['reset'] is set:
// 1. Delete the cookie by setting expiry in the past
// 2. Redirect to this page (use header('Location: 01-visit-counter.php'))
// 3. Call exit; after the redirect
// -----------------------------------------------------------------------------
// TODO Exercise 3: Write your solution here

If (isset($_GET['reset'])){
    $expiry = time() - 60 * 60;
    setcookie('visit_count', ' ',$expiry,'/');
    Reader("Location: 01-visit-counter.php");
    exit();
}

// =============================================================================

// =============================================================================
// Exercise 4: Track Last Visit Time (Bonus)
// 1. Read the existing 'last_visit' cookie (if any)
// 2. Set a new 'last_visit' cookie with the current timestamp
// -----------------------------------------------------------------------------
// TODO Exercise 4: Write your solution here

if (isset($_COOKIE['last_visit'])){
            $lastVisit = $_COOKIE['last_visit'];
        }
        else{
            $lastVisit = null ;
        }

        $now = date ('Y-M-D H:')


// =============================================================================
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visit Counter Exercise - PHP Cookies &amp; Sessions</title>
    <link rel="stylesheet" href="/exercises/css/style.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to Cookies &amp; Sessions</a>
        <a href="/examples/03-php-cookies-sessions/01-visit-counter.php">View Example &rarr;</a>
    </div>

    <h1>Visit Counter Exercise</h1>

    <!-- Exercise 1: Basic Visit Counter -->
    <h2>Exercise 1: Display Visit Count</h2>
    <p>
        <strong>Task:</strong> Complete the PHP code at the top of this file to:
        <ol>
            <li>Read the current visit count from the cookie (or default to 0)</li>
            <li>Increment the visit count</li>
            <li>Save the new count back to the cookie</li>
        </ol>
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // =====================================================================
        // Exercise 1: Display the visit count
        // ---------------------------------------------------------------------
        // TODO Exercise 1: Write your solution here


        echo "Visit count = $visitCount";

        // =====================================================================
        ?>
    </div>

    <!-- Exercise 2: First Visit Detection -->
    <h2>Exercise 2: First Visit Message</h2>
    <p>
        <strong>Task:</strong> Display a different message for first-time visitors
        versus returning visitors. Use the visit count to determine this.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // =====================================================================
        // Exercise 2: Use an if/else statement to display:
        // - "Welcome, first-time visitor!" if visitCount is 1
        // - "Hello again!" if visitCount is greater than 1 but less than 10
        // - "Welcome back!" if visitCount is greater than or equal to 10
        // ---------------------------------------------------------------------
        // TODO Exercise 2: Write your solution here

        
        // =====================================================================
        ?>
    </div>

    <!-- Exercise 3: Reset Counter -->
    <h2>Exercise 3: Reset Functionality</h2>
    <p>
        <strong>Task:</strong> Complete the reset handler at the top of the file.
        When the user clicks "Reset Counter", the cookie should be deleted and
        the page should refresh.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <p><a href="01-visit-counter.php">Refresh Page</a></p>
        <p><a href="01-visit-counter.php?reset=1">Reset Counter</a></p>
    </div>

    <!-- Exercise 4: Bonus - Track Last Visit -->
    <h2>Exercise 4 (Bonus): Track Last Visit Time</h2>
    <p>
        <strong>Task:</strong> Add a second cookie called 'last_visit' that stores
        the timestamp of the user's last visit. Display this on the page.
    </p>
    <p>
        <strong>Hints:</strong>
        <ul>
            <li>Use <code>date('Y-m-d H:i:s')</code> to get the current timestamp</li>
            <li>Read the existing 'last_visit' cookie BEFORE setting the new one</li>
            <li>Remember to delete this cookie too when resetting</li>
        </ul>
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // =====================================================================
        // Exercise 4: Display the last visit time
        // Example output: "Your last visit was: 2024-01-15 10:30:45"
        // ---------------------------------------------------------------------
        // TODO Exercise 4: Write your solution here
        
        // =====================================================================
        ?>
    </div>

</body>
</html>
