<?php
// =============================================================================
// Exercise 8-10: Book Active Record Class
//
// TODO: Implement this class following the Active Record pattern.
//
// The class should represent the 'books' table with these columns:
// - id (INT, auto-increment primary key)
// - title (VARCHAR)
// - author (VARCHAR)
// - publisher_id (INT, foreign key to publishers table)
// - year (INT)
// - isbn (VARCHAR)
// - description (TEXT)
// - cover_filename (VARCHAR)
//
// Required methods:
// - __construct($data = []) - Hydrate object from data array
// - findAll() - Static method returning all books
// - findById($id) - Static method returning single book or null
// - findByPublisher($publisherId) - Static method returning books by publisher
// - save() - Instance method to INSERT or UPDATE
// - delete() - Instance method to DELETE
// - toArray() - Instance method to convert to array
// =============================================================================
class Book
{
    // public properties for each database column
    public $id;
    public $title;
    public $author;
    public $publisher_id;
    public $year;
    public $isbn;
    public $description;
    public $cover_filename;

    // private $db property for database connection
    private $db;

    // =========================================================================
    // Exercise 8: Book Class Basics
    // =========================================================================
    public function __construct($data = [])
    {
        // TODO: Get database connection from DB singleton
        // TODO: If $data is not empty, populate properties using null coalescing operator
    }

    // =========================================================================
    // Exercise 9: Finder Methods
    // =========================================================================
    public static function findAll()
    {
        // TODO: Implement this method
    }

    // =========================================================================
    // Exercise 9: Finder Methods
    // =========================================================================
    public static function findById($id)
    {
        // TODO: Implement this method
    }

    // =========================================================================
    // Exercise 9: Finder Methods
    // =========================================================================
    public static function findByPublisher($publisherId)
    {
        // TODO: Implement this method
    }

    // =========================================================================
    // Exercise 10: Complete Active Record
    // =========================================================================
    public function save()
    {
        // TODO: Implement this method
    }

    // =========================================================================
    // Exercise 10: Complete Active Record
    // =========================================================================
    public function delete()
    {
        // TODO: Implement this method
    }

    // =========================================================================
    // Exercise 8: Book Class Basics
    // =========================================================================
    public function toArray()
    {
        // TODO: Implement this method
    }
}
