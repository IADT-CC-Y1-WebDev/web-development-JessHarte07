<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>09-2 – Games Create Form Validation</title>
    <link rel="stylesheet" href="/examples/css/style.css">
    <style>
        form {
            margin-top: 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            max-width: 520px;
        }

        .input {
            display: flex;
            gap: 20px;
        }

        .input label.form-label {
            width: 108px;
            display: flex;
            justify-content: flex-end;
            color: #252525;
            font-weight: 900;
            flex-shrink: 0;
        }

        .input>div {
            flex: 1;
        }

        label {
            font-weight: 600;
        }

        input,
        select,
        textarea {
            font-size: 1rem;
            padding: 0.35rem 0.5rem;
        }

        textarea {
            min-height: 80px;
            width: 100%;
            box-sizing: border-box;
        }

        .input .platform-options label {
            font-weight: normal;
            margin-left: 0.25rem;
        }

        .error {
            color: #b00020;
            font-size: 0.85rem;
        }

        .input-error {
            border-color: #b00020;
            background: #fff5f5;
        }

        .error-summary {
            border-radius: 6px;
            border: 1px solid #b00020;
            background: #fff5f5;
            padding: 0.75rem 1rem;
            margin-bottom: 0.75rem;
        }

        #submit_btn {
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to 09 Overview</a>
        <a href="/index.php">Back to Module Index</a>
    </div>

    <h1>09-2 – Games-style Form Validation</h1>

    <p>
        This example mimics the structure of the games create/edit form and uses
        reusable validation helpers. We will apply the same pattern to the books
        project.
    </p>

    <?php
    $genres = [
        ['id' => 1, 'name' => 'Action'],
        ['id' => 2, 'name' => 'RPG'],
        ['id' => 3, 'name' => 'Sports'],
        ['id' => 4, 'name' => 'Puzzle'],
        ['id' => 5, 'name' => 'Simulation'],
    ];
    $platforms = [
        ['id' => 1, 'name' => 'PC'],
        ['id' => 2, 'name' => 'PS5'],
        ['id' => 3, 'name' => 'Xbox'],
    ];
    ?>
    <form id="game_form" novalidate>
        <div id="error_summary_top" class="error-summary" style="display:none" role="alert"></div>

        <div class="form-group">
            <label class="form-label" for="title">Title:</label>
            <div>
                <input type="text" id="title" name="title" data-minlength="3" data-maxlength="255">
                <span id="title_error" class="error"></span>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label" for="release_date">Release Year:</label>
            <div>
                <input type="date" id="release_date" name="release_date">
                <span id="release_date_error" class="error"></span>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label" for="genre_id">Genre:</label>
            <div>
                <select id="genre_id" name="genre_id">
                    <option value="">-- choose a genre --</option>
                    <?php foreach ($genres as $g): ?>
                        <option value="<?= (int) $g['id'] ?>"><?= htmlspecialchars($g['name']) ?></option>
                    <?php endforeach; ?>
                </select>
                <span id="genre_id_error" class="error"></span>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label" for="description">Description:</label>
            <div>
                <textarea id="description" name="description" data-minlength="10"></textarea>
                <span id="description_error" class="error"></span>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Platforms:</label>
            <div class="platform-options">
                <?php foreach ($platforms as $p): ?>
                    <div>
                        <input type="checkbox" id="platform_<?= (int) $p['id'] ?>" name="platform_ids[]" value="<?= (int) $p['id'] ?>">
                        <label for="platform_<?= (int) $p['id'] ?>"><?= htmlspecialchars($p['name']) ?></label>
                    </div>
                <?php endforeach; ?>
                <span id="platform_ids_error" class="error"></span>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label" for="image">Image (required):</label>
            <div>
                <input type="file" id="image" name="image" accept="image/*">
                <span id="image_error" class="error"></span>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label"></label>
            <div>
                <button id="submit_btn" type="submit">Store Game</button>
            </div>
        </div>
    </form>

    <script src="02-games-form.js"></script>
</body>

</html>