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
$foodNo = $_POST['food-no'];
$eatingAmount = $_POST['food-amount'];
$eatingDate = $_POST['food-date'];
$eatingTime = $_POST['food-time'];
$saveAsCommonCollocation = isset($_POST["common-collocation"]) && $_POST["common-collocation"] == "on";


// 查询最后一条记录的主键值
$sql = "SELECT eating_record_no FROM eating ORDER BY eating_record_no DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // 获取最后一条记录的主键值并加一
    $row = $result->fetch_assoc();
    $lastRecordNo = $row['eating_record_no'];
    $newRecordNo = $lastRecordNo + 1;
} else {
    // 如果表中没有记录，则新记录的主键值为1
    $newRecordNo = 1;
}

$sql = "INSERT INTO eating (eating_record_no, pet_no, user_id, food_no, eating_amount, eating_date) 
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iiisss", $newRecordNo, $petNo, $userId, $foodNo, $eatingAmount, $eatingDate);
// $stmt->execute();

// 判断是否保存为常用组合
if ($saveAsCommonCollocation) {
    $sql = "SELECT collocation_no FROM common_collocation ORDER BY collocation_no DESC LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // 获取最后一条记录的主键值并加一
        $row = $result->fetch_assoc();
        $lastRecordNo = $row['collocation_no'];
        $newRecordNo = $lastRecordNo + 1;
    } else {
        // 如果表中没有记录，则新记录的主键值为1
        $newRecordNo = 1;
    }

    $stmt = $conn->prepare("INSERT INTO common_collocation (collocation_no, user_id, food_no, eating_amount) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiii", $newRecordNo, $userId, $foodNo, $eatingAmount);
    // $stmt->execute();
    }

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo "<script>alert('数据插入成功'); window.location.href = 'eatPage.php';</script>";
        exit();
    } else {
        echo "<script>alert('数据插入失败: 没有受影响的行数');</script>";
    }
} else {
    echo "<script>alert('数据插入失败: " . $stmt->error . "');</script>";
}

$stmt->close();
$conn->close();

?>
