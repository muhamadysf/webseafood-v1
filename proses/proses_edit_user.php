<?php
session_start();

include "../config/connect.php";


$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$name = (isset($_POST['nama'])) ? htmlentities($_POST['nama']) : "";
$username = (isset($_POST['email'])) ? htmlentities($_POST['email']) : "";
$level = (isset($_POST['level'])) ? htmlentities($_POST['level']) : "";
$nohp = (isset($_POST['nohp'])) ? htmlentities($_POST['nohp']) : "";
$alamat = (isset($_POST['alamat'])) ? htmlentities($_POST['alamat']) : "";
$password = md5('password');

if (isset($_POST['input_user_validate'])) {
    $sql =  "UPDATE tb_user SET nama=?, username=?, level=?, nohp=?, alamat=? WHERE id=?";



    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssissi", $name, $username, $level, $nohp, $alamat, $id);

    if ($stmt->execute()) {
        $_SESSION['judul'] = "Berhasil.";
        $_SESSION['message'] = "Data user berhasil diperbarui !";
    } else {
        $_SESSION['judul'] = "Gagal.";
        $_SESSION['message'] = "Gagal memperbarui data: " . $stmt->error;
    }


    $stmt->close();
    $conn->close();
    header("Location: /webseafood/user");
    exit();
}
