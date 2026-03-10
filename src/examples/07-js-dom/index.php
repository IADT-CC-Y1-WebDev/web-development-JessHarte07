<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>07 – JS DOM (Examples)</title>
    <link rel="stylesheet" href="/examples/css/style.css">
    <style>
        /* align button icon with text */
        .button-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.25em;
            padding: 0.25em 0.5em;
            border-radius: 0.5em;
            background-color: #cc00aa;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            cursor: pointer;
        }

        .button-primary svg {
            width: 1em;
            height: 1em;
        }
    </style>
</head>

<body>
    <div class="back-link">
        <a href="/index.php">&larr; Back to Module Index</a>
    </div>

    <h1>07 – JavaScript DOM (Examples)</h1>

    <p>View the slides and complete the exercises. Put your solutions in the <code>exercises/07-js-dom/</code> folder.</p>

    <h2>Slides</h2>
    <div class="slides-container">
        <!-- align button icon with text -->
        <a class="button-primary" target="_blank" href="https://webdev-dom.netlify.app/">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-notepad-text-icon lucide-notepad-text">
                <path d="M8 2v4" />
                <path d="M12 2v4" />
                <path d="M16 2v4" />
                <rect width="16" height="18" x="4" y="4" rx="2" />
                <path d="M8 10h6" />
                <path d="M8 14h8" />
                <path d="M8 18h5" />
            </svg>
            <span>The Document Object Model</span>
        </a>

    </div>
</body>

</html>