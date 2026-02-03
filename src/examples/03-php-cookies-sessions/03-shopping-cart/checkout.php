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

// Get the cart instance from the session
$cart = ShoppingCart::getInstance();

// Handle "Complete Order" action
$orderCompleted = false;
if (isset($_GET['complete']) && !$cart->isEmpty()) {
    // In a real app, you would:
    // 1. Process payment
    // 2. Save order to database
    // 3. Send confirmation email

    // For this demo, we just clear the cart
    $cart->clear();
    $orderCompleted = true;
}

$cartCount = $cart->getCount();
$cartTotal = $cart->getTotal();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Shopping Cart Example</title>
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
        .nav-links {
            background: #f5f5f5;
            padding: 1rem;
            border-radius: 8px;
            margin: 1rem 0;
        }
        .nav-links a { margin-right: 1rem; }
        .order-summary {
            background: #f9f9f9;
            padding: 1.5rem;
            border-radius: 8px;
            margin: 1rem 0;
        }
        .order-summary ul {
            list-style: none;
            padding: 0;
        }
        .order-summary li {
            padding: 0.5rem 0;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
        }
        .order-total {
            font-size: 1.5rem;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 2px solid #ddd;
        }
        .complete-btn {
            display: inline-block;
            background: #27ae60;
            color: white;
            padding: 1rem 2rem;
            text-decoration: none;
            border-radius: 4px;
            font-size: 1.1rem;
        }
        .complete-btn:hover { background: #219a52; }
        .success-message {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 2rem;
            border-radius: 8px;
            text-align: center;
        }
        .empty-cart {
            text-align: center;
            padding: 2rem;
            background: #f9f9f9;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="back-link">
        <a href="../index.php">&larr; Back to Cookies &amp; Sessions</a>
        <a href="/exercises/03-php-cookies-sessions/03-shopping-cart/checkout.php">Go to Exercise &rarr;</a>
    </div>

    <h1>Checkout</h1>

    <!-- Navigation -->
    <div class="nav-links">
        <a href="products.php">Products</a> |
        <a href="cart.php">View Cart <span class="cart-badge"><?= $cartCount ?></span></a> |
        <strong>Checkout</strong>
    </div>

    <?php if ($orderCompleted): ?>
        <!-- Order Success Message -->
        <div class="success-message">
            <h2>Order Complete!</h2>
            <p>Thank you for your purchase. Your order has been processed.</p>
            <p><a href="products.php">Continue Shopping</a></p>
        </div>
    <?php elseif ($cart->isEmpty()): ?>
        <!-- Empty Cart -->
        <div class="empty-cart">
            <h2>Your cart is empty</h2>
            <p><a href="products.php">Continue shopping</a></p>
        </div>
    <?php else: ?>
        <!-- Order Summary -->
        <div class="order-summary">
            <h2>Order Summary</h2>
            <ul>
                <?php foreach ($cart->getItems() as $item): ?>
                    <li>
                        <span><?= htmlspecialchars($item->name) ?> x <?= $item->quantity ?></span>
                        <span>&euro;<?= number_format($item->getSubtotal(), 2) ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
            <p class="order-total">
                <strong>Total: &euro;<?= number_format($cartTotal, 2) ?></strong>
            </p>
        </div>

        <p>
            <a href="?complete=1" class="complete-btn">Complete Order</a>
        </p>
        <p><a href="cart.php">&larr; Back to Cart</a></p>
    <?php endif; ?>

    <!-- Code Explanation -->
    <h2>How It Works</h2>

    <h3>Getting the Cart Instance</h3>
    <p>The cart instance is stored in the session and retrieved using <code>getInstance()</code>.</p>
    <pre><code class="language-php">$cart = ShoppingCart::getInstance();</code></pre>

    <h3>Checking Cart Status</h3>
    <p>The cart instance provides convenient methods for checking state.</p>
    <pre><code class="language-php">// Check if cart is empty
if ($cart->isEmpty()) {
    echo "Your cart is empty";
}

// Get totals
$count = $cart->getCount();  // Total items
$total = $cart->getTotal();  // Total price</code></pre>

    <h3>Completing the Order</h3>
    <p>When the order is complete, we use <code>$cart->clear()</code> to empty the cart.</p>
    <pre><code class="language-php">if (isset($_GET['complete']) && !$cart->isEmpty()) {
    // Process payment, save order, etc.

    // Clear the cart
    $cart->clear();
    $orderCompleted = true;
}</code></pre>

    <h3>Benefits of Using Instance Methods</h3>
    <ul>
        <li><strong>Object-oriented:</strong> The cart is a proper object stored in the session</li>
        <li><strong>Encapsulation:</strong> Items are stored in a private <code>$items</code> array</li>
        <li><strong>Cleaner code:</strong> <code>$cart->add($product)</code> reads naturally</li>
        <li><strong>Flexibility:</strong> Could support multiple carts (e.g., wishlist) with different instances</li>
    </ul>

    <script src="/examples/js/prism-core.min.js"></script>
    <script src="/examples/js/prism-autoloader.min.js" data-autoloader-path="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/"></script>
</body>
</html>
