<?php
include '../config/connect.php';
date_default_timezone_set("Asia/Bangkok");

if (isset($_POST['kode'])) {
    $kode = mysqli_real_escape_string($conn, $_POST['kode']); // Amankan input

    $query = mysqli_query($conn, "SELECT tpsn.id_pesanan, tpsn.kode_pesanan, tpsn.id_pembeli, tpsn.total_harga, tpsn.status_pesanan, tpsn.tanggal_pesanan, tb.nama_pembeli FROM tb_pesanan tpsn JOIN tb_pembeli tb ON tpsn.id_pembeli = tb.id_pembeli WHERE tpsn.kode_pesanan = '$kode'");

    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);

        echo "<div><strong>Nama Pembeli:</strong> " . htmlspecialchars($row['nama_pembeli']) . "</div>";
        echo "<div><strong>Tanggal Pesanan:</strong> " . date('d-m-Y H:i:s', strtotime($row['tanggal_pesanan'])) . "</div>";
        echo "<div><strong>Total:</strong> Rp " . number_format($row['total_harga'], 0, ',', '.') . "</div>";
    } else {
        echo "<div class='text-red-600'>Pesanan tidak ditemukan.</div>";
    }
} else {
    echo "<div class='text-red-600'>Kode tidak dikirim.</div>";
}
