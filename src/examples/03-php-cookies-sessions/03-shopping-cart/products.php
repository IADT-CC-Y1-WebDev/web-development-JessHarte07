<?php
// =============================================================================
// CONFIGURE AUTOLOADER BEFORE SESSION START TO ENSURE CLASSES ARE AVAILABLE FOR
// SESSION STORAGE SERIALIZATION
// =============================================================================
require_once 'etc/config.php';

// =============================================================================
// SESSION SETUP
// =============================================================================

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Create products (they auto-register via the Registry pattern)
new Product(1, 'Laptop', 999.99, 'Powerful laptop for work and play');
new Product(2, 'Headphones', 149.99, 'Wireless noise-cancelling headphones');
new Product(3, 'Keyboard', 79.99, 'Mechanical keyboard with RGB lighting');
new Product(4, 'Mouse', 49.99, 'Ergonomic wireless mouse');

// Get the cart instance from the session
$cart = ShoppingCart::getInstance();

// Handle "Add to Cart" action
if (isset($_GET['add'])) {
    $product = Product::findById((int)$_GET['add']);

    if ($product !== null) {
        $cart->add($product);
    }

    header('Location: products.php');
    exit;
}

$cartCount = $cart->getCount();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Shopping Cart Example</title>
    <link rel="stylesheet" href="/examples/css/style.css">
    <link rel="stylesheet" href="/examples/css/prism-tomorrow.min.css">
    <style>
        .cart-badge {
            background: #e74c3c;
            color: white;
            border-radius: 50%;
            padding: 0.25rem 0.5rem;
            font-size: 0.8rem;
            margin-left: 0.5rem;
        }
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
            margin: 1rem 0;
        }
        .product-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 1rem;
            text-align: center;
        }
        .product-card h3 { margin: 0 0 0.5rem 0; }
        .product-price {
            font-size: 1.25rem;
            color: #27ae60;
            font-weight: bold;
        }
        .add-btn {
            display: inline-block;
            background: #3498db;
            color: white;
            padding: 0.5rem 1rem;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 0.5rem;
        }
        .add-btn:hover { background: #2980b9; }
        .nav-links {
            background: #f5f5f5;
            padding: 1rem;
            border-radius: 8px;
            margin: 1rem 0;
        }
        .nav-links a { margin-right: 1rem; }
    </style>
</head>
<body>
    <div class="back-link">
        <a href="../index.php">&larr; Back to Cookies &amp; Sessions</a>
        <a href="/exercises/03-php-cookies-sessions/03-shopping-cart/products.php">Go to Exercise &rarr;</a>
    </div>

    <h1>Shopping Cart (Sessions)</h1>

    <p>This example demonstrates how sessions maintain state across multiple pages.
    Add items to your cart and navigate between pages - your cart contents persist!</p>

    <!-- Navigation -->
    <div class="nav-links">
        <strong>Products</strong> |
        <a href="cart.php">View Cart <span class="cart-badge"><?= $cartCount ?></span></a> |
        <a href="checkout.php">Checkout</a>
    </div>

    <!-- Product List -->
    <h2>Available Products</h2>
    <div class="product-grid">
        <?php foreach (Product::findAll() as $product): ?>
            <div class="product-card">
                <h3><?= htmlspecialchars($product->name) ?></h3>
                <p><?= htmlspecialchars($product->description) ?></p>
                <p class="product-price">&euro;<?= number_format($product->price, 2) ?></p>
                <a href="?add=<?= $product->id ?>" class="add-btn">Add to Cart</a>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Code Explanation -->
    <h2>How It Works</h2>

    <h3>1. Product Class with Registry Pattern</h3>
    <p>Products auto-register themselves when created. We can retrieve them using static methods.</p>
    <pre><code class="language-php">// Create products (they auto-register via the Registry pattern)
new Product(1, 'Laptop', 999.99, 'Powerful laptop for work and play');
new Product(2, 'Headphones', 149.99, 'Wireless noise-cancelling headphones');
new Product(3, 'Keyboard', 79.99, 'Mechanical keyboard with RGB lighting');
new Product(4, 'Mouse', 49.99, 'Ergonomic wireless mouse');

// retrieve products
$allProducts = Product::findAll();
$laptop = Product::findById(1);</code></pre>

    <h3>2. ShoppingCart Instance</h3>
    <p>The cart instance is stored in the session. We retrieve it using <code>getInstance()</code>.</p>
    <pre><code class="language-php">// Get the cart instance from the session
$cart = ShoppingCart::getInstance();

$product = Product::findById((int)$_GET['add']);

if ($product !== null) {
    $cart->add($product);
}

$count = $cart->getCount();
$total = $cart->getTotal();</code></pre>

    <h3>3. ShoppingCartItem Class</h3>
    <p>Each item in the cart tracks the product details and quantity.</p>
    <pre><code class="language-php">// Cart items have public properties
foreach ($cart->getItems() as $item) {
    echo $item->name;
    echo $item->price;
    echo $item->quantity;
    echo $item->getSubtotal();
}</code></pre>

    <script src="/examples/js/prism-core.min.js"></script>
    <script src="/examples/js/prism-autoloader.min.js" data-autoloader-path="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/"></script>
</body>
</html>
