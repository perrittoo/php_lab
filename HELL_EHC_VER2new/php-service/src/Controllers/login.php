<?php
require_once "../Models/db.php";
require_once "../Models/users.php";
session_start();
//connect to db
$is_pdo = true;
$database = new Database();
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
        
        try {
            if ($user->login()) {
                $_SESSION["username"] = $username;
                if ($user->getRole()) {
                    $_SESSION["role"] = "admin";
                    header("Location: /admin");
                } else {
                    $_SESSION["role"] = "user";
                    header("Location: /flag");
                }
            } else {
                echo "Login failed!";
            }
        } catch (PDOException $e) {
            echo "Something went wrong when logging in!";
        } 
        
        
    } else {
        echo "Login failed due to missing information";
    }
    
}

