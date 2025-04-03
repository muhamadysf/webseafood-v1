<?php
include "../config/connect.php";


$ids = isset($_GET['ids']) ? explode(',', $_GET['ids']) : [];

if (empty($ids)) {
    echo json_encode([]);
    exit;
}


$idList = implode(',', array_map('intval', $ids));
$query = "SELECT id_menu, nama_menu, harga FROM tb_menu WHERE id_menu IN ($idList)";
$result = mysqli_query($conn, $query);

$menuData = [];
while ($row = mysqli_fetch_assoc($result)) {
    $menuData[] = $row;
}

echo json_encode($menuData);
