<?php
// =============================================================================
// SESSION LOGIC - Must be at the top
// =============================================================================

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirect to step 1 if wizard not started
if (!isset($_SESSION['wizard'])) {
    header('Location: step1.php');
    exit;
}

// Handle answer submission
if (isset($_GET['answer'])) {
    $_SESSION['wizard']['answers']['activity_preference'] = $_GET['answer'];
    header('Location: step3.php');
    exit;
}

// Get current answer if going back
$currentAnswer = isset($_SESSION['wizard']['answers']['activity_preference'])
    ? $_SESSION['wizard']['answers']['activity_preference']
    : null;

// Check if step 1 was completed
$step1Completed = isset($_SESSION['wizard']['answers']['favorite_season']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Step 2 - Multi-Step Wizard</title>
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
        .question-box {
            background: #f9f9f9;
            padding: 2rem;
            border-radius: 8px;
            text-align: center;
            margin: 1rem 0;
        }
        .question-box h2 { margin-top: 0; }
        .answer-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin: 1.5rem 0;
        }
        .answer-btn {
            display: block;
            padding: 1.5rem;
            text-decoration: none;
            border-radius: 8px;
            border: 2px solid #ddd;
            background: white;
            color: #333;
            transition: all 0.2s;
        }
        .answer-btn:hover {
            border-color: #3498db;
            background: #e7f3ff;
        }
        .answer-btn.selected {
            border-color: #27ae60;
            background: #d4edda;
        }
        .answer-btn .emoji { font-size: 2rem; display: block; margin-bottom: 0.5rem; }
        @media (max-width: 500px) {
            .answer-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="back-link">
        <a href="../index.php">&larr; Back to Cookies &amp; Sessions</a>
        <a href="/exercises/03-php-cookies-sessions/05-wizard/step2.php">Go to Exercise &rarr;</a>
    </div>

    <h1>Multi-Step Wizard (Sessions)</h1>

    <!-- Progress Bar -->
    <div class="progress-bar">
        <div class="progress-step <?= $step1Completed ? 'completed' : '' ?>">Step 1</div>
        <div class="progress-step active">Step 2</div>
        <div class="progress-step">Step 3</div>
        <div class="progress-step">Results</div>
    </div>

    <!-- Question -->
    <div class="question-box">
        <h2>Question 2: How do you prefer to spend free time?</h2>
        <div class="answer-grid">
            <a href="?answer=outdoors" class="answer-btn <?= $currentAnswer === 'outdoors' ? 'selected' : '' ?>">
                <span class="emoji">🏕️</span>
                Outdoors / Adventure
            </a>
            <a href="?answer=social" class="answer-btn <?= $currentAnswer === 'social' ? 'selected' : '' ?>">
                <span class="emoji">👥</span>
                With Friends
            </a>
            <a href="?answer=creative" class="answer-btn <?= $currentAnswer === 'creative' ? 'selected' : '' ?>">
                <span class="emoji">🎨</span>
                Creative Activities
            </a>
            <a href="?answer=relaxing" class="answer-btn <?= $currentAnswer === 'relaxing' ? 'selected' : '' ?>">
                <span class="emoji">📚</span>
                Relaxing at Home
            </a>
        </div>
    </div>

    <p><a href="step1.php">&larr; Back to Step 1</a> | <a href="step1.php?restart=1">Start Over</a></p>

    <!-- Code Explanation -->
    <h2>How It Works</h2>

    <h3>Checking Previous Steps</h3>
    <p>If the wizard data doesn't exist in the session, redirect back to step 1.</p>
    <pre><code class="language-php">// Redirect to step 1 if wizard not started
if (!isset($_SESSION['wizard'])) {
    header('Location: step1.php');
    exit;
}

// Check if step 1 was completed
$step1Completed = isset($_SESSION['wizard']['answers']['favorite_season']);</code></pre>

    <h3>Adding to Existing Data</h3>
    <p>Each step adds its answer to the same session array. The data accumulates as the user progresses.</p>
    <pre><code class="language-php">// Step 1 stored: $_SESSION['wizard']['answers']['favorite_season']
// Step 2 adds:   $_SESSION['wizard']['answers']['activity_preference']

if (isset($_GET['answer'])) {
    $_SESSION['wizard']['answers']['activity_preference'] = $_GET['answer'];
    header('Location: step3.php');
    exit;
}</code></pre>

    <script src="/examples/js/prism-core.min.js"></script>
    <script src="/examples/js/prism-autoloader.min.js" data-autoloader-path="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/"></script>
</body>
</html>
