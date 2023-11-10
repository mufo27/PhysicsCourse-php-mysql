<?php
require_once('auth.inc.php');
require_once('../../database/condb.inc.php');

$category_id = $_GET['category_id'];

$select_category_sub = $conn->prepare("SELECT id, name FROM manage_category_sub WHERE category_id = ? ORDER BY id ASC");
$select_category_sub->bindParam(1, $category_id);
$select_category_sub->execute();

$json = array();
while ($row_category_sub = $select_category_sub->fetch(PDO::FETCH_ASSOC)) {
    array_push($json, $row_category_sub);
}

echo json_encode($json); 

