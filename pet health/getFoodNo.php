<?php
// 获取品牌和类型参数
$brand = $_GET['brand'];
$type = $_GET['type'];
$name = $_GET['name'];

// 连接到数据库
$conn = new mysqli('localhost', 'root', '', '4007');

// 使用预处理语句来防止 SQL 注入攻击
$sql = "SELECT food_no FROM food WHERE food_brand = ? AND food_type = ? AND food_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $brand, $type, $name);
$stmt->execute();

// 获取查询结果
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // 输出匹配到的 food_no 值
    while ($row = $result->fetch_assoc()) {
        echo $row["food_no"];
    }
} else {
    echo "No match Food No";
}

$stmt->close();
$conn->close();
?>