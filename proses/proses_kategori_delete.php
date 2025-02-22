<?php
session_start();

include "../config/connect.php";


if (isset($_POST['btnsubmit'])) {
    $iduser = $_POST['iduser'];

    $query = "SELECT logo_kategori FROM tb_kategori WHERE id_kategori = '$iduser'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $file_path =  $_SERVER['DOCUMENT_ROOT'] . "/webseafood/" .  $row['logo_kategori'];

        $delete = "DELETE FROM tb_kategori WHERE id_kategori = '$iduser'";
        if (mysqli_query($conn, $delete)) {

            if (file_exists($file_path)) {
                unlink($file_path);
            }
            mysqli_close($conn);
            $_SESSION['judul'] = "Berhasil.";
            $_SESSION['message'] = "Data berhasil dihapus !";
            header('location: /webseafood/category');
            exit;
        } else {
            mysqli_close($conn);
            $_SESSION['judul'] = "Gagal.";
            $_SESSION['message'] = "Gagal menghapus data!";
            header("Location: /webseafood/category");
            exit();
        }
    } else {
        mysqli_close($conn);
        $_SESSION['judul'] = "Gagal.";
        $_SESSION['message'] = "Data tidak ditemukan.!";
        header("Location: /webseafood/category");
        exit();
    }
}
