<?php
$games = [
    ['title' => 'Elden Ring', 'genre' => 'RPG'],
    ['title' => 'FIFA 23', 'genre' => 'Sports'],
    ['title' => 'Portal 2', 'genre' => 'Puzzle'],
    ['title' => 'Cities: Skylines II', 'genre' => 'Simulation'],
    ['title' => 'The Witcher 3: Wild Hunt', 'genre' => 'RPG'],
    ['title' => 'The Last of Us Part II', 'genre' => 'Action'],
    ['title' => 'The Legend of Zelda: Breath of the Wild', 'genre' => 'Action-Adventure'],
    ['title' => 'The Elder Scrolls V: Skyrim', 'genre' => 'RPG'],
    ['title' => 'The Sims 4', 'genre' => 'Simulation'],
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>08-3 – Event Delegation on Cards</title>
    <link rel="stylesheet" href="/examples/css/style.css">
    <style>
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }

        .card {
            padding: 1rem;
            border-radius: 8px;
            border: 1px solid #ccc;
            background: #f5f5f5;
        }

        .card.selected {
            border-color: #0066cc;
            box-shadow: 0 0 0 2px rgba(0, 102, 204, 0.2);
        }

        .card-actions {
            margin-top: 0.5rem;
            display: flex;
            gap: 0.5rem;
            font-size: 0.85rem;
        }

        .card-actions button {
            font-size: 0.85rem;
        }
    </style>
</head>

<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to 08 Overview</a>
        <a href="/index.php">Back to Module Index</a>
    </div>

    <h1>08-3 – Event Delegation on Cards (Optional)</h1>

    <p>
        Instead of attaching a separate click listener to every button,
        we attach <strong>one listener</strong> to the cards container and
        use <code>event.target</code> and <code>closest('.card')</code> to
        figure out what was clicked.
    </p>

    <div id="cards" class="cards">
        <?php foreach ($games as $game): ?>
            <div class="card" data-title="<?= htmlspecialchars($game['title']) ?>">
                <h3><?= htmlspecialchars($game['title']) ?></h3>
                <p><?= htmlspecialchars($game['genre']) ?></p>
                <div class="card-actions">
                    <button type="button" data-action="select">Select</button>
                    <button type="button" data-action="log">Log title</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <script src="03-delegation.js"></script>
</body>

</html>