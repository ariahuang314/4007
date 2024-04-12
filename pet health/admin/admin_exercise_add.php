<?php
// 连接到数据库
$link = mysqli_connect('localhost', 'root', '', '4007') or die('Failed to connect or select database');
mysqli_set_charset($link, 'utf8mb4');

if (isset($_POST["submit"])) {
    
    $sql = "SELECT MAX(exercise_record_no) AS max_exercise_record_no FROM exercise";
    $result = mysqli_query($link, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // 处理查询结果
        $row = mysqli_fetch_assoc($result);
        $maxExerNo = $row["max_exercise_record_no"];

        // 将 exercise_record_no 转换为整数，并增加1
        $newExerNo = intval($maxExerNo) + 1;

    } else {
        // 如果表中没有任何记录，则使用默认的起始 exercise_record_no
        $newExerNo = 1;
    }
    
    // 从表单中获取新用户的信息
    
    
    $exercise_record_no = $newExerNo;
    $user_id = $_POST["user_id"];
    $pet_no = $_POST["pet_no"];
    $duration = $_POST["duration"];
    $exercise_type = $_POST["exercise_type"];
    $exercise_date = $_POST["exercise_date"]; // 修改此处的字段名称

    // 构建 SQL INSERT 语句来将新用户插入到数据库中
    $sql = "INSERT INTO exercise (exercise_record_no, user_id, pet_no, duration, exercise_type, exercise_date) VALUES (?, ?, ?, ?, ?, ?)";

    // 使用预处理语句准备 SQL 语句
    $statement = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($statement, "iiidss", $exercise_record_no, $user_id, $pet_no , $duration, $exercise_type, $exercise_date);

    // 执行 SQL 语句并获取结果
    $result = mysqli_stmt_execute($statement);

    // 检查 SQL 语句是否执行成功
    if ($result) {
        // 显示成功消息，并将用户重定向回 admin_exercise.php 页面
        header('Location: admin_exercise.php');
        exit(); // 终止脚本执行
    } else {
        echo "Insert failed! Please recheck the input format!";
    }
}
