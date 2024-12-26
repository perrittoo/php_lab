<?php
class Database {
    public $conn;


    // Kết nối cơ sở dữ liệu
    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = pg_connect("host=postgresdb port=5432 dbname=hell_ehc user=ehc_child password=password");
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}


