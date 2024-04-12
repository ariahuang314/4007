<?php
// 连接到数据库
$link = mysqli_connect('localhost', 'root', '', '4007') or die('Failed to connect or select database');
mysqli_set_charset($link, 'utf8mb4');
    
    // 从表单中获取新product的信息
    $mood_record_no = $_POST["u_mood_record_no"];
    $pet_no = $_POST["u_pet_no"];
    $mood_type = $_POST["u_mood_type"];
    $mood_date = $_POST["u_mood_date"];
    $photo = $_POST["u_photo"];
    $user_id = $_POST["u_user_id"];

    // 构建 SQL INSERT 语句来将新product插入到数据库中
    $sql = "UPDATE mood SET mood_date = ?, mood_type = ?, photo = ?, pet_no = ?, user_id = ? WHERE mood_record_no = ?";

    // 使用预处理语句准备 SQL 语句
    $statement = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($statement, "ssbiii", $mood_date , $mood_type, $photo, $pet_no, $user_id, $mood_record_no);

    // 执行 SQL 语句并获取结果
    $result = mysqli_stmt_execute($statement);

    // 检查 SQL 语句是否执行成功
    if ($result) {
        // 显示成功消息，并将product重定向回 admin_product.php 页面
        header('Location: admin_mood.php');
        exit(); // 终止脚本执行
    } else {
        echo "Insert failed! Please recheck the input format!";
    }