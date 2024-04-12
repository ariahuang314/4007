<?php
session_start();
// 创建数据库连接
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "4007";

$petNo = $_SESSION['pet-no'];
$userId = $_SESSION['user-id'];

$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接是否成功
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 查询每天的总热量、脂肪和蛋白质
$sql = "
    SELECT *
    FROM (
        SELECT
            eating.eating_date,
            SUM(food.calories_100g / 100 * eating.eating_amount) AS total_calories,
            SUM(food.fat / 100 * eating.eating_amount) AS total_fat,
            SUM(food.protein / 100 * eating.eating_amount) AS total_protein
        FROM
            eating
        INNER JOIN
            food ON eating.food_no = food.food_no
        WHERE pet_no = '$petNo' AND user_id = '$userId'
        GROUP BY
            eating.eating_date
        ORDER BY
            eating.eating_date DESC
        LIMIT 7
    ) AS subquery
    ORDER BY eating_date ASC
";

$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>营养摄入统计</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <title>Pet Health Management System</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            text-align: center;
            padding: 10px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        #menu {
            background-color: #8FBC8F;
            width: 200px;
            height: 600px;
            float: left;
        }
        .menuInner {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
        .menuInner li {
            margin: 10px;
        }
        .menuInner li a {
            color: white;
            display: block;
            padding: 10px;
            text-decoration: none;
        }
    </style>

</head>
<body>
    <h1 style="background-color:#8FBC8F;height:50px;">Pet Health Management System</h1>
    <!--Menu-->
    <div id="menu">
        <ul class="menuInner">
            <li><a href="0410/pethealth/main.php" >Main Page</a></li>
            <li><a href="0410/project/forum.php" >Information Forum</a></li>
            <li><a href="eatPage.php">Diet Tracking</a></li>
            <li><a href="hydrationPage.php">Hydration Tracking</a></li>
            <li><a href="exercisePage.php">Exercise Tracking</a></li>
            <li><a href="moodPage.php">Mood Detection</a></li>
            <li><a href="analysisPage.php"><b>Pet Analysis</b></a></li>
            <!-- <li><a href="WastePage.php">Waste Management</a></li>
            <li><a href="recordPage.php">Daily record</a></li> -->
        </ul>
    </div>

    <div>
    <h2>Nutrition Intake Analysis</h2>
    </div>

    <div class="container">
        <form action="" method="post">
            <input type="submit" name="7days" value="7 days">
            <input type="submit" name="14days" value="14 days">
            <input type="submit" name="30days" value="30 days">
        </form>
    </div>

    <?php
    if (isset($_POST['7days'])) {
        header("Location: food7Days.php");
        exit;
    }

    if (isset($_POST['14days'])) {
        header("Location: food14Days.php");
        exit;
    }

    if (isset($_POST['30days'])) {
        header("Location: food30Days.php");
        exit;
    }
    ?>


    <div style="margin-left: 300px;">

        <canvas id="myChart"></canvas>
        <script>
            // 基于提取的数据生成折线图和直方图
            var data = <?php echo json_encode($data); ?>;
            var eatingDates = data.map(function(row) {
                return row.eating_date;
            });

            var totalCalories = data.map(function(row) {
                return row.total_calories;
            });

            var totalFat = data.map(function(row) {
                return row.total_fat;
            });

            var totalProtein = data.map(function(row) {
                return row.total_protein;
            });

            var ctx = document.getElementById('myChart').getContext('2d');
            var chartData = {
                labels: eatingDates,
                datasets: [
                    {
                        label: 'Total Calories',
                        data: totalCalories,
                        type: 'line',
                        fill: false,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2
                    },
                    {
                        label: 'Total Fat',
                        data: totalFat,
                        backgroundColor: 'rgba(255, 99, 132, 0.5)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Total Protein',
                        data: totalProtein,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }
                ]
            };

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: chartData,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
        <table>
            <tr>
                <th>Date</th>
                <th>Total Calories</th>
                <th>Total Fat</th>
                <th>Total Protein</th>
            </tr>
            <?php foreach ($data as $row) { ?>
                <tr>
                <td><?php echo $row['eating_date']; ?></td>
                <td><?php echo number_format($row['total_calories'], 2); ?></td>
                <td><?php echo number_format($row['total_fat'], 2); ?></td>
                <td><?php echo number_format($row['total_protein'], 2); ?></td>
    </tr>
            <?php } ?>
        </table>
    </div>
    <button class="returnButton" onclick="goBack('analysisPage.php')">Back</button>


    <script>
            function goBack(filePath) {
                window.location.href = filePath;
            }

            // 显示返回按钮
            var buttons = document.querySelectorAll('input[type="submit"]');
            for (var i = 0; i < buttons.length; i++) {
                buttons[i].addEventListener('click', function() {
                    var returnButton = document.querySelector('.returnButton');
                    returnButton.style.display = 'block';
                });
            }
    </script>
</body>
</html>