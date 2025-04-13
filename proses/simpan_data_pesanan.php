<?php
header('Content-Type: application/json');


$input = json_decode(file_get_contents('php://input'), true);
$cart = $input['cart'] ?? [];

if (empty($cart)) {
    echo json_encode(["success" => false, "message" => "Cart kosong"]);
    exit;
}

include '../config/connect.php';

mysqli_begin_transaction($conn);

try {

    $queryPembeli = "INSERT INTO tb_pembeli (nama_pembeli, email_pembeli, no_hp) VALUES (?, ?, ?)";

    $queryPesanan = "INSERT INTO tb_pesanan (tanggal_pesanan) VALUES (NOW())";
    if (!mysqli_query($conn, $queryPesanan)) {
        throw new Exception("Gagal insert pesanan: " . mysqli_error($conn));
    }

    $id_pesanan = mysqli_insert_id($conn);

    $stmtItem = mysqli_prepare($conn, "INSERT INTO detail_pesanan (id_pesanan, id_menu, qty) VALUES (?, ?, ?)");
    if (!$stmtItem) {
        throw new Exception("Gagal prepare detail_pesanan: " . mysqli_error($conn));
    }

    foreach ($cart as $item) {
        if (isset($item['id_menu'], $item['qty'])) {
            mysqli_stmt_bind_param($stmtItem, 'iii', $id_pesanan, $item['id_menu'], $item['qty']);
            if (!mysqli_stmt_execute($stmtItem)) {
                throw new Exception("Gagal insert detail: " . mysqli_stmt_error($stmtItem));
            }
        }
    }

    mysqli_commit($conn);
    echo json_encode(["success" => true, "id_pesanan" => $id_pesanan]);
} catch (Exception $e) {
    mysqli_rollback($conn);
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}
