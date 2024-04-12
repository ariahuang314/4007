<html>
<head>
<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap">
<style>
    body {  /* set style for body part  */
	    background-image: url('main.png');
			background-repeat: no-repeat;
			background-size: cover;
	}  
  h1 {    /* set style for the header  */
            text-align: center;
            margin-bottom: 30px;
            font-size: 2em;
            font-weight: bold;
            border: 1px solid #ddd;
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
//Set the initial value.
$error="";
$email1="";
$Phone="";
$Pswfix="";
$Pswfix2="";
$Petname="";
$Type="";
$Weight="";
$Age="";
$category="";
session_start();
if (isset($_SESSION['Account'])){ // Get the variable "Phone" from the session "Account"
  $Phone = $_SESSION["Account"]; 
  
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
  
}else{
  echo '<a href="login.php"> <button type="button" class="submit-btn" margin="100px auto">Click to Login</button> </a>'; 
  exit(); 
}

  
  if (isset($_POST["Fixemail"])){            //form validation and connect database, update information part for changing email.

    if(empty($_POST["email1"])){
      $error ="Please enter the email if you want to change.<br>";
   }else if (!filter_var($_POST["email1"], FILTER_VALIDATE_EMAIL)){
    $error = "Please input a valid email.<br>";
   }else {
     $link = mysqli_connect("localhost","root","","4007")
               or die("Cannot open MySQL database connection!<br/>");
        mysqli_set_charset($link, "utf8");
        $sql = "UPDATE user SET email='".$_POST["email1"]."' WHERE phone='".$Phone."' ";
         if (!mysqli_query($link, $sql) ) {
            die("Failed to update email. Try again.");
  } 
         mysqli_close($link);
            echo("Your email has been updated successfully!");
       }}
      
if (isset($_POST["Fixname"])){   //form validation and connect database, update information part for changing user_name.
 
     if(empty($_POST["user_name"])){
      $error ="Please enter the name if you want to change.<br>";
     }else{
     if (strlen($_POST["user_name"])<2 || strlen($_POST["user_name"])>8) {   
      $error = "Your user name length should be 2-8 characters!<br>";
    }else{
         $link = mysqli_connect("localhost","root","","4007")
                               or die("Cannot open MySQL database connection!<br/>");
         mysqli_set_charset($link, "utf8");
         $sql = "UPDATE user SET user_name='".$_POST["user_name"]."' WHERE phone='".$Phone."' ";
         if ( mysqli_query($link, $sql) ) 
           echo "Your user name has been updated successfully!";
              else
                die("Failed to update your user name. Try again.");
         mysqli_close($link);      
     }}}


if (isset($_POST["Fixpsw"])){   //form validation and connect database, update information part for changing password.
  $Pswfix=$_POST["Pswfix"];
  $Pswfix2=$_POST["Pswfix2"];
  $uppercase    = preg_match('@[A-Z]@', $Pswfix);
  $lowercase    = preg_match('@[a-z]@', $Pswfix);
  $number       = preg_match('@[0-9]@', $Pswfix);
  if(empty($_POST["Pswfix"])){
    $error ="Please enter the password if you want to change.<br>";
   }else
  if(!$uppercase || !$lowercase || !$number ||strlen($Pswfix) < 8){
    $error= "Password should be at least 8 characters in length and should include at least one upper case and lower case letter, one number.<br>";
}else if(empty($_POST["Pswfix2"])){
  $error ="Please double check your password if you want to change.<br>";
 }else if($Pswfix != $Pswfix2){             //double check for password.
     $error="Incorrect!Please input password again!";
}else{
  $link = mysqli_connect("localhost","root","","4007")
                       or die("Cannot open MySQL database connection!<br/>");
  mysqli_set_charset($link, "utf8");
  $sql = "UPDATE user SET password='".$_POST["Pswfix"]."' WHERE phone='".$Phone."' ";
  if ( mysqli_query($link, $sql) ) 
  echo "Your password has been updated successfully!";
              else
               die("Failed to update password. Try again.");
      mysqli_close($link);      
                }}


  if (isset($_POST["Fix"])){          //form validation and connect database, update information part for changing pet type.
    if(empty($_POST["Type"])){
      $error ="Please select the pet type you want to change to.<br>";
     }else{
    $link = mysqli_connect("localhost","root","","4007")
                                     or die("Cannot open MySQL database connection!<br/>");
                              mysqli_set_charset($link, "utf8");
                              $sql = "UPDATE pet SET pet_species='".$_POST["Type"]."' WHERE user_id ='".$uid."' ";
                              if ( mysqli_query($link, $sql) ) 
                                   echo "Your pet has been updated successfully!";
                                 else
                                  die("Failed to update password. Try again.");
                                  mysqli_close($link);      
                              }}


  if (isset($_POST["Fixpn"])){   //form validation and connect database, update information part for changing pet name.
             if(empty($_POST["Petname"])){
              $error ="Please input the new pet name if you want to change.<br>";
             }else if (strlen($_POST["Petname"])<2 || strlen($_POST["Petname"])>8) {    
                      $error = "Petname length should be 2-8 characters!<br>";
                        }else{
                         $link = mysqli_connect("localhost","root","","4007")
                               or die("Cannot open MySQL database connection!<br/>");
                           mysqli_set_charset($link, "utf8");
                              $sql = "UPDATE pet SET pet_name='".$_POST["Petname"]."' WHERE user_id='".$uid."' ";
                               if ( mysqli_query($link, $sql) ) {
                                  echo "Your pet name has been updated successfully!";
                        }else{
                           die("Failed to update pet name. Try again.");
                         } mysqli_close($link);      
                                   }}
  if (isset($_POST["FixWeight"])){          //form validation and connect database, update information part for changing pet type.
      if(empty($_POST["Weight"])){
      $error ="Please input the initial weight of pet.<br>";
      }else{
      $link = mysqli_connect("localhost","root","","4007")
      or die("Cannot open MySQL database connection!<br/>");
      mysqli_set_charset($link, "utf8");
      $sql = "UPDATE pet SET weight='".$_POST["Weight"]."' WHERE user_id ='".$uid."' ";
      if ( mysqli_query($link, $sql) ) 
       echo "Your pet initial weight has been updated successfully!";
      else
      die("Failed to update pet weight. Try again.");
      mysqli_close($link);      
      }}

      if (isset($_POST["Fixage"])){ 
	  //form validation and connect database, update information part for changing pet type.
        if(empty($_POST["Petage"])){
          $error ="Please reset the age of pet.<br>";
         }else{
			
        $link = mysqli_connect("localhost","root","","4007")
                                         or die("Cannot open MySQL database connection!<br/>");
                                  mysqli_set_charset($link, "utf8");
                                  $sql = "UPDATE pet SET age='".$_POST["Petage"]."' WHERE user_id ='".$uid."' ";
                                  if ( mysqli_query($link, $sql) ) 
                                       echo "Your pet has been updated successfully!";
                                     else
                                      die("Failed to update age. Try again.");
                                      mysqli_close($link);      
                                  }}
								  
			      if (isset($_POST["Fixcategory"])){ 
	  //form validation and connect database, update information part for changing pet type.
        if(empty($_POST["Petcategory"])){
          $error ="Please reset the Petcategory of pet.<br>";
         }else{
			
        $link = mysqli_connect("localhost","root","","4007")
                                         or die("Cannot open MySQL database connection!<br/>");
                                  mysqli_set_charset($link, "utf8");
                                  $sql = "UPDATE pet SET pet_category='".$_POST["Petcategory"]."' WHERE user_id ='".$uid."' ";
                                  if ( mysqli_query($link, $sql) ) 
                                       echo "Your pet has been updated successfully!";
                                     else
                                      die("Failed to update category. Try again.");
                                      mysqli_close($link);      
                                  }}					  

						    if (isset($_POST["Fixbirthday"])){ 
	  //form validation and connect database, update information part for changing pet type.
        if(empty($_POST["Petbirthday"])){
          $error ="Please reset the Petbirthday of pet.<br>";
         }else{
			
        $link = mysqli_connect("localhost","root","","4007")
                                         or die("Cannot open MySQL database connection!<br/>");
                                  mysqli_set_charset($link, "utf8");
                                  $sql = "UPDATE pet SET date_of_birth='".$_POST["Petbirthday"]."' WHERE user_id ='".$uid."' ";
                                  if ( mysqli_query($link, $sql) ) 
                                       echo "Your pet has been updated successfully!";
                                     else
                                      die("Failed to update birthday. Try again.");
                                      mysqli_close($link);      
                                  }}		  				
?>
</head>
<!-- Show the form-->
<body id="body" >
  <p class="logo"><h1 align=center >Edit</h1></p>  <!-- Heading -->
<form name="myForm" style="text-align: left;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"> 
  <!-- Heading -->
  <p><div style="color:red; font-size:18px"><?php echo $error ?></div></p>   <!--set error style and print-->
  <p><div style="color:red; font-size:18px">You can edit your pet information here!</div></p>  
    <table style="font-size:18px;">
    <tr>
    <td>Email: </td>
    <td><input type="text" class="logo " name="email1" id="email"> <br></td><br><br>
    <br><br><!-- Set pattern and tips for users to input their phone number as account in our game. -->
    <td><input type="submit" name="Fixemail" value="Change" class="submit-btn" > </td><br><br>
    </tr>
    <tr>
        <td>Name:</td>
        <td><input type="text" class="logo " id="name"  name="user_name"><br></td>
        <td><input type="submit" name="Fixname" value="Change" class="submit-btn" ><br></td>
    </tr><tr></tr>
    <tr>
        <td>New password:</td>
        <td><input type="password" class="logo " name="Pswfix" > <br></td>
    </tr>
    <tr>
        <td>Input again:</td>
        <td><input type="password" class="logo " name="Pswfix2" ></td>
        <td><input type="submit" name="Fixpsw" value="Change" class="submit-btn" ><br></td>
    </tr>
    <tr>
        <td>Change your pet: </td>
        <td><img src="cat-happy.gif" height=70> <input type="radio" class="logo " name="Type" id="cat" value="cat" > Cat
        <img src="dog-happy.gif" height=70> <input type="radio" class="logo " name="Type" id="dog" value="dog" > Dog</td>
        <td><input type="submit" name="Fix" value="Change" class="submit-btn" ></td>
    </tr>
    <tr>
        <td>Change your pet name:</td>
        <td><input type="text" class="logo " id="petn"  name="Petname"> </td>
        <td><input type="submit" name="Fixpn" value="Change" class="submit-btn" ><br></td>
    </tr>
    <tr>
        <td>Change your pet initial weight:</td>
        <td><input type="text" class="logo " id="petweight"  name="Petweight"> kg</td>
        <td><input type="submit" name="Fixweight" value="Change" class="submit-btn" ><br></td>
    </tr>
    <tr>
        <td>Change your pet initial height:</td>
        <td><input type="text" class="logo " id="petheight"  name="Petheight"> cm</td>
        <td><input type="submit" name="Fixheight" value="Change" class="submit-btn" ><br></td>
    </tr>
    <tr>
        <td>Change you pet age:</td>
        <td><input type="text" class="logo " id="petage"  name="Petage">year(s)</td>
        <td><input type="submit" name="Fixage" value="Change" class="submit-btn" ><br></td>
    </tr>
    <tr>
        <td>Change you pet category:</td>
        <td><input type="radio" class="logo " name="Petcategory" id="Adult Dog" value="Adult Dog" > Adult Dog
        <input type="radio" class="logo " name="Petcategory" id="Puppy" value="Puppy" > Puppy
        <input type="radio" class="logo " name="Petcategory" id="Adult cat" value="Adult cat" > Adult cat
        <input type="radio" class="logo " name="Petcategory" id="Kitten" value="Kitten" > Kitten</td>
        <td><input type="submit" name="Fixcategory" value="Change" class="submit-btn" ><br></td>
    </tr>
    <tr>
        <td>Change you pet birthday:</td>
        <td><input type="date" class="logo " id="petbirthday"  name="Petbirthday"></td>
        <td><input type="submit" name="Fixbirthday" value="Change" class="submit-btn" ><br></td>

    </tr>
    

</form>
<a href="main.php"> <button name="Back" value="" class="submit-btn" >Back to main page</button><br><br></a> 
<a href="login.php"> <button name="Back" value="" class="submit-btn" >Back to login page</button></a> 

</div>
</body>
</html>