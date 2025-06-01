<?php
header('Content-Type: application/json');

include '../config/connect.php';
date_default_timezone_set("Asia/Bangkok");

if (isset($_POST['id_menu'])) {
    $id_menu = $_POST['id_menu'];
    $selectedId = $_POST['selectedId'];

    $querySelect = mysqli_query($conn, "SELECT * FROM tb_detail_pesanan WHERE id_pesanan = $selectedId");

    if ($querySelect && mysqli_num_rows($querySelect) > 0) {

        $queryMenu = mysqli_query($conn, "SELECT harga FROM tb_menu WHERE id_menu = $id_menu");
        $row = mysqli_fetch_assoc($queryMenu);
        $harga = $row['harga'];

        $querySelectId = mysqli_query($conn, "SELECT qty FROM tb_detail_pesanan WHERE id_pesanan = $selectedId AND id_menu = $id_menu");

        if ($querySelectId && mysqli_num_rows($querySelectId) > 0) {

            $kolom = mysqli_fetch_assoc($querySelectId);
            $qty = $kolom['qty'];
            $jumlah = $qty + 1;
            $sub_total = $harga * $jumlah;

            $stmt = $conn->prepare("UPDATE tb_detail_pesanan SET qty = ?, sub_total = ? WHERE id_pesanan = ? AND id_menu = ?");

            if ($stmt === false) {
                die(json_encode(['status' => 'error', 'message' => 'Prepare failed: ' . $conn->error]));
            }

            $stmt->bind_param("idii", $jumlah, $sub_total, $selectedId, $id_menu);
            $stmt->execute();
            // 
        } else {
            // 
            $stmt = $conn->prepare("INSERT INTO tb_detail_pesanan (id_pesanan, id_menu, qty, sub_total) VALUES (?, ?, 1, ?)");

            if ($stmt === false) {
                die(json_encode(['status' => 'error', 'message' => 'Prepare failed: ' . $conn->error]));
            }

            $stmt->bind_param("iii", $selectedId, $id_menu, $harga);
            $stmt->execute();
        }

        $queryTotal = mysqli_query($conn, "SELECT SUM(sub_total) AS total_harga FROM tb_detail_pesanan WHERE id_pesanan = $selectedId");
        $totalRow = mysqli_fetch_assoc($queryTotal);
        $totalHarga = $totalRow['total_harga'] ?? 0;
        // ====================================================================================

        $stmt = $conn->prepare("UPDATE tb_pesanan SET total_harga = ? WHERE id_pesanan = ? ");

        if ($stmt === false) {
            die(json_encode(['status' => 'error', 'message' => 'Prepare failed: ' . $conn->error]));
        }

        $stmt->bind_param("ii", $totalHarga, $selectedId);

        if ($stmt->execute()) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Pesanan diperbarui'
            ]);
        } else {
            echo json_encode(['status' => 'error', 'message' => $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Pesanan tidak ditemukan']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'ID tidak diterima']);
}
