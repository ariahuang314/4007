<?php
header('Access-Control-Allow-Origin:*'); //允许任何来源访问
header("Access-Control-Allow-Headers: Content-Type");

error_reporting(0);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $connection = @mysqli_connect("localhost", "root", "", "4007");

    if (!$connection) {
        die("Fail to connect：" . mysqli_connect_error());
    }
    $data = json_decode(file_get_contents('php://input'), true);
    $answer = $data['answer'];
    $query = "SELECT * FROM recommendation WHERE choice='" . $answer . "'";

    $result = $connection->query($query);

    if ($result->num_rows == 0) {
        $error = ['code' => 201, 'message' => '暂无数据'];
        echo json_encode($error);
        die();
    }

    // 遍历结果并显示图片和链接
    while ($row = $result->fetch_assoc()) {
        $success = ['code' => 200, 'message' => 'success', 'data' => ['pet_rec' => $row['pet_rec'], 'img' => $row['img']]];
        echo json_encode($success);
        die();
    }

}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Pet Recommendation</title>
        <style>
            .container {
                border: 1px solid #ddd;
                border-radius: 10px;
                padding: 20px;
                width: fit-content;
                margin: 0 auto;
            }

            table {
                border-collapse: collapse;
            }

            th, td {
                padding: 10px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }

            td {
            vertical-align: top;
            }

            td label {
                display: inline-flex;
                align-items: center;
                margin-right: 10px;
            }

        </style>

    </head>
    <body>
        <input id="submitBtn" type="submit" value="Back to forum"
            onclick="goBackToOtherPage()">
            <h1 style="text-align: center;">Questionnaire</h1>
            <h2 style="text-align: center;"> Please complete our small questionnaire based on your personal preferences</h2>
        <div id="question" style="display: none;">
            <div class="container">
                <table>

                    <tr>
                        <th>Question</th>
                        <th>Answer</th>
                    </tr>
                    <tr>
                        <td>1. Prefer Cat Or Dog?</td>
                        <td>
                            <input type="radio" name="answer1" value="a">
                            <label for="yes">a. Cat</label>
                            <input type="radio" name="answer1" value="b">
                            <label for="no">b. Dog</label>
                        </td>
                    </tr>
                    <tr>
                        <td>2. Big Or Small cat/dog?</td>
                        <td>
                            <input type="radio" name="answer2" value="a">
                            <label for="yes">a. Big</label>
                            <input type="radio" name="answer2" value="b">
                            <label for="no">b. Small</label>
                        </td>
                    </tr>
                    <tr>
                        <td>3. High Or Low activity level?</td>
                        <td>
                            <input type="radio" name="answer3" value="a">
                            <label for="yes">a. High</label>
                            <input type="radio" name="answer3" value="b">
                            <label for="no">b. Low</label>
                        </td>
                    </tr>
                    <tr>
                        <td>4. Long Or Short hair?</td>
                        <td>
                            <input type="radio" name="answer4" value="a">
                            <label for="yes">a. Long</label>
                            <input type="radio" name="answer4" value="b">
                            <label for="no">b. Short</label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" value="Submit your reply!"
                                onclick="showModal()">
                        </td>
                    </tr>

                </table>
                <div id="modal" style="display: none;">
                    <img id="sImg" src alt="picture"
                        style="max-width: 500px; margin: auto;">
                    <h2 id="hTitle" style="text-align: center;">134</h2>
                </div></div>
        </div>
    </body>
    <script>
 
    window.addEventListener('DOMContentLoaded', function() {
        showQuestionForm();
    });

        function showQuestionForm() {
            document.querySelector('#question').style.display = 'block';
        }
        function goBackToOtherPage() {
        window.location.href = 'forum.php';  // 替换为您要返回的页面的URL
    }
        function showModal() {
            const answer1 = document.querySelector('input[name="answer1"]:checked')?.value??'';
            const answer2 = document.querySelector('input[name="answer2"]:checked')?.value;
            const answer3 = document.querySelector('input[name="answer3"]:checked')?.value;
            const answer4 = document.querySelector('input[name="answer4"]:checked')?.value;
            const answer=answer1+answer2+answer3+answer4;

            if (answer.includes('undefined')) {
            alert('Please reply all questions before submit！');
            return;
            }

             //   发送问卷数据到服务器...
            fetch('question.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                answer: answer,
            }),
            })
            .then(response => response.json())
            .then(data=>{
                if(data.code==200){
                    document.getElementById('sImg').src = data.data.img;
                    document.getElementById('hTitle').textContent =  data.data.pet_rec;

                    document.querySelector('#modal').style.display = 'block';
                }else{
                    document.querySelector('#modal').style.display = 'none';
                    alert(data.message);
                }

            });
        }

     </script>
</html>
