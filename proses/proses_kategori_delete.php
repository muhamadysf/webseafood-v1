<?php
session_start();

include "../config/connect.php";


if (isset($_POST['iduser'])) {
    $iduser = $_POST['iduser'];

    // Ambil nama file gambar sebelum menghapus data
    $query = "SELECT logo_kategori FROM tb_kategori WHERE id_kategori = '$iduser'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $file_path =  $_SERVER['DOCUMENT_ROOT'] . "/webseafood/" .  $row['logo_kategori']; // Sesuaikan dengan lokasi penyimpanan gambar



        // Hapus data dari database
        $delete = "DELETE FROM tb_kategori WHERE id_kategori = '$iduser'";
        if (mysqli_query($conn, $delete)) {

            // Hapus file jika ada
            echo "Path file: " . $file_path;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            echo "Data dan gambar berhasil dihapus!";
        } else {
            echo "Gagal menghapus data!";
        }
    } else {
        echo "Data tidak ditemukan!";
    }

    mysqli_close($conn);
}
