<!DOCTYPE html> 
<html>
<head>
	<meta charset="utf-8" /> <!---able to use Chinese--->
	<title>Manager Login Page</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap">
	<style>
		body {
			background-image: url('login.png');
			background-repeat: no-repeat;
			background-size: cover;
		}

        h1 {
            text-align: center;
            margin-bottom: 30px; /* the bottom margin of the element */
            color: black;
            font-size: 2em; /* Twice the font size of the parent element */
            font-weight: bold;
            background-color: white;
            border: 1px solid #ddd; /* Border set to 1 pixel wide, solid line style, border color light gray */
		}

		
		form {
			background-color: white;
			border: 1px solid #ddd;
			border-radius: 5px; /* The four corners are rounded to 5 pixels */
			padding: 20px;
			max-width: 500px;
			margin: 0 auto; /* horizontal center alignment */
		}
		label {
			display: block; /* A block-level element  occupy a single line and fill the width of the parent container. */
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


	</style>
</head>


<body >
	<?php
		session_start();
		$mID = "";
		$password = "";
		$error = "";
	
		if ( isset($_POST["login"]) ) {  // check whether Login button is clicked
        	
			// obtain form data
	    	if ( isset($_POST["mID"]) ) {
	    	$mID = $_POST["mID"];}
        	if ( isset($_POST["password"]) ){
	    	$password = $_POST["password"];}
        
            // check if users input data for name
            if  (empty($mID)) {         
                $error = "Manager ID is required!<br>";
            }
            else if  (empty($password)) {
            // check if users input data for user name        
                $error = "Password is required!<br>";
            }
            else
            {     
                // connect to MYSQL database
			    $link = mysqli_connect("localhost","root","","4007")
                or die("Cannot open MySQL database connection!<br/>");

				// Set the character set to utf8
                mysqli_query($link, 'SET NAMES utf8'); 

                // Sanitize user input
                $mID = mysqli_real_escape_string($link, $mID);
                $password = mysqli_real_escape_string($link, $password);

                // Define SQL query string with placeholders
                $sql = "SELECT * FROM manager WHERE user_id = ? AND password = ?";

                // Prepare the SQL statement with placeholders
                $stmt = mysqli_prepare($link, $sql);

                // Bind the parameters to the placeholders in the SQL statement
                mysqli_stmt_bind_param($stmt, "ss", $mID, $password);

                // Execute the prepared statement
                mysqli_stmt_execute($stmt);

                // Get the query result
                $result = mysqli_stmt_get_result($stmt);

                // Get the number of rows in the query result set
                $total_records = mysqli_num_rows($result); 

                // Check if login data matched with database
                if ( $total_records > 0 ) {
                    // Login succeeded, save manager ID in session and redirect to user.php
                    $_SESSION["mID"] = $mID;
                    header("Location: admin/user.php");
                } else {  // Login fails
                    $error = "Manager ID or password is incorrect!";
                }

                mysqli_close($link);    // Close the connection to the MySQL database
            }   
		}    
      

	?>
	<div class="logo">	
	<h1>Manager Login</h1>
	</div>

	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" text-align: center;
			margin-bottom: 30px;>
	<!---The submit event of the form will be sent to the current PHP script for processing--->
	<!---Escape special characters in form data to avoid security issues such as XSS attacks--->
			
		<?php if ($error != "") { ?>
			<div style="color:red"><?php echo $error ?></div><p>
		<?php } ?>

		<div class="logo">
           <label for="mID">Manager ID:</label> <!--- for-id：When the user clicks on the label, the input box gets focus --->
           <input type="text" name="mID" id="mID" class="logo" value="<?php echo $mID ?>"> <!--- Apply a CSS style called "nes-input". When there is no value in the input box, a placeholder text is displayed --->
        </div>
		<br>
		<br>
        <p>

		<div class="logo">
           <label for="password">Password:</label>
           <input type="password" name="password" id="password" class="logo" >
        </div>
		<br><br>
		<p></p>

		<button type="button" class="submit-btn" onclick="window.location.href='admin_user.php'">login</button><br><br><br>

		<!--- When the mouse hovers over a text element, a hand cursor is displayed to indicate that the element is clickable --->
		<span class="logo" style=" cursor: pointer;" onclick="window.location='login.php'" >Back to user Login page</span>
		
	</form>
	
</body>
</html>