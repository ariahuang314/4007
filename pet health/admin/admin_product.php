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
        $page=$_GET["page"]??1;//get the page number
        $sql1 = "SELECT count(*) from food";
        $totalresult=mysqli_query($link,$sql1);
        $total=mysqli_fetch_row($totalresult);
        $num = 7;
        $totalpage=ceil($total[0]/$num);//total page number
        if($page>$totalpage)
        {
            $page=$totalpage;
        }
        if($page<1)
        {
            $page=1;
        }
        $start = ($page - 1) * $num;
        $sql2 = "SELECT * FROM food LIMIT $start, $num";
        $result = mysqli_query($link, $sql2);
    ?>
    
<body>
    <header class="mdc-top-app-bar app-bar">
    <div class="mdc-top-app-bar__row">
        <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
        <i class="material-icons mdc-button__icon" aria-hidden="true">pets</i>
            <a href="admin_user.php"><button class="mdc-button" style="color: #FFFFFF;">  <span class="mdc-button__ripple"></span><b>Record Modification</b></button></a>
            <a href="admin_data.php"><button class="mdc-button" style="color: #FFFFFF;">  <span class="mdc-button__ripple"></span>Data Analysis</button></a>
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
        <div class="mdc-drawer__content">
            <hr class="mdc-deprecated-list-divider">
            <div class="mdc-deprecated-list">
            <a class="mdc-deprecated-list-item" href="admin_user.php" aria-current="page">
                <span class="mdc-deprecated-list-item__ripple"></span>
                <i class="material-icons mdc-deprecated-list-item__graphic" aria-hidden="true">person</i>
                <span class="mdc-deprecated-list-item__text">User Management</span>
            </a>
            <a class="mdc-deprecated-list-item mdc-deprecated-list-item--activated" href="admin_product.php" aria-current="page">
                <span class="mdc-deprecated-list-item__ripple"></span>
                <i class="material-icons mdc-deprecated-list-item__graphic" aria-hidden="true">category</i>
                <span class="mdc-deprecated-list-item__text">Product</span>
            </a>
            <a class="mdc-deprecated-list-item" href="admin_pet.php" aria-current="page">
                <span class="mdc-deprecated-list-item__ripple"></span>
                <i class="material-icons mdc-deprecated-list-item__graphic" aria-hidden="true">catching_pokemon</i>
                <span class="mdc-deprecated-list-item__text">Pet</span>
            </a>            
            <h6 class="mdc-deprecated-list-group__subheader">Record Management</h6>
            <hr class="mdc-deprecated-list-divider">
            <a class="mdc-deprecated-list-item" href="admin_eating.php" aria-current="page">
                <span class="mdc-deprecated-list-item__ripple"></span>
                <i class="material-icons mdc-deprecated-list-item__graphic" aria-hidden="true">folder</i>
                <span class="mdc-deprecated-list-item__text">Eating</span>
            </a>
            <a class="mdc-deprecated-list-item" href="admin_hydration.php" aria-current="page">
                <span class="mdc-deprecated-list-item__ripple"></span>
                <i class="material-icons mdc-deprecated-list-item__graphic" aria-hidden="true">folder</i>
                <span class="mdc-deprecated-list-item__text">Hydration</span>
            </a>
            <a class="mdc-deprecated-list-item" href="admin_exercise.php" aria-current="page">
                <span class="mdc-deprecated-list-item__ripple"></span>
                <i class="material-icons mdc-deprecated-list-item__graphic" aria-hidden="true">folder</i>
                <span class="mdc-deprecated-list-item__text">Exercise</span>
            </a>
            <a class="mdc-deprecated-list-item" href="admin_mood.php">
                <span class="mdc-deprecated-list-item__ripple"></span>
                <i class="material-icons mdc-deprecated-list-item__graphic" aria-hidden="true">folder</i>
                <span class="mdc-deprecated-list-item__text">Mood</span>
            </a>
        </div>
        </aside>    
    <div class="main-content">
        <div class="box">
            <div><!-- Search form with dropdown menu and input field -->
                <p>Product Management</p>
            <div class="bar">
                <form action="admin_product_search.php" method="post">
                        <!-- Link to search records -->        
                        <select id="search_field" name="search_field" style="margin-right: 10px; height: 26px; padding: 2px;">
                            <option value="food_no">Food ID</option>
                            <option value="food_brand">Food Brand</option>
                            <option value="food_type">Food Type</option>
                            <option value="food_name">Food Name</option>
                            <option value="calories_100g">Calories</option>
                            <option value="fat">Fat</option>
                            <option value="protein">Protein</option>
                        </select>
                        <input id="search_input" class="bar_input" type="text" name="search_input" placeholder="Type to search..." style="width: 300px; height: 26px; border: 1px solid #ccc; padding: 2px 5px; font-size: 16px;">
                        <button id="search_btn" class="mdc-icon-button" name="search_btn">
                            <div class="mdc-icon-button__ripple"></div>
                            <span class="mdc-icon-button__focus-ring"></span>
                            <i class="material-icons">search</i>
                        </button>
                </form>
                
                <!-- Link to insert a new record -->
                <button class="mdc-button mdc-button--raised mdc-button--leading" onclick="showDialog()">
                    <span class="mdc-button__ripple"></span>
                    <i class="material-icons mdc-button__icon" href="package_insert.php" aria-hidden="true">add</i>
                    <span class="mdc-button__label">New Record</span>
                </button>


            </div>


    <form action="admin_product_multidelete.php"method="POST">
<!-- 表格主体 -->
            <div class="mdc-data-table">
            <div class="mdc-data-table__table-container">
                <table class="mdc-data-table__table" aria-label="Dessert calories">
                <thead>
                    <tr class="mdc-data-table__header-row">
                        <th class="mdc-data-table__header-cell" role="columnheader" scope="col">Food ID</th>
                        <th class="mdc-data-table__header-cell" role="columnheader" scope="col">Food Brand</th>
                        <th class="mdc-data-table__header-cell" role="columnheader" scope="col">Food Type</th>
                        <th class="mdc-data-table__header-cell" role="columnheader" scope="col">Food Name</th>
                        <th class="mdc-data-table__header-cell" role="columnheader" scope="col">Calories</th>
                        <th class="mdc-data-table__header-cell" role="columnheader" scope="col">Fat</th>
                        <th class="mdc-data-table__header-cell" role="columnheader" scope="col">Protein</th>
                        <th class="mdc-data-table__header-cell" role="columnheader" scope="col">Action</th>
                        <th class="mdc-data-table__header-cell" role="columnheader" scope="col"><input type="checkbox" id="allChecks"name="allChecks" onclick="ckAll()">Select all</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                <?php
                // 检查是否存在查询结果
                if (isset($_SESSION['searchResults'])) {
                    $searchResults = $_SESSION['searchResults'];
                    $totalpage=ceil(count($searchResults)/$num);//total page number
                    if($totalpage<1)
                    {
                        $totalpage=1;
                    }
                    if($page>$totalpage)
                    {
                        $page=$totalpage;
                    }
                    if($page<1)
                    {
                        $page=1;
                    }
                    // 计算要遍历的范围
                    $start = ($page - 1) * $num;
                    $end = $start + $num;

                    // 获取子集
                    $subset = array_slice($searchResults, $start, $num);
                    // 遍历搜索结果并显示
                    foreach ($subset as $row) {
                        $html = <<<A
                        <tr class="mdc-data-table__row">
                            <td class="mdc-data-table__cell" scope="row">{$row['food_no']}</td>
                            <td class="mdc-data-table__cell">{$row['food_brand']}</td> 
                            <td class="mdc-data-table__cell">{$row['food_type']}</td>
                            <td class="mdc-data-table__cell">{$row['food_name']}</td>
                            <td class="mdc-data-table__cell">{$row['calories_100g']}</td>
                            <td class="mdc-data-table__cell">{$row['fat']}</td>
                            <td class="mdc-data-table__cell">{$row['protein']}</td>
                            <td class="mdc-data-table__cell">
                                <a class="material-icons"  onclick="showUpdateDialog('{$row['food_no']}')">edit</a>
                                <a class="material-icons" onclick="javascript:if(!confirm('Are you sure you want to delete the selected information?')){return false;}" href="admin_product_delete.php?food_no={$row['food_no']}">delete</a>
                            </td>                                                   
                            <td class="mdc-data-table__cell"><input type="checkbox" name="check[]" value="{$row['food_no']}"></td>           
                        </tr>
                A;
                        echo $html;
                    }
                    unset($_SESSION['searchResults']);    
                } else {
                    mysqli_data_seek($result, 0); // 重置结果集的指针到第一行
                    while ($row = mysqli_fetch_assoc($result)) {
                        $html = <<<A
                        <tr class="mdc-data-table__row">
                            <td class="mdc-data-table__cell" scope="row">{$row['food_no']}</td>
                            <td class="mdc-data-table__cell">{$row['food_brand']}</td> 
                            <td class="mdc-data-table__cell">{$row['food_type']}</td>
                            <td class="mdc-data-table__cell">{$row['food_name']}</td>
                            <td class="mdc-data-table__cell">{$row['calories_100g']}</td>
                            <td class="mdc-data-table__cell">{$row['fat']}</td>
                            <td class="mdc-data-table__cell">{$row['protein']}</td>
                            <td class="mdc-data-table__cell">
                                <a class="material-icons" onclick="showUpdateDialog({$row['food_no']})">edit</a>
                                <a class="material-icons" onclick="javascript:if(!confirm('Are you sure you want to delete the selected information?')){return false;}" href="admin_product_delete.php?food_no={$row['food_no']}">delete</a>
                            </td>                                                   
                            <td class="mdc-data-table__cell"><input type="checkbox" name="check[]" value="{$row['food_no']}"></td>           
                        </tr>
                A;
                        echo $html;
                    }
                }
                ?>
                </tbody>
                    <tr class="mdc-data-table__header-row">
                    <td></td>
                    <td class="mdc-data-table__cell" colspan="7" style="text-align: center;"><!-- Links for navigating to the first, previous, next, and last pages -->
                        <button class="mdc-icon-button">
                            <div class="mdc-icon-button__ripple"></div>
                            <span class="mdc-icon-button__focus-ring"></span>
                            <a class="material-icons" href="?page=1">first_page</a>
                        </button>
                        <button class="mdc-icon-button">
                            <div class="mdc-icon-button__ripple"></div>
                            <span class="mdc-icon-button__focus-ring"></span>
                            <a class="material-icons" href="?page=<?php echo $page-1?>">arrow_back_ios</a>
                        </button>
                        <?php echo $page; echo'/'; echo $totalpage?>
                        <button class="mdc-icon-button">
                            <div class="mdc-icon-button__ripple"></div>
                            <span class="mdc-icon-button__focus-ring"></span>
                            <a class="material-icons" href="?page=<?php echo $page+1?>">arrow_forward_ios</a>
                        </button>
                        <button class="mdc-icon-button">
                            <div class="mdc-icon-button__ripple"></div>
                            <span class="mdc-icon-button__focus-ring"></span>
                            <a class="material-icons" href="?page=<?php echo $totalpage?>">last_page</a>
                        </button>
                        
                    </td>
                    <!-- Button for deleting selected records -->
                    <td class="mdc-data-table__cell">
                        <input class="mdc-button mdc-button--raised" onclick = "javascript:if(!confirm('Are you sure you want to delete the selected information?')){return false;}"
                        type="submit"value="Delete selected">                        
                    </td>                  
                    </tr>
                </table>
                </form>
            </div>
        </div>
        </div>
        </div>
    </div>
</div>
</div>
            <!-- 新记录弹窗 -->
            <div id="dialog" class="mdc-dialog">
                <div class="mdc-dialog__container">
                    <div class="mdc-dialog__surface"
                        role="alertdialog"
                        aria-modal="true"
                        aria-labelledby="my-dialog-title"
                        aria-describedby="my-dialog-content">
                        <form action="admin_product_add.php" method="post">
                        <div class="mdc-dialog__content" id="my-dialog-content">
                            <h3>Add New Record</h3>
                                <label for="food_brand">Food Brand:</label>
                                <input type="food_brand" name="food_brand" id="food_brand" required><br>
                                
                                <label for="food_type">Food Type:</label>
                                <input type="food_type" name="food_type" id="food_type" required><br>

                                <label for="food_name">Food Name:</label>
                                <input type="food_name" name="food_name" id="food_name" required><br>

                                <label for="calories_100g">Calories</label>
                                <input type="calories_100g" name="calories_100g" id="calories_100g" required><br>

                                <label for="fat">Fat:</label>
                                <input type="fat" name="fat" id="fat" required><br>  
                                
                                <label for="protein">Protein:</label>
                                <input type="protein" name="protein" id="protein" required><br>
                        </div>
                                <div class="mdc-dialog__actions">
                                    <button type="button" class="mdc-button mdc-dialog__button" data-mdc-dialog-action="cancel">
                                        <div class="mdc-button__ripple"></div>
                                        <span class="mdc-button__label">Cancel</span>
                                    </button>
                                    <button type="submit" class="mdc-button mdc-dialog__button" name="submit" value="submit">
                                        <div class="mdc-button__ripple"></div>
                                        <span class="mdc-button__label">Submit</span>
                                    </button>
                                </div>
                        </form>
                    </div>
                </div>
                    <div class="mdc-dialog__scrim"></div>
            </div>
<!-- 更新弹窗 -->
<div id="update_dialog" class="mdc-dialog">
    <div class="mdc-dialog__container">
        <div class="mdc-dialog__surface"
            role="alertdialog"
            aria-modal="true"
            aria-labelledby="my-dialog-title"
            aria-describedby="my-dialog-content">
            <form action="admin_product_update.php" method="post">
                <div class="mdc-dialog__content" id="my-dialog-content">
                    <h3>Update Record</h3>
                    <label for="u_food_no">Food ID:</label>
                    <input type="text" id="u_food_no" name="u_food_no" value="<?php echo $productDetails['food_no']; ?>" readonly><br>

                    <label for="u_food_brand">Food Brand:</label>
                    <input type="text" id="u_food_brand" name="u_food_brand" value="<?php echo $productDetails['food_brand']; ?>" required><br>

                    <label for="u_food_type">Food Type:</label>
                    <input type="food_type" id="u_food_type" name="u_food_type" value="<?php echo $productDetails['food_type']; ?>" required><br>

                    <label for="u_food_name">Food:</label>
                    <input type="food_name" id="u_food_name" name="u_food_name" value="<?php echo $productDetails['food_name']; ?>" required><br>

                    <label for="u_calories_100g">Calories:</label>
                    <input type="text" id="u_calories_100g" name="u_calories_100g" value="<?php echo $productDetails['calories_100g']; ?>" required><br>

                    <label for="u_fat">Fat:</label>
                    <input type="text" id="u_fat" name="u_fat" value="<?php echo $productDetails['fat']; ?>" required><br>

                    <label for="u_protein">Protein:</label>
                    <input type="text" id="u_protein" name="u_protein" value="<?php echo $productDetails['protein']; ?>" required><br>
                </div>
                <div class="mdc-dialog__actions">
                    <button type="button" class="mdc-button mdc-dialog__button" data-mdc-dialog-action="cancel">
                        <div class="mdc-button__ripple"></div>
                        <span class="mdc-button__label">Cancel</span>
                    </button>
                    <button type="submit" class="mdc-button mdc-dialog__button" name="submit">
                        <div class="mdc-button__ripple"></div>
                        <span class="mdc-button__label">Submit</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="mdc-dialog__scrim"></div>
</div>
    <script>
        function ckAll()
        {
            var cks=document.getElementsByName("check[]");//Get the object of all of the selected records
            var flag=document.getElementById("allChecks").checked; //Get the current state of all of the selected records
            for(var i=0;i<cks.length;i++)
            {
                cks[i].checked = flag;
            }
        }  

        const dialog = new mdc.dialog.MDCDialog(document.getElementById('dialog'));
        function showDialog() {
            // 显示弹窗
            dialog.open();
        }

        const update_dialog = new mdc.dialog.MDCDialog(document.getElementById('update_dialog'));
        function showUpdateDialog(food_no) {
            // 使用AJAX将food_no发送到服务器端的PHP文件
            // 创建XMLHttpRequest对象
            var xhr = new XMLHttpRequest();

            // 设置处理响应的回调函数
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // 请求成功
                        console.log(xhr.responseText); // 输出响应文本内容到控制台
                        var productDetails = JSON.parse(xhr.responseText);
                        // 在这里填充弹窗中的表单字段
                        document.getElementById("u_food_no").value = productDetails.u_food_no;
                        document.getElementById("u_food_brand").value = productDetails.u_food_brand;
                        document.getElementById("u_food_type").value = productDetails.u_food_type;
                        document.getElementById("u_food_name").value = productDetails.u_food_name;
                        document.getElementById("u_calories_100g").value = productDetails.u_calories_100g;
                        document.getElementById("u_fat").value = productDetails.u_fat;
                        document.getElementById("u_protein").value = productDetails.u_protein;
                        // 显示弹窗
                        update_dialog.open();
                    } else {
                        // 请求失败
                        console.error('AJAX request failed.');
                    }
                }
            };

            // 发送AJAX请求
            xhr.open('GET', 'admin_product_getdet.php?food_no=' + food_no, true);
            xhr.send();
        }


    </script> 
</body>
</main>
</html>