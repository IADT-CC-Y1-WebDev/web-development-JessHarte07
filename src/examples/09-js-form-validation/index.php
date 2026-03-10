<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>09 – JS Form Validation (Examples)</title>
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

    <h1>09 – JavaScript Form Validation (Examples)</h1>



    <h2>Introduction</h2>
    <ul>
        <li>The techniques in the previous slides can be used to validate forms</li>
        <li>Validating forms on the client, i.e, the Web Browser, is known as <span style="color:#dc2626">Client-Side Form Validation</span></li>
        <li>The PHP form validation you have previously applied to your forms is known as <span style="color:#dc2626">Server-Side Form Validation</span></li>
        <li>Client-side form validation is usually combined with Server-Side Form validation which was covered in the earlier in this module</li>
        <li>Client-side and Server-side validation have different purposes, but the validation techniques are very similar</li>
    </ul>

    <h2>Client-Side Form Validation</h2>

    <ul>
        <li>Client-Side Form Validation is not used as a security precaution</li>
        <li>It is used to give better feedback to our users while they fill in our forms</li>
        <li>JavaScript code runs in the browser, this means we can give the user feedback as they fill in the form</li>
        <li>This is a much quicker response than server-side validation</li>
        <li>It provides a better user experience to our users, for example,  if a user enters an invalid email address and move to the next field, you can show an error message immediately. That way the user can correct every field before they submit the form.</li>
        <li>With Server-Side validation:</li>
        <ul>
            <li>the form would need to be submitted</li>
            <li>and the form data must be sent to the server</li>
            <li>the server then validates the data and if a field is invalid</li>
            <li>the server would send a response back to the client</li>
            <li>the client then displays the error to the user</li>
        </ul>
    </ul>
    <p>
        The following examples show how to validate forms in the browser before they are
        submitted to the server. Client-side JS improves the user experience, but the
        server-side validation (PHP) is still required.
    </p>

    <ul class="example-list">
        <li><a href="01-contact.php">Example 09-1: Comment form validation</a></li>
        <li><a href="02-games-form.php">Example 09-2: Games form validation</a></li>
    </ul>

    <h2>Slides</h2>
    <div class="slides-container">
        <!-- align button icon with text -->
        <a class="button-primary" target="_blank" href="https://iadt.sharepoint.com/:f:/s/DL836Y1WebDevelopment_67f7a537-8764-11f0-9114-3f2c36e1fb53/IgD7W6ncrrBJSbzWMBomnEvBAVrVy--Go-kZkyglayk96Lg?e=M7vlhA">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-notepad-text-icon lucide-notepad-text">
                <path d="M8 2v4" />
                <path d="M12 2v4" />
                <path d="M16 2v4" />
                <rect width="16" height="18" x="4" y="4" rx="2" />
                <path d="M8 10h6" />
                <path d="M8 14h8" />
                <path d="M8 18h5" />
            </svg>
            <span>0 - JavaScript</span>
        </a>

    </div>
</body>

</html>