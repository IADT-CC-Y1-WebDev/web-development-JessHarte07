<?php

class Game {
    public $id;
    public $title;
    public $release_date;
    public $genre_id;
    public $description;
    public $image_filename;

    private $db;

    public function __construct($data = []) {
        $this->db = DB::getInstance()->getConnection();

        if (!empty($data)) {
            $this->id = $data['id'] ?? null;
            $this->title = $data['title'] ?? null;
            $this->release_date = $data['release_date'] ?? null;
            $this->genre_id = $data['genre_id'] ?? null;
            $this->description = $data['description'] ?? null;
            $this->image_filename = $data['image_filename'] ?? null;
        }
    }

    // Find all games
    public static function findAll() {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM games ORDER BY title");
        $stmt->execute();

        $games = [];
        while ($row = $stmt->fetch()) {
            $games[] = new Game($row);
        }

        return $games;
    }

    // Find game by ID
    public static function findById($id) {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM games WHERE id = :id");
        $stmt->execute(['id' => $id]);

        $row = $stmt->fetch();
        if ($row) {
            return new Game($row);
        }

        return null;
    }

    // Find games by genre
    public static function findByGenre($genreId) {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM games WHERE genre_id = :genre_id ORDER BY title");
        $stmt->execute(['genre_id' => $genreId]);

        $games = [];
        while ($row = $stmt->fetch()) {
            $games[] = new Game($row);
        }

        return $games;
    }

    // Find games by platform (requires JOIN with GamePlatforms table)
    public static function findByPlatform($platformId) {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("
            SELECT g.*
            FROM games g
            INNER JOIN game_platform gp ON g.id = gp.game_id
            WHERE gp.platform_id = :platform_id
            ORDER BY g.title
        ");
        $stmt->execute(['platform_id' => $platformId]);

        $games = [];
        while ($row = $stmt->fetch()) {
            $games[] = new Game($row);
        }

        return $games;
    }

    // Save (insert or update)
    public function save() {
        if ($this->id) {
            // Update existing record
            $stmt = $this->db->prepare("
                UPDATE games
                SET title = :title,
                    release_date = :release_date,
                    genre_id = :genre_id,
                    description = :description,
                    image_filename = :image_filename
                WHERE id = :id
            ");

            $params = [
                'title' => $this->title,
                'release_date' => $this->release_date,
                'genre_id' => $this->genre_id,
                'description' => $this->description,
                'image_filename' => $this->image_filename,
                'id' => $this->id
            ];
        } 
        else {
            // Insert new record
            $stmt = $this->db->prepare("
                INSERT INTO games (title, release_date, genre_id, description, image_filename)
                VALUES (:title, :release_date, :genre_id, :description, :image_filename)
            ");

            $params = [
                'title' => $this->title,
                'release_date' => $this->release_date,
                'genre_id' => $this->genre_id,
                'description' => $this->description,
                'image_filename' => $this->image_filename
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
            throw new Exception("Failed to save game.");
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

        $stmt = $this->db->prepare("DELETE FROM games WHERE id = :id");
        return $stmt->execute(['id' => $this->id]);
    }

    // Convert to array for JSON output
    public function toArray() {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'release_date' => $this->release_date,
            'genre_id' => $this->genre_id,
            'description' => $this->description,
            'image_filename' => $this->image_filename
        ];
    }
}
