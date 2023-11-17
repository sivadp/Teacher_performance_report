<?php
$year = $_GET['year'];
$encodedAwardVal = $_GET['award-val'];
$encodedResearchVal = $_GET['researchVal'];
$encodedUserDetails = $_GET['user-details'];
$encodedAwardNames = $_GET['award-names'];
$encodedResearchNames = $_GET['researchNames'];
$encodedResearchNames1 = $_GET['researchNames1'];
$encodedExtensionVal = $_GET['extensionVal'];
$encodedExtensionNames = $_GET['extensionNames'];
?>

<script>
    // Get the encoded values from PHP
    var encodedUserDetails = '<?php echo $encodedUserDetails; ?>';
    var encodedYear = '<?php echo $year; ?>';
    var encodedAwardVal = '<?php echo $encodedAwardVal; ?>';
    var encodedAwardNames = '<?php echo $encodedAwardNames; ?>';
    var encodedResearchVal = '<?php echo $encodedResearchVal; ?>';
    var encodedResearchNames = '<?php echo $encodedResearchNames; ?>';
    var encodedResearchNames1 = '<?php echo $encodedResearchNames1; ?>';
    var encodedExtensionVal = '<?php echo $encodedExtensionVal; ?>';
    var encodedExtensionNames = '<?php echo $encodedExtensionNames; ?>';

    // Decode the values
    var userDetails = JSON.parse(atob(encodedUserDetails));
    var year = decodeURIComponent(encodedYear);
    var awardVal = JSON.parse(atob(encodedAwardVal));
    var awardNames = JSON.parse(atob(encodedAwardNames));
    var researchVal = JSON.parse(atob(encodedResearchVal));
    var researchNames = JSON.parse(atob(encodedResearchNames));
    var researchNames1 = JSON.parse(atob(encodedResearchNames1));
    var extensionVal = JSON.parse(atob(encodedExtensionVal));
    var extensionNames = JSON.parse(atob(encodedExtensionNames));
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

        function encodeToBase64(string) {
            const encoder = new TextEncoder();
            const data = encoder.encode(string);
            const base64 = btoa(String.fromCharCode.apply(null, data));

            return base64;
        }
        var encodedUserDetails = encodeToBase64(JSON.stringify(userDetails));
        var encodedAwardVal = encodeToBase64(JSON.stringify(awardVal));
        var encodedAwardNames = encodeToBase64(JSON.stringify(awardNames));
        var encodedResearchVal = encodeToBase64(JSON.stringify(researchVal));
        var encodedResearchNames = encodeToBase64(JSON.stringify(researchNames));
        var encodedResearchNames1 = encodeToBase64(JSON.stringify(researchNames1));
        var encodedExtensionVal = encodeToBase64(JSON.stringify(extensionVal));
        var encodedExtensionNames = encodeToBase64(JSON.stringify(extensionNames));
        var encodedDates = encodeToBase64(JSON.stringify(dates));
        var encodedTime = encodeToBase64(JSON.stringify(arr));
        var url = "tpr_user1.php?user-details=" + encodedUserDetails + "&year=" + year + "&award-val=" + encodedAwardVal + "&award-names=" + encodedAwardNames + "&researchVal=" + encodedResearchVal + "&researchNames=" + encodedResearchNames + "&researchNames1=" + encodedResearchNames1 + "&extensionVal=" + encodedExtensionVal + "&extensionNames=" + encodedExtensionNames + "&dates=" + encodedDates + "&time=" + encodedTime;
        window.location.href = url;
    });
</script>

</html>