<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inheritance - PHP Classes &amp; Objects</title>
    <link rel="stylesheet" href="/examples/css/style.css">
    <link rel="stylesheet" href="/examples/css/prism-tomorrow.min.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to Classes &amp; Objects</a>
        <a href="/exercises/02-php-classes-objects/04-inheritance.php">Go to Exercise &rarr;</a>
    </div>

    <h1>Inheritance</h1>

    <p>Inheritance allows a class to inherit properties and methods from another class. The child class (subclass) extends the parent class (superclass) and can add new functionality or modify existing behaviour.</p>

    <!-- Example 1 -->
    <h2>The extends Keyword</h2>
    <p>Use the <code>extends</code> keyword to create a child class. The child class inherits all public and protected members from the parent.</p>
    <pre><code class="language-php">class BankAccount {
    protected $number;
    protected $name;
    protected $balance;

    public function __construct($num, $name, $bal) {
        $this->number = $num;
        $this->name = $name;
        $this->balance = $bal;
    }

    public function getBalance() { return $this->balance; }

    public function deposit($amount) {
        $this->balance += $amount;
    }
}

// SavingsAccount inherits from BankAccount
class SavingsAccount extends BankAccount {
    protected $interestRate;

    public function __construct($num, $name, $bal, $rate) {
        // Call parent constructor first
        parent::__construct($num, $name, $bal);
        // Then set the additional property
        $this->interestRate = $rate;
    }

    public function getInterestRate() {
        return $this->interestRate;
    }
}

$savings = new SavingsAccount("1234567890", "Alice", 1000.00, 0.05);

// Inherited method from BankAccount
echo "Balance: &euro;" . $savings->getBalance() . "&lt;br&gt;";

// Method specific to SavingsAccount
echo "Interest Rate: " . ($savings->getInterestRate() * 100) . "%";</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        class BankAccountBase {
            protected $number;
            protected $name;
            protected $balance;

            public function __construct($num, $name, $bal) {
                $this->number = $num;
                $this->name = $name;
                $this->balance = $bal;
            }

            public function getBalance() { return $this->balance; }

            public function deposit($amount) {
                $this->balance += $amount;
            }
        }

        class SavingsAccountExample extends BankAccountBase {
            protected $interestRate;

            public function __construct($num, $name, $bal, $rate) {
                parent::__construct($num, $name, $bal);
                $this->interestRate = $rate;
            }

            public function getInterestRate() {
                return $this->interestRate;
            }
        }

        $savings = new SavingsAccountExample("1234567890", "Alice", 1000.00, 0.05);
        echo "Balance: &euro;" . $savings->getBalance() . "<br>";
        echo "Interest Rate: " . ($savings->getInterestRate() * 100) . "%";
        ?>
    </div>

    <!-- Example 2 -->
    <h2>Adding New Methods to Child Classes</h2>
    <p>Child classes can add methods that don't exist in the parent class. This extends the functionality for that specific type.</p>
    <pre><code class="language-php">class SavingsAccount extends BankAccount {
    protected $interestRate;

    public function __construct($num, $name, $bal, $rate) {
        parent::__construct($num, $name, $bal);
        $this->interestRate = $rate;
    }

    // New method specific to SavingsAccount
    public function addInterest() {
        $interest = $this->interestRate * $this->balance;
        $this->deposit($interest);  // Uses inherited method
    }

    public function getInterestRate() {
        return $this->interestRate;
    }
}

$savings = new SavingsAccount("1234567890", "Bob", 1000.00, 0.05);

echo "Starting balance: &euro;" . $savings->getBalance() . "&lt;br&gt;";

$savings->addInterest();  // Adds 5% interest

echo "After adding interest: &euro;" . $savings->getBalance();</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        class SavingsAccountWithInterest extends BankAccountBase {
            protected $interestRate;

            public function __construct($num, $name, $bal, $rate) {
                parent::__construct($num, $name, $bal);
                $this->interestRate = $rate;
            }

            public function addInterest() {
                $interest = $this->interestRate * $this->balance;
                $this->deposit($interest);
            }

            public function getInterestRate() {
                return $this->interestRate;
            }
        }

        $savings2 = new SavingsAccountWithInterest("1234567890", "Bob", 1000.00, 0.05);
        echo "Starting balance: &euro;" . $savings2->getBalance() . "<br>";
        $savings2->addInterest();
        echo "After adding interest: &euro;" . $savings2->getBalance();
        ?>
    </div>

    <!-- Example 3 -->
    <h2>Using Class Files with Inheritance</h2>
    <p>The v2 folder contains <code>BankAccount</code>, <code>SavingsAccount</code>, and <code>CurrentAccount</code> classes with inheritance set up.</p>
    <pre><code class="language-php">require_once __DIR__ . '/classes/v2/SavingsAccount.php';

$savings = new SavingsAccount("5555555555", "Charlie", 2000.00, 0.03);

echo $savings . "&lt;br&gt;";

$savings->deposit(500.00);
echo "After deposit: Balance is &euro;" . $savings->getBalance() . "&lt;br&gt;";

$savings->addInterest();
echo "After interest: Balance is &euro;" . $savings->getBalance();</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        require_once __DIR__ . '/classes/v2/SavingsAccount.php';

        $savings3 = new SavingsAccount("5555555555", "Charlie", 2000.00, 0.03);

        echo $savings3 . "<br>";

        $savings3->deposit(500.00);
        echo "After deposit: Balance is &euro;" . $savings3->getBalance() . "<br>";

        $savings3->addInterest();
        echo "After interest: Balance is &euro;" . $savings3->getBalance();
        ?>
    </div>

    <!-- Example 4 -->
    <h2>Protected vs Private</h2>
    <p>Properties declared as <code>protected</code> can be accessed by child classes. Properties declared as <code>private</code> cannot. This is why <code>BankAccount</code> uses <code>protected</code> for its properties.</p>
    <pre><code class="language-php">class Parent {
    private $privateVar = "private";
    protected $protectedVar = "protected";

    // Child classes CANNOT access $privateVar
    // Child classes CAN access $protectedVar
}

class Child extends Parent {
    public function showVars() {
        // echo $this->privateVar;   // Error!
        echo $this->protectedVar;    // Works!
    }
}</code></pre>

    <script src="/examples/js/prism-core.min.js"></script>
    <script src="/examples/js/prism-autoloader.min.js" data-autoloader-path="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/"></script>
</body>
</html>
