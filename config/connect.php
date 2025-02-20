<?php
$conn = mysqli_connect("localhost", "root", "", "db_kingseafood");

if (!$conn) {
    error_log("Gagal koneksi: " . mysqli_connect_error()); // Catat error di log server
    die("Terjadi kesalahan pada server. Silakan coba lagi nanti."); // Pesan user-friendly
}
?>
