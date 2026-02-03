<?php

/**
 * Shopping cart that stores items.
 * The cart instance itself is stored in the session.
 */
class ShoppingCart {

    // The session key used to store the cart instance
    private const SESSION_KEY = 'cart';

    // Private array of ShoppingCartItem objects
    private $items = [];

    /**
     * Get the cart instance from the session.
     * Creates a new cart if one doesn't exist.
     */
    public static function getInstance() {
        if (!isset($_SESSION[self::SESSION_KEY])) {
            $_SESSION[self::SESSION_KEY] = new ShoppingCart();
        }
        return $_SESSION[self::SESSION_KEY];
    }

    /**
     * Get all items in the cart.
     */
    public function getItems() {
        return $this->items;
    }

    /**
     * Add a product to the cart.
     * If the product is already in the cart, increase its quantity.
     */
    public function add(Product $product) {
        if (isset($this->items[$product->id])) {
            // Product already in cart - increase quantity
            $this->items[$product->id]->quantity++;
        } else {
            // Add new item
            $this->items[$product->id] = 
                new ShoppingCartItem($product->id, $product->name, $product->price, 1);
        }
    }

    /**
     * Remove an item from the cart by product ID.
     */
    public function remove($productId) {
        if (isset($this->items[$productId])) {
            unset($this->items[$productId]);
        }
    }

    /**
     * Update the quantity of an item.
     * If quantity is 0 or less, the item is removed.
     */
    public function updateQuantity($productId, $quantity) {
        if (isset($this->items[$productId])) {
            if ($quantity > 0) {
                $this->items[$productId]->quantity = $quantity;
            } else {
                $this->remove($productId);
            }
        }
    }

    /**
     * Clear all items from the cart.
     */
    public function clear() {
        $this->items = [];
    }

    /**
     * Check if the cart is empty.
     */
    public function isEmpty() {
        return empty($this->items);
    }

    /**
     * Get the total number of items in the cart.
     */
    public function getCount() {
        $count = 0;
        foreach ($this->items as $item) {
            $count += $item->quantity;
        }
        return $count;
    }

    /**
     * Get the total price of all items in the cart.
     */
    public function getTotal() {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->getSubtotal();
        }
        return $total;
    }
}
