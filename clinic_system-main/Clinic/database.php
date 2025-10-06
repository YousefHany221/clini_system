<?php
include __DIR__ . '/../config/database.php';

class Database
{
    private static ?Database $instance = null;
    private PDO $connection;

    private function __construct( $config)
    {
        try {
            $dsn = "mysql:host={$config['host']};dbname={$config['dbName']}";
            $this->connection = new PDO($dsn, $config['user'], $config['password']);
            echo "success";
        } catch (PDOException $ex) {
            die("Database connection failed: " . $ex->getMessage());
        }
    }

    public static function get_instance($config): ?self
    {
        if (self::$instance == null) {
            self::$instance = new self($config);
        }
        return self::$instance;
    }

    public function get_connection(): PDO
    {
        return $this->connection;
    }
}

$db = Database::get_instance($config);