<?php
// Retrieve the values from the URL parameters
// Retrieve the query parameters from the URL
$scoreArr = json_decode($_GET['scoreArr'], true);
$selectedPercentage = $_GET['selectedPercentage'];
$userDetails = $_GET['user-details'];
$year = $_GET['year'];
$clg = $_GET['clg'];
$awardValues = explode(',', $_GET['award-val']);
$awardNames = json_decode($_GET['award-names'], true);
?>
<script>
    var userDetails = <?php echo json_encode($userDetails); ?>;
    var year = <?php echo json_encode($year); ?>;
    var clg = <?php echo json_encode($clg); ?>;
    var awardValues = <?php echo json_encode($awardValues); ?>;
    var awardNames = <?php echo json_encode($awardNames); ?>;
    var scoreArr=<?php echo json_encode($scoreArr);?>;
    var selectedPercentage=<?php echo json_encode($selectedPercentage);?>;
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
    var tpr_research1 = getCookieValue('research1');
    var tpr_research2 = getCookieValue('research2');
</script>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>research</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            font-size: 16px;
        }

        body {
            background-color: #435165;
            margin: 0 5vw 0 5vw;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        body img {
            pointer-events: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            z-index: 10;
            opacity: 0.2;
        }

        header {
            color: #fff;
            padding: 20px;
        }

        .block {
            width: 100%;
            padding: 30px 80px;
            border: 1px solid black;
            background-color: aliceblue;
            display: flex;
            flex-direction: column;
        }

        .block1 {
            width: 100%;
            padding: 30px 80px;
            border: 1px solid black;
            background-color: aliceblue;
            display: flex;
            flex-direction: column;
        }

        .block label {
            margin-bottom: 10px;
            font-size: 15px;
            font-weight: bold;
        }

        .block1 label {
            margin-bottom: 5px;
            font-size: 15px;
            font-weight: bold;
        }

        .block1 input {
            margin-bottom: 20px;
        }

        .inner-block {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .block select {
            width: 250px !important;
            height: max-content;
        }

        .block button {
            height: max-content;
        }

        .item-list li {
            margin-bottom: 5px;
        }

        .add-button {
            padding: 5px 10px;
            border-radius: 5px;
            border: none;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        .add-button:hover {
            background-color: #3e8e41;
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

        .delete-button {
            background-color: transparent;
            border: none;
            font-size: 20px;
            cursor: pointer;
        }

        @media only screen and (max-width: 600px) {
            body {
                margin: 0px;

            }

            .block {
                padding: 10px 10px;
            }

            .block1 {
                padding: 10px 20px;
            }

            .inner-block {
                flex-direction: column;
            }

            .block input {
                margin-bottom: 10px;
                margin-right: 0px;
                width: 100%;
            }

            .block select {
                margin-bottom: 10px;
                margin-right: 0px;
                width: 95vw !important;
            }

            .block button {
                margin-bottom: 10px;
                margin-right: 0px;
            }
        }
    </style>
</head>

<body>
    <img src="./au_logo.png" alt="au_logo">
    <header>
        <h1>Research and Consultancy</h1>
    </header>
    <form method="POST" class="form-container">
        <div class="block">
            <label for="Research">A) Research Guidance (Max. Score: 100)</label>
            <div class="inner-block">
                <select class="dropdown-menu" id="Research">
                    <option value="5">M.Phil / M.Tech / M.Pharm/LL.M</option>
                    <option value="10">Ph.D</option>
                    <option value="2">Students presently working for Ph.D</option>
                </select>

                <input type="number" class="input-field" min="0" placeholder="Enter how many">

                <button class="add-button add-btn1">Add</button>
            </div>
            <ul class="item" id="research-list"></ul>
            <div class="block-total" id="research-block-total"></div>
        </div>

        <div class="block1">
            <label>B) Research Projects operated / under operation (Max. Score: 100)</label>
            <label for="Tnum"> 1) Total Number of Projects</label>
            <input type="number" id="Tnum" min="0" placeholder="min=0 max=7">
            <label for="cost">2) Total Value of the Projects </label>
            <input type="number" id="cost" min="0" placeholder="in lakhs ex:30">
            <label for="fund">3) Number of Projects with funding from outside India </label>
            <input type="number" id="fund" min="0" placeholder="min=0 max=2">
            <label for="col_ind"> 4) Number of projects having collaboration with industry / other research organizations </label>
            <input type="number" id="col_ind" min="0" placeholder="min=0 max=2">
            <label for="col_oth">5) Number of projects having collaboration with other departments in the University </label>
            <input type="number" id="col_oth" min="0" placeholder="min=0 max=2">
            <div class="block-total" id="projects-block-total"></div>
        </div>
        <div class="block">
            <label>C) Research Publications (max.score:200)</label>
            <label for="publications1"> 1) Research Publications (total) (Max.Score: 175)</label>
            <div class="inner-block">
                <select class="dropdown-menu" id="publications1">
                    <option value="3">National refereed Journals</option>
                    <option value="5">International refereed Journals</option>
                </select>
                <input type="number" class="input-field" min="0" placeholder="Enter how many">
                <button class="add-button add-btn1">Add</button>
            </div>
            <ul class="item" id="publications1-list"></ul>
            <div class="block-total" id="publications1-block-total"></div>
        </div>
        <div class="block">
            <label for="publications2"> 2) Research Publications (last 3 years) (Max.Score: 25)</label>
            <div class="inner-block">
                <select class="dropdown-menu" id="publications2">
                    <option value="3">National refereed Journals </option>
                    <option value="5">International refereed Journals</option>
                </select>
                <input type="number" class="input-field" min="0" placeholder="Enter how many">
                <button class="add-button add-btn1">Add</button>
            </div>
            <ul class="item" id="publications2-list"></ul>
            <div class="block-total" id="publications2-block-total"></div>
        </div>
        <div class="block">
            <label for="Patents">D) Patents (Max.Score: 50)</label>
            <div class="inner-block">
                <select class="dropdown-menu" id="Patents">
                    <option value="10">Patents Granted</option>
                    <option value="5">Patents applied</option>
                </select>
                <input type="number" class="input-field" min="0" placeholder="Enter how many">
                <button class="add-button add-btn1">Add</button>
            </div>
            <ul class="item" id="patents-list"></ul>
            <div class="block-total" id="patents-block-total"></div>
        </div>
        <div class="block">
            <label for="journal">E) Member on Editorial Boards of refereed research journals (Max. Score : 25)</label>
            <div class="inner-block">
                <select class="dropdown-menu" id="journal">
                    <option value="5">research journal </option>
                </select>
                <input type="text" class="input-field" placeholder="Enter name">
                <button class="add-button add-btn">Add</button>
            </div>
            <ul class="item-list" id="journal-list">
            </ul>
            <div class="block-total" id="journal-block-total"></div>
        </div>
        <div class="block">
            <label for="attended">F) Seminars / Conferences / Symposia attended and presented papers / delivered keynote addresses (Max. Score : 50)</label>
            <div class="inner-block">
                <select class="dropdown-menu" id="attended">
                    <option value="10">With India </option>
                    <option value="5">Outside India</option>
                </select>
                <input type="text" class="input-field" placeholder="Enter name">
                <button class="add-button add-btn">Add</button>
            </div>
            <ul class="item-list" id="attended-list">
            </ul>
            <div class="block-total" id="attended-block-total"></div>
        </div>
        <div class="block">
            <label for="organised">G) Seminars / Conferences / Symposia organized (Max. Score : 25)</label>
            <div class="inner-block">
                <select class="dropdown-menu" id="organised">
                    <option value="5">National Level </option>
                    <option value="10">International Level </option>
                </select>
                <input type="text" class="input-field" placeholder="Enter name">
                <button class="add-button add-btn">Add</button>
            </div>
            <ul class="item-list" id="organised-list">
            </ul>
            <div class="block-total" id="organised-block-total"></div>
        </div>
        <div class="block">
            <label for="consultancy">H) Consultancy (Max. Score : 100)</label>
            <div class="inner-block">
                <select class="dropdown-menu" id="consultancy">
                    <option value="20">Consultancy projects handled </option>
                    <option value="20">Served / Serving as Consultant to Industry / other Organization</option>
                </select>
                <input type="text" class="input-field" placeholder="Enter name">
                <button class="add-button add-btn">Add</button>
            </div>
            <ul class="item-list" id="consultancy-list">
            </ul>
            <div class="block-total" id="consultancy-block-total"></div>
        </div>
        <input type="submit" value="next" name="submit" id="submit">
    </form>
</body>
<script>
    var research_list = document.getElementById("research-list");
    var research_block_total = document.getElementById("research-block-total");
    let score = 0;
    JSON.parse(tpr_research2["guidance"]).forEach(function(item) {
        let li = document.createElement("li");
        if (item == [0]) {
            return;
        }
        let itext = item.split("-")[0].trim();
        let ival = item.split("-")[2].trim();
        item = itext + " - " + ival;
        li.textContent = item;
        deleteButton = document.createElement("button");
        deleteButton.innerHTML = "&#10006;";
        deleteButton.classList.add("delete-button");
        deleteButton.addEventListener("click", () => {
            event.preventDefault();
            const itemValue = parseInt(li.textContent.split(' - ')[1]); // Get the value of the list item
            li.remove(); // Remove the list item when the "Delete" button is clicked
            const currentTotal = parseInt(research_block_total.textContent.split(' ')[1]); // Get the current total score
            const newTotal = currentTotal - itemValue; // Subtract the item value from the current total
            research_block_total.textContent = `Total: ${newTotal} score`; // Update the block total with the new total score
        });
        li.appendChild(deleteButton);
        research_list.appendChild(li);
        val = parseInt(item.split("-")[1].trim());
        score += val;
    });
    research_block_total.textContent = `Total: ${score} score`;
    score = 0;

    var projects_block_total = document.getElementById("projects-block-total");
    projects_block_total.textContent = `Total: ${tpr_research2["projects_val"]} score`

    var publications1_list = document.getElementById("publications1-list");
    var publications1_block_total = document.getElementById("publications1-block-total");
    score = 0;
    JSON.parse(tpr_research2["publications_total"]).forEach(function(item) {
        let li = document.createElement("li");
        if (item == [0]) {
            return;
        }
        let itext = item.split("-")[0].trim();
        let ival = item.split("-")[2].trim();
        item = itext + " - " + ival;
        li.textContent = item;
        deleteButton = document.createElement("button");
        deleteButton.innerHTML = "&#10006;";
        deleteButton.classList.add("delete-button");
        deleteButton.addEventListener("click", () => {
            event.preventDefault();
            const itemValue = parseInt(li.textContent.split(' - ')[1]); // Get the value of the list item
            li.remove(); // Remove the list item when the "Delete" button is clicked
            const currentTotal = parseInt(publications1_block_total.textContent.split(' ')[1]); // Get the current total score
            const newTotal = currentTotal - itemValue; // Subtract the item value from the current total
            publications1_block_total.textContent = `Total: ${newTotal} score`; // Update the block total with the new total score
        });
        li.appendChild(deleteButton);
        publications1_list.appendChild(li);
        val = parseInt(item.split("-")[1].trim());
        score += val;
    });
    publications1_block_total.textContent = `Total: ${score} score`;
    score = 0;

    var publications2_list = document.getElementById("publications2-list");
    var publications2_block_total = document.getElementById("publications2-block-total");
    score = 0;
    JSON.parse(tpr_research2["publications_3"]).forEach(function(item) {
        let li = document.createElement("li");
        if (item == [0]) {
            return;
        }
        let itext = item.split("-")[0].trim();
        let ival = item.split("-")[2].trim();
        item = itext + " - " + ival;
        li.textContent = item;
        deleteButton = document.createElement("button");
        deleteButton.innerHTML = "&#10006;";
        deleteButton.classList.add("delete-button");
        deleteButton.addEventListener("click", () => {
            event.preventDefault();
            const itemValue = parseInt(li.textContent.split(' - ')[1]); // Get the value of the list item
            li.remove(); // Remove the list item when the "Delete" button is clicked
            const currentTotal = parseInt(publications2_block_total.textContent.split(' ')[1]); // Get the current total score
            const newTotal = currentTotal - itemValue; // Subtract the item value from the current total
            publications2_block_total.textContent = `Total: ${newTotal} score`; // Update the block total with the new total score
        });
        li.appendChild(deleteButton);
        publications2_list.appendChild(li);
        val = parseInt(item.split("-")[1].trim());
        score += val;
    });
    publications2_block_total.textContent = `Total: ${score} score`;
    score = 0;

    var patents_list = document.getElementById("patents-list");
    var patents_block_total = document.getElementById("patents-block-total");
    score = 0;
    JSON.parse(tpr_research2["patents"]).forEach(function(item) {
        let li = document.createElement("li");
        if (item == [0]) {
            return;
        }
        let itext = item.split("-")[0].trim();
        let ival = item.split("-")[2].trim();
        item = itext + " - " + ival;
        li.textContent = item;
        deleteButton = document.createElement("button");
        deleteButton.innerHTML = "&#10006;";
        deleteButton.classList.add("delete-button");
        deleteButton.addEventListener("click", () => {
            event.preventDefault();
            const itemValue = parseInt(li.textContent.split(' - ')[1]); // Get the value of the list item
            li.remove(); // Remove the list item when the "Delete" button is clicked
            const currentTotal = parseInt(patents_block_total.textContent.split(' ')[1]); // Get the current total score
            const newTotal = currentTotal - itemValue; // Subtract the item value from the current total
            patents_block_total.textContent = `Total: ${newTotal} score`; // Update the block total with the new total score
        });
        li.appendChild(deleteButton);
        patents_list.appendChild(li);
        val = parseInt(item.split("-")[1].trim());
        score += val;
    });
    patents_block_total.textContent = `Total: ${score} score`;
    score = 0;

    var journal_list = document.getElementById("journal-list");
    var journal_block_total = document.getElementById("journal-block-total");
    score = 0;
    JSON.parse(tpr_research1["journals"]).forEach(function(item) {
        let li = document.createElement("li");
        if (item == [0]) {
            return;
        }
        li.textContent = item;
        deleteButton = document.createElement("button");
        deleteButton.innerHTML = "&#10006;";
        deleteButton.classList.add("delete-button");
        deleteButton.addEventListener("click", () => {
            event.preventDefault();
            const itemValue = parseInt(li.textContent.split(' - ')[1]); // Get the value of the list item
            li.remove(); // Remove the list item when the "Delete" button is clicked
            const currentTotal = parseInt(journal_block_total.textContent.split(' ')[1]); // Get the current total score
            const newTotal = currentTotal - itemValue; // Subtract the item value from the current total
            journal_block_total.textContent = `Total: ${newTotal} score`; // Update the block total with the new total score
        });
        li.appendChild(deleteButton);
        journal_list.appendChild(li);
        let val = parseInt(item.split("-")[2].trim());
        score += val;
    });
    journal_block_total.textContent = `Total: ${score} score`;
    score = 0;

    var attended_list = document.getElementById("attended-list");
    var attended_block_total = document.getElementById("attended-block-total");
    score = 0;
    JSON.parse(tpr_research1["sem_atd"]).forEach(function(item) {
        let li = document.createElement("li");
        if (item == [0]) {
            return;
        }
        li.textContent = item;
        deleteButton = document.createElement("button");
        deleteButton.innerHTML = "&#10006;";
        deleteButton.classList.add("delete-button");
        deleteButton.addEventListener("click", () => {
            event.preventDefault();
            const itemValue = parseInt(li.textContent.split(' - ')[1]); // Get the value of the list item
            li.remove(); // Remove the list item when the "Delete" button is clicked
            const currentTotal = parseInt(attended_block_total.textContent.split(' ')[1]); // Get the current total score
            const newTotal = currentTotal - itemValue; // Subtract the item value from the current total
            attended_block_total.textContent = `Total: ${newTotal} score`; // Update the block total with the new total score
        });
        li.appendChild(deleteButton);
        attended_list.appendChild(li);
        let val = parseInt(item.split("-")[2].trim());
        score += val;
    });
    attended_block_total.textContent = `Total: ${score} score`;
    score = 0;

    var organised_list = document.getElementById("organised-list");
    var organised_block_total = document.getElementById("organised-block-total");
    score = 0;
    JSON.parse(tpr_research1["sem_org"]).forEach(function(item) {
        let li = document.createElement("li");
        if (item == [0]) {
            return;
        }
        li.textContent = item;
        deleteButton = document.createElement("button");
        deleteButton.innerHTML = "&#10006;";
        deleteButton.classList.add("delete-button");
        deleteButton.addEventListener("click", () => {
            event.preventDefault();
            const itemValue = parseInt(li.textContent.split(' - ')[1]); // Get the value of the list item
            li.remove(); // Remove the list item when the "Delete" button is clicked
            const currentTotal = parseInt(organised_block_total.textContent.split(' ')[1]); // Get the current total score
            const newTotal = currentTotal - itemValue; // Subtract the item value from the current total
            organised_block_total.textContent = `Total: ${newTotal} score`; // Update the block total with the new total score
        });
        li.appendChild(deleteButton);
        organised_list.appendChild(li);
        let val = parseInt(item.split("-")[2].trim());
        score += val;
    });
    organised_block_total.textContent = `Total: ${score} score`;
    score = 0;

    var consultancy_list = document.getElementById("consultancy-list");
    var consultancy_block_total = document.getElementById("consultancy-block-total");
    score = 0;
    JSON.parse(tpr_research1["consultancy"]).forEach(function(item) {
        let li = document.createElement("li");
        if (item == [0]) {
            return;
        }
        li.textContent = item;
        deleteButton = document.createElement("button");
        deleteButton.innerHTML = "&#10006;";
        deleteButton.classList.add("delete-button");
        deleteButton.addEventListener("click", () => {
            event.preventDefault();
            const itemValue = parseInt(li.textContent.split(' - ')[1]); // Get the value of the list item
            li.remove(); // Remove the list item when the "Delete" button is clicked
            const currentTotal = parseInt(consultancy_block_total.textContent.split(' ')[1]); // Get the current total score
            const newTotal = currentTotal - itemValue; // Subtract the item value from the current total
            consultancy_block_total.textContent = `Total: ${newTotal} score`; // Update the block total with the new total score
        });
        li.appendChild(deleteButton);
        consultancy_list.appendChild(li);
        let val = parseInt(item.split("-")[2].trim());
        score += val;
    });
    consultancy_block_total.textContent = `Total: ${score} score`;
    score = 0;
</script>
<script>
    // Select the Next button
    const nextBtn = document.querySelector("#submit");

    // Add click event listener to the Next button
    nextBtn.addEventListener("click", (event) => {
        event.preventDefault();
        const blockTotals = document.querySelectorAll(".block-total");
        for (let i = 0; i < blockTotals.length; i++) {
            const element = blockTotals[i];
            if (element.innerText == "") {
                element.innerText = 0;
            }
        }
        // Create an empty array to store the .block-total values
        let totalsArr = [];

        // Iterate over the .block-total elements and push their values to the array  
        blockTotals.forEach((blockTotal) => {
            const totalValue = blockTotal.innerText;
            let totalNumber = parseInt(totalValue.match(/\d+/)[0]);
            if (!isNaN(totalNumber)) {
                totalsArr.push(totalNumber);
            }
        });
        if (totalsArr[0] > 100) {
            totalsArr[0] = 100;
        }
        if (totalsArr[1] > 100) {
            totalsArr[1] = 100;
        }
        if (totalsArr[2] > 175) {
            totalsArr[2] = 175;
        }
        if (totalsArr[3] > 25) {
            totalsArr[3] = 25;
        }
        if (totalsArr[4] > 50) {
            totalsArr[4] = 50;
        }
        if (totalsArr[5] > 25) {
            totalsArr[5] = 25;
        }
        if (totalsArr[6] > 50) {
            totalsArr[6] = 50;
        }
        if (totalsArr[7] > 25) {
            totalsArr[7] = 25;
        }
        if (totalsArr[8] > 100) {
            totalsArr[8] = 100;
        }
        var k = totalsArr[2] + totalsArr[3];
        totalsArr.splice(2, 2, k);

        const uli = document.querySelectorAll(".item-list");
        let list = [];
        uli.forEach(ul => {
            let a = [];
            if (ul.outerText == '') {
                a.push(0);
                list.push(a);
                return;
            }
            let k = ul.outerText.split("\n");
            k.forEach(i => {
                let lastIndex = i.lastIndexOf(String.fromCharCode(10006));
                let resultString = i.substring(0, lastIndex).trim();
                a.push(resultString);
            })
            list.push(a);
        })
        const uli1 = document.querySelectorAll(".item");
        let list1 = [];
        uli1.forEach(ul => {
            let a = [];
            if (ul.outerText == '') {
                a.push(0);
                list1.push(a);
                return;
            }
            let k = ul.outerText.split("\n");
            k.forEach(i => {
                let lastIndex = i.lastIndexOf(String.fromCharCode(10006));
                let resultString = i.substring(0, lastIndex).trim();
                let b = resultString.lastIndexOf("-");
                let text = resultString.substring(0, b).trim();
                let bval = resultString.substring(b + 1).trim();
                bval = parseInt(bval);
                if (text == "M.Phil / M.Tech / M.Pharm/LL.M") {
                    bval = bval / 5;
                    text = text + " - " + bval;
                } else if (text == "Ph.D") {
                    bval = bval / 10;
                    text = text + " - " + bval;
                } else if (text == "Students presently working for Ph.D") {
                    bval = bval / 2;
                    text = text + " - " + bval;
                } else if (text == "National refereed Journals") {
                    bval = bval / 3;
                    text = text + " - " + bval;
                } else if (text == "International refereed Journals") {
                    bval = bval / 5;
                    text = text + " - " + bval;
                } else if (text == "Patents Granted") {
                    bval = bval / 10;
                    text = "Patents Granted - " + bval;
                } else if (text == "Patents applied") {
                    bval = bval / 5;
                    text = "Patents applied - " + bval;
                }
                a.push(text);
            })
            list1.push(a);
        })
        list1.splice(1,0,totalsArr[1]);
        awardNames=encodeURIComponent(JSON.stringify(awardNames));
        list1 = encodeURIComponent(JSON.stringify(list1));
        var lists = encodeURIComponent(JSON.stringify(list))
        var url = "extension1.php?user-details=" + userDetails + "&year=" + year + "&award-val=" + awardValues + "&award-names=" + awardNames + "&researchVal=" + totalsArr + "&researchNames=" + lists + "&researchNames1=" + list1+"&scoreArr="+scoreArr+"&selectedPercentage="+selectedPercentage;
        window.location.href = url;
    });

    // Get all the "Add" buttons    
    const addButtons = document.querySelectorAll(".add-btn");

    // Add click event listener to each "Add" button
    addButtons.forEach((addButton) => {
        addButton.addEventListener("click", (event) => {
            event.preventDefault();
            const block = addButton.closest(".block"); // Get the parent block of the clicked "Add" button
            const inputField = block.querySelector(".input-field"); // Get the input field of the parent block
            if (inputField.value === "") {
                return;
            }
            const dropdownMenu = block.querySelector(".dropdown-menu"); // Get the dropdown menu of the parent block
            const dropdownText = dropdownMenu.options[dropdownMenu.selectedIndex].text;
            const itemList = block.querySelector(".item-list"); // Get the item list of the parent block
            const blockTotal = block.querySelector('.block-total'); // Get the block total element

            // Get the values of the input field and dropdown menu
            const inputFieldValue = inputField.value;
            const dropdownMenuValue = dropdownMenu.value;

            // Create a new list item element with the input field and dropdown menu values
            const listItem = document.createElement("li");
            listItem.innerHTML = `${dropdownText}-${inputFieldValue} - ${dropdownMenuValue}`;

            // Create a "Delete" button for the list item
            const deleteButton = document.createElement("button");
            deleteButton.innerHTML = "&#10006;";
            deleteButton.classList.add("delete-button");
            deleteButton.addEventListener("click", () => {
                const itemValue = parseInt(listItem.textContent.split(' - ')[1]); // Get the value of the list item
                listItem.remove(); // Remove the list item when the "Delete" button is clicked
                const currentTotal = parseInt(blockTotal.textContent.split(' ')[1]); // Get the current total score
                const newTotal = currentTotal - itemValue; // Subtract the item value from the current total
                blockTotal.textContent = `Total: ${newTotal} score`; // Update the block total with the new total score
            });

            // Append the "Delete" button to the list item
            listItem.appendChild(deleteButton);

            // Append the new list item to the item list
            itemList.appendChild(listItem);

            // Reset the input field and dropdown menu
            inputField.value = "";
            dropdownMenu.selectedIndex = 0;

            const totalItems = block.querySelectorAll('.item-list li'); // Get all the list items of the block
            let totalValue = 0; // Initialize the total value of the block to 0
            totalItems.forEach((item) => {
                const itemValue = parseInt(item.textContent.split(' - ')[1]); // Get the value of the list item
                totalValue += itemValue; // Add the value to the total value of the block
            });

            blockTotal.textContent = `Total: ${totalValue} score`;
        });
    });

    const input1 = document.getElementById("Tnum");
    const input2 = document.getElementById("cost");
    const input3 = document.getElementById("fund");
    const input4 = document.getElementById("col_ind");
    const input5 = document.getElementById("col_oth");

    function updateBlockTotal() {
        const block = input2.closest(".block1");
        let block1_tot_for_input2 = 0;
        let a = parseInt(input1.value);
        let b = parseInt(input2.value);
        let c = parseInt(input3.value);
        let d = parseInt(input4.value);
        let e = parseInt(input5.value);
        if (isNaN(a)) {
            a = 0;
        }
        if (isNaN(c)) {
            c = 0;
        }
        if (isNaN(d)) {
            d = 0;
        }
        if (isNaN(e)) {
            e = 0;
        }
        let block1_tot = a * 5 + c * 5 + d * 5 + e * 5;
        if (clg != 'Arts') {
            if (b >= 80) {
                block1_tot_for_input2 = 25;
            } else if (b >= 60 && b < 80) {
                block1_tot_for_input2 = 20;
            } else if (b >= 40 && b < 60) {
                block1_tot_for_input2 = 15;
            } else if (b >= 20 && b < 40) {
                block1_tot_for_input2 = 10;
            } else if (b < 20) {
                block1_tot_for_input2 = 5;
            }
        } else {
            if (b >= 40) {
                block1_tot_for_input2 = 25;
            } else if (b >= 30 && b < 40) {
                block1_tot_for_input2 = 20;
            } else if (b >= 20 && b < 30) {
                block1_tot_for_input2 = 15;
            } else if (b >= 10 && b < 20) {
                block1_tot_for_input2 = 10;
            } else if (b < 10) {
                block1_tot_for_input2 = 5;
            }

        }
        block1_tot = block1_tot + block1_tot_for_input2;
        const blockTotal = block.querySelector('.block-total');
        blockTotal.textContent = `Total: ${block1_tot} score`;
    }
    input1.addEventListener("input", updateBlockTotal);
    input2.addEventListener("input", updateBlockTotal);
    input3.addEventListener("input", updateBlockTotal);
    input4.addEventListener("input", updateBlockTotal);
    input5.addEventListener("input", updateBlockTotal);

    const addButton1 = document.querySelectorAll('.add-btn1');

    addButton1.forEach((addButton) => {
        addButton.addEventListener('click', (event) => {
            event.preventDefault();
            const block = addButton.closest('.block');
            const dropdown = block.querySelector('.dropdown-menu');
            const dropdownText = dropdown.options[dropdown.selectedIndex].text;
            const dropdownValue = dropdown.value;
            const blockTotal = block.querySelector('.block-total');
            const inputField = block.querySelector('.input-field');
            if (inputField.value === "") {
                return;
            }
            const inputValue = inputField.value;

            if (!inputValue || inputValue <= 0) {
                return;
            }

            const itemValue = dropdownValue * inputValue;

            const itemList = block.querySelector('.item');

            const listItem = document.createElement('li');
            listItem.innerHTML = `${dropdownText} - ${itemValue}`;

            const deleteButton = document.createElement('button');
            deleteButton.innerHTML = '&#10006;';
            deleteButton.classList.add('delete-button');

            deleteButton.addEventListener("click", () => {
                const itemValue = parseInt(listItem.textContent.split(' - ')[1]); // Get the value of the list item
                listItem.remove(); // Remove the list item when the "Delete" button is clicked
                const currentTotal = parseInt(blockTotal.textContent.split(' ')[1]); // Get the current total score
                const newTotal = currentTotal - itemValue; // Subtract the item value from the current total
                blockTotal.textContent = `Total: ${newTotal} score`; // Update the block total with the new total score
            });

            listItem.appendChild(deleteButton);
            itemList.appendChild(listItem);

            inputField.value = '';
            dropdown.selectedIndex = 0;
            const totalItems = block.querySelectorAll('.item li'); // Get all the list items of the block
            let totalValue = 0; // Initialize the total value of the block to 0
            totalItems.forEach((item) => {
                const itemValue = parseInt(item.textContent.split(' - ')[1]); // Get the value of the list item
                totalValue += itemValue; // Add the value to the total value of the block
            });

            blockTotal.textContent = `Total: ${totalValue} score`;
        });
    });
</script>

</html>