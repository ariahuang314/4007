<?php
// 连接到数据库
$link = mysqli_connect('localhost', 'root', '', '4007') or die('Failed to connect or select database');
mysqli_set_charset($link, 'utf8mb4');
    
    // 从表单中获取新product的信息
    $eating_record_no = $_POST["u_eating_record_no"];
    $pet_no = $_POST["u_pet_no"];
    $user_id = $_POST["u_user_id"];
    $food_no = $_POST["u_food_no"];
    $eating_amount = $_POST["u_eating_amount"];
    $eating_date = $_POST["u_eating_date"];

    // 构建 SQL INSERT 语句来将新product插入到数据库中
    $sql = "UPDATE eating SET pet_no = ?, user_id = ?, food_no = ?, eating_amount = ?, eating_date = ? WHERE eating_record_no = ?";

    // 使用预处理语句准备 SQL 语句
    $statement = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($statement, "iiiisi", $pet_no, $user_id, $food_no, $eating_amount, $eating_date, $eating_record_no);

    // 执行 SQL 语句并获取结果
    $result = mysqli_stmt_execute($statement);

    // 检查 SQL 语句是否执行成功
    if ($result) {
        // 显示成功消息，并将product重定向回 admin_product.php 页面
        header('Location: admin_eating.php');
        exit(); // 终止脚本执行
    } else {
        echo "Insert failed! Please recheck the input format!";
    }