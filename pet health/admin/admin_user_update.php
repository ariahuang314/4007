<?php
// 连接到数据库
$link = mysqli_connect('localhost', 'root', '', '4007') or die('Failed to connect or select database');
mysqli_set_charset($link, 'utf8mb4');
    
    // 从表单中获取新用户的信息
    $user_id = $_POST["u_user_id"];
    $user_name = $_POST["u_user_name"];
    $gender = $_POST["u_gender"];
    $phone = $_POST["u_phone"];
    $address = $_POST["u_address"];
    $password = $_POST["u_password"];

    // 构建 SQL INSERT 语句来将新用户插入到数据库中
    $sql = "UPDATE user SET user_name = ?, gender = ?, phone = ?, address = ?, password = ? WHERE user_id = ?";

    // 使用预处理语句准备 SQL 语句
    $statement = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($statement, "sssssi", $user_name, $gender, $phone, $address, $password, $user_id);

    // 执行 SQL 语句并获取结果
    $result = mysqli_stmt_execute($statement);

    // 检查 SQL 语句是否执行成功
    if ($result) {
        // 显示成功消息，并将用户重定向回 admin_user.php 页面
        header('Location: admin_user.php');
        exit(); // 终止脚本执行
    } else {
        echo "Insert failed! Please recheck the input format!";
    }
