<?php

/**
 * Product class with Registry pattern.
 * All products are stored in a static array and can be retrieved by ID.
 */
class Product {

    // Registry: static array to store all products
    private static $products = [];

    /**
     * Get all registered products.
     */
    public static function findAll() {
        return self::$products;
    }

    /**
     * Find a product by its ID.
     */
    public static function findById($id) {
        if (array_key_exists($id, self::$products)) {
            return self::$products[$id];
        }
        return null;
    }

    // Public properties (no getters/setters needed)
    public $id;
    public $name;
    public $price;
    public $description;

    /**
     * Create a new product and register it.
     */
    public function __construct($id, $name, $price, $description = '') {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;

        // Register this product in the static array
        self::$products[$id] = $this;
    }
}
