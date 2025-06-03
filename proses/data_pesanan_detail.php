<?php
header('Content-Type: application/json');

include '../config/connect.php';
date_default_timezone_set("Asia/Bangkok");

if (isset($_POST['selected_id'])) {
    $selected_id = $_POST['selected_id'];

    $query = "SELECT p.*, pb.*,
                dp.id_detail, dp.qty, m.nama_menu, dp.catatan AS catatan_detail, 
                p.catatan AS catatan_pesanan
                FROM tb_pesanan p
                JOIN tb_detail_pesanan dp ON dp.id_pesanan = p.id_pesanan
                JOIN tb_menu m ON dp.id_menu = m.id_menu
                JOIN tb_pembeli pb ON p.id_pembeli = pb.id_pembeli
                WHERE p.id_pesanan = '$selected_id'";

    $result = mysqli_query($conn, $query);
    $items = [];
    $pesanan = null;

    while ($row = mysqli_fetch_assoc($result)) {

        if ($pesanan === null) {

            $pesanan = [
                'id_pesanan' => $selected_id,
                'nama_pembeli' => $row['nama_pembeli'],
                'email_pembeli' => $row['email_pembeli'],
                'no_hp' => $row['no_hp'],
                'jenis_pesanan' => $row['jenis_pesanan'],
                'no_meja' => $row['no_meja'],
                'catatan_pesanan' => $row['catatan_pesanan'],
                'total_harga' => $row['total_harga'],
                'status_pesanan' => $row['status_pesanan'],
                'keterangan' => $row['keterangan'],
                'metode_bayar' => $row['metode_bayar']
            ];
        }

        $items[] = [
            'id_detail' => $row['id_detail'],
            'qty' => $row['qty'],
            'nama_menu' => $row['nama_menu'],
            'catatan_detail' => $row['catatan_detail']
        ];
    }

    echo json_encode([
        'status' => 'success',
        'pesanan' => $pesanan,
        'items' => $items
    ]);
} else {
    echo json_encode(['status' => 'error']);
}
