<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encapsulation Exercises - PHP Classes &amp; Objects</title>
    <link rel="stylesheet" href="/exercises/css/style.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to Classes &amp; Objects</a>
        <a href="/examples/02-php-classes-objects/02-encapsulation.php">View Example &rarr;</a>
    </div>

    <h1>Encapsulation Exercises</h1>

    <p><strong>Note:</strong> These exercises build on your <code>classes/Student.php</code> file from the previous exercises. Modifying the class may affect earlier exercises.</p>

    <!-- Exercise 1 -->
    <h2>Exercise 1: Private Properties</h2>
    <p>
        <strong>Task:</strong>
        Modify your <code>Student</code> class in <code>classes/Student.php</code> so that
        <code>$name</code> and <code>$number</code> are <code>private</code> instead of
        <code>public</code>.
    </p>
    <p>
        Your getter methods from the previous exercise should still work. Test them below.
        Also try to access a private property directly (e.g., <code>$student->name</code>)
        and observe what happens. Comment out the error-causing line after testing.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        // require_once __DIR__ . '/classes/Student.php';
        ?>
    </div>

    <!-- Exercise 2 -->
    <h2>Exercise 2: Protected Properties</h2>
    <p>
        <strong>Task:</strong>
        Change the properties in your <code>Student</code> class from <code>private</code>
        to <code>protected</code>. This prepares the class for inheritance (which we'll
        cover in the next exercises).
    </p>
    <p>
        Create a student and display their information using the getter methods.
        The behaviour should be the same as with private properties.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        // require_once __DIR__ . '/classes/Student.php';
        ?>
    </div>

    <!-- Exercise 3 -->
    <h2>Exercise 3: Data Validation</h2>
    <p>
        <strong>Task:</strong>
        Modify the constructor in your <code>Student</code> class to validate that
        the student number is not empty. If it is empty, throw an <code>Exception</code>
        with a message like "Student number cannot be empty".
    </p>
    <p>
        Test this by trying to create a student with an empty number and catching
        the exception.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        // require_once __DIR__ . '/classes/Student.php';
        // try {
        //     $student = new Student("Alice", "");
        // } catch (Exception $e) {
        //     echo "Error: " . $e->getMessage();
        // }
        ?>
    </div>

</body>
</html>
