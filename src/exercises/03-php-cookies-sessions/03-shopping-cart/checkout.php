<?php
require_once './etc/config.php';

// =============================================================================
// EXERCISE: Shopping Cart - Checkout Page
// =============================================================================
// Complete the TODO sections to implement the checkout functionality.
// =============================================================================

// =============================================================================
// Exercise 1: Start the session
// -----------------------------------------------------------------------------
// TODO: Write your code here

// =============================================================================

// =============================================================================
// Exercise 2: Initialize the cart
// -----------------------------------------------------------------------------
// TODO: Write your code here

// =============================================================================

// Variable to track if order is complete
$orderCompleted = false;

// =============================================================================
// Exercise 3: Handle "Complete Order" action
// When $_GET['complete'] is set AND the cart is not empty:
// 1. Set $orderCompleted to true
// 2. Clear the cart
// -----------------------------------------------------------------------------
// TODO: Write your code here

// =============================================================================

// Calculate totals
$cartTotal = isset($cart) ? $cart->getTotal() : 0;
$cartCount = isset($cart) ? $cart->getCount() : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Shopping Cart Exercise</title>
    <link rel="stylesheet" href="/exercises/css/style.css">
    <style>
        .nav-bar {
            background: #f5f5f5;
            padding: 1rem;
            border-radius: 8px;
            margin: 1rem 0;
        }
        .nav-bar a { margin-right: 1rem; }
        .cart-count {
            background: #e74c3c;
            color: white;
            border-radius: 50%;
            padding: 0.2rem 0.5rem;
            font-size: 0.8rem;
        }
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
        .complete-btn {
            display: inline-block;
            background: #27ae60;
            color: white;
            padding: 1rem 2rem;
            text-decoration: none;
            border-radius: 4px;
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
        <a href="/examples/03-php-cookies-sessions/03-shopping-cart/checkout.php">View Example &rarr;</a>
    </div>

    <h1>Shopping Cart Exercise - Checkout</h1>

    <!-- Navigation -->
    <div class="nav-bar">
        <a href="products.php">Products</a> |
        <a href="cart.php">Cart <span class="cart-count"><?= $cartCount ?></span></a> |
        <strong>Checkout</strong>
    </div>

    <!-- Exercise Instructions -->
    <h2>Exercise: Complete the Order</h2>
    <p>
        <strong>Task:</strong> Complete the handler at the top of this file to:
        <ol>
            <li>Check if <code>$_GET['complete']</code> is set AND the cart is not empty</li>
            <li>Set <code>$orderCompleted</code> to <code>true</code></li>
            <li>Clear the cart</li>
        </ol>
    </p>

    <?php if ($orderCompleted): ?>
        <!-- Success Message -->
        <div class="success-message">
            <h2>Order Complete!</h2>
            <p>Thank you for your purchase.</p>
            <p><a href="products.php">Continue Shopping</a></p>
        </div>
    <?php elseif (!isset($cart) or $cart->isEmpty()): ?>
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
                        <span>&euro;<?= number_format($item->price * $item->quantity, 2) ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
            <p style="font-size: 1.25rem; margin-top: 1rem;">
                <strong>Total: &euro;<?= number_format($cartTotal, 2) ?></strong>
            </p>
        </div>

        <p>
            <a href="?complete=1" class="complete-btn">Complete Order</a>
        </p>
        <p><a href="cart.php">&larr; Back to Cart</a></p>
    <?php endif; ?>

</body>
</html>
