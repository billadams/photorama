<?php
class Database {
    private static $dsn = 'mysql:host=localhost;port=3307;dbname=photorama';
    private static $db_username = 'root';
    private static $db_password = '';
    private static $db;

    private function __construct() {}

    public static function DBConnect() {
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO(self::$dsn, self::$db_username, self::$db_password);
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                include('../views/database_error.php');
                exit();
            }
        }

        return self::$db;
    }
}
