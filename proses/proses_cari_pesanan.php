<?php
header('Content-Type: application/json');

include '../config/connect.php';
date_default_timezone_set("Asia/Bangkok");


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['kode'])) {
    $kode = mysqli_real_escape_string($conn, $_POST['kode']);

    if ($kode === '') {
        echo json_encode(['status' => 'error', 'message' => 'Kode kosong']);
        exit;
    }

    $query = "SELECT tpsn.id_pesanan, tpsn.kode_pesanan, tpsn.id_pembeli, tpsn.total_harga, tpsn.status_pesanan, tpsn.tanggal_pesanan, tb.nama_pembeli FROM tb_pesanan tpsn JOIN tb_pembeli tb ON tpsn.id_pembeli = tb.id_pembeli WHERE tpsn.kode_pesanan = '$kode'";

    $result = mysqli_query($conn, $query);

    if ($data = mysqli_fetch_assoc($result)) {
        echo json_encode([
            'status' => 'success',
            'id_pesanan' => $data['id_pesanan'],
            'kode_pesanan' => $data['kode_pesanan'],
            'nama_pembeli' => $data['nama_pembeli'],
            'status_pesanan' => $data['status_pesanan'],
            'total_harga' => number_format($data['total_harga'], 0, ',', '.')
        ]);
    } else {
        echo json_encode(['status' => 'not_found']);
    }
} else {
    echo json_encode(['status' => 'invalid_request']);
}

mysqli_close($conn);
