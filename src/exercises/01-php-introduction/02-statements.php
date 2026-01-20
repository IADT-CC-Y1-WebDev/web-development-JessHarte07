<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statements Exercises - PHP Introduction</title>
    <link rel="stylesheet" href="/exercises/css/style.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to PHP Introduction</a>
        <a href="/examples/01-php-introduction/02-statements.php">View Example &rarr;</a>
    </div>

    <h1>Statements Exercises</h1>

    <!-- Exercise 1 -->
    <h2>Exercise 1: Age Classifier</h2>
    <p>
        <strong>Task:</strong> 
        Create a variable for age. Use if/else statements to classify and 
        display the age group: "Child" (0-12), "Teenager" (13-19), "Adult" 
        (20-64), or "Senior" (65+).
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here

        $age = 30;

        if ($age < 13){
            echo "$age is a child";
        }

        if ($age < 20){
            echo "$age is a teenagers";
        }

        if ($age < 65){
            echo "$age is a adult";
        }

        else{
            echo "$age is a senior";
        }

        ?>
    </div>

    <!-- Exercise 2 -->
    <h2>Exercise 2: Day of the Week</h2>
    <p>
        <strong>Task:</strong> 
        Create a variable for the day of the week (use a number 1-7). Use 
        a switch statement to display whether it's a "Weekday" or "Weekend", 
        and the day name.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here

        $Weekday =1;

        if($Weekday = 1){
            $day = "Monday ";
            $week = "weekday";
        }

        if($Weekday = 2){
            $day = "Tuseday ";
            $week = "weekday";
        }
        
        if($Weekday = 3){
            $day = "Wednesday ";
            $week = "weekday";
        }

        if($Weekday = 4){
            $day = "Thursday ";
            $week = "weekday";
        }

        if($Weekday = 5){
            $day = "Friday ";
            $week = "weekday";
        }

        if($Weekday = 6){
            $day = "Saturday ";
            $week = "weekend";
        }

        if($Weekday = 1){
            $day = "Sunday ";
            $week = "weekend";
        }

        Echo $day, $week
        ?>
    </div>

    <!-- Exercise 3 -->
    <h2>Exercise 3: Multiplication Table</h2>
    <p>
        <strong>Task:</strong> 
        Use a for loop to create a multiplication table for a number of your 
        choice (1 through 10). Display each line in the format "X × Y = Z".
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here

        
        $multiply = 7;
        

        // while ($multiply <=10 ) {
        //     $result= $multiply * $number;
        //     echo "7 x $multiply = $result <br/>";
        //     $multiply = $multiply + 1;
        // }

        for ($i = 0; $i <= 10; $i++){
        
            $result = $multiply *$i;
            echo "$multiply x $i = $result <br/>";
        }

        ?>
    </div>

    <!-- Exercise 4 -->
    <h2>Exercise 4: Countdown Timer</h2>
    <p>
        <strong>Task:</strong> 
        Create a countdown from 10 to 0 using a while loop. Display each number, 
        and when you reach 0, display "Blast off!"
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here

        $time = 10;

        while ($time >= 0){
            if($time > 0) {
                echo "$time<br/>";
            }
            else {
                echo "Blast off!";
            }
            $time = $time - 1;
        }
        ?>
    </div>

</body>
</html>
