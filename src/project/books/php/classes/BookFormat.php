<?php

class BookFormat {
    // Check if a relationship exists
    public static function exists($bookId, $formatId) {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("
            SELECT COUNT(*) as count
            FROM book_format
            WHERE book_id = :book_id AND format_id = :format_id
        ");
        $stmt->execute([
            'book_id' => $bookId,
            'format_id' => $formatId
        ]);

        $row = $stmt->fetch();
        return $row['count'] > 0;
    }

    // Create a new game-platform relationship
    public static function create($bookId, $formatId) {
        // Check if relationship already exists
        if (self::exists($bookId, $formatId)) {
            return false;
        }

        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("
            INSERT INTO book_format (book_id, format_id)
            VALUES (:book_id, :format_id)
        ");

        return $stmt->execute([
            'book_id' => $bookId,
            'format_id' => $formatId
        ]);
    }

    // Delete a specific game-platform relationship
    public static function remove($bookId, $formatId) {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("
            DELETE FROM book_format
            WHERE book_id = :book_id AND format_id = :format_id
        ");

        return $stmt->execute([
            'book_id' => $bookId,
            'format_id' => $formatId
        ]);
    }

    // Delete all platform relationships for a specific game
    public static function deleteByBook($bookId) {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("
            DELETE FROM book_format
            WHERE book_id = :book_id
        ");
        return $stmt->execute(['book_id' => $bookId]);
    }
}
