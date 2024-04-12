<?php
// session_start();
// 连接到数据库
$servername = "localhost";  // 数据库服务器名称
$username = "root";         // 数据库用户名
$password = "";             // 数据库密码
$dbname = "4007";  // 数据库名称

// 创建数据库连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接是否成功
if ($conn->connect_error) {
    die("连接数据库失败: " . $conn->connect_error);
}

$petNo = $_SESSION['pet-no'];
$userId = $_SESSION['user-id'];
// 执行查询操作获取最近的 5 个常见组合
$sql = "SELECT cc.food_no, cc.eating_amount, f.food_brand, f.food_type, f.food_name
        FROM common_collocation cc
        INNER JOIN food f ON cc.food_no = f.food_no
        WHERE cc.user_id = '$userId'
        ORDER BY cc.collocation_no DESC
        LIMIT 5";
$result = $conn->query($sql);

// 检查查询结果
if ($result->num_rows > 0) {
    echo '<table id="commonCollocationTable">';
    echo '<thead>';
    echo '<tr>
            <th>Brand</th>
            <th>Type</th>
            <th>Name</th>
            <th>Amount(g)</th>
            <th></th>
          </tr>';
    echo '</thead>';
    echo '<tbody>';
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['food_brand'] . '</td>';
        echo '<td>' . $row['food_type'] . '</td>';
        echo '<td>' . $row['food_name'] . '</td>';
        echo '<td>' . $row['eating_amount'] . '</td>';
        // echo '<td><button onclick="fillForm(' . $row['food_brand'] .  ', ' . $row['food_type'] . ', ' . $row['food_name'] . ', ' . $row['eating_amount'] . ')">Fill in</button></td>';
        echo '<td><button onclick="fillForm(\'' . $row['food_brand'] .  '\', \'' . $row['food_type'] . '\', \'' . $row['food_name'] . '\', ' . $row['eating_amount'] . ')">Fill in</button></td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
} else {
    echo 'No Common Collocation, Try to Save it!';
}

// 关闭数据库连接
$conn->close();
?>
