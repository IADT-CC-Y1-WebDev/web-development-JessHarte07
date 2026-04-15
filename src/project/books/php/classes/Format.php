<?php

class Format {
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

    // Find all formats
    public static function findAll() {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM formats ORDER BY name");
        $stmt->execute();

        $formats = [];
        while ($row = $stmt->fetch()) {
            $formats[] = new Format($row);
        }

        return $formats;
    }

    // Find format by ID
    public static function findById($id) {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM formats WHERE id = :id");
        $stmt->execute(['id' => $id]);

        $row = $stmt->fetch();
        if ($row) {
            return new Format($row);
        }

        return null;
    }

    public static function findByBook($bookId) {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("
            SELECT f.*
            FROM formats f
            INNER JOIN book_format bf ON f.id = bf.format_id
            WHERE bf.book_id = :book_id
            ORDER BY f.name
        ");
        $stmt->execute(['book_id' => $bookId]);

        $formats = [];
        while ($row = $stmt->fetch()) {
            $formats[] = new Format($row);
        }

        return $formats;
    }

    // Convert to array for JSON output
    public function toArray() {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
