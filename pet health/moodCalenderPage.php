<!DOCTYPE html>
<html>
<head>
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
        </ul>
    </div>

    <div style="margin-left: 220px;">
        <h2>Mood Calender</h2>
        <table>
            <?php
                session_start();   
                // 连接到数据库
                $conn = new mysqli('localhost', 'root', '', '4007');
                
                // 检查数据库连接是否成功
                if ($conn->connect_error) {
                    die("数据库连接失败: " . $conn->connect_error);
                }
                
                $petNo = $_SESSION['pet-no'];
                $userId = $_SESSION['user-id'];

                // 查询数据库获取最近的三十条记录
                $sql = "SELECT mood_type, mood_date FROM mood WHERE pet_no = '$petNo' AND user_id = '$userId' ORDER BY mood_date DESC LIMIT 30";
                $result = $conn->query($sql);
                
                // 创建一个二维数组来存储每个日期对应的心情
                $moods = array();
                while ($row = $result->fetch_assoc()) {
                    $monthYear = date('m-Y', strtotime($row['mood_date']));
                    $day = date('j', strtotime($row['mood_date']));
                    $moods[$monthYear][$day] = $row['mood_type'];
                }
                
                // 反转月份的顺序
                $moods = array_reverse($moods, true);
                // echo "<pre>";
                // print_r($moods);
                // echo "</pre>";
                // 输出表格
                foreach ($moods as $monthYear => $moodData) {
                    echo "<tr>";
                    echo "<th colspan='7'>$monthYear</th>";
                    echo "</tr>";
                    
                    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, substr($monthYear, 0, 2), substr($monthYear, 3, 4));
                    $dayOfMonth = 1;
                    
                    while ($dayOfMonth <= $daysInMonth) {
                        echo "<tr>";
                        
                        for ($cell = 1; $cell <= 7; $cell++) {
                            if ($dayOfMonth <= $daysInMonth) {
                                echo "<td>";
                                echo "<div>$dayOfMonth</div>";
                                
                                $currentDay = sprintf("%d", $dayOfMonth);
                                if (isset($moodData[$currentDay])) {
                                    $mood = $moodData[$currentDay];
                                    $imageFile = '';
            
                                    if ($mood == 'angry') {
                                        $imageFile = 'emoji\angry.jpg';
                                    } elseif ($mood == 'sad') {
                                        $imageFile = 'emoji\sad.jpg';
                                    } elseif ($mood == 'happy') {
                                        $imageFile = 'emoji\happy.jpg';
                                    } else {
                                        $imageFile = 'emoji\others.jpg';
                                    }
            
                                    echo "<div><img src='$imageFile' alt='$mood' style='max-width: 30px; max-height: 30px;'></div>";
                                }
            
                                echo "</td>";
                                
                                $dayOfMonth++;
                            } else {
                                break 2;
                            }
                        }
                        
                        echo "</tr>";
                    }
                }
                
                $conn->close();
            ?>
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