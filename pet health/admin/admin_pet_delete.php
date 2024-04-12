<?php
// 连接数据库
$link = mysqli_connect('localhost', 'root', '', '4007') or die('Failed to connect or select database');
mysqli_set_charset($link, 'utf8mb4');

// 检查是否设置了要删除的ID
if (isset($_GET['pet_no'])) {
    // 删除用户记录
    $pet_no = mysqli_real_escape_string($link, $_GET['pet_no']); // 防止SQL注入攻击
    $sql = "DELETE FROM pet WHERE pet_no = $pet_no";
    $result = mysqli_query($link, $sql);

    // 检查删除操作是否成功
    if ($result && mysqli_affected_rows($link) > 0) {
        header('Location: admin_pet.php');
        exit(); // 终止脚本执行
    } else {
        echo "Failed to delete : " . mysqli_error($link);
    }
} else {
    echo "Pet ID not provided!";
}

// 关闭数据库连接
mysqli_close($link);
?>