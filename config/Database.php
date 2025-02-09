<?php

class Database {
//единственный экземпляр класса Database
    private static $instance=null;
    private $conn;
    public function __construct()
    {
        $host = "localhost";
         $user = "root";
         $pass = "1234";
         $dbname = "test";

        try {
            $this->conn = new PDO(`mysql:host=$host;dbname=$dbname`, $user, $pass);
        }catch (PDOexception $e) {
            die($e->getMessage());
        }
    }
    public static function getInstance(){
        if (self::$instance==null) {
            self::$instance = new self();
        }
        return self::$instance->conn;
    }
}

