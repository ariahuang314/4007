<!DOCTYPE html>
<html>
<head>    
<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap">
    <style> 
    body {   /* set style for body part  */
	    background-image: url('login.png');
			background-repeat: no-repeat;
			background-size: cover;
	}  
    .button1 {             /* set style for the button on this page  */
    -webkit-transition-duration: 0.4s;
    transition-duration: 0.4s;
    font-size: 14px;
    text-align: center;
    border-radius:6px;
    background-color:#FFF5CC;
    color: #0D1D36;}
    .button1:hover {    /* the button change color when focus on it  */
    background-color: #0D1D36;
    color:#FFF5CC;   
    border: 2px solid #FFF5CC;
    }
</style> 
<?php
//Start a session
session_start();   
?>
<?php
//Set the initial value.
$error = "";
$Phone="";
$Name="";
$Gender="";
$Email=""; 
$Password="";
$Pswrep="";

//Show the blank form.
$showform = true; 
//Check if the value is set

if (isset($_POST["Submit"])) {
	
    // Get the value from the form
    $Phone = isset($_POST["Phone"]) ? $_POST["Phone"] : "";
    $Name = isset($_POST["Name"]) ? $_POST["Name"] : "";
    $Gender = isset($_POST["Gender"]) ? $_POST["Gender"] : "";
    $Email = isset($_POST["Email"]) ? $_POST["Email"] : "";
    $Password = isset($_POST["Password"]) ? $_POST["Password"] : "";
    $Pswrep = isset($_POST["Pswrep"]) ? $_POST["Pswrep"] : "";

    // Validate the form data
    if (empty($Phone)) {
        $error = "Login account cannot be empty！<br>";
    } else if (empty($Name)) {
        $error = "Please enter your user name！<br>";
    } else if (strlen($Name) < 2 || strlen($Name) > 8) {
        $error = "The username should be 2-8 characters in length!<br>";
    } else if (empty($Gender)) {
        $error = "Please select gender!<br>";
    } else if (empty($Email)) {
        $error = "Please enter your email address!<br>";
    } else if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address！<br>";
    } else if (empty($Password)) {
        $error = "Please enter your password!br>";
    } else if (strlen($Password) < 8 || !preg_match("/[A-Z]/", $Password) || !preg_match("/[a-z]/", $Password) || !preg_match("/[0-9]/", $Password)) {
        $error = "Passwords should be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one number！<br>";
    } else if (empty($Pswrep)) {
        $error = "Please enter your password again!<br>";
    } else if ($Pswrep != $Password) {
        $error = "Please make sure you enter the same password twice!<br>";
    } else {
		
        // Form validation passes, user registration processed
        // Create database connection
        $link = mysqli_connect("localhost","root","","4007");
        if (!$link) {
            die("Database connection failed, please try again later!<br>");
        }

        // Insert user data
        $sql = "INSERT INTO user (phone, user_name, gender, email, password) VALUES ('$Phone', '$Name', '$Gender', '$Email', '$Password')";
		
        if (mysqli_query($link, $sql)) {
            echo "<script>alert('You have successfully register your own information! Please register your pet information!');</script>";
            // Perform other operations, such as sending confirmation emails, etc.
        } else {
            echo "Registration failed, please try again later!";
        }

        // Close the database connection
        mysqli_close($link);

        // Hide the form, no longer show the registration form
        $showform = false;
    }

    
}
?> 
</head>
<body>

  <class="logo"><h1 align=center >Registration</h1> <!-- Heading -->

<form name="myForm" style="text-align: left;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"> 
  <!-- Heading -->
  <p><div style="color:red" class="logo"><?php echo $error ?></div></p>   <!--set error style and print-->
     Please input your personal information to register our game:
    <table style="font-size:18px;">
    <tr>
    <td>Login Account (Mobile phone number): </td>
    <td><input type="tel" id="phone" name="Phone" class="logo" pattern="[0-9]{3}-[0-9]{4}-[0-9]{4}" value="<?php echo $Phone ?>"  placeholder="xxx-xxxx-xxxx"> <br><br></td>
    <br><br><br><!-- Set pattern and tips for users to input their phone number as account in our game. -->
    </tr>
    <tr>
        <td>User name: </td>
        <td><input type="text" id="Name"  name="Name" class="logo" value="<?php echo $Name ?>"><br><br></td>
    </tr><tr></tr>
    <tr>
       <td>Gender : </td>
       <td><input type="radio" name="Gender" id="male" class="logo" value="male"  <?php if ($Gender == 'male') echo 'checked'; ?>> Male<!-- set a radio box to ask user choose gender-->
           <input type="radio" name="Gender" id="female" class="logo" value="female"  <?php if ($Gender == 'female') echo 'checked'; ?>> Female <br><br></td>
    </tr><tr></tr>
    <tr>
        <td>Email:</td>
        <td><input type="text" name="Email" id="email" class="logo" value="<?php echo $Email ?>"><br><br></td>
    </tr><tr></tr>
    <tr>
        <td>Password:</td>
        <td><input type="password" name="Password" class="logo" id="password" value="<?php echo $Password ?>" ><br><br></td>
    </tr><tr></tr>
    <tr>
        <td>Confirm password:</td> <!-- input password twice to double check-->
        <td><input type="password" name="Pswrep" id="pswrep" class="logo" value="<?php echo $Pswrep ?>"></td>
    </tr><tr></tr>
   
</table>
<br><br>
<input type="submit" name="Submit" value="Submit" class="submit-btn" >
<br>
<br>

</form>
<a href="register2.php"> <input type="submit" name="Back" value="pet information page" class="submit-btn" ></a>

</body>
</html>