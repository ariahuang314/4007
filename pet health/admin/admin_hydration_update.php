<?php
// 连接到数据库
$link = mysqli_connect('localhost', 'root', '', '4007') or die('Failed to connect or select database');
mysqli_set_charset($link, 'utf8mb4');
    
    // 从表单中获取新用户的信息
    $user_id = $_POST["u_user_id"];
    $hydration_record_no = $_POST["u_hydration_record_no"];
    $hydration_date = $_POST["u_hydration_date"];
    $pet_no = $_POST["u_pet_no"];

    // 构建 SQL INSERT 语句来将新用户插入到数据库中
    $sql = "UPDATE hydration SET user_id = ?, hydration_date = ?, pet_no = ? WHERE hydration_record_no = ? ";

    // 使用预处理语句准备 SQL 语句
    $statement = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($statement, "isii", $user_id, $hydration_date, $pet_no, $hydration_record_no, );

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
