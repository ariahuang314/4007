<!--
运动
数据库
-->
<!-- 报错加提示框，不能完全填表，数据不及时更新 -->
<!DOCTYPE html>
<html>
<head>
  <title>Pet Health Management</title>
  <style>
  </style>

<style>
        table {
            border-collapse: collapse;
            /* width: 100%; */
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

<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "4007";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("连接数据库失败: " . $conn->connect_error);
}

$petNo = $_SESSION['pet-no'];
$userId = $_SESSION['user-id'];


$conn->close();
?>


  <h1 style="background-color:#8FBC8F;height:50px;">Pet Health Management System</h1>
  <!--Menu-->
  <div id="menu" style="background-color:#8FBC8F;width:200px;height:600px;float:left;">
    <ul class="menuInner">
    <li><a href="0410/pethealth/main.php" >Main Page</a></li>
      <li><a href="0410/project/forum.php" >Information Forum</a></li>
      <li><a href="eatPage.php">Diet Tracking</a></li>
      <li><a href="hydrationPage.php">Hydration Tracking</a></li>
      <li><a href="exercisePage.php"><b>Exercise Tracking</b></a></li>
      <li><a href="moodPage.php">Mood Detection</a></li>
      <li><a href="analysisPage.php">Pet Analysis</a></li>
      <!-- <li><a href="WastePage.php">Waste Management</a></li>
      <li><a href="recordPage.php">Daily record</a></li> -->
    </ul>
  </div>

    
  <div class="form-container" style="width:500px;height:300px;float:center;">
    <h2>Exercise</h2>
    <form id="exerciseform" action="exerciseSubmitForm.php" method="post">

      <label for="exercise-type">Exercise Type:</label>
      <select name="exercise-type" id="exercise-type">
            <option value="running">Running</option>
            <option value="swimming">Swimming</option>
            <option value="toy">Play with toy</option>
        </select><br><br>

      <label for="duration">Time(min):</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="number" id="duration" name="duration" required><br><br>

      <label for="exercise-date">Date:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="date" id="exercise-date" name="exercise-date" required><br><br>

      <br><br>

      <div class="submit-btn">
        <input type="submit" value="Confirm" >
      </div>

    </form>
  </div>

  <div class="exercise-record-container" style="width:1000px;height:300px;float:center;margin-left: 220px;">
      <h4>Exercise Record History</h4>
      <?php include 'exercise_record.php'; ?>
  </div>
  
  <script>
      window.addEventListener('DOMContentLoaded', function() {
      var foodDateInput = document.getElementById('exercise-date');
      var today = new Date().toISOString().split('T')[0];
      foodDateInput.value = today;
    });
    </script>


</body>
</html>