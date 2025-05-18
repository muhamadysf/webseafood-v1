<?php
header('Content-Type: application/json');

include '../config/connect.php';
date_default_timezone_set("Asia/Bangkok");

if (isset($_POST['id_menu'])) {
    $id_menu = $_POST['id_menu'];
    $selectedId = $_POST['selectedId'];

    $queryDel = mysqli_query($conn, "DELETE FROM tb_detail_pesanan WHERE id_detail = '$id_detail'");

    if ($queryDel) {

        $querySelect = mysqli_query($conn, "SELECT SUM(dp.qty * m.harga) AS total_harga FROM tb_detail_pesanan dp
        JOIN tb_menu m ON dp.id_menu = m.id_menu WHERE dp.id_pesanan = '$selectedId'");


        if ($querySelect && mysqli_num_rows($querySelect) > 0) {
            $row = mysqli_fetch_assoc($querySelect);

            if ($row['total_harga'] !== null) {
                $totalHarga = $row['total_harga'];
                $updateQuery = mysqli_query($conn, "UPDATE tb_pesanan SET total_harga = '$totalHarga' WHERE id_pesanan = '$selectedId' ");

                echo json_encode(['status' => 'success', 'total_harga' => $totalHarga]);
            } else {

                mysqli_query($conn, "DELETE FROM tb_pesanan WHERE id_pesanan = '$selectedId'");

                echo json_encode(['status' => 'hapus', 'message' => 'Data dihapus semua']);
            }
        } else {
            mysqli_query($conn, "DELETE FROM tb_pesanan WHERE id_pesanan = '$selectedId'");

            echo json_encode(['status' => 'hapus', 'message' => 'Data dihapus semua']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => mysqli_error($conn)]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'ID tidak diterima']);
}
