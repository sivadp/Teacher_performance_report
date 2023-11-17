<?php
// Check if the rows parameter is set in the URL
if (isset($_GET['rows'])) {
    $encodedRows = $_GET['rows'];
    $rows = json_decode(urldecode($encodedRows), true);

    // Create separate variables for each table's flattened rows
    $faculty_details=array_merge(...$rows['faculty_details']);
    $tpr_awards = array_merge(...$rows['tpr_awards']);
    $tpr_research1 = array_merge(...$rows['tpr_research1']);
    $tpr_research2 = array_merge(...$rows['tpr_research2']);
    $extension = array_merge(...$rows['extension']);
    $pstn = array_merge(...$rows['pstn']);
}
if (isset($_POST['submit'])) {
    $scoreArr = $_POST['scoreArr'];
    $selectedPercentage = $_POST['selectedPercentage'];

    // Prepare the URL with query parameters
    $url = "awards2.php";
    $params = array(
        'scoreArr' => json_encode($scoreArr),
        'selectedPercentage' => $selectedPercentage,
        'faculty_details'=>$faculty_details,
        'tpr_awards' => $tpr_awards,
        'tpr_research1' => $tpr_research1,
        'tpr_research2' => $tpr_research2,
        'extension' => $extension,
        'pstn' => $pstn
    );
    $queryString = http_build_query($params);
    $url .= "?" . $queryString;

    // Redirect to awards2.php with query parameters
    header("Location: " . $url);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teaching and Contribution to Academia</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            font-size: 16px;
        }

        body {
            background-color: #f3f3f3;
        }

        h2 {
            text-align: center;
        }

        .center {
            margin: 0 15vw 0 15vw;
            display: flex;
            justify-content: center;
            flex-direction: column;
        }

        form {
            display: flex;
            justify-content: center;
        }

        table {
            border: 1px solid black;
            width: 100%;
            border-collapse: collapse;
        }

        td {
            border: 1px solid black;
            padding: 5px;
        }

        td:first-child {
            max-width: 400px;
            word-wrap: break-word;
        }

        button,
        input[type="submit"] {
            padding: 5px 10px;
            border-radius: 5px;
            border: none;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            background-color: #3e8e41;

        }

        input[type="submit"] {
            margin-bottom: 20px;
            width: 100%;
        }
    </style>
</head>

<body>
    <h2>Teaching and Contribution to Academia</h2>
    <br>
    <h2>A) Opinion of the Head Department/Principal (Max. score : 120)</h2>
    <div class="center">
        <table id="qsn1">
            <tr>
                <th>Assessment Criteria</th>
                <th>10</th>
                <th>8</th>
                <th>6</th>
                <th>4</th>
                <th>2</th>
            </tr>
            <tr>
                <td>1. Availability to students during working hours</td>
                <td class="radio-container">grade 5<input type="radio" name="q1" value=10></td>
                <td class="radio-container">grade 4<input type="radio" name="q1" value=8></td>
                <td class="radio-container">grade 3<input type="radio" name="q1" value=6></td>
                <td class="radio-container">grade 2<input type="radio" name="q1" value=4></td>
                <td class="radio-container">grade 1<input type="radio" name="q1" value=2></td>
            </tr>
            <tr>
                <td>2. Punctuality to classes</td>
                <td class="radio-container">grade 5<input type="radio" name="q2" value=10></td>
                <td class="radio-container">grade 4<input type="radio" name="q2" value=8></td>
                <td class="radio-container">grade 3<input type="radio" name="q2" value=6></td>
                <td class="radio-container">grade 2<input type="radio" name="q2" value=4></td>
                <td class="radio-container">grade 1<input type="radio" name="q2" value=2></td>
            </tr>
            <tr>
                <td>3. Regularity in taking classes as per Time-Table</td>
                <td class="radio-container">grade 5<input type="radio" name="q3" value=10></td>
                <td class="radio-container">grade 4<input type="radio" name="q3" value=8></td>
                <td class="radio-container">grade 3<input type="radio" name="q3" value=6></td>
                <td class="radio-container">grade 2<input type="radio" name="q3" value=4></td>
                <td class="radio-container">grade 1<input type="radio" name="q3" value=2></td>
            </tr>
            <tr>
                <td>4. Maintenance of students attendance register</td>
                <td class="radio-container">grade 5<input type="radio" name="q4" value=10></td>
                <td class="radio-container">grade 4<input type="radio" name="q4" value=8></td>
                <td class="radio-container">grade 3<input type="radio" name="q4" value=6></td>
                <td class="radio-container">grade 2<input type="radio" name="q4" value=4></td>
                <td class="radio-container">grade 1<input type="radio" name="q4" value=2></td>
            </tr>
            <tr>
                <td>5. Maintenance of lecture diary</td>
                <td class="radio-container">grade 5<input type="radio" name="q5" value=10></td>
                <td class="radio-container">grade 4<input type="radio" name="q5" value=8></td>
                <td class="radio-container">grade 3<input type="radio" name="q5" value=6></td>
                <td class="radio-container">grade 2<input type="radio" name="q5" value=4></td>
                <td class="radio-container">grade 1<input type="radio" name="q5" value=2></td>
            </tr>
            <tr>
                <td>6. Arranging classroom seminars to students</td>
                <td class="radio-container">grade 5<input type="radio" name="q6" value=10></td>
                <td class="radio-container">grade 4<input type="radio" name="q6" value=8></td>
                <td class="radio-container">grade 3<input type="radio" name="q6" value=6></td>
                <td class="radio-container">grade 2<input type="radio" name="q6" value=4></td>
                <td class="radio-container">grade 1<input type="radio" name="q6" value=2></td>
            </tr>
            <tr>
                <td>7. Regularity in giving home assignments</td>
                <td class="radio-container">grade 5<input type="radio" name="q7" value=10></td>
                <td class="radio-container">grade 4<input type="radio" name="q7" value=8></td>
                <td class="radio-container">grade 3<input type="radio" name="q7" value=6></td>
                <td class="radio-container">grade 2<input type="radio" name="q7" value=4></td>
                <td class="radio-container">grade 1<input type="radio" name="q7" value=2></td>
            </tr>
            <tr>
                <td>8. Celerity/briskness in providing solutions to assignments</td>
                <td class="radio-container">grade 5<input type="radio" name="q8" value=10></td>
                <td class="radio-container">grade 4<input type="radio" name="q8" value=8></td>
                <td class="radio-container">grade 3<input type="radio" name="q8" value=6></td>
                <td class="radio-container">grade 2<input type="radio" name="q8" value=4></td>
                <td class="radio-container">grade 1<input type="radio" name="q8" value=2></td>
            </tr>
            <tr>
                <td>9. Promptness in returning answer scripts to students</td>
                <td class="radio-container">grade 5<input type="radio" name="q9" value=10></td>
                <td class="radio-container">grade 4<input type="radio" name="q9" value=8></td>
                <td class="radio-container">grade 3<input type="radio" name="q9" value=6></td>
                <td class="radio-container">grade 2<input type="radio" name="q9" value=4></td>
                <td class="radio-container">grade 1<input type="radio" name="q9" value=2></td>
            </tr>
            <tr>
                <td>10. Availability for examination work including invigilation</td>
                <td class="radio-container">grade 5<input type="radio" name="q10" value=10></td>
                <td class="radio-container">grade 4<input type="radio" name="q10" value=8></td>
                <td class="radio-container">grade 3<input type="radio" name="q10" value=6></td>
                <td class="radio-container">grade 2<input type="radio" name="q10" value=4></td>
                <td class="radio-container">grade 1<input type="radio" name="q10" value=2></td>
            </tr>
            <tr>
                <td>11. Participation in curriculum / syllabus development</td>
                <td class="radio-container">grade 5<input type="radio" name="q11" value=10></td>
                <td class="radio-container">grade 4<input type="radio" name="q11" value=8></td>
                <td class="radio-container">grade 3<input type="radio" name="q11" value=6></td>
                <td class="radio-container">grade 2<input type="radio" name="q11" value=4></td>
                <td class="radio-container">grade 1<input type="radio" name="q11" value=2></td>
            </tr>
            <tr>
                <td>12. Participation in college/ Department activities</td>
                <td class="radio-container">grade 5<input type="radio" name="q12" value=10></td>
                <td class="radio-container">grade 4<input type="radio" name="q12" value=8></td>
                <td class="radio-container">grade 3<input type="radio" name="q12" value=6></td>
                <td class="radio-container">grade 2<input type="radio" name="q12" value=4></td>
                <td class="radio-container">grade 1<input type="radio" name="q12" value=2></td>
            </tr>
        </table>
        <h2>
            <div id="scoreUpdate1"></div>
        </h2>
        <br>
        <h2>B) Student feedback on teacher performance (last 3 years)(Max. score : 120</h2>
        <table>
            <tr>
                <td>% of students who assessed with grade-4 and/or grade-5</td>
                <td colspan="5">
                    <select name="percentage" id="percentage">
                        <option value="120">≥ 95%</option>
                        <option value="110">90% - &lt; 95%</option>
                        <option value="100">85% - &lt; 90%</option>
                        <option value="90">80% - &lt; 85%</option>
                        <option value="80">75% - &lt; 80%</option>
                        <option value="70">70% - &lt; 75%</option>
                        <option value="60">65% - &lt; 70%</option>
                        <option value="50">60% - &lt; 65%</option>
                        <option value="40">55% - &lt; 60%</option>
                        <option value="30">50% - &lt; 55%</option>
                    </select>
                </td>
            </tr>
        </table>
        <h2>
            <div id="scoreUpdate2"></div>
        </h2>
        <br>
        <button onclick="calculateFinalScore()">Calculate Final Score</button>
        <br>
        <form action="" method="post">
            <input type="hidden" name="scoreArr" value="" id="scoreArrInput">
            <input type="hidden" name="selectedPercentage" value="" id="selectedPercentageInput">

            <input type="submit" value="next" name="submit" onclick="submitted()">
        </form>
    </div>
</body>
<script>
    var scoreArr = [];
    var selectedPercentage=0;
    function calculateFinalScore() {
        scoreArr=[];
        const percentageElement = document.getElementById('percentage');
        selectedPercentage = percentageElement.value;
        const q1 = document.getElementById("qsn1");
        const rows = q1.querySelectorAll('tr:not(:first-child)');
        rows.forEach(function(row) {
            const radioButtons = row.querySelectorAll('input[type="radio"]');
            let score = 0;
            radioButtons.forEach(function(radioButton) {
                if (radioButton.checked) {
                    score = parseInt(radioButton.value);
                }
            });
            scoreArr.push(score);
        });
        let scoreTotal = scoreArr.reduce((a, b) => a + b);
        let scoreUpdate1 = document.getElementById("scoreUpdate1");
        scoreUpdate1.innerText = `block Total: ${scoreTotal}`;
        let scoreUpdate2 = document.getElementById("scoreUpdate2");
        scoreUpdate2.innerText = `block Total: ${selectedPercentage}`;
    }
    function submitted(){
        document.getElementById('scoreArrInput').value = JSON.stringify(scoreArr);
        document.getElementById('selectedPercentageInput').value = selectedPercentage;

        // Submit the form
        var form = document.querySelector('form');
        var submitEvent = new Event('submit');
        form.dispatchEvent(submitEvent);
    }
</script>

</html>