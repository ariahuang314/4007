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

$sql = "SELECT duration, exercise_date, exercise_type FROM exercise WHERE pet_no = '$petNo' AND user_id = '$userId'ORDER BY exercise_date";
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
    <title>运动时间统计</title>
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
            <li><a href="eatPage.php">Diet Tracking</b></a></li>
            <li><a href="hydrationPage.php">Hydration Tracking</li>
            <li><a href="exercisePage.php">Exercise Tracking</a></li>
            <li><a href="moodPage.php">Mood Detection</a></li>
            <li><a href="analysisPage.php"><b>Pet Analysis</a></a></li>
            <!-- <li><a href="WastePage.php">Waste Management</a></li>
            <li><a href="recordPage.php">Daily record</a></li> -->
        </ul>
    </div>

    <div style="margin-left: 300px;">
        <h2>Exercise Time Analysis</h2>
        <canvas id="myChart"></canvas>
        <script>
            // 基于提取的数据生成柱状图和折线图
            var data = <?php echo json_encode($data); ?>;
            var exerciseDates = [];
            var totalDurationsPerDay = {};
            var durationsPerExerciseType = {};

            // 计算每个 exercise_date 的总 duration 值和各个运动种类的时间
            data.forEach(function(row) {
                var exerciseDate = row.exercise_date;
                var duration = parseInt(row.duration);
                var exerciseType = row.exercise_type;

                // 计算每个 exercise_date 的总 duration 值
                if (!totalDurationsPerDay[exerciseDate]) {
                    totalDurationsPerDay[exerciseDate] = duration;
                } else {
                    totalDurationsPerDay[exerciseDate] += duration;
                }

                // 计算各个运动种类的时间
                if (!durationsPerExerciseType[exerciseType]) {
                    durationsPerExerciseType[exerciseType] = {};
                }
                if (!durationsPerExerciseType[exerciseType][exerciseDate]) {
                    durationsPerExerciseType[exerciseType][exerciseDate] = duration;
                } else {
                    durationsPerExerciseType[exerciseType][exerciseDate] += duration;
                }

                // 保留 exerciseDate 的唯一值
                if (!exerciseDates.includes(exerciseDate)) {
                    exerciseDates.push(exerciseDate);
                }
            });

            var ctx = document.getElementById('myChart').getContext('2d');
            var chartData = {
                labels: exerciseDates,
                datasets: []
            };

            // 添加各个运动种类的数据到柱状图
            Object.keys(durationsPerExerciseType).forEach(function(exerciseType) {
                var durations = exerciseDates.map(function(date) {
                    return durationsPerExerciseType[exerciseType][date] || 0;
                });

                var dataset = {
                    label: exerciseType,
                    data: durations,
                    backgroundColor: getRandomColor(),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                };

                chartData.datasets.push(dataset);
            });

            // 添加折线图数据
            var totalDurations = exerciseDates.map(function(date) {
                return totalDurationsPerDay[date] || 0;
            });

            var lineDataset = {
                label: 'Total Duration',
                data: totalDurations,
                type: 'line',
                fill: false,
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2
            };

            chartData.datasets.push(lineDataset);

            var myChart= new Chart(ctx, {
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

            // 生成随机颜色
            function getRandomColor() {
                var letters = '0123456789ABCDEF';
                var color = '#';
                for (var i = 0; i < 6; i++) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
                return color;
            }
        </script>
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