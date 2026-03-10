<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>09-1 – Simple Contact Form Validation</title>
    <link rel="stylesheet" href="/examples/css/style.css">
    <style>
        form {
            margin-top: 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            max-width: 420px;
        }

        label {
            font-weight: 600;
        }

        input {
            font-size: 1rem;
            padding: 0.35rem 0.5rem;
        }

        .error {
            color: #b00020;
            font-size: 0.85rem;
            display: inline-block;
        }

        .input-error {
            border-color: #b00020;
            background: #fff5f5;
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

    <h1>09-1 – Comment Form Validation</h1>

    <p>
        This example validates a comment-style form in the browser before it is sent
        to the server. The same pattern will be used for the games and books forms.
    </p>

    <form id="comment_form" novalidate>
        <div id="error_summary_top" class="error-summary" style="display:none" role="alert"></div>

        <div class="form-group">
            Name:
            <input id="name" type="text" name="name">
            <span id="name_error" class="error"></span>
        </div>
        <div class="form-group">
            Category:
            <select id="category" name="category">
                <option value="">-- choose --</option>
                <option value="Sport">Sport</option>
                <option value="Music">Music</option>
                <option value="Movies">Movies</option>
            </select>
            <span id="category_error" class="error"></span>
        </div>
        <div class="form-group">
            Experience:
            <input type="radio" name="experience" value="Novice" id="experience_novice">
            <label for="experience_novice">Novice</label>
            <input type="radio" name="experience" value="Competent" id="experience_competent">
            <label for="experience_competent">Competent</label>
            <input type="radio" name="experience" value="Expert" id="experience_expert">
            <label for="experience_expert">Expert</label>
            <span id="experience_error" class="error"></span>
        </div>
        <div class="form-group">
            Languages:
            <input type="checkbox" id="lang_english" name="languages[]" value="English">
            <label for="lang_english">English</label>
            <input type="checkbox" id="lang_irish" name="languages[]" value="Irish">
            <label for="lang_irish">Irish</label>
            <input type="checkbox" id="lang_spanish" name="languages[]" value="Spanish">
            <label for="lang_spanish">Spanish</label>
            <span id="languages_error" class="error"></span>
        </div>
        <div class="form-group">
            <button id="submit_btn" type="submit">Submit</button>
        </div>
    </form>

    <script src="01-contact.js"></script>
</body>

</html>