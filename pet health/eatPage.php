<!--进食
喝水
运动
情绪
分析
数据库  DFD file*5（剩下的）
-->
<!-- 报错加提示框，不能完全填表，数据不及时更新 -->
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <title>Pet Management System</title>
	<!-- <link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap">
  <style>
        
    .button-container {
        margin-top: 30px;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        max-width:300px;
    }
    .button-container button {
        float:left
        margin-bottom: 10px;
        width: 85%;
    }
		body {
			background-image: url('0410/pethealth/main.png');
			background-repeat: no-repeat;
			background-size: cover;
		}

    h1 {
        text-align: center;
        margin-bottom: 30px;
        color: black;
        font-size: 2em;
        font-weight: bold;
        background-color: #87CEFA;
        border: 1px solid #ddd;
		}
		form {
			background-color: #F8F8FF;
			border: 1px solid #ddd;
			border-radius: 5px;
			padding: 20px;
			width: 400px;
			margin: 0 auto; */
		}
		label {
			display: block;
			margin-bottom: 10px;
			font-size: 16px;
			color: dark gray;
		} 
    .form-container {
      display: flex;
      flex-direction: column;
      float:left;
      width: 400px;
    }
    .submit-btn{
      float:left
      margin-bottom: 10px;
      width: 85%;
    }

    .common-collocations-container {
      margin-top: 20px;
      max-width: 500px;
    }

    .eating-record-container {
      margin-top: 20px;
      max-width: 500px;
    }


    </style> -->

</head>

<body>

<?php
session_start();
$petNo = 1;
$userId = 1;
$_SESSION['pet-no'] = $petNo;
$_SESSION['user-id'] = $userId;
// $petNo = $_SESSION['pet-no'];
// $userId  = $_SESSION['user-id'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "4007";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("连接数据库失败: " . $conn->connect_error);
}

// 从数据库中获取唯一的brand
$brandOptions = '';
$typeOptions = '';
$nameOptions = '';
$sql = "SELECT DISTINCT food_brand FROM food";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $brand = $row["food_brand"];
    $brandOptions .= '<option value="' . $brand . '">' . $brand . '</option>';
  }
}
$conn->close();
?>

<h1>Welcome to record every detail of your pet!</h1>
		<div class="button-container"style="width:500px;float:left";>
          <button class="submit-btn" onclick="location.href='0410/pethealth/main.php'">Main Page</button><br>
        	<button class="submit-btn" onclick="location.href='0410/project/forum.php'">Information Forum</button><br>
        	<button class="submit-btn" onclick="location.href='eatPage.php'">Diet Tracking</button><br>
        	<button class="submit-btn" onclick="location.href='hydrationPage.php'">Hydration Tracking</button><br>	
        	<button class="submit-btn" onclick="location.href='exercisePage.php'">Exercise Tracking</button><br>
        	<button class="submit-btn" onclick="location.href='moodPage.php'">Mood Detection</button><br>
			<button class="submit-btn" onclick="location.href='analysisPage.php'">Food Analysis</button><br>
    	</div>

    
  <div class="form-container" style="margin-left: 20px;">
    <h2>Food</h2>
    <form id="eatform" action="eatSubmitForm.php" method="post" onsubmit="return validateForm()">

      <label for="food-brand">Food Brand:</label> &nbsp;&nbsp;
      <select id="brandSelect" onchange="getTypes()" required>
        <option value="">Select a brand</option>
        <?php echo $brandOptions; ?>
      </select><br>

      <label for="food-type">Food Type:</label> &nbsp;&nbsp;&nbsp;&nbsp;
      <select id="typeSelect" onchange="getNames()" required>
          <!-- <option value="">Select a type</option> -->
      </select><br>

      <label for="food-name">Food Name:</label> &nbsp;&nbsp;
      <select id="nameSelect" onchange="getFoodNo()" required>
          <!-- <option value="">Select a name</option> -->
      </select><br>

      <input type="hidden" id="food-no" name="food-no">

      <label for="food-amount">Amount(g):</label> &nbsp;&nbsp;&nbsp;
      <input type="number" id="food-amount" name="food-amount" required><br>

      <label for="food-date">Date:</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="date" id="food-date" name="food-date" required><br><br>

      <!-- <label for="food-time">Time:</label>
      <input type="time" id="food-time" name="food-time" required><br><br> -->

      <label for="common-collocation" class="checkbox-label">
        <input type="checkbox" id="common-collocation" name="common-collocation">
        Save as Common Collocation
      </label><br><br>

      <div class="submit-btn">
        <input type="submit" value="Confirm" >
      </div>

    </form>
  </div>

<!-- 在表单下方添加常见组合的表格 -->
<div class="common-collocations-container" style="position: fixed; top: 100px; right: 100px; width: 400px;">
  <h4>Common Collocation</h4>
  <?php include 'common_collocations.php'; ?>
</div><br><br>


<div class="eating-record-container" style="position: fixed; top: 400px; right: 100px; width: 400px;">
  <h4>Eating Record History</h4>
  <?php include 'eating_record.php'; ?>
</div>

  <script>
    // 获取类型列表
    function getTypes() {
        var brandSelect = document.getElementById("brandSelect");
        var typeSelect = document.getElementById("typeSelect");
        var nameSelect = document.getElementById("nameSelect");
        var foodAmount = document.getElementById("food-amount");

        // 清空类型下拉框
        typeSelect.innerHTML = "<option value=''>Select a type<</option>";
        nameSelect.innerHTML = "<option value=''>Select a name</option>";

        // 发送AJAX请求，获取属于选中品牌的不重复类型列表
        var brand = brandSelect.value;
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var types = JSON.parse(xhr.responseText);

                // 生成类型选项
                for (var i = 0; i < types.length; i++) {
                    var option = document.createElement("option");
                    option.value = types[i];
                    option.text = types[i];
                    typeSelect.appendChild(option);
                }
            }
        };
        xhr.open("GET", "getTypes.php?brand=" + brand, true);
        xhr.send();
    }

    // 获取名称列表
    function getNames() {
        var brandSelect = document.getElementById("brandSelect");
        var typeSelect = document.getElementById("typeSelect");
        var nameSelect = document.getElementById("nameSelect");

        // 清空名称下拉框
        nameSelect.innerHTML = "<option value=''>Select a name</option>";

        // 发送AJAX请求，获取符合品牌和类型条件的名称列表
        var brand = brandSelect.value;
        var type = typeSelect.value;
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var names = JSON.parse(xhr.responseText);

                // 生成名称选项
                for (var i = 0; i < names.length; i++) {
                    var option = document.createElement("option");
                    option.value = names[i];
                    option.text = names[i];
                    nameSelect.appendChild(option);
                }
            }
        };
        xhr.open("GET", "getNames.php?brand=" + brand + "&type=" + type, true);
        xhr.send();
    }

    // 获取食物编号
    function getFoodNo() {
      var brandSelect = document.getElementById("brandSelect");
      var typeSelect = document.getElementById("typeSelect");
      var nameSelect = document.getElementById("nameSelect");
      var foodNoInput = document.getElementById("food-no");

      var brand = brandSelect.value;
      var type = typeSelect.value;
      var name = nameSelect.value;
      // 发送AJAX请求，获取食物编号
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
              var foodNo = xhr.responseText;
              foodNoInput.value = foodNo;
          }
      };
      xhr.open("GET", "getFoodNo.php?brand=" + brand + "&type=" + type + "&name=" + name, true);
      xhr.send();
    }

    //default date
    window.addEventListener('DOMContentLoaded', function() {
      var foodDateInput = document.getElementById('food-date');
      var today = new Date().toISOString().split('T')[0];
      foodDateInput.value = today;
    });

    //表单验证
    function validateForm() {
    var brandSelect = document.getElementById("brandSelect");
    var typeSelect = document.getElementById("typeSelect");
    var nameSelect = document.getElementById("nameSelect");
    var amountInput = document.getElementById("food-amount");
    var dateInput = document.getElementById("food-date");

    if (
        brandSelect.value === "Select a brand" ||
        typeSelect.value === "Select a type" ||
        nameSelect.value === "Select a name" ||
        amountInput.value === "" ||
        dateInput.value === ""
    ) {
        alert("请填写完整的信息");
        return false; // 阻止表单提交
    }
    return true; // 允许表单提交

    }
    function fillForm(brand, type, name, eatingAmount) {
      document.getElementById('brandSelect').value = brand;
      getTypes(); // 触发获取类型的函数

      setTimeout(function() {
        document.getElementById('typeSelect').value = type;
        getNames(); // 触发获取名称的函数
      }, 50); // 延迟1秒，以确保类型选项已加载

      setTimeout(function() {
        document.getElementById('nameSelect').value = name;
        getFoodNo(); // 触发获取食物编号的函数
      }, 100); // 延迟2秒，以确保名称选项已加载
      document.getElementById('food-amount').value = eatingAmount

    }
  </script>
</body>
</html>