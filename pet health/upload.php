<?php
session_start();
$servername = "localhost";  
$username = "root";         
$password = "";            
$dbname = "4007";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("数据库连接失败: " . $conn->connect_error);
}

// 处理文件上传
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if (isset($_FILES["image"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
    $imageData = file_get_contents($_FILES["image"]["tmp_name"]);

    // 获取其他相关信息
    $petNo = $_SESSION['pet-no'];
    $userId = $_SESSION['user-id'];
    // $moodType = $_POST["mood_type"];
    $moodDate = $_POST["mood-date"];

    // 查询最后一条记录的主键值
    $sql = "SELECT mood_record_no FROM mood 
            ORDER BY mood_record_no DESC 
            LIMIT 1 ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // 获取最后一条记录的主键值并加一
        $row = $result->fetch_assoc();
        $lastRecordNo = $row['mood_record_no'];
        $newRecordNo = $lastRecordNo + 1;
    } else {
        // 如果表中没有记录，则新记录的主键值为1
        $newRecordNo = 1;
    }

    // 准备 SQL 语句
    $sql = "INSERT INTO mood (mood_record_no, pet_no, user_id, photo, mood_date) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiiss", $newRecordNo, $petNo, $userId, $imageData, $moodDate);


    // $sql = "INSERT INTO mood (mood_record_no, pet_no, user_id, mood_type, photo, mood_date) VALUES (?, ?, ?, ?, ?, ?)";
    // $stmt = $conn->prepare($sql);
    // $stmt->bind_param("iiisss", $newRecordNo, $petNo, $userId, $moodType, $imageData, $moodDate);

    // 执行 SQL 语句    
    if ($stmt->execute()) {
      $_SESSION['mood_record_no'] = $newRecordNo;  ###
      echo '<script>alert("文件上传成功"); window.location.href = "analysisMood.php";</script>';
    } else {
      echo '<script>alert("文件上传失败");</script>';
    }

    $stmt->close();
  } else {
    switch ($_FILES["image"]["error"]) {
        case UPLOAD_ERR_NO_FILE:
          echo "请选择要上传的文件";
          break;
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
          echo "上传的文件太大";
          break;
        case UPLOAD_ERR_PARTIAL:
          echo "文件只有部分被上传";
          break;
        case UPLOAD_ERR_CANT_WRITE:
          echo "无法写入文件";
          break;
        default:
          echo "文件上传错误";
      }
  }
}

$conn->close();
?>