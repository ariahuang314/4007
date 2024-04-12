<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap">
    <style>
    body {
			background-image: url('login.png');
			background-repeat: no-repeat;
			background-size: cover;
		}

        table {
            border-collapse: collapse;
            width: 50%;
            margin: 0 auto;
            border-spacing: 0;
        }

        td {
            width: 25%;
            height: 25%;
            border: 1px solid black;
            padding: 10px;
            text-align: center;
            margin: 0; 
        }

        img {
            width: 20%;
            height: auto;
        }

        #header {
    background-color: #87CEEB;
    padding: 10px 0;
    margin-bottom: 5px;
    text-align: center;
}

#header button {
    position: absolute;
    top: 50px;
    left: 90px;
    transform: translate(-50%, -50%);
    width: 150px;
    height: 50px;
}

#header h1 {
    margin-bottom: 0;
    font-size: 36px;
    text-align: center;
}

        #menu {
            background-color: #87CEEB;
            height: 768px;
            width: 200px; /* 调整左侧菜单背景的宽度 */
            float: left;
        }

        .menu-button {
            display: block;
            width: 100%;
            padding: 10px; /* 调整按钮的内边距 */
            margin-bottom: 5px; /* 调整按钮之间的间距 */
            background-color: transparent;
            border-radius: 20px;
            font-size: 18px;
        }

        #content {
            height: 200px;
            width: 400px;
            float: left;
            padding: 0px; /* 调整内容区域的内边距 */
        }
    </style>
</head>
<body>

<div id="header">
    <h1>Pet caring Forum</h1>
    <a href="../pethealth/main.php" >
        <button name="" value="">Back to main</button>
    </a>
</div>

    <div id="menu"style="text-align: center;">
    <hr style="border: none; border-bottom: 3px solid black;margin-top: 0;">
        <b style="font-size: 20px;" >Pet Type</b><br><br>
        <button class="submit-btn" onclick="location.href='forum.php?type=cat'">Cat</button><br>
        <button class="menu-button" onclick="location.href='forum.php?type=dog'">Dog</button><br>
        <button class="menu-button" onclick="location.href='forum.php?type=other'">Other</button><br>
        <a href="question.php"><button name="" value="" class="menu-button">Don't know which to choose? Let us recommend one to you!</button></a>
  
    </div>

    <?php
    error_reporting(0);
    $connection = @mysqli_connect("localhost", "root", "", "4007");

    if (!$connection) {
        die("Fail to connect：" . mysqli_connect_error());
    }

    $type = $_GET['type'];
    if (!isset($type)) {
        $type = 'cat';
    }
    $query = "SELECT * FROM information WHERE type='" . $type . "' ORDER BY RAND() LIMIT 3";

    ?>
    <table>
        <tr>
            <?php

            $result = $connection->query($query);

            if ($result->num_rows == 0) {
                echo "没有找到文章数据。";
                die();
            }

            // 遍历结果并显示图片和链接
            while ($row = $result->fetch_assoc()) {
                echo '<td><a href="' . $row['path'] . '"> <img style="height:240px;width:380px;margin-bottom:0;"  src="' . $row['img'] . '" alt></a>';
                echo '  <h4>' . $row['title'] . '</h4></td>';
            }

            ?>
        </tr>
        <tr>

            <?php

            $result = $connection->query($query);

            if ($result->num_rows == 0) {
                echo "没有找到文章数据。";
                die();
            }

            // 遍历结果并显示图片和链接
            while ($row = $result->fetch_assoc()) {
                echo '<td><a href="' . $row['path'] . '"> <img style="height:240px;width:380px;margin-bottom:0;"  src="' . $row['img'] . '" alt></a>';
                echo '  <h4>' . $row['title'] . '</h4></td>';
            }

           
            mysqli_close($connection);

            ?>
        </tr>
    </table>
</body>

    </body>
</html>
