<!DOCTYPE html> 
<html>
<head>
	<meta charset="utf-8" />  <!---able to use Chinese--->
	<title>Login Page</title>
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
            font-size: 2em;  /* Twice the font size of the parent element */
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
			margin: 0 auto;  /* horizontal center alignment */
		}

		label {
			display: block;  /* A block-level element  occupy a single line and fill the width of the parent container. */
			margin-bottom: 10px;
			font-size: 16px;
			color: dark gray;
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
		$account = "";
		$password = "";
		$error = "";
	
		if ( isset($_POST["login"]) ) {  // check whether Login button is clicked
        	
			// obtain form data
	    	if ( isset($_POST["account"]) ) {
	    	$account = $_POST["account"];}
        	if ( isset($_POST["password"]) ){
	    	$password = $_POST["password"];}
        
            // check if users input data for name
            if  (empty($account)) {         
                $error = "Account empty!<br>"; 
            }
            else if  (empty($password)) {
            // check if users input data for user name        
                $error = "Password empty!<br>";
            }
	
            else
                {     
                // connect to MySQL database
			    $link = mysqli_connect("localhost","root","","4007")
                or die("Cannot open MySQL database connection!<br/>");

				// Set the character set to utf8
                mysqli_query($link, 'SET NAMES utf8');  


				// define sql string
				$sql1 = "SELECT * FROM user WHERE phone='".$account."' ";

				// Execute SQL query statements and return query results
				$result1 = mysqli_query($link, $sql1); 

				// Get the number of rows in the query result set
				$total_records1 = mysqli_num_rows($result1); 

				if ( !($total_records1 > 0) ) {
					// login fails, show error
					$error = "This phone has not been registered yet, please register first!";
				}else{

                // define sql string
                $sql = "SELECT * FROM user WHERE (phone='".$account."') AND password='".$password."'";
                
				// Execute SQL query statements and return query results
                $result = mysqli_query($link, $sql); 

				if ($result->num_rows > 0) {
					// 从结果集中提取'user_id'
					$row = $result->fetch_assoc();
					$userId = $row['user_id'];
					$_SESSION['user-id'] = $userId;
				} else {
					echo "没有找到匹配的用户。";
				}

				// Get the number of rows in the query result set
                $total_records = mysqli_num_rows($result); 

                // check if login data matched with database
                if ( $total_records > 0 ) {
					// login succeeds, save account in session and redirect to main page
                    $_SESSION["Account"] = $account;
                    header("Location: main.php");
                } else {  // login fails
                    $error = "Account (phone number) or password is wrong!";
                }
                mysqli_close($link);  // Close the connection to the MySQL database
				}
			}   
		}    
        

	?>


<div class="logo">	
<h1>Login</h1>
</div>

	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" text-align: center;
			margin-bottom: 30px;>
    <!---The submit event of the form will be sent to the current PHP script for processing--->
	<!---Escape special characters in form data to avoid security issues such as XSS attacks--->

		<?php if ($error != "") { ?>
			<div style="color:red"><?php echo $error ?></div><p>
		<?php } ?>

		<div class="logo">
           <label for="account">Account (Phone number):</label> <!--- for-id: When the user clicks on the label, the input box gets focus --->
           <input type="tel" name="account" id="account" class="logo" pattern="[0-9]{3}-[0-9]{4}-[0-9]{4}" value="<?php echo $account ?>" placeholder="xxx-xxxx-xxxx"> <!--- Apply a CSS style called "nes-input". When there is no value in the input box, a placeholder text is displayed --->
		<br>
		<br>
		
		</div>


        <p>

		<div class="logo">
           <label for="password">Password:</label> 
           <input type="password" name="password" id="password" class="logo " ><br><br>
        </div>
		
		<p></p>
		
		<input type="submit" name = "login" value="Login" class="submit-btn"/><br><br>


		<button type="button" class="submit-btn" onclick="window.location.href='Register1.php'">Register</button><br><br><br>

		<p></p>

		<!--- When the mouse hovers over a text element, a hand cursor is displayed to indicate that the element is clickable --->
		<span class="logo" style=" cursor: pointer;" onclick="window.location='mlogin.php'">To manager login page</span>
		

	</form>
</body>
</html>
