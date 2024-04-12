<?php
// 连接到数据库
$link = mysqli_connect('localhost', 'root', '', '4007') or die('Failed to connect or select database');
mysqli_set_charset($link, 'utf8mb4');

// 获取用户ID
$hydration_record_no = $_GET['hydration_record_no'];

// 构建查询语句来获取用户详细信息
$sql = "SELECT * FROM hydration WHERE hydration_record_no = ?";
$statement = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($statement, "i", $hydration_record_no);
mysqli_stmt_execute($statement);

// 获取查询结果
$result = mysqli_stmt_get_result($statement);

// 检查结果是否存在
if ($row = mysqli_fetch_assoc($result)) {
    // 将结果转换为关联数组
    $hydrationDetails = array(
        'u_user_id' => $row['user_id'],
        'u_hydration_record_no' => $row['hydration_record_no'],
        'u_hydration_date' => $row['hydration_date'],
        'u_pet_no' => $row['pet_no'],
        
    );

    // 将用户详细信息作为JSON响应返回
    header('Content-Type: application/json');
    echo json_encode($hydrationDetails);
} else {
    // 用户不存在或查询失败
    // 返回一个错误消息或适当的响应
    // 例如，返回一个空的JSON对象
    header('Content-Type: application/json');
    echo json_encode((object)[]);
}
?>