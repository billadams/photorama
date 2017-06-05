<?php
class Database {
    private static $dsn = DB_DSN;
    private static $db_username = DB_USERNAME;
    private static $db_password = DB_PASSWORD;
    private static $db;

    private function __construct() {}

    public static function DBConnect() {
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO(self::$dsn, self::$db_username, self::$db_password);
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                include('errors/database_error.php');
                exit();
            }
        }

        return self::$db;
    }
}
