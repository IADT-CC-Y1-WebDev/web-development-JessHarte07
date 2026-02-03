<?php
require_once 'etc/config.php';

// =============================================================================
// EXERCISE: Shopping Cart - Products Page
// =============================================================================
// Complete the TODO sections to implement a shopping cart using sessions.
// =============================================================================

// =============================================================================
// Exercise 1: Start the session
// -----------------------------------------------------------------------------
// TODO: Write your code here

// =============================================================================

// Create products (they auto-register via the Registry pattern)
new Product(1, 'T-Shirt', 19.99, 'Cotton t-shirt');
new Product(2, 'Jeans', 49.99, 'Classic blue jeans');
new Product(3, 'Sneakers', 79.99, 'Comfortable sneakers');
new Product(4, 'Hat', 14.99, 'Baseball cap');

// =============================================================================
// Exercise 2: Initialize the cart
// -----------------------------------------------------------------------------
// TODO: Write your code here
 
// =============================================================================

// =============================================================================
// Exercise 3: Handle "Add to Cart" action
// When $_GET['add'] is set:
// 1. Get the product ID from $_GET['add'] (convert to integer)
// 2. Check if this product exists in $products
// 3. If it exists, add it to the cart
// 4. Redirect back to products.php
// -----------------------------------------------------------------------------
// TODO: Write your code here

// =============================================================================

// Calculate cart count (this is provided for you)
$cartCount = isset($cart) ? $cart->getCount() : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Shopping Cart Exercise</title>
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
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 1rem;
            margin: 1rem 0;
        }
        .product-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 1rem;
            text-align: center;
        }
        .product-price {
            font-size: 1.2rem;
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
    </style>
</head>
<body>
    <div class="back-link">
        <a href="../index.php">&larr; Back to Cookies &amp; Sessions</a>
        <a href="/examples/03-php-cookies-sessions/03-shopping-cart/products.php">View Example &rarr;</a>
    </div>

    <h1>Shopping Cart Exercise - Products</h1>

    <!-- Navigation -->
    <div class="nav-bar">
        <strong>Products</strong> |
        <a href="cart.php">Cart <span class="cart-count"><?= $cartCount ?></span></a> |
        <a href="checkout.php">Checkout</a>
    </div>

    <!-- Exercise Instructions -->
    <h2>Exercise: Add to Cart</h2>
    <p>
        <strong>Task:</strong> Complete the PHP code at the top of this file to handle
        the "Add to Cart" action. When a user clicks "Add to Cart":
        <ol>
            <li>Get the product ID from <code>$_GET['add']</code></li>
            <li>Check if the product exists</li>
            <li>Add it to <code>$_SESSION['cart']</code> (or increase quantity)</li>
            <li>Redirect back to this page</li>
        </ol>
    </p>

    <!-- Product Grid -->
    <h2>Products</h2>
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

    <!-- Debug: Show Session Contents -->
    <h2>Debug: Session Contents</h2>
    <p>This shows what's currently in your session (for debugging):</p>
    <div class="output">
        <pre><?php
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            print_r($_SESSION['cart']);
        } else {
            echo "Cart is empty";
        }
        ?></pre>
    </div>

</body>
</html>
