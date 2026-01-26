<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classes &amp; Objects - Examples</title>
    <link rel="stylesheet" href="/examples/css/style.css">
</head>
<body>
    <div class="back-link">
        <a href="/index.php">&larr; Back to Module Index</a>
    </div>

    <h1>Classes &amp; Objects - Examples</h1>

    <p>This module introduces object-oriented programming (OOP) in PHP, building progressively from basic classes to namespaces and autoloading.</p>

    <h2>Core OOP Concepts</h2>
    <ul class="example-list">
        <li><a href="01-classes-basics.php">Classes Basics</a></li>
        <li><a href="02-encapsulation.php">Encapsulation</a></li>
        <li><a href="03-magic-methods.php">Magic Methods</a></li>
        <li><a href="04-inheritance.php">Inheritance</a></li>
        <li><a href="05-method-overriding.php">Method Overriding</a></li>
    </ul>

    <h2>Advanced Topics</h2>
    <ul class="example-list">
        <li><a href="06-static-members.php">Static Members</a></li>
        <li><a href="07-namespaces.php">Namespaces</a></li>
        <li><a href="08-autoloader.php">Autoloader</a></li>
    </ul>

    <h2>Class Files</h2>
    <p>The <code>classes/</code> folder contains different versions of the example classes:</p>
    <ul>
        <li><strong>v1/</strong> - Basic BankAccount class (no static, no namespace)</li>
        <li><strong>v2/</strong> - With inheritance: BankAccount, SavingsAccount, CurrentAccount</li>
        <li><strong>v3/</strong> - With static members for tracking accounts</li>
        <li><strong>Account/</strong> - Namespaced version with full features</li>
        <li><strong>User/</strong> - Namespaced User, Customer, Employee classes</li>
    </ul>
</body>
</html>
