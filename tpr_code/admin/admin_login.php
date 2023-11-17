<?php
// Define a function to fetch the eno values based on the selected year
function fetchEnoValues($year) {
    $pdo = new PDO('mysql:host=localhost;dbname=tpr', 'root', 'Siva@2000');

    // Prepare the SQL query to fetch eno based on the selected year
    $stmt = $pdo->prepare("SELECT eno FROM tpr_awards WHERE abs_year = :abs_year");
    $stmt->bindParam(':abs_year', $year);
    $stmt->execute();

    // Fetch the eno values as an associative array
    $enoValues = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Close the database connection
    $pdo = null;

    return $enoValues;
}

// Define a function to fetch the rows based on the selected year and eno
function fetchRows($year, $eno) {
    $pdo = new PDO('mysql:host=localhost;dbname=tpr', 'root', 'Siva@2000');

    // Prepare the SQL queries to fetch rows from multiple tables
    $queries = array(
        'faculty_details'=>"SELECT * FROM faculty_details WHERE abs_year = :abs_year AND eno = :eno",
        'tpr_awards' => "SELECT * FROM tpr_awards WHERE abs_year = :abs_year AND eno = :eno",
        'tpr_research1' => "SELECT * FROM tpr_research1 WHERE abs_year = :abs_year AND eno = :eno",
        'tpr_research2' => "SELECT * FROM tpr_research2 WHERE abs_year = :abs_year AND eno = :eno",
        'extension' => "SELECT * FROM extension WHERE abs_year = :abs_year AND eno = :eno",
        'pstn' => "SELECT * FROM pstn WHERE abs_year = :abs_year AND eno = :eno"
    );

    $results = array();

    foreach ($queries as $table => $query) {
        // Prepare the SQL query for the current table
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':abs_year', $year);
        $stmt->bindParam(':eno', $eno);
        $stmt->execute();

        // Fetch the rows for the current table
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Add the rows to the results array
        $results[$table] = $rows;
    }

    // Close the database connection
    $pdo = null;

    return $results;
}

// Check if the submit button is clicked
if (isset($_POST['submit'])) {
    $year = $_POST['year'];
    $eno = $_POST['eno'];
    $rows = fetchRows($year, $eno);

    // Encode the rows array as a URL parameter
    $encodedRows = urlencode(json_encode($rows));
    // Redirect to tpr.php with the encoded rows in the URL
    header('Location: awards1.php?rows=' . $encodedRows);
    exit;
}

// Check if the year is set in the POST data
if (isset($_POST['year'])) {
    $year = $_POST['year'];
    $enoValues = fetchEnoValues($year);

    // Generate HTML options for the eno dropdown
    $options = '';
    foreach ($enoValues as $eno) {
        $options .= '<option value="' . $eno . '">' . $eno . '</option>';
    }
    echo $options;
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <style>
         * {
            box-sizing: border-box;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
                Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
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

        form select{
            width:360px;
            height:50px;
            border:1px solid #dee0e4;
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
    <div class="login">
        <h1>Admin Login</h1>
        <form method="POST">
            <select name="year" id="year">
                <option value="">select an year</option>
                <option value="2017-18">2017-18</option>
                <option value="2018-19">2018-19</option>
                <option value="2019-20">2019-20</option>
                <option value="2020-21">2020-21</option>
                <option value="2021-22">2021-22</option>
                <option value="2022-23">2022-23</option>
            </select>
            <select name="eno" id="eno"></select>
            <input type="submit" value="Submit" name="submit">
        </form>
    </div>

    <script>
        // Add an event listener to the year selection
        document.getElementById('year').addEventListener('change', function() {
            var year = this.value;

            // Create an AJAX request
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Update the eno dropdown with the fetched values
                    document.getElementById('eno').innerHTML = xhr.responseText;
                }
            };
            xhr.send('year=' + encodeURIComponent(year));
        });
    </script>
</body>
</html>
