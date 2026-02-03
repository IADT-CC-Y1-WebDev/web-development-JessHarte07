<?php
// =============================================================================
// SESSION LOGIC - Must be at the top
// =============================================================================

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Initialize wizard data if starting fresh
if (!isset($_SESSION['wizard']) || isset($_GET['restart'])) {
    $_SESSION['wizard'] = [
        'answers' => [],
        'started_at' => date('Y-m-d H:i:s')
    ];
}

// Handle answer submission
if (isset($_GET['answer'])) {
    $_SESSION['wizard']['answers']['favorite_season'] = $_GET['answer'];
    header('Location: step2.php');
    exit;
}

// Get current answer if going back
$currentAnswer = isset($_SESSION['wizard']['answers']['favorite_season'])
    ? $_SESSION['wizard']['answers']['favorite_season']
    : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Step 1 - Multi-Step Wizard</title>
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
        <a href="/exercises/03-php-cookies-sessions/05-wizard/step1.php">Go to Exercise &rarr;</a>
    </div>

    <h1>Multi-Step Wizard (Sessions)</h1>

    <p>This example shows how sessions accumulate data across multiple pages.
    Answer three questions and see your results at the end!</p>

    <!-- Progress Bar -->
    <div class="progress-bar">
        <div class="progress-step active">Step 1</div>
        <div class="progress-step">Step 2</div>
        <div class="progress-step">Step 3</div>
        <div class="progress-step">Results</div>
    </div>

    <!-- Question -->
    <div class="question-box">
        <h2>Question 1: What's your favorite season?</h2>
        <div class="answer-grid">
            <a href="?answer=spring" class="answer-btn <?= $currentAnswer === 'spring' ? 'selected' : '' ?>">
                <span class="emoji">🌸</span>
                Spring
            </a>
            <a href="?answer=summer" class="answer-btn <?= $currentAnswer === 'summer' ? 'selected' : '' ?>">
                <span class="emoji">☀️</span>
                Summer
            </a>
            <a href="?answer=autumn" class="answer-btn <?= $currentAnswer === 'autumn' ? 'selected' : '' ?>">
                <span class="emoji">🍂</span>
                Autumn
            </a>
            <a href="?answer=winter" class="answer-btn <?= $currentAnswer === 'winter' ? 'selected' : '' ?>">
                <span class="emoji">❄️</span>
                Winter
            </a>
        </div>
    </div>

    <p><a href="?restart=1">Start Over</a></p>

    <!-- Code Explanation -->
    <h2>How It Works</h2>

    <h3>Initializing the Wizard</h3>
    <p>When the wizard starts, we create a structure in the session to hold all answers.</p>
    <pre><code class="language-php">// Initialize wizard data if starting fresh
if (!isset($_SESSION['wizard']) || isset($_GET['restart'])) {
    $_SESSION['wizard'] = [
        'answers' => [],
        'started_at' => date('Y-m-d H:i:s')
    ];
}</code></pre>

    <h3>Storing the Answer</h3>
    <p>When the user clicks an answer, we store it in the session and redirect to the next step.</p>
    <pre><code class="language-php">// Handle answer submission via URL: ?answer=spring
if (isset($_GET['answer'])) {
    $_SESSION['wizard']['answers']['favorite_season'] = $_GET['answer'];
    header('Location: step2.php');
    exit;
}</code></pre>

    <script src="/examples/js/prism-core.min.js"></script>
    <script src="/examples/js/prism-autoloader.min.js" data-autoloader-path="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/"></script>
</body>
</html>
