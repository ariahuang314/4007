<?php
// 连接到数据库
$link = mysqli_connect('localhost', 'root', '', '4007') or die('Failed to connect or select database');
mysqli_set_charset($link, 'utf8mb4');

// 获取ID
$eating_record_no = $_GET['eating_record_no'];

// 构建查询语句来获取详细信息
$sql = "SELECT * FROM eating WHERE eating_record_no = ?";
$statement = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($statement, "i", $eating_record_no);
mysqli_stmt_execute($statement);

// 获取查询结果
$result = mysqli_stmt_get_result($statement);

// 检查结果是否存在
if ($row = mysqli_fetch_assoc($result)) {
    // 将结果转换为关联数组
    $eatingDetails = array(
        'u_eating_record_no' => $row['eating_record_no'],
        'u_pet_no' => $row['pet_no'],
        'u_user_id' => $row['user_id'],
        'u_food_no' => $row['food_no'],
        'u_eating_amount' => $row['eating_amount'],
        'u_eating_date' => $row['eating_date']
    );

    // 将详细信息作为JSON响应返回
    header('Content-Type: application/json');
    echo json_encode($eatingDetails);
} else {
    // 不存在或查询失败
    // 返回一个错误消息或适当的响应
    // 例如，返回一个空的JSON对象
    header('Content-Type: application/json');
    echo json_encode((object)[]);
}
?>