<?php
// 获取品牌和类型参数
$brand = $_GET['brand'];
$type = $_GET['type'];

// 连接到数据库并执行查询，获取符合品牌和类型条件的名称列表
$conn = new mysqli('localhost', 'root', '', '4007');
$query = "SELECT food_name FROM food WHERE food_brand = '$brand' AND food_type = '$type'";
$result = $conn->query($query);

// 将名称列表存储在数组中
$names = array();
while ($row = $result->fetch_assoc()) {
    $names[] = $row['food_name'];
}

// 返回JSON格式的名称列表
echo json_encode($names);
?>