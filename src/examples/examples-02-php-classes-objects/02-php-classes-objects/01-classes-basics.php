<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classes Basics - PHP Classes &amp; Objects</title>
    <link rel="stylesheet" href="/examples/css/style.css">
    <link rel="stylesheet" href="/examples/css/prism-tomorrow.min.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to Classes &amp; Objects</a>
        <a href="/exercises/02-php-classes-objects/01-classes-basics.php">Go to Exercise &rarr;</a>
    </div>

    <h1>Classes Basics</h1>

    <p>A class is a blueprint for creating objects. It defines the properties (data) and methods (functions) that objects of that type will have.</p>

    <!-- Example 1 -->
    <h2>Defining a Simple Class</h2>
    <p>A class is defined using the <code>class</code> keyword. Properties store data, and methods define behaviour. The <code>$this</code> keyword refers to the current object instance.</p>
    <pre><code class="language-php">class BankAccount {
    public $number;
    public $name;
    public $balance;
}

// Create an object (instance) of the class
$account = new BankAccount();

// Set properties
$account->number = "1234567890";
$account->name = "Alice";
$account->balance = 100.00;

// Access properties
echo "Account: " . $account->number;
echo ", Name: " . $account->name;
echo ", Balance: &euro;" . $account->balance;</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        class BankAccountSimple {
            public $number;
            public $name;
            public $balance;
        }

        $account = new BankAccountSimple();
        $account->number = "1234567890";
        $account->name = "Alice";
        $account->balance = 100.00;

        echo "Account: " . $account->number;
        echo ", Name: " . $account->name;
        echo ", Balance: &euro;" . $account->balance;
        ?>
    </div>

    <!-- Example 2 -->
    <h2>Constructor Method</h2>
    <p>The <code>__construct()</code> method is called automatically when you create a new object. It's used to initialise the object's properties.</p>
    <pre><code class="language-php">class BankAccount {
    public $number;
    public $name;
    public $balance;

    public function __construct($num, $name, $bal) {
        $this->number = $num;
        $this->name = $name;
        $this->balance = $bal;
    }
}

// Create object with constructor arguments
$account = new BankAccount("1234567890", "Bob", 250.00);

echo "Account: " . $account->number;
echo ", Name: " . $account->name;
echo ", Balance: &euro;" . $account->balance;</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        class BankAccountWithConstructor {
            public $number;
            public $name;
            public $balance;

            public function __construct($num, $name, $bal) {
                $this->number = $num;
                $this->name = $name;
                $this->balance = $bal;
            }
        }

        $account2 = new BankAccountWithConstructor("1234567890", "Bob", 250.00);

        echo "Account: " . $account2->number;
        echo ", Name: " . $account2->name;
        echo ", Balance: &euro;" . $account2->balance;
        ?>
    </div>

    <!-- Example 3 -->
    <h2>Adding Methods</h2>
    <p>Methods define behaviour for the class. They can access and modify the object's properties using <code>$this</code>.</p>
    <pre><code class="language-php">class BankAccount {
    public $number;
    public $name;
    public $balance;

    public function __construct($num, $name, $bal) {
        $this->number = $num;
        $this->name = $name;
        $this->balance = $bal;
    }

    public function deposit($amount) {
        $this->balance += $amount;
    }

    public function withdraw($amount) {
        $this->balance -= $amount;
    }
}

$account = new BankAccount("1234567890", "Charlie", 100.00);
echo "Starting balance: &euro;" . $account->balance . "&lt;br&gt;";

$account->deposit(50.00);
echo "After deposit of &euro;50: &euro;" . $account->balance . "&lt;br&gt;";

$account->withdraw(30.00);
echo "After withdrawal of &euro;30: &euro;" . $account->balance;</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        class BankAccountWithMethods {
            public $number;
            public $name;
            public $balance;

            public function __construct($num, $name, $bal) {
                $this->number = $num;
                $this->name = $name;
                $this->balance = $bal;
            }

            public function deposit($amount) {
                $this->balance += $amount;
            }

            public function withdraw($amount) {
                $this->balance -= $amount;
            }
        }

        $account3 = new BankAccountWithMethods("1234567890", "Charlie", 100.00);
        echo "Starting balance: &euro;" . $account3->balance . "<br>";

        $account3->deposit(50.00);
        echo "After deposit of &euro;50: &euro;" . $account3->balance . "<br>";

        $account3->withdraw(30.00);
        echo "After withdrawal of &euro;30: &euro;" . $account3->balance;
        ?>
    </div>

    <script src="/examples/js/prism-core.min.js"></script>
    <script src="/examples/js/prism-autoloader.min.js" data-autoloader-path="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/"></script>
</body>
</html>
