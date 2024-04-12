<?php
session_start();
// 连接到数据库
$servername = "localhost";  // 数据库服务器名称
$username = "root";         // 数据库用户名
$password = "";             // 数据库密码
$dbname = "4007";      // 数据库名称

// 创建数据库连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接是否成功
if ($conn->connect_error) {
    die("连接数据库失败: " . $conn->connect_error);
}
$petNo = $_SESSION['pet-no'];
$userId = $_SESSION['user-id'];

// 检查是否收到要删除的记录编号
if (isset($_POST['delete_record_no'])) {
    // 获取要删除的记录编号
    $hydration_record_no = $_POST['delete_record_no'];
    
    // 执行删除操作
    $sql = "DELETE FROM hydration WHERE hydration_record_no = $hydration_record_no";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('数据删除成功'); window.location.href = 'hydrationPage.php';</script>";
    } else {
        echo "<script>alert('数据删除失败'); window.location.href = 'hydrationPage.php';</script>";
    }
}

// 执行查询操作获取最近的 5 个常见组合
$sql = "SELECT hydration_record_no, pet_no, hydration_date, record_time, hydration_times
        FROM hydration
        WHERE pet_no = $petNo
        ORDER BY hydration_record_no DESC
        LIMIT 10";
$result = $conn->query($sql);

// 检查查询结果
if ($result->num_rows > 0) {
    echo '<table id="commonCollocationTable">';
    echo '<thead>';
    echo '<tr>
            <th>Record Time</th>
            <th>Hydration Times</th>
            <th>Hydration Date</th>
            <th></th>
          </tr>';
    echo '</thead>';
    echo '<tbody>';
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['record_time'] . '</td>';
        echo '<td>' . $row['hydration_times'] . '</td>';
        echo '<td>' . $row['hydration_date'] . '</td>';
        echo '<td><button onclick="deleteRecord(' . $row['hydration_record_no'] . ')">Delete it</button></td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
} else {
    echo 'No hydration record, Try to Save it!';
}

// 关闭数据库连接
$conn->close();
?>

<script>
    function deleteRecord(recordNo) {
        var confirmation = confirm("确定要删除记录吗？");
        if (confirmation) {
            // 创建一个隐藏的表单，用于提交要删除的记录编号
            var form = document.createElement("form");
            form.setAttribute("method", "post");
            form.setAttribute("action", "");
            
            var input = document.createElement("input");
            input.setAttribute("type", "hidden");
            input.setAttribute("name", "delete_record_no");
            input.setAttribute("value", recordNo);
            
            form.appendChild(input);
            document.body.appendChild(form);
            
            // 提交表单
            form.submit();
        }
    }
</script>