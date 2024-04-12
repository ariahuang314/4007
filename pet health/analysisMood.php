<?php
session_start();
// 连接到数据库（请根据你的数据库配置进行修改）
$servername = "localhost";  
$username = "root";         
$password = "";            
$dbname = "4007";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("数据库连接失败: " . $conn->connect_error);
}

// 从数据库获取图片的 Base64 编码
$query = "SELECT photo FROM mood WHERE mood_record_no = ?";
$stmt = $conn->prepare($query);
$moodRecordNo = $_SESSION['mood_record_no'];
// $moodRecordNo = 1;        
$stmt->bind_param("i", $moodRecordNo);
$stmt->execute();
$stmt->bind_result($imageData);
$stmt->fetch();
$stmt->close();


// 将图片数据转换为 Base64 编码
$base64Image = base64_encode($imageData);

$conn->close();

// 保存图片数据到文件
$file = 'process/image.jpg'; // 文件路径和名称
file_put_contents($file, $imageData);

?>
<!DOCTYPE html>
<html>
<head>
  <title>show mood</title>
  <style>
        table {
            border-collapse: collapse;
            /* width: 100%; */
        }
        th, td {
            text-align: center;
            padding: 10px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        #menu {
            background-color: #8FBC8F;
            width: 200px;
            height: 600px;
            float: left;
        }
        .menuInner {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
        .menuInner li {
            margin: 10px;
        }
        .menuInner li a {
            color: white;
            display: block;
            padding: 10px;
            text-decoration: none;
        }
    </style>

</head>
<body>
  <h1 style="background-color:#8FBC8F;height:50px;">Pet Health Management System</h1>
        <!--Menu-->
        <div id="menu" style="background-color:#8FBC8F;width:200px;height:600px;float:left;">
        <ul class="menuInner">
            <li><a href="0410/pethealth/main.php" >Main Page</a></li>
            <li><a href="0410/project/forum.php" >Information Forum</a></li>
            <li><a href="eatPage.php">Diet Tracking</a></li>
            <li><a href="hydrationPage.php">Hydration Tracking</a></li>
            <li><a href="exercisePage.php">Exercise Tracking</a></li>
            <li><a href="moodPage.php"><b>Mood Detection</b></a></li>
            <li><a href="analysisPage.php">Pet Analysis</a></li>
        </ul>
        </div>

  <div style="margin-left: 220px;">
    <h2>Pet Photo</h2>
    <h2>Analysis in progress(about 10s)</h2>
    <img src="data:image/jpeg;base64,<?php echo $base64Image; ?>" alt="pet face">
    <p>Your upload Photo</p>

  
  <?php
  $cmd = shell_exec("python moodDetect.py");
  echo "<pre >$cmd</pre>";
  ?>

</div>

</body>
</html>