<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <title>Pet Management System</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap">
	<style>
		.button-container {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }
    
    .button-container button {
        margin-bottom: 10px;
        width: 50%;
    }
		body {
			background-image: url('main.png');
			background-repeat: no-repeat;
			background-size: cover;
		}

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: black;
            font-size: 2em;
            font-weight: bold;
            background-color: white;
            border: 1px solid #ddd;
		}
		form {
			background-color: white;
			border: 1px solid #ddd;
			border-radius: 5px;
			padding: 20px;
			max-width: 500px;
			margin: 0 auto;
		}
		label {
			display: block;
			margin-bottom: 10px;
			font-size: 16px;
			color: dark gray;
		}
		
		input[type="submit"] {
			background-color: #4CAF50;
			color: white;
			padding: 10px;
			font-size: 16px;
			border: none;
			border-radius: 5px;
			cursor: pointer;
		}
		input[type="submit"]:hover {
			background-color: #3e8e41;
		}
		.error-message {
			color: red;
			font-weight: bold;
			margin-bottom: 20px;
			font-size: 16px;
		}

		.container {
			display: flex;
			align-items: flex-start;
		}

		.button-container {
			width: 50%;
		}

		.img-container {
			margin-left: 20px;
		}
		.img-container img {
			width: 800px;
			height: 500px;
		}
#petDetails{
    position: fixed; top: 73px; right: 7px; width: 115px;
}
	</style>
	<?php
	session_start();
	if (isset($_SESSION['Account'])){ // Get the variable "Phone" from the session "Account"
 
	$Phone=$_SESSION["Account"];
	}
	else{
		echo '<a href="login.php"> <button type="button" class="submit-btn" margin="100px auto">Click to Login</button> </a>'; 
		exit(); 
}
	    $host = "localhost";
        $username = "root";
        $password = "";
        $database = "4007";

        // Create a new database connection
        $link = mysqli_connect($host, $username, $password, $database);
        if (!$link) {
            die("Fail to register, please try again!<br>");
        }
		
		$sql = "SELECT * FROM user WHERE phone = '$Phone'";
		// 执行查询  
		$result = mysqli_query($link, $sql);  
		// 检查查询结果  
		if ($result) {  
		// 提取数据  
		if ($row = mysqli_fetch_assoc($result)) {  
        $uid=$row["user_id"];
		$Name=$row["user_name"];
		$email=$row["email"];
	} else {  
       $error = "No users found for this mobile phone number!<br>";
    }  
      
    // Release the result set  
    mysqli_free_result($result);  
	} else {  
		echo "Query Failed:" . $conn->error;  
	}
	
	
		$sql = "SELECT * FROM pet WHERE user_id = '$uid' ORDER BY `pet`.`pet_no` ASC"; 
		// Execute the query  
		$resultt = mysqli_query($link, $sql);  
	
	if ($resultt) {  
	   
    $htmlOptions = '<select id="petSelect" onchange="showPetDetails()" class="logo" style="position: fixed; top: 190px; right: 100px; width: 115px;">';  
    // $htmlOptions .= "<option value=''>Select Pet</option>";
	while ($roww = mysqli_fetch_assoc($resultt)) {  
        $pet_name = ($roww["pet_name"]);  
        $pet_no = $roww["pet_no"];  
        $htmlOptions .= "<option value='$pet_no'>$pet_name</option>";  
		
    }  
    $htmlOptions .= '</select>';  
    echo $htmlOptions;    
	// $_SESSION['pet-no'] = $pet_no;

    // If no pets are found, display an error message   
    if (empty($htmlOptions)) {  
        $error = "No pets found for this user!";  
    } else {  
        // Clear the error message (if there was one before)  
        $error = '';  
    }  
      
    // Close the result set  
    mysqli_free_result($resultt);   
} else {  
    echo "Query Failed: " . $conn->error;  
}
	
	?>
</head>
<body>

    <h1>Welcome to record every detail of your pet!</h1>
	<div class="container">
		<div class="button-container">
        	<button class="submit-btn" onclick="location.href='../project/forum.php'">Information Forum</button><br>
        	<button class="submit-btn" onclick="location.href='../../eatPage.php'">Diet Tracking</button><br>
        	<button class="submit-btn" onclick="location.href='../../hydrationPage.php'">Hydration Tracking</button><br>	
        	<button class="submit-btn" onclick="location.href='../../exercisePage.php'">Exercise Tracking</button><br>
        	<button class="submit-btn" onclick="location.href='../../moodPage.php'">Mood Detection</button><br>
			<button class="submit-btn" onclick="location.href='../../analysisPage.php'">Food Analysis</button><br>
    	</div>

		<div class="img-container">
			<img src="mainpage.jpg" alt="Pet Image">
		</div>
	</div>

    <div style="position: fixed; top: 10px; right: 10px;">
        <button class="submit-btn" onclick="location.href='edit1.php'">Edit</button><br><br>
        <button class="submit-btn" onclick="location.href='logout.php'">Logout</button><br><br>
        <button class="submit-btn" onclick="location.href='register3.php'">Register other pets</button><br><br>
    </div>

    <div id="petDetails" style="position: fixed; top: 230px; right: 100px; width: 115px;"></div>
    
    <script>
  function showPetDetails() {  
    var petSelect = document.getElementById("petSelect");  
    var selectedPetNo = petSelect.value;  
    var petDetailsDiv = document.getElementById("petDetails");  
      
    // Clear previous details 
    petDetailsDiv.innerHTML = "";  
      
	// Display the message regardless of whether there is a selected pet or not   
    if (selectedPetNo) {  
        var petName = petSelect.options[petSelect.selectedIndex].text;  
        petDetailsDiv.innerHTML = "Pet ID: " + selectedPetNo + "<br>" +  
                                   "Pet Name: " + petName;  
		// $_SESSION['pet-no'] = $selectedPetNo;
    } else {  
        // If there are no selected pets, you can display an alert message   
        petDetailsDiv.innerHTML = "Current user has no pets";  
    }  
	$_SESSION['pet-no'] = $selectedPetNo;
}  
  
// Calling the showPetDetails function after the page has finished loading 
window.onload = showPetDetails;
document.addEventListener('DOMContentLoaded', (event) => {  
    showPetDetails();  
});
    </script>
</body>
</html>