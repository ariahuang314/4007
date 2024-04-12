<?php
// 连接到数据库
$link = mysqli_connect('localhost', 'root', '', '4007') or die('Failed to connect or select database');
mysqli_set_charset($link, 'utf8mb4');

if (isset($_POST["submit"])) {
    
    $sql = "SELECT MAX(eating_record_no) AS max_eating_record_no FROM eating";
    $result = mysqli_query($link, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // 处理查询结果
        $row = mysqli_fetch_assoc($result);
        $maxFoodNo = $row["max_eating_record_no"];

        // 将 eating_record_no 转换为整数，并增加1
        $newFoodNo = intval($maxFoodNo) + 1;

    } else {
        // 如果表中没有任何记录，则使用默认的起始 eating_record_no
        $newFoodNo = 1;
    }
    
    // 从表单中获取新用户的信息
    $eating_record_no = $newFoodNo;
    $pet_no = $_POST["pet_no"];
    $user_id = $_POST["user_id"];
    $food_no = $_POST["food_no"];
    $eating_amount = $_POST["eating_amount"];
    $eating_date = $_POST["eating_date"]; // 修改此处的字段名称

    // 构建 SQL INSERT 语句来将新用户插入到数据库中
    $sql = "INSERT INTO eating (eating_record_no, pet_no, user_id, food_no, eating_amount, eating_date) VALUES (?, ?, ?, ?, ?, ?)";

    // 使用预处理语句准备 SQL 语句
    $statement = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($statement, "iiiiis", $eating_record_no, $pet_no, $user_id, $food_no, $eating_amount, $eating_date);

    // 执行 SQL 语句并获取结果
    $result = mysqli_stmt_execute($statement);

    // 检查 SQL 语句是否执行成功
    if ($result) {
        // 显示成功消息，并将用户重定向回 admin_product.php 页面
        header('Location: admin_eating.php');
        exit(); // 终止脚本执行
    } else {
        echo "Insert failed! Please recheck the input format!";
    }
}
