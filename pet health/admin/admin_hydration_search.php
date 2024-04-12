<?php
session_start();

// 获取搜索字段和输入值
$searchField = $_POST['search_field'];
$searchInput = $_POST['search_input'];

// 执行 SQL 查询，获取搜索结果
$mysqli = new mysqli('localhost', 'root', '', '4007');
$query = "SELECT * FROM hydration WHERE $searchField LIKE ?";
$stmt = $mysqli->prepare($query);
$searchInput = '%' . $searchInput . '%';
$stmt->bind_param('s', $searchInput);
$stmt->execute();
$result = $stmt->get_result();
$searchResults = array();
while ($row = $result->fetch_assoc()) {
    $searchResults[] = $row;
}

// 存储查询结果
$_SESSION['searchResults'] = $searchResults;

// 重定向回搜索页面
header('Location: admin_hydration.php');
exit();
?>