<!-- Required styles for Material Web -->
<link rel="stylesheet" href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
<!-- Required Material Web JavaScript library -->
<script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
<!-- Instantiate single textfield component rendered in the document -->

<!DOCTYPE html>
<html>
    <link href="admin.css" type="text/css" rel="Stylesheet" />
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <meta charset="utf-8">
    <title>Admin Page</title>
</head>
<?php

        session_start();
        $link=mysqli_connect('localhost', 'root', '', '4007') or die('Failed to connect or select database');
        mysqli_set_charset($link, 'utf8mb4');
    ?>
    
<body>
    <header class="mdc-top-app-bar app-bar">
    <div class="mdc-top-app-bar__row">
        <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
        <i class="material-icons mdc-button__icon" aria-hidden="true">pets</i>
            <button class="mdc-button" style="color: #FFFFFF;">  <span class="mdc-button__ripple"></span><a href="admin_user.php">Record Modification</a></button>
            <button class="mdc-button" style="color: #FFFFFF;">  <span class="mdc-button__ripple"></span><b><a href="admin_data.php">Data Analysis</a></b></button>
        </section>
        <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end">
            <button class="mdc-icon-button">
                    <div class="mdc-icon-button__ripple"></div>
                    <span class="material-icons"></span>
                    <a class="material-icons" href="logout.php">logout</a>
            </button>
        </section>
    </div>
    </header>
    <main class="mdc-top-app-bar--fixed-adjust">
    <div class="content-wrapper">
        <aside class="mdc-drawer mdc-top-app-bar--fixed-adjust">
        <div class="mdc-drawer__header">
            <h3 class="mdc-drawer__title">Mail</h3>
            <h6 class="mdc-drawer__subtitle">email@material.io</h6>
        </div>
            <a id="user-data-analysis" class="mdc-deprecated-list-item">
                <span class="mdc-deprecated-list-item__ripple"></span>
                <i class="material-icons mdc-deprecated-list-item__graphic" aria-hidden="true">folder</i>
                <span class="mdc-deprecated-list-item__text">User Data Analysis</span>
            </a>    
            <a id="website-performance" class="mdc-deprecated-list-item">
                <span class="mdc-deprecated-list-item__ripple"></span>
                <i class="material-icons mdc-deprecated-list-item__graphic" aria-hidden="true">folder</i>
                <span class="mdc-deprecated-list-item__text">Website Performance</span>
            </a>  
            <a id="anomaly-user" class="mdc-deprecated-list-item">
                <span class="mdc-deprecated-list-item__ripple"></span>
                <i class="material-icons mdc-deprecated-list-item__graphic" aria-hidden="true">folder</i>
                <span class="mdc-deprecated-list-item__text">Anomaly User</span>
            </a> 
            <div id="sidebar">

</div>
        </aside>    
    <div class="main-content">
        <div class="box">
        <?php
// 数据库配置
$host = 'localhost'; // 或者其他主机地址
$dbname = '4007'; // 修改为正确的数据库名称，不包含空格
$username = 'root'; // 修改为正确的用户名
$password = ''; // 修改为正确的密码

try {
    // 连接数据库
    $pdo = new PDO("mysql:host=$host;port=3306;dbname=$dbname;charset=utf8mb4", $username, $password);

    // 设置 PDO 错误模式为异常
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 执行性别的 SQL 查询
    $genderSql = "SELECT gender, COUNT(*) as number FROM user GROUP BY gender";
    $genderStmt = $pdo->prepare($genderSql);
    $genderStmt->execute();
    $genderData = $genderStmt->fetchAll(PDO::FETCH_ASSOC);

    // 执行城市的 SQL 查询
    $addressSql = "SELECT address, COUNT(*) as number FROM user GROUP BY address";
    $addressStmt = $pdo->prepare($addressSql);
    $addressStmt->execute();
    $addressData = $addressStmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    $error = array('error' => '数据库连接失败', 'message' => $e->getMessage());
    echo json_encode($error);
    exit();
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        /* ... your existing styles ... */
        .main-content {
            /* ... */
        }
        .hidden {
            display: none;
        }
    </style>
    <!-- ... other head elements ... -->
</head>
<body>



<div class="main-content">
    <div id="user-data-content" class="content-section hidden">
    <?php
// 数据库配置
$host = 'localhost'; // 或者其他主机地址
$dbname = '4007'; // 修改为正确的数据库名称，不包含空格
$username = 'root'; // 修改为正确的用户名
$password = ''; // 修改为正确的密码

try {
    // 连接数据库
    $pdo = new PDO("mysql:host=$host;port=3306;dbname=$dbname;charset=utf8mb4", $username, $password);

    // 设置 PDO 错误模式为异常
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 执行性别的 SQL 查询
    $genderSql = "SELECT gender, COUNT(*) as number FROM user GROUP BY gender";
    $genderStmt = $pdo->prepare($genderSql);
    $genderStmt->execute();
    $genderData = $genderStmt->fetchAll(PDO::FETCH_ASSOC);

    // 执行城市的 SQL 查询
    $addressSql = "SELECT address, COUNT(*) as number FROM user GROUP BY address";
    $addressStmt = $pdo->prepare($addressSql);
    $addressStmt->execute();
    $addressData = $addressStmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    $error = array('error' => '数据库连接失败', 'message' => $e->getMessage());
    echo json_encode($error);
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gender and Address Charts</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="genderChart" width="200" height="200"></canvas>
    <canvas id="AddressChart" width="100" height="100"></canvas>
    <script>
        // 获取从服务器返回的 JSON 数据
        var genderJsonData = <?php echo json_encode($genderData); ?>;
        var addressJsonData = <?php echo json_encode($addressData); ?>;

        // 提取性别和数量数据
        var genderLabels = genderJsonData.map(function(item) {
            return item.gender;
        });
        var genderData = genderJsonData.map(function(item) {
            return item.number;
        });

        // 提取城市和数量数据
        var addressLabels = addressJsonData.map(function(item) {
            return item.address;
        });
        var addressData = addressJsonData.map(function(item) {
            return item.number;
        });

        // 创建性别饼状图
    
        var genderCtx = document.getElementById('genderChart').getContext('2d');
        var genderChart = new Chart(genderCtx, {
            type: 'pie',
            data: {
                labels: genderLabels,
                datasets: [{
                    label: '性别统计',
                    data: genderData,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(153, 102, 255, 0.5)',
                        'rgba(255, 159, 64, 0.5)'
                    ]
                }]
            },
            options: {
                responsive: true
            }
        });

        // 创建城市饼状图
        var addressCtx = document.getElementById('AddressChart').getContext('2d');
        var addressChart = new Chart(addressCtx, {
            type: 'pie',
            data: {
                labels: addressLabels,
                datasets: [{
                    label: '城市统计',
                    data: addressData,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(153, 102, 255, 0.5)',
                        'rgba(255, 159, 64, 0.5)'
                    ]
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>
</body>
</html>
        
    </div>
    <div id="website-performance-content" class="content-section hidden">
        
<?php
// Replace these with your connection details
$host = 'localhost'; // or your database host
$username = 'root'; // your database username
$password = ''; // your database password
$database = '4007'; // your database name, ensure there are no spaces in the database name

// Connect to the database
$conn = new mysqli($host, $username, $password, $database);

// Check for a connection error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get active users data
$activeUsersQuery = "SELECT count FROM active_users_table ORDER BY id ASC"; // replace with your actual query
$activeUserCounts = array();
if ($result = $conn->query($activeUsersQuery)) {
    while ($row = $result->fetch_assoc()) {
        $activeUserCounts[] = $row['count']; // Make sure 'count' is the correct column name
    }
    $result->free();
}

// Query to get new user acquisition data
$newUsersQuery = "SELECT count FROM new_users_table ORDER BY id ASC"; // replace with your actual query
$newUserCounts = array();
if ($result = $conn->query($newUsersQuery)) {
    while ($row = $result->fetch_assoc()) {
        $newUserCounts[] = $row['count']; // Make sure 'count' is the correct column name
    }
    $result->free();
}

// Query to get KPI data
$kpiQuery = "SELECT average_logins, average_time_spent, user_churn_rate FROM kpi_table LIMIT 1"; // replace with your actual query
$averageLogins = $averageTimeSpent = $userChurnRate = 'XX';
if ($result = $conn->query($kpiQuery)) {
    $kpiData = $result->fetch_assoc();
    $averageLogins = $kpiData['average_logins'];
    $averageTimeSpent = $kpiData['average_time_spent'];
    $userChurnRate = $kpiData['user_churn_rate'];
    $result->free();
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Website Performance</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; }
        .dashboard { display: flex; justify-content: space-between; }
        .chart-container { width: 60%; }
        .kpi-container { width: 30%; }
        .kpi { background-color: #f2f2f2; padding: 10px; margin-bottom: 10px; }
        .kpi h3 { margin: 0 0 10px 0; }
        canvas { display: block; max-width: 100%; }
    </style>
</head>
<body>
    <h1>Website Performance</h1>
    <div class="dashboard">
        <div class="chart-container">
            <canvas id="performanceChart"></canvas>
        </div>
        <div class="kpi-container">
            <div class="kpi">
                <h3>Average Logins</h3>
                <p><?php echo htmlspecialchars($kpiData['average_logins'] ?? 'XX'); ?></p>
            </div>
            <div class="kpi">
                <h3>Average Time Spent</h3>
                <p><?php echo htmlspecialchars($kpiData['average_time_spent'] ?? 'XXX'); ?></p>
            </div>
            <div class="kpi">
                <h3>User Churn Rate</h3>
                <p><?php echo htmlspecialchars($kpiData['user_churn_rate'] ?? 'XX'); ?></p>
            </div>
        </div>
    </div>

    <script>
        var activeUserData = <?php echo json_encode($activeUserCounts); ?>;
        var newUserAcquisitionData = <?php echo json_encode($newUserCounts); ?>;
        var labels = ['Q1', 'Q2', 'Q3', 'Q4']; // Replace with actual labels if necessary

        var ctx = document.getElementById('performanceChart').getContext('2d');
        var performanceChart = new Chart(ctx, {
            type: 'line', // Specified line type chart
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Active User',
                        data: activeUserData,
                        borderColor: 'rgb(54, 162, 235)',
                        borderWidth: 2,
                        fill: false,
                        tension: 0.1
                    },
                    {
                        label: 'New User Acquisition',
                        data: newUserAcquisitionData,
                        borderColor: 'rgb(75, 192, 192)',
                        borderWidth: 2,
                        fill: false,
                        tension: 0.1
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });
    </script>
    </div>
    <div id="anomaly-user-content" class="content-section hidden">
    <?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Replace these with your connection details
$host = 'localhost'; // or your database host
$username = 'root'; // your database username
$password = ''; // your database password
$database = '4007'; // your database name, ensure there are no spaces in the database name

// Connect to the database
$conn = new mysqli($host, $username, $password, $database);

// Check for a connection error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get active users data
$anomalyUsersQuery = "SELECT * FROM anomaly_users ORDER BY id ASC"; // replace with your actual query
$anomaly_users = array();
if ($result = $conn->query($anomalyUsersQuery)) { // fix variable name
    while ($row = $result->fetch_assoc()) {
        $anomaly_users[] = $row; // Store the row data in the array
    }
    $result->free();
}
?>


    <title>Anomaly User Reminder</title>
    <style>
        /* Add your existing CSS styles here */
        /* ... other styles ... */

        /* Modal styles */
        .modal {
            /* Modal CSS here */
        }
        .modal-content {
            /* Modal content CSS here */
        }
        .close {
            /* Close button CSS here */
        }
        /* ... other modal styles ... */
    </style>
    <!-- Your header and navigation here -->

    <main>
        <section class="anomaly-users">
            <table>
                <!-- Table headers -->
                <tr>
                    <th>Index</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Species</th>
                    <th>Action</th>
                </tr>
                <!-- Table rows -->
                <?php foreach ($anomaly_users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['index']); ?></td>
                    <td><?php echo htmlspecialchars($user['id']); ?></td>
                    <td><?php echo htmlspecialchars($user['name']); ?></td>
                    <td><?php echo htmlspecialchars($user['gender']); ?></td>
                    <td><?php echo htmlspecialchars($user['species']); ?></td>
                    <td>
                        <button onclick="showModal()">Remind</button>
                        <button>Delete</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </section>
    </main>

    <!-- The Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <p>Do you want to send an email to them?</p>
            <button onclick="closeModal()">Yes</button>
        </div>
    </div>

    <script>
        function showModal() {
            // Get the modal
            var modal = document.getElementById('myModal');
            modal.style.display = "block";
        }

        function closeModal() {
            // Get the modal
            var modal = document.getElementById('myModal');
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            var modal = document.getElementById('myModal');
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
    </div>
</div>

<script>
    document.getElementById('user-data-analysis').addEventListener('click', function() {
        showContent('user-data-content');
    });
    
    document.getElementById('website-performance').addEventListener('click', function() {
        showContent('website-performance-content');
    });
    
    document.getElementById('anomaly-user').addEventListener('click', function() {
        showContent('anomaly-user-content');
    });
    
    function showContent(id) {
        // Hide all content sections
        document.querySelectorAll('.content-section').forEach(function(section) {
            section.classList.add('hidden');
        });
        
        // Show the clicked content section
        document.getElementById(id).classList.remove('hidden');
    }
</script>


</div>
</div>
</body>
</main>
</html>
