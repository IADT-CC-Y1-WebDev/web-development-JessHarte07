<?php

class Platform {
    public $id;
    public $name;
    public $manufacturer;

    private $db;

    public function __construct($data = []) {
        $this->db = DB::getInstance()->getConnection();

        if (!empty($data)) {
            $this->id = $data['id'] ?? null;
            $this->name = $data['name'] ?? null;
            $this->manufacturer = $data['manufacturer'] ?? null;
        }
    }

    // Find all platforms
    public static function findAll() {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM platforms ORDER BY name");
        $stmt->execute();

        $platforms = [];
        while ($row = $stmt->fetch()) {
            $platforms[] = new Platform($row);
        }

        return $platforms;
    }

    // Find platform by ID
    public static function findById($id) {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM platforms WHERE id = :id");
        $stmt->execute(['id' => $id]);

        $row = $stmt->fetch();
        if ($row) {
            return new Platform($row);
        }

        return null;
    }

    // Find platforms by book (requires JOIN with book_platform table)
    public static function findByBook($bookId) {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("
            SELECT p.*
            FROM platforms p
            INNER JOIN book_platform gp ON p.id = gp.platform_id
            WHERE gp.book_id = :book_id
            ORDER BY p.name
        ");
        $stmt->execute(['book_id' => $bookId]);

        $platforms = [];
        while ($row = $stmt->fetch()) {
            $platforms[] = new Platform($row);
        }

        return $platforms;
    }
    
    // Convert to array for JSON output
    public function toArray() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'manufacturer' => $this->manufacturer
        ];
    }
}
