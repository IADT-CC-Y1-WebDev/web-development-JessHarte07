<?php

class Publisher {
    public $id;
    public $name;

    private $db;

    public function __construct($data = []) {
        $this->db = DB::getInstance()->getConnection();

        if (!empty($data)) {
            $this->id = $data['id'] ?? null;
            $this->name = $data['name'] ?? null;
        }
    }

    // Find all publishers
    public static function findAll() {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM publishers ORDER BY name");
        $stmt->execute();

        $publishers = [];
        while ($row = $stmt->fetch()) {
            $publishers[] = new Publisher($row);
        }

        return $publishers;
    }

    // Find publisher by ID
    public static function findById($id) {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM publishers WHERE id = :id");
        $stmt->execute(['id' => $id]);

        $row = $stmt->fetch();
        if ($row) {
            return new Publisher($row);
        }

        return null;
    }
    
    // Convert to array for JSON output
    public function toArray() {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
