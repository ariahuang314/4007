<?php

session_start();

// 数据库连接信息
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "4007";

// 创建数据库连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接是否成功
if ($conn->connect_error) {
    die("连接数据库失败: " . $conn->connect_error);
}

// 获取表单提交的数据
$petNo = $_SESSION['pet-no'];
$userId = $_SESSION['user-id'];
$duration = $_POST['duration'];
$exerciseDate = $_POST['exercise-date'];
$exerciseType = $_POST['exercise-type'];

// 查询最后一条记录的主键值
$sql = "SELECT exercise_record_no FROM exercise ORDER BY exercise_record_no DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // 获取最后一条记录的主键值并加一
    $row = $result->fetch_assoc();
    $lastRecordNo = $row['exercise_record_no'];
     $newRecordNo = $lastRecordNo + 1;
} else {
    // 如果表中没有记录，则新记录的主键值为1
    $newRecordNo = 1;
}

$sql = "INSERT INTO exercise (exercise_record_no, pet_no, user_id, duration, exercise_date, exercise_type) 
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iiiiss", $newRecordNo, $petNo, $userId, $duration, $exerciseDate, $exerciseType);

if ($stmt->execute()) {
    echo "<script>alert('数据插入成功'); window.location.href = 'exercisePage.php';</script>";
    exit();
} else {
    echo "<script>alert('数据插入失败: " . $stmt->error . "');</script>";
}

$stmt->close();
$conn->close();

?>
