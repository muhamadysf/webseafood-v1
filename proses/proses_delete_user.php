<?php
session_start();

include "../config/connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";

if (isset($_POST['input_user_validate'])) {
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
