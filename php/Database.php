<?php
class Database {
    private static $host = "localhost";
    private static $dbname = "system_rezerwacji";
    private static $user = "";
    private static $password = "";
    private static $pdo = null;

    public static function setCredentials($user, $password) {
        self::$user = $user;
        self::$password = $password;
    }

    public static function connect() {
        if (self::$pdo === null) {
            try {
                $dsn = "pgsql:host=" . self::$host . ";dbname=" . self::$dbname;
                self::$pdo = new PDO($dsn, self::$user, self::$password);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Błąd połączenia z bazą danych: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }

    public static function getConnection() {
        return self::connect();
    }
}
?>
