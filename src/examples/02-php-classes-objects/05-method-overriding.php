<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Method Overriding - PHP Classes &amp; Objects</title>
    <link rel="stylesheet" href="/examples/css/style.css">
    <link rel="stylesheet" href="/examples/css/prism-tomorrow.min.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to Classes &amp; Objects</a>
        <a href="/exercises/02-php-classes-objects/05-method-overriding.php">Go to Exercise &rarr;</a>
    </div>

    <h1>Method Overriding</h1>

    <p>Method overriding allows a child class to provide a different implementation of a method that is already defined in its parent class. The child's version replaces the parent's version when called on a child object.</p>

    <!-- Example 1 -->
    <h2>Overriding __toString()</h2>
    <p>A child class can override the parent's <code>__toString()</code> method to provide a different string representation.</p>
    <pre><code class="language-php">class BankAccount {
    protected $number;
    protected $name;
    protected $balance;

    public function __construct($num, $name, $bal) {
        $this->number = $num;
        $this->name = $name;
        $this->balance = $bal;
    }

    public function __toString() {
        return "Account: {$this->number}, Name: {$this->name}, Balance: &euro;{$this->balance}";
    }
}

class SavingsAccount extends BankAccount {
    protected $interestRate;

    public function __construct($num, $name, $bal, $rate) {
        parent::__construct($num, $name, $bal);
        $this->interestRate = $rate;
    }

    // Override __toString() to include interest rate
    public function __toString() {
        $rate = $this->interestRate * 100;
        return "Savings Account: {$this->number}, Name: {$this->name}, " .
               "Balance: &euro;{$this->balance}, Interest: {$rate}%";
    }
}

$bank = new BankAccount("1111111111", "Alice", 100.00);
$savings = new SavingsAccount("2222222222", "Bob", 500.00, 0.05);

echo $bank . "&lt;br&gt;";
echo $savings;</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        class BankAccountOverride {
            protected $number;
            protected $name;
            protected $balance;

            public function __construct($num, $name, $bal) {
                $this->number = $num;
                $this->name = $name;
                $this->balance = $bal;
            }

            public function __toString() {
                return "Account: {$this->number}, Name: {$this->name}, Balance: &euro;{$this->balance}";
            }
        }

        class SavingsAccountOverride extends BankAccountOverride {
            protected $interestRate;

            public function __construct($num, $name, $bal, $rate) {
                parent::__construct($num, $name, $bal);
                $this->interestRate = $rate;
            }

            public function __toString() {
                $rate = $this->interestRate * 100;
                return "Savings Account: {$this->number}, Name: {$this->name}, " .
                       "Balance: &euro;{$this->balance}, Interest: {$rate}%";
            }
        }

        $bank = new BankAccountOverride("1111111111", "Alice", 100.00);
        $savings = new SavingsAccountOverride("2222222222", "Bob", 500.00, 0.05);

        echo $bank . "<br>";
        echo $savings;
        ?>
    </div>

    <!-- Example 2 -->
    <h2>Calling the Parent Method with parent::</h2>
    <p>When overriding a method, you can still call the parent's version using <code>parent::methodName()</code>. This is useful when you want to extend the parent's behaviour rather than replace it entirely.</p>
    <pre><code class="language-php">class CurrentAccount extends BankAccount {
    protected $transactionCount = 0;

    public function deposit($amount) {
        $this->transactionCount++;      // Add our own behaviour
        parent::deposit($amount);        // Then call parent's deposit
    }

    public function withdraw($amount) {
        $this->transactionCount++;      // Add our own behaviour
        parent::withdraw($amount);       // Then call parent's withdraw
    }

    public function getTransactionCount() {
        return $this->transactionCount;
    }
}

$current = new CurrentAccount("3333333333", "Charlie", 100.00);

$current->deposit(50.00);
$current->withdraw(20.00);
$current->deposit(30.00);

echo "Balance: &euro;" . $current->getBalance() . "&lt;br&gt;";
echo "Transactions: " . $current->getTransactionCount();</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        class BankAccountForCurrent {
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

            public function withdraw($amount) {
                $this->balance -= $amount;
            }
        }

        class CurrentAccountExample extends BankAccountForCurrent {
            protected $transactionCount = 0;

            public function deposit($amount) {
                $this->transactionCount++;
                parent::deposit($amount);
            }

            public function withdraw($amount) {
                $this->transactionCount++;
                parent::withdraw($amount);
            }

            public function getTransactionCount() {
                return $this->transactionCount;
            }
        }

        $current = new CurrentAccountExample("3333333333", "Charlie", 100.00);

        $current->deposit(50.00);
        $current->withdraw(20.00);
        $current->deposit(30.00);

        echo "Balance: &euro;" . $current->getBalance() . "<br>";
        echo "Transactions: " . $current->getTransactionCount();
        ?>
    </div>

    <!-- Example 3 -->
    <h2>The CurrentAccount Class</h2>
    <p>The <code>CurrentAccount</code> class in our v2 folder tracks transactions and charges fees for transactions beyond the free limit.</p>
    <pre><code class="language-php">require_once __DIR__ . '/classes/v2/CurrentAccount.php';

$current = new CurrentAccount("4444444444", "Diana", 100.00);

// Make several transactions
$current->deposit(20.00);   // Transaction 1
$current->withdraw(30.00);  // Transaction 2
$current->deposit(40.00);   // Transaction 3
$current->withdraw(15.00);  // Transaction 4 (will incur fee)
$current->deposit(25.00);   // Transaction 5 (will incur fee)

echo "Balance before fees: &euro;" . $current->getBalance() . "&lt;br&gt;";

// Deduct fees (3 free transactions, then &euro;1.50 per transaction)
$current->deductFees();

echo "Balance after fees: &euro;" . $current->getBalance() . "&lt;br&gt;";
echo "(Fee: 2 transactions x &euro;1.50 = &euro;3.00)";</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        require_once __DIR__ . '/classes/v2/CurrentAccount.php';

        $current2 = new CurrentAccount("4444444444", "Diana", 100.00);

        $current2->deposit(20.00);
        $current2->withdraw(30.00);
        $current2->deposit(40.00);
        $current2->withdraw(15.00);
        $current2->deposit(25.00);

        echo "Balance before fees: &euro;" . $current2->getBalance() . "<br>";

        $current2->deductFees();

        echo "Balance after fees: &euro;" . $current2->getBalance() . "<br>";
        echo "(Fee: 2 transactions x &euro;1.50 = &euro;3.00)";
        ?>
    </div>

    <!-- Example 4 -->
    <h2>Polymorphism</h2>
    <p>Because child classes share the same interface as the parent, we can treat different account types uniformly. This is called polymorphism.</p>
    <pre><code class="language-php">require_once __DIR__ . '/classes/v2/SavingsAccount.php';
require_once __DIR__ . '/classes/v2/CurrentAccount.php';

// Create different types of accounts
$accounts = [
    new BankAccount("1111111111", "Alice", 100.00),
    new SavingsAccount("2222222222", "Bob", 200.00, 0.05),
    new CurrentAccount("3333333333", "Charlie", 300.00)
];

// We can loop through them and call common methods
foreach ($accounts as $account) {
    $account->deposit(10.00);  // Works on all account types
    echo $account . "&lt;br&gt;";
}</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        require_once __DIR__ . '/classes/v2/SavingsAccount.php';
        require_once __DIR__ . '/classes/v2/CurrentAccount.php';

        $accounts = [
            new BankAccount("1111111111", "Alice", 100.00),
            new SavingsAccount("2222222222", "Bob", 200.00, 0.05),
            new CurrentAccount("3333333333", "Charlie", 300.00)
        ];

        foreach ($accounts as $account) {
            $account->deposit(10.00);
            echo $account . "<br>";
        }
        ?>
    </div>

    <script src="/examples/js/prism-core.min.js"></script>
    <script src="/examples/js/prism-autoloader.min.js" data-autoloader-path="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/"></script>
</body>
</html>
