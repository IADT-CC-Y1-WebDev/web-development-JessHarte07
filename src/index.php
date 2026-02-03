<?php
$topics = [
    'php' => [
        'title' => 'PHP',
        'items' => [
            '01-php-introduction' => 'Introduction',
            '02-php-classes-objects' => 'Classes and Objects',
            '03-php-cookies-sessions' => 'Cookies and Sessions',
            '04-php-forms' => 'Forms',
            '05-php-database' => 'Database Access',
        ]
    ],
    'js' => [
        'title' => 'JavaScript',
        'items' => [
            '06-js-classes-objects' => 'Classes and Objects',
            '07-js-dom' => 'The Document Object Model',
            '08-js-events' => 'Event Handling',
            '09-js-form-validation' => 'Form Validation',
        ]
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Development Module</title>
    <link rel="stylesheet" href="/examples/css/style.css">
</head>
<body>
    <h1>Web Development Module</h1>

    <div class="nav-links">
        <a href="db-test.php">Database Test</a>
        <a href="phpinfo.php">PHP Info</a>
    </div>

    <?php foreach ($topics as $section): ?>
        <h2><?= htmlspecialchars($section['title']) ?></h2>

        <?php foreach ($section['items'] as $folder => $name): ?>
            <div class="topic">
                <h3><?= htmlspecialchars($name) ?></h3>
                <div class="links">
                    <a href="examples/<?= $folder ?>/">Examples</a>
                    <a href="exercises/<?= $folder ?>/">Exercises</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endforeach; ?>

    <h2>Capstone Project</h2>
    <div class="topic capstone">
        <p>
            The capstone project brings together everything you've learned in this module.
            You will build a complete CRUD application for managing books, following the
            structure and patterns demonstrated in the Games example.
        </p>
        <p>The project is divided into two phases:</p>
        <ul>
            <li>
                <strong>Phase 1 (after PHP exercises):</strong> Build the PHP application 
                with database connectivity, Active Record classes, and all CRUD operations.
            </li>
            <li>
                <strong>Phase 2 (after JS exercises):</strong> Enhance your application with
                JavaScript for improved user experience.
            </li>
        </ul>
        <p>
            The <a href="project/games/">games application</a> demonstrating the required 
            structure and functionality.
        </p>
        <p>
            You are required to build a CRUD application for books following the Games example. 
            Detailed instructions are available <a href="project/books/instructions.php">here</a> 
            and in the README.md file.
        </p>
        <div class="links">
            <a href="project/books/">Your Project Folder</a>
        </div>
    </div>
</body>
</html>