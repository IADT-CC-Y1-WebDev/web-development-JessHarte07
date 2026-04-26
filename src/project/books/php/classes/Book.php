<?php

class Book {
    public $id;
    public $title;
    public $author;
    public $publisher_id;
    public $year;
    public $isbn;
    public $description;
    public $cover_filename;
    public $format_ids;

    private $db;

    public function __construct($data = []) {
        $this->db = DB::getInstance()->getConnection();

        if (!empty($data)) {
            $this->id = $data['id'] ?? null;
            $this->title = $data['title'] ?? null;
            $this->author = $data['author'] ?? null;
            $this->publisher_id = $data['publisher_id'] ?? null;
            $this->year = $data['year'] ?? null;
            $this->isbn = $data['isbn'] ?? null;
            $this->description = $data['description'] ?? null;
            $this->cover_filename = $data['cover_filename'] ?? null;
            $this->format_ids = $data['format_ids'] ?? '';
        }
    }

    // GET ALL BOOKS + FORMATS
    public static function findAll() {
        $db = DB::getInstance()->getConnection();

        $stmt = $db->prepare("
            SELECT 
                books.*,
                GROUP_CONCAT(book_format.format_id SEPARATOR ',') AS format_ids
            FROM books
            LEFT JOIN book_format
                ON books.id = book_format.book_id
            GROUP BY books.id
            ORDER BY books.title
        ");

        $stmt->execute();

        $books = [];
        while ($row = $stmt->fetch()) {
            $books[] = new Book($row);
        }

        return $books;
    }

    // FIND BY ID + FORMATS
    public static function findById($id) {
        $db = DB::getInstance()->getConnection();

        $stmt = $db->prepare("
            SELECT 
                books.*,
                GROUP_CONCAT(book_format.format_id SEPARATOR ',') AS format_ids
            FROM books
            LEFT JOIN book_format
                ON books.id = book_format.book_id
            WHERE books.id = :id
            GROUP BY books.id
        ");

        $stmt->execute(['id' => $id]);

        $row = $stmt->fetch();
        return $row ? new Book($row) : null;
    }

    // SAVE BOOK
    public function save() {
        if ($this->id) {

            $stmt = $this->db->prepare("
                UPDATE books
                SET title = :title,
                    author = :author,
                    publisher_id = :publisher_id,
                    year = :year,
                    isbn = :isbn,
                    description = :description,
                    cover_filename = :cover_filename
                WHERE id = :id
            ");

            $params = [
                'title' => $this->title,
                'author' => $this->author,
                'publisher_id' => $this->publisher_id,
                'year' => $this->year,
                'isbn' => $this->isbn,
                'description' => $this->description,
                'cover_filename' => $this->cover_filename,
                'id' => $this->id
            ];
        } else {

            $stmt = $this->db->prepare("
                INSERT INTO books 
                (title, author, publisher_id, year, isbn, description, cover_filename)
                VALUES 
                (:title, :author, :publisher_id, :year, :isbn, :description, :cover_filename)
            ");

            $params = [
                'title' => $this->title,
                'author' => $this->author,
                'publisher_id' => $this->publisher_id,
                'year' => $this->year,
                'isbn' => $this->isbn,
                'description' => $this->description,
                'cover_filename' => $this->cover_filename
            ];
        }

        $stmt->execute($params);

        if (!$this->id) {
            $this->id = $this->db->lastInsertId();
        }
    }

    // DELETE BOOK
    public function delete() {
        if (!$this->id) return false;

        $stmt = $this->db->prepare("DELETE FROM books WHERE id = :id");
        return $stmt->execute(['id' => $this->id]);
    }

    // ARRAY OUTPUT
    public function toArray() {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'author' => $this->author,
            'publisher_id' => $this->publisher_id,
            'year' => $this->year,
            'isbn' => $this->isbn,
            'description' => $this->description,
            'cover_filename' => $this->cover_filename,
            'format_ids' => $this->format_ids
        ];
    }
}