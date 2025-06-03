<?php
session_start();

include "../config/connect.php";

if (isset($_POST['btnSubmit'])) {
    mysqli_report(MYSQLI_REPORT_OFF);

    $idmenu = $_POST['id'];

    $query = "SELECT gambar_menu FROM tb_menu WHERE id_menu = '$idmenu'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $file_path = $_SERVER['DOCUMENT_ROOT'] . "/webseafood/" . $row['gambar_menu'];

        $delete = "DELETE FROM tb_menu WHERE id_menu = '$idmenu'";

        if (mysqli_query($conn, $delete)) {
            if (file_exists($file_path)) {
                unlink($file_path);
            }

            mysqli_close($conn);
            $_SESSION['judul'] = "Berhasil.";
            $_SESSION['message'] = "Data berhasil dihapus!";
            header('location: ../admin/menu');
            exit;
        } else {
            $error_code = mysqli_errno($conn);
            mysqli_close($conn);

            $_SESSION['judul'] = "Gagal.";
            if ($error_code == 1451) {
                $_SESSION['message'] = "Data tidak bisa dihapus karena masih digunakan dalam pesanan.";
            } else {
                $_SESSION['message'] = "Gagal menghapus data! Kode error: $error_code";
            }

            header("Location: ../admin/menu");
            exit();
        }
    } else {
        mysqli_close($conn);
        $_SESSION['judul'] = "Gagal.";
        $_SESSION['message'] = "Data tidak ditemukan!";
        header("Location: ../admin/menu");
        exit();
    }
}
