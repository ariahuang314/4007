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
$address="";
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
		
    $sql = "SELECT u.*, p.pet_no FROM user u JOIN pet p ON u.user_id = p.user_id WHERE u.phone = '$Phone'";
// 执行查询  
$result = mysqli_query($link, $sql);  
  
// 检查查询结果  
if ($result) {  
    // 提取数据  
    if ($row = mysqli_fetch_assoc($result)) {  
        $uid=$row["user_id"];
		$Name=$row["user_name"];
		$email=$row["email"];
    $pid=$row["pet_no"];
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
if (isset($_POST["Fixaddress"])){   //form validation and connect database, update information part for changing user_name.
 
      if(empty($_POST["address"])){
       $error ="Please select your address.<br>";
      }else{
        $link = mysqli_connect("localhost","root","","4007")
        or die("Cannot open MySQL database connection!<br/>");
 mysqli_set_charset($link, "utf8");
 $sql = "UPDATE user SET address='".$_POST["address"]."' WHERE user_id ='".$uid."' ";
 if ( mysqli_query($link, $sql) ) 
      echo "Your pet has been updated successfully!";
    else
     die("Failed to update password. Try again.");
     mysqli_close($link);      
 }}    

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
                              $sql = "UPDATE pet SET pet_species='".$_POST["Type"]."' WHERE pet_no='".$pid."' ";
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
                              $sql = "UPDATE pet SET pet_name='".$_POST["Petname"]."' WHERE pet_no='".$pid."' ";
                               if ( mysqli_query($link, $sql) ) {
                                  echo "Your pet name has been updated successfully!";
                        }else{
                           die("Failed to update pet name. Try again.");
                         } mysqli_close($link);      
                                   }}
  if (isset($_POST["FixWeight"])){          //form validation and connect database, update information part for changing pet type.
      if(empty($_POST["Petweight"])){
      $error ="Please input the initial weight of pet.<br>";
      }else{
      $link = mysqli_connect("localhost","root","","4007")
      or die("Cannot open MySQL database connection!<br/>");
      mysqli_set_charset($link, "utf8");
      $sql = "UPDATE pet SET weight='".$_POST["Petweight"]."' WHERE pet_no ='".$pid."' ";
      if ( mysqli_query($link, $sql) ) 
       echo "Your pet initial weight has been updated successfully!";
      else
      die("Failed to update pet weight. Try again.");
      mysqli_close($link);      
      }}

      if (isset($_POST["Fixheight"])){          //form validation and connect database, update information part for changing pet type.
        if(empty($_POST["Petheight"])){
        $error ="Please input the initial height of pet.<br>";
        }else{
        $link = mysqli_connect("localhost","root","","4007")
        or die("Cannot open MySQL database connection!<br/>");
        mysqli_set_charset($link, "utf8");
        $sql = "UPDATE pet SET height='".$_POST["Petheight"]."' WHERE pet_no ='".$pid."' ";
        if ( mysqli_query($link, $sql) ) 
         echo "Your pet initial height has been updated successfully!";
        else
        die("Failed to update pet height. Try again.");
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
                                  $sql = "UPDATE pet SET age='".$_POST["Petage"]."' WHERE pet_no ='".$pid."' ";
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
                                  $sql = "UPDATE pet SET pet_category='".$_POST["Petcategory"]."' WHERE pet_no ='".$pid."' ";
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
                                  $sql = "UPDATE pet SET date_of_birth='".$_POST["Petbirthday"]."' WHERE pet_no ='".$pid."' ";
                                  if ( mysqli_query($link, $sql) ) 
                                       echo "Your pet has been updated successfully!";
                                     else
                                      die("Failed to update birthday. Try again.");
                                      mysqli_close($link);      
                                  }}		  
								  
								  
							
?>
</head> <!-- Show the form-->
<body id="body" >
<h1 text-align=center>Fix your information</h1> <!--header -->

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
<p></p>

<div style="border-top: 1px solid #ccc; margin-top: 10px;"></div>
<p><div style="color:red"><?php echo $error ?></div></p> 
<p></p>
Email:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" class="logo " name="email1" id="email"> 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" name="Fixemail" value="Change" class="submit-btn" > <br>
<p></p>
Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" class="logo " id="name"  name="user_name">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" name="Fixname" value="Change" class="submit-btn" ><br>
<p></p>
address:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<select class="logo" name="address">
<option class="logo" name="address" value="Beijing" <?php if ($address == 'Beijing') echo 'selected'; ?>>Beijing</option>
<option class="logo" name="address" value="Shanghai" <?php if ($address == 'Shanghai') echo 'selected'; ?>>Shanghai</option>
<option class="logo" name="address" value="London" <?php if ($address == 'London') echo 'selected'; ?>>London</option>
<option class="logo" name="address" value="Sydney" <?php if ($address == 'Sydney') echo 'selected'; ?>>Sydney</option>
</select>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" name="Fixaddress" value="Change" class="submit-btn" ><br>
New password:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="password" class="logo " name="Pswfix" > <br>
<p></p>
Input again:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="password" class="logo " name="Pswfix2" >
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" name="Fixpsw" value="Change" class="submit-btn" ><br>
<p></p>
Change your pet: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <img src="cat-happy.gif" height=70> <input type="radio" class="logo " name="Type" id="cat" value="cat" > Cat<!-- set a radio box to ask user choose gender-->
        <img src="dog-happy.gif" height=70> <input type="radio" class="logo " name="Type" id="dog" value="dog" > Dog 
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="submit" name="Fix" value="Change" class="submit-btn" >
<p></p>
Change your pet name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" class="logo " id="petn"  name="Petname"> 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" name="Fixpn" value="Change" class="submit-btn" ><br>
<p></p>

Change your pet initial weight:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" class="logo " id="petweight"  name="Petweight"> kg
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" name="FixWeight" value="Change" class="submit-btn" ><br>
<p></p>
Change your pet initial height:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" class="logo " id="petheight"  name="Petheight"> cm
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" name="Fixheight" value="Change" class="submit-btn" ><br>
<p></p>
Change you pet age:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" class="logo " id="petage"  name="Petage">year(s)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" name="Fixage" value="Change" class="submit-btn" ><br>
<p></p>

Change you pet category:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" class="logo " name="Petcategory" id="Adult Dog" value="Adult Dog" > Adult Dog<!-- set a radio box to ask user choose gender-->
                        <input type="radio" class="logo " name="Petcategory" id="Puppy" value="Puppy" > Puppy
                        <input type="radio" class="logo " name="Petcategory" id="Adult cat" value="Adult cat" > Adult cat
                        <input type="radio" class="logo " name="Petcategory" id="Kitten" value="Kitten" > Kitten
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="submit" name="Fixcategory" value="Change" class="submit-btn" ><br>
<p></p>

Change you pet birthday:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="date" class="logo " id="petbirthday"  name="Petbirthday">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" name="Fixbirthday" value="Change" class="submit-btn" ><br>
<p></p>
</form>
<br>
<a href="main.php"> <button name="Back" value="" class="submit-btn" >Back to main page</button><br><br></a> 
<a href="login.php"> <button name="Back" value="" class="submit-btn" >Back to login page</button></a> 
</body>
</html>