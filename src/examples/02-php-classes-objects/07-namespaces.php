<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Namespaces - PHP Classes &amp; Objects</title>
    <link rel="stylesheet" href="/examples/css/style.css">
    <link rel="stylesheet" href="/examples/css/prism-tomorrow.min.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to Classes &amp; Objects</a>
        <a href="/exercises/02-php-classes-objects/07-namespaces.php">Go to Exercise &rarr;</a>
    </div>

    <h1>Namespaces</h1>

    <p>Namespaces allow you to organise classes into logical groups and avoid naming conflicts. Without namespaces, you cannot have two classes with the same name in your project.</p>

    <!-- Example 1 -->
    <h2>The Problem: Name Collisions</h2>
    <p>Imagine you have two different concepts that both make sense to call "Status":</p>
    <ul>
        <li><strong>Account Status:</strong> Active, Frozen, Closed, Overdrawn</li>
        <li><strong>User Status:</strong> Active, Suspended, Pending, Verified</li>
    </ul>
    <p>Without namespaces, PHP would give an error if you tried to define two classes called <code>Status</code>.</p>
    <pre><code class="language-php">// This would cause an error without namespaces:
// class Status { /* Account statuses */ }
// class Status { /* User statuses */ }  // Fatal error: Cannot declare class Status

// With namespaces, we can have both:
// namespace Account;
// class Status { ... }

// namespace User;
// class Status { ... }</code></pre>

    <!-- Example 2 -->
    <h2>Declaring a Namespace</h2>
    <p>A namespace is declared at the top of a PHP file using the <code>namespace</code> keyword. All classes in that file belong to that namespace.</p>
    <pre><code class="language-php">// File: classes/Account/Status.php
&lt;?php
namespace Account;

class Status {
    public const ACTIVE = 'active';
    public const FROZEN = 'frozen';
    public const CLOSED = 'closed';
    public const OVERDRAWN = 'overdrawn';

    public static function getDescription($status) {
        $descriptions = [
            self::ACTIVE => 'Account is active and in good standing',
            self::FROZEN => 'Account is temporarily frozen',
            self::CLOSED => 'Account has been closed',
            self::OVERDRAWN => 'Account balance is negative'
        ];
        return $descriptions[$status] ?? 'Unknown status';
    }
}</code></pre>

    <pre><code class="language-php">// File: classes/User/Status.php
&lt;?php
namespace User;

class Status {
    public const ACTIVE = 'active';
    public const SUSPENDED = 'suspended';
    public const PENDING = 'pending';
    public const VERIFIED = 'verified';

    public static function getDescription($status) {
        $descriptions = [
            self::ACTIVE => 'User account is active',
            self::SUSPENDED => 'User account has been suspended',
            self::PENDING => 'User account is awaiting verification',
            self::VERIFIED => 'User identity has been verified'
        ];
        return $descriptions[$status] ?? 'Unknown status';
    }
}</code></pre>

    <!-- Example 3 -->
    <h2>Using Namespaced Classes</h2>
    <p>To use a namespaced class, you can either use the full name (<code>Namespace\ClassName</code>) or import it with <code>use</code>.</p>
    <pre><code class="language-php">require_once __DIR__ . '/classes/Account/Status.php';
require_once __DIR__ . '/classes/User/Status.php';

// Option 1: Use full namespace path
echo Account\Status::ACTIVE . "&lt;br&gt;";
echo User\Status::ACTIVE . "&lt;br&gt;";

// Option 2: Import with 'use'
use Account\Status as AccountStatus;
use User\Status as UserStatus;

echo AccountStatus::getDescription(AccountStatus::FROZEN) . "&lt;br&gt;";
echo UserStatus::getDescription(UserStatus::PENDING);</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        require_once __DIR__ . '/classes/Account/Status.php';
        require_once __DIR__ . '/classes/User/Status.php';

        // Using aliases to avoid collision
        use Account\Status as AccountStatus;
        use User\Status as UserStatus;

        echo "Account ACTIVE constant: " . AccountStatus::ACTIVE . "<br>";
        echo "User ACTIVE constant: " . UserStatus::ACTIVE . "<br><br>";

        echo AccountStatus::getDescription(AccountStatus::FROZEN) . "<br>";
        echo UserStatus::getDescription(UserStatus::PENDING);
        ?>
    </div>

    <!-- Example 4 -->
    <h2>Namespaced Account Classes</h2>
    <p>The classes in the <code>Account/</code> folder are namespaced. Here's how to use them:</p>
    <pre><code class="language-php">require_once __DIR__ . '/classes/Account/BankAccount.php';
require_once __DIR__ . '/classes/Account/SavingsAccount.php';
require_once __DIR__ . '/classes/Account/CurrentAccount.php';

use Account\BankAccount;
use Account\SavingsAccount;
use Account\CurrentAccount;

$basic = new BankAccount("1111111111", "Alice", 100.00);
$savings = new SavingsAccount("2222222222", "Bob", 500.00, 0.05);
$current = new CurrentAccount("3333333333", "Charlie", 300.00);

echo $basic . "&lt;br&gt;";
echo $savings . "&lt;br&gt;";
echo $current;</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        require_once __DIR__ . '/classes/Account/BankAccount.php';
        require_once __DIR__ . '/classes/Account/SavingsAccount.php';
        require_once __DIR__ . '/classes/Account/CurrentAccount.php';

        use Account\BankAccount;
        use Account\SavingsAccount;
        use Account\CurrentAccount;

        $basic = new BankAccount("1111111111", "Alice", 100.00);
        $savings = new SavingsAccount("2222222222", "Bob", 500.00, 0.05);
        $current = new CurrentAccount("3333333333", "Charlie", 300.00);

        echo $basic . "<br>";
        echo $savings . "<br>";
        echo $current;
        ?>
    </div>

    <!-- Example 5 -->
    <h2>Using Multiple Namespaces</h2>
    <p>You can use classes from multiple namespaces in the same file:</p>
    <pre><code class="language-php">require_once __DIR__ . '/classes/Account/BankAccount.php';
require_once __DIR__ . '/classes/User/Customer.php';
require_once __DIR__ . '/classes/User/Employee.php';

use Account\BankAccount;
use User\Customer;
use User\Employee;

$account = new BankAccount("9999999999", "Diana", 1000.00);
$customer = new Customer("dianac", "pass123", "Diana Chen", "10 Main St", "087-1234567");
$employee = new Employee("admin", "secret", "Admin User", "EMP001");

echo "&lt;strong&gt;Account:&lt;/strong&gt; " . $account . "&lt;br&gt;";
echo "&lt;strong&gt;Customer:&lt;/strong&gt; " . $customer . "&lt;br&gt;";
echo "&lt;strong&gt;Employee:&lt;/strong&gt; " . $employee;</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        require_once __DIR__ . '/classes/User/User.php';
        require_once __DIR__ . '/classes/User/Customer.php';
        require_once __DIR__ . '/classes/User/Employee.php';

        use User\Customer;
        use User\Employee;

        $account2 = new BankAccount("9999999999", "Diana", 1000.00);
        $customer = new Customer("dianac", "pass123", "Diana Chen", "10 Main St", "087-1234567");
        $employee = new Employee("admin", "secret", "Admin User", "EMP001");

        echo "<strong>Account:</strong> " . $account2 . "<br>";
        echo "<strong>Customer:</strong> " . $customer . "<br>";
        echo "<strong>Employee:</strong> " . $employee;
        ?>
    </div>

    <!-- Summary -->
    <h2>Namespace Conventions</h2>
    <table style="width: 100%; border-collapse: collapse; margin: 1rem 0;">
        <tr style="background: #f5f5f5;">
            <th style="padding: 0.5rem; border: 1px solid #ddd; text-align: left;">Convention</th>
            <th style="padding: 0.5rem; border: 1px solid #ddd; text-align: left;">Example</th>
        </tr>
        <tr>
            <td style="padding: 0.5rem; border: 1px solid #ddd;">Namespace matches folder structure</td>
            <td style="padding: 0.5rem; border: 1px solid #ddd;"><code>Account\BankAccount</code> in <code>Account/BankAccount.php</code></td>
        </tr>
        <tr>
            <td style="padding: 0.5rem; border: 1px solid #ddd;">One class per file</td>
            <td style="padding: 0.5rem; border: 1px solid #ddd;"><code>BankAccount.php</code> contains only <code>BankAccount</code> class</td>
        </tr>
        <tr>
            <td style="padding: 0.5rem; border: 1px solid #ddd;">PascalCase for namespaces</td>
            <td style="padding: 0.5rem; border: 1px solid #ddd;"><code>Account</code>, <code>User</code>, <code>MyApp\Controllers</code></td>
        </tr>
        <tr>
            <td style="padding: 0.5rem; border: 1px solid #ddd;">Use aliases to avoid conflicts</td>
            <td style="padding: 0.5rem; border: 1px solid #ddd;"><code>use Account\Status as AccountStatus;</code></td>
        </tr>
    </table>

    <script src="/examples/js/prism-core.min.js"></script>
    <script src="/examples/js/prism-autoloader.min.js" data-autoloader-path="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/"></script>
</body>
</html>
