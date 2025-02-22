<?php
session_start();

include "../config/connect.php";
$id = (isset($_POST['iduser'])) ? htmlentities($_POST['iduser']) : "";

if (isset($_POST['delete_data'])) {
    $query = mysqli_query($conn, "DELETE FROM tb_user WHERE id='$id'");
    if ($query) {

        $_SESSION['judul'] = "Berhasil.";
        $_SESSION['message'] = "Data berhasil dihapus !";
    } else {
        $_SESSION['judul'] = "Gagal.";
        $_SESSION['message'] = "Gagal menghapus data!";
    }
    mysqli_close($conn);
    header("Location: /webseafood/user");
    exit();
}
