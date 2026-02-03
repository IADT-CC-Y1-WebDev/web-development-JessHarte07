<?php
// =============================================================================
// EXERCISE: Multi-Step Wizard - Step 2
// =============================================================================
// Complete the TODO sections to continue the quiz.
// =============================================================================

// TODO Exercise 1: Start the session


// TODO Exercise 2: Redirect to step 1 if quiz not started
// If $_SESSION['food_quiz'] is not set, redirect to step1.php


// TODO Exercise 3: Handle answer submission
// When $_GET['answer'] is set:
// 1. Store the answer in $_SESSION['food_quiz']['answers']['meal_type']
// 2. Redirect to step3.php


// Get current answer if going back (this is provided)
$currentAnswer = isset($_SESSION['food_quiz']['answers']['meal_type'])
    ? $_SESSION['food_quiz']['answers']['meal_type']
    : null;

// Check if step 1 was completed
$step1Completed = isset($_SESSION['food_quiz']['answers']['cuisine']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Step 2 - Wizard Exercise</title>
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
        <a href="/examples/03-php-cookies-sessions/05-wizard/step2.php">View Example &rarr;</a>
    </div>

    <h1>Food Preferences Quiz - Exercise</h1>

    <!-- Progress Bar -->
    <div class="progress-bar">
        <div class="progress-step <?= $step1Completed ? 'completed' : '' ?>">Step 1</div>
        <div class="progress-step active">Step 2</div>
        <div class="progress-step">Step 3</div>
        <div class="progress-step">Results</div>
    </div>

    <!-- Exercise Instructions -->
    <h2>Exercise: Check Previous Step & Store Answer</h2>
    <p>
        <strong>Tasks:</strong>
        <ol>
            <li>Redirect to step 1 if the quiz hasn't been started</li>
            <li>Store this step's answer and redirect to step 3</li>
        </ol>
    </p>

    <!-- Question -->
    <div class="question-box">
        <h2>Question 2: What's your preferred meal type?</h2>
        <div class="answer-grid">
            <a href="?answer=breakfast" class="answer-btn <?= $currentAnswer === 'breakfast' ? 'selected' : '' ?>">
                Breakfast
            </a>
            <a href="?answer=lunch" class="answer-btn <?= $currentAnswer === 'lunch' ? 'selected' : '' ?>">
                Lunch
            </a>
            <a href="?answer=dinner" class="answer-btn <?= $currentAnswer === 'dinner' ? 'selected' : '' ?>">
                Dinner
            </a>
            <a href="?answer=snacks" class="answer-btn <?= $currentAnswer === 'snacks' ? 'selected' : '' ?>">
                Snacks
            </a>
        </div>
    </div>

    <p><a href="step1.php">&larr; Back</a> | <a href="step1.php?restart=1">Start Over</a></p>

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
