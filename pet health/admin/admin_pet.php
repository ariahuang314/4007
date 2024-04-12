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
        $sql1 = "SELECT count(*) from pet";
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
        $sql2 = "SELECT * FROM pet LIMIT $start, $num";
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
            <h6 class="mdc-drawer__subtitle">1170296793qq.com</h6>
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
            <a class="mdc-deprecated-list-item mdc-deprecated-list-item--activated" href="admin_pet.php" aria-current="page">
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
                <p>Pet Management</p>
            <div class="bar">
                <form action="admin_pet_search.php" method="post">
                        <!-- Link to search records -->        
                        <select id="search_field" name="search_field" style="margin-right: 10px; height: 26px; padding: 2px;">
                            <option value="pet_no">Pet ID</option>
                            <option value="pet_name">Pet Name</option>
                            <option value="pet_species">Species</option>
                            <option value="pet_category">Category</option>
                            <option value="gender">Gender</option>
                            <option value="date_of_birth">Date of Birth</option>
                            <option value="height">Height</option>
                            <option value="weight">Weight</option>
                            <option value="user_id">User ID</option>
                            <option value="photo">Photo</option>
                            <option value="age">Age</option>
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


    <form action="admin_pet_multidelete.php"method="POST">
<!-- 表格主体 -->
            <div class="mdc-data-table">
            <div class="mdc-data-table__table-container">
                <table class="mdc-data-table__table" aria-label="Dessert calories">
                <thead>
                    <tr class="mdc-data-table__header-row">
                        <th class="mdc-data-table__header-cell" role="columnheader" scope="col">Pet ID</th>
                        <th class="mdc-data-table__header-cell" role="columnheader" scope="col">Pet Name</th>
                        <th class="mdc-data-table__header-cell" role="columnheader" scope="col">Species</th>
                        <th class="mdc-data-table__header-cell" role="columnheader" scope="col">Category</th>
                        <th class="mdc-data-table__header-cell" role="columnheader" scope="col">Gender</th>
                        <th class="mdc-data-table__header-cell" role="columnheader" scope="col">Date of Birth</th>
                        <th class="mdc-data-table__header-cell" role="columnheader" scope="col">Height</th>
                        <th class="mdc-data-table__header-cell" role="columnheader" scope="col">Weight</th>
                        <th class="mdc-data-table__header-cell" role="columnheader" scope="col">User ID</th>
                        <th class="mdc-data-table__header-cell" role="columnheader" scope="col">Photo</th>
                        <th class="mdc-data-table__header-cell" role="columnheader" scope="col">Age</th>
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
                            <td class="mdc-data-table__cell" scope="row">{$row['pet_no']}</td>
                            <td class="mdc-data-table__cell">{$row['pet_name']}</td> 
                            <td class="mdc-data-table__cell">{$row['pet_species']}</td>
                            <td class="mdc-data-table__cell">{$row['pet_category']}</td>
                            <td class="mdc-data-table__cell">{$row['gender']}</td>
                            <td class="mdc-data-table__cell">{$row['date_of_birth']}</td>
                            <td class="mdc-data-table__cell">{$row['height']}</td>
                            <td class="mdc-data-table__cell">{$row['weight']}</td>
                            <td class="mdc-data-table__cell">{$row['user_id']}</td>
                            <td class="mdc-data-table__cell">{$row['photo']}</td>
                            <td class="mdc-data-table__cell">{$row['age']}</td>
                            <td class="mdc-data-table__cell">
                                <a class="material-icons"  onclick="showUpdateDialog('{$row['pet_no']}')">edit</a>
                                <a class="material-icons" onclick="javascript:if(!confirm('Are you sure you want to delete the selected information?')){return false;}" href="admin_pet_delete.php?pet_no={$row['pet_no']}">delete</a>
                            </td>                                                   
                            <td class="mdc-data-table__cell"><input type="checkbox" name="check[]" value="{$row['pet_no']}"></td>           
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
                        <td class="mdc-data-table__cell" scope="row">{$row['pet_no']}</td>
                        <td class="mdc-data-table__cell">{$row['pet_name']}</td> 
                        <td class="mdc-data-table__cell">{$row['pet_species']}</td>
                        <td class="mdc-data-table__cell">{$row['pet_category']}</td>
                        <td class="mdc-data-table__cell">{$row['gender']}</td>
                        <td class="mdc-data-table__cell">{$row['date_of_birth']}</td>
                        <td class="mdc-data-table__cell">{$row['height']}</td>
                        <td class="mdc-data-table__cell">{$row['weight']}</td>
                        <td class="mdc-data-table__cell">{$row['user_id']}</td>
                        <td class="mdc-data-table__cell">{$row['photo']}</td>
                        <td class="mdc-data-table__cell">{$row['age']}</td>
                            <td class="mdc-data-table__cell">
                                <a class="material-icons" onclick="showUpdateDialog({$row['pet_no']})">edit</a>
                                <a class="material-icons" onclick="javascript:if(!confirm('Are you sure you want to delete the selected information?')){return false;}" href="admin_pet_delete.php?pet_no={$row['pet_no']}">delete</a>
                            </td>                                                   
                            <td class="mdc-data-table__cell"><input type="checkbox" name="check[]" value="{$row['pet_no']}"></td>           
                        </tr>
                A;
                        echo $html;
                    }
                }
                ?>
                </tbody>
                    <tr class="mdc-data-table__header-row">
                    <td></td>
                    <td class="mdc-data-table__cell" colspan="11" style="text-align: center;"><!-- Links for navigating to the first, previous, next, and last pages -->
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
            <form id="my-form" method="post" enctype="multipart/form-data">
                <div class="mdc-dialog__content" id="my-dialog-content">
                    <h3>Add New Record</h3>
                    <label for="pet_name">Pet Name:</label>
                    <input type="text" id="pet_name" name="pet_name" required><br>

                    <label>Species:</label>
                    <div class="mdc-form-field">
                        <div class="mdc-radio">
                            <input class="mdc-radio__native-control" type="radio" value="Cat" id="Cat" name="pet_species" checked>
                            <div class="mdc-radio__background">
                                <div class="mdc-radio__outer-circle"></div>
                                <div class="mdc-radio__inner-circle"></div>
                            </div>
                            <div class="mdc-radio__ripple"></div>
                        </div>
                        <label for="Cat">Cat</label>
                        <div class="mdc-radio">
                            <input class="mdc-radio__native-control" type="radio" value="Dog" id="Dog" name="pet_species">
                            <div class="mdc-radio__background">
                                <div class="mdc-radio__outer-circle"></div>
                                <div class="mdc-radio__inner-circle"></div>
                            </div>
                            <div class="mdc-radio__ripple"></div>
                        </div>
                        <label for="Dog">Dog</label>
                    </div><br>

                    <label for="pet_category">Category:</label>
                    <input type="text" id="pet_category" name="pet_category" required><br>

                    <label>Gender:</label>
                    <div class="mdc-form-field">
                        <div class="mdc-radio">
                            <input class="mdc-radio__native-control" type="radio" id="Male" value="Male" name="gender" checked>
                            <div class="mdc-radio__background">
                                <div class="mdc-radio__outer-circle"></div>
                                <div class="mdc-radio__inner-circle"></div>
                            </div>
                            <div class="mdc-radio__ripple"></div>
                        </div>
                        <label for="Male">Male</label>
                        <div class="mdc-radio">
                            <input class="mdc-radio__native-control" type="radio" id="Female" value="Female" name="gender">
                            <div class="mdc-radio__background">
                                <div class="mdc-radio__outer-circle"></div>
                                <div class="mdc-radio__inner-circle"></div>
                            </div>
                            <div class="mdc-radio__ripple"></div>
                        </div>
                        <label for="Female">Female</label>
                    </div><br>

                    <label for="date_of_birth">Date of Birth:</label>
                    <input type="date" id="date_of_birth" name="date_of_birth" required><br>

                    <label for="height">Height:</label>
                    <input type="text" id="height" name="height" required><br>

                    <label for="weight">Weight:</label>
                    <input type="text" id="weight" name="weight" required><br>

                    <label for="user_id">User ID:</label>
                    <input type="text" id="user_id" name="user_id" required><br>

                    <label for="photo">Select Pet Photo:</label>
                    <input type="file" name="photo" id="photo" accept=".jpg, .png" required>
                    <span id="file-name"></span>
                    <button id="upload-btn" type="button" onclick="uploadPhoto()">Upload</button>
                    <br>

                    <label for="age">Age:</label>
                    <input type="text" id="age" name="age" required><br>
                </div>
                <div class="mdc-dialog__actions">
                    <button type="button" class="mdc-button mdc-dialog__button" data-mdc-dialog-action="cancel">
                        <div class="mdc-button__ripple"></div>
                        <span class="mdc-button__label">Cancel</span>
                    </button>
                    <button type="submit" class="mdc-button mdc-dialog__button" name="submit" value="submit" onclick="submitForm()">
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
            <form action="admin_pet_update.php" method="post" enctype="multipart/form-data">
                <div class="mdc-dialog__content" id="my-dialog-content">
                    <h3>Update Record</h3>
                    <label for="u_pet_no">Pet ID:</label>
                    <input type="text" id="u_pet_no" name="u_pet_no" value="<?php echo $petDetails['pet_no']; ?>" readonly><br>

                    <label for="u_pet_name">Pet Name:</label>
                    <input type="text" id="u_pet_name" name="u_pet_name" value="<?php echo $petDetails['pet_name']; ?>" required><br>

                    <label for="u_pet_species">Species:</label>
                    <div class="mdc-select">
                        <select id="u_pet_species" name="u_pet_species">
                            <option value="Cat" id="u_pet_species_c">Cat</option>
                            <option value="Dog"  id="u_pet_species_d">Dog</option>
                        </select>
                        <i class="mdc-select__dropdown-icon"></i>
                    </div><br>

                    <label for="u_pet_category">Category:</label>
                    <input type="u_pet_category" id="u_pet_category" name="u_pet_category" value="<?php echo $petDetails['pet_category']; ?>" required><br>

                    <label for="u_gender">Gender:</label>
                    <div class="mdc-select">
                        <select id="u_gender" name="u_gender">
                            <option value="Male" id="u_gender_m">Male</option>
                            <option value="Female"  id="u_gender_f">Female</option>
                        </select>
                        <i class="mdc-select__dropdown-icon"></i>
                    </div><br>

                    <label for="u_date_of_birth">Date of Birth:</label>
                    <input type="date" id="u_date_of_birth" name="u_date_of_birth" value="<?php echo date('yyyy-MM-dd', strtotime($petDetails['u_date_of_birth'])); ?>" required><br>

                    <label for="u_height">Height:</label>
                    <input type="text" id="u_height" name="u_height" value="<?php echo $petDetails['height']; ?>" required><br>

                    <label for="u_weight">Weight:</label>
                    <input type="text" id="u_weight" name="u_weight" value="<?php echo $petDetails['weight']; ?>" required><br>

                    <label for="u_user_id">User ID:</label>
                    <input type="text" id="u_user_id" name="u_user_id" value="<?php echo $petDetails['user_id']; ?>" required><br>

                    <label for="u_photo">Select File:</label>
                    <input type="file" name="photo" id="u_photo" accept=".jpg, .png">
                    <span id="file-name"></span>
                    <button type="button" onclick="uploadPhoto()">Upload</button><br>

                    <label for="u_age">Age:</label>
                    <input type="text" id="u_age" name="u_age" value="<?php echo $petDetails['age']; ?>" required><br>
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
        function showUpdateDialog(pet_no) {
            // 使用AJAX将pet_no发送到服务器端的PHP文件
            // 创建XMLHttpRequest对象
            var xhr = new XMLHttpRequest();

            // 设置处理响应的回调函数
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // 请求成功
                        var petDetails = JSON.parse(xhr.responseText);
                        // 在这里填充弹窗中的表单字段
                        document.getElementById("u_pet_no").value = petDetails.u_pet_no;
                        document.getElementById("u_pet_name").value = petDetails.u_pet_name;
                        if (petDetails.u_pet_species === 'Cat') {
                            document.getElementById('u_pet_species_c').selected = true; // 选中男性选项
                        } else if (petDetails.u_pet_species === 'Dog') {
                            document.getElementById('u_pet_species_d').selected = true; // 选中女性选项
                        }
                        document.getElementById("u_pet_category").value = petDetails.u_pet_category;
                        if (petDetails.u_gender === 'Male') {
                            document.getElementById('u_gender_m').selected = true; // 选中男性选项
                        } else if (petDetails.u_gender === 'Female') {
                            document.getElementById('u_gender_f').selected = true; // 选中女性选项
                        }
                        document.getElementById("u_date_of_birth").value = petDetails.u_date_of_birth;
                        document.getElementById("u_height").value = petDetails.u_height;
                        document.getElementById("u_weight").value = petDetails.u_weight;
                        document.getElementById("u_user_id").value = petDetails.u_user_id;
                        //document.getElementById("u_photo").value = petDetails.u_photo;
                        var fileName = petDetails.u_photo.split('\\').pop();
                        document.getElementById('file-name').textContent = fileName;
                        document.getElementById("u_age").value = petDetails.u_age;
                        // 显示弹窗
                        update_dialog.open();
                    } else {
                        // 请求失败
                        console.error('AJAX request failed.');
                    }
                }
            };

            // 发送AJAX请求
            xhr.open('GET', 'admin_pet_getdet.php?pet_no=' + pet_no, true);
            xhr.send();
        }

// 全局变量用于存储上传的文件内容
let uploadedPhotoContent = null;

function uploadPhoto() {
  const photoInput = document.getElementById("photo");
  const file = photoInput.files[0];

  if (file) {
    const reader = new FileReader();
    reader.onload = function (e) {
      uploadedPhotoContent = e.target.result; // 将文件内容赋值给 uploadedPhotoContent 变量
      // 上传成功后，设置一个标志或显示上传成功的消息
      console.log("Image Content:", uploadedPhotoContent);
      console.log("Upload successful!");
    };
    reader.readAsDataURL(file);
  }
}

function submitForm() {
  // 检查是否已经上传了文件
  const uploadedPhoto = document.getElementById("photo").files[0];
  if (uploadedPhoto) {
    // 获取其他表单数据
    const pet_name = document.getElementById("pet_name").value;
    const pet_species = document.querySelector('input[name="pet_species"]:checked').value;
    const pet_category = document.getElementById("pet_category").value;
    const gender = document.querySelector('input[name="gender"]:checked').value;
    const date_of_birth = document.getElementById("date_of_birth").value;
    const height = document.getElementById("height").value;
    const weight = document.getElementById("weight").value;
    const user_id = document.getElementById("user_id").value;
    const age = document.getElementById("age").value;

    // 创建一个新的 XMLHttpRequest 对象
    const xhr = new XMLHttpRequest();
    // 设置 POST 请求的 URL
    const url = "admin_pet_add.php"; // 替换为服务器端插入数据的 URL

    // 打开和配置请求
    xhr.open("POST", url, true);

    // 构建包含文件内容和其他表单数据的对象
    const formData = new FormData();
    formData.append("photo", uploadedPhoto);
    formData.append("pet_name", pet_name);
    formData.append("pet_species", pet_species);
    formData.append("pet_category", pet_category);
    formData.append("gender", gender);
    formData.append("date_of_birth", date_of_birth);
    formData.append("height", height);
    formData.append("weight", weight);
    formData.append("user_id", user_id);
    formData.append("age", age);

    // 发送请求并将 formData 作为请求的正文
    xhr.send(formData);
  } else {
    // 如果没有上传文件，可以显示错误消息或采取其他操作
    console.log("No file uploaded!");
  }
}
    </script> 
</body>
</main>
</html>