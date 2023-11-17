<?php
// Retrieve the query parameters from the URL
$scoreArr = json_decode($_GET['scoreArr'], true);
$selectedPercentage = $_GET['selectedPercentage'];
$faculty_details=$_GET['faculty_details'];
$tpr_awards = $_GET['tpr_awards'];
$tpr_research1 = $_GET['tpr_research1'];
$tpr_research2 = $_GET['tpr_research2'];
$extension = $_GET['extension'];
$pstn = $_GET['pstn'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>awards</title>
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
            margin-bottom: 20px;
            font-size: 15px;
            font-weight: bold;
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
                padding: 10px 20px;
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

            }

            .block select {
                width: 95vw !important;
                margin-bottom: 10px;
                margin-right: 0px;
            }

            .block button {
                margin-bottom: 10px;
                margin-right: 0px;
            }
        }
    </style>

</head>

<body>
    <header>
        <h1>Teaching and Contribution to Academia</h1>
    </header>
    <form method="POST" class="form-container">
        <div class="block">
            <label for="awards">1.Awards / Honors / Fellowships received by the teacher (Max. Score : 50)</label>
            <div class="inner-block">
                <select class="dropdown-menu" id="awards">
                    <option value="10">State Level</option>
                    <option value="15">National Level</option>
                    <option value="20">International Level</option>
                </select>
                <input type="text" class="input-field" placeholder="name">
                <button class="add-button add-btn">Add</button>
            </div>
            <ul class="item-list" id="awards_list">
            </ul>
            <div class="block-total" id="awards-block-total"></div>
        </div>

        <div class="block">
            <label for="teacher-distinction-year">2.Teacher Distinction (Max. Score : 50)</label>
            <div class="inner-block">
                <select class="dropdown-menu" id="teacher-distinction-year">
                    <option value="10"> Nominated / elected to state bodies</option>
                    <option value="15"> Nominated / elected to national bodies</option>
                    <option value="20">Nominated / elected to International bodies</option>
                </select>
                <input type="text" class="input-field" placeholder="name">
                <button class="add-button add-btn">Add</button>
            </div>
            <ul class="item-list" id="dist_list">
            </ul>
            <div class="block-total" id="dist-block-total"></div>
        </div>
        <div class="block1">
            <label for="sabbatical-year">3. Stay abroad on sabbatical leave for teaching ( Research /
                Exchange programmed (not for employment ) on invitation) (Max. Score : 60)</label>
            <input type="number" id="sabbatical-year" min="0" placeholder="In months multiple to 3">
            <div class="block-total"id="leave-block-total"></div>
        </div>
        <div class="block">
            <label for="books">4.Books authored and published (Max. Score : 200)</label>
            <div class="inner-block">
                <select class="dropdown-menu" id="books">
                    <option value="40">Single authored (Text / Reference Books) </option>
                    <option value="20">Multi authored (Text / Reference Books)</option>
                    <option value="20">Single authored(Other Books)</option>
                    <option value="10">Multi authored(Other Books)</option>
                </select>
                <input type="text" class="input-field" placeholder="Book name">
                <button class="add-button add-btn">Add</button>
            </div>
            <ul class="item-list" id="books_list">
            </ul>
            <div class="block-total" id="books-block-total"></div>
        </div>
        <input type="submit" value="next" name="submit" id="submit">
    </form>
    <img src="./au_logo.png" alt="au_logo">
</body>
<script>
    var faculty_details=<?php echo json_encode($faculty_details);?>;
    var tpr_awards = <?php echo json_encode($tpr_awards); ?>;
    var tpr_research1 = <?php echo json_encode($tpr_research1); ?>;
    var tpr_research2 = <?php echo json_encode($tpr_research2); ?>;
    var extension = <?php echo json_encode($extension); ?>;
    var pstn = <?php echo json_encode($pstn); ?>;
    var scoreArr=<?php echo json_encode($scoreArr);?>;
    var selectedPercentage=<?php echo json_encode($selectedPercentage);?>;
    var awards = JSON.parse(tpr_awards.awards);
    var books = JSON.parse(tpr_awards.books);
    var teacher_distinction = JSON.parse(tpr_awards.teacher_distinction);
    var leave_time = JSON.parse(tpr_awards.leave_time);
    var awards_list = document.getElementById("awards_list");
    var awardstotalElement = document.getElementById("awards-block-total");
    let score = 0;
    awards.forEach(function(item) {
        let li = document.createElement("li");
        if(item==[0]){
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
            const currentTotal = parseInt(awardstotalElement.textContent.split(' ')[1]); // Get the current total score
            const newTotal = currentTotal - itemValue; // Subtract the item value from the current total
            awardstotalElement.textContent = `Total: ${newTotal} score`; // Update the block total with the new total score
        });
        li.appendChild(deleteButton);
        awards_list.appendChild(li);
        let val = parseInt(item.split("-")[2].trim());
        score += val;
    });
    awardstotalElement.textContent = `Total: ${score} score`;
    score = 0;

    var dist_list = document.getElementById("dist_list");
    var distTotalElement = document.getElementById("dist-block-total");
    teacher_distinction.forEach(function(item) {
        let li = document.createElement("li");
        if(item==[0]){
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
            const currentTotal = parseInt(distTotalElement.textContent.split(' ')[1]); // Get the current total score
            const newTotal = currentTotal - itemValue; // Subtract the item value from the current total
            distTotalElement.textContent = `Total: ${newTotal} score`; // Update the block total with the new total score
        });
        li.appendChild(deleteButton);
        dist_list.appendChild(li);
        let val = parseInt(item.split("-")[2].trim());
        score += val;
    });
    distTotalElement.textContent = `Total: ${score} score`;
    score = 0;
    
    third = document.getElementById('sabbatical-year');
    document.getElementById("leave-block-total").textContent=`Total: ${leave_time} score`;
    third.value=(leave_time/5)*3;
    
    var books_list = document.getElementById("books_list");
    var booksTotalElement = document.getElementById("books-block-total");
    books.forEach(function(item) {
        let li = document.createElement("li");
        if(item==[0]){
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
            const currentTotal = parseInt(booksTotalElement.textContent.split(' ')[1]); // Get the current total score
            const newTotal = currentTotal - itemValue; // Subtract the item value from the current total
            booksTotalElement.textContent = `Total: ${newTotal} score`; // Update the block total with the new total score
        });
        li.appendChild(deleteButton);
        books_list.appendChild(li);
        let val = parseInt(item.split("-")[2].trim());
        score += val;
    });
    booksTotalElement.textContent = `Total: ${score} score`;
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
        const totalsArr = [];

        // Iterate over the .block-total elements and push their values to the array  
        blockTotals.forEach((blockTotal) => {
            const totalValue = blockTotal.innerText;
            let totalNumber = parseInt(totalValue.match(/\d+/)[0]);
            if (!isNaN(totalNumber)) {
                totalsArr.push(totalNumber);
            }
        });
        // Log the array to the console
        var myArray = [];
        if (totalsArr[0] > 50) {
            totalsArr[0] = 50;
        }
        if (totalsArr[1] > 50) {
            totalsArr[1] = 50;
        }
        if (totalsArr[2] > 60) {
            totalsArr[2] = 60;
        }
        if (totalsArr[3] > 200) {
            totalsArr[3] = 200;
        }
        myArray.push(totalsArr);

        const uli = document.querySelectorAll(".item-list");
        const list = [];
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
        var userDetails = faculty_details;
        var year = tpr_awards.abs_year;
        var clg = userDetails.clg;
        var userDetailsStr = encodeURIComponent(JSON.stringify(userDetails));
        var lists = encodeURIComponent(JSON.stringify(list))
        var url = "research1.php?user-details=" + userDetailsStr + "&year=" + year + "&clg=" + clg + "&award-val=" + myArray + "&award-names=" + lists+"&scoreArr="+scoreArr+"&selectedPercentage="+selectedPercentage;
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

    let third = document.getElementById('sabbatical-year');
    third.addEventListener("input", updateThird);
    third.addEventListener("change", updateThird);

    function updateThird(event) {
        let a = document.querySelector("#sabbatical-year").value;
        event.preventDefault();
        let block = event.target.closest(".block1");
        if (a == "") {
            a = 0;
            let blockTotal = block.querySelector('.block-total');
            blockTotal.textContent = `Total: ${a} score`;
            return;
        }
        a = parseInt(a);
        a = a / 3;
        if (Number.isInteger(a)) {
            a = a * 5;
            let blockTotal = block.querySelector('.block-total');
            blockTotal.textContent = `Total: ${a} score`;
        } else {
            a = Math.floor(a);
            a = a * 5;
            let blockTotal = block.querySelector('.block-total');
            blockTotal.textContent = `Total: ${a} score`;
        }
    }
</script>
<script>
    var expirationDate = new Date();
    expirationDate.setDate(expirationDate.getDate() + 1);
    document.cookie = "awards=" + encodeURIComponent(JSON.stringify(tpr_awards)) + "; expires=" + expirationDate.toUTCString() + "; path=/";
    document.cookie = "research1=" + encodeURIComponent(JSON.stringify(tpr_research1)) + "; expires=" + expirationDate.toUTCString() + "; path=/";
    document.cookie = "research2=" + encodeURIComponent(JSON.stringify(tpr_research2)) + "; expires=" + expirationDate.toUTCString() + "; path=/";
    document.cookie = "extension=" + encodeURIComponent(JSON.stringify(extension)) + "; expires=" + expirationDate.toUTCString() + "; path=/";
    document.cookie = "pstn=" + encodeURIComponent(JSON.stringify(pstn)) + "; expires=" + expirationDate.toUTCString() + "; path=/";
</script>

</html>