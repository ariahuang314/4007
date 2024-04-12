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
// Start a session
session_start();

// Set the initial values
$error = "";
$Petname = "";
$Type = "";
$Age = "";
$Weight = "";
$category="";
// Show the blank form
$showform = true;

// Check if the form is submitted
if (isset($_POST["Submit"])) {
    $Petname = isset($_POST["Petname"]) ? $_POST["Petname"] : "";
    $Type = isset($_POST["Type"]) ? $_POST["Type"] : "";
    $Age = isset($_POST["Age"]) ? $_POST["Age"] : "";
    $Weight = isset($_POST["Weight"]) ? $_POST["Weight"] : "";
	$height = isset($_POST["height"]) ? $_POST["height"] : "";
$Phone = $_POST["Phone"];
$category = $_POST["category"];
$birthday = $_POST["birthday"];

    // Validate form inputs
    if (empty($Age)) {
        $error = "Pet Age is empty!<br>";
    } elseif (empty($Type)) {
        $error = "Pet type must be selected!<br>";
    } elseif (empty($Petname)) {
        $error = "Please input an exclusive pet name!<br>";
    } elseif (strlen($Petname) < 2 || strlen($Petname) > 8) {
        $error = "Pet's name length should be 2-8 characters!<br>";
    } elseif (empty($Weight)) {
        $error = "Pet Weight is empty!<br>";
    } elseif (empty($height)) {
        $error = "Pet height is empty!<br>";
    }elseif (empty($category)) {
        $error = "Pet category is empty!<br>";
    }elseif (empty($birthday)) {
        $error = "Pet birthday is empty!<br>";
    }else {
		
		
		
		
		
        // Store form inputs in session variables
        $_SESSION["Petname"] = $Petname;
        $_SESSION["Type"] = $Type;
        $_SESSION["Age"] = $Age;
        $_SESSION["Weight"] = $Weight;

        // Database connection settings
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
       $error = "没有找到此手机号的用户!<br>";
    }  
      
    // 释放结果集  
    mysqli_free_result($result);  
} else {  
    echo "查询失败: " . $conn->error;  
}  

        // Prepare the SQL statement to insert data into the user table
        $sql = "INSERT INTO pet (user_id, age,weight,height,pet_category,pet_species,date_of_birth,pet_name) VALUES ('$uid','$Age','$Weight','$height','$category','$Type','" . $birthday . "', '" . $_SESSION["Petname"] . "')";

        // Execute the SQL statement
        mysqli_query($link, 'SET NAMES utf8');
        if (mysqli_query($link, $sql)) {
            // Insertion into the user table successful
            echo "Successfully registered! You will receive an email from us later.";
        } else {
            // Failed to insert into the user table
            die("Sorry, fail to register!<br>");
        }
    


    mysqli_close($link);   //Disconnect to the database
	
    }
}
?> 
</head>
<body id="body" >

  <p class="logo"><h1 align=center >Registration</h1></p>  <!-- Heading -->
<form name="myForm" style="text-align: left;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"> 
  <!-- Heading -->
  <p><div style="color:red"><?php echo $error ?></div></p>   <!--set error style and print-->
     Please input your pet information!
    <table style="font-size:18px;">
    <tr>
    <td>Login Account(Mobile phone number): </td>
    <td><input type="tel" id="phone" name="Phone" pattern="[0-9]{3}-[0-9]{4}-[0-9]{4}" class="logo" value="<?php echo isset($Phone) && !empty($Phone) ? htmlspecialchars($Phone) : ''; ?>"  placeholder="xxx-xxxx-xxxx"> <br><br></td><br><br>
    <br><br><!-- Set pattern and tips for users to input their phone number as account in our game. -->
    </tr>
    <tr>
        <td>Pet Name:</td>
        <td><input type="text" id="Petname"  name="Petname" class="logo" value="<?php echo $Petname ?>"><br><br></td>
    </tr><tr></tr>
    <tr>
        <td>Pet Type:</td>
        <td>
  <label style="display: flex; align-items: center;">
    <img src="cat-happy.gif" height=70> <input type="radio" name="Type" id="cat" style=" margin-left: 10px; " class="logo" value="cat" <?php if ($Type == 'cat') echo 'checked'; ?>> Cat
    <img src="dog-happy.gif" height=70> <input type="radio" name="Type" id="dog" style=" margin-left: 10px; " class="logo" value="dog" <?php if ($Type == 'dog') echo 'checked'; ?>> Dog
  </label>
</td>
    </tr><tr></tr>
    <tr>
        <td>Pet Age:</td>
        <td><input type="text" name="Age" id="Age" class="logo" value="<?php echo $Age ?>">year(s)<br><br></td>
    </tr><tr></tr>
    <tr>
    <td>Pet Weight:</td>
    <td><input type="text" name="Weight" id="Weight" class="logo" value="<?php echo $Weight ?>"> kg<br><br></td>
    </tr><tr></tr>
	
	<tr>
    <td>Pet height:</td>
    <td><input type="text" name="height" id="height" class="logo" value="<?php echo isset($height) && !empty($height) ? htmlspecialchars($height) : ''; ?>"> cm<br><br></td>
    </tr><tr></tr>
	
	<tr>
    <td>Pet category:</td>
    <td>
        <!--<input type="text" name="category" id="category" value="<?php echo isset($category) && !empty($category) ? htmlspecialchars($category) : ''; ?>">-->
       <label style="display: flex; align-items: center;">
    <input type="radio" name="category" id="Adult Dog" style=" margin-left: 10px; " class="logo" value="Adult Dog" <?php if ($category == 'Adult Dog') echo 'checked'; ?>> Adult Dog
    <input type="radio" name="category" id="Puppy" style=" margin-left: 10px; " class="logo" value="Puppy" <?php if ($category == 'Puppy') echo 'checked'; ?>> Puppy
    <input type="radio" name="category" id="Adult cat" style=" margin-left: 10px; " class="logo" value="Adult cat" <?php if ($category == 'Adult cat') echo 'checked'; ?>> Adult cat
    <input type="radio" name="category" id="Kitten" style=" margin-left: 10px; " class="logo" value="Kitten" <?php if ($category == 'Kitten') echo 'checked'; ?>> Kitten
  </label> 
        
        </td>
    </tr><tr></tr>
	
<tr>    
    <td><br>Pet birthday:</td>    
    <td>    
        <input type="date" name="birthday" id="birthday" class="logo" value="<?php echo htmlspecialchars($birthday, ENT_QUOTES, 'UTF-8'); ?>">    
    </td>    
</tr>    
<tr></tr>
</table>
<br>
<input type="submit" name="Submit" value="Submit" class="submit-btn"  ><br><br>

</form>
<a href="main.php"> <input type="submit" name="Back" value="Main page" class="submit-btn"  ><br><br></a>


</div>
</body>
</html>