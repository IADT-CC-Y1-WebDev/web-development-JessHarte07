<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>08-1 – Basic Event Listeners</title>
    <link rel="stylesheet" href="/examples/css/style.css">
    <style>
        #box {
            width: 120px;
            height: 120px;
            background: #e8f4e8;
            border: 1px solid #4a4;
            border-radius: 8px;
            margin-top: 1rem;
        }
        #box.hidden {
            display: none;
        }
        #preview {
            padding: 0.5rem;
            border-radius: 4px;
            border: 1px solid #ccc;
            margin-top: 0.5rem;
            min-height: 1.5rem;
        }
        #preview.empty {
            color: #888;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to 08 Overview</a>
        <a href="/index.php">Back to Module Index</a>
    </div>

    <h1>08-1 – Basic Event Listeners</h1>

    <p>
        This page introduces event listeners for <strong>click</strong> and <strong>input</strong> events.
        PHP renders the elements, and JavaScript attaches behaviour using <code>addEventListener</code>.
    </p>

    <button id="toggle_box_btn">Toggle Box</button>

    <div id="box"></div>

    <h2>Live Preview</h2>

    <label for="preview_input">Type something:</label>
    <input type="text" id="preview_input" placeholder="Your text here">

    <div id="preview" class="empty">(nothing yet)</div>

    <script src="01-basic-events.js"></script>
</body>
</html>

