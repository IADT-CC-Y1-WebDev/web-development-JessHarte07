<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Method Overriding Exercises - PHP Classes &amp; Objects</title>
    <link rel="stylesheet" href="/exercises/css/style.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to Classes &amp; Objects</a>
        <a href="/examples/02-php-classes-objects/05-method-overriding.php">View Example &rarr;</a>
    </div>

    <h1>Method Overriding Exercises</h1>

    <p><strong>Note:</strong> These exercises build on your <code>classes/Student.php</code> and <code>classes/Undergrad.php</code> files.</p>

    <!-- Exercise 1 -->
    <h2>Exercise 1: Override __toString() in Undergrad</h2>
    <p>
        <strong>Task:</strong>
        Add a <code>__toString()</code> method to your <code>Undergrad</code> class that
        returns a string like "Undergrad: [name] ([number]), [course], Year [year]".
    </p>
    <p>
        Create both a Student and an Undergrad, then echo both objects to see the
        different outputs from their respective <code>__toString()</code> methods.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        // require_once __DIR__ . '/classes/Undergrad.php';
        ?>
    </div>

    <!-- Exercise 2 -->
    <h2>Exercise 2: Create a Postgrad Class</h2>
    <p>
        <strong>Task:</strong>
        Create a new file called <code>Postgrad.php</code> in the <code>classes/</code> folder.
        This class should:
    </p>
    <ul>
        <li>Use <code>require_once</code> to include <code>Student.php</code></li>
        <li>Extend the <code>Student</code> class</li>
        <li>Add two protected properties: <code>$supervisor</code> and <code>$topic</code></li>
        <li>Have a constructor that accepts all four values and calls <code>parent::__construct()</code></li>
        <li>Have getter methods for supervisor and topic</li>
        <li>Override <code>__toString()</code> to return "Postgrad: [name] ([number]), Supervisor: [supervisor], Topic: [topic]"</li>
    </ul>
    <p>
        Create a Postgrad object and echo it to see the output from your overridden
        <code>__toString()</code> method.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        // require_once __DIR__ . '/classes/Postgrad.php';
        ?>
    </div>

    <!-- Exercise 3 -->
    <h2>Exercise 3: Polymorphism</h2>
    <p>
        <strong>Task:</strong>
        Create an array containing one Student, one Undergrad, and one Postgrad.
        Loop through the array and echo each object. Notice how each type displays
        differently despite being in the same array - this is polymorphism in action.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        // require_once __DIR__ . '/classes/Undergrad.php';
        // require_once __DIR__ . '/classes/Postgrad.php';
        ?>
    </div>

</body>
</html>
