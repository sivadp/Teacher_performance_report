<?php
$userDetails = isset($_GET['user-details']) ? $_GET['user-details'] : '';
$year = isset($_GET['year']) ? $_GET['year'] : '';
$awardVal = isset($_GET['award-val']) ? explode(',', $_GET['award-val']) : [];
$awardNames = json_decode(urldecode($_GET['award-names']), true);
$researchVal = isset($_GET['researchVal']) ? explode(',', $_GET['researchVal']) : [];
$researchNames = isset($_GET['researchNames']) ? json_decode($_GET['researchNames'], true) : [];
$researchNames1 = isset($_GET['researchNames1']) ? json_decode($_GET['researchNames1'], true) : [];
$scoreArr = isset($_GET['scoreArr']) ? explode(',', $_GET['scoreArr']) : [];
$selectedPercentage = isset($_GET['selectedPercentage']) ? $_GET['selectedPercentage'] : '';
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
    var extension = getCookieValue('extension');
</script>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Extension</title>
</head>
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

    .block label {
        margin-bottom: 10px;
        font-size: 15px;
        font-weight: bold;
    }

    .inner-block {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        flex-wrap: wrap;
    }

    .block .dropdown-menu {
        width: 300px !important;
        height: auto;
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

    #extension {
        width: 450px;
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
            padding: 0px 10px;
        }

        .inner-block {
            flex-direction: column;
        }

        .block input {
            margin-bottom: 10px;
            width: 95vw;
        }

        .block .dropdown-menu {
            margin-bottom: 10px;
            width: 95vw !important;
        }

        .block .add-button {
            margin-bottom: 10px;
            width: 95vw;
        }

    }
</style>

<body>
    <img src="./au_logo.png" alt="au_logo">
    <header>
        <h1>Extension / Other Activities</h1>
    </header>
    <form method="POST" class="form-container">
        <div class="block">
            <label for="extension">A) Extension / out reach activities involved in (Max. Score : 100)</label>
            <div class="inner-block">
                <select class="dropdown-menu" id="extension">
                    <option value="20">environment protection</option>
                    <option value="20">healthcare in rural</option>
                    <option value="20">slum population</option>
                    <option value="20">adult literacy</option>
                    <option value="20">nation building activities</option>
                </select>
                <input type="text" class="input-field" placeholder="Activity name">
                <button class="add-btn add-button">Add</button>
            </div>
            <ul class="item-list" id="extension-list">
            </ul>
            <div class="block-total" id="extension-block-total"></div>
        </div>
        <div class="block">
            <label for="membership">B) Membership of Professional Societies, Membership of Governing / Executive / Advisory body of an industry or other sector(Max. Score : 50)</label>
            <div class="inner-block">
                <select class="dropdown-menu" id="membership">
                    <option value="10"> Membership of Professional Societies </option>
                    <option value="10"> Membership of Governing/ Executive / Advisory </option>
                </select>
                <input type="text" class="input-field" placeholder="Membership name">
                <button class="add-btn add-button">Add</button>
            </div>
            <ul class="item-list" id="membership-list">
            </ul>
            <div class="block-total" id="membership-block-total"></div>
        </div>
        <div class="block">
            <label for="assignments">C) Administrative assignments held For Each assignment per year (Max. Score : 50) </label>
            <div class="inner-block">
                <select class="dropdown-menu" id="assignments">
                    <option value="5">Head of Department </option>
                    <option value="5">Chairperson BOS</option>
                    <option value="5">Dean of Faculty</option>
                </select>
                <input type="text" class="input-field" placeholder="Membership name">
                <button class="add-btn add-button">Add</button>
            </div>
            <ul class="item-list" id="assignments-list">
            </ul>
            <div class="block-total" id="assignments-block-total"></div>
        </div>
        <input type="submit" value="next" name="submit" id="submit">
        <script>
            var extension_list = document.getElementById("extension-list");
            var extension_block_total = document.getElementById("extension-block-total");
            score = 0;
            JSON.parse(extension["activities"]).forEach(function(item) {
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
                    const currentTotal = parseInt(extension_block_total.textContent.split(' ')[1]); // Get the current total score
                    const newTotal = currentTotal - itemValue; // Subtract the item value from the current total
                    extension_block_total.textContent = `Total: ${newTotal} score`; // Update the block total with the new total score
                });
                li.appendChild(deleteButton);
                extension_list.appendChild(li);
                let val = parseInt(item.split("-")[2].trim());
                score += val;
            });
            extension_block_total.textContent = `Total: ${score} score`;
            score = 0;

            var membership_list = document.getElementById("membership-list");
            var membership_block_total = document.getElementById("membership-block-total");
            score = 0;
            JSON.parse(extension["membership"]).forEach(function(item) {
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
                    const currentTotal = parseInt(membership_block_total.textContent.split(' ')[1]); // Get the current total score
                    const newTotal = currentTotal - itemValue; // Subtract the item value from the current total
                    membership_block_total.textContent = `Total: ${newTotal} score`; // Update the block total with the new total score
                });
                li.appendChild(deleteButton);
                membership_list.appendChild(li);
                let val = parseInt(item.split("-")[2].trim());
                score += val;
            });
            membership_block_total.textContent = `Total: ${score} score`;
            score = 0;

            var assignments_list = document.getElementById("assignments-list");
            var assignments_block_total = document.getElementById("assignments-block-total");
            score = 0;
            JSON.parse(extension["assignments"]).forEach(function(item) {
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
                    const currentTotal = parseInt(assignments_block_total.textContent.split(' ')[1]); // Get the current total score
                    const newTotal = currentTotal - itemValue; // Subtract the item value from the current total
                    assignments_block_total.textContent = `Total: ${newTotal} score`; // Update the block total with the new total score
                });
                li.appendChild(deleteButton);
                assignments_list.appendChild(li);
                let val = parseInt(item.split("-")[2].trim());
                score += val;
            });
            assignments_block_total.textContent = `Total: ${score} score`;
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
                    totalsArr = 100;
                }
                if (totalsArr[1] > 50) {
                    totalsArr = 50;
                }
                if (totalsArr[2] > 50) {
                    totalsArr = 50;
                }

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
                awardNames=encodeURIComponent(JSON.stringify(awardNames));
                researchNames=encodeURIComponent(JSON.stringify(researchNames));
                researchNames1=encodeURIComponent(JSON.stringify(researchNames1));
                scoreArr=encodeURIComponent(JSON.stringify(scoreArr));
                var lists = encodeURIComponent(JSON.stringify(list))
                var url = "position1.php?user-details=" + userDetails + "&year=" + year + "&award-val=" + awardVal + "&award-names=" + awardNames + "&researchVal=" + researchVal + "&researchNames=" + researchNames + "&researchNames1=" + researchNames1 + "&extensionVal=" + totalsArr + "&extensionNames=" + lists+"&scoreArr="+scoreArr+"&selectedPercentage="+selectedPercentage;
                window.location.href = url;
            });
            // Get all the "Add" buttons    
            const addButtons = document.querySelectorAll(".add-btn");

            // Add click event listener to each "Add" button
            addButtons.forEach((addButton) => {
                addButton.addEventListener("click", () => {
                    event.preventDefault();
                    const block = addButton.closest(".block"); // Get the parent block of the clicked "Add" button
                    const inputField = block.querySelector(".input-field"); // Get the input field of the parent block
                    if (inputField.value == "") {
                        return;
                    }
                    const dropdownMenu = block.querySelector(".dropdown-menu"); // Get the dropdown menu of the parent block
                    const itemList = block.querySelector(".item-list"); // Get the item list of the parent block
                    const blockTotal = block.querySelector('.block-total'); // Get the block total element
                    // Get the values of the input field and dropdown menu
                    const inputFieldValue = inputField.value;
                    const dropdownMenuValue = dropdownMenu.value;
                    const dropdownText = dropdownMenu.options[dropdownMenu.selectedIndex].text;
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
        </script>
</body>

</html>