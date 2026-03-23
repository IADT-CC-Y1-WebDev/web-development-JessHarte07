<?php
$games = [
    ['title' => 'Elden Ring', 'genre' => 'RPG', 'platform' => 'PC', 'year' => 2022],
    ['title' => 'FIFA 23', 'genre' => 'Sports', 'platform' => 'PS5', 'year' => 2022],
    ['title' => 'Portal 2', 'genre' => 'Puzzle', 'platform' => 'PC', 'year' => 2011],
    ['title' => 'Cities: Skylines II', 'genre' => 'Simulation', 'platform' => 'PC', 'year' => 2023],
    ['title' => 'The Witcher 3: Wild Hunt', 'genre' => 'RPG', 'platform' => 'PC', 'year' => 2015],
    ['title' => 'The Last of Us Part II', 'genre' => 'Action', 'platform' => 'PS5', 'year' => 2020],
    ['title' => 'The Legend of Zelda: Breath of the Wild', 'genre' => 'Action-Adventure', 'platform' => 'Nintendo Switch', 'year' => 2017],
    ['title' => 'The Elder Scrolls V: Skyrim', 'genre' => 'RPG', 'platform' => 'PC', 'year' => 2011],
    ['title' => 'The Sims 4', 'genre' => 'Simulation', 'platform' => 'PC', 'year' => 2014],
];
$genres = ['RPG', 'Sports', 'Puzzle', 'Simulation', 'Action', 'Action-Adventure'];
$platforms = ['PC', 'PS5', 'Xbox', 'Nintendo Switch'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>08-2 – Games-style Filters with Events</title>
    <link rel="stylesheet" href="/examples/css/style.css">
    <style>
        .filters {
            padding: 0.75rem 1rem;
            border-radius: 6px;
            border: 1px solid #ccc;
            background: #f5f5f5;
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            align-items: center;
        }

        .filters .input {
            display: flex;
            gap: 20px;
        }

        .filters .input label.filter-label {
            width: 108px;
            display: flex;
            justify-content: flex-end;
            color: #252525;
            font-weight: 900;
            font-size: 0.9rem;
        }

        .filters input,
        .filters select,
        .filters button {
            font-size: 0.9rem;
        }

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

        .card.hidden {
            display: none;
        }

        .card h3 {
            margin-top: 0;
            margin-bottom: 0.25rem;
        }
    </style>
</head>

<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to 08 Overview</a>
        <a href="/index.php">Back to Module Index</a>
    </div>

    <h1>08-2 – Games filters with events</h1>

    <p>
        This example is a simplified version of the filters you will add to the games
        and books applications. PHP renders the filter controls and cards;
        JavaScript listens for button clicks and applies the filters.
    </p>

    <form id="filters" class="filters">
        <div class="input">
            <label class="filter-label" for="title_filter">Title:</label>
            <div>
                <input type="text" id="title_filter" name="title_filter" placeholder="Part of a title">
            </div>
        </div>
        <div class="input">
            <label class="filter-label" for="genre_filter">Genre:</label>
            <div>
                <select id="genre_filter" name="genre_filter">
                    <option value="">All Genres</option>
                    <?php foreach ($genres as $genre): ?>
                        <option value="<?= htmlspecialchars($genre) ?>">
                            <?= htmlspecialchars($genre) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="input">
            <label class="filter-label" for="platform_filter">Platform:</label>
            <div>
                <select id="platform_filter" name="platform_filter">
                    <option value="">All Platforms</option>
                    <?php foreach ($platforms as $platform): ?>
                        <option value="<?= htmlspecialchars($platform) ?>">
                            <?= htmlspecialchars($platform) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="input">
            <label class="filter-label" for="sort_by">Sort:</label>
            <div>
                <select id="sort_by" name="sort_by">
                    <option value="title_asc">Title A–Z</option>
                    <option value="year_desc">Year (newest first)</option>
                    <option value="year_asc">Year (oldest first)</option>
                </select>
            </div>
        </div>
        <div class="input">
            <label class="filter-label" for="apply_filters">Actions</label>
            <div>
                <button type="button" id="apply_filters">Apply Filters</button>
                <button type="button" id="clear_filters">Clear Filters</button>
            </div>
        </div>
    </form>

    <div id="game_cards" class="cards">
        <?php foreach ($games as $game): ?>
            <div class="card"
                data-title="<?= htmlspecialchars($game['title']) ?>"
                data-genre="<?= htmlspecialchars($game['genre']) ?>"
                data-platform="<?= htmlspecialchars($game['platform']) ?>"
                data-year="<?= $game['year'] ?>">
                <h3><?= htmlspecialchars($game['title']) ?></h3>
                <p><?= htmlspecialchars($game['genre']) ?> · <?= htmlspecialchars($game['platform']) ?> (<?= (int) $game['year'] ?>)</p>
            </div>
        <?php endforeach; ?>
    </div>

    <script src="02-games-filters.js"></script>
</body>

</html>