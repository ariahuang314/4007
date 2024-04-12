<?php
// 连接到数据库
$link = mysqli_connect('localhost', 'root', '', '4007') or die('Failed to connect or select database');
mysqli_set_charset($link, 'utf8mb4');

// 在提交表单后进行处理
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $sql = "SELECT MAX(pet_no) AS max_pet_no FROM pet";
    $result = mysqli_query($link, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // 处理查询结果
        $row = mysqli_fetch_assoc($result);
        $maxPetNo = $row["max_pet_no"];

        // 将 food_no 转换为整数，并增加1
        $newPetNo = intval($maxPetNo) + 1;

    } else {
        // 如果表中没有任何记录，则使用默认的起始
        $newPetNo = 1;
    }
    // 从表单中获取新宠物的信息
    $pet_no = $newPetNo;
    $pet_name = $_POST["pet_name"];
    $pet_species = $_POST["pet_species"];
    $pet_category = $_POST["pet_category"];
    $gender = $_POST["gender"];
    $date_of_birth = $_POST["date_of_birth"];
    $height = $_POST["height"];
    $weight = $_POST["weight"];
    $user_id = $_POST["user_id"];
    $age = $_POST["age"];
    // 通过 $_FILES 获取上传的文件内容
    if ($_FILES["photo"]["error"] === UPLOAD_ERR_OK) {
        $photo = file_get_contents($_FILES["photo"]["tmp_name"]);
    }

    // 构建 SQL INSERT 语句来将新宠物插入到数据库中
    $sql = "INSERT INTO pet (pet_no, pet_name, pet_species, pet_category, gender, date_of_birth, height, weight, user_id, photo, age) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // 使用预处理语句准备 SQL 语句
    $statement = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($statement, "isssssddibi", $pet_no, $pet_name, $pet_species, $pet_category, $gender, $date_of_birth, $height, $user_id, $weight, $photo, $age);

    // 执行 SQL 语句并获取结果
    $result = mysqli_stmt_execute($statement);

    // 检查 SQL 语句是否执行成功
    if ($result) {
        // 显示成功消息，并将用户重定向回 admin_pet.php 页面
        header('Location: admin_pet.php');
        exit(); // 终止脚本执行
    } else {
        echo "Insert failed! Please recheck the input format!";
    }
}
?>