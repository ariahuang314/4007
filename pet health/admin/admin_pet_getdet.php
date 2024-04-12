<?php
// 连接到数据库
$link = mysqli_connect('localhost', 'root', '', '4007') or die('Failed to connect or select database');
mysqli_set_charset($link, 'utf8mb4');

// 获取ID
$pet_no = $_GET['pet_no'];
// 构建查询语句来获取详细信息
$sql = "SELECT * FROM pet WHERE pet_no = ?";
$statement = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($statement, "i", $pet_no);
mysqli_stmt_execute($statement);

// 获取查询结果
$result = mysqli_stmt_get_result($statement);

// 检查结果是否存在
if ($row = mysqli_fetch_assoc($result)) {
    // 将结果转换为关联数组
    $petDetails = array(
        'u_pet_no' => $row['pet_no'],
        'u_pet_name' => $row['pet_name'],
        'u_pet_species' => $row['pet_species'],
        'u_pet_category' => $row['pet_category'],
        'u_gender' => $row['gender'],
        'u_date_of_birth' => $row['date_of_birth'],
        'u_height' => $row['height'],
        'u_weight' => $row['weight'],
        'u_user_id' => $row['user_id'],
        'u_photo' => $row['photo'],
        'u_age' => $row['age']
    );

    // 将详细信息作为JSON响应返回
    header('Content-Type: application/json');
    echo json_encode($petDetails);
}

?>