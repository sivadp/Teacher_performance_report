<?php
$userDetails = isset($_GET['user-details']) ? $_GET['user-details'] : '';
$year = isset($_GET['year']) ? $_GET['year'] : '';
$awardVal = isset($_GET['award-val']) ? explode(',', $_GET['award-val']) : [];
$awardNames = json_decode(urldecode($_GET['award-names']), true);
$researchVal = isset($_GET['researchVal']) ? explode(',', $_GET['researchVal']) : [];
$researchNames = isset($_GET['researchNames']) ? json_decode($_GET['researchNames'], true) : [];
$researchNames1 = isset($_GET['researchNames1']) ? json_decode($_GET['researchNames1'], true) : [];
$scoreArr = isset($_GET['scoreArr']) ? json_decode($_GET['scoreArr'], true) : [];
$selectedPercentage = isset($_GET['selectedPercentage']) ? $_GET['selectedPercentage'] : '';
$extensionVal = isset($_GET['extensionVal']) ? explode(',', $_GET['extensionVal']) : [];
$extensionNames = isset($_GET['extensionNames']) ? json_decode($_GET['extensionNames'], true) : [];
?>
<script>
    // Get the user details from PHP
    var userDetails = <?php echo json_encode($userDetails); ?>;
    var year = <?php echo json_encode($year); ?>;
    var awardVal = <?php echo json_encode($awardVal); ?>;
    var awardNames = <?php echo json_encode($awardNames); ?>;
    var researchVal = <?php echo json_encode($researchVal); ?>;
    var researchNames = <?php echo json_encode($researchNames); ?>;
    var researchNames1 = <?php echo json_encode($researchNames1); ?>;
    var extensionVal = <?php echo json_encode($extensionVal); ?>;
    var extensionNames = <?php echo json_encode($extensionNames); ?>;
    var scoreArr = <?php echo json_encode($scoreArr); ?>;
    var selectedPercentage = <?php echo json_encode($selectedPercentage); ?>;

    // Function to decode a cookie value
    function decodeCookieValue(cookieValue) {
        return JSON.parse(decodeURIComponent(cookieValue));
    }

    // Function to retrieve the value of a cookie by its name
    function getCookieValue(cookieName) {
        var cookies = document.cookie.split(';');
        for (var i = 0; i < cookies.length; i++) {
            var cookie = cookies[i].trim();
            if (cookie.indexOf(cookieName + '=') === 0) {
                var cookieValue = cookie.substring(cookieName.length + 1);
                return decodeCookieValue(cookieValue);
            }
        }
        return null; // Cookie not found
    }
    var pstn = getCookieValue('pstn');
</script>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Position</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            font-size: 16px;
        }

        body {
            background-color: #435165;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
            margin-left: 0px;
            margin-right: 0px;
        }

        h1 {
            background-color: aliceblue;
            width: 500px;
            text-align: center;
            padding: 10px 0px;
        }

        .block {
            margin: 0px auto;
            width: 500px;
            min-width: 300px;
            padding-top: 15px;
            border: 1px solid black;
            background-color: aliceblue;
            text-align: center;
        }

        .block label {
            margin-bottom: 10px;
            font-size: 15px;
            font-weight: bold;
        }

        .block div {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            margin: 10px;
            flex-wrap: wrap;
        }

        form input[type="submit"] {
            width: 100%;
            padding: 15px;
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

        @media only screen and (max-width:600px) {
            h1 {
                width: 98vw;
            }

            .block {
                width: 98vw;
            }

            .block div {
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <form method="POST">
        <h1>please select according to your experiance in different positions</h1>
        <div class="block">
            <label>service as Lecturer/Asst.Professor</label>
            <div>
                <div>
                    <label for="fromL">from=</label>
                    <input type="date" id="fromL" value="0">
                </div>
                <div>
                    <label for="toL">to=</label>
                    <input type="date" id="toL" value="0">
                </div>
            </div>
        </div>
        <div class="block">
            <label>service as Reader/Assoicate Professor</label>
            <div>
                <div>
                    <label for="fromR">from=</label>
                    <input type="date" id="fromR" value="0">
                </div>
                <div>
                    <label for="toR">to=</label>
                    <input type="date" id="toR" value="0">
                </div>
            </div>
        </div>
        <div class="block">
            <label>service as Professor</label>
            <div>
                <div>
                    <label for="fromP">from=</label>
                    <input type="date" id="fromP" value="0">
                </div>
                <div>
                    <label for="toP">to=</label>
                    <input type="date" id="toP" value="0">
                </div>
            </div>
        </div>
        <input type="submit" value="next" name="submit" id="submit">
    </form>
</body>
<script>
    let date1 = JSON.parse(pstn['lecturer']);
    document.getElementById("fromL").value = date1[0];
    document.getElementById("toL").value = date1[1];
    date1 = JSON.parse(pstn['reader']);
    document.getElementById("fromR").value = date1[0];
    document.getElementById("toR").value = date1[1];
    date1 = JSON.parse(pstn['professor']);
    document.getElementById("fromP").value = date1[0];
    document.getElementById("toP").value = date1[1];
</script>
<script>
    document.getElementById("submit").addEventListener("click", function(event) {
        event.preventDefault();
        let fromL = document.getElementById("fromL").value;
        let toL = document.getElementById("toL").value;
        let fromR = document.getElementById("fromR").value;
        let toR = document.getElementById("toR").value;
        let fromP = document.getElementById("fromP").value;
        let toP = document.getElementById("toP").value;
        let lec = 0,
            red = 0,
            pro = 0;
        if (fromL && toL) {
            lec = new Date(toL) - new Date(fromL);
            lec = Math.floor(lec / (1000 * 60 * 60 * 24));
        } else {
            fromL = 0;
            toL = 0;
        }
        if (fromR && toR) {
            red = new Date(toR) - new Date(fromR);
            red = Math.floor(red / (1000 * 60 * 60 * 24));
        } else {
            fromR = 0;
            toR = 0;
        }
        if (fromP && toP) {
            pro = new Date(toP) - new Date(fromP);
            pro = Math.floor(pro / (1000 * 60 * 60 * 24));
        } else {
            fromP = 0;
            toP = 0;
        }
        let arr = [lec, red, pro];
        let dates = [
            [fromL, toL],
            [fromR, toR],
            [fromP, toP]
        ];
        encodeddates = encodeURIComponent(JSON.stringify(dates));
        encodedawardNames = encodeURIComponent(JSON.stringify(awardNames));
        encodedresearchNames = encodeURIComponent(JSON.stringify(researchNames));
        encodedresearchNames1 = encodeURIComponent(JSON.stringify(researchNames1));
        encodedextensionNames = encodeURIComponent(JSON.stringify(extensionNames));
        var url = "tpr_admin.php?user-details=" + userDetails + "&year=" + year + "&awardVal=" + awardVal + "&awardNames=" + encodedawardNames + "&researchVal=" + researchVal + "&researchNames=" + encodedresearchNames + "&researchNames1=" + encodedresearchNames1 + "&extensionVal=" + extensionVal + "&extensionNames=" + encodedextensionNames + "&position=" + arr + "&dates=" + encodeddates +"&scoreArr="+ scoreArr + "&selectedPercentage=" + selectedPercentage;
        window.location.href = url;
    });
</script>

</html>