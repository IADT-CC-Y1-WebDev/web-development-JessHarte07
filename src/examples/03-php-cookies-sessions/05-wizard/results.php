<?php
// =============================================================================
// SESSION LOGIC - Must be at the top
// =============================================================================

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirect to step 1 if wizard not started or not complete
if (!isset($_SESSION['wizard']) || !isset($_SESSION['wizard']['completed_at'])) {
    header('Location: step1.php');
    exit;
}

// Get all answers
$answers = $_SESSION['wizard']['answers'];
$startedAt = $_SESSION['wizard']['started_at'];
$completedAt = $_SESSION['wizard']['completed_at'];

// Generate a "personality" based on answers (just for fun!)
$personalities = [
    'spring' => ['trait' => 'optimistic', 'color' => '#90EE90'],
    'summer' => ['trait' => 'energetic', 'color' => '#FFD700'],
    'autumn' => ['trait' => 'thoughtful', 'color' => '#DEB887'],
    'winter' => ['trait' => 'calm', 'color' => '#87CEEB'],
];

$activities = [
    'outdoors' => 'adventure-seeking',
    'social' => 'people-loving',
    'creative' => 'imaginative',
    'relaxing' => 'peaceful',
];

$times = [
    'early_bird' => 'productive morning',
    'night_owl' => 'creative night',
    'flexible' => 'adaptable',
    'afternoon' => 'steady afternoon',
];

$season = $answers['favorite_season'] ?? 'spring';
$activity = $answers['activity_preference'] ?? 'outdoors';
$time = $answers['time_preference'] ?? 'flexible';

$personality = $personalities[$season];
$activityTrait = $activities[$activity];
$timeTrait = $times[$time];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results - Multi-Step Wizard</title>
    <link rel="stylesheet" href="/examples/css/style.css">
    <link rel="stylesheet" href="/examples/css/prism-tomorrow.min.css">
    <style>
        .progress-bar {
            display: flex;
            margin: 1rem 0;
            background: #f0f0f0;
            border-radius: 8px;
            overflow: hidden;
        }
        .progress-step {
            flex: 1;
            padding: 0.75rem;
            text-align: center;
            background: #e0e0e0;
            border-right: 1px solid #ccc;
        }
        .progress-step:last-child { border-right: none; }
        .progress-step.active { background: #3498db; color: white; }
        .progress-step.completed { background: #27ae60; color: white; }
        .results-box {
            background: <?= $personality['color'] ?>;
            padding: 2rem;
            border-radius: 8px;
            text-align: center;
            margin: 1rem 0;
        }
        .results-box h2 { margin-top: 0; }
        .answers-summary {
            background: #f9f9f9;
            padding: 1.5rem;
            border-radius: 8px;
            margin: 1rem 0;
        }
        .answers-summary ul {
            list-style: none;
            padding: 0;
        }
        .answers-summary li {
            padding: 0.5rem 0;
            border-bottom: 1px solid #eee;
        }
        .answers-summary li:last-child { border-bottom: none; }
        .session-debug {
            background: #2d2d2d;
            color: #f8f8f2;
            padding: 1rem;
            border-radius: 8px;
            font-family: monospace;
            font-size: 0.9rem;
            overflow-x: auto;
        }
    </style>
</head>
<body>
    <div class="back-link">
        <a href="../index.php">&larr; Back to Cookies &amp; Sessions</a>
        <a href="/exercises/03-php-cookies-sessions/05-wizard/results.php">Go to Exercise &rarr;</a>
    </div>

    <h1>Multi-Step Wizard (Sessions)</h1>

    <!-- Progress Bar -->
    <div class="progress-bar">
        <div class="progress-step completed">Step 1</div>
        <div class="progress-step completed">Step 2</div>
        <div class="progress-step completed">Step 3</div>
        <div class="progress-step active">Results</div>
    </div>

    <!-- Results -->
    <div class="results-box">
        <h2>Your Personality Profile</h2>
        <p style="font-size: 1.25rem;">
            You are a <strong><?= $personality['trait'] ?></strong>,
            <strong><?= $activityTrait ?></strong> person with
            <strong><?= $timeTrait ?></strong> energy!
        </p>
    </div>

    <!-- Answers Summary -->
    <div class="answers-summary">
        <h3>Your Answers</h3>
        <ul>
            <li><strong>Favorite Season:</strong> <?= ucfirst($season) ?></li>
            <li><strong>Activity Preference:</strong> <?= ucfirst(str_replace('_', ' ', $activity)) ?></li>
            <li><strong>Time Preference:</strong> <?= ucfirst(str_replace('_', ' ', $time)) ?></li>
        </ul>
        <p><small>Started: <?= $startedAt ?> | Completed: <?= $completedAt ?></small></p>
    </div>

    <p><a href="step1.php?restart=1">Take the Quiz Again</a></p>

    <!-- Code Explanation -->
    <h2>How It Works</h2>

    <h3>Accessing All Collected Data</h3>
    <p>The results page can access all data collected during the wizard because it was stored in the session.</p>
    <pre><code class="language-php">// Get all answers from the session
$answers = $_SESSION['wizard']['answers'];
$startedAt = $_SESSION['wizard']['started_at'];
$completedAt = $_SESSION['wizard']['completed_at'];

// Access individual answers
$season = $answers['favorite_season'];      // From step 1
$activity = $answers['activity_preference']; // From step 2
$time = $answers['time_preference'];         // From step 3</code></pre>

    <h3>Verifying Completion</h3>
    <p>We check that the wizard was actually completed before showing results.</p>
    <pre><code class="language-php">// Redirect if wizard not complete
if (!isset($_SESSION['wizard']) || !isset($_SESSION['wizard']['completed_at'])) {
    header('Location: step1.php');
    exit;
}</code></pre>

    <!-- Session Debug -->
    <h2>Session Data (Debug View)</h2>
    <p>Here's the actual session data that was collected:</p>
    <div class="output">
        <pre><?php print_r($_SESSION['wizard']); ?></pre>
    </div>

    <h2>Key Takeaways</h2>
    <ul>
        <li><strong>Data Accumulation:</strong> Each step added to the same session array</li>
        <li><strong>No URL Parameters:</strong> Data didn't need to be passed in every URL</li>
        <li><strong>Navigation:</strong> Users can go back and change answers</li>
        <li><strong>Validation:</strong> Each step can check if previous steps were completed</li>
        <li><strong>Cleanup:</strong> Data can be cleared when starting over</li>
    </ul>

    <script src="/examples/js/prism-core.min.js"></script>
    <script src="/examples/js/prism-autoloader.min.js" data-autoloader-path="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/"></script>
</body>
</html>
