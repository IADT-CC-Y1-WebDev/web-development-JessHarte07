<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Functions Exercises - PHP Introduction</title>
    <link rel="stylesheet" href="/exercises/css/style.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to PHP Introduction</a>
        <a href="/examples/01-php-introduction/05-functions.php">View Example &rarr;</a>
    </div>

    <h1>Functions Exercises</h1>

    <!-- Exercise 1 -->
    <h2>Exercise 1: Temperature Converter</h2>
    <p>
        <strong>Task:</strong> 
        Create a function called celsiusToFahrenheit() that takes a Celsius temperature as a parameter and returns the Fahrenheit equivalent. Formula: F = (C × 9/5) + 32. Test it with a few values.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        

        function celsiusToFahrenheit(){
            $F = (78 * 9/5) + 32.;

            echo "<p>78 celcius is ". $F . " Fahrenheit</p>";
        };

        celsiusToFahrenheit();

        ?>
    </div>

    <!-- Exercise 2 -->
    <h2>Exercise 2: Rectangle Area</h2>
    <p>
        <strong>Task:</strong> 
        Create a function called calculateRectangleArea() that takes width
         and height as parameters. It should return the area. If only one 
         parameter is provided, assume it's a square (both dimensions equal).
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here

   function calculateRectangleArea(){
        $height = "60";
        $width = "60";
        $area = $height * $width;

        echo $area;
        // $width2 = $width * $height,
    }

    

    calculateRectangleArea();
        ?>
    </div>

    <!-- Exercise 3 -->
    <h2>Exercise 3: Even or Odd</h2>
    <p>
        <strong>Task:</strong>
        Create a function called checkEvenOdd() that takes a number and returns 
        "Even" if the number is even, or "Odd" if it's odd. Use the modulo 
        operator (%).
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here


        
       function checkEvenOdd() {
    $number = 4;

    if ($number % 2 == 0) {
        echo "even";
    } else {
        echo "odd";
    }
}
        checkEvenOdd();
        ?>
    </div>

    <!-- Exercise 4 -->
    <h2>Exercise 4: Array Statistics</h2>
    <p>
        <strong>Task:</strong> 
        Create a function called getArrayStats() that takes an array of numbers 
        and returns an array with three values: minimum, maximum, and average. 
        Use array destructuring to display the results.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here

        

                
        function getArrayStats($numbers) {
            $min = min($numbers);
            $max = max($numbers);
            $avg = array_sum($numbers) / count($numbers);

            return [$min, $max, $avg];
        }

        $values = [4, 8, 15, 16, 23, 42];

        [$minimum, $maximum, $average] = getArrayStats($values);

        echo "Minimum: $minimum<br>";
        echo "Maximum: $maximum<br>";
        echo "Average: $average";
        



        ?>
    </div>

</body>
</html>
