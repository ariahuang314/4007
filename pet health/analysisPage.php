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
            <!-- <li><a href="WastePage.php">Waste Management</a></li>
            <li><a href="recordPage.php">Daily record</a></li> -->
        </ul>
    </div>

    <div class="container">
        <form action="" method="post">
            <input type="submit" name="food_analysis" value="Food Analysis">
            <br><br>
            <input type="submit" name="exercise_analysis" value="Exercise Analysis">
            <br><br>
            <input type="submit" name="mood_calendar" value="Mood Calendar">
        </form>
    </div>

    <?php
    if (isset($_POST['food_analysis'])) {
        header("Location: foodAnalysisPage.php");
        exit;
    }

    if (isset($_POST['exercise_analysis'])) {
        header("Location: exerciseAnalysisPage.php");
        exit;
    }

    if (isset($_POST['mood_calendar'])) {
        header("Location: moodCalenderPage.php");
        exit;
    }
    ?>
</body>
</html>