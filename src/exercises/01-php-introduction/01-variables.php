<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Variables Exercises - PHP Introduction</title>
    <link rel="stylesheet" href="/exercises/css/style.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to PHP Introduction</a>
        <a href="/examples/01-php-introduction/01-variables.php">View Example &rarr;</a>
    </div>

    <h1>Variables Exercises</h1>

    <!-- Exercise 1 -->
    <h2>Exercise 1: Personal Information</h2>
    <p>
        <strong>Task:</strong> 
        Create variables for your first name, last name, age, and city. 
        Then output a sentence using these variables that says "My name 
        is [first] [last], I am [age] years old and I live in [city]."
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here

    $firstname = "Jessie";
    $lastname = "Harte";
    $age = "18";
    $city = "Wicklow";

    echo "My name is $firstname $lastname, i am $age years old and i live in $city";

        ?>
    </div>

    <!-- Exercise 2 -->
    <h2>Exercise 2: Shopping Calculator</h2>
    <p>
        <strong>Task:</strong> 
        Create variables for three product prices and their quantities. 
        Calculate the subtotal for each product (price × quantity), then 
        calculate the total cost. Apply a 10% discount and display the 
        final price.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here

        $pro1 = 5.99;
        $pro2 = 1.99;
        $pro3 = 2.50;

        $quan1 = 2;
        $quan2 = 3;
        $quan3 = 5;

        $total1 = $pro1 * $quan1; 
        $total2 = $pro2 * $quan2; 
        $total3 = $pro3 * $quan3; 

        $totcost = $total1 + $total2 + $total3;
        $full = $totcost * 0.9;
echo $full
        ?>
    </div>

    <!-- Exercise 3 -->
    <h2>Exercise 3: User Status</h2>
    <p>
        <strong>Task:</strong> 
        Create boolean variables for isStudent, hasDiscount, and isPremiumMember. 
        Use the ternary operator to display "Yes" or "No" for each status.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here

        $isStudent = TRUE;
        $hasDiscount = FALSE;
        $isPremiumMember = TRUE;

        // if($isStudent){
        //     $studentVar = "Yes";
        // }

        // else{
        //     $studentVar = "no";
        // }
        $studentVar = ($isStudent) ? "Yes" : "No";

        if($hasDiscount){
            $discountVar = "Yes";
        }

        else{
            $discountVar = "no";
        }
        
        if($isPremiumMember){
            $premiumVar = "Yes";
        }

        else{
            $premiumVar = "no";
        }

        echo "is student a premium member? $premiumVar,<br/> " . 
            "Has the student got a disocunt? $discountVar,<br/> " . 
            "are they a student? " . (($isStudent) ? 'Yes' : 'No');

        ?>
    </div>

</body>
</html>
