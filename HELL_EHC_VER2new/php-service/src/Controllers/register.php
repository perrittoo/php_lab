<?php
require_once "../Models/db.php";
require_once "../Models/users.php";
$database = new Database();
$is_pdo = true;
$db = $database->getConnection($is_pdo);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST["username"], $_POST["password"]) && 
    !empty($_POST["username"]) && 
    !empty($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        

        $user = new User($db);
        $user->username = $username;
        $user->password = $password;
        if ($user->checkExist($username)) {
            echo "User already exists!";
            return;
        } else {
            try {
                if ($user->register()) {
                    echo "User created!";
                } else {
                    echo "Something went wrong when creating user!";
                }
            } catch (PDOException $e) {
                echo "Something went wrong when creating user!";
            }
        }
        
        
        
    } else {
        echo "Missing param or something?";
    }
    
    

}