<?php
// 连接到数据库
$link = mysqli_connect('localhost', 'root', '', '4007') or die('Failed to connect or select database');
mysqli_set_charset($link, 'utf8mb4');

if (isset($_POST["submit"])) {
    
    $sql = "SELECT MAX(hydration_record_no) AS max_hydration_record_no FROM hydration";
    $result = mysqli_query($link, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // 处理查询结果
        $row = mysqli_fetch_assoc($result);
        $maxHydrationNo = $row["max_hydration_record_no"];

        // 将 user_id 转换为整数，并增加1
        $newHydration = intval($maxHydrationNo) + 1;

    } else {
        // 如果表中没有任何记录，则使用默认的起始 user_id
        $newHydration = 1;
    }
    
    // 从表单中获取新用户的信息
    $hydration_record_no = $newHydration;
    $user_id = $_POST["user_id"];
    $pet_no = $_POST["pet_no"];
    $hydration_date = $_POST["hydration_date"];
     // 修改此处的字段名称

    // 构建 SQL INSERT 语句来将新用户插入到数据库中
    $sql = "INSERT INTO hydration (user_id, pet_no, hydration_record_no, hydration_date) VALUES (?, ?, ?, ?)";

    // 使用预处理语句准备 SQL 语句
    $statement = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($statement, "iiis", $user_id, $pet_no, $hydration_record_no, $hydration_date);

    // 执行 SQL 语句并获取结果
    $result = mysqli_stmt_execute($statement);

    // 检查 SQL 语句是否执行成功
    if ($result) {
        // 显示成功消息，并将用户重定向回 admin_user.php 页面
        header('Location: admin_hydration.php');
        exit(); // 终止脚本执行
    } else {
        echo "Insert failed! Please recheck the input format!";
    }
}
