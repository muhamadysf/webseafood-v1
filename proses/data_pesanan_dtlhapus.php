<?php
header('Content-Type: application/json');
include 'koneksi.php';

if (isset($_POST['id_detail'])) {
    $id_detail = $_POST['id_detail'];

    $query = "DELETE FROM detail_pesanan WHERE id_detail = '$id_detail'";
    if (mysqli_query($conn, $query)) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => mysqli_error($conn)]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'ID tidak diterima']);
}
