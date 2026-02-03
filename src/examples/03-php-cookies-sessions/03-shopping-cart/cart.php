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

// Handle "Remove from Cart" action
if (isset($_GET['remove'])) {
    $cart->remove((int)$_GET['remove']);
    header('Location: cart.php');
    exit;
}

// Handle "Update Quantity" action
if (isset($_GET['update']) && isset($_GET['qty'])) {
    $cart->updateQuantity((int)$_GET['update'], (int)$_GET['qty']);
    header('Location: cart.php');
    exit;
}

// Handle "Clear Cart" action
if (isset($_GET['clear'])) {
    $cart->clear();
    header('Location: cart.php');
    exit;
}

// Retrieve the cart count and total
$cartCount = $cart->getCount();
$cartTotal = $cart->getTotal();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Shopping Cart Example</title>
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
        .cart-table {
            width: 100%;
            border-collapse: collapse;
            margin: 1rem 0;
        }
        .cart-table th, .cart-table td {
            padding: 0.75rem;
            border: 1px solid #ddd;
            text-align: left;
        }
        .cart-table th { background: #f5f5f5; }
        .cart-total {
            font-size: 1.25rem;
            text-align: right;
            margin: 1rem 0;
        }
        .qty-links a {
            display: inline-block;
            width: 24px;
            height: 24px;
            line-height: 24px;
            text-align: center;
            background: #eee;
            text-decoration: none;
            border-radius: 4px;
        }
        .qty-links a:hover { background: #ddd; }
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
        <a href="/exercises/03-php-cookies-sessions/03-shopping-cart/cart.php">Go to Exercise &rarr;</a>
    </div>

    <h1>Your Shopping Cart</h1>

    <!-- Navigation -->
    <div class="nav-links">
        <a href="products.php">Products</a> |
        <strong>View Cart <span class="cart-badge"><?= $cartCount ?></span></strong> |
        <a href="checkout.php">Checkout</a>
    </div>

    <!-- Cart Contents -->
    <?php if ($cart->isEmpty()): ?>
        <div class="empty-cart">
            <h2>Your cart is empty</h2>
            <p><a href="products.php">Continue shopping</a></p>
        </div>
    <?php else: ?>
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart->getItems() as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item->name) ?></td>
                        <td>&euro;<?= number_format($item->price, 2) ?></td>
                        <td>
                            <span class="qty-links">
                                <a href="?update=<?= $item->productId ?>&qty=<?= $item->quantity - 1 ?>">-</a>
                                <strong><?= $item->quantity ?></strong>
                                <a href="?update=<?= $item->productId ?>&qty=<?= $item->quantity + 1 ?>">+</a>
                            </span>
                        </td>
                        <td>&euro;<?= number_format($item->getSubtotal(), 2) ?></td>
                        <td><a href="?remove=<?= $item->productId ?>">Remove</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <p class="cart-total">
            <strong>Total: &euro;<?= number_format($cartTotal, 2) ?></strong>
        </p>

        <p>
            <a href="checkout.php">Proceed to Checkout</a> |
            <a href="?clear=1">Clear Cart</a>
        </p>
    <?php endif; ?>

    <!-- Code Explanation -->
    <h2>How It Works</h2>

    <h3>Getting the Cart Instance</h3>
    <p>First, we get the cart instance from the session.</p>
    <pre><code class="language-php">$cart = ShoppingCart::getInstance();</code></pre>

    <h3>Removing Items</h3>
    <p>The cart instance provides a simple <code>remove()</code> method.</p>
    <pre><code class="language-php">// Handle "Remove from Cart" via URL: ?remove=1
if (isset($_GET['remove'])) {
    $cart->remove((int)$_GET['remove']);
    header('Location: cart.php');
    exit;
}</code></pre>

    <h3>Updating Quantities</h3>
    <p>The <code>updateQuantity()</code> method handles both updates and auto-removal when quantity reaches 0.</p>
    <pre><code class="language-php">// Handle quantity update via URL: ?update=1&qty=3
if (isset($_GET['update']) && isset($_GET['qty'])) {
    $cart->updateQuantity((int)$_GET['update'], (int)$_GET['qty']);
    header('Location: cart.php');
    exit;
}</code></pre>

    <h3>Displaying Cart Items</h3>
    <p>We loop through the items using the public properties and <code>getSubtotal()</code> method.</p>
    <pre><code class="language-php">foreach ($cart->getItems() as $item) {
    echo $item->name;
    echo $item->price;
    echo $item->quantity;
    echo $item->getSubtotal();
}</code></pre>

    <script src="/examples/js/prism-core.min.js"></script>
    <script src="/examples/js/prism-autoloader.min.js" data-autoloader-path="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/"></script>
</body>
</html>
