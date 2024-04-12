<!DOCTYPE html>
<html>
<head>
  <title>Mood page</title>
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
  

  <h1 style="background-color:#8FBC8F;height:50px;">Pet Health Management System</h1>
        <!--Menu-->
        <div id="menu" style="background-color:#8FBC8F;width:200px;height:600px;float:left;">
        <ul class="menuInner">
            <li><a href="0410/pethealth/main.php" >Main Page</a ></li>
            <li><a href="0410/project/forum.php" >Information Forum</a ></li>
            <li><a href="eatPage.php">Diet Tracking</a ></li>
            <li><a href="hydrationPage.php"><b>Hydration Tracking</b></a ></li>
            <li><a href="exercisePage.php">Exercise Tracking</a ></li>
            <li><a href="moodPage.php">Mood Detection</a ></li>
            <li><a href="analysisPage.php">Pet Analysis</a ></li>
        </ul>
        </div>
    <div class="form-container" style="width:500px;height:300px;float:center;margin-left: 220px;">
    <h2>Hydration</h2>
        <form method="post" action="hydrationSubmit.php">
        
        <label for="hydration-times">Hydration Times:</label>&nbsp;
        <input type="number" id="hydration-times" name="hydration-times" required><br><br>


        <label for="hydration-date">Date:</label>
        <input type="date" id="hydration-date" name="hydration-date" required><br><br>

        <!-- <input type="submit" name="submit" value="drank water once"> -->
        <input type="submit" name="submit" value="confirm">
        </form>
    </div>

    <div class="hydration-record-container" style="width:1000px;height:300px;float:center;margin-left: 220px;">
        <h4>Hydration Record History</h4>
        <?php include 'hydration_record.php'; ?>
        </div>

    <script>
      window.addEventListener('DOMContentLoaded', function() {
      var foodDateInput = document.getElementById('hydration-date');
      var today = new Date().toISOString().split('T')[0];
      foodDateInput.value = today;
    });
    </script>

</body>
</html>