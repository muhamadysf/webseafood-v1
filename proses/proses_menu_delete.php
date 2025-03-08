<?php
session_start();

include "../config/connect.php";


if (isset($_POST['btnSubmit'])) {
    $idmenu = $_POST['id'];

    $query = "SELECT gambar_menu FROM tb_menu WHERE id_menu = '$idmenu'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $file_path =  $_SERVER['DOCUMENT_ROOT'] . "/webseafood/" .  $row['gambar_menu'];

        $delete = "DELETE FROM tb_menu WHERE id_menu = '$idmenu'";
        if (mysqli_query($conn, $delete)) {

            if (file_exists($file_path)) {
                unlink($file_path);
            }
            mysqli_close($conn);
            $_SESSION['judul'] = "Berhasil.";
            $_SESSION['message'] = "Data berhasil dihapus !";
            header('location: /webseafood/menu');
            exit;
        } else {
            mysqli_close($conn);
            $_SESSION['judul'] = "Gagal.";
            $_SESSION['message'] = "Gagal menghapus data!";
            header("Location: /webseafood/menu");
            exit();
        }
    } else {
        mysqli_close($conn);
        $_SESSION['judul'] = "Gagal.";
        $_SESSION['message'] = "Data tidak ditemukan.!";
        header("Location: /webseafood/menu");
        exit();
    }
}
