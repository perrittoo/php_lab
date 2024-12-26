<?php
ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
error_reporting(0);
class User {
    private $conn;
    public function __construct($db) {
        $this->conn = $db;
    }


    public function checkExist($username) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE username=:username;";
        $stmt = $this->conn->prepare($query);

        // sanitize
        // bind values
        $stmt->bindParam(":username", $username);

        $stmt->execute();
        $num = $stmt->rowCount();
        if ($num > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_poems($id = "") {
        $query = "SELECT * FROM poems";
        if ($id != null) {
            $query .= " WHERE id=$id";
        } 
        $res = pg_query($this->conn, $query);

        if ($res > 0) {
            $array = array();
            while ($row = pg_fetch_assoc($res)) {
                extract($row);
                array_push($array, $row);
            }
            return $array;
        } else {
            return false;
        }
    }
    
}