<?php

include "../config/connect.php";
date_default_timezone_set("Asia/Bangkok");


$email = $_POST['email'];
$token = $_POST['token'];
$password = (isset($_POST['password'])) ? md5(htmlentities($_POST['password'])) : "";

$stmt = $conn->prepare("SELECT * FROM tb_reset_pwd WHERE email = ? AND token = ? AND expires_at > NOW()");
$stmt->bind_param("ss", $email, $token);
$stmt->execute();
$result = $stmt->get_result();
$reset = $result->fetch_assoc();

if ($reset) {

    $stmt = $conn->prepare("UPDATE tb_user SET password = ? WHERE email = ?");
    $stmt->bind_param("ss", $password, $email);
    $stmt->execute();


    $stmt = $conn->prepare("DELETE FROM tb_reset_pwd WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    echo "
        <script>
            alert('Password berhasil direset. Silakan login.');
            window.location = '../admin/login';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Token tidak ditemukan / sudah kadaluarsa.\nSilahkan ulangi proses anda...');
            window.location = '../admin/login';
        </script>";
}
