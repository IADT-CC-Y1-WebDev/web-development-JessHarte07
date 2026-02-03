<?php

/**
 * Represents an item in the shopping cart.
 * Stores the product ID, name, price, and quantity.
 */
class ShoppingCartItem {

    // Public properties
    public $productId;
    public $name;
    public $price;
    public $quantity;

    /**
     * Create a new cart item.
     */
    public function __construct($productId, $name, $price, $quantity = 1) {
        $this->productId = $productId;
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
    }

    /**
     * Calculate the subtotal for this item.
     */
    public function getSubtotal() {
        return $this->price * $this->quantity;
    }
}
