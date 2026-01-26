<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magic Methods - PHP Classes &amp; Objects</title>
    <link rel="stylesheet" href="/examples/css/style.css">
    <link rel="stylesheet" href="/examples/css/prism-tomorrow.min.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to Classes &amp; Objects</a>
        <a href="/exercises/02-php-classes-objects/03-magic-methods.php">Go to Exercise &rarr;</a>
    </div>

    <h1>Magic Methods</h1>

    <p>Magic methods are special methods in PHP that start with double underscores (<code>__</code>). They are called automatically by PHP in response to certain events or operations.</p>

    <!-- Example 1 -->
    <h2>__construct() - The Constructor</h2>
    <p>The constructor is called automatically when you create a new object with <code>new</code>. It's used to initialise the object.</p>
    <pre><code class="language-php">class BankAccount {
    protected $number;
    protected $name;
    protected $balance;

    public function __construct($num, $name, $bal) {
        echo "Creating account for $name...&lt;br&gt;";
        $this->number = $num;
        $this->name = $name;
        $this->balance = $bal;
    }

    public function getName() { return $this->name; }
    public function getBalance() { return $this->balance; }
}

// __construct() is called automatically here
$account = new BankAccount("1234567890", "Alice", 100.00);
echo "Account created: " . $account->getName();</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        class BankAccountConstruct {
            protected $number;
            protected $name;
            protected $balance;

            public function __construct($num, $name, $bal) {
                echo "Creating account for $name...<br>";
                $this->number = $num;
                $this->name = $name;
                $this->balance = $bal;
            }

            public function getName() { return $this->name; }
            public function getBalance() { return $this->balance; }
        }

        $account = new BankAccountConstruct("1234567890", "Alice", 100.00);
        echo "Account created: " . $account->getName();
        ?>
    </div>

    <!-- Example 2 -->
    <h2>__toString() - String Representation</h2>
    <p>The <code>__toString()</code> method is called when an object is used in a string context (e.g., with <code>echo</code>). It must return a string.</p>
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
        $format = "Account number: %s, name: %s, balance: &euro;%01.2f";
        return sprintf($format, $this->number, $this->name, $this->balance);
    }
}

$account = new BankAccount("1234567890", "Bob", 250.00);

// __toString() is called automatically when we echo the object
echo $account;</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        class BankAccountToString {
            protected $number;
            protected $name;
            protected $balance;

            public function __construct($num, $name, $bal) {
                $this->number = $num;
                $this->name = $name;
                $this->balance = $bal;
            }

            public function __toString() {
                $format = "Account number: %s, name: %s, balance: &euro;%01.2f";
                return sprintf($format, $this->number, $this->name, $this->balance);
            }
        }

        $account2 = new BankAccountToString("1234567890", "Bob", 250.00);
        echo $account2;
        ?>
    </div>

    <!-- Example 3 -->
    <h2>__destruct() - The Destructor</h2>
    <p>The <code>__destruct()</code> method is called automatically when an object is destroyed. This happens when the object is set to <code>null</code>, goes out of scope, or when the script ends.</p>
    <pre><code class="language-php">class BankAccount {
    protected $name;

    public function __construct($name) {
        echo "Opening account for $name&lt;br&gt;";
        $this->name = $name;
    }

    public function __destruct() {
        echo "Closing account for {$this->name}&lt;br&gt;";
    }
}

echo "Creating accounts...&lt;br&gt;";
$acc1 = new BankAccount("Alice");
$acc2 = new BankAccount("Bob");

echo "&lt;br&gt;Setting acc1 to null...&lt;br&gt;";
$acc1 = null;  // __destruct() called here

echo "&lt;br&gt;Script ending...&lt;br&gt;";
// __destruct() for acc2 called automatically when script ends</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        class BankAccountDestruct {
            protected $name;

            public function __construct($name) {
                echo "Opening account for $name<br>";
                $this->name = $name;
            }

            public function __destruct() {
                echo "Closing account for {$this->name}<br>";
            }
        }

        echo "Creating accounts...<br>";
        $accA = new BankAccountDestruct("Alice");
        $accB = new BankAccountDestruct("Bob");

        echo "<br>Setting acc1 to null...<br>";
        $accA = null;

        echo "<br>Script ending...<br>";
        ?>
    </div>

    <!-- Example 4 -->
    <h2>Using the BankAccount Class File</h2>
    <p>Our <code>BankAccount</code> class in the classes folder includes <code>__construct()</code> and <code>__toString()</code> methods.</p>
    <pre><code class="language-php">require_once __DIR__ . '/classes/v1/BankAccount.php';

$account1 = new BankAccount("1111111111", "Charlie", 100.00);
$account2 = new BankAccount("2222222222", "Diana", 500.00);

// __toString() makes it easy to display account information
echo "&lt;p&gt;" . $account1 . "&lt;/p&gt;";
echo "&lt;p&gt;" . $account2 . "&lt;/p&gt;";

// We can also use accounts in string concatenation
echo "&lt;p&gt;First account: " . $account1 . "&lt;/p&gt;";</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        require_once __DIR__ . '/classes/v1/BankAccount.php';

        $account3 = new BankAccount("1111111111", "Charlie", 100.00);
        $account4 = new BankAccount("2222222222", "Diana", 500.00);

        echo "<p>" . $account3 . "</p>";
        echo "<p>" . $account4 . "</p>";
        echo "<p>First account: " . $account3 . "</p>";
        ?>
    </div>

    <!-- Example 5 -->
    <h2>Common Magic Methods</h2>
    <p>PHP has many magic methods. Here are some of the most commonly used:</p>
    <table style="width: 100%; border-collapse: collapse; margin: 1rem 0;">
        <tr style="background: #f5f5f5;">
            <th style="padding: 0.5rem; border: 1px solid #ddd; text-align: left;">Method</th>
            <th style="padding: 0.5rem; border: 1px solid #ddd; text-align: left;">Called When</th>
        </tr>
        <tr>
            <td style="padding: 0.5rem; border: 1px solid #ddd;"><code>__construct()</code></td>
            <td style="padding: 0.5rem; border: 1px solid #ddd;">Object is created with <code>new</code></td>
        </tr>
        <tr>
            <td style="padding: 0.5rem; border: 1px solid #ddd;"><code>__destruct()</code></td>
            <td style="padding: 0.5rem; border: 1px solid #ddd;">Object is destroyed or script ends</td>
        </tr>
        <tr>
            <td style="padding: 0.5rem; border: 1px solid #ddd;"><code>__toString()</code></td>
            <td style="padding: 0.5rem; border: 1px solid #ddd;">Object is used as a string</td>
        </tr>
        <tr>
            <td style="padding: 0.5rem; border: 1px solid #ddd;"><code>__get($name)</code></td>
            <td style="padding: 0.5rem; border: 1px solid #ddd;">Accessing an inaccessible property</td>
        </tr>
        <tr>
            <td style="padding: 0.5rem; border: 1px solid #ddd;"><code>__set($name, $value)</code></td>
            <td style="padding: 0.5rem; border: 1px solid #ddd;">Setting an inaccessible property</td>
        </tr>
        <tr>
            <td style="padding: 0.5rem; border: 1px solid #ddd;"><code>__call($name, $args)</code></td>
            <td style="padding: 0.5rem; border: 1px solid #ddd;">Calling an inaccessible method</td>
        </tr>
    </table>

    <script src="/examples/js/prism-core.min.js"></script>
    <script src="/examples/js/prism-autoloader.min.js" data-autoloader-path="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/"></script>
</body>
</html>
