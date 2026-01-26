<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encapsulation - PHP Classes &amp; Objects</title>
    <link rel="stylesheet" href="/examples/css/style.css">
    <link rel="stylesheet" href="/examples/css/prism-tomorrow.min.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to Classes &amp; Objects</a>
        <a href="/exercises/02-php-classes-objects/02-encapsulation.php">Go to Exercise &rarr;</a>
    </div>

    <h1>Encapsulation</h1>

    <p>Encapsulation is the practice of hiding the internal details of a class and controlling access to its data through methods. This protects the data from invalid modifications.</p>

    <!-- Example 1 -->
    <h2>Visibility: Public, Private, Protected</h2>
    <p>PHP provides three visibility keywords:</p>
    <ul>
        <li><code>public</code> - accessible from anywhere</li>
        <li><code>private</code> - accessible only within the class</li>
        <li><code>protected</code> - accessible within the class and its subclasses</li>
    </ul>
    <pre><code class="language-php">class BankAccount {
    private $number;      // Only accessible within this class
    private $name;
    private $balance;

    public function __construct($num, $name, $bal) {
        $this->number = $num;
        $this->name = $name;
        $this->balance = $bal;
    }

    // Public getter methods provide controlled read access
    public function getNumber() { return $this->number; }
    public function getName() { return $this->name; }
    public function getBalance() { return $this->balance; }
}

$account = new BankAccount("1234567890", "Alice", 100.00);

// Access via getter methods (allowed)
echo "Account: " . $account->getNumber() . "&lt;br&gt;";
echo "Name: " . $account->getName() . "&lt;br&gt;";
echo "Balance: &euro;" . $account->getBalance();

// Direct access would cause an error:
// echo $account->balance; // Fatal error!</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        class BankAccountPrivate {
            private $number;
            private $name;
            private $balance;

            public function __construct($num, $name, $bal) {
                $this->number = $num;
                $this->name = $name;
                $this->balance = $bal;
            }

            public function getNumber() { return $this->number; }
            public function getName() { return $this->name; }
            public function getBalance() { return $this->balance; }
        }

        $account = new BankAccountPrivate("1234567890", "Alice", 100.00);

        echo "Account: " . $account->getNumber() . "<br>";
        echo "Name: " . $account->getName() . "<br>";
        echo "Balance: &euro;" . $account->getBalance();
        ?>
    </div>

    <!-- Example 2 -->
    <h2>Why Use Encapsulation?</h2>
    <p>Encapsulation allows you to validate data and prevent invalid states. Here, we ensure deposits are positive and withdrawals don't exceed the balance.</p>
    <pre><code class="language-php">class BankAccount {
    private $number;
    private $name;
    private $balance;

    public function __construct($num, $name, $bal) {
        $this->number = $num;
        $this->name = $name;
        $this->balance = $bal;
    }

    public function getBalance() { return $this->balance; }

    public function deposit($amount) {
        if ($amount <= 0) {
            throw new Exception("Deposit amount must be positive");
        }
        $this->balance += $amount;
    }

    public function withdraw($amount) {
        if ($amount > $this->balance) {
            throw new Exception("Insufficient funds");
        }
        $this->balance -= $amount;
    }
}

$account = new BankAccount("1234567890", "Bob", 100.00);

$account->deposit(50.00);
echo "After deposit: &euro;" . $account->getBalance() . "&lt;br&gt;";

$account->withdraw(30.00);
echo "After withdrawal: &euro;" . $account->getBalance() . "&lt;br&gt;";

// This would throw an exception:
// $account->withdraw(200.00); // Exception: Insufficient funds</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        class BankAccountValidated {
            private $number;
            private $name;
            private $balance;

            public function __construct($num, $name, $bal) {
                $this->number = $num;
                $this->name = $name;
                $this->balance = $bal;
            }

            public function getBalance() { return $this->balance; }

            public function deposit($amount) {
                if ($amount <= 0) {
                    throw new Exception("Deposit amount must be positive");
                }
                $this->balance += $amount;
            }

            public function withdraw($amount) {
                if ($amount > $this->balance) {
                    throw new Exception("Insufficient funds");
                }
                $this->balance -= $amount;
            }
        }

        $account2 = new BankAccountValidated("1234567890", "Bob", 100.00);

        $account2->deposit(50.00);
        echo "After deposit: &euro;" . $account2->getBalance() . "<br>";

        $account2->withdraw(30.00);
        echo "After withdrawal: &euro;" . $account2->getBalance() . "<br>";

        echo "<br><em>Attempting invalid withdrawal...</em><br>";
        try {
            $account2->withdraw(200.00);
        } catch (Exception $e) {
            echo "Exception caught: " . $e->getMessage();
        }
        ?>
    </div>

    <!-- Example 3 -->
    <h2>Using an External Class File</h2>
    <p>In practice, classes are stored in separate files and included using <code>require_once</code>. This keeps code organised and reusable.</p>
    <pre><code class="language-php">// File: classes/v1/BankAccount.php contains the class definition

require_once __DIR__ . '/classes/v1/BankAccount.php';

$account = new BankAccount("9876543210", "Charlie", 500.00);

echo "Account: " . $account->getNumber() . "&lt;br&gt;";
echo "Name: " . $account->getName() . "&lt;br&gt;";
echo "Balance: &euro;" . $account->getBalance();</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        require_once __DIR__ . '/classes/v1/BankAccount.php';

        $account3 = new BankAccount("9876543210", "Charlie", 500.00);

        echo "Account: " . $account3->getNumber() . "<br>";
        echo "Name: " . $account3->getName() . "<br>";
        echo "Balance: &euro;" . $account3->getBalance();
        ?>
    </div>

    <script src="/examples/js/prism-core.min.js"></script>
    <script src="/examples/js/prism-autoloader.min.js" data-autoloader-path="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/"></script>
</body>
</html>
