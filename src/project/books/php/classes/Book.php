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
        }
    }

    // Find all books
    public static function findAll() {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM books ORDER BY title");
        $stmt->execute();

        $books = [];
        while ($row = $stmt->fetch()) {
            $books[] = new Book($row);
        }

        return $books;
    }

    // Find book by ID
    public static function findById($id) {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM books WHERE id = :id");
        $stmt->execute(['id' => $id]);

        $row = $stmt->fetch();
        if ($row) {
            return new Book($row);
        }

        return null;
    }

    // Find books by author
    public static function findByGenre($author) {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM books WHERE author = :author ORDER BY title");
        $stmt->execute(['author' => $author]);

        $books = [];
        while ($row = $stmt->fetch()) {
            $books[] = new Book($row);
        }

        return $books;
    }

    // Find book by platform (requires JOIN with GamePlatforms table)
    public static function findByPlatform($platformId) {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("
            SELECT g.*
            FROM books g
            INNER JOIN book_platform gp ON g.id = gp.book_id
            WHERE gp.platform_id = :platform_id
            ORDER BY g.title
        ");
        $stmt->execute(['platform_id' => $platformId]);

        $books = [];
        while ($row = $stmt->fetch()) {
            $books[] = new Book($row);
        }

        return $books;
    }

    // Save (insert or update)
    public function save() {
        if ($this->id) {
            // Update existing record
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
        } 
        else {
            // Insert new record
            $stmt = $this->db->prepare("
                INSERT INTO books (title, author, publisher_id, year, isbn, description, cover_filename)
                VALUES (:title, :author, :publisher_id, :year, :isbn, :description, :cover_filename)
            ");

            $params = [
                'title' => $this->title,
                'author' => $this->author,
                'publisher_id' => $this->publisher_id,
                'year' => $this->year,
                'isbn' => $this->isbn,
                'description' => $this->description,
                'cover_filename' => $this->cover_filename,
            ];
        }
        // Execute statement
        $status = $stmt->execute($params);

        // Check for errors
        if (!$status) {
            $error_info = $stmt->errorInfo();
            $message = sprintf(
                "SQLSTATE error code: %d; error message: %s",
                $error_info[0],
                $error_info[2]
            );
            throw new Exception($message);  
        }

        // Ensure one row affected
        if ($stmt->rowCount() !== 1) {
            throw new Exception("Failed to save book.");
        }

        // Set ID for new records
        if ($this->id === null) {
            $this->id = $this->db->lastInsertId();
        }
    }

    // Delete
    public function delete() {
        if (!$this->id) {
            return false;
        }

        $stmt = $this->db->prepare("DELETE FROM books WHERE id = :id");
        return $stmt->execute(['id' => $this->id]);
    }

    // Convert to array for JSON output
    public function toArray() {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'author' => $this->author,
            'description' => $this->description,
            'cover_filename' => $this->cover_filename
        ];
    }
}
