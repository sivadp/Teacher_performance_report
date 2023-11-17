<?php
if (isset($_POST['submit'])) {
    $userName = $_POST['userName'];
    $password = $_POST['password'];
    $pdo = new PDO('mysql:host=localhost;dbname=tpr', 'root', 'Siva@2000');

    // Prepare the SQL query to fetch eno based on the selected year
    $stmt = $pdo->prepare("SELECT * FROM admin_login WHERE adminName = :adminName AND password =:password");
    $stmt->bindParam(':adminName', $userName);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $matchedRow = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($matchedRow) {
        if($matchedRow['adminName']==$userName and $matchedRow['password']==$password){
        header('Location: admin_login.php');
        exit;
        }
    } else {
        header('Location: admin_verify.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        * {
            box-sizing: border-box;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            font-size: 16px;
        }

        body {
            background-color: #435165;
            margin: 0px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .login {
            width: 400px;
            background-color: aliceblue;
            box-shadow: 0 0 9px 0 rgba(0, 0, 0, 0.3);
            margin: 100px auto;
        }

        .login h1 {
            text-align: center;
            color: #5b6574;
            font-size: 24px;
            padding: 20px 0 20px 0;
            border-bottom: 1px solid #dee0e4;
        }

        .login form {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding-top: 20px;
        }

        .login form label {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 50px;
            height: 50px;
            background-color: #3274d6;
            color: #ffffff;
            font-size: 22px;
        }

        .login form input[type="password"],
        .login form input[type="text"] {
            width: 310px;
            height: 50px;
            border: 1px solid #dee0e4;
            margin-bottom: 20px;
            padding: 0 15px;
        }

        .login form input[type="submit"] {
            width: 100%;
            padding: 15px;
            margin-top: 20px;
            background-color: #3274d6;
            border: 0;
            cursor: pointer;
            font-weight: bold;
            color: #ffffff;
            transition: background-color 0.2s;
        }

        .login form input[type="submit"]:hover {
            background-color: #2868c7;
            transition: background-color 0.2s;
        }
        @media screen and (max-width: 600px) {
            body {
                top: 30%;
            }
        }
    </style>
</head>

<body>
    <div class="login">
        <h1>Admin Login</h1>
        <form method="POST">
            <label for="userName">
                <i class="fa fa-regular fa-user"></i>
            </label>
            <input type="text" name="userName" placeholder="Admin Name" required>
            <label for="password">
                <i class="fa fa-lock"></i>
            </label>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="login" name="submit">
        </form>
    </div>

</html>