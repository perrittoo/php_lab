<?php
session_start();
if (empty($_SESSION["username"])) {
    header("Location: login.html");
}   
define('FLAG', 'flag{This_is_not_the_flag_you_are_looking_for}');
if (!isset($_SESSION['random_number'])) {
    $_SESSION['random_number'] = rand(1, 10);
}

$randomNumber = $_SESSION['random_number'];
$feedback = "";
$showSource = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userInput = (int)$_POST['user_input'];

    if ($userInput === $randomNumber) {
        $feedback = "Chúc mừng! Bạn đã đoán đúng số $randomNumber.";
        $showSource = true;
    } else {
        $feedback = "Số bạn nhập không đúng. Hãy thử lại!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Are you trolling me?</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        h1 {
            color: #2c3e50;
        }

        p {
            font-size: 1.2em;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        label, input, button {
            font-size: 1.1em;
        }

        input {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2980b9;
        }

        .feedback {
            font-size: 1.2em;
            margin-top: 20px;
            font-weight: bold;
        }

        .success {
            color: green;
        }

        .error {
            color: red;
        }

        h2 {
            margin-top: 30px;
            font-size: 1.5em;
            color: #16a085;
        }

        pre {
            background-color: #ecf0f1;
            padding: 20px;
            border-radius: 8px;
            overflow-x: auto;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
    </style>
</head>
<body>
    <h1>Welcome home!</h1>
    <h1>Vị huynh đài rảnh không, ngồi đây chơi đoán số với ta!</h1>
    <h3>Đoán số từ 1 đến 10</h3>

    <form method="POST" action="">
        <label for="user_input">Nhập số:</label>
        <input type="number" id="user_input" name="user_input" min="1" max="100" required>
        <button type="submit">Kiểm tra</button>
    </form>

    <p><?php echo $feedback; ?></p>

    <?php
    if ($showSource) {
        highlight_file(__FILE__);
    }
    ?>
</body>
</html>