<?php
// =============================================================================
// EXERCISE: Multi-Step Wizard - Results Page
// =============================================================================
// Complete the TODO sections to display the quiz results.
// =============================================================================

// TODO Exercise 1: Start the session


// TODO Exercise 2: Redirect to step 1 if quiz not started or not complete
// Check if $_SESSION['food_quiz'] exists AND 'completed_at' is set
// If not, redirect to step1.php


// Get quiz data (this is provided, but depends on your session being set up correctly)
$answers = isset($_SESSION['food_quiz']['answers']) ? $_SESSION['food_quiz']['answers'] : [];
$startedAt = isset($_SESSION['food_quiz']['started_at']) ? $_SESSION['food_quiz']['started_at'] : 'N/A';
$completedAt = isset($_SESSION['food_quiz']['completed_at']) ? $_SESSION['food_quiz']['completed_at'] : 'N/A';

// Food recommendations based on answers (this is provided)
$recommendations = [
    'italian' => ['Pizza Margherita', 'Pasta Carbonara', 'Tiramisu'],
    'mexican' => ['Tacos al Pastor', 'Enchiladas', 'Churros'],
    'asian' => ['Pad Thai', 'Sushi', 'Dim Sum'],
    'american' => ['Burger', 'BBQ Ribs', 'Apple Pie'],
];

$cuisine = isset($answers['cuisine']) ? $answers['cuisine'] : 'italian';
$recommendation = isset($recommendations[$cuisine]) ? $recommendations[$cuisine] : $recommendations['italian'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results - Wizard Exercise</title>
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
        .results-box {
            background: #d4edda;
            padding: 2rem;
            border-radius: 8px;
            text-align: center;
            margin: 1rem 0;
        }
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
    </style>
</head>
<body>
    <div class="back-link">
        <a href="../index.php">&larr; Back to Cookies &amp; Sessions</a>
        <a href="/examples/03-php-cookies-sessions/05-wizard/results.php">View Example &rarr;</a>
    </div>

    <h1>Food Preferences Quiz - Results</h1>

    <!-- Progress Bar -->
    <div class="progress-bar">
        <div class="progress-step completed">Step 1</div>
        <div class="progress-step completed">Step 2</div>
        <div class="progress-step completed">Step 3</div>
        <div class="progress-step active">Results</div>
    </div>

    <!-- Exercise Instructions -->
    <h2>Exercise: Display Results</h2>
    <p>
        <strong>Task:</strong> Complete the session check at the top of this file
        to ensure the quiz was completed before showing results.
    </p>

    <!-- Results -->
    <div class="results-box">
        <h2>Your Food Recommendations</h2>
        <p>Based on your preference for <strong><?= ucfirst($cuisine) ?></strong> cuisine:</p>
        <ul style="list-style: none; padding: 0;">
            <?php foreach ($recommendation as $food): ?>
                <li style="padding: 0.5rem 0; font-size: 1.1rem;"><?= htmlspecialchars($food) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- Answers Summary -->
    <div class="answers-summary">
        <h3>Your Answers</h3>
        <ul>
            <li><strong>Favorite Cuisine:</strong> <?= ucfirst($answers['cuisine'] ?? 'Not answered') ?></li>
            <li><strong>Preferred Meal:</strong> <?= ucfirst($answers['meal_type'] ?? 'Not answered') ?></li>
            <li><strong>Spice Level:</strong> <?= ucfirst(str_replace('_', ' ', $answers['spice_level'] ?? 'Not answered')) ?></li>
        </ul>
        <p><small>Started: <?= $startedAt ?> | Completed: <?= $completedAt ?></small></p>
    </div>

    <p><a href="step1.php?restart=1">Take the Quiz Again</a></p>

    <!-- Debug -->
    <h2>Debug: Full Session Data</h2>
    <div class="output">
        <pre><?php
        if (isset($_SESSION['food_quiz'])) {
            print_r($_SESSION['food_quiz']);
        } else {
            echo "No quiz data found";
        }
        ?></pre>
    </div>

    <!-- Bonus Exercise -->
    <h2>Bonus Exercise</h2>
    <p>
        <strong>Task:</strong> Modify the results to also consider the spice level.
        For example, if someone likes Asian food and extra hot spice, recommend
        "Spicy Szechuan Noodles" instead of regular "Pad Thai".
    </p>

</body>
</html>
