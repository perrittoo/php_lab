<?php
require_once "../../Models/db.php";
require_once "../../Models/users.php";
session_start();
//connect to db
if (empty($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
    header("Location: /login");
}    
$database = new Database();
$db = $database->getConnection();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['poem_id']) && !empty($_POST['poem_id'])) {
        $id = $_POST['poem_id'];

        # Sanitize the input
        $pattern = "/['\"\s]/";
        $id = preg_replace($pattern , '', $id);
        $user = new User($db);
        $poem = $user->get_poems($id);
        if ($poem) { 
            $poem = $poem[0];
            if ($poem["path"] === null) die();
            $file_path = "../static/" . $poem["path"] . ".txt";
            $poem_content = file_get_contents($file_path);
            $poem_lines = explode("\n", $poem_content); ?>
                
                <div class="poem-container">
                    <div class="poem-title"><?php echo $poem["title"] ?></div>
                    <div class="poem-author"><?php echo $poem["author"] ?></div> 
                    <div class="poem-content">
                        <?php
                        // Output each line of the poem within a paragraph tag
                        foreach ($poem_lines as $line) {
                            echo "<p class='poem-line'>" . htmlspecialchars($line) . "</p>";
                        }
                        ?>
                    </div>
                </div>
            <?php
        } 
    } 
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
    <style>
        
        body {
            font-family: "Dancing Script", cursive;
            font-optical-sizing: auto;
            font-weight: 700;
            font-style: normal;
            background-color: #fafafa;
            color: #333;
            margin: 0;
            padding: 40px;
            line-height: 1.6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .poem-container {
            height: 100vh;
            text-align: center; 
        }

        .poem-title {
            font-size: 3em;
            font-weight: bold;
            color: #4A4A4A;
            margin-bottom: 20px;
        }

        .poem-author {
            font-size: 2em;
            font-style: italic;
            color: #777;
            margin-bottom: 30px;
        }

        .poem-content {
            font-size: 1.5em;
            color: #333;
            white-space: pre-wrap;
        }

        .poem-line {
            margin: 10px 0;
        }
        a {
            font-size: 1.5em;
        }
    </style>
</head>
<body>
    
</body>
</html>