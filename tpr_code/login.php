<?php
require_once 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

// Load the Excel file into a PhpSpreadsheet object
$spreadsheet = IOFactory::load('Teaching.xlsx');

// Get the data from the first worksheet
$worksheet = $spreadsheet->getActiveSheet();
$data = $worksheet->toArray();
// Check if the login form was submitted
if (isset($_POST['submit'])) {
    // Get the email and password input values
    $Aadhar = $_POST['Aadhar'];
    $clg = $_POST['clg_name'];

    // Loop through the data array, starting from row 1 (skip the header row)
    for ($row = 1; $row <= count($data); $row++) {
        // Check if the E.No matches the current row in the Excel file
        if ($data[$row][11] == $Aadhar) {
            // The E.No matches - retrieve the whole row
            $matchedRow = $data[$row];
            $user_details = array(
                'SNo' => $matchedRow[0],
                'ENo' => $matchedRow[1],
                'name' => $matchedRow[2],
                'Dept' => $matchedRow[3],
                'gender' => $matchedRow[4],
                'cat' => $matchedRow[5],
                'pos' => $matchedRow[6],
                'dob' => $matchedRow[7],
                'doj' => $matchedRow[8],
                'HQ' => $matchedRow[9],
                'PAN' => $matchedRow[10],
                'Aadhar' => $matchedRow[11],
                'ph_no' => $matchedRow[12],
                'email' => $matchedRow[13],
                'clg' => $clg
            );

            // Convert the user details array to a JSON string
            // Set a cookie with the user details
            setcookie('user_details', json_encode($user_details), time() + (86400 * 30), '/');
            header('Location: intermediate.php');
            exit;
        } 
    }
    // Login failed
    header('Location: /tpr1/login.php?error=invalid_credentials');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        * {
            box-sizing: border-box;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
                Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
            font-size: 16px;
        }

        body {
            background-color: #435165;
        }

        .Body {
            margin: 0px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        a {
            position: absolute;
            top: 10%;
            left: 85%;
            font-size: 24px;
            color: #dee0e4;
            font-weight: bold;
            text-decoration: none;
        }

        h1 {
            text-align: center;
            color: #5b6574;
            font-size: 24px;
            padding: 20px 0 20px 0;
            border-bottom: 1px solid #dee0e4;
            background-color: aliceblue;
            margin: 0px;
            border-radius: 3px 3px 0px 0px;
        }

        form {
            width: 400px;
            background-color: aliceblue;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding-top: 20px;
            border-radius: 0px 0px 3px 3px;
        }

        form label {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 50px;
            height: 50px;
            background-color: #3274d6;
            color: #ffffff;
            font-size: 22px;
        }

        form input[type="number"] {
            width: 310px;
            height: 50px;
            border: 1px solid #dee0e4;
            margin-bottom: 20px;
            padding: 0 15px;
        }

        form select {
            width: 360px;
            height: 50px;
            border: 1px solid #dee0e4;
            margin-bottom: 20px;
            padding: 0 15px;
        }

        form input[type="submit"] {
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

        form input[type="submit"]:hover {
            background-color: #2868c7;
            transition: background-color 0.2s;
        }

        @media screen and (max-width: 600px) {
            a {
            position: absolute;
            top: 5%;
            left: 75%;
            }
            .Body {
                top: 30%;
            }

            form {
                width: 98vw !important;
            }
        }
    </style>
</head>

<body>
    <div class="login">
        <a href="./admin/admin_verify.php">Admin</a>
        <div class="Body">
            <h1>Teacher Login</h1>
            <form method="POST">
                <label for="email">
                    <i class="fa fa-regular fa-user"></i>
                </label>
                <input type="number" name="Aadhar" placeholder="Enter Aadhar Number" required>
                <select name="clg_name" required>
                    <option value="">Select college</option>
                    <option value="AUCE">AUCE</option>
                    <option value="AUCEW">AUCEW</option>
                    <option value="Science">Andhra University College of Science & Technology</option>
                    <option value="Arts">Andhra University College of ARTS & COMMERCE</option>
                    <option value="Pharma">Andhra University College of PHARMACEUTICAL SCIENCES</option>
                    <option value="LAW">Dr. B.R.AMBEDKAR COLG. OF LAW</option>
                </select>
                <input type="submit" value="login" name="submit">
            </form>
        </div>
    </div>

</html>