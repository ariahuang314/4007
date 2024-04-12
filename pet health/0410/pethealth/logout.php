<?php   
session_start();    

if (isset($_SESSION["Account"])) {  
    unset($_SESSION["Account"]);  
}  
  

session_destroy();  
  

echo "<script>  
    alert('You have successfully logged out!');  
    window.location.href = 'login.php'; // 弹窗确认后跳转到 login.php  
</script>";  

?>