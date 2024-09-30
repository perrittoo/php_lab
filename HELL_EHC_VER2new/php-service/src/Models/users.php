<?php
ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
error_reporting(0);
class User {
    private $conn;
    private $table_name = "users";
    public $username;
    public $password;

    CONST SALT = 'customsalthere1234567890';

    public $admin_username = 'administrator';
    public $admin_password = 'REDACTED';

    public function __construct($db) {
        $this->conn = $db;
    }

    // Tạo người dùng mới
    public function register() {
        $username = $this->useless($this->username);
        $password = $this->useless($this->password);

        $hash_password = password_hash($password, PASSWORD_BCRYPT, ['salt' => self::SALT]);

        $query = "INSERT INTO " . $this->table_name . "(username, password) VALUES (:username,:password);";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $hash_password);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }


    public function login() {
        $username = $this->useless($this->username);
        $password = $this->useless($this->password);

        $hash_password = password_hash($password, PASSWORD_BCRYPT, ['salt' => self::SALT]);

        $query = "SELECT * FROM " . $this->table_name . " WHERE username=:username AND password=:password";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $hash_password);

        $stmt->execute();
        $num = $stmt->rowCount();
        if ($num == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function getRole() {
        if ($this->username === $this->admin_username && $this->password === $this->admin_password) {
            return true;
        } else {
            return false;
        }
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

    // might be a useless function
    public function useless($format_string) {
        $result = '';
        
        while (strpos($format_string, '{{') !== false) {
            $start = strpos($format_string, '{{') + 2;
            $end = strpos($format_string, '}}', $start);
            
            if ($end === false) {
                throw new Exception("Invalid Format String");
            }
            
            $result .= substr($format_string, 0, $start - 2);
            $field = trim(substr($format_string, $start, $end - $start));

            // Check if the field exists and is a public property
            if (property_exists($this, $field)) {
                $value = $this->{$field}; // Get the value of the property
                if (is_string($value)) {
                    $result .= $value;
                } else {
                    throw new Exception("Field not found or not a string");
                }
            } else {
                throw new Exception("Field not found");
            }
            
            // Trim the processed part of the string
            $format_string = substr($format_string, $end + 2);
        }
        
        // Append the remaining part of the string
        $result .= $format_string;

        return $result;
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