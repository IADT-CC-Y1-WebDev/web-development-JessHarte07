<?php
// =============================================================================
// EXERCISE: Multi-Step Wizard - Step 3
// =============================================================================
// Complete the TODO sections to finish the quiz.
// =============================================================================

// TODO Exercise 1: Start the session


// TODO Exercise 2: Redirect to step 1 if quiz not started


// TODO Exercise 3: Handle answer submission
// When $_GET['answer'] is set:
// 1. Store the answer in $_SESSION['food_quiz']['answers']['spice_level']
// 2. Also set $_SESSION['food_quiz']['completed_at'] to the current timestamp
// 3. Redirect to results.php


// Get current answer if going back (this is provided)
$currentAnswer = isset($_SESSION['food_quiz']['answers']['spice_level'])
    ? $_SESSION['food_quiz']['answers']['spice_level']
    : null;

// Check previous steps
$step1Completed = isset($_SESSION['food_quiz']['answers']['cuisine']);
$step2Completed = isset($_SESSION['food_quiz']['answers']['meal_type']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Step 3 - Wizard Exercise</title>
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
        <a href="/examples/03-php-cookies-sessions/05-wizard/step3.php">View Example &rarr;</a>
    </div>

    <h1>Food Preferences Quiz - Exercise</h1>

    <!-- Progress Bar -->
    <div class="progress-bar">
        <div class="progress-step <?= $step1Completed ? 'completed' : '' ?>">Step 1</div>
        <div class="progress-step <?= $step2Completed ? 'completed' : '' ?>">Step 2</div>
        <div class="progress-step active">Step 3</div>
        <div class="progress-step">Results</div>
    </div>

    <!-- Exercise Instructions -->
    <h2>Exercise: Final Step & Mark Complete</h2>
    <p>
        <strong>Tasks:</strong>
        <ol>
            <li>Store this step's answer</li>
            <li>Add a 'completed_at' timestamp to mark the quiz as done</li>
            <li>Redirect to results.php</li>
        </ol>
    </p>

    <!-- Question -->
    <div class="question-box">
        <h2>Question 3: How spicy do you like your food?</h2>
        <div class="answer-grid">
            <a href="?answer=mild" class="answer-btn <?= $currentAnswer === 'mild' ? 'selected' : '' ?>">
                Mild
            </a>
            <a href="?answer=medium" class="answer-btn <?= $currentAnswer === 'medium' ? 'selected' : '' ?>">
                Medium
            </a>
            <a href="?answer=hot" class="answer-btn <?= $currentAnswer === 'hot' ? 'selected' : '' ?>">
                Hot
            </a>
            <a href="?answer=extra_hot" class="answer-btn <?= $currentAnswer === 'extra_hot' ? 'selected' : '' ?>">
                Extra Hot!
            </a>
        </div>
    </div>

    <p><a href="step2.php">&larr; Back</a> | <a href="step1.php?restart=1">Start Over</a></p>

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
