<?php
header('Content-Type: application/json');

include '../config/connect.php';
date_default_timezone_set("Asia/Bangkok");

// ambil data dari request (misal dari AJAX POST)
$cart = json_decode(file_get_contents('php://input'), true);

// ambil data dari array
$pemesanan = $cart['pemesanan'];
$info = $cart['info'];
$pelanggan = $cart['pelanggan'];
// $catatan = $cart['catatan'];
$catatan = isset($cart['catatan']) && trim($cart['catatan']) !== "" ? $cart['catatan'] : "-";
$harga_total = $cart['harga_total'];
$nomor_meja = isset($info['nomor_meja']) ? $info['nomor_meja'] : "";

// =============================================================================================================
function generateKodePesanan($conn)
{
    $prefix = "KSF-";
    $today = date("Y-m-d");

    $query = "SELECT COUNT(*) as total FROM tb_pesanan WHERE DATE(tanggal_pesanan) = '$today'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $jumlahPesananHariIni = $row['total'];

    $nomorAntrian = $jumlahPesananHariIni + 1;

    $nomorStr = str_pad($nomorAntrian, 6, "0", STR_PAD_LEFT);
    return $prefix . $nomorStr;
}


// =============================================================================================================

$sql_pembeli = "INSERT INTO tb_pembeli (nama_pembeli, email_pembeli, no_hp, created_at) VALUES (?, ?, ?, NOW())";

$stmtp = $conn->prepare($sql_pembeli);
$stmtp->bind_param(
    "sss",
    $pelanggan['nama'],
    $pelanggan['email'],
    $pelanggan['telepon']
);
$stmtp->execute();

$id_pembeli = $conn->insert_id;

// =============================================================================================================


$kode = generateKodePesanan($conn);

// simpan ke tabel pesanan
$sql_pesanan = "INSERT INTO tb_pesanan (id_pembeli, kode_pesanan, jenis_pesanan, no_meja, total_harga, tanggal_pesanan, catatan, metode_bayar) VALUES (?, ?, ?, ?, ?, NOW(), ?, ?)";

$stmt = $conn->prepare($sql_pesanan);
$stmt->bind_param(
    "issiiss",
    $id_pembeli,
    $kode,
    $info['tipe'],
    $nomor_meja,
    $harga_total,
    $catatan,
    $pelanggan['metode_bayar']
);
$stmt->execute();

$id_pesanan = $conn->insert_id;


// ==============================================================================================

// 1. Ambil semua id_menu dari $pemesanan
$id_menu_list = array_column($pemesanan, 'id_menu');
$id_menu_placeholders = implode(',', array_fill(0, count($id_menu_list), '?'));

// 2. Ambil harga dari tb_menu
$sql = "SELECT id_menu, harga FROM tb_menu WHERE id_menu IN ($id_menu_placeholders)";
$stmt = $conn->prepare($sql);
$stmt->bind_param(str_repeat('i', count($id_menu_list)), ...$id_menu_list);
$stmt->execute();
$result = $stmt->get_result();

$harga_menu = [];
while ($row = $result->fetch_assoc()) {
    $harga_menu[$row['id_menu']] = $row['harga'];
}

// 3. Simpan tiap item ke tb_detail_pesanan dengan sub_total
$sql_detail = "INSERT INTO tb_detail_pesanan (id_pesanan, id_menu, qty, sub_total, catatan) VALUES (?, ?, ?, ?, ?)";
$stmt_detail = $conn->prepare($sql_detail);

foreach ($pemesanan as $item) {
    $id_menu = $item['id_menu'];
    $qty = $item['qty'];
    $catatan = $item['note'];
    $harga = $harga_menu[$id_menu] ?? 0;
    $sub_total = $qty * $harga;

    $stmt_detail->bind_param(
        "iiiis",
        $id_pesanan,
        $id_menu,
        $qty,
        $sub_total,
        $catatan
    );
    $stmt_detail->execute();
}

// ==============================================================================================

// simpan tiap item ke order_detail
// $sql_detail = "INSERT INTO tb_detail_pesanan (id_pesanan, id_menu, qty, sub_total, catatan) VALUES (?, ?, ?, ?, ?)";
// $stmt_detail = $conn->prepare($sql_detail);

// foreach ($pemesanan as $item) {
//     $stmt_detail->bind_param(
//         "iiiis",
//         $id_order,
//         $item['id_menu'],
//         $item['qty'],
//         $item['note']
//     );
//     $stmt_detail->execute();
// }

// respon ke client
echo json_encode(["status" => "success", "kode" => $kode]);
