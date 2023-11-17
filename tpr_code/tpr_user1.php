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
$encodedDates=$_GET['dates'];
$encodedTime=$_GET['time'];
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
    var encodedDates='<?php echo $encodedDates;?>';
    var encodedTime='<?php echo $encodedTime;?>';

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
    var positionDates=JSON.parse(atob(encodedDates));
    var positionTime=JSON.parse(atob(encodedTime));
</script>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle the form submission

    $userDetails = json_decode($_POST['userDetails'], true);
    $year = $_POST['year'];
    $awardVal = json_decode($_POST['awardVal'], true);
    $researchVal = json_decode($_POST['researchVal'], true);
    $extensionVal = json_decode($_POST['extensionVal'], true);
    $awardNames = json_decode($_POST['awardNames'], true);
    $researchNames = json_decode($_POST['researchNames'], true);
    $researchNames1 = json_decode($_POST['researchNames1'], true);
    $extensionNames = json_decode($_POST['extensionNames'], true);
    $positionDates = json_decode($_POST['dates'], true);
    $positionTime = json_decode($_POST['time'], true);
    $tpr_score = json_decode($_POST['tpr_score'], true);
// Create a new PDO instance
$pdo = new PDO('mysql:host=localhost;dbname=tpr', 'root', 'Siva@2000');

// Retrieve the values from the PHP array
$SNo = $userDetails['SNo'];
$ENo = $userDetails['ENo'];
$name = $userDetails['name'];
$dept = $userDetails['Dept'];
$gender = $userDetails['gender'];
$cat = $userDetails['cat'];
$pos = $userDetails['pos'];
$dob = $userDetails['dob'];
$doj = $userDetails['doj'];
$HQ = $userDetails['HQ'];
$PAN = $userDetails['PAN'];
$Aadhar = $userDetails['Aadhar'];
$ph_no = $userDetails['ph_no'];
$email = $userDetails['email'];
$abs_year=$year;
$year = $ENo . '(' . $year . ')';
$stmt = $pdo->prepare("SELECT COUNT(*) FROM faculty_details WHERE year = :year");
$stmt->bindParam(':year', $year);
$stmt->execute();
$rowCount = $stmt->fetchColumn();

if ($rowCount > 0) {
    echo "<script>alert('Response already submitted.');</script>";
} else {
// Prepare the SQL query
$stmt = $pdo->prepare("INSERT INTO faculty_details (year, sno, eno, name, dept, gender, category, position, dob, doj, high_qual, pan_no, aadhar_no, phone_no, email_id,abs_year)
          VALUES (:year, :sno, :eno, :name, :dept, :gender, :category, :position, :dob, :doj, :high_qual, :pan_no, :aadhar_no, :phone_no, :email_id,:abs_year)");

// Bind parameters to the statement
$stmt->bindParam(':year', $year);
$stmt->bindParam(':sno', $SNo);
$stmt->bindParam(':eno', $ENo);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':dept', $dept);
$stmt->bindParam(':gender', $gender);
$stmt->bindParam(':category', $cat);
$stmt->bindParam(':position', $pos);
$stmt->bindParam(':dob', $dob);
$stmt->bindParam(':doj', $doj);
$stmt->bindParam(':high_qual', $HQ);
$stmt->bindParam(':pan_no', $PAN);
$stmt->bindParam(':aadhar_no', $Aadhar);
$stmt->bindParam(':phone_no', $ph_no);
$stmt->bindParam(':email_id', $email);
$stmt->bindParam(':abs_year', $abs_year);
// Execute the statement
$stmt->execute();

// Check for errors
$errorInfo = $stmt->errorInfo();
if ($stmt->errorInfo()[0] !== '00000') {
    $errorMessage = "Error inserting data into database1. Please try again later.";
    echo "<script>alert('$errorMessage');</script>";
} 
}
    // Check if the row already exists
    $eno = $userDetails['ENo'];
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM tpr_awards WHERE year = :year");
    $stmt->bindParam(':year', $year);
    $stmt->execute();
    $rowCount = $stmt->fetchColumn();

    if ($rowCount > 0) {
        echo "<span style='text-align: center; font-weight: bold;'></span>";
    } else {
        // prepare the SQL query
        $stmt = $pdo->prepare("INSERT INTO tpr_awards (eno, year, awards,teacher_distinction,leave_time,books,tpr_score,abs_year) VALUES (:eno, :year, :awards, :teacher_distinction, :leave_time, :books, :tpr_score,:abs_year)");
        $awards = json_encode($awardNames[0], JSON_UNESCAPED_UNICODE);
        $teacherDistinction = json_encode($awardNames[1], JSON_UNESCAPED_UNICODE);
        $books = json_encode($awardNames[2], JSON_UNESCAPED_UNICODE);
        // bind parameters to the statement
        $stmt->bindParam(':eno', $eno);
        $stmt->bindParam(':year', $year);
        $stmt->bindParam(':awards', $awards);
        $stmt->bindParam(':teacher_distinction', $teacherDistinction);
        $stmt->bindParam(':leave_time', $awardVal[2]);
        $stmt->bindParam(':books', $books);
        $stmt->bindParam(':tpr_score', $tpr_score);
        $stmt->bindParam(':abs_year', $abs_year);

        // set the values for the parameters
        $eno = $userDetails['ENo'];
        

        // execute the statement
        $stmt->execute();

        // check for errors
        $errorInfo = $stmt->errorInfo();
        if ($stmt->errorInfo()[0] !== '00000') {
            $errorMessage = "Error inserting data into database2. Please try again later.";
            echo "<script>alert('$errorMessage');</script>";
        }
    }
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM tpr_research1 WHERE year = :year");
    $stmt->bindParam(':year', $year);
    $stmt->execute();
    $rowCount = $stmt->fetchColumn();

    if ($rowCount > 0) {
        echo "<span style='text-align: center; font-weight: bold;'></span>";
    } else {
        $stmt = $pdo->prepare("INSERT INTO tpr_research1 (eno, year, journals,sem_atd,sem_org,consultancy,abs_year) VALUES (:eno, :year, :journals,:sem_atd,:sem_org,:consultancy,:abs_year)");
        $jounals = json_encode($researchNames[0], JSON_UNESCAPED_UNICODE);
        $sem_atd = json_encode($researchNames[1], JSON_UNESCAPED_UNICODE);
        $sem_org = json_encode($researchNames[2], JSON_UNESCAPED_UNICODE);
        $consultany = json_encode($researchNames[3], JSON_UNESCAPED_UNICODE);
        // bind parameters to the statement
        $stmt->bindParam(':eno', $eno);
        $stmt->bindParam(':year', $year);
        $stmt->bindParam(':journals', $jounals);
        $stmt->bindParam(':sem_atd', $sem_atd);
        $stmt->bindParam(':sem_org', $sem_org);
        $stmt->bindParam(':consultancy', $consultany);
        $stmt->bindParam(':abs_year', $abs_year);

        $eno = $userDetails['ENo'];

        $stmt->execute();
        // check for errors
        $errorInfo = $stmt->errorInfo();
        if ($stmt->errorInfo()[0] !== '00000') {
            $errorMessage = "Error inserting data into database3. Please try again later.";
            echo "<script>alert('$errorMessage');</script>";
        } 
    }
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM tpr_research2 WHERE year = :year");
    $stmt->bindParam(':year', $year);
    $stmt->execute();
    $rowCount = $stmt->fetchColumn();

    if ($rowCount > 0) {
        echo "<span style='text-align: center; font-weight: bold;'></span>";
    } else {
        $stmt = $pdo->prepare("INSERT INTO tpr_research2 (eno, year, guidance,projects_val,publications_total,publications_3,patents,abs_year) VALUES (:eno, :year, :guidance,:projects_val,:publications_total,:publications_3,:patents,:abs_year)");
        $guidance = json_encode($researchNames1[0], JSON_UNESCAPED_UNICODE);
        $publications_total = json_encode($researchNames1[2], JSON_UNESCAPED_UNICODE);
        $publications_3 = json_encode($researchNames1[3], JSON_UNESCAPED_UNICODE);
        $patents = json_encode($researchNames1[4], JSON_UNESCAPED_UNICODE);
        $project_val= json_encode($researchNames1[1]);
        // bind parameters to the statement
        $stmt->bindParam(':eno', $eno);
        $stmt->bindParam(':year', $year);
        $stmt->bindParam(':guidance', $guidance);
        $stmt->bindParam(':projects_val',$project_val);
        $stmt->bindParam(':publications_total', $publications_total);
        $stmt->bindParam(':publications_3', $publications_3);
        $stmt->bindParam(':patents', $patents);
        $stmt->bindParam(':abs_year', $abs_year);

        $eno = $userDetails['ENo'];

        $stmt->execute();
        // check for errors
        $errorInfo = $stmt->errorInfo();
        if ($stmt->errorInfo()[0] !== '00000') {
            $errorMessage = "Error inserting data into database4. Please try again later.";
            echo "<script>alert('$errorMessage');</script>";
        } 
    }
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM extension WHERE year = :year");
    $stmt->bindParam(':year', $year);
    $stmt->execute();
    $rowCount = $stmt->fetchColumn();

    if ($rowCount > 0) {
        echo "<span style='text-align: center; font-weight: bold;'></span>";
    } else {
        $stmt = $pdo->prepare("INSERT INTO extension (eno, year, activities,membership,assignments,abs_year) VALUES (:eno, :year, :activities,:membership,:assignments,:abs_year)");
        $activities = json_encode($extensionNames[0], JSON_UNESCAPED_UNICODE);
        $membership = json_encode($extensionNames[1], JSON_UNESCAPED_UNICODE);
        $assignments = json_encode($extensionNames[2], JSON_UNESCAPED_UNICODE);
        
        // bind parameters to the statement
        $stmt->bindParam(':eno', $eno);
        $stmt->bindParam(':year', $year);
        $stmt->bindParam(':activities', $activities);
        $stmt->bindParam(':membership', $membership);
        $stmt->bindParam(':assignments', $assignments);
        $stmt->bindParam(':abs_year', $abs_year);

        $eno = $userDetails['ENo'];

        $stmt->execute();
        // check for errors
        $errorInfo = $stmt->errorInfo();
        if ($stmt->errorInfo()[0] !== '00000') {
            $errorMessage = "Error inserting data into database5. Please try again later.";
            echo "<script>alert('$errorMessage');</script>";
        }
    }
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM pstn WHERE year = :year");
    $stmt->bindParam(':year', $year);
    $stmt->execute();
    $rowCount = $stmt->fetchColumn();

    if ($rowCount > 0) {
        echo "<span style='text-align: center; font-weight: bold;'></span>";
    } else {
        $stmt = $pdo->prepare("INSERT INTO pstn (eno, year, lecturer,reader,professor,abs_year) VALUES (:eno, :year, :lecturer,:reader,:professor,:abs_year)");
        $lecturer = json_encode($positionDates[0], JSON_UNESCAPED_UNICODE);
        $reader = json_encode($positionDates[1], JSON_UNESCAPED_UNICODE);
        $professor = json_encode($positionDates[2], JSON_UNESCAPED_UNICODE);
        
        // bind parameters to the statement
        $stmt->bindParam(':eno', $eno);
        $stmt->bindParam(':year', $year);
        $stmt->bindParam(':lecturer', $lecturer);
        $stmt->bindParam(':reader', $reader);
        $stmt->bindParam(':professor', $professor);
        $stmt->bindParam(':abs_year', $abs_year);

        $eno = $userDetails['ENo'];

        $stmt->execute();
        // check for errors
        $errorInfo = $stmt->errorInfo();
        if ($stmt->errorInfo()[0] !== '00000') {
            $errorMessage = "Error inserting data into database6. Please try again later.";
            echo "<script>alert('$errorMessage');</script>";
        }
    }
    // close the database connection
    $pdo = null;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Teacher Performance Report</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            font-size: 16px;
        }

        body {
            background-color: #f3f3f3;
        }
        .header{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        #logo{
            width: 100px;
            height: auto;
        }
        .bdy {
            margin: 0 5vw 0 5vw;
        }

        table {
            border: 1px solid black;
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            /* Use a fixed table layout */
        }

        td {
            border: 1px solid black;
            padding: 5px;
        }

        td:nth-child(1) {
            width: 5%;
        }

        td:nth-child(3) {
            width: 45%;
            /* Set the width of the third column to 30% */
        }

        .page2>table {
            width: 50%;
        }

        .center {
            margin-left: auto;
            margin-right: auto;
        }

        table.page3 th:nth-child(1) {
            width: 5%;
        }

        table.page3 th:nth-child(2) {
            width: 65%;
        }

        table.page3 th:nth-child(3) {
            width: 15%;
        }

        table.page3 th:nth-child(4) {
            width: 15%;
        }

        table.page3 td {
            white-space: pre-wrap;
        }

        .footer .sig {
            text-align: end;
        }

        .hidden-button,
        #printButton {
            padding: 5px 10px;
            border-radius: 5px;
            border: none;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            text-align: center;
        }

        .hidden-button:hover,
        #printButton:hover {
            background-color: #3e8e41;
        }
    </style>
</head>

<body>
    <div class="bdy">
        <div class="header">
            <img src="au_logo.png" alt=""id="logo">
            <h1>ANDHRA UNIVERSITY</h1>
            <h1>TEACHER PERFORMANCE REPORT</h1>
        </div>
        <div class="tea_det">
            <h3><u>particulars of the Teacher:</u></h3>
            <table id="myTable1">
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Name</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Designation</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Department/College</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Mobile Number</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Email Adress</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>University</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Date of Birth</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>Educational Qualification</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>Total length of service as Teacher in the University</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>Details of teacher Service</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <br><br>
            <table id="position">
                <tr>
                    <th>Position</th>
                    <th>From-to</th>
                    <th>Length of Service(in days)</th>
                    <th>University</th>
                </tr>
                <tr>
                    <td>Lecturer/Asst. Professor</td>
                    <td></td>
                    <td></td>
                    <td>Andhra University</td>
                </tr>
                <tr>
                    <td>Reader/ Assoicate Professor</td>
                    <td></td>
                    <td></td>
                    <td>Andhra University</td>
                </tr>
                <tr>
                    <td>Professor</td>
                    <td></td>
                    <td></td>
                    <td>Andhra University</td>
                </tr>
            </table>
            <br><br>
            <table id="tableTotal">
                <tbody>
                    <tr>
                        <td>11</td>
                        <td>Score Obtained as per Teacher Performance Report</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br><br><br>
        <div class="page2">
            <h1 class="title"><u>Teacher Performance Report</u></h1>
            <h1 class="title">Evaluation of Teacher Performance</h1>
            <table class="center">
                <tbody>
                    <tr>
                        <th>Performance Parameter</th>
                        <th>Weight(%)</th>
                    </tr>
                    <tr>
                        <td>Teaching and contributionto Academia</td>
                        <td>45</td>
                    </tr>
                    <tr>
                        <td>Research and Consultancy</td>
                        <td>40</td>
                    </tr>
                    <tr>
                        <td>Extension</td>
                        <td>15</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br><br>
        <div class="page31">
            <table class="center page3" id="myTable2">
                <tbody>
                    <tr>
                        <th>S.No</th>
                        <th>Performance Parameter</th>
                        <th>Max. Score</th>
                        <th>PerformanceScore</th>
                    </tr>
                    <tr>
                        <td>I</td>
                        <td>C) Awards / Honors / Fellowships received by the teacher
                            (Max. Score : 50)
                            i) State Level : 10 (each)
                            ii) National Level : 15 (each)
                            iii) International Level : 20 (each)</td>
                        <td>600</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>D) Teacher Distinction (Max. Score : 50)
                            i) Nominated / elected to state bodies : 10 (each)
                            ii) Nominated / elected to national bodies : 15 (each)
                            iii) Nominated / elected to International bodies: 20 (each)</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>E) Stay abroad on sabbatical leave for teaching ( Research /
                            Exchange programmed (not for employment ) on invitation
                            (Max. Score : 60)
                            For every 3 months’ stay : 5</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>F) Books authored and published (Max. Score : 200)
                            Single – authored : 40 (each)
                            (Text / Reference Books)
                            Multi – authored : 20 (each)
                            (Text / Reference Books)
                            Single – authored : 20 (each)
                            (Other Books)
                            Multi – authored : 40 (each)
                            (Other Books)
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>II </td>
                        <td>Research and Consultancy
                            A) Research Guidance (Max. Score : 100)
                            i) M.Phil / M.Tech / M.Pharm/LL.M : 5
                            (each)
                            ii) Ph.D : 10 (each)
                            iii) Students presently working for Ph.D : 2 (each)</td>
                        <td>650</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>B) Research Projects operated / under operation
                            (Max. Score: 100)
                            1) Total Number of Projects (Max. Score: 35)
                            (Each : 5)
                            2) Total Value of the Projects (Max. Score: 25)
                            Score
                            Rs. 50 lakh or more : 25
                            Rs. 60 -&lt;80 lakh : 20
                            Rs. 40 -&lt;60 lakh : 15
                            Rs. 20 -&lt;40 lakh : 10
                            < Rs. 20 lakhs=: 5 
                            if arts->  
                            Rs. 40 lakh or more : 25
                            Rs. 30 -&lt;40 lakh : 20
                            Rs. 20 -&lt;30 lakh : 15
                            Rs. 10 -&lt;20 lakh : 10
                            < Rs. 10 lakhs=: 5 
                            3) Number of Projects with funding from outside India (Max. Score: 10) Each : 5 4) Number of projects having collaboration with industry / other research organizations (Max. Score: 10) Each : 5 5) Number of projects having collaboration with other departments in the University (Max. Score: 10) Each : 5 </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>C) Research Publications (Max. Score: 200)
                            1) Research Publications (total) (Max.Score: 175)
                            i) National refereed Journals : 3 (each)
                            ii) International refereed Journals : 5 (each)
                            - 6 -
                            iii) Cumulative impact factor :
                            2) Research Publications (last 3 years) (Max.Score: 25)
                            i) National refereed Journals : 3 (each)
                            ii) International refereed Journals : 5 (each)
                            iii) Cumulative impact factor :</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>D) Patents (Max.Score: 50)
                            i) Patents Granted : 10 (each)
                            ii) Patents applied : 5 (each)</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>E) Member on Editorial Boards of refereed research journals
                            (Max. Score : 25)
                            For each Journal : 5
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>F) Seminars / Conferences / Symposia attended and
                            presented papers / delivered keynote addresses
                            (Max. Score : 50)
                            i) With India : 5 (each)
                            ii) Outside India : 10 (each)
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>G) Seminars / Conferences / Symposia organized
                            (Max. Score : 25)
                            i) National Level : 5 (each)
                            ii) International Level : 10 (each)</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>H) Consultancy (Max. Score : 100)
                            i) Consultancy projects handled : 20 (each)
                            ii) Served / Serving as Consultant to Industry / other
                            Organization : 20 (each)</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>III </td>
                        <td>Extension / Other Activities
                            A) Extension / out reach activities involved in
                            (Max. Score : 100)
                            The activities may include contributing to : environment
                            protection, healthcare in rural / slum population, adult
                            literacy nation building activities, etc..
                            For any recognized and authenticated activity : 20 (each)</td>
                        <td>200</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>B) Membership of Professional Societies, Membership of Governing
                            / Executive / Advisory body of an industry or other sector
                            (Max. Score : 50)
                            Each : 10</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>C) Administrative assignments (including Head of Department,
                            Chairperson BOS, Dean of Faculty , etc.) held
                            (Max. Score : 50)
                            For Each assignment per year : 5
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>MAXIMUM SCORE (TOTAL)</td>
                        <td>1450</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br><br>
        <div class="footer">
            <h1><u>NOTE:</u></h1>
            <h2>1. Calculate each parameter score.</h2>
            <h2>2. Multiply the parameter score with the corresponding weight.</h2>
            <h2>3. Add the weighted parameter scores of all the three parameters.</h2>
            <h2>4. Divide the total weighted score by 56,000 (Maximum possible weighted Score) and
                multiply the result by 100 to get the performance rate of the teacher.</h2>
            <br><br><br>
            <h2 class="sig"><p id="signature"></p><i>SIGNATURE</i></h2>
        </div>
    </div>
    <form method="POST" action="">
        <!-- Add your form fields here -->

        <input type="hidden" name="userDetails" >
        <input type="hidden" name="year" >
        <input type="hidden" name="awardVal" >
        <input type="hidden" name="researchVal" >
        <input type="hidden" name="extensionVal" >
        <input type="hidden" name="awardNames" >
        <input type="hidden" name="researchNames">
        <input type="hidden" name="researchNames1">
        <input type="hidden" name="extensionNames" >
        <input type="hidden" name="dates" >
        <input type="hidden" name="time">
        <input type="hidden" name="tpr_score">

        <button type="submit" name="save" class="hidden-button">Save</button>
    </form>
    <button id="printButton">Print</button>
    <script>
        document.querySelector('input[name="userDetails"]').value = JSON.stringify(userDetails);
        document.querySelector('input[name="year"]').value = year;
        document.querySelector('input[name="awardVal"]').value = JSON.stringify(awardVal);
        document.querySelector('input[name="researchVal"]').value = JSON.stringify(researchVal);
        document.querySelector('input[name="extensionVal"]').value = JSON.stringify(extensionVal);
        document.querySelector('input[name="awardNames"]').value = JSON.stringify(awardNames);
        document.querySelector('input[name="researchNames"]').value = JSON.stringify(researchNames);
        document.querySelector('input[name="researchNames1"]').value = JSON.stringify(researchNames1);
        document.querySelector('input[name="extensionNames"]').value = JSON.stringify(extensionNames);
        document.querySelector('input[name="dates"]').value = JSON.stringify(positionDates);
        document.querySelector('input[name="time"]').value = JSON.stringify(positionTime);
    </script>
    <script>
        // Parse the date string into a Date object
        var dobParts = userDetails.doj.split('/');
        var dobFormatted = dobParts[2] + '-' + dobParts[1] + '-' + dobParts[0];
        var dobDate = new Date(dobFormatted);

// Calculate the age based on the current date
        var ageMs = Date.now() - dobDate.getTime();
        var ageDate = new Date(ageMs);
        var age = Math.abs(ageDate.getUTCFullYear() - 1970);

        var table1 = document.getElementById("myTable1");
        var row = table1.rows[0];
        var cell = row.cells[2];
        cell.innerHTML = userDetails.name;
        row = table1.rows[1];
        cell = row.cells[2];
        cell.innerHTML = userDetails.pos;
        row = table1.rows[2];
        cell = row.cells[2];
        cell.innerHTML = userDetails.Dept;
        row = table1.rows[3];
        cell = row.cells[2];
        cell.innerHTML = userDetails.ph_no;
        row = table1.rows[4];
        cell = row.cells[2];
        cell.innerHTML = userDetails.email;
        row = table1.rows[5];
        cell = row.cells[2];
        cell.innerHTML = "Andhra University";
        row = table1.rows[6];
        cell = row.cells[2];
        cell.innerHTML = userDetails.dob;
        row = table1.rows[7];
        cell = row.cells[2];
        cell.innerHTML = userDetails.HQ;
        row = table1.rows[8];
        cell = row.cells[2];
        cell.innerHTML = age+" days";
        var posTable = document.getElementById("position");
        row = posTable.rows[1];
        cell = row.cells[1];
        cell.innerHTML = positionDates[0][0] + " to " + positionDates[0][1];
        row = posTable.rows[2];
        cell = row.cells[1];
        cell.innerHTML = positionDates[1][0] + " to " + positionDates[1][1];
        row = posTable.rows[3];
        cell = row.cells[1];
        cell.innerHTML = positionDates[2][0] + " to " + positionDates[2][1];
        row = posTable.rows[1];
        cell = row.cells[2];
        cell.innerHTML = positionTime[0];
        row = posTable.rows[2];
        cell = row.cells[2];
        cell.innerHTML = positionTime[1];
        row = posTable.rows[3];
        cell = row.cells[2];
        cell.innerHTML = positionTime[2];
        var table2 = document.getElementById("myTable2");
        row = table2.rows[1];
        cell = row.cells[3];
        cell.innerHTML = parseInt(awardVal[0]);
        row = table2.rows[2];
        cell = row.cells[3];
        cell.innerHTML = parseInt(awardVal[1]);
        row = table2.rows[3];
        cell = row.cells[3];
        cell.innerHTML = parseInt(awardVal[2]);
        row = table2.rows[4];
        cell = row.cells[3];
        cell.innerHTML = parseInt(awardVal[3]);
        row = table2.rows[5];
        cell = row.cells[3];
        cell.innerHTML = parseInt(researchVal[0]);
        row = table2.rows[6];
        cell = row.cells[3];
        cell.innerHTML = parseInt(researchVal[1]);
        row = table2.rows[7];
        cell = row.cells[3];
        cell.innerHTML = parseInt(researchVal[2]);
        row = table2.rows[8];
        cell = row.cells[3];
        cell.innerHTML = parseInt(researchVal[3]);
        row = table2.rows[9];
        cell = row.cells[3];
        cell.innerHTML = parseInt(researchVal[4]);
        row = table2.rows[10];
        cell = row.cells[3];
        cell.innerHTML = parseInt(researchVal[5]);
        row = table2.rows[11];
        cell = row.cells[3];
        cell.innerHTML = parseInt(researchVal[6]);
        row = table2.rows[12];
        cell = row.cells[3];
        cell.innerHTML = parseInt(researchVal[7]);
        row = table2.rows[13];
        cell = row.cells[3];
        cell.innerHTML = parseInt(extensionVal[0]);
        row = table2.rows[14];
        cell = row.cells[3];
        cell.innerHTML = parseInt(extensionVal[1]);
        row = table2.rows[15];
        cell = row.cells[3];
        cell.innerHTML = parseInt(extensionVal[2]);
        var sum = awardVal.reduce((a, b) => {
            return a + b;
        })
        sum += researchVal.reduce((a, b) => {
            return a + b;
        })
        sum += extensionVal.reduce((a, b) => {
            return a + b;
        })
        row = table2.rows[16];
        cell = row.cells[3];
        cell.innerHTML = sum;
        table1 = document.getElementById("tableTotal");
        row = table1.rows[0];
        cell = row.cells[2];
        cell.innerHTML = sum;
        document.querySelector('input[name="tpr_score"]').value = sum;
        var signature=document.getElementById("signature");
        signature.innerHTML=userDetails.name;
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
    <script>
        // Get a reference to the print button
        const printButton = document.getElementById('printButton');

        // Add a click event listener to the print button
        printButton.addEventListener('click', () => {
            // Hide the elements to exclude
            const elementsToExclude = document.querySelectorAll('.hidden-button, #printButton');
            elementsToExclude.forEach((element) => {
                element.style.display = 'none';
            });

            // Create a new jsPDF instance
            const element = document.body;

            // Generate the PDF with options
            html2pdf()
                .set({
                    filename: 'page.pdf',
                    html2canvas: {
                        scale: 2
                    },
                    jsPDF: {
                        unit: 'in',
                        format: 'letter',
                        orientation: 'portrait'
                    }
                })
                .from(element)
                .save()
                .then(() => {
                    // Restore the visibility of the excluded elements
                    elementsToExclude.forEach((element) => {
                        element.style.display = '';
                    });
                });
        });
    </script>


</body>

</html>