<?php
include '../config/connect.php';
date_default_timezone_set("Asia/Bangkok");

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);

    $id_pembeli_query = "SELECT id_pembeli FROM tb_pesanan WHERE id_pesanan = $id";
    $result_id_pembeli = mysqli_query($conn, $id_pembeli_query);

    if ($result_id_pembeli && mysqli_num_rows($result_id_pembeli) > 0) {
        $row = mysqli_fetch_assoc($result_id_pembeli);
        $id_pembeli = $row['id_pembeli'];


        $querydetail = "DELETE FROM tb_detail_pesanan WHERE id_pesanan = $id";
        $result_detail = mysqli_query($conn, $querydetail);


        $querypesanan = "DELETE FROM tb_pesanan WHERE id_pesanan = $id";
        $result_pesanan = mysqli_query($conn, $querypesanan);


        $querypembeli = "DELETE FROM tb_pembeli WHERE id_pembeli = $id_pembeli";
        $result_pembeli = mysqli_query($conn, $querypembeli);


        if ($result_detail && $result_pesanan && $result_pembeli) {
            echo 'success';
        } else {
            echo 'error';
        }
    } else {
        echo 'error';
    }
} else {
    echo 'invalid';
}
