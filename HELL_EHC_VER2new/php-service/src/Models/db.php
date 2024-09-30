<?php
class Database {
    public $conn;


    // Kết nối cơ sở dữ liệu
    public function getConnection($is_pdo = false) {
        $this->conn = null;
        try {
            if ($is_pdo) {
                $this->conn = new PDO("pgsql:host=postgresdb;port=5432;dbname=hell_ehc_ver2", "ehc_child", "password");
            } else {
                $this->conn = pg_connect("host=postgresdb port=5432 dbname=hell_ehc_ver2 user=ehc_child password=password");
            }
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}


