<?php
// =============================================================================
// EXERCISE: Multi-Step Wizard - Step 1
// =============================================================================
// Complete the TODO sections to create a multi-step food preferences quiz.
// =============================================================================

// TODO Exercise 1: Start the session


// TODO Exercise 2: Initialize wizard data
// If $_SESSION['food_quiz'] doesn't exist OR $_GET['restart'] is set:
// Create $_SESSION['food_quiz'] with:
// - 'answers' => [] (empty array)
// - 'started_at' => date('Y-m-d H:i:s')


// TODO Exercise 3: Handle answer submission
// When $_GET['answer'] is set:
// 1. Store the answer in $_SESSION['food_quiz']['answers']['cuisine']
// 2. Redirect to step2.php


// Get current answer if going back (this is provided)
$currentAnswer = isset($_SESSION['food_quiz']['answers']['cuisine'])
    ? $_SESSION['food_quiz']['answers']['cuisine']
    : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Step 1 - Wizard Exercise</title>
    <link rel="stylesheet" href="/exercises/css/style.css">
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
        }
        .answer-btn:hover {
            border-color: #3498db;
            background: #e7f3ff;
        }
        .answer-btn.selected {
            border-color: #27ae60;
            background: #d4edda;
        }
        @media (max-width: 500px) {
            .answer-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="back-link">
        <a href="../index.php">&larr; Back to Cookies &amp; Sessions</a>
        <a href="/examples/03-php-cookies-sessions/05-wizard/step1.php">View Example &rarr;</a>
    </div>

    <h1>Food Preferences Quiz - Exercise</h1>

    <!-- Progress Bar -->
    <div class="progress-bar">
        <div class="progress-step active">Step 1</div>
        <div class="progress-step">Step 2</div>
        <div class="progress-step">Step 3</div>
        <div class="progress-step">Results</div>
    </div>

    <!-- Exercise Instructions -->
    <h2>Exercise: Initialize and Store Answers</h2>
    <p>
        <strong>Tasks:</strong>
        <ol>
            <li>Start the session</li>
            <li>Initialize the quiz data structure in the session</li>
            <li>Handle the answer submission and redirect to step 2</li>
        </ol>
    </p>

    <!-- Question -->
    <div class="question-box">
        <h2>Question 1: What's your favorite cuisine?</h2>
        <div class="answer-grid">
            <a href="?answer=italian" class="answer-btn <?= $currentAnswer === 'italian' ? 'selected' : '' ?>">
                Italian
            </a>
            <a href="?answer=mexican" class="answer-btn <?= $currentAnswer === 'mexican' ? 'selected' : '' ?>">
                Mexican
            </a>
            <a href="?answer=asian" class="answer-btn <?= $currentAnswer === 'asian' ? 'selected' : '' ?>">
                Asian
            </a>
            <a href="?answer=american" class="answer-btn <?= $currentAnswer === 'american' ? 'selected' : '' ?>">
                American
            </a>
        </div>
    </div>

    <p><a href="?restart=1">Start Over</a></p>

    <!-- Debug -->
    <h2>Debug: Session Contents</h2>
    <div class="output">
        <pre><?php
        if (isset($_SESSION['food_quiz'])) {
            print_r($_SESSION['food_quiz']);
        } else {
            echo "Quiz not started";
        }
        ?></pre>
    </div>

</body>
</html>
