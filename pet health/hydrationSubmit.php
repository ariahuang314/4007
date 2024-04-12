<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "4007";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("连接数据库失败: " . $conn->connect_error);
}

$petNo = $_SESSION['pet-no'];
$userId = $_SESSION['user-id'];

$hydrationDate = $_POST['hydration-date'];
$hydrationTimes = $_POST['hydration-times'];

// 处理按钮点击事件
if (isset($_POST['submit'])) {
    // 获取表单数据
    $hydrationDate = date('Y-m-d'); // 当前日期

    // 查询最后一个hydration_record_no的值
    $sql = "SELECT hydration_record_no FROM hydration ORDER BY hydration_record_no DESC LIMIT 1";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // 获取最后一条记录的主键值并加一
        $row = $result->fetch_assoc();
        $lastRecordNo = $row['hydration_record_no'];
         $newRecordNo = $lastRecordNo + 1;
    } else {
        $newRecordNo = 1;
    }

    // 插入新数据
    $sql = "INSERT INTO hydration (hydration_record_no, pet_no, user_id, hydration_times, hydration_date) 
        VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiiis", $newRecordNo, $petNo, $userId, $hydrationTimes, $hydrationDate);

    if ($stmt->execute()) {
        echo "<script>alert('数据插入成功'); window.location.href = 'hydrationPage.php';</script>";
        exit();
    } else {
        echo "<script>alert('数据插入失败: " . $stmt->error . "');</script>";
    }
}

// 关闭数据库连接
$stmt->close();
$conn->close();
?>