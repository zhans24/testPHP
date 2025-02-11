<?php

namespace backend\config;

use PDO;
use PDOException;

class Database
{
    private static $instance = null;
    private $conn;

    private function __construct()
    {
        $host = "localhost";
        $user = "root";
        $pass = "1234";
        $dbname = "test";

        try {
            $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4"; // ✅ Добавлен `charset=utf8mb4`
            $this->conn = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // ✅ Включаем ошибки
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // ✅ Устанавливаем режим выборки
                PDO::ATTR_EMULATE_PREPARES => false, // ✅ Защита от SQL-инъекций
            ]);
        } catch (PDOException $e) {
            die("Ошибка подключения: " . $e->getMessage()); // ✅ Сообщение об ошибке
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance->conn;
    }
}
