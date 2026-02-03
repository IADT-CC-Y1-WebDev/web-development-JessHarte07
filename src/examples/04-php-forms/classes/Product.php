<?php

class Product {
    private static $products = [];
    private static $nextId = 1;

    public static function findAll() {
        return self::$products;
    }

    public static function findById($id) {
        return self::$products[$id] ?? null;
    }

    public static function init() {
        // Pre-populate with sample products
        $product1 = new Product();
        $product1->title = 'Laptop Pro 15';
        $product1->price = 999.99;
        $product1->description = 'A powerful laptop with 16GB RAM and 512GB SSD storage. Perfect for developers and designers.';
        $product1->category_id = 1;
        $product1->feature_ids = [1, 3];
        $product1->image_filename = 'laptop.jpg';
        $product1->save();

        $product2 = new Product();
        $product2->title = 'Classic T-Shirt';
        $product2->price = 29.99;
        $product2->description = 'Comfortable cotton t-shirt available in multiple colors. Machine washable.';
        $product2->category_id = 2;
        $product2->feature_ids = [1];
        $product2->image_filename = 'tshirt.jpg';
        $product2->save();

        $product3 = new Product();
        $product3->title = 'PHP Programming Guide';
        $product3->price = 49.99;
        $product3->description = 'Comprehensive guide to PHP programming covering basics to advanced topics including OOP and databases.';
        $product3->category_id = 3;
        $product3->feature_ids = [1, 2];
        $product3->image_filename = 'book.jpg';
        $product3->save();
    }

    public $id;
    public $title;
    public $price;
    public $description;
    public $category_id;
    public $feature_ids = [];
    public $image_filename;

    public function __construct() {
        // ID is assigned when save() is called
    }

    public function save() {
        if ($this->id === null) {
            $this->id = self::$nextId++;
        }
        self::$products[$this->id] = $this;
    }

    public function delete() {
        if (array_key_exists($this->id, self::$products)) {
            unset(self::$products[$this->id]);
        }
    }
}
