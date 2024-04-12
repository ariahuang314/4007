<?php
// 连接到数据库
$link = mysqli_connect('localhost', 'root', '', '4007') or die('Failed to connect or select database');
mysqli_set_charset($link, 'utf8mb4');

// 获取ID
$food_no = $_GET['food_no'];

// 构建查询语句来获取详细信息
$sql = "SELECT * FROM food WHERE food_no = ?";
$statement = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($statement, "i", $food_no);
mysqli_stmt_execute($statement);

// 获取查询结果
$result = mysqli_stmt_get_result($statement);

// 检查结果是否存在
if ($row = mysqli_fetch_assoc($result)) {
    // 将结果转换为关联数组
    $productDetails = array(
        'u_food_no' => $row['food_no'],
        'u_food_brand' => $row['food_brand'],
        'u_food_type' => $row['food_type'],
        'u_food_name' => $row['food_name'],
        'u_calories_100g' => $row['calories_100g'],
        'u_fat' => $row['fat'],
        'u_protein' => $row['protein']
    );

    // 将详细信息作为JSON响应返回
    header('Content-Type: application/json');
    echo json_encode($productDetails);
} else {
    // 不存在或查询失败
    // 返回一个错误消息或适当的响应
    // 例如，返回一个空的JSON对象
    header('Content-Type: application/json');
    echo json_encode((object)[]);
}
?>