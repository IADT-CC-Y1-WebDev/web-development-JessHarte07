<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autoloader Exercises - PHP Classes &amp; Objects</title>
    <link rel="stylesheet" href="/exercises/css/style.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to Classes &amp; Objects</a>
        <a href="/examples/02-php-classes-objects/08-autoloader.php">View Example &rarr;</a>
    </div>

    <h1>Autoloader Exercises</h1>

    <p><strong>Note:</strong> These exercises use your namespaced classes in <code>classes/College/</code> from the previous exercise.</p>

    <!-- Exercise 1 -->
    <h2>Exercise 1: Create an Autoloader</h2>
    <p>
        <strong>Task:</strong>
        Create an autoloader function using <code>spl_autoload_register()</code>.
        The function should:
    </p>
    <ol>
        <li>Receive the full class name (e.g., <code>College\Student</code>)</li>
        <li>Convert backslashes to directory separators</li>
        <li>Build the file path (e.g., <code>classes/College/Student.php</code>)</li>
        <li>If the file exists, require it</li>
    </ol>
    <p>
        Test it by creating a <code>College\Student</code> without any require statements
        (other than the autoloader itself).
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        // spl_autoload_register(function ($class) {
        //     $path = str_replace('\\', DIRECTORY_SEPARATOR, $class);
        //     $file = __DIR__ . '/classes/' . $path . '.php';
        //     if (file_exists($file)) {
        //         require_once $file;
        //     }
        // });
        // use College\Student;
        // $student = new Student("Alice", "C12345");
        // echo $student;
        ?>
    </div>

    <!-- Exercise 2 -->
    <h2>Exercise 2: Using the Config File</h2>
    <p>
        <strong>Task:</strong>
        Instead of defining the autoloader inline, use <code>require_once</code>
        to include <code>etc/config.php</code> which contains the autoloader.
        Then create Student, Undergrad, and Postgrad objects without any other
        require statements.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        // require_once __DIR__ . '/etc/config.php';
        // use College\Student;
        // use College\Undergrad;
        // use College\Postgrad;
        ?>
    </div>

    <!-- Exercise 3 -->
    <h2>Exercise 3: Full Application</h2>
    <p>
        <strong>Task:</strong>
        Using the autoloader, create a complete example:
    </p>
    <ul>
        <li>Create several students of different types (Student, Undergrad, Postgrad)</li>
        <li>Use the static <code>Student::findAll()</code> method to retrieve all students</li>
        <li>Use <code>Student::findByNumber()</code> to find a specific student</li>
        <li>Display the results</li>
    </ul>
    <p>
        This demonstrates how a real application would use these classes with
        autoloading - no manual require statements needed!
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        ?>
    </div>

</body>
</html>
