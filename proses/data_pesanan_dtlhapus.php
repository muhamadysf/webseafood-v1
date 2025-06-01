<?php
header('Content-Type: application/json');

include '../config/connect.php';
date_default_timezone_set("Asia/Bangkok");

if (isset($_POST['id_detail'])) {
    $id_detail = $_POST['id_detail'];
    $selectedId = $_POST['selectedId'];

    $querySelectId = mysqli_query($conn, "SELECT id_menu, qty FROM tb_detail_pesanan WHERE id_detail = $id_detail");

    if ($querySelectId && mysqli_num_rows($querySelectId) > 0) {

        $row = mysqli_fetch_assoc($querySelectId);
        $id_menu = $row['id_menu'];
        $qty = $row['qty'];
        $jumlah = $qty - 1;


        $queryMenu = mysqli_query($conn, "SELECT harga FROM tb_menu WHERE id_menu = $id_menu");
        $rowMenu = mysqli_fetch_assoc($queryMenu);
        $harga = $rowMenu['harga'];

        $sub_total = $harga * $jumlah;

        if ($qty > 1) {

            $stmt = $conn->prepare("UPDATE tb_detail_pesanan SET qty = ?, sub_total = ? WHERE id_detail = ?");

            if ($stmt === false) {
                die(json_encode(['status' => 'error', 'message' => 'Prepare failed: ' . $conn->error]));
            }

            $stmt->bind_param("iii", $jumlah, $sub_total, $id_detail);
            $stmt->execute();
            $stmt->close();
            // 
        } else {

            $stmt = $conn->prepare("DELETE FROM tb_detail_pesanan WHERE id_detail = ?");

            if ($stmt === false) {
                die(json_encode(['status' => 'error', 'message' => 'Prepare failed: ' . $conn->error]));
            }

            $stmt->bind_param("i", $id_detail);
            $stmt->execute();
            $stmt->close();

            // 
        }

        $queryTotal = mysqli_query($conn, "SELECT SUM(sub_total) AS total_harga FROM tb_detail_pesanan WHERE id_pesanan = $selectedId");

        if ($queryTotal && mysqli_num_rows($queryTotal) > 0) {
            $totalRow = mysqli_fetch_assoc($queryTotal);
            $totalHarga = $totalRow['total_harga'];

            if (is_null($totalHarga) || $totalHarga == 0) {
                $id_pembeli_query = "SELECT id_pembeli FROM tb_pesanan WHERE id_pesanan = $selectedId";
                $result_id_pembeli = mysqli_query($conn, $id_pembeli_query);

                if ($result_id_pembeli && mysqli_num_rows($result_id_pembeli) > 0) {
                    $row = mysqli_fetch_assoc($result_id_pembeli);
                    $id_pembeli = $row['id_pembeli'];

                    $querypesanan = "DELETE FROM tb_pesanan WHERE id_pesanan = $selectedId";
                    $result_pesanan = mysqli_query($conn, $querypesanan);

                    $querypembeli = "DELETE FROM tb_pembeli WHERE id_pembeli = $id_pembeli";
                    $result_pembeli = mysqli_query($conn, $querypembeli);


                    if ($result_pesanan && $result_pembeli) {
                        echo json_encode(['status' => 'hapus', 'message' => 'Data dihapus semua']);
                    } else {
                        echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus pesanan/pembeli']);
                    }
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'ID pembeli tidak ditemukan']);
                }

                return;
                // 
            } else {
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
                // 
            }
            // 
        } else {
            // 
        }
        // 
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Menu tidak ditemukan dalam pesanan']);
    }

    // ==============================================================================================
} else {
    echo json_encode(['status' => 'error', 'message' => 'ID tidak diterima']);
}
