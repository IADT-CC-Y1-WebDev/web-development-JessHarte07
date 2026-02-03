<?php
/**
 * Database Singleton Class
 *
 * This class implements the Singleton pattern to ensure only one
 * database connection is created throughout the application.
 *
 * Usage:
 *   $db = DB::getInstance()->getConnection();
 *   $stmt = $db->prepare("SELECT * FROM games");
 */
class DB
{
    /** @var DB|null The single instance of this class */
    private static $instance = null;

    /** @var PDO The PDO database connection */
    private $connection;

    /**
     * Private constructor - prevents direct instantiation
     * Creates the database connection using settings from config.php
     */
    private function __construct()
    {
        try {
            $this->connection = new PDO(DB_DSN, DB_USER, DB_PASS, DB_OPTIONS);
        } catch (PDOException $e) {
            // In production, you might log this error instead of displaying it
            die("Database connection failed: " . $e->getMessage());
        }
    }

    /**
     * Get the singleton instance
     *
     * @return DB The singleton instance
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Get the PDO connection
     *
     * @return PDO The database connection
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * Prevent cloning of the instance
     */
    private function __clone() {}

    /**
     * Prevent unserialization of the instance
     */
    public function __wakeup()
    {
        throw new Exception("Cannot unserialize a singleton.");
    }
}
