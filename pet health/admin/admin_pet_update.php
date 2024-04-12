<?php
// 连接到数据库
$link = mysqli_connect('localhost', 'root', '', '4007') or die('Failed to connect or select database');
mysqli_set_charset($link, 'utf8mb4');
    
    // 从表单中获取新product的信息
    $u_pet_no = $_POST["u_pet_no"];
    $u_pet_name = $_POST["u_pet_name"];
    $u_pet_species = $_POST["u_pet_species"];
    $u_pet_category = $_POST["u_pet_category"];
    $u_gender = $_POST["u_gender"];
    $u_date_of_birth = $_POST["u_date_of_birth"];
    $u_height = $_POST["u_height"];
    $u_weight = $_POST["u_weight"];
    $u_user_id = $_POST["u_user_id"];
    //$u_photo = $_POST["u_photo"];
    $u_age = $_POST["u_age"];

    // 构建 SQL INSERT 语句来将新product插入到数据库中
    $sql = "UPDATE pet SET pet_name = ?, pet_species = ?, pet_category = ?, gender = ?, date_of_birth = ?, height = ?, weight = ?, user_id = ?, age = ? WHERE pet_no = ?";

    // 使用预处理语句准备 SQL 语句
    $statement = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($statement, "sssssddiii", $u_pet_name, $u_pet_species, $u_pet_category, $u_gender, $u_date_of_birth, $u_height, $u_weight, $u_user_id, $u_age, $u_pet_no);

    // 执行 SQL 语句并获取结果
    $result = mysqli_stmt_execute($statement);

    // 检查 SQL 语句是否执行成功
    if ($result) {
        // 显示成功消息，并将et重定向回 admin_pet.php 页面
        header('Location: admin_pet.php');
        exit(); // 终止脚本执行
    } else {
        echo "Insert failed! Please recheck the input format!";
    }