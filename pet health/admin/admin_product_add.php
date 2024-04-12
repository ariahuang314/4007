<?php
// 连接到数据库
$link = mysqli_connect('localhost', 'root', '', '4007') or die('Failed to connect or select database');
mysqli_set_charset($link, 'utf8mb4');

if (isset($_POST["submit"])) {
    
    $sql = "SELECT MAX(food_no) AS max_food_no FROM food";
    $result = mysqli_query($link, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // 处理查询结果
        $row = mysqli_fetch_assoc($result);
        $maxFoodNo = $row["max_food_no"];

        // 将 food_no 转换为整数，并增加1
        $newFoodNo = intval($maxFoodNo) + 1;

    } else {
        // 如果表中没有任何记录，则使用默认的起始 food_no
        $newFoodNo = 1;
    }
    
    // 从表单中获取新用户的信息
    $food_no = $newFoodNo;
    $food_brand = $_POST["food_brand"];
    $food_type = $_POST["food_type"];
    $food_name = $_POST["food_name"];
    $calories_100g = $_POST["calories_100g"];
    $fat = $_POST["fat"];
    $protein = $_POST["protein"]; // 修改此处的字段名称

    // 构建 SQL INSERT 语句来将新用户插入到数据库中
    $sql = "INSERT INTO food (food_no, food_brand, food_type, food_name, calories_100g, fat, protein) VALUES (?, ?, ?, ?, ?, ?, ?)";

    // 使用预处理语句准备 SQL 语句
    $statement = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($statement, "isssddd", $food_no, $food_brand, $food_type, $food_name, $calories_100g, $fat, $protein);

    // 执行 SQL 语句并获取结果
    $result = mysqli_stmt_execute($statement);

    // 检查 SQL 语句是否执行成功
    if ($result) {
        // 显示成功消息，并将用户重定向回 admin_product.php 页面
        header('Location: admin_product.php');
        exit(); // 终止脚本执行
    } else {
        echo "Insert failed! Please recheck the input format!";
    }
}
