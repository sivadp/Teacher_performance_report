<?php
session_start();
// Retrieve the user details from the cookie
$user_details = json_decode($_COOKIE['user_details'], true);

// if user is not logged in, redirect to login page
if (!isset($user_details)) {
    header("Location: /login.php");
    exit();
}
// Check if the login form was submitted
if (isset($_POST['submit'])) {
    // Assuming you have already populated the $_POST['year'] variable and the $user_details array

// Encode the user_details array as JSON
$user_details_json = json_encode($user_details);

// Prepare the data to be sent via POST
$data = array(
    'user_details' => $user_details_json,
    'year' => $_POST['year'],
    'clg' => $user_details['clg']
);

// Encode the data as JSON
$data_json = json_encode($data);

// Base64 encode the JSON data to ensure safe URL encoding
$data_encoded = base64_encode($data_json);

// Redirect to the awards.php page with the encoded data as a query parameter
header("Location: awards.php?data=" . $data_encoded);
exit();

}
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>year wise list</title>
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

        form {
            max-width: 400px;
            background-color: aliceblue;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            border-radius: 3px;
        }

        form label {
            text-align: center;
            color: #5b6574;
            font-size: 18px;
            font-weight: bold;
            padding: 7px 0 20px 0;
        }

        select {
            display: block;
            margin-bottom: 20px;
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            background-color: #fff;
        }

        input[type="submit"] {
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

        input[type="submit"]:hover {
            background-color: #2868c7;
            transition: background-color 0.2s;
        }

        h1 {
            text-align: center;
            background-color: aliceblue;
            color: #5b6574;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: -20px;
            border: 3px;
            padding-top: 10px;
        }

        #name {
            margin-top: 0px;
        }

        @media only screen and (max-width: 600px) {
            body {
                top: 30%;
            }

            form {
                width: 98vw !important;
            }
        }
    </style>

</head>

<body>
    <h1>welcome <p id="name"></p>
    </h1>
    <form method="POST" class="mobile-form-container">
        <label for="year">Select a year for Teacher Perfomance Report</label>
        <select name="year" id="year">
            <option value="2017-18" default>2017-18</option>
            <option value="2018-19">2018-19</option>
            <option value="2019-20">2019-20</option>
            <option value="2020-21">2020-21</option>
            <option value="2021-22">2021-22</option>
            <option value="2022-23">2022-23</option>
        </select>
        <br><br>
        <input type="submit" value="Submit" name="submit">
    </form>
</body>
<script>
    var userDetails = <?php echo json_encode($user_details); ?>;
    document.getElementById("name").textContent = userDetails.name;
</script>

</html>