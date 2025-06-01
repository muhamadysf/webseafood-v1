<?php
session_start();
header('Content-Type: application/json');
$petugas = $_SESSION['id'];

include '../config/connect.php';
date_default_timezone_set("Asia/Bangkok");


if (isset($_POST['selectedId'])) {

    $catatan = $_POST['catatan'] ?? '';
    $metode = $_POST['metode'] ?? '';
    $keterangan = $_POST['keterangan'] ?? '';
    $id_pesanan = $_POST['selectedId'] ?? 0;
    $status = "Selesai";

    $query = $conn->prepare("UPDATE tb_pesanan SET catatan = ?, metode_bayar = ?, status_pesanan = ?, id_user = ?, keterangan = ? WHERE id_pesanan = ? ");
    $query->bind_param("sssisi", $catatan, $metode, $status, $petugas, $keterangan, $id_pesanan);

    if ($query->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Data pesanan diperbarui']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal update: ' . $conn->error]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'ID tidak diterima']);
}
