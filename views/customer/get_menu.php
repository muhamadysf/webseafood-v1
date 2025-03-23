
<?php
header('Content-Type: application/json');
include "../../config/connect.php";

$mquery = $conn->query("SELECT id_menu, harga FROM tb_menu");
$menu = [];

while ($row = $mquery->fetch_assoc()) {
    $menu[] = $row;
}

echo json_encode($menu);
?>