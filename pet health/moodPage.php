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
            <li><a href="0410/pethealth/main.php" >Main Page</a></li>
            <li><a href="0410/project/forum.php" >Information Forum</a></li>
            <li><a href="eatPage.php">Diet Tracking</a></li>
            <li><a href="hydrationPage.php">Hydration Tracking</a></li>
            <li><a href="exercisePage.php">Exercise Tracking</a></li>
            <li><a href="moodPage.php"><b>Mood Detection</b></a></li>
            <li><a href="analysisPage.php">Pet Analysis</a></li>
            <!-- <li><a href="WastePage.php">Waste Management</a></li>
            <li><a href="recordPage.php">Daily record</a></li> -->
        </ul>
        </div>

        <div class="form-container" style="width:500px;height:300px;float:center;margin-left: 220px;">
        <h2>Mood</h2>
        
        <form action="upload.php" method="POST" enctype="multipart/form-data">
        
            <label for="photo">Please upload the pet face here: <br><br></label>
            <input type="file" name="image" accept="image/*" required>
            <br><br>
            <label for="mood-date">Date:</label>
            <input type="date" id="mood-date" name="mood-date" required><br><br>

            <input type="submit" value="Submit">
        </form>
        </div>

        <div class="mood-record-container" style="width:1000px;height:300px;float:center;margin-left: 220px;">
        <h4>Mood Record History</h4>
        <?php include 'mood_record.php'; ?>
        </div>

  <script>
      window.addEventListener('DOMContentLoaded', function() {
      var foodDateInput = document.getElementById('mood-date');
      var today = new Date().toISOString().split('T')[0];
      foodDateInput.value = today;
    });
    </script>
</body>
</html>