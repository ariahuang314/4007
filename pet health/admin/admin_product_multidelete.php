<?php
    $link=mysqli_connect('localhost', 'root', '', '4007') or die('Failed to connect or select database');
    mysqli_set_charset($link, 'utf8mb4');
    if (isset($_POST['check'])) {
        $ids = $_POST['check'];
            
        // 检查ids是否为空
        if (!empty($ids)) {
            $id_list = array();
            foreach ($ids as $id) {
                $id_list[] = "'" . $id . "'";
            }

            $id_string = implode(",", $id_list);

            $sql = "DELETE FROM food WHERE food_no IN ($id_string)";

            $result = mysqli_query($link, $sql);
            if ($result && mysqli_affected_rows($link) > 0) {
                header('Location: admin_product.php');
            } else {
                echo '<script>alert("Deletion failed!")</script>';
            }
        } else {
            echo '<script>alert("No IDs selected!")</script>';
        }
    }else{header('Location: admin_product.php');
    }
?>
