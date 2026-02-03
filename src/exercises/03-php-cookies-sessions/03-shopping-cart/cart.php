<?php
require_once './etc/config.php';

// =============================================================================
// EXERCISE: Shopping Cart - Cart Page
// =============================================================================
// Complete the TODO sections to display and manage the shopping cart.
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

// =============================================================================
// Exercise 3: Handle "Remove from Cart" action
// When $_GET['remove'] is set:
// 1. Get the product ID
// 2. Remove the item from the cart
// 3. Redirect back to cart.php
// -----------------------------------------------------------------------------
// TODO: Write your code here

// =============================================================================

// =============================================================================
// Exercise 4: Handle "Clear Cart" action
// When $_GET['clear'] is set:
// 1. Clear all items from the cart
// 2. Redirect back to cart.php
// -----------------------------------------------------------------------------
// TODO: Write your code here

// =============================================================================

// =============================================================================
// Bonus Exercise: Handle "Update Quantity" action
// When $_GET['update'] and $_GET['qty'] are set:
// 1. Get the product ID and new quantity
// 2. Update the quantity of the item in the cart
// 3. Redirect back to cart.php
// -----------------------------------------------------------------------------
// TODO: Write your code here

// =============================================================================

// Retrieve the cart count and total
$cartTotal = isset($cart) ? $cart->getTotal() : 0;
$cartCount = isset($cart) ? $cart->getCount() : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Shopping Cart Exercise</title>
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
        .empty-cart {
            text-align: center;
            padding: 2rem;
            background: #f9f9f9;
            border-radius: 8px;
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
        <a href="/examples/03-php-cookies-sessions/03-shopping-cart/cart.php">View Example &rarr;</a>
    </div>

    <h1>Shopping Cart Exercise - Cart</h1>

    <!-- Navigation -->
    <div class="nav-bar">
        <a href="products.php">Products</a> |
        <strong>Cart <span class="cart-count"><?= $cartCount ?></span></strong> |
        <a href="checkout.php">Checkout</a>
    </div>

    <!-- Exercise Instructions -->
    <h2>Exercise: Display and Manage Cart</h2>
    <p>
        <strong>Tasks:</strong>
        <ol>
            <li>Complete the remove and clear handlers at the top</li>
            <li>Complete the cart total calculation</li>
            <li>The display code below is provided for you</li>
        </ol>
    </p>

    <!-- Cart Contents -->
    <?php if (!isset($cart) or $cart->isEmpty()): ?>
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
                            <?php
                            // =================================================
                            // Bonus Exercise: Insert Quantity Links 
                            // -------------------------------------------------
                            ?>
                            <span class="qty-links">
                                <?= $item->quantity ?>
                            </span>
                            <?php
                            // =================================================
                            ?>
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

    <!-- Bonus Exercise -->
    <h2>Bonus Exercise: Update Quantity</h2>
    <p>
        <strong>Task:</strong> Add the ability to update item quantities. You'll need to:
        <ol>
            <li>Add a handler for <code>$_GET['update']</code> and <code>$_GET['qty']</code></li>
            <li>Add +/- links in the quantity column of the table</li>
        </ol>
    </p>

</body>
</html>
