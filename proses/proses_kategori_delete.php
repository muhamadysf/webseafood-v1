<?php
session_start();

include "../config/connect.php";


if (isset($_POST['btnsubmit'])) {

    mysqli_report(MYSQLI_REPORT_OFF);

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
            header('location: ../admin/category');
            exit;
        } else {

            $error_code = mysqli_errno($conn);
            mysqli_close($conn);

            $_SESSION['judul'] = "Gagal.";
            if ($error_code == 1451) {
                $_SESSION['message'] = "Data tidak bisa dihapus karena masih digunakan dalam menu.";
            } else {
                $_SESSION['message'] = "Gagal menghapus data! Kode error: $error_code";
            }

            header("Location: ../admin/category");
            exit();
        }
    } else {
        mysqli_close($conn);
        $_SESSION['judul'] = "Gagal.";
        $_SESSION['message'] = "Data tidak ditemukan.!";
        header("Location: ../admin/category");
        exit();
    }
}
