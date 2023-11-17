<?php
$data_encoded = $_GET['data'];

// Base64 decode the data to retrieve the JSON
$data_json = base64_decode($data_encoded);

// Decode the JSON to retrieve the original data array
$data = json_decode($data_json, true);

// Access the values
$user_details = $data['user_details'];
$year = $data['year'];
$clg = $data['clg'];
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
            <ul class="item-list">
            </ul>
            <div class="block-total"></div>
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
            <ul class="item-list">
            </ul>
            <div class="block-total"></div>
        </div>
        <div class="block1">
            <label for="sabbatical-year">3. Stay abroad on sabbatical leave for teaching ( Research /
                Exchange programmed (not for employment ) on invitation) (Max. Score : 60)</label>
            <input type="number" id="sabbatical-year" min="0" placeholder="In months multiple to 3">
            <div class="block-total"></div>
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
            <ul class="item-list">
            </ul>
            <div class="block-total"></div>
        </div>
        <input type="submit" value="next" name="submit" id="submit">
    </form>
    <img src="./au_logo.png" alt="au_logo">
</body>

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
        function encodeToBase64(string) {
            const encoder = new TextEncoder('utf-8');
            const data = encoder.encode(string);
            const base64 = btoa(String.fromCharCode.apply(null, data));

            return base64;
        }
        var userDetails = <?php echo json_encode($user_details); ?>;
        var year = <?php echo json_encode($year); ?>;
        var clg = <?php echo json_encode($clg); ?>;
        // Base64 encode the data
        var encodedUserDetails = encodeToBase64(JSON.stringify(userDetails));
        var encodedLists = encodeToBase64(JSON.stringify(list));
        var url = "research.php?user-details=" + encodedUserDetails + "&year=" + year + "&clg=" + clg + "&award-val=" + myArray + "&award-names=" + encodedLists;
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

</html>