<?php
session_start();

include "../config/connect.php";


$name = (isset($_POST['nama'])) ? htmlentities($_POST['nama']) : "";
$username = (isset($_POST['email'])) ? htmlentities($_POST['email']) : "";
$level = (isset($_POST['level'])) ? htmlentities($_POST['level']) : "";
$nohp = (isset($_POST['nohp'])) ? htmlentities($_POST['nohp']) : "";
$alamat = (isset($_POST['alamat'])) ? htmlentities($_POST['alamat']) : "";
$password = md5($username);

if (isset($_POST['input_user_validate'])) {

    $sql = "INSERT INTO tb_user (nama,username,level,nohp,alamat,password) values (?,?,?,?,?,?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisss", $name, $username, $level, $nohp, $alamat, $password);

    if ($stmt->execute()) {
        $_SESSION['judul'] = "Berhasil.";
        $_SESSION['message'] = "Data user baru berhasil disimpan !";
    } else {
        $_SESSION['judul'] = "Gagal.";
        $_SESSION['message'] = "Data gagal disimpan! Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    header("Location: /webseafood/user");
    exit();
}
