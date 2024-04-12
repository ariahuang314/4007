<?php
// 获取品牌参数
$brand = $_GET['brand'];

// 连接到数据库并执行查询，获取属于选中品牌的不重复类型列表
$conn = new mysqli('localhost', 'root', '', '4007');
$query = "SELECT DISTINCT food_type FROM food WHERE food_brand = '$brand'";
$result = $conn->query($query);

// 将类型列表存储在数组中
$types = array();
while ($row = $result->fetch_assoc()) {
    $types[] = $row['food_type'];
}

// 返回JSON格式的类型列表
echo json_encode($types);
?>