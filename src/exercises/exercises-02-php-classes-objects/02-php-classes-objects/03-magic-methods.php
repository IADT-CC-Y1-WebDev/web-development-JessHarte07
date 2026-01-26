<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magic Methods Exercises - PHP Classes &amp; Objects</title>
    <link rel="stylesheet" href="/exercises/css/style.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to Classes &amp; Objects</a>
        <a href="/examples/02-php-classes-objects/03-magic-methods.php">View Example &rarr;</a>
    </div>

    <h1>Magic Methods Exercises</h1>

    <p><strong>Note:</strong> These exercises build on your <code>classes/Student.php</code> file from the previous exercises.</p>

    <!-- Exercise 1 -->
    <h2>Exercise 1: Observe the Constructor</h2>
    <p>
        <strong>Task:</strong>
        Your <code>Student</code> class should already have a <code>__construct()</code> method.
        Modify it to also print "Creating student: [name]" when a new student is created.
    </p>
    <p>
        Then create two students and observe the output. The messages should appear
        automatically when the objects are created.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        // require_once __DIR__ . '/classes/Student.php';
        ?>
    </div>

    <!-- Exercise 2 -->
    <h2>Exercise 2: Add __toString()</h2>
    <p>
        <strong>Task:</strong>
        Add a <code>__toString()</code> method to your Student class that returns
        a formatted string like "Student: [name] ([number])".
    </p>
    <p>
        Create a student and echo the object directly. PHP will automatically call
        your <code>__toString()</code> method.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        // require_once __DIR__ . '/classes/Student.php';
        ?>
    </div>

    <!-- Exercise 3 -->
    <h2>Exercise 3: Using __toString() with Multiple Students</h2>
    <p>
        <strong>Task:</strong>
        Create an array of three students. Loop through the array and echo each
        student directly (which will use the <code>__toString()</code> method).
        Add a <code>&lt;br&gt;</code> tag after each student for readability.
    </p>
    <p>
        <strong>Tip:</strong> You may want to remove or comment out the "Creating student"
        message from the constructor to keep the output clean.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        // require_once __DIR__ . '/classes/Student.php';
        ?>
    </div>

    <!-- Exercise 4 -->
    <h2>Exercise 4: Add __destruct()</h2>
    <p>
        <strong>Task:</strong>
        Add a <code>__destruct()</code> method to your Student class that prints
        "Student [name] has left the system" when the object is destroyed.
    </p>
    <p>
        Create two students, then set one of them to <code>null</code>. Observe when
        the destructor messages appear. Notice that the second student's destructor
        is called automatically when the script ends.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        // require_once __DIR__ . '/classes/Student.php';
        // $student1 = new Student("Alice", "S001");
        // $student2 = new Student("Bob", "S002");
        // echo "Setting student1 to null...<br>";
        // $student1 = null;
        // echo "Script ending...<br>";
        ?>
    </div>

</body>
</html>
