<?php
session_start();
include "connect.php";

$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$passwordlama = (isset($_POST['passwordlama'])) ? md5(htmlentities($_POST['passwordlama'])) : "";
$passwordbaru = (isset($_POST['passwordbaru'])) ? md5(htmlentities($_POST['passwordbaru'])) : "";
$repasswordbaru = (isset($_POST['repasswordbaru'])) ? md5(htmlentities($_POST['repasswordbaru'])) : "";

$message = "";

if (isset($_POST['ubah_password_validate'])) {
    $query = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$_SESSION[username_kingseafood]' AND password = '$passwordlama'");
    $hasil = mysqli_fetch_array($query);

    if ($hasil) {
        if ($passwordbaru == $repasswordbaru) {
            $query = mysqli_query($conn, "UPDATE tb_user SET password='$passwordbaru' WHERE id='$id'");
            if ($query) {
                $message = '<script>alert("Password Berhasil Di Ubah"); window.history.back();</script>';
            } else {
                $message = '<script>alert("Password Gagal Di Ubah"); window.history.back();</script>';
            }
        } else {
            $message = '<script>alert("Password Baru Tidak Sama"); window.history.back();</script>';
        }
    } else {
        $message = '<script>alert("Password Lama Tidak Sesuai"); window.history.back();</script>';
    }
} else {
    header('location:../home');
    exit; // Pastikan menghentikan eksekusi setelah redirect.
}

echo $message;
