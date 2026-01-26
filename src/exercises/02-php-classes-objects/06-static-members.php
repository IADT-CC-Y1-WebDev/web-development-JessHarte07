<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Static Members Exercises - PHP Classes &amp; Objects</title>
    <link rel="stylesheet" href="/exercises/css/style.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to Classes &amp; Objects</a>
        <a href="/examples/02-php-classes-objects/06-static-members.php">View Example &rarr;</a>
    </div>

    <h1>Static Members Exercises</h1>

    <p><strong>Note:</strong> These exercises modify your <code>classes/Student.php</code> file to add static members. This may affect earlier exercises.</p>

    <!-- Exercise 1 -->
    <h2>Exercise 1: Static Counter</h2>
    <p>
        <strong>Task:</strong>
        Modify your <code>Student</code> class in <code>classes/Student.php</code> to add:
    </p>
    <ul>
        <li>A private static property <code>$count</code> initialised to 0</li>
        <li>In the constructor, increment <code>self::$count</code></li>
        <li>A public static method <code>getCount()</code> that returns the count</li>
    </ul>
    <p>
        Create three students and display the count after each creation using
        <code>Student::getCount()</code>.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        // require_once __DIR__ . '/classes/Student.php';
        ?>
    </div>

    <!-- Exercise 2 -->
    <h2>Exercise 2: Student Registry</h2>
    <p>
        <strong>Task:</strong>
        Add the following to your <code>Student</code> class:
    </p>
    <ul>
        <li>A private static array <code>$students</code> initialised to an empty array</li>
        <li>In the constructor, add the current student to <code>self::$students</code> using the student number as the key</li>
        <li>A public static method <code>findAll()</code> that returns the <code>$students</code> array</li>
        <li>A public static method <code>findByNumber($num)</code> that returns the student with that number, or null if not found</li>
    </ul>
    <p>
        In Exercise 1, the static <code>$counter</code> property was added to keep a count the number of students. This property is now redundant because
        we can simply use <code>count(Student::findAll())</code> to get the number of students. Modify your <code>Student</code> class as follows:
    </p>
    <ul>
        <li>Remove the static <code>$count</code> property</li>
        <li>Remove the increment of <code>self::$count</code> from the constructor</li>
        <li>rewrite <code>getCount()</code> to return the count of students using <code>count(self::$students)</code>.
    </ul>
    <p>
        Create three students and then use <code>Student::findAll()</code> to display
        all students. Use <code>Student::findByNumber()</code> to find a specific
        student by their number and display that student.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        // require_once __DIR__ . '/classes/Student.php';
        ?>
    </div>

    <!-- Exercise 3 -->
    <h2>Exercise 3: Registry with Child Classes</h2>
    <p>
        <strong>Task:</strong>
        Create a mix of Student, Undergrad, and Postgrad objects. Then use
        <code>Student::findAll()</code> to retrieve all students and display them.
        Use <code>Student::findByNumber()</code> to find a specific student by their number.
    </p>
    <p>
        Notice how all child class instances are also registered in the parent's
        static array because they all call <code>parent::__construct()</code>.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        // require_once __DIR__ . '/classes/Undergrad.php';
        // require_once __DIR__ . '/classes/Postgrad.php';
        ?>
    </div>

    <!-- Exercise 4 -->
    <h2>Exercise 4: Removing from Registry</h2>
    <p>
        <strong>Task:</strong>
        Add the following to your <code>Student</code> class:
    </p>
    <ul>
        <li>A <code>leave()</code> method that removes the student from the static <code>$students</code> array using <code>unset(self::$students[$this->number])</code></li>
        <li>A <code>__destruct()</code> method that prints "Student [name] has been destroyed"</li>
    </ul>
    <p>
        Create three students, display the count, then call <code>leave()</code> and <code>unset()</code>
        on one student. Display the count again to confirm they were removed.
    </p>
    <p>
        <strong>Why both methods?</strong> The static array holds a reference to each object.
        PHP only calls <code>__destruct()</code> when <em>all</em> references are gone, so we must
        call <code>leave()</code> first to remove from the array, then <code>unset()</code> to
        trigger <code>__destruct()</code>.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        // require_once __DIR__ . '/classes/Student.php';
        ?>
    </div>

</body>
</html>
