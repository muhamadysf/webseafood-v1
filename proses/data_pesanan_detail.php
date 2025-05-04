<?php
header('Content-Type: application/json');

include '../config/connect.php';
date_default_timezone_set("Asia/Bangkok");

if (isset($_POST['selected_id'])) {
    $selected_id = $_POST['selected_id'];

    $query = "SELECT dp.id_detail, dp.qty, m.nama_menu, dp.catatan 
                FROM tb_detail_pesanan dp
                JOIN tb_menu m ON dp.id_menu = m.id_menu
                WHERE dp.id_pesanan = '$selected_id'";

    $result = mysqli_query($conn, $query);
    $data = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = [
            'id_detail' => $row['id_detail'],
            'qty' => $row['qty'],
            'nama_menu' => $row['nama_menu'],
            'catatan' => $row['catatan']
        ];
    }

    echo json_encode([
        'status' => 'success',
        'items' => $data
    ]);
} else {
    echo json_encode(['status' => 'error']);
}
