<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autoloader - PHP Classes &amp; Objects</title>
    <link rel="stylesheet" href="/examples/css/style.css">
    <link rel="stylesheet" href="/examples/css/prism-tomorrow.min.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to Classes &amp; Objects</a>
        <a href="/exercises/02-php-classes-objects/08-autoloader.php">Go to Exercise &rarr;</a>
    </div>

    <h1>Autoloader</h1>

    <p>An autoloader automatically loads class files when they are needed, eliminating the need for multiple <code>require_once</code> statements. PHP's <code>spl_autoload_register()</code> function makes this possible.</p>

    <!-- Example 1 -->
    <h2>The Problem: Too Many Require Statements</h2>
    <p>As your project grows, you end up with many require statements:</p>
    <pre><code class="language-php">// Without an autoloader, you need to require every class:
require_once __DIR__ . '/classes/Account/BankAccount.php';
require_once __DIR__ . '/classes/Account/SavingsAccount.php';
require_once __DIR__ . '/classes/Account/CurrentAccount.php';
require_once __DIR__ . '/classes/Account/Status.php';
require_once __DIR__ . '/classes/User/User.php';
require_once __DIR__ . '/classes/User/Customer.php';
require_once __DIR__ . '/classes/User/Employee.php';
require_once __DIR__ . '/classes/User/Status.php';
// ... and many more as your project grows</code></pre>

    <p>This is tedious, error-prone, and makes code harder to maintain.</p>

    <!-- Example 2 -->
    <h2>Creating an Autoloader</h2>
    <p>An autoloader is a function that PHP calls whenever it encounters an undefined class. The function receives the class name and should load the appropriate file.</p>
    <pre><code class="language-php">// File: etc/config.php
&lt;?php
spl_autoload_register(function ($class) {
    // Convert namespace separators to directory separators
    // Account\BankAccount becomes Account/BankAccount
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    // Build the full file path
    $file = __DIR__ . '/../classes/' . $path . '.php';

    // If the file exists, require it
    if (file_exists($file)) {
        require_once $file;
    }
});</code></pre>

    <!-- Example 3 -->
    <h2>How It Works</h2>
    <p>When PHP encounters a class it doesn't know:</p>
    <ol>
        <li>PHP calls the registered autoloader function with the class name</li>
        <li>The autoloader converts the namespace to a file path</li>
        <li>If the file exists, it's loaded automatically</li>
        <li>PHP continues executing with the class now available</li>
    </ol>

    <pre><code class="language-php">// Example: When PHP sees "new Account\BankAccount(...)"
// 1. PHP doesn't know Account\BankAccount
// 2. Autoloader is called with "Account\BankAccount"
// 3. Converts to path: "classes/Account/BankAccount.php"
// 4. Requires the file
// 5. Class is now available</code></pre>

    <!-- Example 4 -->
    <h2>Using the Autoloader</h2>
    <p>With an autoloader, you only need one require statement, and then you can use any class:</p>
    <pre><code class="language-php">// Just require the config file with the autoloader
require_once __DIR__ . '/etc/config.php';

use Account\BankAccount;
use Account\SavingsAccount;
use Account\CurrentAccount;
use User\Customer;
use User\Employee;

// Now use any class - files are loaded automatically!
$account = new BankAccount("1234567890", "Alice", 100.00);
$savings = new SavingsAccount("2345678901", "Bob", 500.00, 0.05);
$current = new CurrentAccount("3456789012", "Charlie", 300.00);
$customer = new Customer("dianac", "pass", "Diana", "10 Main St", "087-123");
$employee = new Employee("admin", "secret", "Admin", "EMP001");

echo $account . "&lt;br&gt;";
echo $savings . "&lt;br&gt;";
echo $current . "&lt;br&gt;";
echo $customer . "&lt;br&gt;";
echo $employee;</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        require_once __DIR__ . '/etc/config.php';

        // Now classes load automatically when used
        $account = new \Account\BankAccount("1234567890", "Alice", 100.00);
        $savings = new \Account\SavingsAccount("2345678901", "Bob", 500.00, 0.05);
        $current = new \Account\CurrentAccount("3456789012", "Charlie", 300.00);
        $customer = new \User\Customer("dianac", "pass", "Diana", "10 Main St", "087-123");
        $employee = new \User\Employee("admin", "secret", "Admin", "EMP001");

        echo $account . "<br>";
        echo $savings . "<br>";
        echo $current . "<br>";
        echo $customer . "<br>";
        echo $employee;
        ?>
    </div>

    <!-- Example 5 -->
    <h2>Benefits of Autoloading</h2>
    <table style="width: 100%; border-collapse: collapse; margin: 1rem 0;">
        <tr style="background: #f5f5f5;">
            <th style="padding: 0.5rem; border: 1px solid #ddd; text-align: left;">Without Autoloader</th>
            <th style="padding: 0.5rem; border: 1px solid #ddd; text-align: left;">With Autoloader</th>
        </tr>
        <tr>
            <td style="padding: 0.5rem; border: 1px solid #ddd;">Many require_once statements</td>
            <td style="padding: 0.5rem; border: 1px solid #ddd;">One require for the config</td>
        </tr>
        <tr>
            <td style="padding: 0.5rem; border: 1px solid #ddd;">Must remember to add requires</td>
            <td style="padding: 0.5rem; border: 1px solid #ddd;">Classes loaded when needed</td>
        </tr>
        <tr>
            <td style="padding: 0.5rem; border: 1px solid #ddd;">All files loaded upfront</td>
            <td style="padding: 0.5rem; border: 1px solid #ddd;">Only loads files actually used</td>
        </tr>
        <tr>
            <td style="padding: 0.5rem; border: 1px solid #ddd;">Path errors are common</td>
            <td style="padding: 0.5rem; border: 1px solid #ddd;">Consistent path resolution</td>
        </tr>
    </table>

    <!-- Example 6 -->
    <h2>PSR-4 Standard</h2>
    <p>The PSR-4 standard defines a consistent way to map namespaces to file paths:</p>
    <ul>
        <li>Each namespace corresponds to a directory</li>
        <li>Each class name corresponds to a file name</li>
        <li>File names use PascalCase with <code>.php</code> extension</li>
    </ul>

    <pre><code class="language-php">// PSR-4 mapping examples:
// Namespace\Class          ->  Folder/File.php
// Account\BankAccount      ->  Account/BankAccount.php
// Account\SavingsAccount   ->  Account/SavingsAccount.php
// User\Customer            ->  User/Customer.php
// App\Controllers\Home     ->  App/Controllers/Home.php</code></pre>

    <p>This convention is used by Composer (PHP's package manager) and most modern PHP frameworks.</p>

    <script src="/examples/js/prism-core.min.js"></script>
    <script src="/examples/js/prism-autoloader.min.js" data-autoloader-path="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/"></script>
</body>
</html>
