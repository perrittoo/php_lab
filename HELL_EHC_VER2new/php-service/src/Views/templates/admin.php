<?php
require_once "../../Models/db.php";
require_once "../../Models/users.php";
session_start();
if (empty($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
    header("Location: login.html");
}    
$database = new Database();
$db = $database->getConnection();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read Poem</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-family: "Dancing Script", cursive;
            font-optical-sizing: auto;
            font-weight: 700;
            font-style: normal;
            font-size: 1.5em;
            background-color: #f0f0f0;
            color: #333;
            margin: 0;
            padding: 20px;

        }

        /* Form styling */
        form {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        form label {
            margin-bottom: 10px;
            display: block;
        }

        form select, form input[type="text"] {
            font-family: "Dancing Script", cursive;
            font-optical-sizing: auto;
            font-weight: 700;
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
        }

        form input[type="submit"] {
            font-family: "Dancing Script", cursive;
            font-optical-sizing: auto;
            font-weight: 700;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
        }

        form input[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Heading and paragraph styling */
        h1 {
            font-size: 2em;
            color: #333;
            margin-bottom: 15px;
            text-align: center;
        }

        h3 {
            font-size: 1.5em;
            color: #555;
            margin-bottom: 10px;
            text-align: center;
        }

        p {
            font-size: 1.1em;
            color: #666;
            line-height: 1.6;
            background-color: white;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }


    </style>
</head>
    <h3>Các vị huynh đài vào đây ngâm thơ với ta!</h3>
    <form method="POST" action="read_poem">
        <label for="poem_id">Choose poems:</label>
        <select id="poem_id" name="poem_id" required>
            <?php
                $user = new User($db);
                $poems = $user->get_poems();
                if ($poems) {
                    foreach ($poems as $poem) {
                        echo "<option value='" . $poem["id"] . "'>" . $poem['title'] . " của " . $poem["author"] . "</option>";
                    }
                }
            ?>
        </select>

        <input type="submit"></input>
    </form>

</body>
</html>

