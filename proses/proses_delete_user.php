<?php
session_start();

include "../config/connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";

if (isset($_POST['input_user_validate'])) {
    mysqli_report(MYSQLI_REPORT_OFF);

    $query = mysqli_query($conn, "DELETE FROM tb_user WHERE id_user ='$id'");
    if ($query) {

        $_SESSION['judul'] = "Berhasil.";
        $_SESSION['message'] = "Data berhasil dihapus !";
    } else {
        $error_code = mysqli_errno($conn);
        mysqli_close($conn);

        $_SESSION['judul'] = "Gagal.";
        if ($error_code == 1451) {
            $_SESSION['message'] = "Data tidak bisa dihapus karena masih digunakan dalam pesanan.";
        } else {
            $_SESSION['message'] = "Gagal menghapus data! Kode error: $error_code";
        }
    }
    mysqli_close($conn);
    header("Location: ../admin/user");
    exit();
}
