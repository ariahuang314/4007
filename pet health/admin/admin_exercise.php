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
        $sql1 = "SELECT count(*) from exercise";
        $totalresult=mysqli_query($link,$sql1);
        $total=mysqli_fetch_row($totalresult);
        $num = 7;
        $totalpage=ceil($total[0]/$num);//total page number
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
        $start = ($page - 1) * $num;
        $sql2 = "SELECT * FROM exercise LIMIT $start, $num";
        $result = mysqli_query($link, $sql2);
    ?>
    
<body>
    <header class="mdc-top-app-bar app-bar">
    <div class="mdc-top-app-bar__row">
        <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
        <i class="material-icons mdc-button__icon" aria-hidden="true">pets</i>
            <button class="mdc-button" style="color: #FFFFFF;">  <span class="mdc-button__ripple"></span><b><a href="admin_user.php">Record Modification</b></button></a>
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
            <a class="mdc-deprecated-list-item" href="admin_product.php" aria-current="page">
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
            <a class="mdc-deprecated-list-item mdc-deprecated-list-item--activated" href="admin_exercise.php" aria-current="page">
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
                <p>Exercise</p>
            <div class="bar">
                <form action="admin_exercise_search.php" method="post">
                        <!-- Link to search records -->        
                        <select id="search_field" name="search_field" style="margin-right: 10px; height: 26px; padding: 2px;">                            
                            <option value="exercise_record_no">Exercise Record No</option>
                            <option value="user_id">User ID</option>
                            <option value="pet_no">Pet No</option>
                            <option value="exercise_type">Exercise Type</option>
                            <option value="duration">Duration</option>
                            <option value="exercise_date">Exercise Date</option>


                        </select>
                        <input id="search_input" class="bar_input" type="text" name="search_input" placeholder="Type to search..." style="width: 200px; height: 26px; border: 1px solid #ccc; padding: 2px 5px; font-size: 16px;">
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


    <form action="admin_exercise_multidelete.php"method="POST">
<!-- 表格主体 -->
            <div class="mdc-data-table">
            <div class="mdc-data-table__table-container">
                <table class="mdc-data-table__table" aria-label="Dessert calories">
                <thead>
                    <tr class="mdc-data-table__header-row">
                        <th class="mdc-data-table__header-cell" role="columnheader" scope="col">Exercise Record No</th>
                        <th class="mdc-data-table__header-cell" role="columnheader" scope="col">Pet No</th>
                        <th class="mdc-data-table__header-cell" role="columnheader" scope="col">User ID</th>
                        <th class="mdc-data-table__header-cell" role="columnheader" scope="col">Exercise Type</th>
                        <th class="mdc-data-table__header-cell" role="columnheader" scope="col">Duration</th>
                        <th class="mdc-data-table__header-cell" role="columnheader" scope="col">Exercise Date</th>
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
                            <td class="mdc-data-table__cell" scope="row">{$row['exercise_record_no']}</td> 
                            <td class="mdc-data-table__cell">{$row['pet_no']}</td>
                            <td class="mdc-data-table__cell">{$row['user_id']}</td>
                            <td class="mdc-data-table__cell">{$row['exercise_type']}</td>
                            <td class="mdc-data-table__cell">{$row['duration']}</td>
                            <td class="mdc-data-table__cell">{$row['exercise_date']}</td>
                            <td class="mdc-data-table__cell">
                                <a class="material-icons"  onclick="showUpdateDialog('{$row['exercise_record_no']}')">edit</a>
                                <a class="material-icons" onclick="javascript:if(!confirm('Are you sure you want to delete the selected information?')){return false;}" href="admin_exercise_delete.php?exercise_record_no={$row['exercise_record_no']}">delete</a>
                            </td>                                                   
                            <td class="mdc-data-table__cell"><input type="checkbox" name="check[]" value="{$row['exercise_record_no']}"></td>           
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
                            <td class="mdc-data-table__cell" scope="row">{$row['exercise_record_no']}</td> 
                            <td class="mdc-data-table__cell">{$row['pet_no']}</td> 
                            <td class="mdc-data-table__cell">{$row['user_id']}</td>
                            <td class="mdc-data-table__cell">{$row['exercise_type']}</td>
                            <td class="mdc-data-table__cell">{$row['duration']}</td>
                            <td class="mdc-data-table__cell">{$row['exercise_date']}</td>
                            <td class="mdc-data-table__cell">
                                <a class="material-icons" onclick="showUpdateDialog({$row['exercise_record_no']})">edit</a>
                                <a class="material-icons" onclick="javascript:if(!confirm('Are you sure you want to delete the selected information?')){return false;}" href="admin_exercise_delete.php?exercise_record_no={$row['exercise_record_no']}">delete</a>
                            </td>                                                   
                            <td class="mdc-data-table__cell"><input type="checkbox" name="check[]" value="{$row['exercise_record_no']}"></td>           
                        </tr>
                A;
                        echo $html;
                    }
                }
                ?>
                </tbody>
                    <tr class="mdc-data-table__header-row">
                    <td></td>
                    <td class="mdc-data-table__cell" colspan="6" style="text-align: center;"><!-- Links for navigating to the first, previous, next, and last pages -->
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
                        <form action="admin_exercise_add.php" method="post">
                        <div class="mdc-dialog__content" id="my-dialog-content">
                            <h3>Add New Record</h3>
                                <label for="pet_no">Pet No:</label>
                                <input type="pet_no" name="pet_no" id="pet_no" required><br>
                                <label for="user_id">User ID:</label>
                                <input type="user_id" name="user_id" id="user_id" required><br>
                                <label for="exercise_date">Exercise Date:</label>
                                <input type="date" name="exercise_date" id="exercise_date" required><br>
                                <label for="duration">Duration(min):</label>
                                <input type="number" name="duration" id="duration" required><br>
                                <div class="mdc-form-field">
                                <div class="mdc-radio">
                                    <input class="mdc-radio__native-control" value="running" type="radio" id="running" name="exercise_type" checked>
                                    <div class="mdc-radio__background">
                                    <div class="mdc-radio__outer-circle"></div>
                                    <div class="mdc-radio__inner-circle"></div>
                                    </div>
                                    <div class="mdc-radio__ripple"></div>
                                </div>
                                <label for="running">Running</label>
                                <div class="mdc-radio">
                                    <input class="mdc-radio__native-control" value="swimming" type="radio" id="swimming" name="exercise_type">
                                    <div class="mdc-radio__background">
                                    <div class="mdc-radio__outer-circle"></div>
                                    <div class="mdc-radio__inner-circle"></div>
                                    </div>
                                    <div class="mdc-radio__ripple"></div>
                                </div>
                                <label for="swimming">Swimming</label>
                                <div class="mdc-radio">
                                    <input class="mdc-radio__native-control" value="toy" type="radio" id="toy" name="exercise_type">
                                    <div class="mdc-radio__background">
                                    <div class="mdc-radio__outer-circle"></div>
                                    <div class="mdc-radio__inner-circle"></div>
                                    </div>
                                    <div class="mdc-radio__ripple"></div>
                                </div>
                                <label for="toy">Toy</label>
                                </div><br>                           
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
            <form action="admin_exercise_update.php" method="post">
                <div class="mdc-dialog__content" id="my-dialog-content">
                    <h3>Update Record</h3>
                    <label for="u_exercise_record_no">Exercise Record No:</label>
                    <input type="number" id="u_exercise_record_no" name="u_exercise_record_no" value="<?php echo $exerciseDetails['exercise_record_no']; ?>" readonly><br>
                    
                    <label for="u_user_id">User ID:</label>
                    <input type="number" id="u_user_id" name="u_user_id" value="<?php echo $exerciseDetails['user_id']; ?>" readonly><br>

                    <label for="u_pet_no">Pet No:</label>
                    <input type="number" id="u_pet_no" name="u_pet_no" value="<?php echo $exerciseDetails['pet_no']; ?>" required><br>

                    <label for="u_duration">Duration:</label>
                    <input type="number" id="u_duration" name="u_duration" value="<?php echo $exerciseDetails['duration']; ?>" required><br>

                    <label for="u_exercise_date">Exercise Date:</label>
                    <input type="date" id="u_exercise_date" name="u_exercise_date" value="<?php echo $exerciseDetails['exercise_date']; ?>" required><br>

                    <label for="u_exercise_type">Exercise Type:</label>
                    <div class="mdc-select">
                        <select id="u_exercise_type" name="u_exercise_type">
                            <option value="running" id="u_exercise_type_r">Running</option>
                            <option value="swimming"  id="u_exercise_type_s">Swimming</option>
                            <option value="toy" id="u_exercise_type_t">Toy</option>
                        </select>
                        <i class="mdc-select__dropdown-icon"></i>
                    </div><br>

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
        function showUpdateDialog(exercise_record_no) {
            // 使用AJAX将用户ID发送到服务器端的PHP文件
            // 在PHP文件中执行数据库查询以获取用户详细信息
            // 将返回的用户详细信息填充到弹窗中并显示

            // 创建XMLHttpRequest对象
            var xhr = new XMLHttpRequest();

            // 设置处理响应的回调函数
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // 请求成功
                        var exerciseDetails = JSON.parse(xhr.responseText);
                        // 在这里填充弹窗中的表单字段
                        document.getElementById("u_exercise_record_no").value = exerciseDetails.u_exercise_record_no;
                        document.getElementById("u_user_id").value = exerciseDetails.u_user_id;
                        document.getElementById("u_duration").value = exerciseDetails.u_duration;
                        document.getElementById("u_pet_no").value = exerciseDetails.u_pet_no;
                        document.getElementById("u_exercise_date").value = exerciseDetails.u_exercise_date;
                        if (exerciseDetails.u_exercise_type === 'running') {
                            document.getElementById('u_exercise_type_r').selected = true; // 选中
                        } 
                        else if (exerciseDetails.u_exercise_type === 'swimming') {
                            document.getElementById('u_exercise_type_s').selected = true; // 选中
                        }
                        else if (exerciseDetails.u_exercise_type === 'toy') {
                            document.getElementById('u_exercise_type_t').selected = true; // 选中
                        }
                        // 显示弹窗
                        update_dialog.open();
                    } else {
                        // 请求失败
                        console.error('AJAX request failed.');
                    }
                }
            };

            // 发送AJAX请求
            xhr.open('GET', 'admin_exercise_getdet.php?exercise_record_no=' + exercise_record_no, true);
            xhr.send();
        }


    </script> 
</body>
</main>
</html>